<template>
  <div class="bg-gray-100 p-8 rounded-xl shadow-xl">
    <div class="md:h-auto bg-white pl-8 pr-8 pt-4 w-auto rounded-xl shadow-xl">
      <div class="flex pl-3 pr-3 justify-between">
        <div class="text-xl text-gray-600">
          Products
        </div>
      </div><hr class="mt-2 bg-gray-300">
  	
      <div class="row rounded-md">
        <div class="col rounded-md">
          <table id="products-table" class="display table-bordered nowrap rounded-md bg-blue-500 text-white" cellspacing="0" width="100%">
            <thead class="text-center">
              <tr>
                <th>Sr #</th>
                <th>Product</th>
                <th>Category</th>
                <th>Description</th>
                <th>Quality</th>
                <th>Latest Price</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody class="text-center text-black">
            </tbody>
          </table>
        </div>
      </div>
      </br>
    </div>
  </div>
</template>

<script>
  //Bootstrap and jQuery libraries
import 'bootstrap/dist/css/bootstrap.min.css';
import 'jquery/dist/jquery.min.js';

//Datatable Modules
import "datatables.net/js/jquery.dataTables.min.js"
import "datatables.net-dt/css/jquery.dataTables.min.css"

//Jquery and Axios Module
import $ from 'jquery'; 
import axios from 'axios';

  export default {
    mounted() {
      let products = [];

      this.dataTable = $("#products-table").DataTable();
      const url = "http://vuespajwt.test/inventory/products";
      fetch(url)
      .then((res) => res.json())
      .then((data) => {
        data.forEach((item) => {
          products.push(item);
        });
        var i = 1;
        products.forEach((product) => {
          this.dataTable.row
            .add([i++, product.product, product.category, product.description, product.quality, product.latest_price, '<div class="flex justify-center"><a onClick="show('+product.id+');" class="shadow-xl"><svg class="h-5 w-8 p-1 bg-blue-500 rounded hover:bg-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" fill="currentColor"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z" /><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/></svg></a>        <a onClick="edit('+product.id+');" class="shadow-xl"><svg class="ml-2 h-5 w-8 p-1 bg-yellow-500 rounded hover:bg-yellow-600" viewBox="0 0 18 18" fill="currentColor"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" /><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" /></svg></a></div>'])
            .draw(false);
        });
      });
    }
  }
</script>

