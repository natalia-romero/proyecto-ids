<?php

namespace Database\Seeders;
use App\Models\SLA;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SLA::upsert([
            [
                'id' => 1,
                'name' => 'Abierto'
            ],
            [
                'id' => 2,
                'name' => 'En curso'
            ],
            [
                'id' => 3,
                'name' => 'Cerrado'
            ]
        ], ['id'], ['name']);
    }
}
