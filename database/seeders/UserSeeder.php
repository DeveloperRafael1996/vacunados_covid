<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'name' => 'Aron',
                'email' => 'aron@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'condicion' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Administrador',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'condicion' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
