/**
 * Created by kutas on 6/7/17.
 */

import Steps from './Steps';
export default class Checkout {

    constructor (config){
        this.steps = new Steps(config.steps.names, config.steps.default_step);

        this.contacts = {
            first_name:'',
            email: '',
            phone: ''
        };

        this.validator = config['validator'];
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