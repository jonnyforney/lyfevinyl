<template>
<section v-if="current_step.show" class="text-center">
  <headline :heading="name" :subhead="current_step.subhead"></headline>
  <div class="row">
    <div class="col-md-9 col-center">
      <div class="row">
        <div class="image-upload col-md-6">
          <p class="lvds-headline--tertiary">Front Cover</p>
          <div class="row margin-bottom-30">
            <div class="col-md-12">
                <dropzone 
                  id="frontcoverZone" 
                  url="/steps/cover" 
                  :headers="headers"
                  :thumbnailHeight="200"
                  :thumbnailWidth="200"
                  @vdropzone-sending="sending"
                  @vdropzone-success="success"
                  @vdropzone-removed-file="remove"
                ></dropzone>
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
  <stepcontrolbuttons></stepcontrolbuttons>
</section>
</template>

<script>
    import Headline from './Headline';
    import Dropzone from 'vue2-dropzone';
    import StepControlButtons from './StepControlButtons';
    import lv_functions from '../mixins/lv-functions.js';

    export default {
        name: 'covers',
        props: [],
        mixins: [lv_functions],
        components: {
            Headline,
            'stepcontrolbuttons': StepControlButtons,
            Dropzone
        },
        data: function() {
            return {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }
        },
        computed: {
            current_step() {
                return this.$store.state.step_covers;
            },
            name() {
                return this.$store.state.name;
            },
            front_cover_path() {
                return this.$store.state.front_cover_path;
            }
        },
        methods: {
            sending: function(file, xhr, formData) {
                formData.append('method', 'upload');
            },
            success(file) {
                let uploaded_file_path = JSON.parse(file.xhr.response).path;
                this.$store.commit('setFrontCoverPath', uploaded_file_path);
            },
            remove(file, error, xhr) {
                axios.post('/steps/cover', {
                        method: 'remove',
                        path: this.front_cover_path
                    })
                    .then((response) => {
                        console.log(response)
                    })
                    .catch((response) => {
                        console.log(response)
                    });
            }
        }
    };
</script>