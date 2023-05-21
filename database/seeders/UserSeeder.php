<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
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
                'name' => 'Coordinador',
                'rut' => '12345678-1',
                'phone' => '+56912345678',
                'email' => 'coordinador@correo.com',
                'password' => Hash::make('12345678'),
                'role_id' => Role::COORDINATOR_ID
            ],
            [
                'id' => 2,
                'name' => 'John Doe',
                'rut' => '22333444-1',
                'phone' => '+56912345678',
                'email' => 'soporte@correo.com',
                'password' => Hash::make('12345678'),
                'role_id' => Role::SUPPORT_ID
            ],
        ],['id']);
    }
}
