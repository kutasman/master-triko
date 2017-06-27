/**
 * Created by kutas on 6/27/17.
 */
export default class Payment{

    constructor(payments){
        this.payments = payments;

        this.selected = _.first(this.payments);
    }

    getDataForValidation() {
        return {
            payment_type: this.selected.slug,
        }
    }

}