<template>
    <transition name="fade">
        <div v-if="shared.state.shouldShowStationDetail">
            <div class="row-fluid">
                <div class="col-xs-12 col-md-8 col-md-offset-2">
                    <div class="row">
                        <div id="station-detail">
                            <div class="col-sm-6 col-lg-4">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <h2 class="text-center">Charging Details</h2>
                                        <table class="detail-list">
                                            <tr>
                                                <td>Level(s)</td>
                                                <td>
                                                    <span v-for="(level, index) in getCurrentStation().location.connections.levels">
                                                        <span>
                                                          {{ level.id }}
                                                            {{ (index == (getCurrentStation().location.connections.levels.length - 1)) ? '' : ',' }}
                                                        </span>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Amperage(s)</td>
                                                <td>
                                                    <span v-for="(amperage, index) in getCurrentStation().location.connections.amperages">
                                                        <span>
                                                          {{ amperage }}
                                                            {{ (index == (getCurrentStation().location.connections.amperages.length - 1)) ? '' : ',' }}
                                                        </span>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Voltage(s)</td>
                                                <td>
                                                    <span v-for="(voltage, index) in getCurrentStation().location.connections.voltages">
                                                        <span>
                                                          {{ voltage }}
                                                            {{ (index == (getCurrentStation().location.connections.voltages.length - 1)) ? '' : ',' }}
                                                        </span>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>kW</td>
                                                <td>
                                                    <span v-for="(kilowatt, index) in getCurrentStation().location.connections.kilowatts">
                                                        <span>
                                                          {{ kilowatt }}
                                                            {{ (index == (getCurrentStation().location.connections.voltages.length - 1)) ? '' : ',' }}
                                                        </span>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Fast Charge</td>
                                                <td>
                                                    {{ (true == getCurrentStation().location.connections.fast_charge_capable) ? 'Yes' : 'No' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Connections</td>
                                                <td>
                                                    {{ getCurrentStation().location.connections.count }}
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="hidden-lg">
                                            <h2 class="text-center">Operator Details</h2>
                                            <table class="detail-list">
                                                <tr>
                                                    <td>Name</td>
                                                    <td>
                                                        {{ getCurrentStation().operator.name }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Website</td>
                                                    <td>
                                                        <span v-if="'-' != getCurrentStation().operator.website">
                                                        <a :href="getCurrentStation().operator.website" target="_BLANK">
                                                            {{ getCurrentStation().operator.website }}
                                                        </a>
                                                    </span>
                                                        <span v-else>
                                                        -
                                                    </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Phone</td>
                                                    <td>
                                                        {{ getCurrentStation().operator.phone }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Email</td>
                                                    <td>
                                                        {{ getCurrentStation().operator.email }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 hidden-xs hidden-sm hidden-md">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <h2 class="text-center">Operator Details</h2>
                                        <table class="detail-list">
                                            <tr>
                                                <td>Name</td>
                                                <td>
                                                    {{ getCurrentStation().operator.name }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Website</td>
                                                <td>
                                                    <span v-if="'-' != getCurrentStation().operator.website">
                                                        <a :href="getCurrentStation().operator.website" target="_BLANK">
                                                            {{ getCurrentStation().operator.website }}
                                                        </a>
                                                    </span>
                                                    <span v-else>
                                                        -
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Phone</td>
                                                <td>
                                                    {{ getCurrentStation().operator.phone }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>
                                                    {{ getCurrentStation().operator.email }}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <h2 class="text-center">Location Details</h2>
                                        <table class="detail-list">
                                            <tr>
                                                <td>Address</td>
                                                <td>
                                                    {{ getCurrentStation().location.street_address.line_1 }}<br>
                                                    <span v-if="'-' != getCurrentStation().location.street_address.line_2">
                                                        {{ getCurrentStation().location.street_address.line_2 }}<br>
                                                    </span>
                                                    {{ getCurrentStation().location.street_address.city }},
                                                    {{ getCurrentStation().location.street_address.state }}
                                                    {{ getCurrentStation().location.street_address.zip }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Name</td>
                                                <td>
                                                    {{ getCurrentStation().location.name }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Distance</td>
                                                <td>
                                                    {{ getCurrentStation().location.distance }} mi
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Lat</td>
                                                <td>
                                                    {{ getCurrentStation().location.lat }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Lng</td>
                                                <td>
                                                    {{ getCurrentStation().location.lng }}
                                                </td>
                                            </tr>
                                        </table>
                                        <a
                                                id="gmap"
                                                type="button"
                                                class="btn btn-default view-map"
                                                :href="getCurrentStation().google_map_link"
                                                target="_BLANK">
                                            Google Map
                                        </a>
                                        <a
                                                id="amap"
                                                type="button"
                                                class="btn btn-default view-map"
                                                :href="getCurrentStation().apple_map_link"
                                                target="_BLANK">
                                            Apple Map
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>
<style lang="scss">
    @import '../../css/partials/colors.scss';
    @import '../../css/partials/mixins.scss';
    @import '../../css/partials/vue-transitions.scss';
    #station-detail {
            .panel {
            @include box-shadow(4px, 4px, 4px, rgba(63, 146, 161, 0.5));
            overflow: hidden;

            table.detail-list {
                width: 100%;
                margin: 1.2em auto;
                font-size: 1.185em;
            }

            td {
                padding: 3px 4px;
                vertical-align: top;
            }

            tr:nth-child(even) {
                background-color: $off-white-alt;
            }

            .panel-default {
                @include box-shadow(4px, 4px, 4px, rgba(63, 146, 161, 0.25));
                border: none;
            }

            .panel-body {
                min-height: 425px;

                h2 {
                    margin-top: 6px;
                }
            }
        }

        a.btn.view-map {
            border-radius: 0;
            background-color: $dark-green;
            width: 100%;
            font-weight: bold;
            font-size: 1.125em;
            border: none;
            margin: 0.45em 0;
            color: #fff;
            padding: 14px 0;
        }
    }
</style>
<script>
    export default {
        props: [],

        methods: {
            getCurrentStation () {
                return window.nearMe.dataStore.stations.list[window.nearMe.dataStore.stations.currentStation];
            }
        },

        data() {
            return {
                shared: window.nearMe.dataStore
            };
        }
    }
</script>