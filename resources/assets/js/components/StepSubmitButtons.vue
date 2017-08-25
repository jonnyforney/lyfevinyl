<template>
  <div class="row">
    <hr class="lvds-hr--gray-medium">
    <div class="col-md-6 text-right">
        <button class="lvds-button lvds-button--ghost-blue-light" @click="back()">&laquo; Go Back</button>
    </div>
    <div class="col-md-6 margin-bottom-30-sm">
      <button class="lvds-button lvds-button--blue-light" @click="alertDone">Submit Order</button>
    </div>
  </div>
</template>

<script>
    import lv_functions from '../mixins/lv-functions.js';

    export default {
        mixins: [lv_functions],
        data: () => {
            return {};
        },
        computed: {
            title() {
                return this.$store.state.vinyl.name;
            },
            frontcover() {
                return this.$store.state.vinyl.front_cover_path;
            },
            vinyl() {
                return {
                    step: this.$store.state.display.current_step,
                    data: {
                        order_id: this.$store.state.vinyl.order_id,
                        title: this.title,
                        frontcover: this.front_cover_path,
                        sides: this.$store.state.vinyl.sides,
                        shipping: this.$store.state.shipping,
                        payment: this.$store.state.payment,
                        status: this.$store.state.order.status
                    }
                };
            }
        },
        methods: {
            //  alerts
            alertDone: function(event) {
                axios.post('/order/save', this.vinyl)
                    .then((response) => {
                        console.log(response.data);

                        swal({
                            title: "You did it!",
                            html: "You'll receive an email with your order summary soon.<br/> (" + response.data + ")",
                            type: "success"
                        });
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        },
        ready() {
            console.log('loaded')
        }
    };
</script>