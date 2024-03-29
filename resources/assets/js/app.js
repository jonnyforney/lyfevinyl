/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

//  addons
window.swal = require('sweetalert2');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import store from './store';

Vue.component('home', require('./components/Home.vue'));
Vue.component('steps', require('./components/Steps.vue'));
Vue.component('progress-bar', require('./components/ProgressBar.vue'));
Vue.component('loading', require('./components/Loading.vue'));

const app = new Vue({
    el: '#app',
    store
});
