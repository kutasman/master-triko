/**
 * Created by kutas on 6/7/17.
 */

import Steps from './Steps';
import Contacts from './Contacts';
import Shipping from './Shipping';
import Validator from './Validator';

export default class Checkout {

    constructor (shippings, payments, cart){

        this.steps = new Steps({
            steps: ['contacts', 'shipping', 'payment', 'confirm', 'success'],
            defaultStep: 'shipping',
        });

        this.contacts = new Contacts();

        this.validator = new Validator('checkout/validate/');

        this.shipping = new Shipping(shippings);
    }

    validate(){

        this.validator.validate( this.steps.current, this.getObjectForValidation( this.steps.current ).getDataForValidation() )
            .then(res => {
                console.log(res.status);
                this.steps.nextStep();
                alert('go to ' + this.steps.current + ' step');
            })
            .catch(errors => {
                console.log(errors);
            });
    }

    getObjectForValidation(step){
        return this[step];
    }
}