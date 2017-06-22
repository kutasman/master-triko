/**
 * Created by kutas on 6/22/17.
 */
import BaseRepository from './BaseRepository';
export default class WarehousesRepository extends BaseRepository{

    constructor(apiKey){
        super(apiKey);

        this.warehouses = [];
    }

    get(){
        return this.warehouses;
    }

    retrieveWarehouses(city_ref){
        this.clear();
        this.removeDefaultAxiosHeaders();
        axios.post(this.baseUrl, this.createQueryData('Address', 'getWarehouses', {'CityRef': city_ref}))
            .then((response) =>{
                this.warehouses = response.data.data;
            })
            .catch(error => {
                console.log(error.response.data);
            });
        this.restoreDefaultAxiosHeaders();

    }

    clear(){
        this.warehouses = [];
    }

}