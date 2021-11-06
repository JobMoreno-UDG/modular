<?php

namespace Database\Factories;

use App\Models\Pacientes;
use App\Models\ProcesosCognitivos;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProcesosCognitivosFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProcesosCognitivos::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_paciente'=>Pacientes::factory(),
            'orientacion'=>3,
            'atencion_concentracion'=>2,
            'memoria'=>2,
            'funciones_ejecutivas'=>1,
            'lenguaje'=>2,
            'percepcion'=>4,
        ];
    }
}
