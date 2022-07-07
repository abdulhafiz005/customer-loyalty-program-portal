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

		<div class="col-md-12">
			<!--begin::Card-->
			<div class="card card-custom">
				<div class="card-header pl-2">
					<div class="card-title col-md-3">
						{{ Metronic::getSVG("media/svg/icons/Shopping/Chart-line1.svg", "svg-icon-2x svg-icon-primary d-block my-2 p-1 ml-2") }}
						<h3 class="card-label">Cities</h3>
					</div>
					@if($role -> hasPermissionTo('Write Cities'))
                    <div class="card-title col-md-3 float-right" style="justify-content: flex-end;">
						<button class="btn btn-primary font-weight-bold btn-sm" data-toggle="modal" data-target="#addModal">Add New</button>
					</div>
					@endif
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
							@if($role -> hasPermissionTo('Export Data'))
							<div class="dropdown dropdown-inline mr-2" style="float:right;">
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
							@endif
							<!--end::Dropdown-->
						</div>
					</div>

					<hr/>
					<table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
						<thead>
							<tr>
								<th class="export">City Name</th>
								<th class="export">Added By</th>
								<th class="export">Date</th>
								@if($role -> hasPermissionTo('Write Cities'))
								<th>Actions</th>
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

    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add City</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="form-group row fv-plugins-icon-container has-success">
                    <div class="col-md-3">
                        <label class="p-md-4">City: </label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="select_city" id="select_city">
                        <div class="v-plugins-message-container text-danger mt-2" id="cityErr"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitCitiesData()">Save</button>
            </div>
            </div>
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
				url:"{{ route('ajax-cities-list') }}",
				method: "POST",
				data: {
					"_token": "{{ csrf_token() }}"
				},
			},
			columns: [
				{ data: 'city' },
				{ data: 'first_name' },
				{ data: 'date' },
				@if($role -> hasPermissionTo('Write Cities'))
				{ data: 'action' },
				@endif
			],
			columnDefs: [
				{
					targets: 1,
					render: function(data, type, row, meta) {
						if(type === 'export'){
							return row.first_name + ` ` + row.last_name;
						}else{ 
							var output = `<a href="/user-managment-details/` + row.id + `" title="View Trucker Profile"
											<div class="d-flex align-items-center">
												<div class="symbol symbol-50 symbol-light-success" flex-shrink-0">
													<div class="symbol-label font-size-h5">`;
													if(row.first_name == null){
														output += "N";
													}else{
														output += row.first_name.substring(0, 1);
													}
													output += `</div>
												</div>
												<div class="ml-3">`;
													if(row.first_name == null){
														output += `<span class="text-dark-75 font-weight-bold line-height-sm d-block pb-2">Null</span>`;
													}else{
														output += `<span class="text-dark-75 font-weight-bold line-height-sm d-block pb-2">` + row.first_name + ` ` + row.last_name + `</span>`;
													}
												output += `</div>
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

function submitCitiesData(){
    var selected_city = document.getElementById('select_city').value;
    $.ajax({
        type: 'POST',
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        url:"{{ route('ajax-add-new-city') }}",
        // dataType: "JSON",
        data: {
            'city': selected_city,
        },
        success: function (response) {
            document.getElementById('cityErr').style.display = 'none';
            var table = $('#kt_datatable').DataTable();
            table.ajax.reload();
            $('#addModal').modal('hide');
        },
        error: function(xhr, status, error){
            document.getElementById('cityErr').innerHTML = (selected_city+" already exist.");
            document.getElementById('cityErr').style.display = 'block';
     },
    });
}
</script>
		<!--end::Page Vendors-->
	@endsection


