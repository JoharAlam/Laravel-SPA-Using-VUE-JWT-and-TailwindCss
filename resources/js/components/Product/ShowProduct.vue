<template>
  <div class="bg-gray-100 p-8 rounded-xl shadow-xl">
    <div class="md:h-auto bg-white pl-8 pr-8 pt-4 w-auto rounded-xl shadow-xl">
      <div class="flex pl-3 pr-3 justify-between">
        <div class="text-xl text-gray-600">
          Product Detail
        </div>
      </div><hr class="mt-2 bg-gray-300">
    	<div class="flex justify-between p-2">
        <div class="justify-center">
          <img :src="/storage/+data.image" class="rounded-xl" width="400" alt="Product Image"/>
        </div>
        <div class="bg-gray-200 rounded-xl p-4">
          <div class="flex justify-center">
            <div class="text-justify">
              <h6>Product Name:</h6>
              <h6>Product Category:</h6>
              <h6>Product Price:</h6>
              <h6>Product Quality:</h6>
              <h6>Product Retailer:</h6><br>
            </div>
            <div  class="pl-12 text-justify">
              <h6 v-if="data.product">{{data.product}}</h6><h6 v-else="">{{data.product}}</h6>
              <h6 v-if="data.product">{{data.category}}</h6><h6 v-else="">{{data.category}}</h6>
              <h6 v-if="data.latest_price">{{data.latest_price}}</h6><h6 v-else="">N/A</h6>
              <h6 v-if="data.quality">{{data.quality}}</h6><h6 v-else="">N/A</h6>
              <h6 v-if="data.retailer_name">{{data.retailer_name}}</h6><h6 v-else="">N/A</h6>
            </div>
          </div>
          <h6 class="text-left">Product Description:</h6>
          <textarea class="bg-gray-400 rounded shadow-xl w-90 p-3" style="height: 200px;" v-if="data.description"> {{data.description}}</textarea>
          <textarea class="bg-gray-400 rounded shadow-xl w-90 p-3" style="height: 200px;" v-else=""> N/A</textarea>
        </div>
      </div>
      <input type="hidden" id="id" class="bg-blue-500" >
      </br>
    </div>
  </div>
</template>

<script>
  export default {
    data(){
      return{
        data: {
          id: '',
          product: '',
          category: '',
          description: '',
          image: '',
          latest_price: '',
          quality: '',
          retailer_name: ''
        },
        errors:[]
      }
    },
    mounted(){
      var productid = localStorage.getItem('productID');
      console.log(productid);
      $('#id').val(productid);
      axios.post('http://vuespajwt.test/show/inventory/product', {productid}).then((res) =>{
        console.log('Product fetched successfully');
        console.log(res.data);
        this.data.id = res.data.id;
        this.data.product = res.data.product;
        this.data.category = res.data.category;
        this.data.description = res.data.description;
        this.data.image = res.data.image;
        this.data.latest_price = res.data.latest_price;
        this.data.quality = res.data.quality;

        var retailer_id = res.data.retailer_id;
        axios.post('http://vuespajwt.test/get/retailer', {retailer_id}).then((res) =>{
          console.log('Retailer fetched successfully');
          console.log(res.data);
          this.data.retailer_name = res.data.retailer_name;
        })
        .catch((error)=>{
          this.errors = error.response.data.errors;
        })
      })
      .catch((error)=>{
        this.errors = error.response.data.errors;
      })
    }
  }
</script>

