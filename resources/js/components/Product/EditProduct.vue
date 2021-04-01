<template>
  <div class="bg-gray-100 p-8 rounded-xl shadow-xl">
    <div class="md:h-auto bg-white pl-8 pr-8 pt-4 w-auto rounded-xl shadow-xl">
      <div class="flex pl-3 pr-3 justify-between">
        <div class="text-xl text-gray-600">
          Edit Product
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

      <div v-if="data.url" class="card-body">
        <div align="center" class="mb-3">
          <img :src="data.url" id="picture_preview" style="display: block; margin-left: auto; margin-right: auto;" width="100" class="rounded" alt="Product Image">
          <button class="rounded text-center text-white shadow-xl bg-blue-500 hover:bg-blue-700 py-2 px-3 font-bold mt-3" onClick="document.getElementById('picture').click();">Change</button>
        </div>
      </div>
      <div v-else="data.product_pic_pic" class="card-body">
        <div align="center" class="mb-3">
          <img :src="/storage/+data.product_pic" id="picture_preview" style="display: block; margin-left: auto; margin-right: auto;" width="100" class="rounded" alt="Product Image">
          <button class="rounded text-center text-white shadow-xl bg-blue-500 hover:bg-blue-700 py-2 px-3 font-bold mt-3" onClick="document.getElementById('picture').click();">Change</button>
        </div>
      </div>

      <form @submit.prevent="updateProduct">
        <input type="file" id="picture" name="picture" autocomplete="product_image" @change="onFileChange" hidden>

        <div class="flex justify-between ml-12 mr-12">
          <div class="relative">
            <label for="product" class="uppercase text-blue-300 text-xs font-bold absolute pl-3 pt-2">Product</label>
            <input type="product" class="pt-4 w-full rounded pl-3 bg-blue-800 text-white placeholder-gray-300 outline-none focus:bg-blue-700" style="width: 400px; height:60px" id="product" placeholder="Product Name" autocomplete="product" autofocus disabled>
          </div>
          <div class="relative">
            <label for="category" class="uppercase text-blue-300 text-xs font-bold absolute pl-3 pt-2">Category</label>
            <input type="category" class="pt-4 w-full rounded pl-3 bg-blue-800 text-white placeholder-gray-300 outline-none focus:bg-blue-700" style="width: 400px; height:60px" id="category" placeholder="Category" autocomplete="category" autofocus disabled>
          </div>
        </div>

        <div class="flex pt-3 justify-between ml-12 mr-12">
          <div class="relative">
            <label for="retailer_name" class="uppercase text-blue-300 text-xs font-bold absolute pl-3 pt-2">Retailer</label>
            <input type="retailer_name" class="pt-4 w-full rounded pl-3 bg-blue-800 text-white placeholder-gray-300 outline-none focus:bg-blue-700" style="width: 400px; height:60px" id="retailer_name" placeholder="Retailer Name" autocomplete="retailer_name" autofocus disabled>
          </div>
          <div class="relative">
            <label for="price" class="uppercase text-blue-300 text-xs font-bold absolute pl-3 pt-2">Latest Price</label>
            <input type="price" class="pt-4 w-full rounded pl-3 bg-blue-800 text-white placeholder-gray-300 outline-none focus:bg-blue-700" style="width: 400px; height:60px" id="price" placeholder="Latest Price" autocomplete="price" autofocus>
          </div>
        </div>

        <div class="flex pt-3 justify-between ml-12 mr-12">
          <div class="relative">
            <label for="quality" class="uppercase text-blue-300 text-xs font-bold absolute pl-3 pt-2">Quality</label>
            <input type="quality" class="pt-4 w-full rounded pl-3 bg-blue-800 text-white placeholder-gray-300 outline-none focus:bg-blue-700" style="width: 940px; height:60px" id="quality" placeholder="Product Quality" autocomplete="quality" autofocus>
          </div>
        </div>

        <div class="flex pt-3 ml-12 mr-12">
          <div class="relative">
            <label for="description" class="uppercase text-blue-300 text-xs font-bold absolute pl-3 pt-2">Description</label>
            <textarea type="description" class="pt-4 rounded pl-3 bg-blue-800 text-white placeholder-gray-300 outline-none focus:bg-blue-700" style="width: 940px; height:200px" id="description" placeholder="Product Description" autocomplete="description" autofocus></textarea>
          </div>
        </div>
        
        <div class="pt-8 ml-12 mr-12 text-center">
          <button  type="submit" class="w-80 uppercase rounded text-center text-white bg-blue-500 hover:bg-blue-700 py-2 px-3 font-bold shadow-xl">
            Update
          </button>
        </div>
      </form>
      <input type="hidden" id="id" class="bg-blue-500">
      <input type="hidden" id="rid" class="bg-blue-500">
      </br>
    </div>
  </div>
</template>

<script>
  export default {
    data(){
      return{
        data: {
          url: null,
          product_pic: null
        },
        formFields: {
          picture: null
        },
        errors:[],
        success: ''
      }
    },
    mounted(){
      var productid = localStorage.getItem('productID');
      $('#id').val(productid);
      axios.post('http://vuespajwt.test/edit/inventory/product', {productid}).then((res) =>{
        console.log('Product fetched successfully');
        console.log(res.data);
        $("#product").val(res.data.product);
        $("#category").val(res.data.category);
        $("#price").val(res.data.latest_price);
        $("#quality").val(res.data.quality);
        $("#description").val(res.data.description);
        $("#rid").val(res.data.retailer_id);
        this.data.product_pic = res.data.image;

        var retailer_id = res.data.retailer_id;
        axios.post('http://vuespajwt.test/get/retailer', {retailer_id}).then((res) =>{
          console.log('Retailer fetched successfully');
          console.log(res.data);
          $("#retailer_name").val(res.data.retailer_name);
        })
        .catch((error)=>{
          this.errors = error.response.data.errors;
        })
      })
      .catch((error)=>{
        this.errors = error.response.data.errors;
      })
    },
    methods:{
      updateProduct(){
        let formData = new FormData();

        formData.append("picture", this.formFields.picture);
        formData.append("id", $("#id").val());
        formData.append("product", $("#product").val());
        formData.append("category", $("#category").val());
        formData.append("latest_price", $("#price").val());
        formData.append("description", $("#description").val());
        formData.append("quality", $("#quality").val());
        formData.append("retailer_id", $("#rid").val());
        formData.append("retailer_name", $("#retailer_name").val());

        axios.post('/update/product', formData).then(() =>{
          this.success = null;
          this.errors = [];
          this.success = 'Product updated successfully';
        }).catch((error)=>{
          this.success = null;
          this.errors = error.response.data.errors;
        })
      },
      onFileChange(event){
        this.formFields.picture = event.target.files[0];

        const file = event.target.files[0];
        this.data.url = URL.createObjectURL(file);
      }
    }
  }
</script>

