<?php

namespace Database\Seeders;

use App\Models\Functionary;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FunctionarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Functionary::upsert([
            [
                'id' => 1,
                'name' => 'John Doe',
                'rut' => '123',
                'phone' => '12345678',
                'email' => 'john.doe@mail.com',
            ],
            [
                'id' => 2,
                'name' => 'Diego Perez',
                'rut' => '123',
                'phone' => '12345678',
                'email' => 'diego.perez@mail.com',
            ],
            [
                'id' => 3,
                'name' => 'Homero Simpson',
                'rut' => '123',
                'phone' => '12345678',
                'email' => 'homero.simp@mail.com',
            ],
            [
                'id' => 4,
                'name' => 'Felipe Bustos',
                'rut' => '123',
                'phone' => '12345678',
                'email' => 'felipe.bustos@mail.com',
            ],
        ], ['id'], ['name'],['rut'],['phone'],['email']);
    }
}
