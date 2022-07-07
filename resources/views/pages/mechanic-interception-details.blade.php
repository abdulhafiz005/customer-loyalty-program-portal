{{-- Extends layout --}}
	@extends('layout.default')

	{{-- Content --}}
	@section('content')

	{{-- Dashboard 1 --}}

	<div class="row">

		<div class="col-lg-12 col-xxl-12">
			<div class="card card-custom gutter-b">
			    
			    <div class="card-header border-0">
			        <h3 class="card-title font-weight-bolder text-dark">Mechanic Interception Details</h3>
			    </div>

			    <div class="card-body pt-2">

			    	<div class="row">
			    		
			    		<div class="col-md-2 text-center" style="border-right: 1px solid #cece;">
							<img src="{{ asset('media/users/blank.png') }}" width="150px">
							<p class="font-size-h3 pt-3 text-weight-bold">{{ ucfirst($parts[0] -> name) }}</p>
			    		</div> 

			    		<div class="col-md-10">

			    			<div class="col-md-12">
			    				{{ Metronic::getSVG("media/svg/icons/Design/Layers.svg", "svg-icon-2x svg-icon-danger my-2 p-1") }} 
			    				<span class="font-size-h5 font-weight-bold">Personal Details</span>
			    				
			    				<div class="row">
			    					
			    					<div class="col-md-3 mt-5">
			    						<span class="text-muted">Name: </span> <br>
                                        <span class="font-size-h6">{{ ucfirst($parts[0] -> name) }}</span>
			    					</div>

									<div class="col-md-3 mt-5">
			    						<span class="text-muted">Contact: </span> <br>
                                        <span class="font-size-h6">{{ $parts[0] -> contact }}</span>
			    					</div>

			    					<div class="col-md-3 mt-5">
			    						<span class="text-muted">CNIC: </span> <br>
                                        <span class="font-size-h6">{{ $parts[0] -> cnic }}</span>
			    					</div>

                                    <div class="col-md-3 mt-5">
			    						<span class="text-muted">Marital Status: </span> <br>
                                        @if($parts[0] -> married == "yes")
                                            <span class="font-size-h6">Married</span>
                                        @elseif($parts[0] -> married == "no")
                                            <span class="font-size-h6">Single</span>
                                        @endif
			    					</div>
			    					
			    				</div>
			    			</div>

			    			<div class="separator separator-solid mt-10 separator-border-3"></div>

				    			<div class="col-md-12 mt-5">
				    				<i class="icon-l fas fa-truck pr-1"></i>
				    				<span class="font-size-h5 font-weight-bold">Shop Details</span>
				    				<div class="row">
				    					
				    					<div class="col-md-2 mt-5">
				    						<span class="text-muted">Shop Name: </span> <br>
                                            <span class="font-size-h6">{{ $parts[0] -> shop_name }}</span>
				    					</div>

				    					<div class="col-md-2 mt-5">
				    						<span class="text-muted">Daily Trucks Traffic: </span> <br>
											<span class="font-size-h6">{{ $parts[0] -> daily_trucks_traffic }}</span>
				    					</div>

				    					<div class="col-md-2 mt-5">
				    						<span class="text-muted">Daily Oil Changes: </span> <br>
                                            <span class="font-size-h6">{{ $parts[0] -> daily_oil_changes }}</span>
				    					</div>

				    					<div class="col-md-2 mt-5">
				    						<span class="text-muted">Rimula Users: </span> <br>
                                            <span class="font-size-h6">{{ $parts[0] -> rimula_users }}</span>
				    					</div>

				    					<div class="col-md-3 mt-5">
				    						<span class="text-muted">Interested In Loyalty Program: </span> <br>
                                            <span class="font-size-h6">{{ ucfirst($parts[0] -> loyalty_interest) }}</span>
				    					</div>

				    				</div>
				    			</div>

							<div class="separator separator-solid mt-10 separator-border-3"></div>

							<div class="col-md-offset-6 col-md-6 mt-5"> <?php //$address = 'Karachi' ; /* Insert address Here */
								echo '<iframe width="100%" height="100" frameborder="0" src="https://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=' . str_replace(",", "", str_replace(" ", "+", $parts[0] -> city)) . '&z=5&output=embed"></iframe>';
							?> </div>

			    		</div>

			    	</div>

			    </div>
			    <!--end::Body-->
			</div>
		</div>

    	<div class="col-lg-6">

			<!--begin::Card-->
			<div class="card card-custom gutter-b card-stretch">

				<div class="card-header">
					<div class="card-title">
						<h3 class="card-label">Feedback</h3>
					</div>
					<!-- <div class="card-toolbar">
						<span class="text-muted mr-2"> Interception Status </span> <span class="btn btn-success btn-xs pt-1 pb-1 pl-2 pr-2  font-weight-bold btn-pill">{{ $data->interception_status }}</span>

					</div> -->
				</div>

				<div class="card-body">
					<!--begin::Example-->
							<div class="timeline timeline-justified timeline-4">
								<div class="timeline-items">

									@foreach($feedback as $feed)

										@if($feed->feedback_url != '')
											<div class="timeline-item">
												<div class="timeline-badge">
													<div class="bg-primary"></div>
												</div>
												<div class="timeline-content">
													<p class="font-size-h6 m-0">
														<audio controls>
															<source src="{{ url('storage/'.$feed->feedback_url) }}" type="audio/ogg">
															<source src="{{ url('storage/'.$feed->feedback_url) }}" type="audio/mpeg">
														</audio>	
													</p>
													<span class="text-muted"><!-- 2 hour ago --> by </span> <span class="text-info"> {{ $feed->first_name }} </span>
												</div>
											</div>
										@endif

										<div class="timeline-item">
												<div class="timeline-badge">
													<div class="bg-primary"></div>
												</div>
												<div class="timeline-content">
													<p class="font-size-h6 m-0">
														{{ $feed->feedback_text }}
													</p>
													<span class="text-muted"><!-- 2 hour ago --> by </span> <span class="text-info"> {{ $feed->first_name }} </span>
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

	</div>

	@endsection

	{{-- Scripts Section --}}
	@section('scripts')
		<script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places,geometry"></script>
		<!--end::Page Vendors-->

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

				}

				return that;

			})();

			$(document).ready(function() {
				myPage.init();
			});
		</scritp>
	@endsection


