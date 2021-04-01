import { Line } from 'vue-chartjs'

export default {
  extends: Line,
  mounted() 
  {
    let uri = 'http://vuespajwt.test/sales/chart';
    let Dates = new Array();
    let Products = new Array();
    let Prices = new Array();
    let Sales = new Array();
    this.axios.get(uri).then((response) => {
      let data = response.data;
      if(data) {
    data.forEach(element => {
    Products.push(element.product);
    Prices.push(element.purchase_rate);
    Dates.push(element.purchase_date);
    });
  	this.renderChart({
  		labels: Products,
             	datasets: [{
  			label: 'Price',
        data: Prices,
  			borderColor: '#FC2525',
  			hoverBackgroundColor: '#CCCCCC',
  			hoverBorderColor: '#666666'
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