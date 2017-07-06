<template>
  <transition-group
    name="very-special-transition"
    mode="out-in"
  >
    <section v-if="current_step.show" key="album-name">
      <headline :heading="current_step.headline"></headline>
      <div class="row">
        <div class="col-md-8 col-center margin-bottom-30">
          <!-- <circle></circle> -->
          <label class="lvds-form__label">What would you like to name this album?*</label><br>
          <input
            class="lvds-form__text-input"
            type="text"
            id="albumName"
            name="albumName"
            v-model="name"
            placeholder="i.e. Jake and Sarah's Wedding"
            autofocus
            required="true"
          />
          <br>
          <br>
          <br>
          <button
            class="lvds-button lvds-button--blue-light"
            @click="next()"
            >Continue &raquo;
          </button>
        </div>
      </div>
    </section>
  </transition-group>
</template>

<script>
    import Headline from './Headline';
    import lv_functions from '../mixins/lv-functions.js';
    // import Circle2from './~/vue-loading-spinner/src/components/Circle.vue';

    export default {
        name: 'album-name',
        props: [],
        mixins: [lv_functions],
        components: {
            'headline': Headline,
            // Circle,
        },
        data: function () {
          return {
            progress: this.$store.state.progress
          }
        },
        computed: {
            current_step() {
                return this.$store.state.step_album_name;
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
        mounted() {
          this.moveProgressBar();
        }
    };
</script>
