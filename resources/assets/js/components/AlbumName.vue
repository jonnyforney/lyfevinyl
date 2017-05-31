<template>
    <section v-if="current_step.show" class="text-center">
      <headline :heading="current_step.headline"></headline>
    <div class="row">
        <div class="col-md-6 col-center margin-bottom-30">
          <label class="lvds-form__label">What would you like to name this album?*</label><br>
          <input
            class="lvds-form__text-input"
            type="text"
            id="albumName"
            name="albumName"
            v-model="name"
            placeholder="i.e. Dad's Favorite Songs"
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
</template>

<script>
    import Headline from './Headline';
    import lv_functions from '../mixins/lv-functions.js';

    export default {
        name: 'album-name',
        props: [],
        mixins: [lv_functions],
        components: {
            'headline': Headline,
        },
        data: function() {
            return {}
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
                }
            }
        },
        methods: {

        },
        ready() {
            console.log('loaded')
        }
    };
</script>
