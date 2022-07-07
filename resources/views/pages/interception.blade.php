{{-- Extends layout --}}
	@extends('layout.default')

	{{-- Content --}}
	@section('content')

	{{-- Dashboard 1 --}}

	<div class="row">

		<div class="col-md-3 col-12">
			<div class="card card-custom gutter-b card-stretch p-2" style="height: 200px;">
				<!--begin::Body-->
				<div class="card-body p-1">
					<!--begin::Chart-->
						<div id="bar"></div>
					<!--end::Items-->
				</div>
				<!--end::Body-->
			</div>
		</div>

		<div class="col-md-3 col-12">
			<div class="card card-custom gutter-b p-2" style="height: 200px;">
				<div class="card-body p-2" >
					<!--begin::Chart-->
						<div id="chart_11"></div>
					<!--end::Chart-->
				</div>
			</div>
		</div>

		<div class="col-md-3 col-12">
			<div class="card card-custom gutter-b p-2" style="height: 200px;">
				<div class="card-body p-2" >
					<!--begin::Chart-->
						<div id="chart_12"></div>
					<!--end::Chart-->
				</div>
			</div>
		</div>

		<div class="col-md-3 col-12">
			<div class="card card-custom gutter-b p-2" style="height: 200px;">
				<div class="card-body p-5">
					<h4 class="font-weight-bold">Interceptions by Cities</h4>

					<div class="row p-1">
						<div class="col-6  pl-5 pr-5 text-center">
							<h3 class="display-4 font-weight-bolder" id="interceptions_karachi"></h3>
							<p class="font-size-sm">Karachi</p>
						</div>

						<div class="col-6  pl-5 pr-5 text-center">
							<h3 class="display-4 font-weight-bolder" id="interceptions_lahore"></h3>
							<p class="font-size-sm">Lahore</p>
						</div>

						<div class="col-6  pl-5 pr-5 text-center">
							<h3 class="display-4 font-weight-bolder" id="interceptions_islamabad"></h3>
							<p class="font-size-sm">Islamabad</p>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>


	<!--begin::Card-->
	<div class="card card-custom">
		<div class="card-header pl-2">
			<div class="card-title col-md-3">
				{{ Metronic::getSVG("media/svg/icons/Shopping/Chart-line1.svg", "svg-icon-2x svg-icon-primary d-block my-2 p-1 ml-2") }}
				<h3 class="card-label">Interceptions</h3>

			</div>
			<div class="card-toolbar col-md-8">

				<div class="form-group row m-0 pr-1 pl-1 col-md-4">
					<label for="inputPassword" class="col-sm-3 pr-1 pl-1 col-form-label">By Role</label>
					<div class="col-sm-9 pr-1 pl-1">
						<select class="form-control data_select" id="exampleSelect1">
							<option selected value="4">Ustad Mechanic</option>
							<option value="2">Brand Ambassador</option>
							<option value="3">Mechanic Supervisor</option>
						</select>
					</div>
				</div>

			</div>
		</div>
		<div class="card-body">
			<!--begin: Datatable-->
			<div class="table-responsive">
				<table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
					<thead>
						<tr>
							<th>Trucker Name</th>
							<th>Truck No</th>
							<th>Phone No</th>
							<th>Location</th>
							<th>Agent</th>
							<th>Date</th>
							<th>Status</th>
							<!-- <th>Comment</th> -->
							<th>Actions</th>
						</tr>

					</thead>

					<tbody>
					</tbody>

				</table>
				<!--end: Datatable-->
			</div>
		</div>
	</div>
	<!--end::Card-->

	<div class="modal fade" id="interception_details" tabindex="-1" aria-labelledby="interception_details" style="display: none;" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h6 class="modal-title" id="exampleModalLabel">Interception Detail</h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<i aria-hidden="true" class="ki ki-close"></i>
					</button>
				</div>

				<div class="modal-body">

				</div>

			</div>
		</div>
	</div>

	@endsection

	{{-- Scripts Section --}}
	@section('scripts')
		<script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
		<script src="{{ asset('js/pages/functions.js') }}" type="text/javascript"></script>
		<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>

		<!--end::Page Vendors-->

		<script type="text/javascript">
			var optionsBar = {
				chart: {
					type: 'bar',
					height: 210,
					stacked: true,
					foreColor: '#999',
					toolbar: {
						show: false
					},
				},
				yaxis: {
	                tickAmount: 5,
	            },
				dataLabels: {
					enabled: true,
					enabledOnSeries: true,
				},
				colors: ["#47C4AB", '#BA95BE'],
				series: [

				],
				//labels: ['1 Jan', '3 Jan', '5 Jan'],
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
					offsetY: -20,
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

			var buttonCommon = {
				exportOptions: {
					format: {
						body: function (data, column, row, node) {
							column[1].replace = 'Name';
							column[2].replace = 'Vehicle No';
							column[3].replace = 'Contact No';
							column[4].replace = 'Location';
							column[5].replace = 'First_name';
							column[6].replace = 'Status';
						}
					}
				}
       		};
       		var city     = getSelectedCity();
            var dateData = getSelectedDate();

			var table = $('#kt_datatable').DataTable({
			    // Pagination settings
			    dom: "<'row'<'col-sm-8'B><'col-sm-4 m-auto d-flex'l i>>" +
			        "<'row'<'col-sm-12'tr>>" +
			        "<'row'<'col-sm-4'><'col-sm-4 text-center'p><'col-sm-4'>>",
			    /*dom:"<'row flex-row-reverse'<'col-sm-6 d-flex 'l i>>"+""+
			    "<'row' <'col-md-6' p> >",*/
			    // read more: https://datatables.net/examples/basic_init/dom.html

			    lengthMenu: [5, 10, 25, 50],
			    scrollX: true,
			    pageLength: 10,
			    language: {
			        'lengthMenu': '_MENU_ ',
			    },
			    "aaSorting": [],
			    "order": [],
			    "ordering": false,
			    processing: true,
			    serverSide: true,
			    ajax: {
			        url: "{{ route('ajax-interception-list') }}",
			        method: "POST",
			        data: {
			            _token: "{{ csrf_token() }}",
			            type: function(){
			            	return $('#exampleSelect1').val();
			            },
			            startDate: dateData.start_date,
                        endDate: dateData.end_date,
                        city: city,
			        },
			    },
			    bAutoWidth: false,x
			    columns: [
			    		{data: 'trucker_first_name'},
			            {data: 'vehicle_no'},
			            {data: 'contact_no'},
			            {data: 'location'},
			            {data: 'agent_first_name'},
			            {data: 'interception_status'},
			            {data: 'action'},
			    ],
			    columnDefs: [
			    	{
			    		render: function(data, type, row, meta) {
			    			return row.trucker_first_name + ' ' + row.trucker_last_name;
			    		}
			    	},
			    	{
			            targets: 4,
			            //title: 'Agent',
			            render: function(data, type, row, meta) {
			                //var number = KTUtil.getRandomInt(1, 14);
			                // var user_img = '100_' + number + '.jpg';
		                    // output = `
		                    //             <div class="d-flex align-items-center">
		                    //                 <div class="symbol symbol-50 flex-shrink-0">
		                    //                     <img src="assets/media/users/` + user_img + `" alt="photo">
		                    //                 </div>
		                    //                 <div class="ml-3">
		                    //                     <span class="text-dark-75 font-weight-bold line-height-sm d-block pb-2">` + row.agent_first_name + ` ` + row.agent_last_name + `</span>

		                    //                 </div>
		                    //             </div>`;
		                    var output = `
		                                <div class="d-flex align-items-center">
		                                    <div class="symbol symbol-50 symbol-light-success" flex-shrink-0">
		                                        <div class="symbol-label font-size-h5">` + row.agent_first_name.substring(0, 1) + `</div>
		                                    </div>
		                                    <div class="ml-3">
		                                        <span class="text-dark-75 font-weight-bold line-height-sm d-block pb-2">` + row.agent_first_name + ` ` + row.agent_last_name + `</span>
		                                    </div>
		                                </div>`;

			                return output;
			            },
			        },
			        {
			            targets: 5,
			            render: function(data, type, row, meta) {
			                var status = {
			                    'pending': {
			                        'title': 'Conversion Pending',
			                        'class': 'label-light-info'
			                    },
			                    'converted': {
			                        'title': 'Success',
			                        'class': ' label-light-success'
			                    },
			                    'incomplete': {
			                        'title': 'Incomplete Data',
			                        'class': ' label-light-primary'
			                    },
			                };
			                if (typeof status[data] === 'undefined') {
			                    return data;
			                }
			                return '<span class="label label-lg font-weight-bold' + status[data].class + ' label-inline">' + status[data].title + '</span>';
			            },
			        },
			    ],
			    'orderable': false,

				buttons: [
					$.extend( true, {}, buttonCommon, {
						extend: 'copyHtml5'
					} ),
					$.extend( true, {}, buttonCommon, {
						extend: 'excelHtml5'
					} ),
					$.extend( true, {}, buttonCommon, {
						extend: 'pdfHtml5'
					} )
				]
			});

			table.columns().every(function() {
			    var that = this;

			    $('input', this.header()).on('keyup change', function() {
			        if (that.search() !== this.value) {
			            that
			                .search(this.value)
			                .draw();
			        }
			    });

			});

			$('#kt_datatable tbody').on('click', 'tr .get_interception', function (e) {
    			e.preventDefault();
    			var id = $(this).attr('data-id');

    			$.ajax({
					type: "POST",
					url:"{{ route('ajax-interception-details') }}",
					data:{
						"_token"  : "{{ csrf_token() }}",
						"interception_id" : id
					},
					async: false,
					cache: false,
					success: function (response) {
						$('.modal-body').html(response);
						$('#interception_details').modal('show');
					}
				});

    			/*$('#user_update').modal('show');*/
			} );


			function getData(){
				var city     = getSelectedCity();
            	var dateData = getSelectedDate();

				return $.ajax({
					type: "Get",
					url:"{{ route('ajax-interception-chart') }}",
					data: {
						role_id: function(){
							return $('#exampleSelect1').val();
						},
						start: dateData.start_date,
	                    end  : dateData.end_date,
	                    city : city,
					},
					async: false,
					cache: false,
					success: function (response) {
						data = JSON.parse(response);
						chartBar.updateSeries([
							{
								name: 'Interception',
								data: data.interceptions,
							},
							{
								name: 'Conversions',
								data: data.converted_interceptions
							}
						]);

						$('#chart_11').html('');
						$('#chart_12').html('');


						var options = {
							dataLabels: {
								enabled: false
							},
							series: data.top_brands.switch_from_counts,
							labels: data.top_brands.switch_from_label,
							chart: {
								type: 'donut',
								width:330,
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
						var chart2 = new ApexCharts(document.querySelector("#chart_11"), options);
						chart2.render();

						var options = {
							dataLabels: {
								enabled: false
							},
							series: data.top_users.user_counts,
							labels: data.top_users.user_label,

							chart: {
								type: 'donut',
								width: 300,
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

						$('#interceptions_karachi').html(data.top_cities.total_karachi_interceptions); 
						$('#interceptions_lahore').html(data.top_cities.total_islamabad_interceptions);
						$('#interceptions_islamabad').html(data.top_cities.total_islamabad_interceptions);
					}
				});
			}

			function city_function(city){
				$('#city_holder').html(city);
            	localStorage.setItem("city", city);
				getData();
				table.draw();
			}

			//getData().done();

			$(function() {

				$('#addition_Ar').hide();

				$('#exampleSelect1').on('change', function(){
					table.draw();
					if ($(this).val() == 3) {
						table.columns(1).visible(false);
					}else{
						table.columns(1).visible(true);
					}

					getData();


				});

				$('.data_select').on('change', function(){
					if ( $(this).val() ){
						$(this).addClass('data_select2');
					}else{
						$(this).removeClass('data_select2');
					}
				});

				$('#kt_datatable thead tr').clone(true).appendTo('#kt_datatable thead');
				$('#kt_datatable thead tr:eq(1) th').each(function() {
				 	$(this).css("width", "10%");
		    		var title = $(this).text();
		    		if (title != 'Actions') {
		        		$(this).html('<input type="text" class="search_datatable" placeholder="Search " />');
		        		$(this).css("width", "10%");

		    		} else {
		        		$(this).html('');
		        		$(this).css("width", "15%");

		    		}

				});

				$('#kt_dashboard_daterangepicker').on('apply.daterangepicker', function(ev, picker) {
					console.log('on apple date range values');
		            var start = $('#kt_dashboard_daterangepicker').data('daterangepicker').startDate.format('YYYY-MM-DD');
		            var end =   $('#kt_dashboard_daterangepicker').data('daterangepicker').endDate.format('YYYY-MM-DD');

		            console.log (start);
		            console.log (end);
		            localStorage.setItem('start_date', start);
		            localStorage.setItem('end_date', end);

		            getData();
					table.draw();
				});

				// fetch initial data with cached date and city values (if any)
            	getData();

			});

		</script>
		<!--end::Page Scripts-->
@endsection


