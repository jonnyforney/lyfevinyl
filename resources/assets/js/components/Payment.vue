<template>
  <section v-if="current_step.show" key="payment">
    <headline :heading="name" :subhead="current_step.subhead"></headline>
    <div class="row">
      <div class="col-md-8 col-center margin-bottom-30">
        <checkout></checkout>
      </div>
    </div>
    <back-next-btns></back-next-btns>
  </section>
</template>

<script>
    import Headline from './Headline';
    import StepControlButtons from './StepControlButtons';
    import lv_functions from '../mixins/lv-functions.js';
    import Checkout from './Checkout.vue';
    // import Circle2from './~/vue-loading-spinner/src/components/Circle.vue';

    export default {
        firstName: 'first-name',
        props: [],
        mixins: [lv_functions],
        components: {
            Headline,
            'back-next-btns': StepControlButtons,
            Checkout
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