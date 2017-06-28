/**
 * Created by kutas on 6/7/17.
 */

import Cart from '../Cart';
import Steps from './Steps';
import Contacts from './Contacts';
import Shipping from './Shipping';
import Payment from './Payment';
import Validator from './Validator';

export default class Checkout {

    constructor (shippings, payments, cart){

        this.cart = new Cart(cart);

        this.steps = new Steps({
            steps: ['contacts', 'shipping', 'payment', 'confirm', 'finish'],
            defaultStep: 'contacts',
        });

        this.contacts = new Contacts();

        this.validator = new Validator('checkout/validate/');

        this.shipping = new Shipping(shippings);

        this.payment = new Payment(payments);
    }

    validate(){

        this.validator.validate( this.steps.current, this.getObjectForValidation( this.steps.current ).getDataForValidation() )
            .then(res => {
                console.log(res.status);
                this.steps.nextStep();
            })
            .catch(errors => {
                console.log(errors);
            });
    }

    createOrder(){
        axios.post('checkout/confirm-order', this.getOrderData())
            .then((res => {
                if (res.status === 200){
                    this.steps.set('finish');
                }
            }))
            .catch(error => {
                console.log(error.response.data);
            })
    }

    getObjectForValidation(step){
        return this[step];
    }

    getOrderData(){
        return {

        }
    }
}