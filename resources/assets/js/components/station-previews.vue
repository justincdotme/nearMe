<template>
    <div>
        <div v-if="shared.state.shouldShowResults" v-for="(station, index) in shared.stations.list">
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
                                        <i class="fa fa-bolt" aria-hidden="true"></i>
                                        <span v-for="(level, index) in station.location.connections.levels">
                                            <span>
                                               Level {{ level.id }}
                                                {{ (index == (station.location.connections.levels.length - 1)) ? '' : ',' }}
                                            </span>
                                        </span>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <i v-if="station.location.usage == 'Unknown'" class="fa fa-question-circle" aria-hidden="true"></i>
                                        <i v-else-if="station.location.usage == 'Public'" class="fa fa-unlock" aria-hidden="true"></i>
                                        <i v-else="station.location.usage == 'Unknown'" class="fa fa-lock" aria-hidden="true"></i>
                                        <span>{{ station.location.usage }}</span>
                                    </div>
                                    <div class="col-xs-4 text-right">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        <span>{{ station.location.distance }} mi</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <button type="button" class="btn btn-default view-details" @click="showStationDetails(index)">
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style lang="scss">
    @import '../../css/partials/colors.scss';
    @import '../../css/partials/mixins.scss';

    .panel-result-preview {
        @include box-shadow(4px, 4px, 4px, rgba(63, 146, 161, 0.5));
        h3 {
            color: $dark-green;
            font-size: 1.125em;
            font-weight: bold;
            margin-top: 0.125em;
        }

        .row.quick-info {
            height: 42px;
            margin: 10px 0 5px 0;
            span {
                color: $light-grey;
            }

            .fa.fa-bolt {
                color: $dark-green;
            }
        }
    }
</style>
<script>
    export default {
        props: [],

        methods: {
            showStationDetails (sid) {
                this.shared.stations.currentStation = sid;
                this.shared.state.shouldShowResults = false;
                this.shared.state.shouldShowStationDetail = true;
                this.showStationMarker();
            },

            showStationMarker () {
                //Empty current map markers and place the single station in the marker list
                let currentStation = this.shared.stations.list[this.shared.stations.currentStation];
                this.shared.stations.markers = [{
                    position: {
                        lat: currentStation.location.lat,
                        lng: currentStation.location.lng
                    }
                }];
            }
        },

        data() {
            return {
                shared: window.nearMe.dataStore
            };
        }
    }
</script>