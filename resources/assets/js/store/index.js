import Vue from 'vue';
import Vuex from 'vuex';
import actions from './actions'
import getters from './getters'
import mutations from './mutations'
import display from './modules/display'
import order from './modules/order'

Vue.use(Vuex);

export default new Vuex.Store({
    actions,
    getters,
    mutations,
    modules: {
        display,
        order
    },
    state: {
        "current_customer_id": null,
        "order_id": null,
        "name": "",
        "frontcover": "",
        "front_cover_path": "",
        "sides": [{
                "side": "a",
                "songs": [{
                        "file": "",
                        "side": "",
                        "track": "",
                        "picked": false
                    },
                    {
                        "file": "",
                        "picked": false
                    },
                    {
                        "file": "",
                        "picked": false
                    },
                    {
                        "file": "",
                        "picked": false
                    },
                    {
                        "file": "",
                        "picked": false
                    }
                ]
            },
            {
                "side": "b",
                "songs": [{
                        "file": "",
                        "picked": false
                    },
                    {
                        "file": "",
                        "picked": false
                    },
                    {
                        "file": "",
                        "picked": false
                    },
                    {
                        "file": "",
                        "picked": false
                    },
                    {
                        "file": "",
                        "picked": false
                    }
                ]
            }
        ],
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
        "step_shipping": {
            "headline": "",
            "subhead": "Where should we send this beautiful creation?",
            "show": false
        },
        "step_payment": {
            "headline": "Dolla dolla bills, y'all.",
            "subhead": "Show me da money.",
            "show": false
        },
        "step_preview": {
            "headline": "Let's preview your vinyl.",
            "subhead": "Double check that everything is looking swell. Feel free to go back and change anything before moving forward.",
            "show": false
        }

    }
});
