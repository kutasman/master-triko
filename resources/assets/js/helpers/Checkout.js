/**
 * Created by kutas on 6/7/17.
 */

import Steps from './Steps';
export default class Checkout {

    constructor (config){
        this.steps = new Steps(config.steps.names, config.steps.default_step);

        this.customer = {
            first_name:'',
            email: '',
            phone: ''
        };
    }

    nextStep(step){

        
        console.log('verification');
        console.log('switch step to ' + step);
    }
}