<template>
  <section v-if="current_step.show" key="songs">
    <headline :heading="name" :subhead="current_step.subhead"></headline>
    <div class="row song-upload margin-top-30">
        <div class="col-md-2"></div>
        <div class="col-md-4" v-for="side in sides">
          <p class="lvds-headline--tertiary">Side {{side.side}}</p>
          <div v-for="(song, index) in side.songs">
            <div class="row">
              <div class="col-md-12">
                  <div class="lvds-form__label-button-group">
                    <label :for="side.side + index" for="vue-dropzone--songs" class="lvds-form__label">{{ index+1 }}.
                      <a v-if="song.picked" class="lvds-button"><span class="glyphicon glyphicon-ok"></span> {{ song.file }}</a>
                      <span v-else>
                        <dropzone
                          :id="side.side + index"
                          class="vue-dropzone--songs lvds-button lvds-button--pink lvds-form__button"
                          url="/steps/media/action"
                          @vdropzone-sending="sending"
                          @vdropzone-success="success"
                          @vdropzone-removed-file="remove"
                          @change="onSongChange($event, song)"
                          useCustomDropzoneOptions
                          :dropzoneOptions="dropzoneConfig"
                        >
                        </dropzone>
                      </span>
                    </label>
                  </div>
              </div>
            </div>
            <!-- <div class="row">
              <div class="col-md-12">
                  <input
                  :id="side.side + index"
                  type="file"
                  @change="onSongChange($event, song)"
                  />
              </div>
            </div> -->
          </div>
        </div>
        <div class="col-md-2"></div>
    </div>
    <back-next-btns></back-next-btns>
  </section>
</template>

<script>
    import Headline from './Headline';
    import StepControlButtons from './StepControlButtons';
    import Dropzone from 'vue2-dropzone';
    import lv_functions from '../mixins/lv-functions.js';

    export default {
        name: 'songs',
        props: [],
        mixins: [lv_functions],
        components: {
            'headline': Headline,
            'back-next-btns': StepControlButtons,
            Dropzone
        },
        data: function () {
          return {
            dropzoneConfig : {
              dictDefaultMessage : "Upload Song",
             }
          }
        },
        computed: {
            current_step() {
                return this.$store.state.display.step_songs;
            },
            name() {
                return this.$store.state.order.name;
            },
            sides() {
                return this.$store.state.order.sides;
            },
            idGen() {
              return this.songId += 1;
            },
        },
        methods: {
            onSongChange(e, song) {
                var songFiles = e.target.files || e.dataTransfer.files;
                if (!songFiles.length)
                    return;

                this.createSong(songFiles[0], song);
            },

            createSong(file, song) {
                // var song = new Song();
                var reader = new FileReader();

                reader.fileName = file.name;
                reader.onload = (e) => {
                    //vm.song = e.target.result;
                    song.picked = true;
                    song.file = file.name;
                };
                reader.readAsDataURL(file);

                this.$store.commit('setSong', this.sides);
            },
            sending: function(file, xhr, formData) {
                formData.append('method', 'upload');
            },
            success(file) {
                let uploaded_file_path = JSON.parse(file.xhr.response).path;
                this.$store.commit('setSongPath', uploaded_file_path);
            },
            remove(file, error, xhr) {
                axios.post('/steps/media/action', {
                        method: 'remove',
                        path: this.song_path
                    })
                    .then((response) => {
                        console.log(response)
                    })
                    .catch((response) => {
                        console.log(response)
                    });
            }
        },
    };
</script>
