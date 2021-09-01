<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Agregar Antena
        </h2>
    </x-slot>
                            {{-- COORDINATE ID --}}
                            <div class="px-4 py-1 bg-white sm:p-6">
                                <label for="coordinates" class="block font-medium text-sm text-gray-700">ID Dirección</label>
                                <select name="coordinate_id[]" id="coordinate_id" class="form-multiselect block rounded-md shadow-sm mt-1 block w-full" multiple="multiple">
                                    @foreach($coordinates as $id => $coordinate)
                                        <option value="{{ $id }}"{{ in_array($id, old('coordinate_id', [])) ? ' selected' : '' }}>{{ $coordinate }}</option>
                            {{-- STATUS --}}
                            <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="Status" class="block font-bold text-sm text-gray-700">Estatus</label>
                            <select name="Status" id="Status" class="form-multiselect block rounded-md shadow-sm mt-1 block w-full" multiple="multiple">
                                    <option value="ACTIVE">ACTIVA</option>
                                    <option value="INACTIVE">INACTIVA</option>
                            </select>
                            @error('Status')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <a href="{{ route('antennas.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">Atrás</a>
                                </div>
<<<<<<< Updated upstream
                            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
=======
                            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">                            
>>>>>>> Stashed changes
                                Agregar
                            </button>
                        </div>
                    </div>