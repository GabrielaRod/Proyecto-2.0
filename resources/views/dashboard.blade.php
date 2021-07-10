<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mapa
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="maptrack" id="app">
                    <gmap-map
                    :center="mapCenter"
                    :zoom="9"
                    style="width: 100%; height: 550px;"
                    >
                        <gmap-marker
                            v-for="(c, index) in coordinates"           {{-- For loop that retrieves the Coordinates from the coordinates array. --}}
                            :key="c.id"                                       {{-- Specifies de index as the id of the Coordinate --}}
                            :position="getPosition(c)"
                            :draggable="false"
                        ></gmap-marker>
                        <gmap-marker
                            v-for="(a, index) in coordinates_assets"           {{-- For loop that creates a marker for each item in Coordinates array. --}}
                            :key="a.id"                                       {{-- Specifies de index as the id of the Coordinate --}}
                            :position="setPosition(a)"
                            :draggable="false"
                        ></gmap-marker>
                    </gmap-map>
                </div>
            </div>
        </div>        
    </div>
</x-app-layout>
