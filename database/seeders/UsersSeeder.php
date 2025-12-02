<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "name" => "Test",
            "email" => "test@gmail.com",
            "password" => "Password@123"
        ]); 

        User::create([
            "name" => "Demo",
            "email" => "demo@gmail.com",
            "password" => "Password@123"
        ]); 

        User::create([
            "name" => "John",
            "email" => "john@gmail.com",
            "password" => "Password@123"
        ]);

        User::create([
            "name" => "Doe",
            "email" => "doe@gmail.com",
            "password" => "Password@123"
        ]);
    }
}
