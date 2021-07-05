<template>
	<div class="bg-gray-100 p-8 rounded-xl shadow-xl">
    <div class="md:h-auto bg-white pl-8 pr-8 pt-4 w-auto rounded-xl shadow-xl">
      <!-- <router-link to="/add/sale" class="pl-2 pr-2 text-blue-600">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-6 rounded shadow-xl">
          Add Sale
        </button>
      </router-link> -->
      <div class="flex pl-3 pr-3 pt-4 justify-between">
        <div class="text-xl text-gray-600">
          Sale
        </div>
        <router-link to="/customers" class="pl-2 pr-2 text-blue-600 border rounded">
          Customers
        </router-link>
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
        <h6 class="mt-3 text-gray-600">Edit Sale</h6>
        <hr>
        <div class="row">
          <div class="col pt-3">
            <label for="customer" class="uppercase text-blue-300 text-xs font-bold absolute pl-3 pt-2">Sale ID</label>
            <input type="customer" id="id" class="pt-4 w-full rounded pl-3 pb-1 bg-blue-800 text-white placeholder-gray-300 outline-none focus:bg-blue-700" placeholder="ID" autocomplete="customer" disabled>
          </div>
          <div class="col pt-3">
            <label for="name" class="uppercase text-blue-300 text-xs font-bold absolute pl-3 pt-2">Name</label>
            <input type="name" id="name" class="pt-4 w-full rounded pl-3 pb-1 bg-blue-800 text-white placeholder-gray-300 outline-none focus:bg-blue-700" placeholder="Customer Name" autocomplete="customer_name" disabled>
          </div>
          <div class="col pt-3">
            <label for="product" class="uppercase text-blue-300 text-xs font-bold absolute pl-3 pt-2">Product</label>
            <input type="product" id="product" class="pt-4 w-full rounded pl-3 pb-1 bg-blue-800 text-white placeholder-gray-300 outline-none focus:bg-blue-700" placeholder="Product Name" autocomplete="product" disabled>
          </div>
          <div class="col pt-3">
            <label for="return" class="uppercase text-blue-300 text-xs font-bold absolute pl-3 pt-2">Procuct Return</label>
            <input type="return" id="return" class="pt-4 w-full rounded pl-3 pb-1 bg-blue-800 text-white placeholder-gray-300 outline-none focus:bg-blue-700" placeholder="Enter return quantity" autocomplete="return">
          </div>
        </div>
        <br>
        <button class="uppercase rounded text-center text-white bg-blue-500 hover:bg-blue-700 py-2 px-3 shadow-xl font-bold" @click="updateSale">Update</button><!-- <mdb-btn color="default" class="mb-3" @click="confirm = true">lanuch modal</mdb-btn> -->
        <hr>
        <br>

    		<div class="row rounded-md">
          <div class="col rounded-md">
            <table id="sales-table" class="display table-bordered nowrap rounded-md bg-blue-500 text-white" cellspacing="0" width="100%">
              <thead class="text-center">
                <tr>
                  <th>Sr #</th>
                  <th>Customer Name</th>
                  <th>Product</th>
                  <th>Category</th>
                  <th>Selling Rate</th>
                  <th>Quantity</th>
                  <th>Payment</th>
                  <th>Sale Date</th>
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

    <mdb-container>
    <!-- confirm modal -->
    <mdb-modal :show="confirm" @close="confirm = false" size="sm" class="text-center" success>
      <mdb-modal-header center :close="false" class="bg-blue-500  rounded-xl">
        <p class="heading">{{success}}</p>
      </mdb-modal-header>
      <mdb-modal-body>
        </br>
        Do you want to pay Rs-{{pay_able}} back to customer?
      </mdb-modal-body>
        </br>
      <mdb-modal-footer center>
        <mdb-btn outline="success" @click="pay">Yes</mdb-btn>
        <mdb-btn color="danger" @click="confirm = false">No</mdb-btn>
      </mdb-modal-footer>
    </mdb-modal>
  </mdb-container>
	</div>
</template>

