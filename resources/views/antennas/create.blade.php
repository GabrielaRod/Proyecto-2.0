<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Agregar Antena
        </h2>
    </x-slot>

    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('antennas.store') }}">
                    @csrf
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            {{-- MAC ADDRESS --}}
                            <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="MacAddress" class="block font-bold text-sm text-gray-700">Mac Address</label>
                            <input type="text" name="MacAddress" id="MacAddress" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('MacAddress', '') }}" />
                            @error('MacAddress')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            </div>

                            {{-- COORDINATE ID --}}
                            <div class="px-4 py-1 bg-white sm:p-6">
                                <label for="coordinates" class="block font-medium text-sm text-gray-700">ID Dirección</label>
                                <select name="coordinate_id[]" id="coordinate_id" class="form-multiselect block rounded-md shadow-sm mt-1 block w-full" multiple="multiple">
                                    @foreach($coordinates as $id => $coordinate)
                                        <option value="{{ $id }}"{{ in_array($id, old('coordinate_id', [])) ? ' selected' : '' }}>{{ $coordinate }}</option>
                                    @endforeach
                                </select>
                                @error('coordinate_id')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>              
                            
                            {{-- STATUS --}}
                            <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="Status" class="block font-bold text-sm text-gray-700">Estatus</label>
                            <select name="Status" id="Status" class="form-multiselect block rounded-md shadow-sm mt-1 block w-full" multiple="multiple">
                                    <option value="ACTIVE">ACTIVA</option>
                                    <option value="INACTIVE">INACTIVA</option>
                            </select>
                            @error('Status')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            </div>                            
                        </div>

                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <a href="{{ route('antennas.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">Atrás</a>
                                </div>
                            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Agregar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>