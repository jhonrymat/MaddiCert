<?php

namespace App\Http\Livewire;

use App\Models\Barrio;
use Livewire\Component;

class BarrioComponent extends Component
{
    public $barrio_id;  // ID para evitar conflictos con Livewire
    public $nombreBarrio;
    public $unidad;  // UPZ o UPR
    public $numero;  // numero
    public $tipo;  // Tipo: Barrio, Vereda, etc.
    public $showForm = false; // Control para mostrar/ocultar el formulario
    public function mount()
    {
        if (!auth()->user()->can('solicitudes')) {
            abort(403, 'No tienes acceso a esta página.');
        }
    }
    // Validación básica
    protected $rules = [
        'nombreBarrio' => 'required|string|max:255',
        'unidad' => 'required|string|max:50',  // Puede ser UPZ o UPR
        'numero' => 'required|string|max:50',  // Tipo de área (Barrio, Vereda, etc.)
        'tipo' => 'required|string|max:50',  // Tipo de área (Barrio, Vereda, etc.)
    ];

    protected $listeners = ['edit', 'delete'];

    public function save()
    {
        // Validamos los datos
        $this->validate();

        if ($this->barrio_id) {
            // Si estamos editando un barrio existente
            $barrio = Barrio::find($this->barrio_id);
            if ($barrio) {
                $barrio->update([
                    'nombreBarrio' => $this->nombreBarrio,
                    'unidad' => $this->unidad,
                    'numero' => $this->numero,
                    'tipo' => $this->tipo
                ]);
            }
        } else {
            // Si no hay barrio_id, creamos un nuevo barrio
            Barrio::create([
                'nombreBarrio' => $this->nombreBarrio,
                'unidad' => $this->unidad,
                'numero' => $this->numero,
                'tipo' => $this->tipo
            ]);
        }

        // Resetear el formulario y ocultarlo después de guardar
        $this->resetFields();
        $this->showForm = false;

        // Emitir el evento para refrescar la tabla
        $this->emit('Updated');
    }

    public function edit($barrioId)
    {
        $barrio = Barrio::find($barrioId);

        if ($barrio) {
            $this->barrio_id = $barrio->id;  // Mostrar el ID actual en el formulario
            $this->nombreBarrio = $barrio->nombreBarrio;
            $this->unidad = $barrio->unidad;
            $this->numero = $barrio->numero;
            $this->tipo = $barrio->tipo;
            $this->showForm = true;  // Mostrar el formulario al editar
        }
    }

    public function create()
    {
        $this->resetFields();
        $this->showForm = true; // Mostrar el formulario al crear
    }

    public function delete($barrioId)
    {
        $barrio = Barrio::find($barrioId);
        if ($barrio) {
            $barrio->delete();
            $this->emit('Updated'); // Refrescar la tabla después de eliminar
        }
    }

    public function resetFields()
    {
        $this->barrio_id = null;
        $this->nombreBarrio = null;
        $this->unidad = null;
        $this->numero = null;
        $this->tipo = null;
    }

    public function render()
    {
        return view('livewire.barrio-component')->layout('layouts.tenancy');
    }
}
