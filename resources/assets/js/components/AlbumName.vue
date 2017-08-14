<template>
  <section v-if="current_step.show" key="album-name">
    <headline :heading="current_step.headline" :subhead="current_step.subhead"></headline>
      <!-- <label class="lvds-form__label">What would you like to name this album?</label><br> -->
      <input
        class="lvds-form__text-input"
        type="text"
        id="albumName"
        name="albumName"
        v-model="name"
        placeholder="i.e. Jim and Pam's Wedding Tracks"
        autofocus
        required="true"
      />
      <div class="margin-bottom-30"></div>
      <next-btn></next-btn>
  </section>
</template>

<script>
    import Headline from './Headline';
    import StepContinueButton from './StepContinueButton';
    import lv_functions from '../mixins/lv-functions.js';
    // import Circle2from './~/vue-loading-spinner/src/components/Circle.vue';

    export default {
        name: 'album-name',
        props: [],
        mixins: [lv_functions],
        components: {
            'headline': Headline,
            'next-btn': StepContinueButton,
            // Circle,
        },
        data: () => {
            return {}
        },
        computed: {
            current_step() {
                return this.$store.state.display.step_album_name;
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
        mounted() {
            this.moveProgressBar();
        }
    };
</script>
