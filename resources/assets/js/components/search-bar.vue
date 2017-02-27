<template>
    <div class="input-group input-group-lg">
        <gmap-autocomplete
                class="form-control"
                id="gmap-auto"
                placeholder="Address"
                :value="shared.location.address"
                @place_changed="updateLocation"
        ></gmap-autocomplete>
        <span class="input-group-btn">
                <button class="btn btn-default" id="search-button" type="button">
                    <i class="fa fa-search" aria-hidden="true" v-show="!shared.state.isLoading" @click="addressSearch"></i>
                    <i class="fa fa-spinner slow-spin" aria-hidden="true" v-show="shared.state.isLoading"></i>
                </button>
            </span>
    </div>
</template>
<style lang="scss">
    @import '../../css/partials/colors.scss';
    @import '../../css/partials/mixins.scss';
    #top-bar {
        background-color: #2a8474;
        height: 66px;
        padding: 8px 0;
        color: #fff;


        @include placeholder {
            color: $light-green;
        }

        a i.back-button {
            font-size: 3.75em;
            color: #fff;
        }
        h1#detail-name {
            font-weight: bold;
        }

        @media only screen and (min-width : 320px) {
            h1#detail-name {
                font-size: 1.5em;
                margin: 0.25em 0 0 0;
            }
        }

        @media only screen and (min-width : 768px) {
            h1#detail-name {
                font-size: 2.25em;
                margin: .25em 0 0 .25em;
            }
        }

    @include loading-icon();
    }
</style>
<script>
    export default {
        props: [

        ],
        methods: {
            updateLocation(place) {
                if ('formatted_address' in place) {
                    this.shared.location.address = place.formatted_address;
                } else {
                    this.shared.location.address = place.name;
                }
                this.addressSearch();
            },

            addressSearch() {
                if (!this.shared.state.isLoading) {
                    return nearMe.app.populateListByAddress({
                        address: this.shared.location.address
                    });
                }
            },
        },

        data() {
            return {
                shared: window.nearMe.dataStore
            };
        }
    }
</script>