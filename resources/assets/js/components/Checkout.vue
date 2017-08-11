<template>
    <form action="" method="POST">        
        <button id="buyVinyl" type="submit" @click.prevent="buy()">Buy This Here Vinyl</button>
    </form>
</template>

<script>
    import lv_functions from '../mixins/lv-functions.js';
    export default {
        mixins: [lv_functions],
        data: () => {
            return {
                name: 'Lyfe Vinyl',
                description: '',
                zipCode: true,
                amount: 20000,
                stripeToken: '',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }
        },
        computed: {
            stripeEmail() {
                return this.$store.state.shipping.email;
            }
        },
        methods: {
            buy() {
                this.stripe.open({
                    name: this.name,
                    description: this.description,
                    email: this.stripeEmail,
                    amount: this.amount,
                    zipCode: true
                })
            }
        },
        mounted() {
            //$('#buyVinyl').click()
        },
        created() {
            this.stripe = StripeCheckout.configure({
                key: this.stripeToken,
                image: "https:///stripe.com/img/documentation/checkout/marketplace.png",
                locale: "auto",
                token: () => {
                    this.stripeToken = token.id;
                    this.stripeEmail = token.email;

                    //  axios request
                }
            });
        }
    };
</script>