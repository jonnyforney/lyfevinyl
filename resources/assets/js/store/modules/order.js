import actions from './actions/order-actions.js'
import getters from './getters/order-getters.js'
import mutations from './mutations/order-mutations.js'

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
        ]
    }
}