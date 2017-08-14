<template>
  <section v-if="current_step.show" key="preview">
    <headline :heading="current_step.headline" :subhead="current_step.subhead"></headline>
    <!-- ALBUM NAME -->
    <div class="row margin-bottom-15">
      <div class="col-md-12">
        <p class="lvds-headline--tertiary"><strong>Vinyl Name:</strong></p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <p class="lvds-para">{{ name }}</p>
      </div>
    </div>

    <!-- COVERS -->
    <div class="row margin-top-50">
      <div class="col-md-12">
        <p class="lvds-headline--tertiary"><strong>Album Covers:</strong></p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-6">
            <img v-if="!front_cover_path" class="cover-image" src="http://placehold.it/250x250">
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
        <p class="lvds-headline--tertiary"><strong>Tracks:</strong></p>
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
        data: () => {
            return {}
        },
        computed: {
            current_step() {
                return this.$store.state.display.step_preview;
            },
            name() {
                return this.$store.state.vinyl.name;
            },
            front_cover_path() {
                return this.$store.state.vinyl.front_cover_path;
            },
            sides() {
                return this.$store.state.vinyl.sides;
            }
        },
        methods: {

        },
    };
</script>
