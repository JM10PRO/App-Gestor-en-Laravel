<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 0: Admin, 1: Operario, 2: Cliente

        User::create([
            'name' => 'JM10PRO Dev',
            'email' => 'devjm10pro@gmail.com',
            'password' => Hash::make('passwd1234'),
            'role' => 0
        ]);
        
        User::create([
            'name' => 'Santi',
            'email' => 'santi2@gmail.com',
            'password' => Hash::make('passwd1234'),
            'role' => 1
        ]);
        
        User::create([
            'name' => 'Carlos',
            'email' => 'carlos2@gmail.com',
            'password' => Hash::make('passwd1234'),
            'role' => 2
        ]);
    }
}
