<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        User::upsert([
            [
                'id' => 1,
                'name' => 'Admin',
                'rut' => '12345678-1',
                'phone' => '+56912345678',
                'email' => 'admin@admin.com',
                'password' => Hash::make('Admin'),
                'role_id' => 1
            ]
        ],['id'],['name'],['rut'],['phone'],['email'],['password'],['role_id']);
    }
}