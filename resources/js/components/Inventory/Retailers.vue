<template>
  <div class="bg-gray-100 p-8 rounded-xl shadow-xl">
    <div class="md:h-auto bg-white pl-8 pr-8 pt-4 w-auto rounded-xl shadow-xl">
      <div class="flex pl-3 pr-3 pt-4 justify-between">
        <div class="text-xl text-gray-600">
          Reailers Detail
        </div>
      </div>
      <hr class="mt-2 bg-gray-300">

      <div v-if="success" class="alert alert-success">
        <strong>Success! </strong>{{success}}
      </div>
      <div v-for="error in errors">
        <div v-if="errors" class="alert alert-danger">
          <strong>Error: </strong>{{error}}
        </div>
      </div>
      
      <div id="app" class="container">
        <h6 class="mt-3 text-gray-600">Edit Retailer</h6>
        <hr>
        <div class="row">
          <div class="col pt-3">
            <label for="retailer" class="uppercase text-blue-300 text-xs font-bold absolute pl-3 pt-2">Retailer ID</label>
            <input type="retailer" id="id" class="pt-4 w-full rounded pl-3 pb-1 bg-blue-800 text-white placeholder-gray-300 outline-none focus:bg-blue-700" placeholder="ID" autocomplete="retailer" disabled>
          </div>
          <div class="col pt-3">
            <label for="name" class="uppercase text-blue-300 text-xs font-bold absolute pl-3 pt-2">Name</label>
            <input type="name" id="retailer_name" class="pt-4 w-full rounded pl-3 pb-1 bg-blue-800 text-white placeholder-gray-300 outline-none focus:bg-blue-700" placeholder="Retailer Name" autocomplete="name" disabled>
          </div>
          <div class="col pt-3">
            <label for="received" class="uppercase text-blue-300 text-xs font-bold absolute pl-3 pt-2">Received</label>
            <input type="received" id="received" class="pt-4 w-full rounded pl-3 pb-1 bg-blue-800 text-white placeholder-gray-300 outline-none focus:bg-blue-700" placeholder="Enter received amount" autocomplete="received">
          </div>
          <div class="pt-7"><u>OR</u></div>
          <div class="col pt-3">
            <label for="paid" class="uppercase text-blue-300 text-xs font-bold absolute pl-3 pt-2">Paid</label>
            <input type="paid" id="paid" class="pt-4 w-full rounded pl-3 pb-1 bg-blue-800 text-white placeholder-gray-300 outline-none focus:bg-blue-700" placeholder="Enter paid amount" autocomplete="paid">
          </div>
        </div>
        <br>
        <button class="uppercase rounded text-center text-white bg-blue-500 hover:bg-blue-700 py-2 px-3 font-bold shadow-xl" @click="updateRetailer">Update</button>
        <hr>
        <br>
  
        <div class="row rounded-md">
          <div class="col rounded-md">
            <table id="retailers-table" class="display table-bordered nowrap rounded-md bg-blue-500 text-white" cellspacing="0" width="100%">
              <thead class="text-center">
                <tr>
                  <th>Sr #</th>
                  <th>Retailer Name</th>
                  <th>Total</th>
                  <th>Paid</th>
                  <th>Receive Able</th>
                  <th>Pay Able</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody class="text-center text-black">
              </tbody>
            </table>
          </div>
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
  data(){
    return{
      errors:[],
      success: ''
    }
  },
  methods: {
    reloadDatatable(){
      let retailers = [];
      this.dataTable = $("#retailers-table").DataTable();

      //To clear datatable rows
      this.dataTable.clear().draw();

      //To reload datatable rows
      const url = "http://vuespajwt.test/retailers/detail";
      fetch(url)
      .then((res) => res.json())
      .then((data) => {
        data.forEach((item) => {
          retailers.push(item);
        });
        var i = 1;
        retailers.forEach((retailer) => {
          let name = retailer.retailer_name;

          this.dataTable.row
          .add([i++, retailer.retailer_name, retailer.total, retailer.paid, retailer.receive_able, retailer.pay_able, '<button type="submit" class="pl-2 h-5 w-9 border-2 border-yellow-500 border-opacity-80 rounded hover:bg-yellow-500" onClick="editRetailer('+retailer.id+');retailerName(\''+name+'\');"><svg class="w-4 h-3" viewBox="0 0 18 18" fill="currentColor"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" /><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" /></svg></button>'])
          .draw(false);
        });
      });
    },
    updateRetailer() {
      var id = $("#id").val();
      var retailer_name = $("#retailer_name").val();
      var received = $("#received").val();
      var paid = $("#paid").val();

      axios.post('http://vuespajwt.test/update/retailer', {id, retailer_name, received, paid}).then((res) =>{
        this.success = '';
        this.errors = [];
        if(received == '' && paid == '')
        {
          this.errors = ['[ "Please fill one of the field from received or paid" ]'];
        }
        else
        {
          this.reloadDatatable();
          $("#received").val('');
          $("#paid").val('');
          this.success = 'Retailer updated successfully';
        }
      })
      .catch((error)=>{
        this.success = '';
        this.errors = [];
        this.errors = error.response.data.errors;
      })
    }
  },
  mounted() {
    let retailers = [];

    this.dataTable = $("#retailers-table").DataTable();
    const url = "http://vuespajwt.test/retailers/detail";

    fetch(url)
    .then((res) => res.json())
    .then((data) => {
      data.forEach((item) => {
        retailers.push(item);
      });
      var i = 1;
      retailers.forEach((retailer) => {
        let name = retailer.retailer_name;

        this.dataTable.row
        .add([i++, retailer.retailer_name, retailer.total, retailer.paid, retailer.receive_able, retailer.pay_able, '<button type="submit" class="pl-2 h-5 w-9 border-2 border-yellow-500 border-opacity-80 rounded hover:bg-yellow-500" onClick="editRetailer('+retailer.id+');retailerName(\''+name+'\');"><svg class="w-4 h-3" viewBox="0 0 18 18" fill="currentColor"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" /><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" /></svg></button>'])
        .draw(false);
      });
    });
  }
}
</script>