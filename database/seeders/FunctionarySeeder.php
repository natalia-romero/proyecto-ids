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
                'name' => 'Natalia Oviedo',
                'rut' => '123',
                'phone' => '12345678',
                'email' => 'natalia.oviedo@correo.com',
            ],
            [
                'id' => 2,
                'name' => 'Diego Lillo',
                'rut' => '123',
                'phone' => '12345678',
                'email' => 'diego.perez@correo.com',
            ],
            [
                'id' => 3,
                'name' => 'Jonás Bustos',
                'rut' => '123',
                'phone' => '12345678',
                'email' => 'jonas.bustos@correo.com',
            ],
            [
                'id' => 4,
                'name' => 'Felipe Romero',
                'rut' => '123',
                'phone' => '12345678',
                'email' => 'felipe.romero@correo.com',
            ],
        ], ['id'], ['name'],['rut'],['phone'],['email']);
    }
}
