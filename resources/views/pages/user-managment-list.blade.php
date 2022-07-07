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
		<div class="col-md-3">
			<div class="card card-custom gutter-b">
			    <!--begin::Body-->
			    <div class="card-body pt-3 pb-3">

					<div class="mr-2">
						<div class="d-flex align-items-center justify-content-between flex-grow-1">
							<span class="display-3 font-weight-bolder" id="role_2">0</span>
							{{ Metronic::getSVG("media/svg/icons/Home/Library.svg", "svg-icon-2x svg-icon-primary d-block my-2") }}
						</div>
		    			<p class="font-size-lg mb-1"> Total Brand Ambassadors </p>
					</div>

					<div id="chart"></div>
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="card card-custom gutter-b">
			    <!--begin::Body-->
			    <div class="card-body pt-3 pb-3">
			    	
					<div class="mr-2">
						<div class="d-flex align-items-center justify-content-between flex-grow-1">
							<span class="display-3 font-weight-bolder" id="role_5"></span>
							{{ Metronic::getSVG("media/svg/icons/Design/Layers.svg", "svg-icon-2x svg-icon-danger my-2 p-1") }}
						</div>
		    			<p class="font-size-sm mb-1"> Total Loyalty Program Members </p>
					</div>
			    	
					<div id="chart2"></div>
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="card card-custom gutter-b">
			    <!--begin::Body-->
			    <div class="card-body pt-3 pb-3">

					<div class="mr-2">
						<div class="d-flex align-items-center justify-content-between flex-grow-1">
							<span class="display-3 font-weight-bolder" id="role_4"></span>
							{{ Metronic::getSVG("media/svg/icons/Communication/Urgent-mail.svg", "svg-icon-2x svg-icon-warning d-block my-2") }}
						</div>
		    			<p class="font-size-sm mb-1"> Total Ustad Mechanics </p>
					</div>

					<div id="chart3"></div>
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="card card-custom gutter-b">
			    <!--begin::Body-->
			    <div class="card-body pt-3 pb-3">

					<div class="mr-2">
						<div class="d-flex align-items-center justify-content-between flex-grow-1">
							<span class="display-3 font-weight-bolder" id="role_9"></span>
							{{ Metronic::getSVG("media/svg/icons/Design/PenAndRuller.svg", "svg-icon-2x svg-icon-danger d-block my-2 ") }}
						</div>
		    			<p class="font-size-sm mb-1"> Total Truck Drivers </p>
					</div>

					<div id="chart4"></div>
				</div>
			</div>
		</div>

		<!-- <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#user_update">Modal - xl</button> -->

		<div class="col-md-12">
			<!--begin::Card-->
			<div class="card card-custom">
				<div class="card-header pl-2">
					<div class="card-title col-md-3">
						{{ Metronic::getSVG("media/svg/icons/Shopping/Chart-line1.svg", "svg-icon-2x svg-icon-primary d-block my-2 p-1 ml-2") }}
						<h3 class="card-label">User Management</h3>

					</div>

					{{-- <div class="card-toolbar col-md-8 d-flex justify-content-end">
						<div class="form-group row m-0 col-md-6">							
							<div class="col-sm-8">
								<div class="input-group date">
									<input type="text" class="form-control @error('d_o_b') is-invalid @enderror" name="d_o_b" id="kt_datepicker_3" placeholder="Select date">
									<div class="input-group-append">
										<span class="input-group-text">
											<i class="la la-calendar-check-o"></i>
										</span>
									</div>
								</div>
							</div>

						</div>
					</div> --}}
				</div>

				<div class="card-body">
					<!--begin: Datatable-->


					<div class="row d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">


						<div class="col-md-4 my-2 my-md-0">
							<div class="input-icon">
								<input type="text" class="form-control" placeholder="Search..." id="generalSearch" />
								<span>
									<i class="flaticon2-search-1 text-muted"></i>
								</span>
							</div>
						</div>

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
											<a id="export_print" class="navi-link" href="#" onclick="btnPress(this);">
												<span class="navi-icon">
													<i class="la la-print"></i>
												</span>
												<span class="navi-text">Print</span>
											</a>
										</li>
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

							<a href="{{ route('user-management-add') }}" class="btn btn-primary font-weight-bolder">
								<span class="svg-icon svg-icon-md">
								<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Design/Flatten.svg-->
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<rect x="0" y="0" width="24" height="24"></rect>
										<circle fill="#000000" cx="9" cy="15" r="6"></circle>
										<path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3"></path>
									</g>
								</svg>
								<!--end::Svg Icon-->
								</span>
								Create User
							</a>
						</div>
						</div>
						<hr/>
						<table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
						<thead>
							<tr>
								<th class="export">Full Name</th>
								<th class="export">User Name</th>
								{{--<th>Last Name</th>--}}
								<th class="export">CNIC</th>
								<th class="export">Date of Birth</th>
								<th class="export">User Type</th>
								{{-- <th>Password</th> --}}
								<th class="export">Registration City</th>
								<th class="export">Status</th>
								<th class="export">Date</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
						</table>

				</div>
			</div>
			<!--end::Card-->
		</div>

	</div>

	@endsection

	{{-- Scripts Section --}}
	@section('scripts')
		<script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
		<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
		<script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}" type="text/javascript"></script>

		<script type="text/javascript">

			$(function(){

				var options = {
					series: [{
						data: []
					}],
					chart: {
						height: 100,
						parentHeightOffset: 0,
						width:160,
						type: 'line',
						zoom: {
							enabled: false
						},
						toolbar: {
							show: false
						},
					},
					dataLabels: {
						enabled: false
					},
					stroke: {
						curve: 'smooth'
					},
					grid: {
						show: false,
					},
					yaxis: {
						show: false,
					},
					xaxis: {
						categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
						labels: {
							show: false,
						},
					},
					colors: ['#A4B3FF'],
				};

				var chart = new ApexCharts(document.querySelector("#chart"), options);
				chart.render();

				var options = {
					series: [{
						data: []
					}],
					chart: {
						height: 100,
						parentHeightOffset: 0,
						width:160,
						type: 'line',
						zoom: {
							enabled: false
						},
						toolbar: {
							show: false
						},
					},
					dataLabels: {
						enabled: false
					},
					stroke: {
						curve: 'smooth'
					},
					grid: {
						show: false,
					},
					yaxis: {
						show: false,
					},
					xaxis: {
						categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
						labels: {
							show: false,
						}
					},
					colors:['#0ABB87']
				};

				var chart2 = new ApexCharts(document.querySelector("#chart2"), options);
				chart2.render();

				var options = {
					series: [{
						data: []
					}],
					chart: {
						height: 100,
						parentHeightOffset: 0,
						width:160,
						type: 'line',
						zoom: {
							enabled: false
						},
						toolbar: {
							show: false
						},
					},
					dataLabels: {
						enabled: false
					},
					stroke: {
						curve: 'smooth'
					},
					grid: {
						show: false,
					},
					yaxis: {
						show: false,
					},
					xaxis: {
						categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
						labels: {
							show: false,
						},
					},
					colors:['#FFB822']
				};

				var chart3 = new ApexCharts(document.querySelector("#chart3"), options);
				chart3.render();

				var options = {
					series: [{
						data: []
					}],
					chart: {
						height: 100,
						parentHeightOffset: 0,
						width:160,
						type: 'line',
						zoom: {
							enabled: false
						},
						toolbar: {
							show: false
						},
					},
					dataLabels: {
						enabled: false
					},
					stroke: {
						curve: 'smooth'
					},
					grid: {
						show: false,
					},
					yaxis: {
						show: false,
					},
					xaxis: {
						categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
						labels: {
							show: false,
						},
					},
					colors:['#FC4C87']
				};

				var chart4 = new ApexCharts(document.querySelector("#chart4"), options);
				chart4.render();


				$(document).ready(function() {
						oTable = $('#kt_datatable').DataTable( {
							dom: 'Bfrtip',
							responsive: true,
							buttons: [
								{
									extend: 'print',
									exportOptions: {
										columns: '.export',
										orthogonal: 'export',
									}
								},
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
									url:"{{ route('ajax-user-list') }}",
									method: "POST",
									data: {
										"_token": "{{ csrf_token() }}",
										"date_filter" : function(){
											return $('#kt_datepicker_3').val();
										},
									},
								},
								columns: [
									{ data: 'first_name' },//, render: function (data, type, row) {
										// 	return row.first_name+" "+row.last_name;
										// } },
									//{ data: 'last_name' },
									{ data: 'user_name' },
									{ data: 'cnic' },
									{ data: 'd_o_b' },
									{ data: 'role' },
									// { data: 'password_text' },
									{ data: 'location_to_be_place' },
									{ data: 'status' },
									{ data: 'date' },
									{ data: 'action' }
								],
								columnDefs: [
						    	{
						    		targets: 0,
						    		render: function(data, type, row, meta) {
										if(type === 'export'){
											return row.first_name + ` ` + row.last_name;
										}else{
											var output = `<a href="/user-managment-details/` + row.id + `" title="View User Profile"
						                                <div class="d-flex align-items-center">
						                                    <div class="symbol symbol-50 symbol-light-success" flex-shrink-0">
						                                        <div class="symbol-label font-size-h5">` + row.first_name.substring(0, 1) + `</div>
						                                    </div>
						                                    <div class="ml-3">
						                                        <span class="text-dark-75 font-weight-bold line-height-sm d-block pb-2">` + row.first_name + ` ` + row.last_name + `</span>
						                                    </div>
						                                </div>
					                                </a>
						    						`;
						    			return output;
										}
						    		}
						    	},
								{
						    		targets: 6,
						    		render: function(data, type, row, meta) {
						    			var output = "";
										if(row.status == 1)
										{
											output = '<span class="label label-lg font-weight-bold label-light-success label-inline">Active</span>';
										}else{
											output = '<span class="label label-lg font-weight-bold label-inline">Inactive</span>';
										}
						    			return output;
						    		}
						    	},
						    ],
						} );
					} );

					$('#generalSearch').keyup(function(){
						oTable.search($(this).val()).draw() ;
					});

				$('#kt_datepicker_3').on('change', function(){
					table.draw();
				});


				$('.data_select').on('change', function(){
					if ( $(this).val() ){
						$(this).addClass('data_select2');
					}else{
						$(this).removeClass('data_select2');
					}
				});

    			$.ajax({
    				type : "GET",
    				url  : "{{ route('ajax-get-user-member') }}",
    				data : {
    					"_token" : "{{ csrf_token() }}",
    				},
    				async : false,
    				cache : false,
    				success : function (response){
    					var list = JSON.parse(response);
    					list.forEach(assign_value);
    				}
    			});

    			$.ajax({
    				type : "GET",
    				url  : "{{ route('ajax-get-the-user-member-graph') }}",
    				data : {
    					"_token" : "{{ csrf_token() }}",
    				},
    				async : false,
    				cache : false,
    				success : function(response){
    					var list = JSON.parse(response);
    					refill_graph(list);
    				}
    			});

    			function refill_graph(data){
					chart.updateSeries([
						{ data: data.brand_ambassador, }
					]);

					chart3.updateSeries([
						{ data: data.total_ustad, }
					]);

					chart4.updateSeries([
						{ data: data.truckers, }
					]);
				}

	    	});  

			function assign_value(values){
				//console.log(values.id);
				$('#role_'+values.id).html(values.total);
			}

			function btnPress(btn){
				if(btn.id == 'export_print'){
					pBtn = document.getElementsByClassName('buttons-print')[0];
				}else if(btn.id == 'export_copy'){
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
		<!--end::Page Vendors-->
	@endsection


