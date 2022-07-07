{{-- Extends layout --}}
	@extends('layout.default')

	{{-- Content --}}
	@section('content')

	{{-- Dashboard 1 --}}

	<div class="row">

		<meta name="csrf-token" content="{{ csrf_token() }}">

		<div class="col-md-4">
			<div class="card card-custom gutter-b">
			    <!--begin::Body-->
			    <div class="card-body pt-3 pb-3">
			    	<span class="display-3 font-weight-bolder">{{ $total_purchases }}</span>
			    	<p class="font-size-lg mb-1"> Purchase </p>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="card card-custom gutter-b">
			    <!--begin::Body-->
			    <div class="card-body pt-3 pb-3">
			    	<span class="display-3 font-weight-bolder">{{ count($interception_query) }}</span>
			    	<p class="font-size-lg mb-1"> Total Interceptions </p>
				</div>
			</div>
		</div>

		<!-- <div class="col-md-4">
			<div class="card card-custom gutter-b">
			    <div class="card-body pt-3 pb-3">
			    	<span class="display-3 font-weight-bolder">0</span>
			    	<p class="font-size-lg mb-1"> Loyalty Program score </p>
				</div>
			</div>
		</div> -->

		<div class="col-md-4">
			<div class="card card-custom gutter-b">
			    <!--begin::Body-->
			    <div class="card-body pt-3 pb-3">
			    	<span class="display-3 font-weight-bolder">{{ $gifts -> count() }}</span>
			    	<p class="font-size-lg mb-1"> Reward Claim </p>
				</div>
			</div>
		</div>

		<div class="col-lg-12 col-xxl-12">
			<div class="card card-custom gutter-b">
			    <!--begin::Header-->
			    <div class="card-header border-0">
			        <h3 class="card-title font-weight-bolder text-dark">Trucker Profile</h3>
					@if($role -> hasPermissionTo('Write Purchase'))
						@if($gifts -> count() < 3 && 
								in_array($total_purchases, [1, 2, 3]) && 
									$total_purchases > $gifts -> count())
							<button type="button" style="float:right;" class="btn btn-primary mt-5 mb-5" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Assign Gift</button>
						@endif
					@endif
			    </div>
			    <!--end::Header-->

			    <!--begin::Body-->
			    <div class="card-body pt-2">

			    	<div class="row">

			    		<div class="col-md-3 text-center" style="border-right: 1px solid #cece;">
							<img src="{{ asset('media/users/blank.png') }}" width="150px">
							<p class="font-size-h3 pt-3 text-weight-bold">{{ $data['first_name'] }} {{$data['last_name']}}</p>
							<p class="text-muted"> Members Since 12-Aug-2020 </p>
			    		</div>

			    		<div class="col-md-9">

			    			<div class="col-md-12">
			    				{{ Metronic::getSVG("media/svg/icons/Design/Layers.svg", "svg-icon-2x svg-icon-danger my-2 p-1") }}
			    				<span class="font-size-h5 font-weight-bold">Personal Details</span>

			    				<div class="row">

			    					<div class="col-md-2 mt-5">
			    						<span class="text-muted font-size-sm">First Name: </span> <br>
			    						<span class="font-size-lg">{{ $trucker->first_name }}</span>
			    					</div>

			    					<div class="col-md-2 mt-5">
			    						<span class="text-muted font-size-sm">Last Name: </span> <br>
			    						<span class="font-size-lg">{{ $trucker->last_name }}</span>
			    					</div>

			    					<div class="col-md-3 mt-5">
			    						<span class="text-muted font-size-sm">CNIC: </span> <br>
			    						<span class="font-size-lg">{{ $trucker->cnic }}</span>
			    					</div>

			    					<div class="col-md-3 mt-5">
			    						<span class="text-muted font-size-sm">Date of Birth: </span> <br>
			    						<span class="font-size-lg">{{ $trucker->d_o_b }}</span>
			    					</div>

			    					<div class="col-md-2 mt-5">
			    						<span class="text-muted font-size-sm">Birth City: </span> <br>
			    						<span class="font-size-lg">{{ $trucker->b_city }}</span>
			    					</div>

			    				</div>
			    			</div>

			    			<div class="separator separator-solid mt-10 separator-border-3"></div>

			    			<div class="col-md-12 mt-5">
			    				<i class="icon-l fas fa-truck pr-1"></i>
			    				<span class="font-size-h5 font-weight-bold">Professional Details</span>
			    				<div class="row">

			    					<div class="col-md-4 mt-5">
			    						<span class="text-muted font-size-sm">Current Vehicle No: </span> <br>
			    						<span class="font-size-lg">@isset($trucker->get_truck->vehicle_no) {{ $trucker->get_truck->vehicle_no  }}@endisset</span>
			    					</div>

			    					<div class="col-md-4 mt-5">
			    						<span class="text-muted font-size-sm">Driving Experience: </span> <br>
			    						<span class="font-size-lg">{{ $trucker->driving_exp }} Years</span>
			    					</div>

									<div class="col-md-4 mt-5">
			    						<span class="text-muted font-size-sm">Gifts: </span> <br>
											<span class="font-size-lg">{{ $gifts -> count() }}</span>
			    					</div>

									@if($gifts -> count() > 0)	
										<span class="font-size-h5 font-weight-bold mt-8 mb-5 ml-5">Gifts</span>
										<div class="col-md-12 row">
											@foreach($gifts as $gift)
												<div class="col-md-4 mb-10 font-size-sm font-weight-bold">
												<h5 class="display-5 ml-5">{{ $gift -> name }}</h5>
													<div class="p-5 text-center">
														@if( is_array(unserialize($gift -> evidence)) )
															@foreach(unserialize($gift -> evidence) as $leader)
																<img src="{{ url('storage/'.$leader) }}" width="100%">
																@break
															@endforeach
														@else
															<img src="{{ url('storage/'.unserialize($gift -> evidence)) }}" width="100%">
														@endif
													</div>
												</div>
											@endforeach
										</div>
									@endif

			    					<!-- <div class="col-md-4 mt-5">
			    						<span class="text-muted font-size-sm">Frequent Routes: </span> <br>
			    						<span class="btn btn-secondary font-size-sm">Islamabad</span>
			    						<span class="btn btn-secondary font-size-sm">Peshawar</span>
			    					</div> -->

			    				</div>
			    			</div>

			    			<!-- <div class="separator separator-solid mt-10 separator-border-3"></div>

			    			<div class="col-md-12 mt-5">
			    				<i class="icon-l fas fa-truck pr-1"></i>
			    				<span class="font-size-h5 font-weight-bold">Loyalty Program</span>
			    				<div class="row">

			    					<div class="col-md-4 mt-5">
			    						<span class="text-muted font-size-sm">Reward Claims: </span> <br>
			    						<span class="font-size-lg">10 Times</span>
			    					</div>

			    					<div class="col-md-4 mt-5">
			    						<span class="text-muted font-size-sm">Loyalty Program Status: </span> <br>
			    						<span class="btn btn-success font-size-xs btn-xs pt-1 pb-1 pl-2 pr-2  font-weight-bold btn-pill">Eligible</span>
			    					</div>

			    				</div>
			    			</div> -->

			    		</div>

			    	</div>

			    </div>
			    <!--end::Body-->
			</div>
		</div>

		<div class="col-lg-3 pr-0">
			<div class="card card-custom card-stretch gutter-b">
			    <div class="card-header">
			        <h3 class="card-title text-dark"> Interception History </h3>
			    </div>
			    <div class="card-body pl-3 pt-2 pr-2">

			        @foreach( $interception_query as $interceptions )
			        <div class="d-flex align-items-center space_border">
			            <span class="bullet bullet-bar bg-info align-self-stretch mr-3"></span>
			            <div class="d-flex flex-column flex-grow-1">
			                <a href="#" class="text-dark-65 text-hover-primary font-weight-bold font-size-lg mb-1">
			                    {{ $data['first_name'] }} intrepted by Ustad Mechanic
			                </a>
			                <div class="d-flex">
			                	<span class="text-muted font-size-xs pr-1">
			                		{{ $diff = Carbon\Carbon::parse($interceptions->created_at)->diffForHumans() }} by
			                	</span>
			                	<span class="text-info font-size-xs"> {{ $interceptions->first_name }}  {{ $interceptions->last_name }}</span>
			                </div>
			            </div>
			        </div>
			        @endforeach
			    </div>
			</div>
         </div>

		<div class="col-lg-3 pr-0">

			<!--begin::Card-->
			<div class="card card-custom card-stretch gutter-b">

				<div class="card-header">
					<div class="card-title">
						<h3 class="card-label">Questionnaire History</h3>
					</div>
				</div>

				<div class="card-body p-2 card_body_fixed">
					<!--begin::Example-->
							<div class="timeline timeline-justified timeline-4">
								<div class="timeline-items">

									@foreach($interception_questions as $int_question)
										<div class="timeline-item">
											<div class="timeline-badge">
												<div class="bg-primary"></div>
											</div>
											<div class="timeline-content p-3">
												<p class="font-size-sm mb-2"> {{ $int_question->question }} </p>
												<p class="text-muted font-size-xs"> {{ $int_question->answer }} </p>
											</div>
										</div>
									@endforeach

								</div>
							</div>
					<!--end::Example-->

            	</div>
        	</div>
        	<!--end::Card-->

    	</div>

    	<div class="col-lg-3 pr-0">

			<!--begin::Card-->
			<div class="card card-custom card-stretch gutter-b">

				<div class="card-header">
					<div class="card-title">
						<h3 class="card-label">Feedback</h3>
					</div>
				</div>

				<div class="card-body p-2 card_body_fixed">
					<div class="timeline timeline-justified timeline-4">
						<div class="timeline-items">

							@foreach($interception_feedback as $int_feedback)

							<div class="timeline-item">
								<div class="timeline-badge">
									<div class="bg-primary"></div>
								</div>
								<div class="timeline-content p-3">
									<p class="font-size-sm mb-1">{{ $int_feedback->feedback_text }}</p>
									<span class="text-muted font-size-xs">
										{{ $diff = Carbon\Carbon::parse($int_feedback->created_at)->diffForHumans() }} by
									</span>
									<span class="text-info font-size-xs"> {{ $int_feedback->first_name }} </span>
								</div>
							</div>

							@endforeach

						</div>
					</div>
            	</div>
        	</div>
        	<!--end::Card-->

    	</div>

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

							@foreach($purchase_ as $p)
							<li class="pb-5 d-flex">
								<i class="fas fa-circle icon-nm mt-5 mr-3"></i>
								<div class="d-flex flex-column flex-grow-1">

									<a href="#" class="text-dark-65 text-hover-primary font-weight-bold font-size-lg mb-1"> {{ $p->product_name }}, {{ $p -> variant }}L </a>
									<div class="d-flex">
										<span class="text-muted font-size-xs pr-1"> {{ $p->created_at }} </span>
									</div>

								</div>
							</li>
							@endforeach

						</ul>
					</div>
            	</div>
        	</div>
    	</div>

   		<div class="modal fade" id="add_purchase" tabindex="-1" aria-labelledby="add_purchase" style="display: none;" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Edit Trucker Profile</h5>
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Gift Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gitf-form" action="{{URL::to('assign-trucker-gift/')}}" method="POST" enctype="multipart/form-data">
			<input type="hidden" value="{{$id}}" name="trucker_id" />
			@csrf
			<div class="form-group">
				<label for="recipient-name" class="col-form-label">Name:</label>
				<input type="text" class="form-control" id="recipient-name" name="name" required>
			</div>
			<div class="custom-file">
				<input type="file" class="custom-file-input" name="evidence_p" id="evidence_p" class="custom-file" required>
				<label class="custom-file-label" for="evidence_p">Gift Evidence:</label>
			</div>
			<input type="submit" style="display:none;" class="btn btn-primary" id="submit-gift-form" value="Submit"/>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="submit-gift">Submit</button>
      </div>
    </div>
  </div>
