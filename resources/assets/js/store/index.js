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
        "customer_id": null,
        "order_id": null
    }
});