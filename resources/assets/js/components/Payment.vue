<template>
  <section v-if="current_step.show" key="payment">
    <headline :heading="name" :subhead="current_step.subhead"></headline>
    <div class="row">
      <div class="col-md-8 col-center margin-bottom-30">
        <p>STRIPE GOES HERE</p>
      </div>
    </div>
    <back-next-btns></back-next-btns>
  </section>
</template>

<script>
    import Headline from './Headline';
    import StepControlButtons from './StepControlButtons';
    import lv_functions from '../mixins/lv-functions.js';
    // import Circle2from './~/vue-loading-spinner/src/components/Circle.vue';

    export default {
        firstName: 'first-name',
        props: [],
        mixins: [lv_functions],
        components: {
            'headline': Headline,
            'back-next-btns': StepControlButtons,
        },
        data: function () {
          return {

          }
        },
        computed: {
            current_step() {
                return this.$store.state.step_payment;
            },
            name: {
                get() {
                    return this.$store.state.name;
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
