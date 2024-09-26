<div>
    <div class="w-3/4 mx-auto py-6">
        <!-- Botón para crear una nueva solicitud -->
        <button wire:click="create" class="mb-4 px-4 py-2 bg-green-500 text-white rounded">Nueva Solicitud</button>

        <!-- Tabla de solicitudes -->
        @livewire('solicitud-datatable')
    </div>

    <!-- Modal de Solicitud -->
    <div x-data="{ showModal: @entangle('showForm') }">
        <div x-show="showModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full"
            style="display: none;">
            <div class="relative top-20 mx-auto p-5 border w-1/2 shadow-lg rounded-md bg-white">
                <form wire:submit.prevent="save">
                    <div class="mb-4">
                        <label for="fechaSolicitud" class="block text-sm font-medium">Fecha de Solicitud</label>
                        <input type="date" wire:model="fechaSolicitud" id="fechaSolicitud" class="mt-1 block w-full"
                            required>
                        @error('fechaSolicitud')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="numeroIdentificacion_id" class="block text-sm font-medium">Número de
                            Identificación</label>
                        <input type="text" wire:model="numeroIdentificacion_id" id="numeroIdentificacion_id"
                            class="mt-1 block w-full" required>
                        @error('numeroIdentificacion_id')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="fechaActual" class="block text-sm font-medium">Fecha Actual</label>
                        <input type="date" wire:model="fechaActual" id="fechaActual" class="mt-1 block w-full"
                            required>
                        @error('fechaActual')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="barrio_id" class="block text-sm font-medium">Barrio</label>
                        <select wire:model="barrio_id" id="barrio_id" class="form-select w-full" required>
                            <option value="">Selecciona un barrio</option>
                            @foreach ($barrios as $barrio)
                                <option value="{{ $barrio->id }}">{{ $barrio->nombreBarrio }}</option>
                            @endforeach
                        </select>
                        @error('barrio_id')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="direccion_id" class="block text-sm font-medium">Dirección</label>
                        <select wire:model="direccion_id" id="direccion_id" class="form-select w-full" required>
                            <option value="">Selecciona una dirección</option>
                            @foreach ($direcciones as $direccion)
                                <option value="{{ $direccion->id }}">
                                    {{ $direccion->tipoViaPrimaria }} {{ $direccion->numeroViaPrincipal }}
                                    {{ $direccion->letraViaPrincipal }}
                                    {{ $direccion->bis }} {{ $direccion->letraBis }}
                                    {{ $direccion->cuadranteViaPrincipal }}
                                    No. {{ $direccion->numeroViaGeneradora }} {{ $direccion->letraViaGeneradora }} -
                                    {{ $direccion->numeroPlaca }} {{ $direccion->cuadranteViaGeneradora }}
                                </option>
                            @endforeach
                        </select>
                        @error('direccion_id')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="ubicacion" class="block text-sm font-medium">Ubicación</label>
                        <input type="text" wire:model="ubicacion" id="ubicacion" class="mt-1 block w-full" required>
                        @error('ubicacion')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="evidenciaPDF" class="block text-sm font-medium">Evidencia PDF</label>
                        <input type="file" wire:model="evidenciaPDF" id="evidenciaPDF" class="mt-1 block w-full">
                        @if ($existingPDF)
                            <a href="{{ Storage::url($existingPDF) }}" class="text-blue-500">Ver archivo actual</a>
                        @endif
                        @error('evidenciaPDF')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-2">
                        <!-- Botón para cerrar el modal -->
                        <button type="button" @click="showModal = false"
                            class="px-4 py-2 bg-gray-500 text-white rounded">Cerrar</button>
                        <!-- Botón para guardar el formulario -->
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
