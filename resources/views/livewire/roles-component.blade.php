<div class="p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold mb-6">Gestión de Roles</h1>

    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-3 rounded mb-6">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="createRole" class="mb-6">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-center">
            <!-- Nombre del Rol -->
            <div class="col-span-1">
                <input type="text" wire:model="name" placeholder="Nombre del rol"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>

            <!-- Selección de Permisos -->
            <div class="col-span-1">
                <select wire:model="permissions" multiple
                    class="w-full h-24 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @foreach ($permissions as $permission)
                        <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Botón Crear -->
            <div class="col-span-1 flex justify-end">
                <button type="submit"
                    class="inline-flex items-center px-6 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-wider hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-300 transition duration-150 ease-in-out">
                    Crear Rol
                </button>
            </div>
        </div>
    </form>

    <!-- Lista de Roles -->
    <h2 class="text-xl font-semibold mb-4">Lista de Roles</h2>
    <ul class="bg-gray-50 rounded-lg shadow-sm p-4 divide-y divide-gray-200">
        @foreach ($roles as $role)
            <li class="flex justify-between items-center py-3">
                <span class="text-gray-700 font-medium">{{ $role->name }}</span>
                <div class="flex gap-4">
                    <button wire:click="editRole({{ $role->id }})" class="text-yellow-500 hover:text-yellow-600">
                        Editar
                    </button>
                    <button wire:click="deleteRole({{ $role->id }})" class="text-red-500 hover:text-red-600">
                        Eliminar
                    </button>
                </div>
            </li>
        @endforeach
    </ul>
</div>
