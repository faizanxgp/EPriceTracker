<div>
	<canvas id="myChart"></canvas>
</div>

<script>
	// Line chart
	// -----------------------------------
	jQuery(document).ready(function () {
		var lineData = {
			labels: ['6 Days', '5 Days', '4 Days', '3 Days', '2 Days', '1 Day', 'Today'],
			datasets: [
//			{
//				label: 'My First dataset',
//
//				backgroundColor: 'rgba(114,102,186,0.2)',
//
//				borderColor: 'rgba(114,102,186,1)',
//
//				pointBorderColor: '#fff',
//
//				data: [1, 2, 3, 4, 5, 6, 7]
//
//			}, {
//
//				label: 'My Second dataset',
//
//				backgroundColor: 'rgba(35,183,229,0.2)',
//
//				borderColor: 'rgba(35,183,229,1)',
//
//				pointBorderColor: '#fff',
//
//				data: [2, 5, 6, 7, 3, 8, 1]
//
//			},
			@foreach($results as $result)
				{
					label: '{{ $result["url"] }}',

					//backgroundColor: 'rgba(35,183,229,0.2)',

					borderColor: 'rgba(' + color() + ',1)',

					//pointBorderColor: '#fff',

					fill: false,

					data: [ {{ $result['data'] }} ]
				},
			@endforeach
			]
		};

		var lineOptions = {
			legend: {
				display: true
			},
			tooltip: true,
		};

		var linectx = document.getElementById('myChart'); //.getContext('2d');

		var lineChart = new Chart(linectx, {
			type: 'line',
			data: lineData,

			options: lineOptions
		});

		function color() {
			var colorR = Math.floor((Math.random() * 256));
			var colorG = Math.floor((Math.random() * 256));
			var colorB = Math.floor((Math.random() * 256));
			return colorR + "," + colorG + "," + colorB;
		}


//
//
//
//
//
//
//	var ctx = document.getElementById("myChart");
//	var myChart = new Chart(ctx, {
//		type: 'bar',
//		data: {
//			labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
//			datasets: [{
//				label: '# of Votes',
//				data: [12, 19, 3, 5, 2, 3],
//				backgroundColor: [
//					'rgba(255, 99, 132, 0.2)',
//					'rgba(54, 162, 235, 0.2)',
//					'rgba(255, 206, 86, 0.2)',
//					'rgba(75, 192, 192, 0.2)',
//					'rgba(153, 102, 255, 0.2)',
//					'rgba(255, 159, 64, 0.2)'
//				],
//				borderColor: [
//					'rgba(255,99,132,1)',
//					'rgba(54, 162, 235, 1)',
//					'rgba(255, 206, 86, 1)',
//					'rgba(75, 192, 192, 1)',
//					'rgba(153, 102, 255, 1)',
//					'rgba(255, 159, 64, 1)'
//				],
//				borderWidth: 1
//			}]
//		},
//		options: {
//			scales: {
//				yAxes: [{
//					ticks: {
//						beginAtZero:true
//					}
//				}]
//			}
//		}
//	});

	});
</script>