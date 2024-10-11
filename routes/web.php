<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\CategoryPostController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Financial_ReportController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\FlagMiddleware;
use App\Models\Flight;
use App\Models\OrderItem;
use App\Models\Phone;
use App\Models\Post1;
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

Route::get('/1', function () {

    // echo DB::table('users')->inRandomOrder()->limit(10)->toRawSql();die;


    // $users = User::where(function (Builder $query) {
    //     $query->select('type')
    //         ->from('membership')
    //         ->whereColumn('membership.user_id', 'users.id')
    //         ->orderByDesc('membership.start_date')
    //         ->limit(1);
    // }, 'Pro')
    //     ->toRawSQL();
    // dd($users);

    // echo DB::table('products')
    //     ->whereNot(function (Builder $query) {
    //         $query->where('clearance', true)
    //             ->orWhere('price', '<', 10);
    //     })
    //     ->toRawSql();
    // die;

    // $users = DB::table('users')->where(function (Builder $query) {
    //     $query->where('name', 'Abigail')
    //           ->orWhere('votes', '>', 50);
    // })
    //     ->where('is_vip', true)
    //     ->toRawSql();
    // dd($users);

    // echo DB::table('users')
    //     ->join('contacts', function (JoinClause $join) {
    //         $join->on('users.id', '=', 'contacts.user_id')
    //         ->where('contact.user_id', '>', 100);
    //     })
    //     ->where('status',  1)
    //     ->toRawSql();
    // die;

    // $users = DB::table('users', 'u')
    //     ->join('contacts as c', 'u.id', '=',  'c.user_id')
    //     ->join('orders as o', 'u.id', '=', 'o.user_id')
    //     ->select(
    //         'u.*',
    //         'c.phone as c_phone',
    //         'o.price as o_price'
    //     )
    //     ->toRawSql();

    // dd($users);

    // $orders = DB::table('orders')
    //     ->selectRaw('price * ? as price_with_tax, ?', [1.0825, 'Okok'])
    //     ->toRawSql();

    // dd($orders);

    // $users = DB::table('users')
    //     // ->select(DB::raw('count(*) as user_count, status'))

    //     ->selectRaw('count(*) as user_count, status')

    //     ->where('status', '<>', 1)

    //     ->groupBy('status')

    //     ->toRawSql();
    // dd($users);

    // $users = DB::table('users')->get();

    // foreach ($users as $user){
    //     dd($user->name);
    // };

    // $query = DB::table('users')->wheres('name', 'Jamaal Morar');

    // $query = DB::table('users')->select('name', 'email as user_email');


    // $user = $query
    //     ->limit(10)
    //     ->get();

    // $user2 = $query->addSelect('password')
    //     ->limit(10)
    //     ->get();

    // dd($user, $user2);

    // $count = $query->count('id');
    // $sum = $query->sum('id');
    // $avg = $query->where('id', '?', 100)->avg('id');
    // $min = $query->min('id');
    // $max = $query->max('id');

    // dd(
    //     $count,
    //     $sum,
    //     $avg,
    //     $min,
    //     $max
    // );

    // $query->orderBy('id')->chunk(100, function (Collection $users) {

    //     // dd($users);

    //     foreach ($users as $user){
    //         /// ...
    //      }
    // });

    // $query->orderBy('id')->lazy()->each(function () {
    //     // ...
    // });

    // $name = $query->pluck('name', 'email')->all();

    // dd($name);

    // dd($query->toRawSQL());

    // $first = $query->find(2);

    // $first = $query->findOr(233333, function () {
    //     abort(404);
    // });

    // dd($first);

    return view('welcome');
});

// PHẦN 1: CHUYỂN ĐỔI CÂU SQL VỀ QUERY BUILDER OR ELOQUENT

// Truy vấn kết hợp nhiều bảng (JOIN):

Route::get('/cauhoi1', function () {
    $query = DB::table('users', 'u')
        ->join('orders as o', 'u.id', '=', 'o.user_id')
        ->select('u.name', DB::raw('SUM(o.amount) as total_spent'))
        ->groupBy('u.name')
        ->having('total_spent', '>', '1000');


    dd($query->toRawSql());
});

