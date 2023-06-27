<?php

namespace Database\Seeders;

use App\Models\Category;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    // Asignación de celular
    // Asignación de Pc escritorio
    // Asignación de pendrive 
    // Instalación de software 
    // Instalación de impresora 
    // Mantención de impresora 
    // Solicitud de toner
    // Soporte ofimatico
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
                'name' => 'Creación de correo'
            ],
            [
                'id' => 2,
                'name' => 'Creación de cuentas de plataformas web'
            ],
            [
                'id' => 3,
                'name' => 'Re-establecer contraseña correo'
            ],
            [
                'id' => 4,
                'name' => 'Re-establecer contraseña plataformas web'
            ],
            [
                'id' => 5,
                'name' => 'Creación correo'
            ],
            [
                'id' => 6,
                'name' => 'Caída de servicio de internet'
            ],
            [
                'id' => 7,
                'name' => 'Caída de servicio telefónico'
            ],
            [
                'id' => 8,
                'name' => 'Caída de enlace'
            ],
            [
                'id' => 9,
                'name' => 'Caída de plataformas web'
            ],
            [
                'id' => 10,
                'name' => 'Bloqueo de correo malicioso'
            ],
            [
                'id' => 11,
                'name' => 'Habilitar plataformas web'
            ],
            [
                'id' => 12,
                'name' => 'Asignación de teclado'
            ],
            [
                'id' => 13,
                'name' => 'Asignación de mouse'
            ],
            [
                'id' => 14,
                'name' => 'Asignación de cable de red'
            ],
            [
                'id' => 15,
                'name' => 'Asignación de cable hdmi'
            ],
            [
                'id' => 16,
                'name' => 'Asignación de monitor'
            ],
            [
                'id' => 17,
                'name' => 'Asignación de notebook'
            ],
            [
                'id' => 18,
                'name' => 'Asignación de celular'
            ],
            [
                'id' => 19,
                'name' => 'Asignación de PC escritorio'
            ],
            [
                'id' => 20,
                'name' => 'Asignación de pendrive'
            ],
            [
                'id' => 21,
                'name' => 'Instalación de software'
            ],
            [
                'id' => 22,
                'name' => 'Instalación de impresora'
            ],
            [
                'id' => 23,
                'name' => 'Mantención de impresora'
            ],
            [
                'id' => 24,
                'name' => 'Solicitud de tóner'
            ],
            [
                'id' => 25,
                'name' => 'Soporte ofimático'
            ],
        ], ['id'], ['name']);
    }
}
