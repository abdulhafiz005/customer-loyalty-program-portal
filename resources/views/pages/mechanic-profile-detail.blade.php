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
			    	<span class="display-3 font-weight-bolder">{{ $mechanic->daily_trucks_traffic }}</span>
			    	<p class="font-size-lg mb-1"> Daily Trucks Traffic </p>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="card card-custom gutter-b">
			    <!--begin::Body-->
			    <div class="card-body pt-3 pb-3">
			    	<span class="display-3 font-weight-bolder">{{ $mechanic->daily_oil_changes }}</span>
			    	<p class="font-size-lg mb-1"> Daily Oil Changes </p>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="card card-custom gutter-b">
			    <!--begin::Body-->
			    <div class="card-body pt-3 pb-3">
			    	<span class="display-3 font-weight-bolder">{{ $mechanic->rimula_users }}</span>
			    	<p class="font-size-lg mb-1"> Rimula Users </p>
				</div>
			</div>
		</div>

		<div class="col-lg-12 col-xxl-12">
			<div class="card card-custom gutter-b">
			    <!--begin::Header-->
			    <div class="card-header border-0">
			        <h3 class="card-title font-weight-bolder text-dark">Mechanic Profile</h3>
			    </div>
			    <!--end::Header-->

			    <!--begin::Body-->
			    <div class="card-body pt-2">

			    	<div class="row">

			    		<div class="col-md-3 text-center" style="border-right: 1px solid #cece;">
							<img src="{{ asset('media/users/blank.png') }}" width="150px">
							<p class="font-size-h3 pt-3 text-weight-bold">{{ $mechanic->name }}</p>
							<p class="text-muted"> Registered Since {{ $mechanic->created_at }} </p>
			    		</div>

			    		<div class="col-md-9">

			    			<div class="col-md-12">
			    				{{ Metronic::getSVG("media/svg/icons/Design/Layers.svg", "svg-icon-2x svg-icon-danger my-2 p-1") }}
			    				<span class="font-size-h5 font-weight-bold">Personal Details</span>

			    				<div class="row">

			    					<div class="col-md-2 mt-5">
			    						<span class="text-muted font-size-sm">Full Name: </span> <br>
			    						<span class="font-size-lg">{{ $mechanic->name }}</span>
			    					</div>

			    					<div class="col-md-3 mt-5">
			    						<span class="text-muted font-size-sm">CNIC: </span> <br>
			    						<span class="font-size-lg">{{ $mechanic->cnic }}</span>
			    					</div>

			    					<div class="col-md-2 mt-5">
			    						<span class="text-muted font-size-sm">City: </span> <br>
			    						<span class="font-size-lg">{{ $mechanic->city }}</span>
			    					</div>

			    				</div>
			    			</div>

			    			<div class="separator separator-solid mt-10 separator-border-3"></div>

			    			<div class="col-md-12 mt-5">
			    				<i class="icon-l fas fa-truck pr-1"></i>
			    				<span class="font-size-h5 font-weight-bold">Professional Details</span>
			    				<div class="row">

			    					<div class="col-md-4 mt-5">
			    						<span class="text-muted font-size-sm">Shop Name: </span> <br>
			    						<span class="font-size-lg">{{ $mechanic->shop_name }}</span>
			    					</div>

			    					<div class="col-md-4 mt-5">
			    						<span class="text-muted font-size-sm">Marital Status: </span> <br>
                                        @if($mechanic->married == "yes")
                                            <span class="font-size-lg">Married</span>
                                        @elseif($mechanic->married == "no")
                                            <span class="font-size-lg">Single</span>
                                        @endif
			    					</div>

                                    <div class="col-md-4 mt-5">
			    						<span class="text-muted font-size-sm">Interested In Loyalty Program: </span> <br>
			    						<span class="font-size-lg">{{ ucwords($mechanic->loyalty_interest) }}</span>
			    					</div>

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
			                    {{ $data['name'] }} intrepted by Ustad Mechanic
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

	</div>

	@endsection

	{{-- Scripts Section --}}
	@section('scripts')
		<script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
		<script src="{{ asset('js/pages/crud/forms/widgets/select2.js') }}"></script>
		<script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}" type="text/javascript"></script>

		<script>
			@role('Administrator')
				$('#addition_Ar').append('<a href="{{URL::to('convert-to-ustad/'.$mechanic->id)}}" class="btn btn-light-primary font-weight-bolder">Convert To Ustad</a>');
			@endrole
		</script>
		<!--end::Page Vendors-->
	@endsection