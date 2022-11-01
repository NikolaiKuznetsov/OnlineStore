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

        Product::factory(50)->state(new Sequence(
            ['image' => '1.avif'],
            ['image' => '2.avif'],
            ['image' => '3.avif'],
            ['image' => '4.avif'],
        ))->create();

//        Category::factory(5)->state(new Sequence(
//            ['name' => 'Электроника', 'slug' => Str::of('Электроника')->slug('-')],
//            ['name' => 'Товары для дома', 'slug' => Str::of('Товары для дома')->slug('-')],
//            ['name' => 'Одежда', 'slug' => Str::of('Одежда')->slug('-')],
//            ['name' => 'Аксессуары', 'slug' => Str::of('Аксессуары')->slug('-')],
//            ['name' => 'Инструменты', 'slug' => Str::of('Инструменты')->slug('-')],
//        ))->create();
        Category::factory(5)->state(new Sequence(
            ['name' => 'Лазерные принтеры'],
            ['name' => 'Струйные принтеры'],
            ['name' => 'Термопринтеры'],
        ))->create();
    }
}
