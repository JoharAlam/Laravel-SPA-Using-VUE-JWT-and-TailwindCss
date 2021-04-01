<template>
  <div class="bg-gray-100 p-8 rounded-xl shadow-xl">
    <div class="md:h-auto bg-white pl-8 pr-8 pt-4 w-auto rounded-xl shadow-xl">
      <div class="flex pl-3 pr-3 pt-3 justify-between">
        <div class="text-xl text-gray-600">
          Monthly Record
        </div>
      </div><hr class="mt-2 bg-gray-300">
      
      <div class="row rounded-md">
        <div class="col rounded-md">
          <table id="monthlySales-table" class="display table-bordered nowrap rounded-md bg-blue-500 text-white" cellspacing="0" width="100%">
            <thead class="text-center">
              <tr>
                <th>Sr #</th>
                <th>Product</th>
                <th>Category</th>
                <th>Quantity Sold</th>
                <th>Monthly Sale</th>
                <th>First Sale</th>
                <th>Last Sale</th>
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
    let monthlySales = [];

    this.dataTable = $("#monthlySales-table").DataTable();
    const url = "http://vuespajwt.test/monthly";
    fetch(url)
    .then((res) => res.json())
    .then((data) => {
      data.forEach((item) => {
        monthlySales.push(item);
      });
      var i = 1;
      monthlySales.forEach((monthlySale) => {
        this.dataTable.row
          .add([i++, monthlySale.product, monthlySale.category, monthlySale.quantity_sold, monthlySale.monthly_sale, monthlySale.first_sale, monthlySale.last_sale])
          .draw(false);
      });
    });
  }
}
</script>