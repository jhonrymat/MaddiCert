
<div>
    <div class="w-3/4 mx-auto py-6">
        

        <!-- Componente de tabla -->
        @livewire('tenant-datatable')
    </div>

    <!-- Modal con Alpine.js -->
    <div x-data="{ showModal: @entangle('showForm') }">
        <!-- Overlay para el modal -->
        <div x-show="showModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" style="display: none;">
            <div class="relative top-20 mx-auto p-5 border w-1/2 shadow-lg rounded-md bg-white">
                <!-- Formulario dentro del modal -->
                <form wire:submit.prevent="save">
                    <div class="mb-4">
                        <label for="tenant_id" class="block text-sm font-medium">ID del Tenant</label>
                        <input type="text" wire:model="tenant_id" id="tenant_id" class="mt-1 block w-full" required>
                        @error('tenant_id') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                   
                </form>
            </div>
        </div>
    </div>
</div>
