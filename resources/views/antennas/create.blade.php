<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Agregar Antena
        </h2>
    </x-slot>
    {{-- COORDINATE ID --}}
    <div class="px-4 py-1 bg-white sm:p-6">
        <label for="coordinates" class="block text-sm font-medium text-gray-700">ID Dirección</label>
        <select name="coordinate_id[]" id="coordinate_id"
            class="block w-full mt-1 rounded-md shadow-sm form-multiselect" multiple="multiple">
            @foreach($coordinates as $id => $coordinate)
            <option value="{{ $id }}" {{ in_array($id, old('coordinate_id', [])) ? ' selected' : '' }}>{{ $coordinate }}
            </option>
            {{-- STATUS --}}
            <div class="px-4 py-5 bg-white sm:p-6">
                <label for="Status" class="block text-sm font-bold text-gray-700">Estatus</label>
                <select name="Status" id="Status" class="block w-full mt-1 rounded-md shadow-sm form-multiselect"
                    multiple="multiple">
                    <option value="ACTIVE">ACTIVA</option>
                    <option value="INACTIVE">INACTIVA</option>
                </select>
                @error('Status')
                <p class="text-sm text-red-600">{{ $message }}</p>
                <div class="flex items-center justify-end px-4 py-3 text-right bg-gray-50 sm:px-6">
                    <div class="flex items-center justify-end px-4 py-3 text-right bg-gray-50 sm:px-6">
                        <a href="{{ route('antennas.index') }}"
                            class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25">Atrás</a>
                    </div>
                    <button
                        class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25">
                        Agregar
                    </button>
                </div>
            </div>
