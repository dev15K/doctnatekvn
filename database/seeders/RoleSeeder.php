<?php

namespace Database\Seeders;

use App\Enums\RoleName;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => RoleName::USER()],
            ['name' => RoleName::MODERATOR()],
            ['name' => RoleName::ADMIN()],
        ];
        DB::table('roles')->insert($roles);
    }
}
