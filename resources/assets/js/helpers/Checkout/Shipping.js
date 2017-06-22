/**
 * Created by kutas on 6/21/17.
 */

import NovaPoshtaApi from './NovaPoshtaDelivery/NovaPoshtaDelivery';
export default class Shipping {

    constructor(shippings){
        this.shippings = shippings;
        this.data = {};
        this.selected = {};
        this.np = {};
    }

    getDataForValidation(){
        return {
            shipping: this.selected,
            data: this.data,
        };
    }

    createNovaPoshtaApiInstance(apiKey){
        this.np = new NovaPoshtaApi(apiKey);
    }

}