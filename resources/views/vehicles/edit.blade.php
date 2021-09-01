<x-app-layout>
    <x-slot name="header">   
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
<<<<<<< Updated upstream
            Editar Vehicle Matrícula:
=======
            Editar Vehiculo Matrícula:
>>>>>>> Stashed changes
        </h2>
        <p class="text-sm text-red-600">{{ $vehicle->VIN }}</p>
    </x-slot>

    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('vehicles.update', $vehicle->id) }}">
                    @csrf
                    @method('put')
                    <div class="px-4 py-5 bg-white sm:p-6">
<<<<<<< Updated upstream
                        <label for="app_users" class="block font-medium text-sm text-gray-700">Cédulas</label>
=======
                        <label for="app_users" class="block font-medium text-sm text-gray-700">Usuarios</label>
>>>>>>> Stashed changes
                        <select name="app_user_id" id="app_user_id" class="form-multiselect block rounded-md shadow-sm mt-1 block w-full" multiple="multiple">
                            @foreach($app_users as $domid => $app_user)
                                <option value="{{ $domid }}"{{ in_array($domid, old('app_users', $vehicle->app_users->pluck('DomId')->toArray())) ? ' selected' :'' }}>
                                    {{ $app_user }}
                                </option>
                            @endforeach
                        </select>
                        @error('app_users')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>                   

                        <div class="px-4 py-5 bg-white sm:p-6">
<<<<<<< Updated upstream
                            <label for="email" class="block font-medium text-sm text-gray-700">Cambiar Estatus</label>
=======
                            <label for="email" class="block font-medium text-sm text-gray-700">Cambio de Estatus</label>
>>>>>>> Stashed changes
                            <select name="Status" id="Status" class="form-multiselect block rounded-md shadow-sm mt-1 block w-full" multiple="multiple">
                                <option value="ACTIVE">ACTIVO</option>
                                <option value="INACTIVE">INACTIVO</option>
                        </select>
                        @error('Status')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        </div>
                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <a href="{{ route('vehicles.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">Atrás</a>
                                </div>
                            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Editar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>