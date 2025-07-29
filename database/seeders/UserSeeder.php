<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            'user01',
            'user02',
            'user03',
            'user04',
            'user05',
        ];

        // 配列をループしてデータを作成
        foreach ($users as $userName) {
            User::create([
                'name' => $userName,
                'email' => $userName . '@laranote.test',
                'password' => Hash::make('passpass'),
            ]);
        }
    }
}
