<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name'     => 'Admin',
                'email'    => 'admin@erp.local',
                'password' => 'Admin@1234',
                'role'     => 'admin',
            ],
            [
                'name'     => 'Account Manager 1',
                'email'    => 'am@erp.local',
                'password' => 'Am@1234',
                'role'     => 'account_manager',
            ],
            [
                'name'     => 'Purchasing 1',
                'email'    => 'purchasing@erp.local',
                'password' => 'Pur@1234',
                'role'     => 'purchasing',
            ],
            [
                'name'     => 'Finance 1',
                'email'    => 'finance@erp.local',
                'password' => 'Fin@1234',
                'role'     => 'finance',
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}
