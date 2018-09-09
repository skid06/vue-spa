
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import {routes} from './routes';
import MainApp from './components/MainApp'
import store from './store'
// import axios from '../../node_modules/axios';
import {initialize} from './services/route-checker'

Vue.use(VueRouter);
Vue.use(Vuex);

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
        MainApp
    }
});
