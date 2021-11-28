<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de Vehiculos
        </h2>
    </x-slot>

    <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 w-full">
                                <thead>
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 bg-gray-50 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">
                                            Id
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 bg-gray-50 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">
                                            Placa
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 bg-gray-50 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">
                                            Matrícula
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 bg-gray-50 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">
                                            Marca
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 bg-gray-50 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">
                                            Modelo
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 bg-gray-50 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">
                                            Opciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($vehicles as $vehicle)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                                                {{ $vehicle->id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                                                <span
                                                    class="px-2 inline-flex text-s leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                    {{ $vehicle->LicensePlate }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                                                <span
                                                    class="px-2 inline-flex text-s leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                    {{ $vehicle->VIN }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                                                {{ $vehicle->Make }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                                                {{ $vehicle->Model }}
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-sm text-center font-medium">
                                                <a href="{{ route('vehicles.show', $vehicle->id) }}"
                                                    class="text-blue-600 hover:text-blue-900 mb-2 mr-2">Ver</a>
                                                <a href="{{ route('vehicles.edit', $vehicle->id) }}"
                                                    class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">Editar</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
