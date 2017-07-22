<template>
    <div class="row margin-top-50">
        <div class="col-md-2"></div>
        <div class="col-md-3 text-right">
            <button class="lvds-button lvds-button--ghost-blue-light" @click="back()">&laquo; Go Back</button>
        </div>
        <div class="col-md-1"></div>
          <div class="col-md-3 margin-bottom-30-sm">
              <button class="lvds-button lvds-button--blue-light" @click="alertDone">Submit Order</button>
          </div>
        <div class="col-md-3"></div>
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
                return this.$store.state.order.name;
            },
            frontcover() {
                return this.$store.state.order.front_cover_path;
            },
            vinyl() {
                return {
                    step: this.$store.state.display.current_step,
                    data: {
                        title: this.title,
                        frontcover: this.front_cover_path
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