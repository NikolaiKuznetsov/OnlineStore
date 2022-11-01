<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AdminUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Admin',
            'login' => 'admin',
            'email' => 'example@example.com',
            'password' => bcrypt('admin11'),
            'remember_token' => Str::random(10),
        ];
    }
}
