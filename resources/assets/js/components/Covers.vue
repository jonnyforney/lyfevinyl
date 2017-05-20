<template>
<section v-show="step_covers.show" class="text-center">
  <headline :heading="name" :subhead="step_covers.subhead"></headline>
  <div class="row">
    <div class="col-md-9 col-center">
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
              ^^ Upload Image ^^</input>
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
          <div class="row">
            <div class="col-md-12">
              <a class="lvds-button lvds-button--ghost-white lvds-form__button" href="#">Upload Image</a>
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
            return this.$store.state;
        },
        methods: {
            onImageChange(e, cover) {
                var imageFiles = e.target.files || e.dataTransfer.files;
                if (!imageFiles.length)
                    return;
                this.createImage(imageFiles[0], cover);
            },
            createImage(file, cover) {
                var image = new Image();
                var reader = new FileReader();
                var vm = this;

                reader.onload = (e) => {
                    vm.data[cover] = e.target.result;
                };
                reader.readAsDataURL(file);
            },
        },
        ready() {
            console.log('loaded')
        }
    };
</script>