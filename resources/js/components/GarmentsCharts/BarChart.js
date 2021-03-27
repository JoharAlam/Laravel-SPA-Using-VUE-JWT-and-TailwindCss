import { Bar } from 'vue-chartjs'

export default {
  extends: Bar,
  mounted() 
  {
    let uri = 'http://vuespajwt.test/garments';
    let Years = new Array();
    let Labels = new Array();
    let Prices = new Array();
    let Sales = new Array();
    this.axios.get(uri).then((response) => {
      let data = response.data;
      if(data) {
    data.forEach(element => {
    Years.push(element.year);
    Labels.push(element.name);
    Prices.push(element.price);
    Sales.push(element.yearly_sale);
    });
    this.renderChart({
    labels: Years,
           	datasets: [{
    	label: 'Garments',
    	backgroundColor: '#FC2525',	                  
    	hoverBackgroundColor: '#CCCCCC',
    	hoverBorderColor: '#666666',
              	data: Sales
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