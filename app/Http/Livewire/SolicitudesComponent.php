<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Solicitud;

class SolicitudesComponent extends Component
{


    public $id_solicitante;
    public $numeroIdentificacion;
    public $id_barrio;
    public $direccion;
    public $ubicacion;
    public $evidenciaPDF;

    public function mount()
    {
        if (!auth()->user()->can('versolicitudes')) {
            abort(403, 'No tienes acceso a esta página.');
        }
    }



    public function render()
    {
        $user = auth()->user();
        $solicitudes = Solicitud::where('id_solicitante', $user->id)->get();


        return view('livewire.solicitudes-component', [
            'solicitudes'=>$solicitudes,
        ])->layout('layouts.tenancy');
    }
}
