<template>
  <div class="antennamap">
    <gmap-map :center="mapCenter" :zoom="13" style="width: 100%; height: 550px">
      <gmap-custom-marker
        v-for="d in data"
        :key="d.id"
        :marker="{ lat: d.latitude, lng: d.longitude }"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          style="width: 30px; height: 35px"
          viewBox="0 0 20 20"
          :fill="d.status == 'INACTIVE' ? 'red' : 'green'"
        >
          <path
            fill-rule="evenodd"
            d="M10.453 14.016l6.563-6.609-1.406-1.406-5.156 5.203-2.063-2.109-1.406 1.406zM12 2.016q2.906 0 4.945 2.039t2.039 4.945q0 1.453-0.727 3.328t-1.758 3.516-2.039 3.070-1.711 2.273l-0.75 0.797q-0.281-0.328-0.75-0.867t-1.688-2.156-2.133-3.141-1.664-3.445-0.75-3.375q0-2.906 2.039-4.945t4.945-2.039z"
            clip-rule="evenodd"
          />
        </svg>
        <!-- <gmap-marker
        v-for="d in data"
        :key="d.id"
        :position="{ lat: d.latitude, lng: d.longitude }"
        :draggable="false"
        :icon="d.status == 'INACTIVE' ? svgMarkerRed : svgMarkerGreen"
      >
         <GmapInfoWindow>
          <div>
            <strong>Estatus:{{ d.status }}</strong>
          </div>
        </GmapInfoWindow>
      </gmap-marker> -->
      </gmap-custom-marker>
    </gmap-map>
  </div>
</template>

<script>
import GmapCustomMarker from "vue2-gmap-custom-marker";

export default {
  components: {
    "gmap-custom-marker": GmapCustomMarker,
  },
  data() {
    //Hold Data as an Array of [Latitude, Longitud]
    return {
      coordinates: [],
      infoWindowOptions: {
        width: 0,
        height: -35,
      },
      activeAntenna: {},
      infoWindowOpened: true,
      infoContent: "",
      infoWinOpen: false,
      currentMidx: null,
      infoOptions: {
        pixelOffset: {
          width: 0,
          height: -35,
        },
      },
      data: [],
      svgMarkerRed: {
        path: "M10.453 14.016l6.563-6.609-1.406-1.406-5.156 5.203-2.063-2.109-1.406 1.406zM12 2.016q2.906 0 4.945 2.039t2.039 4.945q0 1.453-0.727 3.328t-1.758 3.516-2.039 3.070-1.711 2.273l-0.75 0.797q-0.281-0.328-0.75-0.867t-1.688-2.156-2.133-3.141-1.664-3.445-0.75-3.375q0-2.906 2.039-4.945t4.945-2.039z",
        fillColor: "red",
        fillOpacity: 0.9,
        strokeWeight: 0,
        rotation: 0,
        scale: 2,
        //anchor: new google.maps.Point(15, 30),
      },

      svgMarkerGreen: {
        path: "M10.453 14.016l6.563-6.609-1.406-1.406-5.156 5.203-2.063-2.109-1.406 1.406zM12 2.016q2.906 0 4.945 2.039t2.039 4.945q0 1.453-0.727 3.328t-1.758 3.516-2.039 3.070-1.711 2.273l-0.75 0.797q-0.281-0.328-0.75-0.867t-1.688-2.156-2.133-3.141-1.664-3.445-0.75-3.375q0-2.906 2.039-4.945t4.945-2.039z",
        fillColor: "green",
        fillOpacity: 0.9,
        strokeWeight: 0,
        rotation: 0,
        scale: 2,
        //anchor: new google.maps.Point(15, 30),
      },
    };
  },
  assetscoordinates() {
    //Hold Data as an Array of [Latitude, Longitud]
    return {
      coordinates_assets: [],
    };
  },

  async markers() {
    //Will run when the Vue cycle starts
    axios.get("assets").then((a) => {
      this.coordinates_assets = a.assetscoordinates;
    });
  },

  methods: {
    async fetchData() {
      try {
        const { data } = await axios.get("antennasmap");
        console.log(data);
        data.forEach((element) => {
          this.data.push(element);
        });
      } catch {
        console.log("error fetching antennasmap");
      }
    },

    getPosition(data) {
      //Get position from Array
      return {
        lat: parseFloat(data.latitude),
        lng: parseFloat(data.longitude),
      };
    },
    setPosition(a) {
      //Will set the position of the asset from an Array
      return {
        lat: parseFloat(a.latitude),
        lng: parseFloat(a.longitude),
      };
    },
  },
  computed: {
    mapCenter: function () {
      if (!this.coordinates.lenght) {
        //This becomes the center of the Map if theres no markers close,
        return {
          //this will be used when an alert is filled and we are looking for an asset
          lat: 19.450245,
          lng: -70.686466,
        };
      }
      return {
        //This uses the first coordinates in the array to use as center.
        lat: parseFloat(this.coordinates[0].latitude),
        lng: parseFloat(this.coordinates[0].longitude),
      };
    },
    infoWindowPosition: function () {
      return {
        lat: parseFloat(this.activeAntenna.latitude),
        lng: parseFloat(this.activeAntenna.longitude),
      };
    },
  },
  async created() {
    await this.fetchData();
    Echo.private("MapLocationChannel").listen("MapAntennaUpdate", (x) => {
      console.log("Antena mapa");
      console.log(x);
      this.data.push(x);
    });
  },
};
</script>
