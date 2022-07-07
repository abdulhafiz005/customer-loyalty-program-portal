{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}

@section('content')
<style>
	.dataTables_filter, .dt-buttons { display: none; }
	#kt_datatable_info { float:right; }
</style>
	<div class="row">

		<div class="col-md-6 col-lg-6 ">
			<div class="card card-custom gutter-b card-stretch" style="height: 350px">
				<div class="card-body p-1">
						<div id="truckerInterceptions"></div>
				</div>
			</div>
		</div>

		<div class="col-md-6 col-lg-6 ">
			<div class="card card-custom gutter-b card-stretch" style="height: 350px">
				<div class="card-body p-1">
						<div id="truckerSales"></div>
				</div>
			</div>
		</div>

		<div class="col-md-12">
			<!--begin::Card-->
			<div class="card card-custom">
				<div class="card-header pl-2">
					<div class="card-title col-md-3">
						{{ Metronic::getSVG("media/svg/icons/Shopping/Chart-line1.svg", "svg-icon-2x svg-icon-primary d-block my-2 p-1 ml-2") }}
						<h3 class="card-label">Truck Drivers</h3>
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

							<div class="card-toolbar">
								<!--begin::Dropdown-->
								@if($role -> hasPermissionTo('Export Data'))
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
								@endif
								<!--end::Dropdown-->
								@if($role -> hasPermissionTo('Write Trucker'))
								<a href="{{ route('trucker-profile-add') }}" class="btn btn-primary font-weight-bolder">
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
									Create Trucker
								</a>
								@endif
							</div>
					</div>

					<hr/>
					<table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
						<thead>
							<tr>
								<th class="export">Name</th>
								<th class="export">CNIC</th>
								<th class="export">Phone</th>
								<!-- <th class="export">Member ID</th> -->
								<th class="export">Date of Birth</th>
								<th class="export">Date Added</th>
								<th class="export">Registration City</th>
								<th class="export">Driving Experience</th>
								<th class="export">Current Truck</th>
								<th class="export">No of Purchases</th>
								@if($role -> hasPermissionTo('Convert Trucker') | $role -> hasPermissionTo('Write Purchase'))
									<th>Action</th>
								@endif
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>


					<!-- <div class="table-responsive">
						<table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
							<thead>
								<tr>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Phone</th>
									<th>Member ID</th>
									<th>Date of Birth</th>
									<th>Registration City</th>
									<th>Driving Experience</th>
									<th>Current Truck</th>
									<th>No of Purchases</th>
									<th>Action</th>
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
		</div>

		<div class="modal fade" id="add_purchase" tabindex="-1" aria-labelledby="add_purchase" style="display: none;" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Add Purchases</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<i aria-hidden="true" class="ki ki-close"></i>
						</button>
					</div>

					<div class="modal-body">
						<form id="purchase" enctype="multipart/form-data" >
						</form>

						<form id="edit_profile_form" enctype="multipart/form-data" >
						</form>
					</div>

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
	<script src="{{ asset('js/pages/crud/datatables/extensions/buttons.js') }}"></script>

	<script type="text/javascript">

		$('#addition_Ar').hide();
        // $('#kt_datatable thead tr:eq(1) th').each(function() {
        //     $(this).css("width", "10%");
		//
        //     var title = $(this).text();
		//
        //     if (title != 'Action') {
        //         $(this).html('<input type="text" class="search_datatable" placeholder="Search " />');
        //         $(this).css("width", "10%");
        //     } else {
        //         $(this).html('');
        //         $(this).css("width", "5%");
        //     }
		//
        // });

		var truckerInterceptionsOptions = {
			series: [

			],
			chart: {
				type: 'bar',
				height: 300,
				width: '100%',
				parentHeightOffset: 0,
				toolbar: {
					show: false
				},
			},
			plotOptions: {
				bar: {
					horizontal: false,
					columnWidth: '90%',
					endingShape: 'flat'
				},
			},
			dataLabels: {
				enabled: false
			},
			stroke: {
				show: true,
				width: 2,
				colors: ['transparent']
			},
			xaxis: {

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
				},
			},
			fill: {
				opacity: 1
			},

			legend: {
				floating: true,
				position: 'top',
				horizontalAlign: 'right',
				offsetY: -20,
			},
			title:{
				text: 'City-wise Conversions',
				style:{
					fontSize: '20px',
					fontWeight:  'bold',
				},
			},
			colors:['#F1A5A6','#8A9BF1']
		};

		var truckerInterceptions = new ApexCharts(document.querySelector("#truckerInterceptions"), truckerInterceptionsOptions);
		truckerInterceptions.render();

		var truckerSalesOptions = {
			series: [
				{
					name: 'Shell User',
					data: [0, 0, 0, 0, 0, 0, 100]
				},
				{
					name: 'Other Brands User',
					data: []
				}
			],
			chart: {
				height: 350,
				type: 'area',
				parentHeightOffset: 0,
				toolbar: {
					show: false
				},
				dropShadow: {
                    enabled: true,
                    top: 5,
                    left: 0,
                    blur: 0,
                    opacity: 0.5
                }
			},
			fill: {
				opacity: 1
			},
			legend: {
				floating: true,
				position: 'top',
				horizontalAlign: 'right',
				offsetY: -30,
				markers:{
					width: 20
				},
			},
			dataLabels: {
				enabled: false
			},
			stroke: {
				curve: 'smooth',
				width: 0,
			},
			title:{
				text: 'Market Share',
				style:{
					fontSize: '20px',
					fontWeight:  'bold',
				},
			},
			colors:['#E4E8F7', '#F1A5A6']
		};

		var truckerSales = new ApexCharts(document.querySelector("#truckerSales"), truckerSalesOptions);
		truckerSales.render();


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
						url:"{{ route('ajax-trucker-list') }}",
						method: "POST",
						data: {
							"_token": "{{ csrf_token() }}",
							// startDate: function(){
							// 	var start = JSON.parse(localStorage.getItem("start_date"));
							// 	if (start) {
							// 		return start[0];
							// 	}else{
							// 		return 0;
							// 	}
							// },
							// endDate: function(){
							// 	var end = JSON.parse(localStorage.getItem("end_date"));
							// 	if (end) {
							// 		return end[0];
							// 	}else{
							// 		return 0;
							// 	}
							// },
							// city: function(){
							// 	if (localStorage.getItem('city') != null) {
							// 		return $.trim(localStorage.getItem('city'));
							// 	}else{
							// 		return 'All Cities';
							// 	}
							//}
						},
					},
				columns: [
					{ data: 'first_name' },
					{ data: 'cnic' },
					{ data: 'contact' },
					// { data: 'member_id' },
					{ data: 'd_o_b' },
					{ data: 'date_added' },
					{ data: 'b_city' },
					{ data: 'driving_exp' },
					{ data: 'vehicle_no' },
					{ data: 'count' },
					@if($role -> hasPermissionTo('Convert Trucker') | $role -> hasPermissionTo('Write Purchase'))
						{ data: 'action' },
					@endif
				],
				columnDefs: [
				{
					targets: 0,
		    		render: function(data, type, row, meta) {
						if(type === 'export'){
							return row.first_name + ` ` + row.last_name;
						}else{
		    			var output = `<a href="/trucker-profile-detail/` + row.id + `" title="View Trucker Profile"
		                                <div class="d-flex align-items-center">
		                                    <div class="symbol symbol-50 symbol-light-success" flex-shrink-0">
		                                        <div class="symbol-label font-size-h5">` + row.first_name.substring(0, 1) + `</div>
		                                    </div>
		                                    <div class="ml-3">
		                                        <span class="text-dark-75 font-weight-bold line-height-sm d-block pb-2">` + row.first_name + ` ` + row.last_name + `</span>
		                                    </div>
		                                </div>
	                                </a>`;
		    			return output;
						}
		    		}
				}],
			} );
		} );

		$('#generalSearch').keyup(function(){
			oTable.search($(this).val()).draw() ;
		});

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

		function getPurchaseForm(id){
			$.ajax({
				type: "Get",
				url:"{{ route('ajax-trucker-form') }}",
				data: {
					"_token": "{{ csrf_token() }}",
					"user_id" : id
				},
				async: false,
				cache: false,
				success: function (response) {
					$('#add_purchase .modal-body #purchase').html(response);
					$('#add_purchase').modal('show');
					$('.modal-body #kt_touchspin_3').TouchSpin({
						buttondown_class: 'btn btn-secondary',
						buttonup_class: 'btn btn-secondary',
						min: -1000000000,
						max: 1000000000,
						stepinterval: 50,
						maxboostedstep: 10000000
					});

					$('.modal-body #ustad_mechanic').select2({
						multiple: false,
					});

					$('.modal-body #vehicle_id').select2({
						multiple: false,
						tags: true,
					});

					arrows = {
						leftArrow: '<i class="la la-angle-left"></i>',
						rightArrow: '<i class="la la-angle-right"></i>'
					}

					$('#kt_datepicker_2').datepicker({
						todayBtn: "linked",
						clearBtn: true,
						todayHighlight: true,
						templates: arrows
					});

					document.getElementById('kt_touchspin_3').value = 1;
				}
			});
		}

			$("body #purchase").on('submit', function(e){
				e.preventDefault();
				var formData = new FormData(this);
    			formData.append("_token", "{{ csrf_token() }}");
				$.ajax({
					type: 'POST',
					url:"{{ route('ajax-trucker-form-submit') }}",
					// dataType: "JSON",
					data: formData,
					async: false,
					cache: false,
					processData: false,
					contentType: false,
					success: function (response) {
						if (response) {
							var rr = JSON.parse(response);
							$('#add_purchase').modal('toggle');
							alert(rr.msg);
							$('#add_purchase .modal-body #purchase').html('');
							location.reload(true);
						}
					}
				});
			});

		function getData(){
			// var city     = getSelectedCity();
            var dateData = getSelectedDate();
			return $.ajax({
				type: "Get",
				url:"{{ route('ajax-trucker-chart') }}",
				data: {
					"_token": "{{ csrf_token() }}",
					start: dateData.start_date,
                    end  : dateData.end_date,
                    // city : city,
				},
				async: false,
				cache: false,
				success: function (response) {
					var r = JSON.parse(response);

					truckerInterceptions.updateSeries([
						{ name: 'Converted', data: r.truckerInterceptionsResponse.truckersConverted, },
						{ name: 'Already using Shell', data: r.truckerInterceptionsResponse.truckersExisting, },
					]);

					truckerSales.updateSeries([
						{ name: 'Shell User', data: r.truckerSales.n_shell_sales, },
						{ name: 'Other User', data: r.truckerSales.shell_sales, },
					]);

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
	</script>
@endsection


