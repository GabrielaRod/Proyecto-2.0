<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Live Feed
        </h2>
    </x-slot>
    <div>
        <example-component></example-component>
        <div class="py-10 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                            <livedata-component></livedata-component>
                            {{-- <livedata-component></livedata-component> --}}
                            {{-- <table class="w-full min-w-full divide-y divide-gray-200">
                                <thead>
                                <tr>
                                    <th scope="col" width="50" class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase bg-gray-50">
                                        ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase bg-gray-50">
                                        Mac Address
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase bg-gray-50">
                                        Location
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($data as $d)
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-center text-gray-900 whitespace-nowrap">
                                            {{ $d->id }}
                            </td>
                            <td class="px-6 py-4 text-sm text-center text-gray-900 whitespace-nowrap">
                                {{ $d->data[109] . $d->data[110] . $d->data[111] . $d->data[112] . $d->data[113] . $d->data[114] . $d->data[115] . $d->data[116] .$d->data[117] . $d->data[118] . $d->data[119] . $d->data[120] . $d->data[121] . $d->data[122] . $d->data[123] . $d->data[124] . $d->data[125]}}
                            </td>
                            <td class="px-6 py-4 text-sm text-center text-gray-900 whitespace-nowrap">
                                {{ $d->location }}
                            </td>
                            </tr>
                            @endforeach
                            </tbody>
                            </table> --}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
