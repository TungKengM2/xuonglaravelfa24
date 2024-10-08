<?php

namespace App\Http\Controllers;

use App\Models\CategoryPost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PostController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Post::latest('id')->paginate(5);
        return view('posts.index', compact('data'));
    }

    // public function adminPostIndex()
    // {
    //     $data = DB::table('posts')
    //         ->join('category_posts', 'posts.category_id', '=', 'category_posts.id')
    //         ->select('posts.*', 'category_posts.name as category_id')
    //         ->latest('id')
    //         ->paginate(5);
    //     return view('admin.adminposts.index', compact('data'));
    // }

    public function getPostsByCategory($category_id)
    {
        $data = Post::join('category_posts', 'posts.category_id', '=', 'category_posts.id')
            ->select('posts.id', 'posts.name', 'posts.views', 'posts.image', 'posts.title', 'posts.description', 'posts.category_id', 'category_posts.name as category_id')
            ->where('posts.category_id', $category_id)
            ->latest('id')
            ->paginate(5);
        return view('posts.tintrongloai', compact('data', 'category_id'));
    }


    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     $categories = CategoryPost::all();
    //     return view('Admin.posts.create', compact('categories'));
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         'name'              => 'required|max:255',
    //         'category_id'       => 'required|exists:category_posts,id',
    //         'title'             => 'required|max:255',
    //         'description'       => 'nullable',
    //         'image'             => 'nullable|image|max:2048',
    //         'views'             => 'required',
    //     ]);

    //     try {
    //         if ($request->hasFile('image')) {
    //             $data['image'] = Storage::put('posts', $request->file('image'));
    //         }

    //         Post::query()->create($data);

    //         return redirect()->route('posts.index')->with('success', true);
    //     } catch (\Throwable $th) {

    //         if (!empty($data['image']) && Storage::exists($data['image'])) {

    //             Storage::delete($data['image']);
    //         }

    //         return back()->with('success', false)->with('error', $th->getMessage());
    //     }
    // }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('Admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('Admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Post $post)
    // {

    //     $data = $request->validate([
    //         'name'              => 'required|max:255',
    //         'category_id'       => 'required|exists:category_posts,id',
    //         'title'             => 'required|max:255',
    //         'description'       => 'nullable',
    //         'image'             => 'nullable|image|max:2048',
    //         'views'             => 'required',
    //     ]);

    //     try {
    //         if ($request->hasFile('image')) {

    //             $data['image'] = Storage::put('posts', $request->file('image'));
    //         }

    //         $currentImage = $post->image;

    //         $post->update($data);

    //         if (
    //             $request->hasFile('image')
    //             && !empty($currentImage)
    //             && Storage::exists($currentImage)
    //         ) {
    //             Storage::delete($currentImage);
    //         }

    //         return back()->with('success', true);
    //     } catch (\Throwable $th) {

    //         if (!empty($data['image']) && Storage::exists($data('image'))) {
    //             Storage::delete($data['image']);
    //         }

    //         return back()
    //             ->with('success', false)
    //             ->with('error', $th->getMessage());
    //     }
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {

        try {
            $post->delete();
            return back()->with('success', true);
        } catch (\Throwable $th) {
            return back()
                ->with('success', false)
                ->with('error', $th->getMessage());
        }
    }

    public function forceDestroy(Post $post)
    {
        try {
            $post->forceDelete();

            if (!empty($post->image) && Storage::exists($post->image)) {
                Storage::delete($post->image);
            }
            return back()->with('success', true);
        } catch (\Throwable $th) {
            return back()
                ->with('success', false)
                ->with('error', $th->getMessage());
        }
    }
}
