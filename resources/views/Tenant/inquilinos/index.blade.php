<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Inquilinos
        </h2>
    </x-slot>

    <x-container class="py-12">


        <div class="relative overflow-x-auto">
            <br>
            <a href="{{ route('tenants.create') }}" class="btn btn-blue">
                Nuevo inquilino
            </a>
            <br>
            <br>
            <table class="min-w-full text-sm text-left text-gray-500 dark:text-gray-400 block md:table">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr class="block md:table-row">
                        <th scope="col" class="px-6 py-3 block md:table-cell">Id</th>
                        <th scope="col" class="px-6 py-3 block md:table-cell">Dominio</th>
                        <th scope="col" class="px-6 py-3 block md:table-cell text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tenants as $tenant)
                        <tr class="bg-white border-b text-gray-700 block md:table-row">
                            <th scope="row" class="px-6 py-4 block md:table-cell">
                                {{ $tenant->id }}
                            </th>
                            <td class="px-6 py-4 block md:table-cell">
                                {{ $tenant->domains->first()->domain ?? '' }}
                            </td>
                            <td class="px-6 py-4 block md:table-cell">
                                <div class="flex justify-end space-x-2">
                                    <form method="POST" action="{{ route('tenants.destroy', $tenant) }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="Delete" class="btn-red btn"/>
                                    </form>

                                    <a href="{{ route('tenants.edit', $tenant) }}" class="btn-blue btn">
                                        Editar
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-container>
</x-app-layout>
