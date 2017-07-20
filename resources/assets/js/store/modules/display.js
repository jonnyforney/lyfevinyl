import actions from './actions/display-actions.js'
import getters from './getters/display-getters.js'
import mutations from './mutations/display-mutations.js'

export default {
    actions,
    getters,
    mutations,
    state: {
        "steps": [
            "album_name",
            "songs",
            "covers",
            "preview"
        ],
        "current_step": "album_name",
        "progress": 0,
        "step_album_name": {
            "headline": "Let's get started!",
            "subhead": "What's the best way to start personalizing your vinyl? Giving it a title, of course! You can choose to have this name on the front of your album cover.",
            "show": true
        },
        "step_songs": {
            "headline": "",
            "subhead": "Let's upload the songs now. <br>Make sure you own the music and it must be in .mp3 format.",
            "show": false
        },
        "step_covers": {
            "headline": "",
            "subhead": "This is going to be a wonderful record. <br>Let's add some images for the album art now.",
            "show": false
        },
        "step_preview": {
            "headline": "Let's preview your vinyl.",
            "subhead": "Double check that everything is looking swell. Feel free to go back and change anything before moving forward.",
            "show": false
        }
    }
}