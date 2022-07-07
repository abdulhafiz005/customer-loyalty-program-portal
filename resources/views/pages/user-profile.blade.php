
{{-- Extends layout --}}
	@extends('layout.default')

	{{-- Content --}}
	@section('content')

	{{-- Dashboard 1 --}}

<style>
	.dataTables_filter, .dt-buttons { display: none; }
	#kt_datatable_info { float:right; }
	#kt_datatable_log_time_wrapper{display:none}
	#export {
		background-color: white;
		padding: 6px 14px;
		font-size: 16px;
		border-width: 1px;
		cursor: pointer;
		border-radius: 5px;
	}
	.icon-color{color:DodgerBlue;}
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<div class="row">
		
		<meta name="csrf-token" content="{{ csrf_token() }}">
		
		@if(!in_array($user_role -> name, ['Administrator', 'Rimula Center', 'Rimula Brand Manager']))

		<div class="col-md-3">
			<div class="card card-custom gutter-b">
			    <!--begin::Body-->
			    <div class="card-body pt-3 pb-3">
			    	<span class="display-3 font-weight-bolder">{{ count($purchase) }}</span>
			    	<p class="font-size-lg mb-1"> Sales </p>
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="card card-custom gutter-b">
			    <!--begin::Body-->
			    <div class="card-body pt-3 pb-3">
			    	<span class="display-3 font-weight-bolder">{{ count($interception) }}</span>
			    	<p class="font-size-lg mb-1"> Total Interceptions </p>
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="card card-custom gutter-b">
			    <!--begin::Body-->
			    <div class="card-body pt-3 pb-3">
			    	<span class="display-3 font-weight-bolder">{{ count($converted_interception) }}</span>
			    	<p class="font-size-lg mb-1"> Converted Interceptions </p>
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="card card-custom gutter-b">
			    <!--begin::Body-->
			    <div class="card-body pt-3 pb-3">
			    	<span class="display-3 font-weight-bolder">0</span>
			    	<p class="font-size-lg mb-1"> Reward Claim </p>
				</div>
			</div>
		</div>

		@endif

		<div class="col-lg-12 col-xxl-12">
			<div class="card card-custom gutter-b">
			    <!--begin::Header-->
			    <div class="card-header border-0">
			        <h3 class="card-title font-weight-bolder text-dark">
			        	User Profile&nbsp;
			        	@if($role -> hasPermissionTo('Write User'))
			        	<a href="{{ route('user-management-edit.id', $data['id']) }}" class="btn btn-sm btn-danger user_action btn-light btn-clean btn-icon">
							<i class="fas fa-edit" title="Edit"></i>
						</a>
						@endif
			        </h3>
			    </div>

			    <!--end::Header-->

			    <!--begin::Body-->
			    <div class="card-body pt-2">

			    	<div class="row">

			    		<div class="col-md-3 text-center" style="border-right: 1px solid #cece;">
							<img src="{{ asset('media/users/blank.png') }}" width="150px">
							<p class="font-size-h3 pt-3 text-weight-bold">{{ $data['first_name'] }} {{ $data['last_name'] }}</p>
							<!-- <p class="text-muted"> Members Since 12-Aug-2020 </p> -->
			    		</div>

			    		<div class="col-md-9">

			    			<div class="col-md-12">
			    				{{ Metronic::getSVG("media/svg/icons/Design/Layers.svg", "svg-icon-2x svg-icon-danger my-2 p-1") }} 
			    				<span class="font-size-h5 font-weight-bold">Personal Details</span>
			    				<div class="row">
			    					<div class="col-md-3 mt-5">
			    						<span class="text-muted font-size-sm">First Name: </span> <br>
			    						<span class="font-size-lg">{{ $data['first_name'] }}</span>
			    					</div>

			    					<div class="col-md-3 mt-5">
			    						<span class="text-muted font-size-sm">Last Name: </span> <br>
			    						<span class="font-size-lg">{{ $data['last_name'] }}</span>
			    					</div>

			    					<div class="col-md-3 mt-5">
			    						<span class="text-muted font-size-sm">CNIC: </span> <br>
			    						<span class="font-size-lg">{{ $data['cnic'] }}</span>
			    					</div>

			    					<div class="col-md-3 mt-5">
			    						<span class="text-muted font-size-sm">Date of Birth: </span> <br>
			    						<span class="font-size-lg">{{ $data['d_o_b'] }}</span>
			    					</div>
			    					
			    				</div>

			    				<div class="row">
			    					<div class="col-3 mt-5">
			    						<span class="text-muted font-size-sm">Location To Be Place: </span> <br>
			    						<span class="font-size-lg">{{ $data['b_city'] }}</span>
			    					</div>
									<div class="col-3 mt-5">
										<span class="text-muted font-size-sm">Phone: </span> <br>
										<span class="font-size-lg">{{ $data['phone'] }}</span>
									</div>
									<div class="col-3 mt-5">
										<span class="text-muted font-size-sm">User Type: </span> <br>
										<span class="font-size-lg">{{ $user_role -> name }}</span>
									</div>
			    				</div>
			    			</div>

			    			<div class="separator separator-solid mt-10 separator-border-3"></div>

			    			<div class="col-md-offset-6 col-md-6 mt-5"> <?php //$address = 'Karachi' ; /* Insert address Here */
			    				if ($data['role_id'] == 3) {
			    					echo '<iframe width="100%" height="100" frameborder="0" src="https://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=' . str_replace(",", "", str_replace(" ", "+", $data['b_city'])) . '&z=5&output=embed"></iframe>';	
			    				}

                            ?> </div>

				    			<div class="col-md-12 mt-5">
				    				<i class="icon-l fas fa-truck pr-1"></i>
				    				<span class="font-size-h5 font-weight-bold">Loyalty Program</span>
				    				<div class="row">
				    					
				    					<div class="col-md-4 mt-5">
				    						<span class="text-muted font-size-sm">Points Earned: </span> <br>
				    						<span class="font-size-lg">@if($points[0] -> points != "") {{ $points[0] -> points }} @else 0 @endif</span>
				    					</div>

				    					<!-- <div class="col-md-4 mt-5">
				    						<span class="text-muted font-size-sm">Loyalty Program Status: </span> <br>
				    						<span class="btn btn-success font-size-xs btn-xs pt-1 pb-1 pl-2 pr-2  font-weight-bold btn-pill">Eligible</span>
				    					</div> -->

				    				</div>
				    			</div>
			    		</div>

			    	</div>

			    </div>
			    <!--end::Body-->
			</div>
		</div>


		<div class="col-lg-12 col-xxl-12">
			<div class="card card-custom gutter-b">
			    <!--begin::Header-->
			    <!--end::Header-->

			    <!--begin::Body-->


			    		<!--begin: Datatable-->
						<!-- <div class="table-responsive">

							<table class="table table-separate table-head-custom table-checkable" id="purchase_datatbale">
								<thead>
									<tr>
										<th>Product Name</th>
										<th>Quantity</th>
										<th>Variant</th>
										<th>Total Liters</th>
										<th>Name</th>
										<th>CNIC</th>
										<th>Date</th>
									</tr>
								</thead>
								<tbody>

								</tbody>

								<tfoot>
									<tr>
										<th>Product Name</th>
										<th>Quantity</th>
										<th>Variant</th>
										<th>Total Liters</th>
										<th>Name</th>
										<th>CNIC</th>
										<th>Date</th>
									</tr>
								</tfoot>
							</table>
						</div> -->
						<!--end: Datatable-->
			    <!--end::Body-->
			</div>
		</div>

		@if($data->role_id == 3)

			<div class="col-lg-4 col-xxl-4" style="height: 400px;">
				<div class="card card-custom gutter-b h-100">
					<!--begin::Header-->
					<div class="card-header border-0">
						<h3 class="card-title font-weight-bolder text-dark mt-6">Time Log</h3>
						<div class="form-inline">
							<input type="date" name="from_date" id="from_date" placeholder="From" class="form-control mt-5">&nbsp;
							<input type="date" name="date_log" id="date_log" placeholder="To" class="form-control mt-5">&nbsp;&nbsp;
							@if($role -> hasPermissionTo('Export Data'))
								<button id="export" class="mt-5" onclick="downloadExcel()"><i class="fa fa-download icon-color"></i></button>
							@endif
						</div>
					</div>
					<hr/>
					<div class="card-body pt-2" id="timeline">


					</div>
					<!-- <div id="displayActivityBtn" style='display:none;'>
					<hr/>
					<input type='button' id='exportActivity' value='Export' class='form-control mb-5'/>
					</div> -->
				</div>
			</div>
			<!-- <table  id="kt_datatable_log_time">
				<thead>
					<tr>
						<th>Activity</th>
						<th>longitude</th>
						<th>latitude</th>
						<th>Date</th>
						<th>Time</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table> -->

			<div class="col-md-8 card-strech">
				<div id="map" class="h-100"></div>
			</div>

		@endif

		@if($data -> role_id == 5)

		<div class="col-lg-3 pr-0">
			<div class="card card-custom card-stretch gutter-b">
				<div class="card-header">
					<div class="card-title">
						<h3 class="card-label">Purchase History</h3>
					</div>
				</div>

				<div class="card-body p-2 card_body_fixed">
					<div class="">
						<ul class="p_history pl-3">

							@foreach($purchase_history as $p)
							<li class="pb-5 d-flex">
								<i class="fas fa-circle icon-nm mt-5 mr-3"></i>
								<div class="d-flex flex-column flex-grow-1">

									<a href="#" class="text-dark-65 text-hover-primary font-weight-bold font-size-lg mb-1"> {{ $p -> product_name }}, {{ $p -> variant }}L </a>
									<div class="d-flex">
										<span class="text-muted font-size-xs pr-1"> {{ $p -> created_at }} <a href="#"> {{ $p -> trucker_name }} </a></span>
									</div>

								</div>
							</li>
							@endforeach

						</ul>
					</div>
            	</div>
        	</div>
    	</div>

		@endif


		<div class="modal fade" id="edit_profile" tabindex="-1" aria-labelledby="" style="display: none;" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="edit_profile_label">Edit Profile</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<i aria-hidden="true" class="ki ki-close"></i>
						</button>
					</div>

					<div class="modal-body">
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
		<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places,geometry"></script>


		<script type="text/javascript">

			var myPage = (function() {

				var that = {};

				that.init = function () {

					function maps(locations){
						var map = new google.maps.Map(document.getElementById('map'), {
							zoom: 5,
							center: new google.maps.LatLng(30.3753 , 69.3451),
							mapTypeId: google.maps.MapTypeId.ROADMAP
						});

						var infowindow = new google.maps.InfoWindow();

						var marker, i;

						for (i = 0; i < locations.length; i++) {
							marker = new google.maps.Marker({
								position: new google.maps.LatLng(locations[i]['lat'], locations[i]['lng']),
								map: map,
								label: ''+i,
							});

							google.maps.event.addListener(marker, 'click', (function(marker, i) {
								return function() {
									//infowindow.setContent(locations[i][0]);
									infowindow.open(map, marker);
								}
							})(marker, i));
						}

					}

					$('#timeline').on('click', 'p[data-lng]', function(){
						var location = [{lat:$(this).attr('data-lat'), lng:$(this).attr('data-lng')}];
						maps(location);
					});

					$('#date_log').on('change', function()
					{
						var from = $('#from_date').val();
						var to = $(this).val();
						$.ajax({
							type: 'POST',
							headers: {
							       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
							url:"{{ route('ajax-get-time-log') }}",
							//dataType : 'html',
							data: {
								user_id: {{ $data['id'] }},
								from : from,
								to	 : to,
							},
							success: function (response) {
								if (response) {
									var res = JSON.parse(response);
									$('#timeline').html(res.response);
									maps(res.location);
									if(res.response != ""){
										document.getElementById('displayActivityBtn').style.display = 'block';
										var le = $('#kt_datatable_log_time').DataTable();
										le.ajax.reload();
									}else{
										document.getElementById('displayActivityBtn').style.display = 'none';
									}
								}
							}
						});
					});
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

		function downloadExcel(){
			var from = document.getElementById('from_date').value;
			var to = document.getElementById('date_log').value;

			if(from == "" || to == ""){
				return;
			}
			
			var route = '{{ URL::to('export-ms-timelog') }}';
			route += '/{{ $data['id'] }}/'+from+'/'+to;
			fetch(route)
			.then(resp => resp.blob())
			.then(blob => {
				const url = window.URL.createObjectURL(blob);
				const a = document.createElement('a');
				a.style.display = 'none';
				a.href = url;
				a.download = 'Timelogs.csv';
				document.body.appendChild(a);
				a.click();
				window.URL.revokeObjectURL(url);
				console.log('file has downloaded!');
			})
			.catch(() => console.log('something went wrong!'));
		}

		</script>
	@endsection


