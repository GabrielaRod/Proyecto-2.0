<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Antenna
        </h2>
    </x-slot>

    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('antennas.store') }}">
                    @csrf
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="MacAddress" class="block font-bold text-sm text-gray-700">Mac Address</label>
                            <input type="text" name="MacAddress" id="MacAddress" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('MacAddress', '') }}" />
                            @error('MacAddress')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <label for="Location" class="block font-bold text-sm text-gray-700">Location</label>
                            <input type="text" name="Location" id="Location" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('Location', '') }}" />
                            @error('Location')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <label for="Status" class="block font-bold text-sm text-gray-700">Status</label>
                            <input type="text" name="Status" id="Status" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('Status', '') }}" />
                            @error('Status')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <label for="coordinate_id" class="block font-bold text-sm text-gray-700">Coordinate Id</label>
                            <input type="text" name="coordinate_id" id="coordinate_id" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('coordinate_id', '') }}" />
                            @error('coordinate_id')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Create
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>