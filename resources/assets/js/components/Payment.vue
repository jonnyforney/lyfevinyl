<template>
  <section v-if="current_step.show" key="payment">
    <headline :heading="current_step.headline" :subhead="current_step.subhead"></headline>
    <paymentdialog></paymentdialog>
    <back-next-btns></back-next-btns>
  </section>
</template>

<script>
    import Headline from './Headline';
    import StepControlButtons from './StepControlButtons';
    import lv_functions from '../mixins/lv-functions.js';
    import PaymentDialog from './PaymentDialog.vue';
    // import Circle2from './~/vue-loading-spinner/src/components/Circle.vue';

    export default {
        firstName: 'first-name',
        props: [],
        mixins: [lv_functions],
        components: {
            Headline,
            'back-next-btns': StepControlButtons,
            'paymentdialog': PaymentDialog
        },
        data: function() {
            return {

            }
        },
        computed: {
            current_step() {
                return this.$store.state.display.step_payment;
            },
            name: {
                get() {
                    return this.$store.state.vinyl.name;
                },
                set(name) {
                    this.$store.commit('setName', name);
                },
            }
        },
        methods: {

        },
    };
</script>