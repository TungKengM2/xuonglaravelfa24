<?php

namespace App\Http\Controllers;

use App\Models\CategoryPost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Post::join('category_posts', 'posts.category_id', '=', 'category_posts.id')
            ->select('posts.*', 'category_posts.name as category_id')
            ->latest('id')
            ->paginate(5);
        return view('admin.adminposts.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CategoryPost::all();
        return view('admin.adminposts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'name'              => 'required|max:255',
            'category_id'       => 'required|exists:category_posts,id',
            'title'             => 'required|max:255',
            'description'       => 'nullable',
            'image'             => 'nullable|image|max:2048',
            'views'             => 'required',
        ]);

        try {
            if ($request->hasFile('image')) {
                $data['image'] = Storage::put('posts', $request->file('image'));
            }

            Post::query()->create($data);

            return redirect()->route('adminposts.index')->with('success', true);
        } catch (\Throwable $th) {

            if (!empty($data['image']) && Storage::exists($data['image'])) {

                Storage::delete($data['image']);
            }

            return back()->with('success', false)->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $adminpost)
    {
        return view('admin.adminposts.show', compact('adminpost'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $adminpost)
    {
        $categories = CategoryPost::all();

        return view('admin.adminposts.edit', compact('adminpost', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $adminpost)
    {

        $data = $request->validate([
            'name'              => 'required|max:255',
            'category_id'       => 'required|exists:category_posts,id',
            'title'             => 'required|max:255',
            'description'       => 'nullable',
            'image'             => 'nullable|image|max:2048',
            'views'             => 'required',
        ]);

        try {
            if ($request->hasFile('image')) {

                $data['image'] = Storage::put('posts', $request->file('image'));
            }

            $currentImage = $adminpost->image;

            $adminpost->update($data);

            if (
                $request->hasFile('image')
                && !empty($currentImage)
                && Storage::exists($currentImage)
            ) {
                Storage::delete($currentImage);
            }

            return back()->with('success', true);
        } catch (\Throwable $th) {

            if (!empty($data['image']) && Storage::exists($data('image'))) {
                Storage::delete($data['image']);
            }

            return back()
                ->with('success', false)
                ->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $adminpost)
    {

        try {
            $adminpost->delete();
            return back()->with('success', true);
        } catch (\Throwable $th) {
            return back()
                ->with('success', false)
                ->with('error', $th->getMessage());
        }
    }

    public function forceDestroy(Post $adminpost)
    {
        try {
            $adminpost->forceDelete();

            if (!empty($adminpost->image) && Storage::exists($adminpost->image)) {
                Storage::delete($adminpost->image);
            }
            return back()->with('success', true);
        } catch (\Throwable $th) {
            return back()
                ->with('success', false)
                ->with('error', $th->getMessage());
        }
    }
}
