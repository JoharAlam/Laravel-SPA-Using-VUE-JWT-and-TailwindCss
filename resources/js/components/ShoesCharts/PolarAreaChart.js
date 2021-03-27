import { PolarArea } from 'vue-chartjs'

export default {
  extends: PolarArea,
  mounted() 
  {
    let uri = 'http://vuespajwt.test/sale/shoes';
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
    Labels.push(element.name);
    Sales.push(element.sale);
    });
    this.renderChart({
      labels: Months,
            datasets: [{
      label: '2021',
      data: Sales,
      backgroundColor: [
                '#6B7280',
                '#374151',
                '#F87171',
                '#DC2626',
                '#FBBF24',
                '#6EE7B7',
                '#064E3B',
                '#78350F',
                '#93C5FD',
                '#818CF8',
                '#F472B6',
                '#FDE68A',
            ],
            borderColor: [
                '#6B7280',
                '#374151',
                '#F87171',
                '#DC2626',
                '#FBBF24',
                '#6EE7B7',
                '#064E3B',
                '#78350F',
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