<?php

namespace Database\Seeders;

use App\Constants\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Administrator',
                'email' => 'admin@mail.ru',
                'password' => bcrypt('12345678'),
                'type' => UserRole::SUPERADMIN
            ]
        ];

        User::query()->insert($data);
    }
}
