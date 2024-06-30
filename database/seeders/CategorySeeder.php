<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['category_name' => 'Games', 'is_active' => 1],
            ['category_name' => 'Movies', 'is_active' => 1],
            ['category_name' => 'Sports', 'is_active' => 1],
            ['category_name' => 'Music', 'is_active' => 1],
            ['category_name' => 'Dining Out', 'is_active' => 1],
            ['category_name' => 'Groceries', 'is_active' => 1],
            ['category_name' => 'Electronics', 'is_active' => 1],
            ['category_name' => 'Furniture', 'is_active' => 1],
            ['category_name' => 'Rent', 'is_active' => 1],
        ]);
    }
}
