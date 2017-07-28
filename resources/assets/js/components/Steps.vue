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
            this.$store.state.customer_id = this.customer_id;

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
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, load it!',
                    cancelButtonText: 'No, start fresh',
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: false
                }).then(function() {
                    //  load in order
                    axios.post('/order/load', {
                            'order_id': self.order
                        })
                        .then((response) => {
                            console.log(response.data);
                            self.$store.commit('setName', response.data.title);
                        })
                        .catch((error) => {
                            console.error(error);
                        });
                }, function(dismiss) {
                    //  start fresh
                })
            }
        },
    };
</script>
