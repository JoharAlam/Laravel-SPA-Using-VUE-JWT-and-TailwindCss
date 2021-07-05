<template>
  <div class="bg-gray-100 p-8 rounded-xl shadow-xl">
    <div class="md:h-auto bg-white pl-8 pr-8 pt-4 w-auto rounded-xl shadow-xl">
      <div class="flex pl-3 pr-3 justify-between">
        <div class="text-xl text-gray-600">
          Add Sale
        </div>
      </div><hr class="mt-2 bg-gray-300">

      <div v-if="success" class="alert alert-success">
        <strong>Success! </strong>{{success}}
      </div>
      <div v-if="invoice" class="alert alert-success">
        <strong>Success! </strong>{{invoice}}
      </div>
      <div v-for="error in errors">
        <div v-if="errors" class="alert alert-danger">
          <strong>Error: </strong>{{error}}
        </div>
      </div>

      <div class="flex pt-3 justify-between ml-12 mr-12">
        <div class="relative">
          <label for="customer" class="uppercase text-blue-300 text-xs font-bold absolute pl-3 pt-2">Name</label>
          <input type="customer" class="pt-4 w-full rounded pl-3 bg-blue-800 text-white placeholder-gray-300 outline-none focus:bg-blue-700" style="width: 400px; height:60px" v-model="form.customer" name="customer" placeholder="Customer Name" autocomplete="customer" autofocus/>
        </div>
        <div class="relative">
          <label for="product" class="uppercase text-blue-300 text-xs font-bold absolute pl-3 pt-2">Product</label>
          <select type="product" class="pt-4 w-full rounded pl-3 bg-blue-800 text-white placeholder-gray-300 outline-none focus:bg-blue-700" style="width: 400px; height:60px" v-model="form.product" placeholder="Product Name" autocomplete="product" autofocus>
            <option value="">Select Product</option>
            <option v-for="(product, index) in products" :value="product.product" v-bind:key="index">{{product.product}}</option>
          </select>
        </div>
      </div>

      <div class="flex pt-3 justify-between ml-12 mr-12">
        <div class="relative">
          <label for="product_retailer" class="uppercase text-blue-300 text-xs font-bold absolute pl-3 pt-2">Product Retailer</label>
          <select type="product_retailer" class="pt-4 w-full rounded pl-3 bg-blue-800 text-white placeholder-gray-300 outline-none focus:bg-blue-700" style="width: 400px; height:60px" v-model="form.product_retailer" placeholder="Retailer Name" autocomplete="retailer name" autofocus>
            <option value="">Select Retailer</option>
            <option v-for="(retailer, index) in retailers" :value="retailer.retailer_name" v-bind:key="index">{{retailer.retailer_name}}</option>
          </select>
        </div>
        <div class="relative">
          <label for="selling_rate" class="uppercase text-blue-300 text-xs font-bold absolute pl-3 pt-2">Price</label>
          <input type="selling_rate" class="pt-4 w-full rounded pl-3 bg-blue-800 text-white placeholder-gray-300 outline-none focus:bg-blue-700" style="width: 400px; height:60px" v-model="form.selling_rate" placeholder="Selling rate/piece" autocomplete="selling rate" autofocus>
        </div>
      </div>

      <div class="flex pt-3 justify-between ml-12 mr-12">
        <div class="relative">
          <label for="quantity" class="uppercase text-blue-300 text-xs font-bold absolute pl-3 pt-2">Quantity</label>
          <input type="quantity" class="pt-4 w-full rounded pl-3 bg-blue-800 text-white placeholder-gray-300 outline-none focus:bg-blue-700" style="width: 400px; height:60px" v-model="form.quantity" placeholder="Product Quantity" autocomplete="quantity" autofocus>
        </div>
        <div class="relative">
          <label for="payment" class="uppercase text-blue-300 text-xs font-bold absolute pl-3 pt-2">Payment</label>
          <input type="payment" class="pt-4 w-full rounded pl-3 bg-blue-800 text-white placeholder-gray-300 outline-none focus:bg-blue-700" style="width: 400px; height:60px" v-model="form.payment" placeholder="Payment Received" autocomplete="payment" autofocus>
        </div>
      </div>

      <div class="pt-8 ml-12 mr-12 text-center">
        <button @click.prevent="storeSale" type="submit" class="w-80 uppercase rounded text-center text-white shadow-xl bg-blue-500 hover:bg-blue-700 py-2 px-3 font-bold">
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
          customer: '',
          product: '',
          product_retailer: '',
          selling_rate: '',
          quantity: '',
          payment: '',
          sale_id: ''
        },
        retailers: [],
        products: [],
        errors:[],
        success: '',
        invoice: '',
        name: ''
      }
    },
    methods:{
      storeSale(){
        axios.post('/store/sale', this.form).then((res) =>{
          this.success = '';
          this.invoice = '';
          this.errors = [];
          this.form.sale_id = res.data.sale_id;
          
          if(res.data.success == 'done')
          {
            this.success = 'New sale stored successfully';
            console.log(this.form);

            axios.post('/invoice', this.form).then((res) =>{
              this.invoice = 'Invoice stored successfully';
            }).catch((error)=>{
              this.errors = error.response.data.errors;
            })
          }

          if(res.data.noStock == '')
          {
            this.errors = ['[ "Stock against product and retailer is not available. Please recheck entered data carefully." ]'];
          }

          if(res.data.zeroStock == 0)
          {
            this.errors = ['[ "Products is out of stock." ]'];
          }

          if(this.form.quantity > res.data.limitStock)
          {
            this.errors = ['[ "Entered quantity of stock exceeds available stock in inventory which is = ' + res.data.limitStock + '" ]'];
          }

        }).catch((error)=>{
          this.success = [];
          this.errors = [];
          this.errors = error.response.data.errors;
        })
      }
    },
    mounted() {
      axios.get('/get/retailers').then((res) =>{
          this.retailers = res.data;
      }).catch((error)=>{
        this.success = [];
        this.errors = [];
        this.errors = error.response.data.errors;
      })

      axios.get('/get/stock').then((res) =>{
        this.products = res.data;
      }).catch((error)=>{
        this.success = [];
        this.errors = [];
        this.errors = error.response.data.errors;
      })
    }
  }
</script>
