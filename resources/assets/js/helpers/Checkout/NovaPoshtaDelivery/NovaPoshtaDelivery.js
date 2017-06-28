/**
 * Created by kutas on 6/22/17.
 */
import CitiesRepository from './CitiesRepository';
import WarehousesRepository from './WarehousesRepository';
export default class NovaPoshta{
    constructor(apiKey){
        this.apiKey = apiKey;

        this.citiesRepository = new CitiesRepository(this.apiKey);
        this.citySearchKey = '';
        this.filteredCities = [];
        this.city = {};

        this.warehousesRepository = new WarehousesRepository(this.apiKey);
        this.warehouse = {};


        this.citiesRepository.retrieveCities();
    }

    getCities(){
        return this.citiesRepository.cities;
    }
    setCity(city){
        this.city = city;
        this.filteredCities = [];
        this.citySearchKey = city.DescriptionRu;
        this.warehousesRepository.retrieveWarehouses(this.city.Ref);
    }
    removeCity(){
        this.city = {};
        this.warehouse = {};
        this.warehousesRepository.clear();
    }
    citySelected(){
        return !_.isEmpty(this.city);
    }

    getWarehouses(){
        return this.warehousesRepository.get();
    }

    filterCities(){
        this.filteredCities = (_.isEmpty(this.citySearchKey)) ? {} : this.citiesRepository.filter(this.citySearchKey);
    }






}