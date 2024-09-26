<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TenantNavigationMenu extends Component
{
    public function render()
    {
        return view('livewire.tenant-navigation-menu')->layout('layouts.tenancy');
    }
}
