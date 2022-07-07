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

		<!-- <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#user_update">Modal - xl</button> -->

		<div class="col-md-12">
			<!--begin::Card-->
			<div class="card card-custom">
				<div class="card-header pl-2">
					<div class="card-title col-md-3">
						{{ Metronic::getSVG("media/svg/icons/Shopping/Chart-line1.svg", "svg-icon-2x svg-icon-primary d-block my-2 p-1 ml-2") }}
						<h3 class="card-label">Brand Ambassadors</h3>

					</div>
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
							</div>
						@endif
					</div>
					<hr/>
					<table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
					<thead>
						<tr>
							<th class="export">Full Name</th>
							<th class="export">User Name</th>
							<th class="export">CNIC</th>
							<th class="export">Date of Birth</th>
							<th class="export">Registration City</th>
							<th class="export">Registered Date</th>
							<!-- <th>Purchase</th>
							<th>Liters</th> -->
							@if($role -> hasPermissionTo('Write Brand Ambassador'))
								<th>Action</th>
							@endif	
						</tr>
					</thead>
					<tbody>
					</tbody>
					</table>


					<!-- <div class="table-responsive">
						<table class="table table-separate table-head-custom table-checkable" id="kt_datatable2">
							<thead>
								<tr>
									<th>User Name</th>
									<th>First Name</th>
									<th>Last Name</th>
									<th>CNIC</th>
									<th>Date of Birth</th>
									<th>Password</th>
									<th>Registration City</th>
									<th>Purchase</th>
									<th>Liters</th>
									<th>Action</th>
								</tr>
							</thead>

							<tbody>
							</tbody>

							<tfoot>
								<tr>
									<th>User Name</th>
									<th>First Name</th>
									<th>Last Name</th>
									<th>CNIC</th>
									<th>Date of Birth</th>
									<th>Password</th>
									<th>Location To Be Place</th>
									<th>Purchase</th>
									<th>Liters</th>
									<th>Action</th>
								</tr>
							</tfoot>
						</table>
					</div> -->
					<!--end: Datatable-->
				</div>
			</div>
			<!--end::Card-->
		</div>



		<!-- <div class="modal fade" id="user_update" tabindex="-1" aria-labelledby="user_update" style="display: none;" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-md" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h6 class="modal-title" id="exampleModalLabel">EDIT USER</h6>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<i aria-hidden="true" class="ki ki-close"></i>
						</button>
					</div>
					
					<div class="modal-body">
						
					</div>

				</div>
			</div>
		</div> -->

	</div>

	@endsection

	{{-- Scripts Section --}}
	@section('scripts')
		<script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
		<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
		<script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}" type="text/javascript"></script>

		<script type="text/javascript">

			var myPage = (function() {

				var that = {};

				that.init = function () {


					$(document).ready(function() {
						oTable = $('#kt_datatable').DataTable( {
							dom: 'Bfrtip',
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
									url:"{{ route('ajax-role-list') }}",
									method: "POST",
									data: {
										"_token": "{{ csrf_token() }}",
										'date_filter' : function(){
											return $('#kt_datepicker_3').val();
										},
										'role_id': 2
									},
								},
							columns: [
								{ data: 'first_name' },
								{ data: 'user_name' },
								{ data: 'cnic' },
								{ data: 'd_o_b' },
								{ data: 'location_to_be_place' },
								{ data: 'date' },
								// { data: 'purchases'},
								// { data: 'liters'},
								@if($role -> hasPermissionTo('Write Brand Ambassador'))
									{ data: 'action' }
								@endif
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
							],
						} );
					} );

					$('#generalSearch').keyup(function(){
						oTable.search($(this).val()).draw() ;
					});

					// $('#kt_datatable2 thead tr').clone(true).appendTo('#kt_datatable2 thead');
					// $('#kt_datatable2 thead tr:eq(1) th').each(function() {
					//     $(this).css("width", "10%");

					//     var title = $(this).text();

					//     if (title != 'Action') {
					//     	$(this).html('<input type="text" class="search_datatable" placeholder="Search " />'); 
					//     	$(this).css("width", "10%");   
					//     } else {
					//         $(this).html('');
					//         $(this).css("width", "5%");
					//     }

					// });

			      	// var table = $('#kt_datatable2').DataTable({
			        //     // Pagination settings
			        //     dom:  "<'row'<'col-sm-7'B><'col-sm-5 m-auto d-flex'l i>>" +
			        //     "<'row'<'col-sm-12'tr>>" +
			        //     "<'row'<'col-sm-4'><'col-sm-4 text-center'p><'col-sm-4'>>",
			        //     /*dom:"<'row flex-row-reverse'<'col-sm-6 d-flex 'l i>>"+""+
			        //     "<'row' <'col-md-6' p> >",*/
			        //     // read more: https://datatables.net/examples/basic_init/dom.html

			        //     lengthMenu: [5, 10, 25, 50],

			        //     pageLength: 10,

			        //     language: {
			        //         'lengthMenu': '_MENU_ ',
			        //     },
			        //     "aaSorting": [],
		    		// 	"order": [],
			    	// 	"ordering": false,
			            
			        //     searching: true,

					// 	processing: true,
					// 	serverSide: true,
					// 	ajax: {
					// 		url:"{{-- route('ajax-role-list') --}}",
					// 		method: "POST",
					// 		data: {
					// 			"_token": "{{-- csrf_token() --}}",
					// 			'date_filter' : function(){
					// 				return $('#kt_datepicker_3').val();
					// 			},
					// 			'role_id': 3
					// 		},
					// 	},
					// 	columns: [
					// 		{ data: 'user_name' },
					// 		{ data: 'first_name' },
					// 		{ data: 'last_name' },
					// 		{ data: 'cnic' },
					// 		{ data: 'd_o_b' },
					// 		{ data: 'password_text' },
					// 		{ data: 'location_to_be_place' },
					// 		{ data: 'purchases'},
					// 		{ data: 'liters'},
					// 		{ data: 'action' }
					// 	],
					// 	'orderable': false,
			        // });

					// table.columns().every(function() {
					// 	var that = this;

					// 	$('input', this.header()).on('keyup change', function() {
					// 		if (that.search() !== this.value) {
					// 			that
					// 				.search(this.value)
					// 				.draw();
					// 		}	
					// 	});

					// });
				}


	    		return that;

			})();

			$(document).ready(function() {
				myPage.init();

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

			function assign_value(values){
				//console.log(values.id);
				$('#role_'+values.id).html(values.total);
			}

    
		</script>
		<!--end::Page Vendors-->
	@endsection


