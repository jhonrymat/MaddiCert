<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Inquilinos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{route('tenants.store')}}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <input-label>
                           Nombre
                        </input-label>
                        <x-text-input name="id" type="text" value="{{ old('id') }}" class="w-full mt-2" placeholder="Ingrese el nombre"/>
                        {{--Mostrar mensajes de error con input-error --}}
                        <x-input-error :messages="$errors->first('id')"/>
                    </div>
                    <div class="flex justify-end">
                        <button class="btn btn-blue">
                            Guardar
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
