<?php

namespace App\Http\Livewire;

use App\Models\Solicitud;
use Illuminate\Support\Facades\Storage;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;

class SolicitudDatatable extends DataTableComponent
{
    protected $model = Solicitud::class;
    protected $listeners = ['Updated' => '$refresh']; // Refrescar la tabla cuando se actualiza un tenant

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
            Column::make("Id", "id")
                ->sortable()
                ->searchable(),
            Column::make("Fecha de Solicitud", "fechaSolicitud")
                ->sortable()
                ->searchable(),
            Column::make("Número de Identificación", "numeroIdentificacion_id")
                ->sortable()
                ->searchable(),
            Column::make("Fecha Actual", "fechaActual")
                ->sortable()
                ->searchable(),
            Column::make("Barrio", "barrio.nombreBarrio")
                ->sortable()
                ->searchable(), // Relacionado con la tabla de barrios
            Column::make("Dirección", "direccion.direccionCompleta")
                ->sortable()
                ->searchable(), // Relacionado con la tabla de direcciones
            Column::make("Ubicación", "ubicacion")
                ->sortable()
                ->searchable(),
            Column::make("Evidencia PDF", "evidenciaPDF")
                ->label(
                    fn($row) => $row->evidenciaPDF
                    ? '<a href="' . Storage::url($row->evidenciaPDF) . '" target="_blank" class="text-blue-500">Ver archivo</a>'
                    : 'No disponible'
                )
                ->html(),
            Column::make("Created at", "created_at")
                ->sortable()
                ->searchable(),
            Column::make("Acciones")
                ->label(
                    fn($row) => view('livewire.acciones', ['row' => $row])
                )
        ];
    }
}
