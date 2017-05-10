<template>
    <div>
        <h3 class="title">Edit {{ product.title }}</h3>

        <div class="tabs">
            <ul>
                <li @click="setTab('general')" :class="{'is-active': isTab('general')}"><a>General</a></li>

            </ul>
        </div>

        <component :is="tab" :product="product" :factories="factories">
            <div class="field">
                <label></label>
                <div class="control">
                    <div :class="{'is-loading' : busy}" @click="updateProduct" class="button is-primary">update</div>
                </div>

            </div>
        </component>

        <div v-show="isTab('general')">


        </div> <!--tab general-->



    </div>
</template>

<style></style>

<script>

    import General from './tabs/general.vue';
    export default {
        props: ['productInit', 'factories'],
        data(){
            return {
                tab:'general',
                busy: false,
                product: {},

            }
        },
        methods: {
            isTab(name){
                return this.tab === name;
            },
            setTab(name){
                this.tab = name;
            },
            toggleActive(){
                this.product.active = !this.product.active ;
            },
            updateProduct(){
                this.busy = true;
                axios.put('/admin/products/' + this.product.id, this.product)
                    .then(response => {
                        this.busy = false;
                    })
                    .catch(error => {
                        console.log(error.response.data);
                        this.busy = false;

                    })

            },


        },
        watch:{
            product(){
                this.updateProduct(this.product);
            }
        },
        computed: {},
        mounted() {
            this.product = this.productInit;
        },
        components: {
            General
        }
    }
</script>
