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
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#user_update">Modal - xl</button> -->

		<div class="col-md-12">
			<!--begin::Card-->
			<div class="card card-custom">
				<div class="card-header pl-2">
					<div class="card-title col-md-3">
						{{ Metronic::getSVG("media/svg/icons/Shopping/Chart-line1.svg", "svg-icon-2x svg-icon-primary d-block my-2 p-1 ml-2") }}
						<h3 class="card-label">Mechanics</h3>
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
								<th class="export">CNIC</th>
								<th class="export">Shop Name</th>
								<th class="export">Agent Name</th>
								<th class="export">Contact</th>
								<th class="export">City</th>
								<th class="export">Daily Trucks Visits</th>
								<th class="export">Daily Oil Changes</th>
								<th class="export">Rimula Users</th>
								<th class="export">Marital Status</th>
								<th class="export">Interested In Loyalty Program</th>
								<th class="export">Registered Date</th>
								@if($role -> hasPermissionTo('Convert Mechanic'))
									<th>Action</th>
								@endif
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
					<!--end: Datatable-->
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
	<script src="{{ asset('js/pages/crud/datatables/extensions/buttons.js') }}"></script>

	<script type="text/javascript">

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
				url:"{{ route('ajax-mechanic-list') }}",
				method: "POST",
				data: {
					"_token": "{{ csrf_token() }}"
				},
			},
			columns: [
				{ data: 'name' },
				{ data: 'cnic' },
				{ data: 'shop_name' },
				{ data: 'agent_name'},
				{ data: 'contact' },
				{ data: 'city' },
				{ data: 'daily_trucks_traffic' },
				{ data: 'daily_oil_changes' },
				{ data: 'rimula_users' },
				{ data: 'married' },
				{ data: 'loyalty_interest' },
				{ data: 'date' },
				@if($role -> hasPermissionTo('Convert Mechanic'))
					{ data: 'action' },
				@endif
			],
			columnDefs: [
			{
				targets: 0,
				render: function(data, type, row, meta) {
					if(type === 'export'){
						return row.name;
					}else{
						var output = "";
						if(row.name != null){
							output += `<a href="/mechanic-details/` + row.id + `" title="View Mechanic Profile"
										<div class="d-flex align-items-center">
											<div class="symbol symbol-50 symbol-light-success" flex-shrink-0">
												<div class="symbol-label font-size-h5">` + row.name.substring(0, 1) + `</div>
											</div>
											<div class="ml-3">
												<span class="text-dark-75 font-weight-bold line-height-sm d-block pb-2">` + row.name + `</span>
											</div>
										</div>
									</a>
									`;
						}
						return output;
					}
				}
			},
			{
				targets: 3,
				render: function(data, type, row, meta) {
					if(type === 'export'){
						return row.agent_name;
					}else{
						var output = "";
						if(row.agent_name != null){
							output += `<a href="/user-managment-details/` + row.agent_id + `" title="View Agent Profile"
										<div class="d-flex align-items-center">
											<div class="symbol symbol-50 symbol-light-success" flex-shrink-0">
												<div class="symbol-label font-size-h5">` + row.agent_name.substring(0, 1) + `</div>
											</div>
											<div class="ml-3">
												<span class="text-dark-75 font-weight-bold line-height-sm d-block pb-2">` + row.agent_name + `</span>
											</div>
										</div>
									</a>
									`;
						}
						return output;
					}
				}
			},
			{
				targets: 9,
				render: function(data, type, row, meta) {
					var output = ``;
					if(row.married == "no"){
						output += 'Single';
					}else if( row.married == "yes"){
						output += `Married`;
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


