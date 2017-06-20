/**
 * Created by kutas on 6/7/17.
 */

import Steps from './Steps';
import Contacts from './Contacts';
import Validator from './Validator';

export default class Checkout {

    constructor (shippings, payments, cart){

        this.steps = new Steps({
            steps: ['contacts', 'shipping', 'payment', 'confirm', 'success'],
            defaultStep: 'contacts',
        });

        this.contacts = new Contacts();

        this.validator = new Validator('checkout/validate/');

        /*this.shippings = config['shippings'];*/
    }

    validate(){

        this.validator.validate( this.steps.current, this.getObjectForValidation( this.steps.current ) )
            .then(status => {
                console.log(status);
                this.steps.nextStep()
            })
            .catch(errors => {
                console.log(errors);
            });

        /*return new Promise((resolve, reject) => {
            reject(['errors'])
        });*/
    }

    getObjectForValidation(step){
        return this[step];
    }
}