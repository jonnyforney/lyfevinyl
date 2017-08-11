<template>
  <div class="row">
    <div class="col-md-10 col-center">
        <album-name></album-name>
        <songs></songs>
        <covers></covers>
        <shipping></shipping>
        <payment></payment>
        <preview></preview>
    </div>
  </div>
</template>

<script>
    import AlbumName from './AlbumName.vue';
    import Songs from './Songs.vue';
    import Covers from './Covers.vue';
    import Shipping from './Shipping.vue';
    import Payment from './Payment.vue';
    import Preview from './Preview.vue';

    export default {
        props: [
            'customer_id',
            'order',
            'is_logged_in'
        ],
        data: function() {
           return {
               data: {

               }
           }
       },
        components: {
            'album-name': AlbumName,
            'songs': Songs,
            'covers': Covers,
            'shipping': Shipping,
            'payment': Payment,
            'preview': Preview,
        },
        methods: {

        },
        mounted: function() {
            this.$store.commit('setCustomerId', this.customer_id);

            // setTimeout(() => {
            //   this.loading = false;
            // },6000);

            if (this.order) {
                let self = this;

                swal({
                    title: 'Previous Order Found',
                    text: "Would you like to load in the order?",
                    type: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#00a0ff',
                    cancelButtonColor: '#BBC2C8',
                    confirmButtonText: 'Yes, load it!',
                    cancelButtonText: 'No, start fresh.',
                    buttonsStyling: true
                }).then(function() {
                    //  load in order
                    axios.post('/order/load', {
                            'order_id': self.order
                        })
                        .then((response) => {
                            console.log(response.data);
                            self.$store.commit('setOrderId', self.order);
                            self.$store.commit('setName', response.data.title);
                            self.$store.commit('setFrontCoverPath', response.data.front_cover_path);
                            self.$store.commit('setSong', response.data.songs);
                        })
                        .catch((error) => {
                            console.error(error);
                        });
                }, function(dismiss) {
                    //  start fresh
                    axios.post('/file/clearSession')
                        .then((response) => {
                            console.log('cleared session');
                        })
                        .catch((error) => {
                            console.error(error);
                        });
                })
            }
        },
    };
</script>
