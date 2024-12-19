<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::create(['name' => 'Lance', 'email' => 'test@test.com', 'password' => 'test123']);
        // User::create(['name' => 'Michael', 'email' => 'michael@gmail.com', 'password' => 'test123']);
    
    
        User::factory()->count(10)->create();

    }
}