</div>

	@endsection

	{{-- Scripts Section --}}
	@section('scripts')
		<script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
		<script src="{{ asset('js/pages/crud/forms/widgets/select2.js') }}"></script>
		<script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}" type="text/javascript"></script>


		<script type="text/javascript">
			@role('Administrator')
				$('#addition_Ar').append(' <a href="{{URL::to('convert-to-safeer/'.$data['id'])}}" class="btn btn-light-primary font-weight-bolder">Convert To Safeer</a>');
				$('#addition_Ar').append(' <a href="#" class="btn btn-light-primary edit_p font-weight-bolder" data-id="{{$data['id']}}">Edit Profile</a>');
			@endrole

			$('#addition_Ar').on('click', '.edit_p', function(e){

				
				e.preventDefault();
				var id = $(this).attr('data-id');

				$.ajax({
					type: "Get",
					url:"{{ route('ajax-trucker-list-popup') }}",
					data:{
						"_token"  : "{{ csrf_token() }}",
						"user_id" : id
					},
					async: false,
					cache: false,
					success: function (response) {
						$('#add_purchase .modal-body #edit_profile_form').html(response);
						$('#add_purchase').modal('show');
						$('.modal-body #vehicle_id').select2({
							multiple: false,
							tags: true,
						});
					}
				});

				///$('#edit_profile').modal('show');

			});

			$("body #edit_profile_form").on('submit', function(e){
				e.preventDefault();
				$.ajax({
					type: 'POST',
					headers: {
					       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url:"{{ route('ajax-trucker-update-submit') }}",
					// dataType: "JSON",
					data: new FormData(this),
					async: false,
					cache: false,
					processData: false,
					contentType: false,
					success: function (response) {
						if (response) {
							var rr = JSON.parse(response);
							$('#add_purchase').modal('toggle');
							alert(rr.msg);
							$('#add_purchase .modal-body #edit_profile_form').html('');
							//location.reload(true);
						}
					}
				});
			});

			document.getElementById("submit-gift").addEventListener("click", function () {
				document.getElementById("submit-gift-form").click();
			});
		</script>
		<!--end::Page Vendors-->
	@endsection


