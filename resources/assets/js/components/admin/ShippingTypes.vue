<template>

    <div class="row">
        <div class="col-xs-12 col-sm-8">
            <div class="list-group">
                <a v-for="(type, index) in types" href="#" class="list-group-item">
                    <strong>ID: {{ type.id }} </strong>
                    <strong>{{ type.name }}</strong>
                    <br/>

                    <p class="text-muted">description:{{ type.description }}</p>
                    <p class="text-muted">slug: {{ type.slug }}</p>

                    <button @click.prevent="deleteType(index)" class="btn btn-xs btn-danger">delete</button>

                </a>
            </div>
        </div>


        <div class="col-xs-12 col-sm-4">

            <form action="admin/shipping-types/store" method="post" role="form">
                <legend>Create shipping type</legend>

                <div class="form-group">
                    <label for="name"></label>
                    <input v-model="newType.name" type="text" class="form-control" name="name" id="name" placeholder="Name...">
                    <span v-if="formErrors['name']" class="error text-danger">{{ formErrors['name'][0] }}</span>
                </div>
                <div class="form-group">
                    <label for="description" class="control-label">Description</label>
                    <input v-model="newType.description" type="text" class="form-control" id="description" placeholder="Description">
                    <span v-if="formErrors['description']" class="error text-danger">{{ formErrors['description'][0] }}</span>

                </div>

                <div class="form-group">
                    <label for="slug" class="control-label">Slug</label>
                    <input v-model="newType.slug" type="text" class="form-control" id="slug" placeholder="Slug" >
                    <span v-if="formErrors['slug']" class="error text-danger">{{ formErrors['slug'][0] }}</span>

                </div>
                <div class="form-group">
                    <label for="meta[apiKey]" class="col-sm-2 control-label">Api Key</label>
                    <input v-model="newType.meta.apiKey" type="text" class="form-control" name="meta[apiKey]" id="meta[apiKey]" placeholder="Meta[apiKey]">
                    <span v-if="formErrors['meta.apiKey']" class="error text-danger">{{ formErrors['meta.apiKey'][0] }}</span>

                </div>


                <!--META FIELDS-->


                <button @click.prevent="createType" type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>


    </div>
</template>

<style>

    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active in <2.1.8 */ {
        opacity: 0
    }
</style>

<script>
    export default {
        data(){
            return {
                types: [],
                newType: {
                    name: '',
                    description: '',
                    slug: '',
                    meta: {
                        apiKey: '',
                    }
                },
                formErrors: {}
            }
        },
        methods: {
            createType(){

                axios.post('shipping-types', this.newType)
                    .then((response) => {
                        this.types.push(response.data);
                    })
                    .catch((error) => {
                       if (422 == error.response.status){
                           this.formErrors = error.response.data;
                       }
                    });
            },
            deleteType(index){
                axios.delete('shipping-types/' + this.types[index].id)
                    .then((response) => {
                        this.types.splice(index,1);
                    })
                    .catch((error) => {
                        console.log(error);
                    })
            }
        },
        computed: {

        },
        mounted() {
            console.log('shipping types component mounted');

            axios.get('shipping-types')
                .then((response) => {
                    this.types = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        }
    }
</script>
