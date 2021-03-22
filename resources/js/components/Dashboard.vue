<template>
	<div>
		<!--<div class="md:h-auto ml-8 mr-8 bg-gray-800 pl-8 pr-8 pt-2 rounded">
	        <div class="text-gray-400 text-sm">
	            Total Shipments
	        </div>
	        <div class="text-gray-200 text-2xl">
	            Performance
	        </div>
	        <scatter-chart :chart-data="datacollection" :height="300" class="w-auto"></scatter-chart>
	    </div>-->

		<div class="md:h-auto ml-8 mr-8 bg-gray-800 pl-8 pr-8 pt-2 w-auto rounded">
	        <div class="text-gray-400 text-sm">
	            Bitcoin
	        </div>
	        <div class="text-gray-200 text-2xl">
	            Yearly Rate
	        </div>
	        <line-chart :chart-data="datacollection" :height="300"></line-chart>
	    </div>

	    <div class="flex">
		    <div class="md:h-auto ml-8 mr-8 mt-8 bg-gray-800 pl-8 pr-8 pt-5 w-90 rounded">
		        <div class="text-gray-400 text-sm">
		            Bitcoin
		        </div>
		        <div class="text-gray-200 text-2xl">
		            Yearly Sale
		        </div>
		        <bar-chart :chart-data="datacollections" :height="200"></bar-chart>
		    </div>
		    <!--<div class="md:h-auto ml-8 mr-8 mt-8 bg-gray-800 pl-8 pr-8 pt-5 w-90 rounded">
		        <div class="text-gray-400 text-sm">
		            Total Shipments
		        </div>
		        <div class="text-gray-200 text-2xl">
		            Performance
		        </div>
		        <bar-chart :chart-data="datacollections" :height="200"></bar-chart>
		    </div>
		    <div class="md:h-auto ml-8 mr-8 mt-8 bg-gray-800 pl-8 pr-8 pt-5 w-90 rounded">
		        <div class="text-gray-400 text-sm">
		            Total Shipments
		        </div>
		        <div class="text-gray-200 text-2xl">
		            Performance
		        </div>
		        <bar-chart :chart-data="datacollections" :height="200"></bar-chart>
		    </div>-->
	    </div>
	</div>
</template>

<script>
	import LineChart from './Charts/LineChart.js';
	import BarChart from './Charts/BarChart.js';
	// import ScatterChart from './ScatterChart.js'

	export default {
	  components: {
	    LineChart,
	    BarChart,
	    // ScatterChart
	  },
	  data(){
	    return {
	    }
	  },
	  
	}
</script>