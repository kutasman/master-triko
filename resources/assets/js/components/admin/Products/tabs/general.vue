<template>
    <div>
        <div class="field">
            <label class="label">Title</label>
            <div class="control">
                <input type="text" class="input" v-model="product.title" placeholder="title"/>
            </div>
        </div>
        <div class="field">
            <label class="label">Price</label>
            <div class="control">
                <input type="number" class="input" v-model="product.price" placeholder="price"/>
            </div>
        </div>

        <div class="field">
            <label class="label">Factory</label>
            <p class="control">
                    <span class="select">
                      <select v-model="product.factory_id">
                        <option v-for="factory in factories" :value="factory.id" v-text="factory.name"></option>
                      </select>
                    </span>
            </p>
        </div>

        <div class="field">
            <label class="label">Active</label>
            <div class="control">
                <div @click="product.active = !product.active" class="button" :class="{'is-success' : product.active}">Active</div>
            </div>
        </div>

        <slot></slot>
    </div>
</template>

<style></style>

<script>

    export default {
        props: ['product', 'factories'],
        data(){
            return {}
        },
        methods: {},
        computed: {},
        mounted() {
        },
        components: {}
    }
</script>
