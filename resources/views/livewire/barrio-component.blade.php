<div>
    <div class="w-3/4 mx-auto py-6">
        <!-- Botón para crear un nuevo barrio -->
        <button wire:click="create" class="mb-4 px-4 py-2 bg-green-500 text-white rounded">
            Nuevo Barrio
        </button>

        <!-- Componente de tabla -->
        @livewire('barrio-datatable')
    </div>

    <!-- Modal con Alpine.js -->
    <div x-data="{ showModal: @entangle('showForm') }">
        <!-- Overlay para el modal -->
        <div x-show="showModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" style="display: none;">
            <div class="relative top-20 mx-auto p-5 border w-1/2 shadow-lg rounded-md bg-white">
                <!-- Formulario dentro del modal -->
                <form wire:submit.prevent="save">
                    <div class="mb-4">
                        <label for="nombreBarrio" class="block text-sm font-medium">Nombre del Barrio</label>
                        <input type="text" wire:model="nombreBarrio" id="nombreBarrio" class="mt-1 block w-full" required>
                        @error('nombreBarrio') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="unidad" class="block text-sm font-medium">Unidad (UPZ o UPR)</label>
                        <select wire:model="unidad" id="unidad" class="mt-1 block w-full" required>
                            <option value="" selected>Selecciona una unidad</option>
                            <option value="UPZ">UPZ</option>
                            <option value="UPR">UPR</option>
                        </select>
                        @error('unidad') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="numero" class="block text-sm font-medium">Numero</label>
                        <select wire:model="numero" id="numero" class="mt-1 block w-full" required>
                            <option value="" selected>Selecciona una numero</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="2">3</option>
                            <option value="2">4</option>
                            <option value="2">5</option>
                            <option value="2">6</option>
                        </select>
                        @error('numero') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="tipo" class="block text-sm font-medium">Tipo (Barrio, Vereda, etc.)</label>
                        <select wire:model="tipo" id="tipo" class="mt-1 block w-full" required>
                            <option value="" selected>Selecciona un tipo</option>
                            <option value="Barrio">Barrio</option>
                            <option value="Vereda">Vereda</option>
                            <!-- Agregar más opciones según lo que necesites -->
                        </select>
                        @error('tipo') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end space-x-2">
                        <!-- Botón para cerrar el modal -->
                        <button type="button" @click="showModal = false" class="px-4 py-2 bg-gray-500 text-white rounded">
                            Cancelar
                        </button>
                        <!-- Botón para guardar el formulario -->
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">
                            @if ($barrio_id) Actualizar @else Crear @endif
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
