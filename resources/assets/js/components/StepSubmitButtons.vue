<template>
    <div class="row margin-top-50">
        <div class="col-md-2"></div>
        <div class="col-md-4 col-md-push-4 text-left margin-bottom-30-sm">
            <button class="lvds-button lvds-button--blue-light" @click="alertDone">Submit Order</button>
        </div>
        <div class="col-md-4 col-md-pull-4 text-right">
            <button class="lvds-button lvds-button--ghost-blue-light" @click="back()">&laquo; Go Back</button>
        </div>
        <div class="col-md-2"></div>
    </div>
</template>

<script>
    import lv_functions from '../mixins/lv-functions.js';

    export default {
        mixins: [lv_functions],
        data: function() {
            return {};
        },
        computed: {
            title() {
                return this.$store.state.name;
            },
            frontcover() {
                return this.$store.state.frontcover;
            },
            vinyl() {
                return {
                    title: this.title,
                    frontcover: this.frontcover
                };
            }
        },
        methods: {
            //  alerts
            alertDone: function(event) {
                axios.post('/steps/save', this.vinyl)
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