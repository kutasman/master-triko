<template>
    <div>
        <div class="field">
            <label class="label">Title</label>
            <div class="control">
                <input type="text" name="product-title" class="input" v-model="newProduct.title" />
            </div>
        </div>
        <div class="field">
            <label class="label">Factory</label>

            <div class="control">
                <span class="select">
                <select v-model="newProduct.factory_id">
                    <option v-for="factory in factories" :value="factory.id">{{ factory.name }}</option>
                </select>
                </span>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <span class="button" @click="createProduct">Create</span>
            </div>
        </div>
    </div>
</template>

<style></style>

<script>

    export default {
        props: ['products', 'factories'],
        data(){
            return {
                newProduct: {
                    title:'',
                    factory_id: ''
                }
            }
        },
        methods: {
            createProduct(){
                axios.post('/admin/products', this.newProduct)
                    .then(response => {
                        this.products.push(response.data);

                    });
            }
        },
        computed: {},
        mounted() {
        },
        components: {}
    }
</script>
