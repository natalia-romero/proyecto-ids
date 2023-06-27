<?php

namespace Database\Seeders;
use App\Models\SLA;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SLASeeder extends Seeder
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
                'name' => 'Normal'
            ],
            [
                'id' => 2,
                'name' => 'Medio'
            ],
            [
                'id' => 3,
                'name' => 'Urgente'
            ],
        ], ['id'], ['name']);
    }
}
