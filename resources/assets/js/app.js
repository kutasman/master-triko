
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('../../../node_modules/select2/dist/js/select2.min');
require('../../../node_modules/chosen-js/chosen.jquery');
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('checkout', require('./components/Checkout.vue'));
Vue.component('factory', require('./components/Factory/Factory.vue'));

//Vuex
import Vuex from 'vuex';

Vue.use(Vuex);

const factory = {
    state: {
        product: {},
        factory: {},
        modificators:[]
    },
    mutations: {
        setProduct(state, p){
            state.product = p;
        },
        setFactory(state, factory){
            state.factory = factory;
            state.product = _.first(factory.products);
        },
        syncModificator(state, mod){
            let index = _.findIndex(state.modificators, {id:mod.id});
            if ( index >= 0){
                state.modificators.splice(index, 1, mod);
            } else {
                state.modificators.push(mod);
            }
        }
    },
    actions: {  },
    getters: {
        products(state){
            return state.factory.products;
        }
    }
};


const store = new Vuex.Store({
    modules: {
        f: factory,
    }
});


const app = new Vue({
    el: '#app',
    store
});
