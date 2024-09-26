<div class="flex space-x-2">
    <button wire:click="$emit('edit', '{{ $row->id }}')" class="px-4 py-2 bg-blue-500 text-white rounded">
        Editar
    </button>

    <button wire:click="$emit('delete', '{{ $row->id }}')" class="px-4 py-2 bg-red-500 text-white rounded">
        Eliminar
    </button>
</div>
