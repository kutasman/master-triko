<template>
    <div>
        <h3 class="title">Edit {{ product.title }}</h3>

        <div class="tabs">
            <ul>
                <li @click="setTab('general')" :class="{'is-active': isTab('general')}"><a>General</a></li>

            </ul>
        </div>

        <div v-show="isTab('general')">
            <div class="field">
                <label class="label">Title</label>
                <div class="control">
                    <input  @change="updateProduct(product)" @chan type="text" class="input" v-model="product.title" placeholder="title"/>
                </div>
            </div>
            <div class="field">
                <label class="label">Price</label>
                <div class="control">
                    <input @change="updateProduct(product)"  type="number" class="input" v-model="product.price" placeholder="price"/>
                </div>
            </div>

            <div class="field">
                <label class="label">Factory</label>
                <p class="control">
                    <span class="select">
                      <select @change="updateProduct(product)" v-model="product.factory_id">
                        <option v-for="factory in factories" :value="factory.id" v-text="factory.name"></option>
                      </select>
                    </span>
                </p>
            </div>

            <div class="field">
                <label class="label">Active</label>
                <div  class="control">
                    <div @click="updateProduct(product)" class="button" :class="{'is-success' : product.active}">Active</div>
                </div>
            </div>

        </div> <!--tab general-->

    </div>
</template>

<style></style>

<script>

    export default {
        props: ['product', 'factories'],
        data(){
            return {
                tab:'general',
                busy: false

            }
        },
        methods: {
            isTab(name){
                return this.tab === name;
            },
            setTab(name){
                this.tab = name;
            },
            updateProduct: _.debounce((product) => {
                axios.put('/admin/products/' + product.id, product)
                    .then(response => {

                    })
                    .catch(error => {
                        console.log(error.response.data);
                    })

            }, 500),


        },
        watch:{
            product(){
                this.updateProduct();
            }
        },
        computed: {},
        mounted() {
        },
        components: {}
    }
</script>
