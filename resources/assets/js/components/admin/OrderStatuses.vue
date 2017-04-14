<template>
    <div class="row">
        <div class="col-xs-12 col-sm-8">
            <ul class="list-group">
                <li v-for="(status, index) in statuses" class="list-group-item">
                    <strong>{{ status.name }}</strong>, desc: {{ status.description }}, slug: {{ status.slug }}
                    <button @click.prevent="deleteStatus(index)" class="btn btn-xs btn-danger pull-right">delete</button>
                </li>
            </ul>
        </div>
        <div class="col-xs-12 col-sm-4">
            <h3>Create new status</h3>

            <div class="form-group">
                <label for="name" class="control-label">Name</label>
                <input v-model="newStatus.name" type="text" class="form-control" id="name" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="description" class="control-label">Description</label>
                <input v-model="newStatus.description" type="text" class="form-control" id="description" placeholder="Description">
            </div>
            <div class="form-group">
                <label for="slug" class="control-label">Slug</label>
                <input v-model="newStatus.slug" type="text" class="form-control" id="slug" placeholder="Slug">
            </div>

            <button @click.prevent="createStatus" >create</button>


        </div>
    </div>
</template>

<style></style>

<script>
    export default {
        data(){
            return {
                statuses: [],
                newStatus:{
                    name: '',
                    description: '',
                    slug: '',
                },
                errors: []
            }
        },
        methods: {
            createStatus(){
                axios.post('order-statuses', this.newStatus)
                    .then((response) => {
                        if (200 == response.status){

                            this.statuses.push(response.data);
                        }
                    })
                    .catch((error) => {
                        console.log(error.response.data);
                        this.errors = error.response.data;
                });
            },
            deleteStatus(index){
                axios.delete('order-statuses/' + this.statuses[index].id)
                    .then((response) => {
                        if( 200 == response.status){
                            this.statuses.splice(index,1);
                        }
                    })
                    .catch((error) => {

                    });
            }
        },
        computed: {},
        mounted() {
            console.log('mounted');
            axios.get('order-statuses')
                .then((response) => {
                    this.statuses = response.data;
                })
                .catch((error) => {
                    console.log(error.response.data);
                })
        }
    }
</script>
