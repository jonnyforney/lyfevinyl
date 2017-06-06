<template>
<section v-if="current_step.show">
  <headline :heading="name" :subhead="current_step.subhead"></headline>
  <div class="row">
    <div class="col-md-8 col-center">
      <div class="row">
        <div class="image-upload col-md-6">
          <p class="lvds-headline--tertiary">Front Cover</p>
          <div class="row margin-bottom-30">
            <div class="col-md-12">
              <label for="frontcover-input">
                <img v-if="!frontcover" class="cover-image" src="http://placehold.it/200x200">
                <img v-if="frontcover" class="cover-image" :src="frontcover">
              </label>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <input
                id="frontcover-input"
                type="file"
                @change="onImageChange($event, 'frontcover')"
              >
              </input>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <p class="lvds-headline--tertiary">Back Cover</p>
          <div class="row margin-bottom-30">
            <div class="col-md-12">
              <img src="http://placehold.it/200x200">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <back-next-btns></back-next-btns>
</section>

</template>

<script>
    import Headline from './Headline';
    import StepControlButtons from './StepControlButtons';
    import lv_functions from '../mixins/lv-functions.js';

    export default {
        name: 'covers',
        props: [],
        mixins: [lv_functions],
        components: {
            'headline': Headline,
            'back-next-btns': StepControlButtons
        },
        data: function() {
          return {
            progress: this.$store.state.progress,
            image: ''
          }
        },
        computed: {
            current_step() {
                return this.$store.state.step_covers;
            },
            name() {
                return this.$store.state.name;
            },
            frontcover() {
                return this.$store.state.frontcover;
            }
        },
        methods: {
            onImageChange(e, cover) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length) return;

                //  start loader here

                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;

                reader.onload = (e) => {
                    vm.image = e.target.result;
                    vm.$store.commit('setFrontCover', vm.image);

                    //  stop loader
                };

                reader.readAsDataURL(file);
            },
        },
    };
</script>
