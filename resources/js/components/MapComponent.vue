<template>
    <div class="maptrack">
        <gmap-map
            :center="mapCenter"
            :zoom="13"
            style="width: 100%; height: 550px;"
        >
            <gmap-marker
                v-for="c in coordinates"
                :key="c.id"
                :position="getPosition(c)"
                :draggable="false"
            ></gmap-marker>
            <gmap-marker
                v-for="a in coordinates_assets"
                :key="a.id"
                :position="setPosition(a)"
                :draggable="false"
            ></gmap-marker>
        </gmap-map>
    </div>
</template>

<script>
export default {
    data() {
        //Hold Data as an Array of [Latitude, Longitud]
        return {
            coordinates: [],
            infoWindowOptions: {
                width: 0,
                height: -35
            },
            activeAntenna: {},
            infoWindowOpened: false,
            infoContent: "",
            infoWinOpen: false,
            currentMidx: null,
            //optional: offset infowindow so it visually sits nicely on top of our marker
            infoOptions: {
                pixelOffset: {
                    width: 0,
                    height: -35
                }
            }
        };
    },
    assetscoordinates() {
        //Hold Data as an Array of [Latitude, Longitud]
        return {
            coordinates_assets: []
        };
    },
    async created() {
        //Will run when the Vue cycle starts
        axios.get("map").then(c => {
            this.coordinates = c.data;
        });
    },
    async markers() {
        //Will run when the Vue cycle starts
        axios.get("assets").then(a => {
            this.coordinates_assets = a.assetscoordinates;
        });
    },
    mounted() {
        //set bounds of the map
        this.$refs.gmap.$mapPromise.then(map => {
            const bounds = new google.maps.LatLngBounds();
            for (let m of this.markers) {
                bounds.extend(m.position);
            }
            map.fitBounds(bounds);
        });
    },
    methods: {
        getPosition(c) {
            //Get position from Array
            return {
                lat: parseFloat(c.latitude),
                lng: parseFloat(c.longitude)
            };
        },
        setPosition(a) {
            //Will set the position of the asset from an Array
            return {
                lat: parseFloat(a.latitude),
                lng: parseFloat(a.longitude)
            };
        }
    },
    computed: {
        mapCenter: function() {
            if (!this.coordinates.lenght) {
                //This becomes the center of the Map if theres no markers close,
                return {
                    //this will be used when an alert is filled and we are looking for an asset
                    lat: 19.450245,
                    lng: -70.686466
                };
            }
            return {
                //This uses the first coordinates in the array to use as center.
                lat: parseFloat(this.coordinates[0].latitude),
                lng: parseFloat(this.coordinates[0].longitude)
            };
        },
        infoWindowPosition: function() {
            return {
                lat: parseFloat(this.activeAntenna.latitude),
                lng: parseFloat(this.activeAntenna.longitude)
            };
        }
    }
};
</script>