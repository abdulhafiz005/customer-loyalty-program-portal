{{-- Extends layout --}}
	@extends('layout.default')

	{{-- Content --}}
	@section('content')

	{{-- Dashboard 1 --}}
<style>
	.dataTables_filter, .dt-buttons { display: none; }
	#kt_datatable_info { float:right; }
</style>
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
			<div class="card card-custom gutter-b p-2" style="height: 200px; overflow: scroll;">
				<div class="card-body p-5">
					<h4 class="font-weight-bold">Interceptions by Cities</h4>
					<hr/>
					<div class="row p-1" id="chars_div_interceptions">
						<!-- <div class="col-6  pl-5 pr-5 text-center">
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
						</div> -->
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
				<h3 class="card-label">Trucker Interceptions</h3>
			</div>
			<div class="card-toolbar col-md-8">
				<div class="form-group row m-0 pr-1 pl-1 col-md-4">
					<label class="col-sm-3 pr-1 pl-1 col-form-label">By Role</label>
					<div class="col-sm-9 pr-1 pl-1">
						<select class="form-control data_select" id="exampleSelect1">
							<option selected value="2">Brand Ambassador</option>
							<option value="5">Safeer Truck Driver</option>
							<option value="4">Ustad Mechanic</option>
						</select>
					</div>
				</div>
			</div>
		</div>

		<div class="card-body">
			<!--begin: Datatable-->


            <div class="row d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <div>
                    <div class="input-icon">
                        <input type="text" class="form-control" placeholder="Search..." id="generalSearch" />
                        <span>
                            <i class="flaticon2-search-1 text-muted"></i>
                        </span>
                    </div>
                </div>
			@if($role -> hasPermissionTo('Export Data'))
                <div class="card-toolbar">
                    <!--begin::Dropdown-->
                    <div class="dropdown dropdown-inline mr-2">
                        <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="svg-icon svg-icon-md">
                            <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Design/PenAndRuller.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
                                    <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>Export</button>
                        <!--begin::Dropdown Menu-->
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                            <!--begin::Navigation-->
                            <ul class="navi flex-column navi-hover py-2">
                                <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
                                <li class="navi-item">
                                    <a id="export_copy" class="navi-link" href="#" onclick="btnPress(this);">
                                        <span class="navi-icon">
                                            <i class="la la-copy"></i>
                                        </span>
                                        <span class="navi-text">Copy</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a id="export_excel" class="navi-link" href="#" onclick="btnPress(this);">
                                        <span class="navi-icon">
                                            <i class="la la-file-excel-o"></i>
                                        </span>
                                        <span class="navi-text">Excel</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a id="export_csv" class="navi-link" href="#" onclick="btnPress(this);">
                                        <span class="navi-icon">
                                            <i class="la la-file-text-o"></i>
                                        </span>
                                        <span class="navi-text">CSV</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a id="export_pdf" class="navi-link" href="#" onclick="btnPress(this);">
                                        <span class="navi-icon">
                                            <i class="la la-file-pdf-o"></i>
                                        </span>
                                        <span class="navi-text">PDF</span>
                                    </a>
                                </li>
                            </ul>
                            <!--end::Navigation-->
                        </div>
                        <!--end::Dropdown Menu-->
                    </div>
                    <!--end::Dropdown-->
                </div>
				@endif
                </div>
                <hr/>
                <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                <thead>
                    <tr>
                        <th class="export">Trucker Name</th>
                        <th class="export">Truck No</th>
                        <th class="export">Phone No</th>
						<th class="export">CNIC</th>
                        <th class="export">Location</th>
                        <th class="export">Agent</th>
                        <th class="export">Status</th>
                        <th class="export">Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                </table>


			<!-- <div class="table-responsive">
				<table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
					<thead>
						<tr>
							<th>Trucker Name</th>
							<th>Vehicle No</th>
							<th>Contact No</th>
							<th>Location</th>
							<th>Agent</th>
							<th>Status</th> -->
							<!-- <th>Comment</th> -->
							<!-- <th>Actions</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
            </div> -->
			<!--end: Datatable-->
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
               var table = $('#kt_datatable').DataTable( {
                        dom: 'Bfrtip',
                        responsive: true,
                        buttons: [
						{
							extend: 'copyHtml5',
							exportOptions: {
								columns: '.export',
								orthogonal: 'export',
							}
						},
						{
							extend: 'excelHtml5',
							exportOptions: {
								columns: '.export',
								orthogonal: 'export',
							}
						},
						{
							extend: 'csvHtml5',
							exportOptions: {
								columns: '.export',
								orthogonal: 'export',
							}
						},
						{
							extend: 'pdfHtml5',
							exportOptions: {
								columns: '.export',
								orthogonal: 'export',
							}
						},
                        ],
                            "aaSorting": [],
                            "order": [],
                            ajax: {
                                url: "{{ route('ajax-interception-list') }}",
                                method: "POST",
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    type: function(){
											console.log($('#exampleSelect1').val());
											return $('#exampleSelect1').val();
										},
                                    startDate: dateData.start_date,
                                    endDate: dateData.end_date,
                                    city: city,
                                },
                            },
                            columns: [
						    		{data: 'trucker_first_name'},
						            {data: 'vehicle_no'},
						            {data: 'contact_no'},
									{data: 'cnic'},
						            {data: 'location'},
						            {data: 'agent_first_name'},
						            {data: 'interception_status'},
						            {data: 'date'},
						            {data: 'action'},
						    ],
						    columnDefs: [
						    	{
						    		targets: 0,
						    		render: function(data, type, row, meta) {
										if(type === 'export'){
											return row.trucker_first_name + " " + row.trucker_last_name;
										}else{
											var output = `<a href="/trucker-profile-detail/` + row.trucker_id + `" title="View Trucker Profile"
															<div class="d-flex align-items-center">
																<div class="symbol symbol-50 symbol-light-success" flex-shrink-0">`;
																	if(row.trucker_first_name == ""){
																		output += `<div class="symbol-label font-size-h5">N</div>`;
																	}else{
																		output += `<div class="symbol-label font-size-h5">` + row.trucker_first_name.substring(0, 1) + `</div>`;
																	}
													output += `</div>
																<div class="ml-3">
																	<span class="text-dark-75 font-weight-bold line-height-sm d-block pb-2">` + row.trucker_first_name + ` ` + row.trucker_last_name + `</span>
																</div>
															</div>
														</a>
														`;
											return output;
										}
						    		}
						    	},
						    	{
						            targets: 5,
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
										if(type === 'export'){
											return row.agent_first_name + ` ` + row.agent_last_name;
										}else{
											var output = `
					                                <a href="/user-managment-details/` + row.agent + `" title="View Agent Profile">
						                                <div class="d-flex align-items-center">
						                                    <div class="symbol symbol-50 symbol-light-success" flex-shrink-0">
						                                        <div class="symbol-label font-size-h5">` + row.agent_first_name.substring(0, 1) + `</div>
						                                    </div>
						                                    <div class="ml-3">
						                                        <span class="text-dark-75 font-weight-bold line-height-sm d-block pb-2">` + row.agent_first_name + ` ` + row.agent_last_name + `</span>
						                                    </div>
						                                </div>
					                                </a>`;

						                	return output;
										}
						            },
						        },
						        {
						            targets: 6,
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
                    });

					$('#generalSearch').keyup(function(){
						table.search($(this).val()).draw() ;
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
					async: true,
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
								width:280,
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
							noData: {
								text: "No Data.",
								align: 'center',
								verticalAlign: 'middle',
								offsetX: 50,
								offsetY: -32,
								style: {
									fontSize: '14px',
								}
							},
							colors: ['#798DF1', '#C39CC3', '#D66D6F']
						};
                        console.log(data.top_brands.switch_from_counts);
                        console.log(data.top_brands.switch_from_label);
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
								width: 290,
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
							noData: {
								text: "No Data.",
								align: 'center',
								verticalAlign: 'middle',
								offsetX: 50,
								offsetY: -32,
								style: {
									fontSize: '14px',
								}
							},
							colors: ['#C3E29C', '#A698DB', '#92D7CE']
						};
                        console.log(data.top_users.user_counts);
                        console.log(data.top_users.user_label);
						var chart = new ApexCharts(document.querySelector("#chart_12"), options);
						chart.render();

						var dom = "";
						data.top_cities.all_interceptions.forEach(function(interception){
							dom += '<div class="col-3  pl-2 pr-2 pb-2 text-center"><h3 class="font-weight-bolder" id="interceptions_"'+interception.location+'>'+interception.total_count+'</h3><p class="font-size-sm" style="text-transform: capitalize;">'+interception.location+'</p></div>';
						});
						$('#chars_div_interceptions').html(dom);
						// $('#interceptions_karachi').html(data.top_cities.total_karachi_interceptions); 
						// $('#interceptions_lahore').html(data.top_cities.total_lahore_interceptions);
						// $('#interceptions_islamabad').html(data.top_cities.total_islamabad_interceptions);
					}
				});
			}

			function city_function(city)
			{
				$('#city_holder').html(city);
            	localStorage.setItem("city", city);
				getData();
				table.draw();
			}

			$(function() {

				$('#exampleSelect1').on('change', function(){
					//testAjaxRoute();
					var table = $('#kt_datatable').DataTable();
					table.ajax.reload();
                    table.columns(1).visible(true);
					getData();
				});

				$('.data_select').on('change', function(){
					if ( $(this).val() ){
						$(this).addClass('data_select2');
					}else{
						$(this).removeClass('data_select2');
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
				getData();
			});

            function btnPress(btn){
                if(btn.id == 'export_copy'){
					pBtn = document.getElementsByClassName('buttons-copy')[0];
				}else if(btn.id == 'export_excel'){
					pBtn = document.getElementsByClassName('buttons-excel')[0];
				}else if(btn.id == 'export_csv'){
					pBtn = document.getElementsByClassName('buttons-csv')[0];
				}else if(btn.id == 'export_pdf'){
					pBtn = document.getElementsByClassName('buttons-pdf')[0];
				}
				pBtn.click();
			}

		</script>
		<!--end::Page Scripts-->
@endsection


