import { Line } from 'vue-chartjs'

export default {
  extends: Line,
  mounted() {
         let uri = 'http://vuespajwt.test/coins';
         let Years = new Array();
         let Labels = new Array();
         let Prices = new Array();
         this.axios.get(uri).then((response) => {
            let data = response.data;
            if(data) {
				data.forEach(element => {
				Years.push(element.year);
				Labels.push(element.name);
				Prices.push(element.price);
				});
				this.renderChart({
					labels: Years,
	               	datasets: [{
						label: 'Bitcoin',
						borderColor: '#FC2525',
						hoverBackgroundColor: '#CCCCCC',
						hoverBorderColor: '#666666',
	                  data: Prices
	            	}],
         		}, {responsive: true, maintainAspectRatio: false})
       		}
       		else 
       		{
          		console.log('No data');
       		}
      	});            
   	}
}