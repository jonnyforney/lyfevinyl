import actions from './actions/display-actions.js'
import getters from './getters/display-getters.js'
import mutations from './mutations/display-mutations.js'

export default {
    // namespaced: true,
    actions,
    getters,
    mutations,
    state: {
        "steps": [
            "album_name",
            "songs",
            "covers",
            "shipping",
            "payment",
            "preview"
        ],
        "current_step": "album_name",
        "progress": 0,
        "step_album_name": {
            "headline": "Choose an album name.",
            "subhead": "What would you like to name your customized album?",
            "infobox": "",
            "show": true
        },
        "step_songs": {
            "headline": "Upload your songs.",
            "subhead": "<strong>Important:</strong> Make sure you own the music. Please use .wav, .flac, .mp3, or .m4a as the file types.",
            "show": false
        },
        "step_covers": {
            "headline": "Add your album art.",
            "subhead": "This is going to be a wonderful record. Let's add some images for the album art now.",
            "show": false
        },
        "step_shipping": {
            "headline": "Shuh-ship it real good.",
            "subhead": "Where should we send this beautiful creation?",
            "show": false
        },
        "step_payment": {
            "headline": "Dolla dolla bills, y'all.",
            "subhead": "Show me da money.",
            "show": false
        },
        "step_preview": {
            "headline": "Let's make sure everything looks correct.",
            "subhead": "Double check that everything is looking swell. Feel free to go back and change anything before moving forward.",
            "show": false
        }
    }
}
