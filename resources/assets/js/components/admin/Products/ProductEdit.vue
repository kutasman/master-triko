<template>
    <div>
        <h3 class="title">Edit {{ product.title }}</h3>

        <div class="tabs">
            <ul>
                <li @click="setTab('general')" :class="{'is-active': isTab('general')}"><a>General</a></li>
                <li @click="setTab('modificators')" :class="{'is-active': isTab('modificators')}"><a>Modificators</a></li>

            </ul>
        </div>

        <component :is="tab" :product="product" :factories="factories">
            <div class="field">
                <label></label>
                <div class="control">
                    <div :class="{'is-loading' : busy}" @click="updateProduct(tab)" class="button is-primary">update</div>
                </div>
            </div>


        </component>


    </div>
</template>

<style></style>

<script>

    import General from './tabs/general.vue';
    import Modificators from './../Modifcators/Modificators.vue';
    export default {
        props: ['productInit', 'factories'],
        data(){
            return {
                tab:'general',
                busy: false,
                product: {},
                factoryMods:[]
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
            updateProduct(tab){
                this.busy = true;
                switch (tab){
                    case 'general':
                        axios.put('/admin/products/' + this.product.id, this.product)
                            .then(response => {
                                this.busy = false;
                            })
                            .catch(error => {
                                console.log(error.response.data);
                                this.busy = false;

                            });
                        break;
                    case 'modificators':
                        axios.post('modificators', {modificators:this.productModIds})
                            .then(response => {
                                this.busy = false;
                                console.log(response.data);

                            })
                            .catch(error => {
                                console.log(error.response.data);
                                this.busy = false;

                            });
                }


            },


        },
        watch:{
            tab(){
                if ('modificators' === this.tab){

                }
            }
        },
        computed: {
            productModIds(){
                return this.product.modificators.map(mod => {
                    return mod.id;
                });
            }
        },
        mounted() {
            this.product = this.productInit;
            this.$store.commit('setProduct', this.productInit);
        },
        components: {
            General,
            Modificators,
        }
    }
</script>
