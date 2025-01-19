<?php

namespace Database\Seeders;

use App\Enums\UserStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('123456'),
                'phone' => '0989889889',
                'address' => 'HANOI',
                'status' => UserStatus::ACTIVE(),
            ],
            [
                'name' => 'moderator',
                'email' => 'moderator@gmail.com',
                'password' => Hash::make('123456'),
                'phone' => '0986886886',
                'address' => 'HANOI',
                'status' => UserStatus::ACTIVE(),
            ],
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456'),
                'phone' => '0983838383',
                'address' => 'HANOI',
                'status' => UserStatus::ACTIVE(),
            ]

        ];
        DB::table('users')->insert($users);
    }
}
