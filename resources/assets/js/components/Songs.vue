<template>
  <section v-if="current_step.show" key="songs">
    <headline :heading="current_step.headline" :subhead="current_step.subhead"></headline>
        <dropzone
            id="songs"
            class="vue-dropzone--songs"
            url="/file/action"
            :headers="headers"
            @vdropzone-sending="sending"
            @vdropzone-sending-multiple="sending"
            @vdropzone-success="success"
            @vdropzone-success-multiple="success"
            @vdropzone-removed-file="remove"
            acceptedFileTypes= ".mp3, .m4a, .wav, .flac"
            uploadMultiple=true
        >
        </dropzone>
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
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }
        },
        computed: {
            current_step() {
                return this.$store.state.display.step_songs;
            },
            name() {
                return this.$store.state.vinyl.name;
            }
        },
        methods: {
            sending(files, xhr, formData) {
                formData.append('method', 'upload');
                formData.append('type', 'song');
            },
            success(files, response) {
                let uploaded_file_path = JSON.parse(files.xhr.response).path;
                this.$store.commit('addSong', uploaded_file_path);
            },
            remove(file, error, xhr) {
                axios.post('/file/action', {
                        method: 'remove',
                        path: JSON.parse(file.xhr.response).path
                    })
                    .then((response) => {
                        console.log(response)
                        let uploaded_file_path = JSON.parse(file.xhr.response).path;
                        this.$store.commit('removeSong', uploaded_file_path);
                    })
                    .catch((response) => {
                        console.log(response)
                    });
            }
        },
    };
</script>