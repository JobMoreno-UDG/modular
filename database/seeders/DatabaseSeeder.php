<?php

namespace Database\Seeders;
use \App\Models\Pacientes;
use \App\Models\ProcesosCognitivos;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(2)->create();
        ProcesosCognitivos::factory(200)->create();
    }
}
