<?php

namespace App\Http\Livewire;

use App\Models\Tenant;
use Livewire\Component;

class TenantComponent extends Component
{
    public $tenant_id;
    public $original_id; // Guardar el ID original durante la edición
    public $showForm = false; // Control para mostrar/ocultar el formulario

    // Validación básica del campo `tenant_id`
    protected $rules = [
        'tenant_id' => 'required|string|max:255',
    ];

    protected $listeners = ['editTenant', 'deleteTenant'];

    public function save()
    {
        // Validamos los datos
        $this->validate();

        if ($this->original_id) {
            // Si estamos editando un tenant existente
            $tenant = Tenant::find($this->original_id);
            if ($tenant) {
                // Actualizamos el ID solo si es diferente al original
                if ($this->tenant_id !== $this->original_id) {
                    $tenant->update(['id' => $this->tenant_id]);
                    $tenant->domains()->update(['domain' => $this->tenant_id . '.' . env('DOMINIO', 'fortitenant.test')]);
                }
            }
        } else {
            // Si no hay original_id, creamos un nuevo tenant
            $tenant = Tenant::create(['id' => $this->tenant_id]);
            $tenant->domains()->create(['domain' => $this->tenant_id . '.' . env('DOMINIO', 'fortitenant.test')]);
        }

        // Resetear el formulario y ocultarlo después de guardar
        $this->resetFields();
        $this->showForm = false;

        // Emitir el evento para refrescar la tabla
        $this->emit('tenantUpdated');
    }

    public function editTenant($tenantId)
    {
        $tenant = Tenant::find($tenantId);

        if ($tenant) {
            $this->tenant_id = $tenant->id;    // Mostrar el ID actual en el formulario
            $this->original_id = $tenant->id;  // Guardamos el ID original
            $this->showForm = true;            // Mostrar el formulario al editar
        }
    }

    public function createTenant()
    {
        $this->resetFields();
        $this->showForm = true; // Mostrar el formulario al crear
    }

    public function deleteTenant($tenantId)
    {
        $tenant = Tenant::find($tenantId);
        $tenant->delete();
        $this->emit('tenantUpdated'); // Refrescar la tabla después de eliminar
    }

    public function resetFields()
    {
        $this->tenant_id = null;
        $this->original_id = null;  // Reiniciamos el ID original
    }

    public function render()
    {
        return view('livewire.tenant-component');
    }
}
