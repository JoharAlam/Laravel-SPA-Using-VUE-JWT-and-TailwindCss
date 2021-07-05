<template>
	<div class="bg-gray-100 p-8 rounded-xl shadow-xl">
		<div class="md:h-auto bg-white pl-8 pr-8 pt-2 w-auto rounded-xl">
			<div class="flex justify-between">
		        <div class="text-gray-600 mt-8 text-sm">
		            Products
		        </div>
			</div>
	        <div class="text-gray-600 text-2xl">
	            Purchase Price Scale 
	            <br>
	        </div>
	        <line-chart :height="300"></line-chart>
	        <br>
	    </div>

	    <div class="flex">
		    <div class="md:h-auto mt-8 bg-white pl-8 pr-8 pt-5 w-95 rounded-xl">
		        <div class="text-gray-600 text-sm">
		            Products
		        </div>
		        <div class="text-gray-600 text-2xl">
		            Current Month Sale
		        </div>
		        <polar-chart :height="400"></polar-chart>
		    </div>
		    <div class="md:h-auto ml-3 mt-8 bg-white pl-8 pr-8 pt-5 w-90 rounded-xl">
		        <div class="text-gray-600 text-sm">
		            Products
		        </div>
		        <div class="text-gray-600 text-2xl">
		            Current Year Sale
		        </div>
		        <bar-chart :height="350"></bar-chart>
		    </div>
	    </div>
	</div>
</template>

<script>
	import LineChart from './Charts/LineChart.js';
	import BarChart from './Charts/BarChart.js';
	import PolarChart from './Charts/PolarAreaChart.js'

	export default {
	  components: {
	    LineChart,
	    BarChart,
	    PolarChart,
	  },
	  data(){
	    return {
	    }
	  },
	  
	}

</script>