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
        User::create([
            'name'=>'Demo User',
            'email'=>'demo@gmail.com',
            'password'=>bcrypt('password'),
            'role'=>'contributor',
            'university'=>'Yangon University',
        ]);
    }
}
