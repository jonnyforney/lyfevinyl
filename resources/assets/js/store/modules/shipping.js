import actions from './actions/shipping-actions.js'
import getters from './getters/shipping-getters.js'
import mutations from './mutations/shipping-mutations.js'

export default {
    // namespaced: true,
    actions,
    getters,
    mutations,
    state: {
        firstName: '',
        lastName: '',
        addressLineOne: '',
        addressLineTwo: '',
        addressCity: '',
        addressState: '',
        addressZip: '',
    }
}