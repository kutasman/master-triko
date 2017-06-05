
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


class Referee {

    constructor(rules){

        this.rules = rules;

    }


    isModDisabled(mod_id, modificators){

        let results = [];

        let rules = this.getRelevantRules(mod_id, 'disabled');

        if (rules.length && modificators.length){

            _.forEach(rules, rule => {
                if (!_.isUndefined(this.getModificator(rule.toggle_id, modificators))){

                    results.push(this.getModificator(rule.toggle_id, modificators).value === rule.toggle_option_id);

                } else {
                    results.push(false);
                }
            });

        }

        return results.includes(true);

    }

    getAccordance(modificators){


        return _.map(this.rules, rule => {
            if (!_.isUndefined(this.getModificator(rule.toggle_id, modificators))){

                return this.getModificator(rule.toggle_id, modificators).value === rule.toggle_option_id;

            } else {

                return false;

            }
        })
    }

    getModificator(mod_id, modificators){

        return _.find(modificators, mod => { return mod.mod.id === mod_id});

    }

    getRelevantRules(mod_id, action){

        return this.rules.filter(rule => {

            return mod_id === rule.target_id && rule.action === action;

        });
    }

}

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

            console.log(index);

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
