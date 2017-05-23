<template>
    <section v-show="current_step.show" class="text-center">
        <headline :heading="name" :subhead="current_step.subhead"></headline>
        <div class="row song-upload">
            <div class="col-md-2"></div>
            <div class="col-md-4" v-for="side in sides">
            <p class="lvds-headline--tertiary">Side {{side.side}}</p>
            <div v-for="(song, index) in side.songs">
                <div class="row"> 
                <div class="col-md-12">
                    <span class="lvds-form__label-button-group">
                    <label :for="side.side + index" class="lvds-form__label">{{ index+1 }}.
                        <a v-if="song.picked" class="lvds-button lvds-button--ghost-blue-light lvds-form__button">{{ song.file }}</a>
                        <a v-if="!song.picked" class="lvds-button lvds-button--ghost-blue-light lvds-form__button">Upload Song</a>
                    </label>
                    </span>
                </div>
                </div>
                <div class="row">
                <div class="col-md-12">
                    <input
                    :id="side.side + index"
                    type="file"
                    @change="onSongChange($event, 'side.side + index')"
                    />              
                </div>
                </div>
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
    import lv_functions from '../mixins/lv-functions.js';

    export default {
        name: 'songs',
        props: [],
        mixins: [lv_functions],
        components: {
            'headline': Headline,
            'back-next-btns': StepControlButtons
        },
        data: function() {
            return {
                name: this.$store.state.name,
                current_step: this.$store.state.step_songs,
                sides: this.$store.state.sides
            }
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
                var vm = this;

                reader.fileName = file.name;
                reader.onload = (e) => {
                    vm.data[song] = e.target.result;
                    song.picked = true;
                    song.file = file.name;
                };
                reader.readAsDataURL(file);
            },
        },
        ready() {
            console.log('loaded')
        }
    };
</script>