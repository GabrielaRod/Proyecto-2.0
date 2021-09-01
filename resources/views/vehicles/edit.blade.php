<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Editar Vehiculo Matrícula:
        </h2>
        <p class="text-sm text-red-600">{{ $vehicle->VIN }}</p>
    </x-slot>

    <div>
        <div class="max-w-4xl py-10 mx-auto sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('vehicles.update', $vehicle->id) }}">
                    @csrf
                    @method('put')
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="app_users" class="block text-sm font-medium text-gray-700">Cédulas</label>
                        <select name="app_user_id" id="app_user_id"
                            class="block w-full mt-1 rounded-md shadow-sm form-multiselect" multiple="multiple">
                            @foreach($app_users as $domid => $app_user)
                            <option value="{{ $domid }}"
                                {{ in_array($domid, old('app_users', $vehicle->app_users->pluck('DomId')->toArray())) ? ' selected' :'' }}>
                                {{ $app_user }}
                            </option>
                            @endforeach
                        </select>
                        @error('app_users')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="px-4 py-5 bg-white sm:p-6">
                        <label for="email" class="block text-sm font-medium text-gray-700">Cambiar Estatus</label>
                        <select name="Status" id="Status"
                            class="block w-full mt-1 rounded-md shadow-sm form-multiselect" multiple="multiple">
                            <option value="ACTIVE">ACTIVO</option>
                            <option value="INACTIVE">INACTIVO</option>
                        </select>
                        @error('Status')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex items-center justify-end px-4 py-3 text-right bg-gray-50 sm:px-6">
                        <div class="flex items-center justify-end px-4 py-3 text-right bg-gray-50 sm:px-6">
                            <a href="{{ route('vehicles.index') }}"
                                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25">Atrás</a>
                        </div>
                        <button
                            class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25">
                            Editar
                        </button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>
</x-app-layout>
