<template>
    <form>            
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
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }
        },
        computed: {
            stripeEmail: {
                get() {
                    return this.$store.state.shipping.email;
                },
                set(email) {
                    this.$store.commit('setEmail', email);
                }
            },
            stripeToken: {
                get() {
                    return this.$store.state.payment.stripeToken;
                },
                set(token) {
                    this.$store.commit('setStripeToken', token);
                }
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
                image: "imgs/icon.png",
                locale: "auto",
                token: (token) => {
                    this.stripeToken = token.id;
                    this.stripeEmail = token.email;
                }
            });
        }
    };
</script>