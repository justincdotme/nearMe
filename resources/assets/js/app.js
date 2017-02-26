require('./../css/app.scss');
import Vue from 'vue';
import * as VueGoogleMaps from 'vue2-google-maps';
import Axios from 'axios';
import SearchBar from './components/search-bar.vue';
import StationPreview from './components/station-preview.vue';

Vue.use(VueGoogleMaps, {
    load: {
        key: window.googleMapsKey,
        libraries: 'places' //For autocomplete
    },
});

window.dataStore = {
    isLoading: true,
    hasGeoLocation: false,
    noStationsFound: false,
    shouldShowResults: false,
    stationList: null,
    location: {},
    markers: [],
    address: null
};

//Root Vue Instance
window.app = new Vue({
    el: '#app',
    data: dataStore,
    components: {
        SearchBar,
        StationPreview
    },
    methods: {
        getLocation () {
            return new Promise((resolve, reject) => {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        resolve(position);
                    },
                    (error) => {
                        reject(error);
                    },
                );
            });
        },

        initMap () {
            //Add the markers
            this.stationList.forEach((value, i) => {
                this.markers.push({
                    position: {
                        lat: value.location.lat,
                        lng: value.location.lng,
                    },
                    content: value.location.street_address.line_1 + ' ' + value.location.street_address.city
                });
            });

            this.shouldShowResults = true;
        },

        fetchStationList (type, payload) {
            this.isLoading = true;
            this.stationList = Axios.get('/' + type, {
                params: payload
            }).then((response) => {
                if ('success' == response.data.status) {
                    //Populate the global station list
                    this.stationList = response.data.list;
                    this.address = response.data.address;
                    this.location = {
                        lat: parseFloat(response.data.coords.lat),
                        lng: parseFloat(response.data.coords.lng)
                    };
                    //Initialize the map
                    this.initMap();
                    this.isLoading = false;
                }
                //TODO - More error handling

            }).catch((error) => {
                //TODO - Error handling

            });
        },

        populateListByAddress (address) {
            this.fetchStationList('address', address);

        },

        populateListByCoords (coords) {
            return this.fetchStationList('coords', coords);
        }
    },

    mounted () {
        this.getLocation()
            .then((position) => {
                this.populateListByCoords({
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                });
            }).catch((error) => {
            //TODO - Handle no geolocation

        });
    }
});