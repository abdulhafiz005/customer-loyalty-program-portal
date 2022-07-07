{{-- Extends layout --}}
	@extends('layout.default')

	{{-- Content --}}
	@section('content')

	{{-- Dashboard 1 --}}

	<div class="row">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#user_update">Modal - xl</button> -->

		<div class="col-md-12">
			<!--begin::Card-->
			<div class="card card-custom">
				<div class="card-header pl-2">
					<div class="card-title col-md-3">
						{{ Metronic::getSVG("media/svg/icons/Shopping/Chart-line1.svg", "svg-icon-2x svg-icon-primary d-block my-2 p-1 ml-2") }}
						<h3 class="card-label">Mechanic History</h3>
					</div>
				</div>

				<div class="card-body">
					<div class="table-responsive">
						<!--begin: Datatable-->
						<table class="table table-separate table-head-custom table-checkable" id="kt_datatable2">
							<thead>
								<tr>
									<th>Name</th>
									<th>Phone</th>
									<th>City</th>
									<th>CNIC</th>
									<th>Purchased From</th>
									<th>Vehicle Type</th>
									<th>Vehicle Modal</th>
									<th>Vechicle No</th>
									<th>Current Oil</th>
									<th>License No</th>
								</tr>
							</thead>

							<tbody>
							</tbody>

							<tfoot>
								<tr>
									<th>Name</th>
									<th>Phone</th>
									<th>City</th>
									<th>CNIC</th>
									<th>Purchased From</th>
									<th>Vehicle Type</th>
									<th>Vehicle Modal</th>
									<th>Vechicle No</th>
									<th>Current Oil</th>
									<th>License No</th>
								</tr>
							</tfoot>
						</table>
						<!--end: Datatable-->
					</div>
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

		<script type="text/javascript">

			$(function(){

				$('#kt_datatable2 thead tr').clone(true).appendTo('#kt_datatable2 thead');
				$('#kt_datatable2 thead tr:eq(1) th').each(function() {
				    $(this).css("width", "10%");

				    var title = $(this).text();

				    if (title != 'Action') {
				    	$(this).html('<input type="text" class="search_datatable" placeholder="Search " />'); 
				    	$(this).css("width", "10%");   
				    } else {
				        $(this).html('');
				        $(this).css("width", "5%");
				    }

				});

		      	var table = $('#kt_datatable2').DataTable({
		            responsive: true,
		            processing: true,
		            // Pagination settings
		            dom:  "<'row'<'col-sm-7'B><'col-sm-5 m-auto d-flex'l i>>" +
		            			"<'row'<'col-sm-12'tr>>" +
		            			"<'row'<'col-sm-4'><'col-sm-4 text-center'p><'col-sm-4'>>",
		            lengthMenu: [5, 10, 25, 50],
		            pageLength: 10,
		            language: {
		                'lengthMenu': '_MENU_ ',
		            },
		            "aaSorting": [],
	    			"order": [],
		    		"ordering": false,
		            searching: true,
					
					serverSide: true,
					ajax: {
						url:"{{ route('ajax-mechanic-history-list') }}",
						method: "POST",
						data: {
							"_token": "{{ csrf_token() }}"
						},
					},
					columns: [
						{ data: 'name' },
						{ data: 'phone' },
						{ data: 'city' },
						{ data: 'cnic' },
						{ data: 'purchased_from' },
						{ data: 'vehicle_type' },
						{ data: 'vehicle_modal' },
						{ data: 'vehicle_no' },
						{ data: 'current_oil' },
						{ data: 'license_no' }
					],
					'orderable': false,
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


	    	});  
    
		</script>
		<!--end::Page Vendors-->
	@endsection


