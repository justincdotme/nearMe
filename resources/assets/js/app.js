"use strict";
require('./../css/app.scss');
import Vue from 'vue';
import * as VueGoogleMaps from 'vue2-google-maps';
import Axios from 'axios';
import SearchBar from './components/search-bar.vue';
import StationPreviews from './components/station-previews.vue';
import StationDetail from './components/station-detail.vue';
import LoadingIcon from './components/loading-icon.vue';

Vue.use(VueGoogleMaps, {
    load: {
        key: window.googleMapsKey,
        libraries: 'places' //For autocomplete
    },
});

//The shared data object
window.nearMe = {
    dataStore: {
        state: {
            isLoading: true,
            noLocation: false,
            hasFatalError: false,
            shouldShowMap: false,
            noStationsFound: false,
            shouldShowResults: false,
            shouldShowStationDetail: false
        },
        stations: {
            markers: [],
            list: [],
            currentStation: null,
            showDetails: false
        },
        location: {
            coords: null,
            address: null
        }
    }
};

//Root Vue Instance
window.nearMe.app = new Vue({
    el: '#app',
    data: nearMe.dataStore,
    components: {
        SearchBar,
        StationPreviews,
        StationDetail,
        LoadingIcon
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

        addMapMarkers () {
            //Empty current map markers
            this.stations.markers = [];
            //Add the markers to the map
            this.stations.list.forEach((value, i) => {
                this.stations.markers.push({
                    position: {
                        lat: value.location.lat,
                        lng: value.location.lng,
                    },
                    content: value.location.street_address.line_1 + ' ' + value.location.street_address.city
                });
            });
        },

        fetchStationList (type, payload) {
            this.state.isLoading = true;
            this.resetErrors();
            Axios.get('/' + type, {
                params: payload
            }).then((response) => {
                let d = response.data;
                if ('success' == d.status) {
                    if (d.list.length) {
                        //Populate the global station list
                        this.stations.list = response.data.list;
                        //Set the current address and coords
                        this.location.address = response.data.address;
                        this.location.coords = {
                            lat: parseFloat(response.data.coords.lat),
                            lng: parseFloat(response.data.coords.lng)
                        };
                        //Add station markers to the map
                        this.addMapMarkers();
                        //Show the results
                        this.state.shouldShowResults = true;
                        this.state.shouldShowMap = true;
                        //Reset the app loading state
                        this.state.isLoading = false;
                    } else {
                        this.showError('results');
                    }
                } else {
                    this.showError('results');
                }
            }).catch((error) => {
                this.showError();
            });
        },

        populateListByAddress (address) {
            this.fetchStationList('address', address);
        },

        populateListByCoords (coords) {
            return this.fetchStationList('coords', coords);
        },

        showError(type) {
            this.state.isLoading = false;
            this.state.shouldShowResults = false;
            switch (type) {
                case 'location':
                    this.state.noLocation = true;
                    break;
                case 'results':
                    this.state.noStationsFound = true;
                    this.state.shouldShowMap = false;
                    break;
                default:
                    this.state.hasFatalError = true;
            }
        },

        resetErrors () {
            this.state.noLocation = false;
            this.state.noStationsFound = false;
            this.state.hasFatalError = false;
        }
    },

    mounted () {
        if ('geolocation' in navigator) {
            this.getLocation()
                .then((position) => {
                    this.populateListByCoords({
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    });
                }).catch((error) => {
                this.showError('location');
            });
        } else {
            this.showError('location');
        }
    }
});