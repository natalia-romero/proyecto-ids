<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::upsert([
            [
                'id' => 1,
                'name' => 'Coordinador'
            ],
            [
                'id' => 2,
                'name' => 'Soporte'
            ],
        ],['id'],['name']);
    }
}
