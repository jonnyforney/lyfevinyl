import Vue from 'vue';
import Vuex from 'vuex';
import actions from './actions'
import getters from './getters'
import mutations from './mutations'
import display from './modules/display'
import order from './modules/order'
import vinyl from './modules/vinyl'
import shipping from './modules/shipping'
import payment from './modules/payment'

Vue.use(Vuex);

export default new Vuex.Store({
    actions,
    getters,
    mutations,
    modules: {
        display,
        order,
        vinyl,
        shipping,
        payment
    },
    state: {}
});