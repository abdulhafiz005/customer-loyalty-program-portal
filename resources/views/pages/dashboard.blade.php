{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

{{-- Dashboard 1 --}}

		{{-- @include('pages.widgets._widget-1', ['class' => ' wd_1'])

		@include('pages.widgets._widget-2', ['class' => ' wd_1'])

		@include('pages.widgets._widget-3', ['class' => ' wd_1']) --}}


		@include('pages.widgets._widgets', ['class' => ' wd_1'])

@endsection

{{-- Scripts Section --}}
@section('scripts')
	<script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/pages/functions.js') }}" type="text/javascript"></script>
	<script type="text/javascript">
		/* Begin Conversion Bar */
		var coversionBar_options = {
			chart: {
				animations: {
				    enabled: false
				},
				type: 'bar',
				height: 400,
				stacked: false,
				foreColor: '#999',
				toolbar: {
					show: false
				},
			},
			yaxis: {
				tickAmount: 5,
			},
			responsive: [
				{
					breakpoint: 480,
					options: {
						legend: {
							position: 'bottom',
							offsetX: -10,
							offsetY: 0
						}
					}
				}
			],

			colors: ["#47C4AB", '#BA95BE'],
			series: [
			],
			dataLabels: {
			    enabled: true,
			    position: 'top',
			    style: {
			        colors: ['#444']
			    },
			    offsetY: -20
			  },
			 plotOptions: {
			  bar: {
			    dataLabels: {
			      position: 'top'
			    }
			  }
			},
			grid: {
				xaxis: {
					lines: {
						show: false
					},
				},
			},
			legend: {
				floating: true,
				position: 'top',
				horizontalAlign: 'right',
				offsetY: -26,
				markers: {
					width: 20,
				}
			},
			tooltip: {
				shared: true
			}
		}

		var coversion_bar = new ApexCharts(document.querySelector('#coversion_bar'), coversionBar_options);
		coversion_bar.render();
		/* End Conversion Bar */


		/* Begin Activity Chart */
		var element = document.getElementById("activity_chart");
		var height = parseInt(KTUtil.css(element, 'height'));

		var strokeColor = '#D13647';

		var activityChartOptions = {
			series: [
				/*{
					name: 'Sales',
					data: [500, 22, 30, 28, 25, 26, 30, 800, 22, 24, 25, 35]
				}*/
			],
			chart: {
				animations: {
				    enabled: false
				},
				type: 'area',
				height: height,
				toolbar: {
					show: false
				},
				zoom: {
					enabled: false
				},
				sparkline: {
					//enabled: false
				},
				dropShadow: {
					enabled: true,
					enabledOnSeries: undefined,
					top: 5,
					left: 0,
					blur: 3,
					color: strokeColor,
					opacity: 1
				}
			},
			plotOptions: {},
			legend: {
				show: false
			},
			dataLabels: {
				enabled: false
			},
			fill: {
				type: 'solid',
				opacity: 1
			},
			stroke: {
				curve: 'straight',
				show: true,
				width: 1,
				colors: [strokeColor]
			},
			xaxis: {
				axisBorder: {
					show: false,
				},
				axisTicks: {
					show: false
				},
				labels: {
					show: false,
					style: {
						colors: '#9E9E9E',
						fontSize: '12px',
					}
				},
				crosshairs: {
					show: false,
					position: 'front',
					stroke: {
						color: '#9E9E9E',
						width: 1,
						dashArray: 3
					}
				}
			},
			tooltip: {
				style: {
					fontSize: '12px',
				},
				y: {
					formatter: function (val) {
						return  val + " Liter"
					}
				},
				marker: {
					show: false
				}
			},
			colors: ['#EE8E90'],
			markers: {
				colors: [],
				strokeColor: [strokeColor],
				strokeWidth: 3
			}
		};

		var actitvyChart = new ApexCharts(element, activityChartOptions);
		actitvyChart.render();
		/* End Activity Chart */

		var reg_mechs_options = {
			series: [
				/*{
					name: 'Registered Mechanics',
					data: [10]
				},
				{
					name: 'Registered Mechanics',
					data: [10]
				},
				{
					name: 'Registered Mechanics',
					data: [7]
				}*/
			],
			chart: {
				animations: {
				    enabled: false
				},
				type: 'bar',
				height: 300,
				width: '100%',
				parentHeightOffset: 0,
				toolbar: {
					show: false
				},
			},
			tooltip: {
				enabled: true,
				x: {show: false},
			},
			plotOptions: {
				bar: {
					horizontal: false,
					columnWidth: '80%',
					endingShape: 'flat'
				},
			},
			dataLabels: {
				enabled: true
			},
			stroke: {
				show: true,
				width: 2,
				colors: ['transparent']
			},
			xaxis: {
				categories: ['Karachi', 'Lahore', 'Islamabad', 'Peshawar'],

				labels: {
					show: true,
					rotate: 0,
					rotateAlways: false,
					trim: false,
					style: {
						fontSize: '12px',
					},
					offsetX: 0,
					offsetY: 0,
				},
			},
			fill: {
				opacity: 1,
				colors:['#74c51b','#8950fc', '#3699ff']
			},
			legend: {
				show: false,
				floating: true,
				position: 'top',
				horizontalAlign: 'right',
				offsetY: -20,
			},
			colors:['#74c51b','#8950fc', '#3699ff']
		};
		var reg_mechs = new ApexCharts(document.querySelector("#registered-mechanics"), reg_mechs_options);
		reg_mechs.render();

		var top_converted_brands_options = {
			dataLabels: {
				enabled: false
			},
			series: [],
			labels: [],
			chart: {
				animations: {
				    enabled: false
				},
				type: 'donut',
				height: 300,
				offsetX: -30,
			},
			legend: {
				show: true,
				position: 'right',
				horizontalAlign: 'center',
				offsetX: 0,
				offsetY: 40
			},
			colors: ['#798DF1', '#C39CC3', '#D66D6F']
		};
		/*var top_converted_brands = new ApexCharts(document.querySelector("#top_converted_brands"), top_converted_brands_options);
		top_converted_brands.render();*/

		var bestPerformingOptions = {
			dataLabels: {
				enabled: false
			},
			series: [],
			labels: [],
			chart: {
				animations: {
				    enabled: false
				},
				type: 'donut',
				offsetX: -30,
				height: 300
			},
			legend: {
				show: true,
				position: 'right',
				horizontalAlign: 'center',
				offsetX: 0,
				offsetY: 40,
			},
			colors: ['#C3E29C', '#A698DB', '#92D7CE']
		};
		/*var best_performing_member = new ApexCharts(document.querySelector("#best_performing_member"), bestPerformingOptions);
		best_performing_member.render();*/

		var interceptionByCitiesOptions = {

			series: [

			],
			chart: {
				animations: {
				    enabled: false
				},
				type: 'bar',
				height: 300,
				width: '100%',
				parentHeightOffset: 0,
				toolbar: {
					show: false
				},
			},
			tooltip: {
				enabled: true,
				x: {show: false},
			},
			plotOptions: {
				bar: {
					horizontal: false,
					columnWidth: '100%',
					endingShape: 'flat'
				},
			},
			dataLabels: {
				enabled: true
			},
			stroke: {
				show: true,
				width: 2,
				colors: ['transparent']
			},
			xaxis: {
				categories: ['Karachi', 'Lahore', 'Islamabad', 'Peshawar'],
				labels: {
					show: true,
					rotate: 0,
					rotateAlways: false,
					trim: false,
					style: {
						fontSize: '12px',
					},
					offsetX: 0,
					offsetY: 0,
				},
			},
			fill: {
				opacity: 1,
				colors:['#74c51b','#8950fc', '#3699ff']
			},
			legend: {
				show: true,
				floating: true,
				position: 'top',
				horizontalAlign: 'right',
				offsetY: -20,
			},
			colors:['#74c51b','#8950fc', '#3699ff']
		};

		var interceptionByCities = new ApexCharts(document.querySelector("#interception_by_cities"), interceptionByCitiesOptions);
		interceptionByCities.render();

		var customer_chart_options = {
			series: [
				/*{
					name: 'Registered Mechanics',
					data: [10]
				},
				{
					name: 'Registered Mechanics',
					data: [10]
				},
				{
					name: 'Registered Mechanics',
					data: [7]
				}*/
			],
			chart: {
				animations: {
				    enabled: false
				},
				type: 'bar',
				height: 300,
				width: '100%',
				parentHeightOffset: 0,
				toolbar: {
					show: false
				},
			},
			tooltip: {
				enabled: true,
				x: {show: false},
			},
			plotOptions: {
				bar: {
					horizontal: false,
					columnWidth: '80%',
					endingShape: 'flat'
				},
			},
			dataLabels: {
				enabled: true
			},
			stroke: {
				show: true,
				width: 2,
				colors: ['transparent']
			},
			xaxis: {
				categories: ['New', 'Old'],

				labels: {
					show: true,
					rotate: 0,
					rotateAlways: false,
					trim: false,
					style: {
						fontSize: '12px',
					},
					offsetX: 0,
					offsetY: 0,
				},
			},
			fill: {
				opacity: 1,
				colors:['#74c51b','#8950fc', '#3699ff']
			},
			legend: {
				show: false,
				floating: true,
				position: 'top',
				horizontalAlign: 'right',
				offsetY: -20,
			},
			colors:['#74c51b','#8950fc', '#3699ff']
		};
		var customerChart = new ApexCharts(document.querySelector("#customer_chart"), customer_chart_options);
		customerChart.render();

		var firstRender = false;
		var best_performing_member, top_converted_brands;

		function getData(){
			var city     = getSelectedCity();
            var dateData = getSelectedDate();

            return $.ajax({
                type: "Get",
                url:"{{ route('ajax-dashboard-stats') }}",
                data: {
                    start: dateData.start_date,
                    end  : dateData.end_date,
                    city : city,
                },
                async: true,
                cache: false,
				success: function (response) {
					data = JSON.parse(response);
					console.log(data);

					coversion_bar.updateSeries([
						{
							data: data.sales,
						}
						/*,{
							name: 'Conversions',
							data: data.converted_interceptions
						}*/
					]);

					$('#p_liter').html(data.activity.purchaseLiters);
					$('#t_ba').html(data.activity.totalBA);
					$('#lp_members').html(data.activity.loyalty_members);
					$('#t_interceptions').html(data.activity.totalInterceptions);

					actitvyChart.updateSeries([
						{
							name: 'Sales',
							data: data.activity.activityGraph,
						}
					]);


					if (firstRender)
					{
						best_performing_member.destroy();
						top_converted_brands.destroy();
					}

					bestPerformingOptions.series = data.top_users.user_counts;
					bestPerformingOptions.labels = data.top_users.user_label;
					best_performing_member = new ApexCharts(document.querySelector("#best_performing_member"), bestPerformingOptions);
					best_performing_member.render().then(() => firstRender = true);


					top_converted_brands_options.series = data.top_brands.switch_from_counts;
					top_converted_brands_options.labels = data.top_brands.switch_from_label;
					
					top_converted_brands = new ApexCharts(document.querySelector("#top_converted_brands"), top_converted_brands_options);
					top_converted_brands.render().then(() => firstRender = true);

					var InterceptionCounts = [];
					var labelInterceptions = [];
					data.top_cities.all_interceptions.forEach(function(interception){
						element = {};
						element.name = interception.location;
						element.data = [interception.total_count];
						InterceptionCounts.push(element);
						labelInterceptions.push(interception.location);
					});

					interceptionByCities.updateSeries(InterceptionCounts);

					interceptionByCities.updateOptions({
						xaxis: {
							categories: labelInterceptions,
							labels: {
								show: true,
								rotate: 0,
								rotateAlways: false,
								trim: false,
								style: {
									fontSize: '9px',
								},
								offsetX: 0,
								offsetY: 0,
							}
						},
					});

					var countsMechanics = [];
					var labelMechanics = [];
					if(typeof data.registered_mechanics.locations === 'undefined'){

					}else{
						data.registered_mechanics.locations.forEach(function(location){
						element = {};
						element.name = location.location;
						element.data = [location.count];
						countsMechanics.push(element);
						labelMechanics.push(location.location);
						});
						// reg_mechs.xAxis.setCaetgories();
						reg_mechs.updateSeries(
							countsMechanics
						);

						reg_mechs.updateOptions({
							xaxis: {
								categories: labelMechanics,
								labels: {
									show: true,
									rotate: 0,
									rotateAlways: false,
									trim: false,
									style: {
										fontSize: '12px',
									},
									offsetX: 0,
									offsetY: 0,
								}
							},
						});
					}

					customerChart.updateSeries([
						{
							name : 'New',
							data : [ data.customers.new ]
						},
						{
							name : 'Old',
							data : [ data.customers.old ]
						}
					]);

					loop_Activity(data.activity_list);


				}
			});
		}

		function loop_Activity($data){
			var wrapper = "";
			for (var i = 0; i < $data.length; i++) {
				var tag_color = '';
				switch($data[i].activity_type)
				{
					default:
						tag_color = 'bg-warning';
						break;
					case 'login':
						tag_color = 'bg-success';
					break;
					case 'logout':
						tag_color = 'bg-danger';
					break;
				}
				wrapper +=
					'<div class="d-flex align-items-center space_border"><span class="bullet bullet-bar '+ tag_color +' align-self-stretch mr-3"></span><div class="d-flex flex-column flex-grow-1"><a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-md mb-1">'+ capitalize($data[i].first_name) + ' ' + capitalize($data[i].last_name) + '</a><span class="text-muted font-weight-bold">'+ capitalize($data[i].activity_type) + ': ' + $data[i].created_at +'</span> </div> </div>';

			}

			$('.activity_list').prepend(wrapper);
		}
		function capitalize(s)
		{
		    return s[0].toUpperCase() + s.slice(1);
		}

		function city_function(city)
        {
            $('#city_holder').html(city);
            localStorage.setItem("city", city);
            getData();
        }

        $(function() {

        	$('#kt_dashboard_daterangepicker').on('apply.daterangepicker', function(ev, picker) {
	            console.log('on apple date range values');
	            var start = $('#kt_dashboard_daterangepicker').data('daterangepicker').startDate.format('YYYY-MM-DD');
	            var end =   $('#kt_dashboard_daterangepicker').data('daterangepicker').endDate.format('YYYY-MM-DD');

	            console.log (start);
	            console.log (end);
	            localStorage.setItem('start_date', start);
	            localStorage.setItem('end_date', end);

	            getData();
	        });

            // fetch initial data with cached date and city values (if any)
            getData();
        });
</script>

@endsection


