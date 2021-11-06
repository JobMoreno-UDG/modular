<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Actividad;

class Filter extends Component
{
    use WithPAgination;
    public $searchTerm;

    public function render()
    {
        return view('Actividades.index',[
            'actividad' => Actividad::where('id_doctor','=',$searchTerm)->paginate(5)
        ]);
    }
}
