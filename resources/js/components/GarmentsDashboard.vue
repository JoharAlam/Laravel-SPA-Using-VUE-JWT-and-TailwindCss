<template>
	<div class="mr-12">
		<div class="md:h-auto bg-gray-800 pl-8 pr-8 pt-2 w-auto rounded">
			<div class="flex justify-between">
		        <div class="text-gray-400 text-sm">
		            Garments
		        </div>
	        	<div class="justify-end">
		        	<router-link to="/dashboard/shoes" class="pl-2 pr-2 text-blue-400 border-red-500 border rounded">
						Shoes
					</router-link>
					<router-link to="/dashboard/garments" class="pl-2 pr-2 ml-2 text-blue-400 border-red-500 border rounded">
						Garments
					</router-link>
				</div>
			</div>
	        <div class="text-gray-200 text-2xl">
	            Yearly Price Scale 
	            <br>
	        </div>
	        <line-chart :chart-data="datacollection" :height="300"></line-chart>
	    </div>

	    <div class="flex">
		    <div class="md:h-auto mt-8 bg-gray-800 pl-8 pr-8 pt-5 w-95 rounded">
		        <div class="text-gray-400 text-sm">
		            Shoes
		        </div>
		        <div class="text-gray-200 text-2xl">
		            Monthly Sale
		        </div>
		        <polar-chart :chart-data="datacollections" :height="400"></polar-chart>
		    </div>
		    <div class="md:h-auto ml-3 mt-8 bg-gray-800 pl-8 pr-8 pt-5 w-90 rounded">
		        <div class="text-gray-400 text-sm">
		            Shoes
		        </div>
		        <div class="text-gray-200 text-2xl">
		            Yearly Sale
		        </div>
		        <bar-chart :chart-data="datacollections" :height="350"></bar-chart>
		    </div>
	    </div>
	    <div class="h-8"></div>
	</div>
</template>

<script>
	import LineChart from './GarmentsCharts/LineChart.js';
	import BarChart from './GarmentsCharts/BarChart.js';
	import PolarChart from './GarmentsCharts/PolarAreaChart.js'

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