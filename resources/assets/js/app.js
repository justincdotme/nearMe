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
    hasInvalidAddress: false,
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
Vue.component('station', {
    props: [
        'station'
    ],
    template: `
            <div class="col-xs-12 col-md-6">
                <div class="panel panel-default panel-result-preview">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-9 col-md-8 col-xs-12">
                                <h3>Station Name</h3>
                                <span class="street-address">
                                    1234 Any St <br>
                                    Cityville, DC 20001
                                </span>
                            </div>
                            <div class="col-lg-3 col-md-4 hidden-xs hidden-sm">
                                <img class="img-responsive" src="https://placeholdit.imgix.net/~text?txtsize=12&txt=115%C3%9799&w=115&h=99">
                            </div>
                        </div>
                        <div class="row quick-info">
                            <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-12 col-md-offset-0">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <i class="fa fa-bolt" aria-hidden="true"></i>
                                        <span>Level 2</span>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <i class="fa fa-unlock" aria-hidden="true"></i>
                                        <span>Public</span>
                                    </div>
                                    <div class="col-xs-4 text-right">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        <span>1.2 mi.</span>
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
            return new Promise(function(resolve, reject) {
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