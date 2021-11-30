require('./bootstrap');

import Alpine from 'alpinejs';
import * as VueGoogleMaps from 'vue2-google-maps';
import VueGoodTablePlugin from 'vue-good-table';
import 'vue-good-table/dist/vue-good-table.css'


window.Alpine = Alpine;

Alpine.start();

window.Vue = require('vue').default;


Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('map-component', require('./components/MapComponent.vue').default);
Vue.component('livedata-component', require('./components/LivedataComponent.vue').default);
Vue.component('antenna-component', require('./components/AntennaComponent.vue').default);
Vue.component('tag-report-component', require('./components/TagReportComponent.vue').default);
Vue.component('alert-report-component', require('./components/AlertReportComponent.vue').default);
Vue.component('live-report-component', require('./components/LivefeedReportComponent.vue').default);
Vue.component('appuser-report-component', require('./components/AppUserReportComponent.vue').default);
Vue.component('notification-component', require('./components/NotificationComponent.vue').default);

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.use(VueGoodTablePlugin);

Vue.use(VueGoogleMaps, {
    load: {
        key: '',
        autobindAllEvents: true,
        installComponents: true
    }
});


const app = new Vue({
    el: '#app',
});

const app2 = new Vue({
    el: '#app2',
});

// const app = new Vue({
//     el: '#app',
//     data() {  //Hold Data as an Array of [Latitude, Longitud]
//         return {
//             coordinates: [],
//             infoWindowOptions: {
//                 width: 0,
//                 height: -35
//             },
//             activeAntenna:{},
//             infoWindowOpened:false,
//             infoContent: '',
//             infoWinOpen: false,
//             currentMidx: null,
//             //optional: offset infowindow so it visually sits nicely on top of our marker
//             infoOptions: {
//                 pixelOffset: {
//                     width: 0,
//                     height: -35
//                 }
//             }
//         }
//     },

//     assetscoordinates() {  //Hold Data as an Array of [Latitude, Longitud]
//         return {
//             coordinates_assets: []
//         }
//     },

//     async created() {  //Will run when the Vue cycle starts
//         axios.get("map").then(c => {
//             this.coordinates = c.data;
//         });
//     },

//     async markers() {  //Will run when the Vue cycle starts
//         axios.get("assets").then(a => {
//             this.coordinates_assets = a.assetscoordinates;
//         });
//     },

//     mounted() {
//         //set bounds of the map
//         this.$refs.gmap.$mapPromise.then((map) => {
//           const bounds = new google.maps.LatLngBounds()
//           for (let m of this.markers) {
//             bounds.extend(m.position)
//           }
//           map.fitBounds(bounds);
//         });
//       },

//     methods: {
//         getPosition(c) { //Get position from Array
//             return {
//                 lat: parseFloat(c.latitude),
//                 lng: parseFloat(c.longitude)
//             };
//         },

//         setPosition(a) { //Will set the position of the asset from an Array
//             return {
//                 lat: parseFloat(a.latitude),
//                 lng: parseFloat(a.longitude)
//             };
//         }
//     },

//     computed: {
//         mapCenter: function() {
//             if (!this.coordinates.lenght) { //This becomes the center of the Map if theres no markers close,
//                 return {                  //this will be used when an alert is filled and we are looking for an asset
//                     lat: 19.450245,
//                     lng:  -70.686466,
//                 };
//             }
//             return {                                            //This uses the first coordinates in the array to use as center.
//                 lat: parseFloat(this.coordinates[0].latitude),
//                 lng: parseFloat(this.coordinates[0].longitude)
//             };
//         },
//         infoWindowPosition: function() {
//                 return {
//                     lat: parseFloat(this.activeAntenna.latitude),
//                     lng: parseFloat(this.activeAntenna.longitude)
//                 };
//         },
//     }
// });
