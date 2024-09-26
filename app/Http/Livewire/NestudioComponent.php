<?php
namespace App\Http\Livewire;

use App\Models\Nestudio;
use Livewire\Component;

class NestudioComponent extends Component
{
    public $estudio_id;  // Cambiar $id a $estudio_id para evitar conflictos
    public $nivelEstudio;
    public $showForm = false; // Control para mostrar/ocultar el formulario

    // Validación básica
    protected $rules = [
        'nivelEstudio' => 'required|string|max:255',
    ];

    protected $listeners = ['edit', 'delete'];

    public function save()
    {
        // Validamos los datos
        $this->validate();

        if ($this->estudio_id) {
            // Si estamos editando un nivel de estudio existente
            $estudio = Nestudio::find($this->estudio_id);
            if ($estudio) {
                $estudio->update([
                    'nivelEstudio' => $this->nivelEstudio
                ]);
            }
        } else {
            // Si no hay estudio_id, creamos un nuevo nivel de estudio
            Nestudio::create(['nivelEstudio' => $this->nivelEstudio]);
        }

        // Resetear el formulario y ocultarlo después de guardar
        $this->resetFields();
        $this->showForm = false;

        // Emitir el evento para refrescar la tabla
        $this->emit('Updated');
    }

    public function edit($estudioId)
    {
        $estudio = Nestudio::find($estudioId);

        if ($estudio) {
            $this->estudio_id = $estudio->id;    // Mostrar el ID actual en el formulario
            $this->nivelEstudio = $estudio->nivelEstudio;  // Cargar el campo nivelEstudio
            $this->showForm = true;              // Mostrar el formulario al editar
        }
    }

    public function create()
    {
        $this->resetFields();
        $this->showForm = true; // Mostrar el formulario al crear
    }

    public function delete($estudioId)
    {
        $estudio = Nestudio::find($estudioId);
        if ($estudio) {
            $estudio->delete();
            $this->emit('Updated'); // Refrescar la tabla después de eliminar
        }
    }

    public function resetFields()
    {
        $this->estudio_id = null;
        $this->nivelEstudio = null;  // Limpiar los campos del formulario
    }

    public function render()
    {
        return view('livewire.Nestudio-component')->layout('layouts.tenancy');
    }
}
