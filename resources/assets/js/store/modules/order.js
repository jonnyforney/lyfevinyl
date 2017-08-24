import actions from './actions/order-actions.js'
import getters from './getters/order-getters.js'
import mutations from './mutations/order-mutations.js'

export default {
    // namespaced: true,
    actions,
    getters,
    mutations,
    state: {
        status: ''
    }
}