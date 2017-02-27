<template>
    <div v-if="shared.isLoading" id="loading-icon">
        <h1 class="text-center" id="loading">
            Loading <i class="fa fa-spinner slow-spin" aria-hidden="true"></i>
        </h1>
    </div>
</template>
<style lang="scss">
    @import '../../css/partials/mixins.scss';
    h1#loading {
        @include loading-icon();
        margin-top: 3em;
    }
</style>
<script>
    export default {
        props: [],
        methods: {

        },

        data() {
            return {
                shared: window.dataStore
            };
        }
    }
</script>