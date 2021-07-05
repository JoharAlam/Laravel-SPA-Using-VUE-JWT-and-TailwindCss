gray-300<template>
  <div class="bg-gray-100 p-8 rounded-xl shadow-xl">
    <div class="md:h-auto bg-white pl-8 pr-8 pt-4 w-auto rounded-xl shadow-xl">
      <div class="flex pl-3 pr-3 justify-between">
        <div class="text-xl text-gray-600">
          Add Purchase
        </div>
      </div><hr class="mt-2 bg-gray-300">

      <div v-if="success" class="alert alert-success">
        <strong>Success! </strong>{{success}}
      </div>
      <div v-for="error in errors">
        <div v-if="errors" class="alert alert-danger">
          <strong>Error: </strong>{{error}}
        </div>
      </div>

      <div class="flex pt-3 justify-between ml-12 mr-12">
        <div class="relative">
          <label for="retailer" class="uppercase text-blue-300 text-xs font-bold absolute pl-3 pt-2">Name</label>
          <input type="retailer" class="pt-4 w-full rounded pl-3 bg-blue-800 text-white placeholder-gray-300 outline-none focus:bg-blue-700" style="width: 400px; height:60px" v-model="form.retailer" placeholder="Retailer Name" autocomplete="name" autofocus>
        </div>
        <div class="relative">
          <label for="product" class="uppercase text-blue-300 text-xs font-bold absolute pl-3 pt-2">Product</label>
          <input type="product" class="pt-4 w-full rounded pl-3 bg-blue-800 text-white placeholder-gray-300 outline-none focus:bg-blue-700" style="width: 400px; height:60px" v-model="form.product" placeholder="Product Name" autocomplete="product" autofocus>
        </div>
      </div>

      <div class="flex pt-3 justify-between ml-12 mr-12">
        <div class="relative">
          <label for="category" class="uppercase text-blue-300 text-xs font-bold absolute pl-3 pt-2">Category</label>
          <input type="category" class="pt-4 w-full rounded pl-3 bg-blue-800 text-white placeholder-gray-300 outline-none focus:bg-blue-700" style="width: 400px; height:60px" 
          v-model="form.category" placeholder="Category" autocomplete="total" autofocus>
        </div>
        <div class="relative">
          <label for="purchase_rate" class="uppercase text-blue-300 text-xs font-bold absolute pl-3 pt-2">Price</label>
          <input type="purchase_rate" class="pt-4 w-full rounded pl-3 bg-blue-800 text-white placeholder-gray-300 outline-none focus:bg-blue-700" style="width: 400px; height:60px" v-model="form.purchase_rate" placeholder="Purchase rate/piece" autocomplete="purchase_rate" autofocus>
        </div>
      </div>

      <div class="flex pt-3 justify-between ml-12 mr-12">
        <div class="relative">
          <label for="quantity" class="uppercase text-blue-300 text-xs font-bold absolute pl-3 pt-2">quantity</label>
          <input type="quantity" class="pt-4 w-full rounded pl-3 bg-blue-800 text-white placeholder-gray-300 outline-none focus:bg-blue-700" style="width: 400px; height:60px" v-model="form.quantity" placeholder="Product Quantity" autocomplete="quantity" autofocus>
        </div>
        <div class="relative">
          <label for="payment" class="uppercase text-blue-300 text-xs font-bold absolute pl-3 pt-2">Payment</label>
          <input type="payment" class="pt-4 w-full rounded pl-3 bg-blue-800 text-white placeholder-gray-300 outline-none focus:bg-blue-700" style="width: 400px; height:60px" v-model="form.payment" placeholder="Amount Paid" autocomplete="payment" autofocus>
        </div>
      </div>
      
      <div class="pt-8 ml-12 mr-12 text-center">
        <button @click.prevent="storePurchase" type="submit" class="w-80 uppercase rounded text-center text-white bg-blue-500 shadow-xl hover:bg-blue-700 py-2 px-3 font-bold">
          Submit
        </button>
      </div>
      </br>
    </div>
  </div>
</template>

<script>
  export default{
    data(){
      return{
        form:{
          retailer: '',
          product: '',
          category: '',
          purchase_rate: '',
          quantity: '',
          payment: ''
        },
        errors:[],
        success: ''
      }
    },
    methods:{
      storePurchase(){
        axios.post('/store/purchase', this.form).then(() =>{
          this.success = '';
          this.errors = [];
          this.form.retailer = "";
          this.form.product = "";
          this.form.category = "";
          this.form.purchase_rate = "";
          this.form.quantity = "";
          this.form.payment = "";
          this.success = 'New purchase stored successfully'
        }).catch((error)=>{
          this.success = '';
          this.errors = [];
          this.errors = error.response.data.errors;
        })
      }
    }
  }
</script>
