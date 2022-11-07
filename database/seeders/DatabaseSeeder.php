<?php

namespace Database\Seeders;

use App\Models\AdminUser;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();

        AdminUser::factory(1)->create();

        Product::factory(50)->create();

        Category::factory(3)->state(new Sequence(
            ['name' => 'Лазерные принтеры'],
            ['name' => 'Струйные принтеры'],
            ['name' => 'Термопринтеры'],
        ))->create();
    }
}