//Truy vấn thống kê dựa trên khoảng thời gian (Time-based statistics)

Route::get('/cauhoi2', function () {
    $query = DB::table('orders')
        ->select(DB::raw('DATE(order_date) as date'), DB::raw('COUNT(*) AS orders_count'), DB::raw('SUM(total_amount) AS total_sales'))
        ->whereBetween('order_date', ['2024-01-01', '2024-09-30'])
        ->groupBy(DB::raw('DATE(order_date)'));


    dd($query->toRawSql());
    $query->get();
});

//Truy vấn để tìm kiếm giá trị không có trong tập kết quả khác (NOT EXISTS):

Route::get('/cauhoi3', function () {
    $query = DB::table('products', 'p')
        ->select('product_name')
        ->whereNotExists(function ($cauhoi3) {
            $cauhoi3->select(DB::raw(1))
                ->from('orders as o')
                ->whereRaw('o.product_id = p.id');
        });

    dd($query->toRawSql());
    $query->get();
});

//Truy vấn với CTE (Common Table Expression):
// câu só 4 em chưa làm được

Route::get('/cauhoi4', function () {
    $query = DB::table('sales')
        ->select('product_id', DB::raw('SUM(quantity) as total_sold'))
        ->groupBy('product_id');

    $query = DB::table('products as p')
        ->joinSub($query, 's', function ($join) {
            $join->on('p.id', '=', 's.product_id');
        })
        ->where('s.total_sold', '>', 100)
        ->select('p.product_name', 's.total_sold');



    dd($query->toRawSql());
    $query->get();
});

//Truy vấn lấy danh sách người dùng đã mua sản phẩm trong 30 ngày qua, cùng với thông tin sản phẩm và ngày mua

Route::get('/cauhoi5', function () {
    $query = DB::table('users')
        ->join('orders', 'users.id', '=', 'orders.user_id')
        ->join('order_items', 'orders.id', '=', 'order_items.order_id')
        ->join('products', 'order_items.product_id', '=', 'products.user_id')
        ->select('users.name', 'products.product_name', 'orders.order_date')
        ->where('orders.order_date', '>=', Carbon::now()->subday(30));



    dd($query->toRawSql());
});

//Truy vấn lấy tổng doanh thu theo từng tháng, chỉ tính những đơn hàng đã hoàn thành

Route::get('/cauhoi6', function () {
    $query = DB::table('orders')
        ->join('order_item', 'orders.id', '=', 'order_items.order_id')
        ->select(
            DB::raw("DATE_FORMAT(orders.order_date, '%Y-%m') AS order_month"),
            DB::raw("SUM(order_items.quantity * orders.id = order_items.price) AS total_revenue")
        )
        ->where('orders.status', 'completed')
        ->groupBy('order_month')
        ->orderByDesc('order_month');


    dd($query->toRawSql());
});

//Truy vấn các sản phẩm chưa từng được bán (sản phẩm không có trong bảng order_items)

Route::get('/cauhoi7', function () {
    $query = DB::table('products')
        ->leftJoin('order_items', 'products.id', '=', 'order_items.product_id')
        ->select('products.product_name')
        ->whereNull('order_items.product_id');

    dd($query->toRawSql());
});


//Lấy danh sách các sản phẩm có doanh thu cao nhất cho mỗi loại sản phẩm

Route::get('/cauhoi8', function () {
    $query = DB::table('products', 'p')
        ->join(DB::raw('(SELECT product_id, SUM(quantity * price) AS total FROM order_items GROUP BY product_id) as oi'), 'p.id', '=', 'oi.product_id')
        ->select('p.category_id', 'p.product_name', DB::raw('MAX(oi.total) as max_revenue'))
        ->groupBy('p.category_id', 'p.product_name')
        ->orderByDesc('max_revenue');

    dd($query->toRawSql());
});


//Truy vấn thông tin chi tiết về các đơn hàng có giá trị lớn hơn mức trung bình

