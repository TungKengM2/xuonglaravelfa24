<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Comment;
use App\Models\Phone;
use App\Models\Post1;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

    //     for ($i=0; $i < 10; $i++) {
    //         Role::create([
    //             'name' => fake()->text(20)
    //         ]);
    //     }

        // for ($i = 0; $i < 10; $i++) {
        //     Post1::create([
        //         'title' => fake()->text(100)
        //     ]);
        // }

        // for ($i = 1; $i < 11; $i++) {
        //     Comment::create([
        //         'post1_id' => $i,
        //         'content' => fake()->text
        //     ]);

        //     Comment::create([
        //         'post1_id' => $i,
        //         'content' => fake()->text
        //     ]);

        //     Comment::create([
        //         'post1_id' => $i,
        //         'content' => fake()->text
        //     ]);
        // }



        // $userIDs = User::pluck('id')->all();

        // foreach ($userIDs as $userID) {
        //     Phone::query()->create([
        //         'user_id' => $userID,
        //         'value' => fake()->unique()->phoneNumber(),
        //     ]);
        // }

        // $this->call([
        //     FlightSeeder::class,
        //     UserSeeder::class,
        // ]);


        // $this->call([FlightSeeder::class]);

        // $this->call([UserSeeder::class]);
        // \App\Models\User::factory(1000)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        // DB::table('products')->insert([
        //     ['name' => 'Bàn gỗ', 'price' => 2000000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['name' => 'Ghế xoay', 'price' => 1500000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['name' => 'Tủ quần áo', 'price' => 5000000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['name' => 'Giường ngủ', 'price' => 8000000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        // ]);

        // DB::table('sales')->insert([
        //     ['product_id' => 1, 'quantity' => 3, 'price' => 2000000, 'tax' => 600000, 'total' => 6600000, 'sale_date' => '2024-09-15', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['product_id' => 2, 'quantity' => 2, 'price' => 1500000, 'tax' => 300000, 'total' => 3300000, 'sale_date' => '2024-09-16', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['product_id' => 3, 'quantity' => 1, 'price' => 5000000, 'tax' => 500000, 'total' => 5500000, 'sale_date' => '2024-09-16', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['product_id' => 4, 'quantity' => 2, 'price' => 8000000, 'tax' => 1600000, 'total' => 17600000, 'sale_date' => '2024-09-16', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        // ]);

        // DB::table('expenses')->insert([
        //     ['description' => 'Nhập hàng tháng 9', 'amount' => 5000000, 'expense_date' => '2024-09-05', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['description' => 'Chi phí vận chuyển', 'amount' => 1000000, 'expense_date' => '2024-09-06', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['description' => 'Bảo hành sản phẩm', 'amount' => 800000, 'expense_date' => '2024-09-12', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['description' => 'Lương nhân viên tháng 9', 'amount' => 12000000, 'expense_date' => '2024-09-30', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        // ]);

        // DB::table('financial_reports')->insert([
        //     'month' => 9,
        //     'year' => 2024,
        //     'total_sales' => 32000000,
        //     'total_expenses' => 18800000,
        //     'profit_before_tax' => 13200000,
        //     'tax_amount' => 3200000,
        //     'profit_after_tax' => 10000000,
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now()
        // ]);

        // DB::table('taxes')->insert([
        //     ['tax_name' => 'VAT', 'rate' => 10, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        // ]);
    }
}
