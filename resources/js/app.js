require('./bootstrap');

import Alpine from 'alpinejs';
import axios from 'axios';
import * as VueGoogleMaps from 'vue2-google-maps';

window.Alpine = Alpine;

Alpine.start();

window.Vue = require('vue').default;


Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.use(VueGoogleMaps, {
    load: {
        key: ''
    }
});

const app = new Vue({
    el: '#app',
    data() {  //Hold Data as an Array of [Latitude, Longitud]
        return {
            coordinates: [],
            infoWindowOptions: {
                width: 0,
                height: -35
            },
            activeAntenna:{},
            infoWindowOpened:false
        }
    },

    assetscoordinates() {  //Hold Data as an Array of [Latitude, Longitud]
        return {
            coordinates_assets: []
        }
    },

    async created() {  //Will run when the Vue cycle starts
        axios.get("map").then(c => {
            this.coordinates = c.data;
        });
    },

    async markers() {  //Will run when the Vue cycle starts
        axios.get("assets").then(a => {
            this.coordinates_assets = a.assetscoordinates;
        });
    },

    methods: {
        getPosition(c) { //Get position from Array
            return {
                lat: parseFloat(c.latitude),
                lng: parseFloat(c.longitude)
            };
        },

        setPosition(a) { //Will set the position of the asset from an Array
            return {
                lat: parseFloat(a.latitude),
                lng: parseFloat(a.longitude)
            };
        }
    },

    computed: {
        mapCenter: function() {
            if (!this.coordinates.lenght) { //This becomes the center of the Map if theres no markers close,
                return {                  //this will be used when an alert is filled and we are looking for an asset
                    lat: 19.450245,
                    lng:  -70.686466,
                };
            }
            return {                                            //This uses the first coordinates in the array to use as center.
                lat: parseFloat(this.coordinates[0].latitude),
                lng: parseFloat(this.coordinates[0].longitude)
            };
        },
        infoWindowPosition: function() {
                return {
                    lat: parseFloat(this.activeAntenna.latitude),
                    lng: parseFloat(this.activeAntenna.longitude)
                };
        },
    }
});