<script>
  import { mdbContainer, mdbRow, mdbColumn, mdbBtn, mdbIcon, mdbModal, mdbModalHeader, mdbModalBody, mdbModalFooter } from 'mdbvue';
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
    name: 'ModalExamplesPage',
    components: {
      mdbContainer,
      mdbRow,
      mdbColumn,
      mdbBtn,
      mdbIcon,
      mdbModal,
      mdbModalHeader,
      mdbModalBody,
      mdbModalFooter
    },
    data(){
      return{
        errors:[],
        success: '',
        confirm: false,
        pay_able: '',
        return_id: ''
      }
    },
    methods: {
      reloadDatatable(){
        let sales = [];
        this.dataTable = $("#sales-table").DataTable();

        //To clear datatable rows
        this.dataTable.clear().draw();

        //To reload datatable rows
        const url = "http://vuespajwt.test/sale";
        fetch(url)
        .then((res) => res.json())
        .then((data) => {
          data.forEach((item) => {
            sales.push(item);
          });
          var i = 1;
          sales.forEach((sale) => {
            this.dataTable.row
              .add([i++, sale.customer_name, sale.product, sale.category, sale.selling_rate, sale.quantity, sale.payment, sale.sale_date, '<button type="submit" class="pl-2 h-5 w-9 border-2 border-yellow-500 border-opacity-80 rounded hover:bg-yellow-500" onClick="Id('+sale.id+');Name(\''+sale.customer_name+'\');Product(\''+sale.product+'\');"><svg class="w-4 h-3" viewBox="0 0 18 18" fill="currentColor"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" /><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" /></svg></button><a href="storage/invoices/Invoice-AA-1.pdf" target="_blank" title="invoice" class="pl-2 h-5 w-9 border-2 border-yellow-500 border-opacity-80 rounded hover:bg-yellow-500" role="button"><b>invoice</b></a>'])
              .draw(false);
          });
        });
      },
      updateSale() {
        var id = $("#id").val();
        var name = $("#name").val();
        var product = $("#product").val();
        var returned = $("#return").val();

        axios.post('http://vuespajwt.test/return/sale', {id, name, product, returned}).then((res) =>{
          this.success = '';
          this.errors = [];

          if(res.data.quantity != '')
          {
            this.errors = [res.data.quantity];
          }
          else
          {
            this.pay_able = res.data.pay_able;
            this.return_id = res.data.return_id;
            this.confirm = true;
            $("#return").val('');
            this.reloadDatatable();
            this.success = 'Sale updated successfully.';
          }
        })
        .catch((error)=>{
          this.success = '';
          this.errors = [];
          this.errors = error.response.data.errors;
        })
      },
      pay() {
        var id = $("#id").val();
        var name = $("#name").val();
        var pay_able = this.pay_able;
        var return_id = this.return_id;
        var type = 'customer';

        axios.post('http://vuespajwt.test/pay', {id, name, pay_able, return_id, type}).then(() =>{
          this.success = '';
          this.errors = [];
          this.confirm = false;
          this.reloadDatatable();
          this.success = 'Amount Rs-'+this.pay_able+' is paid to customer successfully.';
        })
        .catch((error)=>{
          this.success = '';
          this.errors = [];
          this.errors = error.response.data.errors;
        })
      }
    },
    mounted() {
      let sales = [];
      this.dataTable = $("#sales-table").DataTable();

      const url = "http://vuespajwt.test/sale";
      fetch(url)
      .then((res) => res.json())
      .then((data) => {
        data.forEach((item) => {
          sales.push(item);
        });
        var i = 1;
        sales.forEach((sale) => {
          this.dataTable.row
            .add([i++, sale.customer_name, sale.product, sale.category, sale.selling_rate, sale.quantity, sale.payment, sale.sale_date, '<div class="flex">   <a href="/storage/'+sale.invoice+'" target="_blank" class="h-6 w-9 border-2 text-black border-blue-500 border-opacity-80 rounded hover:bg-blue-500 hover:text-black" style="padding-top: 3px;"><i class="fas fa-file-invoice-dollar"></i></a>                                                                                                                                                                                      <button type="submit" class="ml-1 h-6 w-9 border-2 text-black border-yellow-500 border-opacity-80 rounded hover:bg-yellow-500 hover:text-black" onClick="Id('+sale.id+');Name(\''+sale.customer_name+'\');Product(\''+sale.product+'\');" style="padding-left: 3px;"><i class="fas fa-edit"></i></button></div>'])
            .draw(false);
        });
      });
    }
  }
</script>