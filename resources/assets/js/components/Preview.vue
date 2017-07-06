<template>
  <section v-if="current_step.show" key="preview">
    <headline :heading="current_step.headline" :subhead="current_step.subhead"></headline>
    <div class="row">
      <div class="col-md-8 col-center">
        <!-- ALBUM NAME -->
        <div class="row margin-bottom-15">
          <div class="col-md-12">
            <label class="lvds-form__label"><strong>Vinyl Name:</strong></label>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label class="lvds-form__label">{{ name }}</label>
          </div>
        </div>

        <!-- COVERS -->
        <div class="row margin-top-50">
          <div class="col-md-12">
            <label class="lvds-form__label"><strong>Album Covers:</strong></label>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-6">
                <img v-if="!front_cover_path" class="cover-image" src="http://placehold.it/200x200">
                <img v-if="front_cover_path" class="cover-image" :src="front_cover_path">
              </div>
              <div class="col-md-6">
                <img src="http://placehold.it/200x200">
              </div>
            </div>
          </div>
        </div>

        <!-- SONGS -->
        <div class="row margin-top-50">
          <div class="col-md-12 margin-bottom-15">
            <label class="lvds-form__label"><strong>Song Order:</strong></label>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-5" v-for="side in sides">
                <p class="lvds-headline--tertiary">Side {{side.side}}</p>
                <div v-for="(song, index) in side.songs">
                  <div class="row">
                    <div class="col-md-12">
                      <p v-if="song.picked" class="lvds-para">{{ index+1 }}. {{ song.file }}</p>
                      <p v-if="!song.picked" class="lvds-para">{{ index+1 }}. Oops, nothing here.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <back-submit-btns></back-submit-btns>
  </section>

</template>

<script>
    import Headline from './Headline';
    import StepSubmitButtons from './StepSubmitButtons';
    import lv_functions from '../mixins/lv-functions.js';

    export default {
        name: 'preview',
        props: [],
        mixins: [lv_functions],
        components: {
            'headline': Headline,
            'back-submit-btns': StepSubmitButtons
        },
        data: function() {
            return {
                progress: this.$store.state.progress,
            }
        },
        computed: {
            current_step() {
                return this.$store.state.step_preview;
            },
            name() {
                return this.$store.state.name;
            },
            frontcover() {
                return this.$store.state.frontcover;
            },
            sides() {
                return this.$store.state.sides;
            }
        },
        methods: {

        },
    };
</script>