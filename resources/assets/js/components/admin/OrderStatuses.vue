<template>
    <div class="row">


        <div class="col-xs-12 col-sm-8">
            <ul class="list-group">
                <li  v-for="(status, index) in statuses" class="list-group-item">
                    <strong>{{ status.name }}</strong>, desc: {{ status.description }}, slug: {{ status.slug }}

                    <div class="btn-group btn-group-xs pull-right">
                        <button @click="editStatus(index)" class="btn btn-warning">edit</button>
                        <button @click.prevent="deleteStatus(index)" class="btn btn-danger">delete</button>

                    </div>
                </li>
            </ul>
        </div>
        <div class="col-xs-12 col-sm-4">
            <h3>Create new status</h3>

            <div :class="{'has-error': errors.create.name }" class="form-group">
                <label for="name" class="control-label">Name</label>
                <input v-model="newStatus.name" type="text" class="form-control" id="name" placeholder="Name">
                <span v-if="errors.create.name" v-text="errors.create.name[0]" class="help-block"></span>
            </div>
            <div :class="{'has-error': errors.create.description }" class="form-group">
                <label for="description" class="control-label">Description</label>
                <input v-model="newStatus.description" type="text" class="form-control" id="description" placeholder="Description">
                <span v-if="errors.create.description" v-text="errors.create.description[0]" class="help-block"></span>

            </div>
            <div :class="{'has-error': errors.create.slug }" class="form-group">
                <label for="slug" class="control-label">Slug</label>
                <input v-model="newStatus.slug" type="text" class="form-control" id="slug" placeholder="Slug">
                <span v-if="errors.create.slug" v-text="errors.create.slug[0]" class="help-block"></span>

            </div>

            <button @click.prevent="createStatus" class="btn btn-primary pull-right" >create</button>


        </div>
        <div class="modal fade" id="edit-status">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Edit Status</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="control-label">Name</label>
                            <input v-model="editable.name" type="text" class="form-control" id="name" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="description" class="control-label">Description</label>
                            <input v-model="editable.description" type="text" class="form-control" id="description" placeholder="Description">
                        </div>
                        <div class="form-group">
                            <label for="slug" class="control-label">Slug</label>
                            <input v-model="editable.slug" type="text" class="form-control" id="slug" placeholder="Slug">
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button @click="updateStatus(editable.id)" type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>


</template>

<style></style>

<script>
    export default {
        props: ['orderStatuses'],
        data(){
            return {
                statuses: this.orderStatuses,
                editableIndex: null,
                newStatus:{
                    name: '',
                    description: '',
                    slug: '',
                },
                errors: {
                    create: {},
                    update: {}
                }
            }
        },
        methods: {
            createStatus(){
                axios.post('order-statuses', this.newStatus)
                    .then((response) => {
                        if (200 == response.status){
                            console.log(response.data);

                            this.statuses.push(response.data);
                        }
                    })
                    .catch((error) => {
                        console.log(error.response.data);
                        this.errors.create = error.response.data;

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
                        console.log(error.response.data);
                    });
            },
            editStatus(index){
                console.log(index);
                this.editableIndex = index;
                $('#edit-status').modal();
            },
            updateStatus(id){
                axios.put('order-statuses/' + id, this.editable)
                    .then((response) => {
                        if (200 == response.status){
                            this.editableIndex = null;
                            $('#edit-status').modal('toggle');
                        }
                    })
                    .catch((error) => {
                        this.errors.update = error.response.data;
                    });
            }
        },
        computed: {
            editable () {

                return (null !== this.editableIndex) ? this.statuses[this.editableIndex] : {name:'',description:'', slug:''};
            }
        },
        mounted() {
            console.log('mounted');
            console.log(this.statuses);
        }
    }
</script>
