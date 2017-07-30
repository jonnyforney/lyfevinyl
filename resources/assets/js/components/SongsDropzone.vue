<template>
  <dropzone
    :id="songId"
    v-model="songId"
    class="lvds-button lvds-button--ghost-blue-light lvds-form__button"
    url="/steps/media/action"
    :headers="headers"
    :thumbnailHeight="40"
    :thumbnailWidth="150"
    @vdropzone-sending="sending"
    @vdropzone-success="success"
    @vdropzone-removed-file="remove"
  >
    <a class=""><span class="glyphicon glyphicon-plus"></span>  Upload Song</a>
  </dropzone>
</template>

<script>
    import Dropzone from 'vue2-dropzone';
    export default {
        components: {
            Dropzone
        },
        data: function() {
            return {
                image: '',
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                songId: 1,
            }
        },
        computed: {
          name() {
              return this.$store.state.name;
          },
          sides() {
              return this.$store.state.sides;
          },
          idGen() {
            return this.songId += 1;
          },
        },
        methods: {
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
        }
    };
</script>
