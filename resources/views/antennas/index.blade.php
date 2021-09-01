<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Lista de Antenas
        </h2>
    </x-slot>

    <div>
        <div class="max-w-6xl py-10 mx-auto sm:px-6 lg:px-8">
            <div class="block mb-8">
                <a href="{{ route('antennas.create') }}"
                    class="px-4 py-2 text-xs font-bold tracking-widest text-white uppercase bg-green-500 border border-transparent rounded-md hover:bg-green-300 hover:bg-green-700 active:bg-green-300 focus:outline-none focus:border-green-900">Agregar
                    Antenna</a>
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                            <table class="w-full min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-bold tracking-wider text-center text-gray-500 uppercase bg-gray-50">
                                            Dirección
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-bold tracking-wider text-center text-gray-500 uppercase bg-gray-50">
                                            Estatus
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-bold tracking-wider text-center text-gray-500 uppercase bg-gray-50">
                                            Opciones
                                        </th>

                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($antennas as $antenna)
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-center text-gray-900 whitespace-nowrap">
                                            @foreach ($antenna->coordinates as $coordinate)
                                            <span
                                                class="inline-flex px-2 font-semibold leading-5 text-blue-800 bg-blue-100 rounded-full text-s">
                                                {{ $coordinate->Location }}
                                        </td>
                                        </span>
                                        @endforeach
                                        </td>
                                        <td class="px-6 py-4 text-sm text-center text-gray-900 whitespace-nowrap">
                                            <span
                                                class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                                {{ $antenna->Status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-3 text-sm font-medium text-center whitespace-nowrap">
                                            <a href="{{ route('antennas.show', $antenna->id) }}"
                                                class="mb-2 mr-2 text-blue-600 hover:text-blue-900">Ver</a>
                                            <a href="{{ route('antennas.edit', $antenna->id) }}"
                                                class="mb-2 mr-2 text-indigo-600 hover:text-indigo-900">Editar</a>
                                            <form class="inline-block"
                                                action="{{ route('antennas.destroy', $antenna->id) }}" method="POST"
                                                onsubmit="return confirm('Estás seguro?');">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="mb-2 mr-2 text-red-600 hover:text-red-900"
                                                    value="Delete">
                                            </form>
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
