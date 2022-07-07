{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

{{-- Dashboard 1 --}}

	<div class="row">

		<div class="col-lg-4 col-xxl-4">
			<div class="card card-custom gutter-b card-stretch" style="height: 200px;">
				<!--begin::Body-->
				<div class="card-body p-1">
					<!--begin::Chart-->
						<div id="bar"></div>
					<!--end::Items-->
				</div>
				<!--end::Body-->
			</div>
		</div>

		<div class="col-lg-4 col-xxl-4">
			<div class="card card-custom gutter-b" style="height: 200px;">
				<div class="card-body p-2" >
					<!--begin::Chart-->
						<div id="chart_11"></div>
					<!--end::Chart-->
				</div>
			</div>
		</div>

		<div class="col-lg-4 col-xxl-4">
			<div class="card card-custom gutter-b" style="height: 200px;">
				<div class="card-body p-2" >
					<!--begin::Chart-->
						<div id="chart_12"></div>
					<!--end::Chart-->
				</div>
			</div>
		</div>

	</div>

	<!--begin::Card-->
	<div class="card card-custom">
		<div class="card-header pl-2">
			<div class="card-title col-md-3">
				{{ Metronic::getSVG("media/svg/icons/Shopping/Chart-line1.svg", "svg-icon-2x svg-icon-primary d-block my-2 p-1 ml-2") }}
				<h3 class="card-label">Individual Column Search</h3>

			</div>
			<div class="card-toolbar col-md-8">

				<div class="form-group row m-0 pr-1 pl-1 col-md-4">
					<label for="inputPassword" class="col-sm-3 pr-1 pl-1 col-form-label">By Role</label>
					<div class="col-sm-9 pr-1 pl-1">
						<select class="form-control data_select" id="exampleSelect1">
							<option value="">Select</option>
							<option value="1">Brand Ambassader</option>
							<option value="1">2</option>
							<option value="1">3</option>
							<option value="1">4</option>
							<option value="1">5</option>
						</select>
					</div>
				</div>

				<div class="form-group row m-0 pr-1 pl-1 col-md-4">
					<label for="inputPassword" class="col-sm-3 pr-1 pl-1 col-form-label">Filter 2</label>
					<div class="col-sm-9 pr-1 pl-1">
						<select class="form-control data_select" id="exampleSelect1">
							<option>Select</option>
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
						</select>
					</div>
				</div>

				<div class="form-group row m-0 col-md-4">
					<label for="inputPassword" class="col-sm-4 col-form-label">Filter 3</label>
					<div class="col-sm-8">
						<select class="form-control data_select" id="exampleSelect1">
							<option>Select</option>
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
						</select>
					</div>
				</div>

			</div>
		</div>

		<div class="card-body">
			<!--begin: Datatable-->
			<div class="table-responsive">
				<table class="table table-separate table-head-custom table-checkable" id="kt_datatable2">
					<thead>
						<tr>
							<th>Name</th>
							<th>Member ID</th>
							<th>Loyalty Program Level</th>
							<th>Loyalty Points</th>
							<th>Primary Location</th>
							<th>Current Truck</th>
							<th>Joining Date</th>
							<th>Total Interceptions</th>
							<th>Total Conversions</th>
							<th>Actions</th>
						</tr>
					</thead>

					<tbody>

					</tbody>

					<tfoot>
						<tr>
							<th>Name</th>
							<th>Member ID</th>
							<th>Loyalty Program Level</th>
							<th>Loyalty Points</th>
							<th>Primary Location</th>
							<th>Current Truck</th>
							<th>Joining Date</th>
							<th>Total Interceptions</th>
							<th>Total Conversions</th>
							<th>Actions</th>
						</tr>
					</tfoot>
				</table>
				<!--end: Datatable-->
			</div>
		</div>
	</div>
	<!--end::Card-->

@endsection

{{-- Scripts Section --}}
@section('scripts')
	<script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
	
	<!--begin::Page Vendors(used by this page)-->
	<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
	<!--end::Page Vendors-->

	<!--begin::Page Scripts(used by this page)-->
	<script src="{{ asset('js/pages/crud/datatables/search-options/column-search.js') }}"></script>
	<!--end::Page Scripts-->

	<!--end::Page Vendors-->

	<script type="text/javascript">
		var KTDatatablesSearchOptionsColumnSearch = function() {

			$.fn.dataTable.Api.register('column().title()', function() {
				return $(this.header()).text().trim();
			});

		    var initTable1 = function() {

		        // begin first table
		        var table = $('#kt_datatable2').DataTable({
		            responsive: true,

		            // Pagination settings
		            dom:  "<'row'<'col-sm-8'B><'col-sm-4 m-auto d-flex'l i>>" +
		            "<'row'<'col-sm-12'tr>>" +
		            "<'row'<'col-sm-4'><'col-sm-4 text-center'p><'col-sm-4'>>",
		            /*dom:"<'row flex-row-reverse'<'col-sm-6 d-flex 'l i>>"+""+
		            "<'row' <'col-md-6' p> >",*/
		            // read more: https://datatables.net/examples/basic_init/dom.html

		            lengthMenu: [5, 10, 25, 50],

		            pageLength: 10,

		            language: {
		                'lengthMenu': '_MENU_ ',
		            },
		        });

		    };

		    return {

		        //main function to initiate the module
		        init: function() {
		            initTable1();
		        },

		    };

		}();

		jQuery(document).ready(function() {
		    KTDatatablesSearchOptionsColumnSearch.init();
		});

		var optionsBar = {
			chart: {
				type: 'bar',
				height: 200,
				width: '100%',
				stacked: true,
				foreColor: '#999',
				toolbar: {
					show: false	
				},
			},
			plotOptions: {
				bar: {
					barHeight: '100%',
					columnWidth: '90%',
					endingShape: 'rounded'
				}
			},
			dataLabels: {
				enabled: false,
				enabledOnSeries: false,
			},
			colors: ["#00C5A4", '#F3F2FC'],
			series: [
				{
					name: "Interception",
					data: [10, 20, 30, 10, 20, 30, 10, 8, 6, 3],
				}, 
				{
					name: "Convertion",
					data: [30, 20, 10, 30, 20, 10, 5, 8, 9, 7],
				}
			],
			labels: ['1 Jan', '3 Jan', '5 Jan'],
			grid: {
				xaxis: {
					lines: {
						show: false
					},
				},
				yaxis: {
					lines: {
						show: false
					},
				}
			},
			legend: {
				floating: true,
				position: 'top',
				horizontalAlign: 'right',
				offsetY: 0,
				markers: {
					width: 20,
				}
			},
			title: {
				text: 'Conversions',
				align: 'left',
				style: {
					fontSize:  '18px',
					fontWeight:  'bolder',
					color:  '#263238'
				},
			},
			tooltip: {
				shared: true
			}
		}

		var chartBar = new ApexCharts(document.querySelector('#bar'), optionsBar);
		chartBar.render();

		var options = {
			dataLabels: { enabled: false},
			series: [44, 17, 15],
			labels: ['Delo to Shell', 'Rubia to Shell', 'Zic to Shell'],
			chart: {
				type: 'donut',
				width:320,
				offsetX: -30,
			},
			title: {
				text: 'Top Converted Brands',
				align: 'left',
				offsetX: 25,
				style: {
					fontSize:  '18px',
					fontWeight:  'bolder',
					color:  '#263238'
				},
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
		var chart = new ApexCharts(document.querySelector("#chart_11"), options);
		chart.render();

		var options = {
			dataLabels: { enabled: false },
			series: [44, 17, 15],
			labels: ['Akbar Khan', 'Akbar Khan', 'Akbar Khan'],
			chart: {
				type: 'donut',
				width:320,
				offsetX: -30,
			},
			title: {
				text: 'Best Performing Member',
				align: 'left',
				offsetX: 25,
				style: {
					fontSize:  '18px',
					fontWeight:  'bolder',
					color:  '#263238'
				},
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
		var chart = new ApexCharts(document.querySelector("#chart_12"), options);
		chart.render();


		$('.data_select').on('change', function(){
			if ( $(this).val() ){
				$(this).addClass('data_select2');
			}else{
				$(this).removeClass('data_select2');
			}
		});
	</script>

@endsection


