<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\CategoryPostController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Financial_ReportController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\FlagMiddleware;
use App\Models\Flight;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Route::get('/', function () {
//     // echo (new OrderItem())->getTable();
//     // die;

//     // Flight::findOrCreate();
//     // die;


//     return view('welcome');
// });


// Route::middleware([FlagMiddleware::class])->group(function () {
//     Route::resource('customers', CustomerController::class);
//     Route::delete('customers/{customer}/forceDestroy', [CustomerController::class, 'forceDestroy'])->name('customers.forceDestroy');


//     // Route::resource('employees', EmployeeController::class);
//     // Route::delete('employees/{employee}/forceDestroy', [EmployeeController::class, 'forceDestroy'])->name('employees.forceDestroy');
// });

Route::resource('customers', CustomerController::class)->middleware('auth');
Route::delete('customers/{customer}/forceDestroy', [CustomerController::class, 'forceDestroy'])->name('customers.forceDestroy');

// Route::get('login', function () {
//     echo 'Đây là trang login';
//     die;
// })->name('login');

// Buổi 5 session

Route::get('session', function () {
    // session()->put('ahihi', 'xxxxxx');

    // session()->put('ahihi', [
    //     'name' => 'kkkkk',
    //     'email' => 'kkkk@gmail.com',
    // ]);

    // session()->put('orders', []);

    // session()->put('orders.101', [
    //     'name' => 'Sản phẩm 1',
    //     'price' => 50000
    // ]);


    // session(['orders.102' => ['name' => 'Sản phẩm 1', 'price' => 50000]]);


    // [
    //     101 => [
    //         'name' => 'Sản phẩm 1',
    //         'price' => 50000
    //     ]
    //     ,
    //     102 => [
    //         'name' => 'Sản phẩm 1',
    //         'price' => 2222
    //     ]
    // ]


    // return session()->get('ahihi', '789');

    // session()->forget('ahihi');

    // session()->regenerate();

    // session()->invalidate();

    // session()->flash('keke', 'OK luôn');

    // echo session('keke');

    return session()->all();
});



// BÀI LÀM ASM

// Client

Route::resource('posts', PostController::class);
Route::delete('posts/{post}/forceDestroy', [PostController::class, 'forceDestroy'])->name('posts.forceDestroy');

Route::resource('categorypost', CategoryPostController::class);
Route::delete('categorypost/{categorypost}/forceDestroy', [CategoryPostController::class, 'forceDestroy'])->name('categorypost.forceDestroy');

Route::get('/category/{category_id}', [PostController::class, 'getPostsByCategory'])->name('category.posts');


// Admin
// Route::get('/adminPostIndex', [PostController::class, 'adminPostIndex']);
Route::resource('admin/adminposts', AdminPostController::class);
Route::delete('adminposts/{adminpost}/forceDestroy', [CategoryPostController::class, 'forceDestroy'])->name('adminposts.forceDestroy');

Route::get('/adminHome', function () {
    return view('Admin.dashboard');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
