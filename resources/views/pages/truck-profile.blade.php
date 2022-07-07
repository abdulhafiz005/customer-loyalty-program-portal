{{-- Extends layout --}}
	@extends('layout.default')

	{{-- Content --}}
	@section('content')

	{{-- Dashboard 1 --}}

	<div class="row">

		<div class="col-md-3">
			<div class="card card-custom gutter-b">
			    <!--begin::Body-->
			    <div class="card-body pt-3 pb-3">
			    	<span class="display-3 font-weight-bolder">10</span>
			    	<p class="font-size-lg mb-1"> Purchase </p>
					<div id="chart"></div>
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="card card-custom gutter-b">
			    <!--begin::Body-->
			    <div class="card-body pt-3 pb-3">
			    	<span class="display-3 font-weight-bolder">4</span>
			    	<p class="font-size-lg mb-1"> Total Interceptions </p>
					<div id="chart2"></div>
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="card card-custom gutter-b">
			    <!--begin::Body-->
			    <div class="card-body pt-3 pb-3">
			    	<span class="display-3 font-weight-bolder">28</span>
			    	<p class="font-size-lg mb-1"> Loyalty Program score </p>
					<div id="chart3"></div>
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="card card-custom gutter-b">
			    <!--begin::Body-->
			    <div class="card-body pt-3 pb-3">
			    	<span class="display-3 font-weight-bolder">111</span>
			    	<p class="font-size-lg mb-1"> Reward Claim </p>
					<div id="chart4"></div>
				</div>
			</div>
		</div>

		<div class="col-lg-12 col-xxl-12">
			<div class="card card-custom gutter-b">
			    <!--begin::Header-->
			    <div class="card-header border-0">
			        <h3 class="card-title font-weight-bolder text-dark">Truck's Profile</h3>
			    </div>
			    <!--end::Header-->

			    <!--begin::Body-->
			    <div class="card-body pt-2">

			    	<div class="row">
			    		
			    		<div class="col-md-3 text-center" style="    border-right: 1px solid #cece;">
							<img src="{{ asset('media/users/blank.png') }}" width="150px">
							<p class="font-size-h3 pt-3 text-weight-bold">Hino Pak</p>
							<p class="text-muted"> AWD - 5235 </p>
			    		</div>

			    		<div class="col-md-9">

			    			<div class="col-md-12">
			    				{{ Metronic::getSVG("media/svg/icons/Design/Layers.svg", "svg-icon-2x svg-icon-danger my-2 p-1") }} 
			    				<span class="font-size-h5 font-weight-bold">Truck Details</span>
			    				
			    				<div class="row">
			    					
			    					<div class="col-md-2 mt-5">
			    						<span class="text-muted font-size-sm">Make: </span> <br>
			    						<span class="font-size-lg">Hino Pak</span>
			    					</div>

			    					<div class="col-md-2 mt-5">
			    						<span class="text-muted font-size-sm">Model Year: </span> <br>
			    						<span class="font-size-lg">2005</span>
			    					</div>

			    					<div class="col-md-3 mt-5">
			    						<span class="text-muted font-size-sm">Register Year: </span> <br>
			    						<span class="font-size-lg">2006</span>
			    					</div>

			    					<div class="col-md-3 mt-5">
			    						<span class="text-muted font-size-sm">Color: </span> <br>
			    						<span class="font-size-lg">Red/Black</span>
			    					</div>

			    					<div class="col-md-2 mt-5">
			    						<span class="text-muted font-size-sm">Truck Type: </span> <br>
			    						<span class="font-size-lg">Dumper</span>
			    					</div>
			    					
			    				</div>
			    			</div>

			    			<div class="separator separator-solid mt-10 separator-border-3"></div>

			    			<div class="col-md-12 mt-5">
			    				<i class="icon-l fas fa-truck pr-1"></i>
			    				<span class="font-size-h5 font-weight-bold">Professional Details</span>
			    				<div class="row">
			    					
			    					<div class="col-md-4 mt-5">
			    						<span class="text-muted font-size-sm">Current Owner: </span> <br>
			    						<span class="font-size-lg">Shehzad Mirza</span>
			    					</div>

			    					<div class="col-md-4 mt-5">
			    						<span class="text-muted font-size-sm">Mileage: </span> <br>
			    						<span class="font-size-lg">1,50,000 Kms</span>
			    					</div>

			    					<div class="col-md-4 mt-5">
			    						<span class="text-muted font-size-sm">Frequent Routes: </span> <br>
			    						<span class="btn btn-secondary p-2 font-size-xs">Islamabad Motorway</span>
			    						<span class="btn btn-secondary p-2 font-size-xs">Peshawar Highway</span>
			    					</div>

			    				</div>
			    			</div>

			    		</div>

			    	</div>

			    </div>
			    <!--end::Body-->
			</div>
		</div>

		<div class="col-lg-4 pr-0">
            <!--begin::List Widget 4-->
			<div class="card card-custom card-stretch gutter-b">
			    <!--begin::Header-->
			    <div class="card-header">
			        <h3 class="card-title text-dark"> Interception History </h3>
			    </div>
			    <!--end::Header-->

			    <!--begin::Body-->
			    <div class="card-body pl-3 pt-2 pr-2">

			        <div class="d-flex align-items-center space_border">
			            <!--begin::Bullet-->
			            <span class="bullet bullet-bar bg-warning align-self-stretch mr-3"></span>
			            <!--end::Bullet-->
			            <!--begin::Text-->
			            <div class="d-flex flex-column flex-grow-1">
			                <a href="#" class="text-dark-65 text-hover-primary font-weight-bold font-size-lg mb-1">
			                    Zain intrepted by Safeer Truck
			                </a>
			                <div class="d-flex">
			                	<span class="text-muted font-size-xs pr-1">2 hour ago by  </span> <span class="text-info font-size-xs"> Zeeshan Ahmed Solangi </span>
			                </div>
			                
			            </div>
			            <!--end::Text-->
			        </div>

			        <div class="d-flex align-items-center space_border">
			            <!--begin::Bullet-->
			            <span class="bullet bullet-bar bg-info align-self-stretch mr-3"></span>
			            <!--end::Bullet-->
			            <!--begin::Text-->
			            <div class="d-flex flex-column flex-grow-1">
			                <a href="#" class="text-dark-65 text-hover-primary font-weight-bold font-size-lg mb-1">
			                    Zain intrepted by Safeer Truck
			                </a>
			                <div class="d-flex">
			                	<span class="text-muted font-size-xs pr-1">2 hour ago by  </span> <span class="text-info font-size-xs"> Zeeshan Ahmed Solangi </span>
			                </div>
			                
			            </div>
			            <!--end::Text-->
			        </div>

			        <div class="d-flex align-items-center space_border">
			            <!--begin::Bullet-->
			            <span class="bullet bullet-bar bg-success align-self-stretch mr-3"></span>
			            <!--end::Bullet-->
			            <!--begin::Text-->
			            <div class="d-flex flex-column flex-grow-1">
			                <a href="#" class="text-dark-65 text-hover-primary font-weight-bold font-size-lg mb-1">
			                    Zain intrepted by Safeer Truck
			                </a>
			                <div class="d-flex">
			                	<span class="text-muted font-size-xs pr-1">2 hour ago by  </span> <span class="text-info font-size-xs"> Zeeshan Ahmed Solangi </span>
			                </div>
			                
			            </div>
			            <!--end::Text-->
			        </div>

			        <div class="d-flex align-items-center space_border">
			            <!--begin::Bullet-->
			            <span class="bullet bullet-bar bg-info align-self-stretch mr-3"></span>
			            <!--end::Bullet-->
			            <!--begin::Text-->
			            <div class="d-flex flex-column flex-grow-1">
			                <a href="#" class="text-dark-65 text-hover-primary font-weight-bold font-size-lg mb-1">
			                    Zain intrepted by Safeer Truck
			                </a>
			                <div class="d-flex">
			                	<span class="text-muted font-size-xs pr-1">2 hour ago by  </span> <span class="text-info font-size-xs"> Zeeshan Ahmed Solangi </span>
			                </div>
			                
			            </div>
			            <!--end::Text-->
			        </div>

			        <div class="d-flex align-items-center space_border">
			            <!--begin::Bullet-->
			            <span class="bullet bullet-bar bg-primary align-self-stretch mr-3"></span>
			            <!--end::Bullet-->
			            <!--begin::Text-->
			            <div class="d-flex flex-column flex-grow-1">
			                <a href="#" class="text-dark-65 text-hover-primary font-weight-bold font-size-lg mb-1">
			                    Zain intrepted by Safeer Truck
			                </a>
			                <div class="d-flex">
			                	<span class="text-muted font-size-xs pr-1">2 hour ago by  </span> <span class="text-info font-size-xs"> Zeeshan Ahmed Solangi </span>
			                </div>
			                
			            </div>
			            <!--end::Text-->
			        </div>



			    </div>
			    <!--end::Body-->
			</div>
			<!--end:List Widget 4-->
         </div>

        <div class="col-lg-4 pr-0">
            <!--begin::List Widget 4-->
			<div class="card card-custom card-stretch gutter-b">
			    <!--begin::Header-->
			    <div class="card-header">
			        <h3 class="card-title text-dark"> Drivers History </h3>
			    </div>
			    <!--end::Header-->

			    <!--begin::Body-->
			    <div class="card-body p-3">

					<div class="timeline timeline-6 mt-3">

						<!--begin::Item-->
						<div class="timeline-item align-items-start">
							<!--begin::Label-->
							<div class="timeline-label font-weight-bold text-dark-25 font-size-h6 pr-3">2020</div>
							<!--end::Label-->

							<!--begin::Badge-->
							<div class="timeline-badge">
								<i class="fa fa-genderless text-success icon-xl"></i>
							</div>
							<!--end::Badge-->

							<!--begin::Content-->
							<div class="timeline-content d-flex align-items-center mb-2">
								<!--begin::Symbol-->
								<div class="symbol symbol-50 symbol-light-white mr-5">
									<div class="symbol-label">
										<img src="{{ asset('media/users/100_4.jpg') }}" class="h-100 align-self-end" alt="">
									</div>
								</div>
								<!--end::Symbol-->
								<!--begin::Text-->
								<div class="d-flex flex-column font-weight-bold">
									<a href="#" class="text-dark text-hover-primary mb-1 font-size-sm">Hassan Mustafa s/o  Karamat Mustafa</a>
									<span class="text-muted font-weight-400">Est. Mileage 30,0000</span>
								</div>
								<!--end::Text-->
							</div>
							<!--end::Content-->
						</div>
						<!--end::Item-->

						<!--begin::Item-->
						<div class="timeline-item align-items-start">
							<!--begin::Label-->
							<div class="timeline-label font-weight-bold text-dark-25 font-size-h6 pr-3">2015</div>
							<!--end::Label-->

							<!--begin::Badge-->
							<div class="timeline-badge">
								<i class="fa fa-genderless text-success icon-xl"></i>
							</div>
							<!--end::Badge-->

							<!--begin::Content-->
							<div class="timeline-content d-flex align-items-center mb-2">
								<!--begin::Symbol-->
								<div class="symbol symbol-50 symbol-light-white mr-5">
									<div class="symbol-label">
										<img src="{{ asset('media/users/100_13.jpg') }}" class="h-100 align-self-end" alt="">
									</div>
								</div>
								<!--end::Symbol-->
								<!--begin::Text-->
								<div class="d-flex flex-column font-weight-bold">
									<a href="#" class="text-dark text-hover-primary mb-1 font-size-sm">Hassan Mustafa s/o  Karamat Mustafa</a>
									<span class="text-muted font-weight-400">Est. Mileage 30,0000</span>
								</div>
								<!--end::Text-->
							</div>
							<!--end::Content-->
						</div>
						<!--end::Item-->

						<!--begin::Item-->
						<div class="timeline-item align-items-start">
							<!--begin::Label-->
							<div class="timeline-label font-weight-bold text-dark-25 font-size-h6 pr-3">2010</div>
							<!--end::Label-->

							<!--begin::Badge-->
							<div class="timeline-badge">
								<i class="fa fa-genderless text-success icon-xl"></i>
							</div>
							<!--end::Badge-->

							<!--begin::Content-->
							<div class="timeline-content d-flex align-items-center mb-2">
								<!--begin::Symbol-->
								<div class="symbol symbol-50 symbol-light-white mr-5">
									<div class="symbol-label">
										<img src="{{ asset('media/users/100_11.jpg') }}" class="h-100 align-self-end" alt="">
									</div>
								</div>
								<!--end::Symbol-->
								<!--begin::Text-->
								<div class="d-flex flex-column font-weight-bold">
									<a href="#" class="text-dark text-hover-primary mb-1 font-size-sm">Hassan Mustafa s/o  Karamat Mustafa</a>
									<span class="text-muted font-weight-400">Est. Mileage 30,0000</span>
								</div>
								<!--end::Text-->
							</div>
							<!--end::Content-->
						</div>
						<!--end::Item-->

						<!--begin::Item-->
						<div class="timeline-item align-items-start">
							<!--begin::Label-->
							<div class="timeline-label font-weight-bold text-dark-25 font-size-h6 pr-3">2005</div>
							<!--end::Label-->

							<!--begin::Badge-->
							<div class="timeline-badge">
								<i class="fa fa-genderless text-success icon-xl"></i>
							</div>
							<!--end::Badge-->

							<!--begin::Content-->
							<div class="timeline-content d-flex align-items-center mb-2">
								<!--begin::Symbol-->
								<div class="symbol symbol-50 symbol-light-white mr-5">
									<div class="symbol-label">
										<img src="{{ asset('media/users/100_11.jpg') }}" class="h-100 align-self-end" alt="">
									</div>
								</div>
								<!--end::Symbol-->
								<!--begin::Text-->
								<div class="d-flex flex-column font-weight-bold">
									<a href="#" class="text-dark text-hover-primary mb-1 font-size-sm">Hassan Mustafa s/o  Karamat Mustafa</a>
									<span class="text-muted font-weight-400">Est. Mileage 30,0000</span>
								</div>
								<!--end::Text-->
							</div>
							<!--end::Content-->
						</div>
						<!--end::Item-->

						<!--begin::Item-->
						<div class="timeline-item align-items-start">
							<!--begin::Label-->
							<div class="timeline-label font-weight-bold text-dark-25 font-size-h6 pr-3">2000</div>
							<!--end::Label-->

							<!--begin::Badge-->
							<div class="timeline-badge">
								<i class="fa fa-genderless text-success icon-xl"></i>
							</div>
							<!--end::Badge-->

							<!--begin::Content-->
							<div class="timeline-content d-flex align-items-center mb-2">
								<!--begin::Symbol-->
								<div class="symbol symbol-50 symbol-light-white mr-5">
									<div class="symbol-label">
										<img src="{{ asset('media/users/100_14.jpg') }}" class="h-100 align-self-end" alt="">
									</div>
								</div>
								<!--end::Symbol-->
								<!--begin::Text-->
								<div class="d-flex flex-column font-weight-bold">
									<a href="#" class="text-dark text-hover-primary mb-1 font-size-sm">Hassan Mustafa s/o  Karamat Mustafa</a>
									<span class="text-muted font-weight-400">Est. Mileage 30,0000</span>
								</div>
								<!--end::Text-->
							</div>
							<!--end::Content-->
						</div>
						<!--end::Item-->
					</div>

			    </div>
			    <!--end::Body-->
			</div>
			<!--end:List Widget 4-->
        </div>


    	<div class="col-lg-4 pr-0">

			<!--begin::Card-->
			<div class="card card-custom card-stretch gutter-b">

				<div class="card-header">
					<div class="card-title">
						<h3 class="card-label">Oil Change History</h3>
					</div>
				</div>

				<div class="card-body p-2">
					<!--begin::Example-->
						<div class="">
							<ul class="p_history pl-3">
								<li class="pb-5 d-flex">
									<i class="fas fa-circle icon-nm mt-5 mr-3"></i>
									<div class="d-flex flex-column flex-grow-1">

									<a href="#" class="text-dark-65 text-hover-primary font-weight-bold font-size-lg mb-1">
												Purchase Shell Rimula Oil
										</a>
										<div class="d-flex">
											<span class="text-muted font-size-xs pr-1">09-Dec-2019 </span> <span class="text-info font-size-xs"> Lahore Motorway </span>
										</div>

									</div>
								</li>
								<li class="pb-5 d-flex">
									<i class="fas fa-circle icon-nm mt-5 mr-3"></i>
									<div class="d-flex flex-column flex-grow-1">
										<a href="#" class="text-dark-65 text-hover-primary font-weight-bold font-size-lg mb-1">
											Purchase Shell Rimula Oil
										</a>
										<div class="d-flex">
											<span class="text-muted font-size-xs pr-1">09-Dec-2019 </span> <span class="text-info font-size-xs"> Lahore Motorway </span>
										</div>

									</div>
								</li>
								<li class="pb-5 d-flex">
									<i class="fas fa-circle icon-nm mt-5 mr-3"></i>
									<div class="d-flex flex-column flex-grow-1">
										<a href="#" class="text-dark-65 text-hover-primary font-weight-bold font-size-lg mb-1">
											Purchase Shell Rimula Oil
										</a>
										<div class="d-flex">
											<span class="text-muted font-size-xs pr-1">09-Dec-2019 </span> <span class="text-info font-size-xs"> Lahore Motorway </span>
										</div>

									</div>
								</li>
								<li class="pb-5 d-flex">
									<i class="fas fa-circle icon-nm mt-5 mr-3"></i>
									<div class="d-flex flex-column flex-grow-1">
										<a href="#" class="text-dark-65 text-hover-primary font-weight-bold font-size-lg mb-1">
											Purchase Shell Rimula Oil
										</a>
										<div class="d-flex">
											<span class="text-muted font-size-xs pr-1">09-Dec-2019 </span> <span class="text-info font-size-xs"> Lahore Motorway </span>
										</div>

									</div>
								</li>
								<li class="pb-5 d-flex">
									<i class="fas fa-circle icon-nm mt-5 mr-3"></i>
									<div class="d-flex flex-column flex-grow-1">
										<a href="#" class="text-dark-65 text-hover-primary font-weight-bold font-size-lg mb-1">
											Purchase Shell Rimula Oil
										</a>
										<div class="d-flex">
											<span class="text-muted font-size-xs pr-1">09-Dec-2019 </span> <span class="text-info font-size-xs"> Lahore Motorway </span>
										</div>

									</div>
								</li>

							</ul>
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

		<script type="text/javascript">
			var options = {
				series: [{
					data: [50, 20, 0, 12, 20, 30, 0, 50]
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
					data: [50, 20, 0, 12, 20, 30, 0, 50]
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

			var chart = new ApexCharts(document.querySelector("#chart2"), options);
			chart.render();

			var options = {
				series: [{
					data: [50, 20, 0, 12, 20, 30, 0, 50]
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

			var chart = new ApexCharts(document.querySelector("#chart3"), options);
			chart.render();

			var options = {
				series: [{
					data: [50, 20, 0, 12, 20, 30, 0, 50]
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

			var chart = new ApexCharts(document.querySelector("#chart4"), options);
			chart.render();

      
    
		</script>
		<!--end::Page Vendors-->
	@endsection


