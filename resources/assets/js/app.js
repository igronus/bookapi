
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Vuex = require('vuex');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('search', require('./components/Search.vue'));

Vue.use(Vuex);
const store = new Vuex.Store({
    state: {
        count: 0,
        items: [],
        fired: false,
        search_string: 'test'
    },
    mutations: {
        clear (state) {
            state.items = [];
            state.fired = false;
            state.total = 0;

            console.log('Store cleared.');
        },

        populate (state, {items, total}) {
            state.fired = true;
            state.items = items;
            state.total = total;

            console.log('Store populated.');
        },
    }
});


const app = new Vue({
    el: '#app',
    store
});
