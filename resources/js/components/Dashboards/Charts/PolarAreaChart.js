import { PolarArea } from 'vue-chartjs'

export default {
  extends: PolarArea,
  mounted() 
  {
    let uri = 'http://vuespajwt.test/monthly/sales/chart';
    let Years = new Array();
    let Months = new Array();
    let Labels = new Array();
    let Sales = new Array();
    this.axios.get(uri).then((response) => {
      let data = response.data;
      if(data) {
    data.forEach(element => {
    Years.push(element.year);
    Months.push(element.month);
    Labels.push(element.product);
    Sales.push(element.monthly_sale);
    });
    this.renderChart({
      labels: Labels,
            datasets: [{
      label: Months,
      data: Sales,
      backgroundColor: [
                '#F87171',
                '#DC2626',
                '#6B7280',
                '#FBBF24',
                '#6EE7B7',
                '#064E3B',
                '#78350F',
                '#374151',
                '#93C5FD',
                '#818CF8',
                '#F472B6',
                '#FDE68A',
            ],
            borderColor: [
                '#F87171',
                '#DC2626',
                '#6B7280',
                '#FBBF24',
                '#6EE7B7',
                '#064E3B',
                '#78350F',
                '#374151',
                '#93C5FD',
                '#818CF8',
                '#F472B6',
                '#FDE68A',
            ]
          }],
        }, {maintainAspectRatio: false})
      }
      else 
      {
        console.log('No data');
      }
    });            
  }
}