Route::get('/cauhoi9', function () {
    $query = DB::table('orders')
        ->join('users', 'users.id', '=', 'orders.user_id')
        ->join('order_items', 'orders.id', '=', 'order_items.order_id')
        ->select('orders.id', 'users.name', 'orders.order_date', DB::raw('SUM(order_items.quantity * order_items.price) AS total_value'))
        ->groupBy('orders.id', 'users.name', 'orders.order_date')
        ->havingRaw('total_value > (SELECT AVG(total) FROM (SELECT SUM(quantity * price) AS total FROM order_items GROUP BY order_id) AS avg_order_value)');


    dd($query->toRawSql());
});

//Truy vấn tìm tất cả các sản phẩm có doanh số cao nhất trong từng danh mục (category)

Route::get("/cauhoi10", function () {
    $query = DB::table('products', 'p')
        ->join('order_items as oi', 'p.id', '=', 'oi.product_id')
        ->select('p.category_id', 'p.product_name', DB::raw("SUM(oi.quantity) AS total_sold"))
        ->groupBy('p.category_id', 'p.product_name')
        ->havingRaw('total_sold = (SELECT MAX(sub.total_sold) FROM (SELECT product_name, SUM(quantity) AS total_sold FROM order_items JOIN products ON order_items.product_id = products.id WHERE products.category_id = p.category_id GROUP BY product_name) sub)');

    dd($query->toRawSql());
});


// PHẦN 2 TÌM HIỂU VỀ ELOQUENT

// 1. Eloquent ORM là gì trong laravel

// Eloquent ORM trong Laravel là hệ thống quản lý cơ sở dữ liệu (ORM) giúp bạn làm việc với các bảng trong database dưới dạng các mô hình (model) PHP. Mỗi model đại diện cho một bảng, và bạn có thể dễ dàng thực hiện các thao tác như truy vấn, chèn, cập nhật, xóa dữ liệu mà không cần viết các câu lệnh SQL thủ công. Eloquent cung cấp cú pháp trực quan và mạnh mẽ để làm việc với database.

// 2. Laravel Eloquent có các quy ước mặc định nào khi ảnh xạ giữa tên model và bảng trong cơ sở dữ liệu?

// Tên bảng: Mặc định, Eloquent sẽ lấy tên bảng từ tên model và chuyển về số nhiều bằng tiếng Anh.

// Khóa chính (Primary Key): Mặc định, Eloquent sử dụng cột id làm khóa chính.

// Timestamps: Eloquent tự động mong đợi các cột created_at và updated_at trong bảng để theo dõi thời gian tạo và cập nhật bản ghi.

// Khóa ngoại (Foreign Key): Mặc định, Eloquent sẽ sử dụng tên của model, chuyển về dạng snake_case và thêm hậu tố _id để tạo tên khóa ngoại.


// 3. Làm thế nào để thay đổi tên bảng (table) và khóa chính (primary key) mặc định trong Eloquent?

// Thay đổi tên bảng: Chỉ định tên bảng bằng cách thêm thuộc tính $table trong model.

// class User extends Model
// {
//     protected $table = 'my_users'; // Tên bảng được thay đổi thành 'my_users'
// }

// Thay đổi tên khóa chính: Mặc định, Eloquent sử dụng cột id làm khóa chính, nhưng có thể thay đổi tên cột khóa chính bằng cách khai báo thuộc tính $primaryKey.

// class User extends Model
// {
//     protected $primaryKey = 'user_id'; // Khóa chính được thay đổi thành 'user_id'
// }

// 4. CRUD với Eloquent ORM như nào?

// Create

// Trong model User
// protected $fillable = ['name', 'email', 'password'];

// // Tạo bản ghi mới
// $user = User::create([
//     'name' => 'John Doe',
//     'email' => 'john@example.com',
//     'password' => bcrypt('secret')
// ]);

// Update

// $user = User::find(1);
// $user->update([
//     'name' => 'Jane Doe',
//     'email' => 'jane@example.com'
// ]);

// Delete

// $user = User::find(1);
// $user->delete();

// Route::get('/', function () {
//     // echo (new OrderItem())->getTable();
//     // die;

//     // Flight::findOrCreate();
//     // die;


//     return view('welcome');
// });


