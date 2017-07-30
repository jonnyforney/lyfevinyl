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