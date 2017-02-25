require('./../css/app.scss');
import Vue from 'vue';
import * as VueGoogleMaps from 'vue2-google-maps';

Vue.use(VueGoogleMaps, {
    load: {
        key: window.googleMapsKey,
        libraries: 'places', //// If you need to use place input
    },

});


let data = {
    isLoading: true,
    hasInvalidAddress: false,
    hasGeoLocation: false,
    showResults: false,
    stationList: null,
    noStationsFound: false, //Candidate for computed property
    location: null,
    //TODO - Temp data, get with Axios
    center: {
        lat: 38.89829066332753,
        lng: -77.03690404999998
    },
    //TODO - Temp data, get with Axios
    markers: [{
        position: {
            lat: 38.89829066332753,
            lng: -77.03690404999998
        }
    }]

};

//TODO - Extract to component .vue
Vue.component('search-bar', {
    props: [
        'address'
    ],
    template: `
        <div class="input-group input-group-lg">
            <gmap-autocomplete class="form-control" id="gmap-auto" placeholder="Address"></gmap-autocomplete>
            <span class="input-group-btn">
                <button class="btn btn-default" id="search-button" type="button">
                    <i class="fa fa-search" aria-hidden="true" v-show="!isLoading" ></i>
                    <i class="fa fa-spinner slow-spin" aria-hidden="true" v-show="isLoading"></i>
                </button>
            </span>
        </div>
    `,
    methods: {

    },

    data() {
        return data;
    }
});

//TODO - Extract to component .vue
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
                                <img class="img-responsive" src="http://placehold.it/115x99">
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

window.app = new Vue({
    el: '#app',
    data: data,
    methods: {

    },

    mounted () {
        //TODO - Implement actual logic. This is just placeholder code
        //Do Geolocation
        if (false) { //geolocation failure
            //this.showResults = false;
            this.hasGeoLocation = false;
        }

        if (true) { //geolocation success
            this.hasGeoLocation = true;
            this.location = {
                lat: 0,
                lng: 0
            }; //Lat and Lng from geolocation

            //Do request to getStationListByCoords, using this.data.location object
            if (true) { //Results in station list
                this.location.address = ''; //Axios response
                this.stationList = {}; //Axios response
                this.isLoading = false;
                //this.showResults = true;
            }

            if (false) { //No station results
                this.isLoading = false;
                this.noStationsFound = true;
            }
        }

        if (false) { // invalid address failure
            this.showResults = false;
            //this.hasInvalidAddress = true;
            this.isLoading = false;
        }
        //TODO - Implement logic, this is placeholder data
        this.stationList = [
            {
                "operator": {
                    "name": "(Unknown Operator)",
                    "website": null,
                    "phone": null,
                    "email": null
                },
                "location": {
                    "street_address": {
                        "line_1": "9812 NE Highway 99",
                        "line_2": null,
                        "city": "Vancouver",
                        "state": "WA"
                    },
                    "name": "9812 NE Highway 99",
                    "distance": 2.1265371135755,
                    "lat": 45.692621,
                    "lng": -122.657682,
                    "connections": {
                        "levels": [
                            {
                                "id": 2,
                                "title": "Level 2 : Medium (Over 2kW)"
                            }
                        ],
                        "amperages": [],
                        "voltages": [],
                        "kilowatts": [],
                        "fast_charge_capable": false
                    }
                },
                "google_map_link": "http:\/\/maps.google.com\/?daddr=9812+NE+Highway+99VancouverWA",
                "apple_map_link": "http:\/\/maps.apple.com\/?daddr=9812+NE+Highway+99%2CVancouverWA"
            },
            {
                "operator": {
                    "name": "Blink Network\/ECOtality",
                    "website": "http:\/\/www.blinknetwork.com\/",
                    "phone": "888.998.BLINK (2546)",
                    "email": "support@blinknetwork.com"
                },
                "location": {
                    "street_address": {
                        "line_1": "2211 Northeast 139th Street",
                        "line_2": null,
                        "city": "Vancouver",
                        "state": "WA"
                    },
                    "name": "Legacy Salmon Creek Hospital",
                    "distance": 2.1317358381556,
                    "lat": 45.720387,
                    "lng": -122.648554,
                    "connections": {
                        "levels": [
                            {
                                "id": 2,
                                "title": "Level 2 : Medium (Over 2kW)"
                            }
                        ],
                        "amperages": [
                            16
                        ],
                        "voltages": [
                            230
                        ],
                        "kilowatts": [
                            3
                        ],
                        "fast_charge_capable": false
                    }
                },
                "google_map_link": "http:\/\/maps.google.com\/?daddr=2211+Northeast+139th+StreetVancouverWA",
                "apple_map_link": "http:\/\/maps.apple.com\/?daddr=2211+Northeast+139th+Street%2CVancouverWA"
            },
            {
                "operator": {
                    "name": "(Unknown Operator)",
                    "website": null,
                    "phone": null,
                    "email": null
                },
                "location": {
                    "street_address": {
                        "line_1": "6708 NE 63rd St",
                        "line_2": null,
                        "city": "Vancouver",
                        "state": "WA"
                    },
                    "name": "6708 NE 63rd St",
                    "distance": 2.264870848097,
                    "lat": 45.668458,
                    "lng": -122.603911,
                    "connections": {
                        "levels": [
                            {
                                "id": 2,
                                "title": "Level 2 : Medium (Over 2kW)"
                            }
                        ],
                        "amperages": [],
                        "voltages": [],
                        "kilowatts": [],
                        "fast_charge_capable": false
                    }
                },
                "google_map_link": "http:\/\/maps.google.com\/?daddr=6708+NE+63rd+StVancouverWA",
                "apple_map_link": "http:\/\/maps.apple.com\/?daddr=6708+NE+63rd+St%2CVancouverWA"
            }
        ];

    }
});
