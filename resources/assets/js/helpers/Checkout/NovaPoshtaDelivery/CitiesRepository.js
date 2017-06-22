/**
 * Created by kutas on 6/22/17.
 */
import BaseRepository from './BaseRepository';
export default class CitiesRepository extends BaseRepository{
    constructor(apiKey){
        super(apiKey);
        this.cities = [];
    }

    retrieveCities(){
        axios.get('nova-poshta-cities')
            .then((response) => {
                if (204 === response.status){
                    console.log('no cities');
                    this.getCities();
                } else if (200 === response.status){
                    this.cities = response.data;
                }
            });
    }

    getCities(){
        this.removeDefaultAxiosHeaders();
        axios.post(this.baseUrl, this.createQueryData('Address','getCities' ))
            .then((response) => {
                this.cities = response.data.data;
                //this.response = response;
                this.cacheCities();
            })
            .catch((error) => {
            });
        this.restoreDefaultAxiosHeaders();
    }
    cacheCities(){
        axios.put('nova-poshta-cities', {np_cities: this.cities})
            .catch((error) => {
                console.log(error.response.data);
            })

    }

    filter(key){
        return this.cities.filter((city) => {
            return city.Description.search( new RegExp('^' + key, 'i')) !== -1 || city.DescriptionRu.search( new RegExp('^' + key, 'i')) !== -1;
        });

    }
}