<template>
  <section v-if="current_step.show">
    <headline :heading="current_step.headline" :subhead="current_step.subhead"></headline>
    <div class="row margin-top-30">
      <div class="image-upload col-md-6">
        <p class="lvds-headline--tertiary">Front Cover</p>
        <dropzone
          id="frontcoverZone"
          class="vue-dropzone--covers"
          url="/file/action"
          :headers="headers"
          :thumbnailHeight="250"
          :thumbnailWidth="250"
          @vdropzone-sending="sending"
          @vdropzone-success="success"
          @vdropzone-removed-file="remove"
          acceptedFileTypes= "image/*"
        >
        </dropzone>
      </div>
      <div class="col-md-6">
        <p class="lvds-headline--tertiary">Back Cover</p>
        <div class="row margin-bottom-30">
          <div class="col-md-12">
            <img src="http://placehold.it/250x250">
          </div>
        </div>
      </div>
    </div>
    <back-next-btns></back-next-btns>
  </section>
</template>

<script>
    import Headline from './Headline';
    import Dropzone from 'vue2-dropzone';
    import StepControlButtons from './StepControlButtons';
    import lv_functions from '../mixins/lv-functions.js';
    export default {
        mixins: [lv_functions],
        components: {
            Headline,
            'back-next-btns': StepControlButtons,
            Dropzone
        },
        data: () => {
            return {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }
        },
        computed: {
            current_step() {
                return this.$store.state.display.step_covers;
            },
            name() {
                return this.$store.state.vinyl.name;
            },
            front_cover_path() {
                return this.$store.state.vinyl.front_cover_path;
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
                axios.post('/file/action', {
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
