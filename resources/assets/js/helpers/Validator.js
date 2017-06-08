/**
 * Created by kutas on 6/7/17.
 */
export default class Validator{

    constructor(base_path = ''){
        this.base_path = base_path;
        this.errors = [];
    }
    validate(step, object){
        return new Promise((resolve, reject) => {
            axios.post(this.actionPath(step), object)
                .then(res => {
                    if (200 === res.status){
                        this.clearErrors();
                        resolve(res.status);
                    }
                })
                .catch(error => {
                    this.errors = error.response.data;
                    reject(error.response.data);
                });
        });


    }
    actionPath( step ){
        return this.base_path + step;
    }
    clearErrors(){
        this.errors = [];
    }
    hasErrors(){
        return !_.isEmpty(this.errors);
    }
    hasError(field_name){
        return (field_name in this.errors);
    }
    showError(field_name){
        if ( this.hasError(field_name)){
            return _.first(this.errors[field_name]);
        }
    }
}