<template>
	<div>
		<div class="md:h-auto mr-12 bg-gray-300 pl-8 pr-8 pt-4 rounded">
      <div class="flex pl-3 pr-3 justify-between">
        <div class="text-gray-900 text-xl">
          Sale
        </div>
        <div class="justify-end">
          <router-link to="/inventory/sale" class="pl-2 pr-2 text-blue-600 border rounded">
            Sale
          </router-link>
          <router-link to="/inventory/purchase" class="pl-2 pr-2 ml-2 text-blue-600 border rounded">
            Purchase
          </router-link>
        </div>
      </div><hr>
  		<label class="pl-3">Search</label>
  		<input type="text" class="rounded pl-2 mt-2" v-model="search"/>
  		<mdb-container>
  		    <mdb-datatable-2 class="text-center pt-2" v-model="data" :searching="{value: search}" striped bordered/>
  		 </mdb-container></br>
  	</div>
    <div class="h-8"></div>
	</div>
</template>

<script>
  import { mdbDatatable2, mdbContainer } from 'mdbvue';
  export default {
    components: {
      mdbDatatable2,
      mdbContainer
    },
    data() {
      return {
      	search: '',
        data: {
          rows: [],
          columns: []
        }
      };
    },
    methods: {
      filterData(dataArr, keys) {
        let data = dataArr.map(entry => {
          let filteredEntry = {};
          keys.forEach(key => {
            if (key in entry) {
              filteredEntry[key] = entry[key];
            }
          });
          return filteredEntry;
        });
        return data;
      }
    },
    mounted(){
      fetch('http://vuespajwt.test/sale')
      .then(res => res.json())
      .then(json => {
        let keys = ["buyer", "product", "selling_rate"];
        let entries = this.filterData(json, keys);
        //columns
        const columns = keys.map(key => {
          return {
            label: key.toUpperCase(),
            field: key,
            sort: true,
          };
        });
        //rows

        this.data = {
          columns,
          rows: entries
        }
      })
      .catch(err => console.log(err));
    }
  };
</script>
