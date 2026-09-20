<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'imismaindra@gmail.com'],
            [
                'name' => 'Admin',
                'password' => 'qwertyuiop1902',
                'is_admin' => true,
            ]
        );
    }
}
