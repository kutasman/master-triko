/**
 * Created by kutas on 6/21/17.
 */
export default class Contacts {
    constructor(){
        this.first_name = '';
        this.email = '';
        this.phone = '';
    }
    getDataForValidation(){
        return {
            email: this.email,
            first_name: this.first_name,
            phone: this.phone,
        }
    }
}