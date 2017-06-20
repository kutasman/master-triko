<template>
    <div>
        <div  class="form-group">
            <label for="city" class="col-sm-2 control-label">City</label>
            <div  class="col-sm-10">

                <input placeholder="Find your city" autocomplete="off" v-model="searchCityString" type="text" name="city" id="city" class="form-control" value="" title="" required="required">


                <ul v-if="filtering" class="list-group">
                    <li class="list-group-item city-candidate"  v-for="(city, index) in filteredCities" @click="chooseCity(city)">{{ city.DescriptionRu }}</li>
                </ul>
            </div>

        </div>


        <div v-if="cityRef" class="form-group">
            <label for="warehouse" class="col-sm-2 control-label">Warehouse</label>
            <div class="col-sm-10">
                <select v-model="meta.warehouse" name="warehouse" id="warehouse" class="form-control">
                    <option v-for="warehouse in warehouses" :value="warehouse"> {{ warehouse.DescriptionRu }} </option>
                </select>
            </div>
        </div>
    </div>
</template>

<style>
    .city-candidate:hover{
        background-color: #e7e9ee;
        cursor: pointer;
    }
</style>

<script>
    export default {
        props: ['shipping', 'meta'],
        data(){
            return {
                queryUrl: 'https://api.novaposhta.ua/v2.0/json/',
                axiosInstance: {},
                searchCityString:'',
                cities: {},
                warehouses:{},
                filteredCities: {},
                filtering: false,
                cityRef: '',
                response: {

                }
            }
        },
        methods: {
            chooseCity(city){
              this.meta.city = city;
              this.cityRef = city.Ref;
              this.filteredCities = {};
              //this.searchCityString = city.DescriptionRu;
              this.filtering = false;
              this.getWarehouses();
            },
            getCity: _.debounce(function () {
                console.log('find city by string ' + this.searchCityString);

                this.axiosInstance.post(this.queryUrl, this.getQuery('Address', 'getCities', {"FindByString": this.searchCityString}))
                    .then((response) => {
                        if( 200 == response.status){
                            this.cities = response.data.data;
                        }
                    })

            }, 2000),
            getCities(){
                axios.get('nova-poshta-cities')
                    .then((response) => {
                        if (204 == response.status){
                            console.log('no cities');
                            this.updateCities();
                        } else if (200 == response.status){
                            this.cities = response.data;
                        }
                    })
            },
            getWarehouses(){
                this.axiosInstance.post(this.queryUrl, this.getQuery('Address', 'getWarehouses', {'CityRef': this.meta.city.Ref}))
                    .then((response) =>{
                        this.warehouses = response.data.data;
                    })
            },
            updateCities(){
                this.axiosInstance.post(this.queryUrl, this.getQuery('Address','getCities' ))
                    .then((response) => {
                        this.cities = response.data.data;
                        this.response = response;
                        this.saveCities();
                    })
                    .catch((error) => {
                    });
            },
            saveCities(){
                axios.put('nova-poshta-cities', {np_cities: this.cities})
                    .then((response) => {

                    })
                    .catch((error) => {
                        console.log(error.response.data);
                    })

            },
            filterCities: _.debounce(function(){
                this.filtering = true;
                if ('' == this.searchString){
                    this.filteredCities = {};
                } else {
                    console.log('filter with ' + this.searchCityString);
                    this.filteredCities = this.cities.filter((city) =>{
                        return city.Description.search( new RegExp('^' + this.searchString, 'i')) != -1 || city.DescriptionRu.search( new RegExp('^' + this.searchString, 'i')) != -1;
                    });
                }

            }, 400),
            getQuery(model_name, method_name, prop){
                return {
                    modelName: model_name,
                    calledMethod: method_name,
                    methodProperties: prop,
                    apiKey: this.apiKey
                }
            }
        },
        watch:{
            searchCityString: function () {
              this.filterCities();
            },
            'meta.city': function(){
                this.meta.warehouse = {};
                this.getWarehouses();
            },
            'meta.warehouse': function () {

            },

        },
        computed: {
            apiKey(){
                return this.shipping.meta.apiKey;
            },
            searchString(){
                return _.toLower( this.searchCityString );
            },

        },
        mounted() {
            let instance = axios.create();
            instance.defaults.headers.common = [];

            this.axiosInstance = instance;
            this.getCities();

        },
    }
</script>
