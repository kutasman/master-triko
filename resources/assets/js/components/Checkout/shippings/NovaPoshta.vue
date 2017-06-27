<template>
    <div>
        <div class="field">
            <label class="label">City</label>
            <div class="control" v-if="citySelected">
                <input autocomplete="off" class="input" type="text" v-model="np.citySearchKey" @input="np.removeCity()"/>
            </div>
            <div v-else class="control" >

                <input  placeholder="Find your city" autocomplete="off" v-model="np.citySearchKey"  @input="filterCities()" type="text" title="city" class="input" :class="{'is-danger': checkout.validator.hasError('data.city')}" required="required">

                <p class="help is-danger" v-show="checkout.validator.hasError('data.city')" >Select city</p>

                <ul class="list-group">
                    <li class="list-group-item city-candidate"  v-for="(city, index) in np.filteredCities" @click="np.setCity(city)">{{ city.DescriptionRu }}</li>
                </ul>
            </div>
        </div>


        <div v-if="citySelected && warehousesReady" class="field">
            <label for="warehouse" class="label">Warehouse</label>
            <div class="control">
                <div class="select is-small" :class="{'is-danger': checkout.validator.hasError('data.warehouse')}">
                    <select v-model="np.warehouse" name="warehouse" id="warehouse">
                        <option v-for="warehouse in np.getWarehouses()" :value="warehouse"> {{ warehouse.DescriptionRu }} </option>
                    </select>
                </div>
                <p class="help is-danger" v-show="checkout.validator.hasError('data.warehouse')">Select warehouse</p>
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
        props: ['shipping', 'checkout'],
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
            filterCities: _.debounce(function() {
                this.np.filterCities();
            }, 400),

            chooseCity(city){
                this.meta.city = city;
                this.checkout.shipping.data.city = city;
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

            getWarehouses(){
                this.removeDefaultAxiosHeaders();
                axios.post(this.queryUrl, this.getQuery('Address', 'getWarehouses', {'CityRef': this.meta.city.Ref}), {headers: {}})
                    .then((response) =>{
                        this.warehouses = response.data.data;
                    });
                this.restoreDefaultAxiosHeaders();
            },


            getQuery(model_name, method_name, prop){
                return {
                    modelName: model_name,
                    calledMethod: method_name,
                    methodProperties: prop,
                    apiKey: this.apiKey
                }
            },
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
                console.log(this.meta.warehouse);
            },

        },
        computed: {
            apiKey(){
                return this.shipping.meta.apiKey;
            },
            searchString(){
                return _.toLower( this.searchCityString );
            },
            meta(){
                return this.shipping.meta;
            },
            np(){
                return this.checkout.shipping.np;
            },
            citySelected(){
                return !_.isEmpty(this.np.city);
            },
            warehousesReady(){
                return !_.isEmpty(this.np.getWarehouses());
            }

        },
        mounted() {


            this.checkout.shipping.createNovaPoshtaApiInstance(this.shipping.meta.apiKey);

        },
    }
</script>
