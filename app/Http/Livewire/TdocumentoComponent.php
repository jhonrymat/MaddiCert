<?php
namespace App\Http\Livewire;

use App\Models\Tdocumento;
use Livewire\Component;

class TdocumentoComponent extends Component
{
    public $documento_id;  // Cambiar $id a $documento_id
    public $tipoDocumento;
    public $showForm = false; // Control para mostrar/ocultar el formulario

    // Validación básica
    protected $rules = [
        'tipoDocumento' => 'required|string|max:255',
    ];

    protected $listeners = ['edit', 'delete'];

    public function save()
    {
        // Validamos los datos
        $this->validate();

        if ($this->documento_id) {
            // Si estamos editando un documento existente
            $documento = Tdocumento::find($this->documento_id);
            if ($documento) {
                $documento->update([
                    'tipoDocumento' => $this->tipoDocumento
                ]);
            }
        } else {
            // Si no hay documento_id, creamos un nuevo documento
            Tdocumento::create(['tipoDocumento' => $this->tipoDocumento]);
        }

        // Resetear el formulario y ocultarlo después de guardar
        $this->resetFields();
        $this->showForm = false;

        // Emitir el evento para refrescar la tabla
        $this->emit('Updated');
    }

    public function edit($documentoId)
    {
        $documento = Tdocumento::find($documentoId);

        if ($documento) {
            $this->documento_id = $documento->id;    // Mostrar el ID actual en el formulario
            $this->tipoDocumento = $documento->tipoDocumento;  // Cargar el campo tipoDocumento
            $this->showForm = true;                  // Mostrar el formulario al editar
        }
    }

    public function create()
    {
        $this->resetFields();
        $this->showForm = true; // Mostrar el formulario al crear
    }

    public function delete($documentoId)
    {
        $documento = Tdocumento::find($documentoId);
        if ($documento) {
            $documento->delete();
            $this->emit('Updated'); // Refrescar la tabla después de eliminar
        }
    }

    public function resetFields()
    {
        $this->documento_id = null;
        $this->tipoDocumento = null;  // Limpiar los campos del formulario
    }

    public function render()
    {
        return view('livewire.tdocumento-component')->layout('layouts.tenancy');
    }
}
