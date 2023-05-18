<?php

namespace Database\Seeders;

use App\Models\Category;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::upsert([
            [
                'id' => 1,
                'name' => 'Software'
            ],
            [
                'id' => 2,
                'name' => 'Impresora'
            ],
            [
                'id' => 3,
                'name' => 'Cambio contraseña'
            ],
            [
                'id' => 4,
                'name' => 'Creación correo'
            ],
        ], ['id'], ['name']);
    }
}
