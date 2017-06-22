/**
 * Created by kutas on 6/22/17.
 */
export default class BaseRepository{
    constructor(apiKey){
        this.baseUrl = 'https://api.novaposhta.ua/v2.0/json/';
        this.apiKey = apiKey;
    }

    removeDefaultAxiosHeaders(){
        axios.defaults.headers.common = [];
    }

    restoreDefaultAxiosHeaders(){
        axios.defaults.headers.common = {
            'X-CSRF-TOKEN': window.Laravel.csrfToken,
            'X-Requested-With': 'XMLHttpRequest',
        };
    }

    createQueryData(model_name, method_name, prop){
        return {
            modelName: model_name,
            calledMethod: method_name,
            methodProperties: prop,
            apiKey: this.apiKey
        }
    }
}