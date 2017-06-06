
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


Vue.component('example', require('./components/Example.vue'));
Vue.component('checkout', require('./components/Checkout/Checkout.vue'));
Vue.component('factory', require('./components/Factory/Factory.vue'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
//Vuex
import Vuex from 'vuex';
import Referee from './helpers/Referee';

Vue.use(Vuex);

const factory = {
    state: {
        product: {},
        factory: {},
        referee: {},
        modificators:[]
    },
    mutations: {
        setProduct(state, p){
            state.product = p;
        },
        setFactory(state, factory){
            state.factory = factory;
        },
        setReferee(state, rules){
            state.referee = new Referee(rules);
        },

        syncModificator(state, mod){


            let index = _.findIndex(state.modificators, (m) =>{
                return m.mod.id === mod.mod.id;

            });

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

        },

        isDisabled: (state) => (id) => {

            return state.referee.isModDisabled(id, state.modificators);

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
