<?php

namespace Database\Factories;

use App\Models\Pacientes;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PacientesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pacientes::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre'=>$this->faker->name(),
            'fecha_nacimiento'=> $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'genero'=>Str::random(1),
            'escolaridad'=>'Sin Estudios',
            'enfermedad'=>'Alzhaimer',
            'enfermedades'=>' ',
            'id_doctor'=> 1,
        ];
    }
}
