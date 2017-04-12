
<template>
  <div class="row">
    <div class="col-xs-12 col-sm-8">
      <div class="list-group">
        <div v-for="(payment, index) in payments" class="list-group-item">
            {{ payment.name }}
            <button @click.prevent="destroy(index)" type="button" name="button" class="btn btn-xs btn-danger pull-right">delete</button>
        </div>

      </div>
    </div>
    <div class="col-xs-12 col-sm-4">
          <h2>Create Paymetn type</h2>

          <div class="form-group">
            <label for="name">Name</label>
            <input v-model="payment.name" type="text" class="form-control" id="name" placeholder="name">
            <p class="help-block">Help text here.</p>
          </div>

          <div class="form-group">
            <label for="description">description</label>
            <input v-model="payment.description" type="text" class="form-control" id="description" placeholder="Descriprion">
            <p class="help-block">Help text here.</p>
          </div>

          <div class="form-group">
            <label for="slug">slug</label>
            <input v-model="payment.slug" type="text" class="form-control" id="slug" placeholder="slug">
            <p class="help-block">Help text here.</p>
          </div>

          <button @click.prevent="create" type="button" name="button">Create</button>


    </div>

  </div>
</template>

<style></style>

<script>
    export default {
        data(){
            return {
              payments: [],
              payment:{
                name: '',
                description: '',
                slug: '',
              }
            }
        },
        methods: {
          create(){
            axios.post('payment-types', this.payment)
              .then((response) => {
                console.log(response.data);
                this.payments.push( response.data);
              })
              .catch((error) => {
                console.log(error);
              });
          },
          destroy(index){
            console.log('delete' + index);
            axios.delete('payment-types/' + this.payments[index].id)
              .then((response) => {
                console.log(response);

                  this.payments.splice(index,1);
                
              })
              .catch((error) => {
                console.log(error.response.data);
              })
          }
        },
        computed: {},
        mounted() {
            console.log('mounted');
            axios.get('payment-types')
              .then((response) => {
                console.log(response.data);
                this.payments = response.data;
              })
              .catch((error) => {
                console.log(error);
              })
        }
    }
</script>
