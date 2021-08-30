<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Location:
        </h2>
        <p class="text-sm text-red-600">{{ $coordinate->Location }}</p>
    </x-slot>

    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('coordinates.update', $coordinate->id) }}">
                    @csrf
                    @method('put')
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="Location" class="block font-medium text-sm text-gray-700">Location</label>
                            <input type="text" name="Location" id="Location" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('Location', $coordinate->Location) }}" />
                            @error('name')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="Latitude" class="block font-medium text-sm text-gray-700">Latitude</label>
                            <input type="number" name="Latitude" id="Latitude" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('Latitude', $coordinate->Latitude) }}" readonly="true"/>
                            @error('Latitude')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="Longitude" class="block font-medium text-sm text-gray-700">Longitude</label>
                            <input type="number" name="Longitude" id="Longitude" class="form-input rounded-md shadow-sm mt-1 block w-full" 
                                value="{{ old('Longitude', $coordinate->Longitude) }}" readonly="true"/>
                            @error('Longitude')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <a href="{{ route('coordinates.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">Back to list</a>
                                </div>
                            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Edit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>