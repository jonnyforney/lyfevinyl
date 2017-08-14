<template>
  <section v-if="current_step.show" key="songs">
    <headline :heading="current_step.headline" :subhead="current_step.subhead"></headline>
    <div class="row song-upload">
      <div class="col-md-6" v-for="side in sides">
        <p class="lvds-headline--tertiary margin-bottom-30">Side {{side.side}}</p>
        <div v-for="(song, index) in side.songs">
          <div class="lvds-form__label-button-group">
            <div :for="side.side + index" for="vue-dropzone--songs">
              <div class="row">
                <div class="col-sm-1 lvds-form__label">
                  <p>{{ index+1 }}. </p>
                </div>
                <div class="col-sm-11">
                  <span v-if="song.picked" class="lvds-button"><span class="glyphicon glyphicon-ok"></span> {{ song.file }}</span>
                  <span v-else>
                    <dropzone
                      :id="side.side + index"
                      class="vue-dropzone--songs lvds-button"
                      url="/steps/media/action"
                      @vdropzone-sending="sending"
                      @vdropzone-success="success"
                      @vdropzone-removed-file="remove"
                      @change="onSongChange($event, song)"
                      useCustomDropzoneOptions
                      :dropzoneOptions="dropzoneConfig"
                      acceptedFileTypes= "audio/*"
                    >
                    </dropzone>
                  </span>
                </div>
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
        data: function() {
            return {
                dropzoneConfig: {
                    dictDefaultMessage: "Upload Song",
                }
            }
        },
        computed: {
            current_step() {
                return this.$store.state.display.step_songs;
            },
            name() {
                return this.$store.state.vinyl.name;
            },
            sides() {
                return this.$store.state.vinyl.sides;
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
                this.$store.commit('setSong', uploaded_file_path);
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
