<template>
  <div class="bg-gray-100 p-8 rounded-xl shadow-xl">
    <div class="md:h-auto bg-white pl-8 pr-8 pt-4 w-auto rounded-xl shadow-xl">
      <div class="flex pl-3 pr-3 pt-3 justify-between">
        <div class="text-xl text-gray-600">
          Stock Record
        </div>
      </div><hr class="mt-2 bg-gray-300">
      
      <div class="row rounded-md">
        <div class="col rounded-md">
          <table id="stocks-table" class="display table-bordered nowrap rounded-md bg-blue-500 text-white" cellspacing="0" width="100%">
            <thead class="text-center">
              <tr>
                <th>Sr #</th>
                <th>Product</th>
                <th>Category</th>
                <th>Total</th>
                <th>Available</th>
                <th>Returned</th>
                <th>Price</th>
                <th>Earned</th>
                <th>Profit</th>
                <th>Loss</th>
                <th>Status</th>
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
    let stocks = [];

    this.dataTable = $("#stocks-table").DataTable();
    const url = "http://vuespajwt.test/stock";
    fetch(url)
    .then((res) => res.json())
    .then((data) => {
      data.forEach((item) => {
        stocks.push(item);
      });
      var i = 1;
      stocks.forEach((stock) => {
        this.dataTable.row
          .add([i++, stock.product, stock.category, stock.total, stock.available, stock.returned, stock.price, stock.earned, stock.profit, stock.loss, stock.status])
          .draw(false);
      });
    });
  }
}
</script>