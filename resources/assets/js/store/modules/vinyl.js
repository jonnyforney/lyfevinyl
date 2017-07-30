import actions from './actions/vinyl-actions.js'
import getters from './getters/vinyl-getters.js'
import mutations from './mutations/vinyl-mutations.js'

export default {
    // namespaced: true,
    actions,
    getters,
    mutations,
    state: {
        "customer_id": null,
        "order_id": null,
        "name": "",
        "front_cover_path": "",
        "sides": [{
                "side": "a",
                "songs": [{
                        "path": "",
                        "side": "",
                        "track": "",
                        "picked": false
                    },
                    {
                        "path": "",
                        "picked": false
                    },
                    {
                        "path": "",
                        "picked": false
                    },
                    {
                        "path": "",
                        "picked": false
                    },
                    {
                        "path": "",
                        "picked": false
                    }
                ]
            },
            {
                "side": "b",
                "songs": [{
                        "path": "",
                        "picked": false
                    },
                    {
                        "path": "",
                        "picked": false
                    },
                    {
                        "path": "",
                        "picked": false
                    },
                    {
                        "path": "",
                        "picked": false
                    },
                    {
                        "path": "",
                        "picked": false
                    }
                ]
            }
        ]
    }
}