<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Tenant;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class TenantDatatable extends DataTableComponent
{
    protected $model = Tenant::class;
    protected $listeners = ['tenantUpdated' => '$refresh']; // Refrescar la tabla cuando se actualiza un tenant

    public ?int $searchFilterDebounce = 600;
    public array $perPageAccepted = [10, 20, 50, 100];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
        $this->setSingleSortingStatus(false);
    }

    public function columns(): array
    {
        return [
            Column::make("Nombre", "id")
                ->sortable()
                ->searchable(),
            // Columna para mostrar el primer dominio relacionado
            Column::make("Dominio")
                ->label(function ($row) {
                    // Accedemos a la relación domains y mostramos el primer dominio
                    return $row->domains->first()->domain ?? 'No tiene dominio';
                }),
            Column::make("Created at", "created_at")
                ->sortable()
                ->searchable(),
            Column::make("Acciones")
                ->label(
                    fn($row) => view('livewire.actions', ['row' => $row])
                )
        ];
    }
}
