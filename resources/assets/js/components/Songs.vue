<template>
  <section v-if="current_step.show" key="songs">
    <headline :heading="current_step.headline" :subhead="current_step.subhead"></headline>
        <dropzone
            id="songs"
            class="vue-dropzone--songs"
            url="/file/action"
            @vdropzone-sending-multiple="sending"
            @vdropzone-success-multiple="success"
            @vdropzone-removed-file="remove"
            acceptedFileTypes= ".mp3, .m4a, .wav, .flac"
            uploadMultiple= true
        >
        </dropzone>
          <!-- <div class="row">
            <div class="col-md-12">
                <input
                :id="side.side + index"
                type="file"
                @change="onSongChange($event, song)"
                />
            </div>
          </div> -->
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
        },
        methods: {
           
            sending: function(files, xhr, formData) {
                formData.append('method', 'upload');
            },
            success(files) {
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
