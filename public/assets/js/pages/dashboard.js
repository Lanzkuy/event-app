var optionsOrderPerMonth = {
	annotations: {
		position: 'back'
	},
	dataLabels: {
		enabled:false
	},
	chart: {
		type: 'bar',
		height: 450
	},
	fill: {
		opacity:1
	},
	plotOptions: {
	},
	series: [{
		name: 'order',
		data: [9,20,30,20,10,20,30,20,10,20,30,20]
	}],
	colors: '#702adc',
	xaxis: {
		categories: ["Jan","Feb","Mar","Apr","May","Jun","Jul", "Aug","Sep","Oct","Nov","Dec"],
	},
}

var chartProfileVisit = new ApexCharts(document.querySelector("#chart-monthly-order"), optionsOrderPerMonth);

chartProfileVisit.render();