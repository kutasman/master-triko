<template>
    <div class="field">
        <label class="label">Select product</label>
        <div class="control">
            <div @click="toggleModal" class="button is-primary">{{ product.title }}</div>
        </div>

        <div :class="{'is-active': activeModal}"  class="modal is-fluid">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Select product</p>
                    <button @click="toggleModal" class="delete"></button>
                </header>
                <section class="modal-card-body">

                    <div class="media" v-for="p in products">
                        <div class="media-content">
                            <a @click="setProduct(p)"><h4 class="is-4">
                                {{ p.title }}
                            </h4></a>
                        </div>
                    </div>


                </section>
                <footer class="modal-card-foot">
                    <a @click="toggleModal" class="button">Cancel</a>
                </footer>
            </div>
        </div>

    </div>
</template>

<style></style>

<script>

    export default {
        props: [],
        data(){
            return {
                activeModal: false
            }
        },
        methods: {
            setProduct(product){
                this.$store.commit('setProduct', product);
                this.toggleModal();
            },
            toggleModal(){
                this.activeModal = ! this.activeModal;
            }
        }
        ,
        computed: {
            products(){

               return this.$store.state.f.factory.products;

            },
            product(){

               return this.$store.state.f.product;

            }
        },
        watch:{
            selectedProduct(){
                console.log('change');
            }
        },
        mounted() {
        },
        components: {}
    }
</script>
