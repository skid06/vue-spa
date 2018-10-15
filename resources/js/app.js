
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import Vuex from 'vuex';
import {routes} from './routes';

import MainContainer from './components/MainContainer'
import store from './store'
// import axios from '../../node_modules/axios';
import {initialize} from './services/route-checker'
import VeeValidate from 'vee-validate'

Vue.use(VeeValidate)

Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(Vuetify);
Vue.use(require('vue-moment'));

const router = new VueRouter({
    routes,
    mode: 'history'
});

initialize(store, router)

const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
        MainContainer
    },
    template: '<MainContainer/>',
});
