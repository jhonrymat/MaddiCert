<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesComponent extends Component
{
    public $name;
    public $role_id;
    public $permissions = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'permissions' => 'required|array',
    ];

    public function createRole()
    {
        $this->validate();

        $role = Role::create(['name' => $this->name]);

        $role->syncPermissions($this->permissions);

        session()->flash('message', 'Role creado exitosamente.');
        $this->resetFields();
    }

    public function editRole($id)
    {
        $role = Role::findOrFail($id);
        $this->role_id = $role->id;
        $this->name = $role->name;
        $this->permissions = $role->permissions->pluck('name')->toArray();
    }

    public function updateRole()
    {
        $this->validate();

        $role = Role::findOrFail($this->role_id);
        $role->name = $this->name;
        $role->syncPermissions($this->permissions);
        $role->save();

        session()->flash('message', 'Role actualizado exitosamente.');
        $this->resetFields();
    }

    public function deleteRole($id)
    {
        Role::findOrFail($id)->delete();
        session()->flash('message', 'Role eliminado exitosamente.');
    }

    public function resetFields()
    {
        $this->name = '';
        $this->permissions = [];
        $this->role_id = null;
    }

    public function render()
    {
        return view('livewire.roles-component', [
            'roles' => Role::all(),
            'permissions' => Permission::all(),
        ])->layout('layouts.tenancy');
    }
}
