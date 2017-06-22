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
        let data = {
            shipping: this.selected,
        };
        //If NP - add data about city and warehouse
        if ('nova_poshta' === this.selected.slug){
            data.data = {
                city: this.np.city,
                warehouse: this.np.warehouse,
            };
        }
        return data;
    }

    createNovaPoshtaApiInstance(apiKey){
        this.np = new NovaPoshtaApi(apiKey);
    }

}