Route::get('/doanh-thu', function () {
    $sales = DB::table('sales')
        ->selectRaw('SUM(total) as total_sales, MONTH(sale_date) as month, YEAR(sale_date) as year')
        ->groupBy(DB::raw('MONTH(sale_date)'), DB::raw('YEAR(sale_date)'))
        ->get();
    dd($sales);
});

Route::get('/chi-phi', function () {
    $expenses = DB::table('expenses')
        ->selectRaw('SUM(amount) as total_expenses, MONTH(expense_date) as month, YEAR(expense_date) as year')
        ->groupBy(DB::raw('MONTH(expense_date)'), DB::raw('YEAR(expense_date)'))
        ->get();
    dd($expenses);
});


//


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

// Bài tập buổi 3

// Route::resource('employees', EmployeeController::class);
// Route::delete('employees/{employee}/forceDestroy', [EmployeeController::class, 'forceDestroy'])->name('employees.forceDestroy');

// Bài tập buổi 4

// Bài 1
Route::get('/19Phim', [MovieController::class, 'index'])->middleware('kiemtratuoi');

Route::get('/rap-phim-19/{age}', function ($age) {
    session(['age' => $age]);
    return redirect('/19Phim');
});

// Bài 2

Route::get('/quyen-truy-cap/{role}', function ($role) {
    session(['role' => $role]);
    return redirect('/');
});


Route::middleware(['kiemtraadmin:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});

Route::middleware(['kiemtraadmin:nhanvien'])->group(function () {
    Route::get('/nhanvien', [OrderController::class, 'index'])->name('orders.index');
});

Route::middleware(['kiemtraadmin:khachhang'])->group(function () {
    Route::get('/khachhang', [ProfileController::class, 'index'])->name('profile.index');
});

// Bài 3 em chưa làm được



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

Route::get('/users', function () {
    $data = User::with('phone')->paginate(15);

    return view('user_list', compact('data'));
});

// Route::get('/phones/{id}', function ($id) {
//     $phone = Phone::find($id);

//     dd($phone->user);
// });

// Route::get('/phones/{id}', function ($id) {
//     $phone = Phone::with('user')->find($id);

//     dd($phone->toArray());
// });

// Route::get('/posts/{id}', function ($id) {
//     $post = Post1::find($id);

//     dd($post->toArray());
// });

// Route::get('/posts/{id}', function ($id) {
//     $post = Post1::find($id);

//     dd($post->comments->toArray());
// });

Route::get('/posts/{id}', function ($id) {
    $post = Post1::with('comments')->find($id);

    dd($post->toArray());
});

Route::get('/users/{id}/add-role', function ($id) {

    $roles = [1, 5, 6, 8];

    $user = User::find($id);

    $user->roles()->attach($roles);

    dd($user->load('roles')->toArray());
});

Route::get('/users/{id}/remove-role', function ($id) {

    $rolesRomove = [5, 6];

    $user = User::find($id);

    $user->roles()->detach($rolesRomove);

    dd($user->load('roles')->toArray());
});

Route::get('/users/{id}/sync-role', function ($id) {

    $roles = [3, 6, 9, 5, 7];

    $user = User::find($id);

    $user->roles()->sync($roles);

    dd($user->load('roles')->toArray());
});


// BÀI LÀM ASM

// Client

// Route::resource('posts', PostController::class);
// Route::delete('posts/{post}/forceDestroy', [PostController::class, 'forceDestroy'])->name('posts.forceDestroy');

// Route::resource('categorypost', CategoryPostController::class);
// Route::delete('categorypost/{categorypost}/forceDestroy', [CategoryPostController::class, 'forceDestroy'])->name('categorypost.forceDestroy');

// Route::get('/category/{category_id}', [PostController::class, 'getPostsByCategory'])->name('category.posts');


// // Admin
// // Route::get('/adminPostIndex', [PostController::class, 'adminPostIndex']);
// Route::resource('admin/adminposts', AdminPostController::class);
// Route::delete('adminposts/{adminpost}/forceDestroy', [CategoryPostController::class, 'forceDestroy'])->name('adminposts.forceDestroy');

// Route::get('/adminHome', function () {
//     return view('Admin.dashboard');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
