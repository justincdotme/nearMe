require('./../css/app.scss');
import Vue from 'vue';
import * as VueGoogleMaps from 'vue2-google-maps';
import Axios from 'axios';

Vue.use(VueGoogleMaps, {
    load: {
        key: window.googleMapsKey,
        libraries: 'places' //For autocomplete
    },
});

//TODO - Refactor, this is getting ugly. We can infer a few of these as computed properties
let data = {
    isLoading: true,
    hasGeoLocation: false,
    noStationsFound: false,
    shouldShowResults: false,
    stationList: null,
    location: {},
    markers: [],
    address: null
};

//TODO - Extract to file
Vue.component('search-bar', {
    props: [
    ],
    template: `
        <div class="input-group input-group-lg">
            <gmap-autocomplete 
            class="form-control" 
            id="gmap-auto" 
            placeholder="Address" 
            :value="address"
            @place_changed="updateLocation"
            ></gmap-autocomplete>
            <span class="input-group-btn">
                <button class="btn btn-default" id="search-button" type="button">
                    <i class="fa fa-search" aria-hidden="true" v-show="!isLoading" @click="addressSearch"></i>
                    <i class="fa fa-spinner slow-spin" aria-hidden="true" v-show="isLoading"></i>
                </button>
            </span>
        </div>
    `,
    methods: {
        updateLocation(place) {
            data.address = place.formatted_address;
        },

        addressSearch() {
            if (!data.isLoading) {
                return app.populateListByAddress({
                    address: data.address
                });
            }
        }
    },

    data() {
        return data;
    }
});

//TODO - Extract to file
Vue.component('station-preview', {
    props: [
        'station'
    ],
    template: `
            <div class="col-xs-12 col-md-6">
                <div class="panel panel-default panel-result-preview">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <h3>{{ station.location.name }}</h3>
                                <span class="street-address">
                                    {{ station.location.street_address.line_1 }} <br>
                                    {{ station.location.street_address.city }}, {{ station.location.street_address.state }} {{ station.location.street_address.zip }}
                                </span>
                            </div>
                        </div>
                        <div class="row quick-info">
                            <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-12 col-md-offset-0">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <strong>Levels: </strong>
                                        <span v-for="level in station.location.connections.levels">
                                            <span><i class="fa fa-bolt" aria-hidden="true"></i> {{ level.id }} </span>
                                        </span>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <strong>Access: </strong>
                                        <i v-if="station.location.usage == 'Unknown'" class="fa fa-question-circle" aria-hidden="true"></i>
                                        <i v-else-if="station.location.usage == 'Public'" class="fa fa-unlock" aria-hidden="true"></i>
                                        <i v-else="station.location.usage == 'Unknown'" class="fa fa-lock" aria-hidden="true"></i>
                                        <span>{{ station.location.usage }}</span>
                                    </div>
                                    <div class="col-xs-4 text-right">
                                        <strong>Distance: </strong>
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        <span>{{ station.location.distance }} mi</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <button type="button" class="btn btn-default view-details" onclick="window.location.href = '/details'">View Details</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    `,
    methods: {

    },

    data() {
        return data;
    }
});

//Root Vue Instance
window.app = new Vue({
    el: '#app',
    data: data,
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