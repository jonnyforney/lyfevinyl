<template>
    <div>
        <album-name></album-name>
        <songs></songs>
        <covers></covers>
        <preview></preview>
    </div>
</template>

<script>
    import AlbumName from './AlbumName.vue';
    import Songs from './Songs.vue';
    import Covers from './Covers.vue';
    import Preview from './Preview.vue';

    export default {
        props: [
            'customer_id',
            'is_logged_in'
        ],
        data: function() {
            return {
                data: {}
            }
        },
        components: {
            'album-name': AlbumName,
            'songs': Songs,
            'covers': Covers,
            'preview': Preview,
        },
        methods: {

        },
        ready: function() {
            this.$store.state.customer_id = this.customer_id;
        }
    };
</script>