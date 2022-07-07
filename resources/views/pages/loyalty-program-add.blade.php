{{-- Extends layout --}}
	@extends('layout.default')

	{{-- Content --}}
	@section('content')

	{{-- Dashboard 1 --}}

	<div class="row">

		<div class="col-md-12">
			<div class="card card-custom gutter-b">

				<div class="card-header">
					<div class="card-title">
						<h3 class="card-label">Register Loyalty Program</h3>
					</div>
				</div>

			    <!--begin::Body-->
			    <div class="card-body pt-3 pb-3">

			    	<div class="col-md-6">	

						<div class="form-group row fv-plugins-icon-container has-success">
							<div class="col-md-5"> 
								<label class="p-md-4">Program Name</label> 
							</div>
							
							<div class="col-md-7">
								<input type="text" class="form-control form-control-solid form-control-lg" name="mb_id" id="mb_id" placeholder="Alaska" value="" >
							<div class="fv-plugins-message-container"></div></div>
						</div>

					</div>

					<div class="col-md-6">	

						<div class="form-group row fv-plugins-icon-container has-success">
							<div class="col-md-5"> 
								<label class="p-md-4">Banner Image</label> 
							</div>
							
							<div class="col-md-7">
								<div class="custom-file">
															<input type="file" class="custom-file-input" name="customFile" id="customFile" class="customFile">
															<label class="custom-file-label" for="customFile">Choose file</label>
														</div>
							<div class="fv-plugins-message-container"></div></div>
						</div>

					</div>


					<div class="col-md-6">	

						<div class="form-group row fv-plugins-icon-container has-success">
							<div class="col-md-5"> 
								<label class="p-md-4">Start Date</label> 
							</div>
							
							<div class="col-md-7">
								<div class="input-group date">
									<input type="text" class="form-control" id="kt_datepicker_2" readonly="" placeholder="Select date">
									<div class="input-group-append">
										<span class="input-group-text">
											<i class="la la-calendar-check-o"></i>
										</span>
									</div>
								</div>
							<div class="fv-plugins-message-container"></div></div>
						</div>

					</div>

					<div class="col-md-6">	

						<div class="form-group row fv-plugins-icon-container has-success">
							<div class="col-md-5"> 
								<label class="p-md-4">End Date</label> 
							</div>
							
							<div class="col-md-7">
								<div class="input-group date">
									<input type="text" class="form-control" id="kt_datepicker_2_2" readonly="" placeholder="Select date">
									<div class="input-group-append">
										<span class="input-group-text">
											<i class="la la-calendar-check-o"></i>
										</span>
									</div>
								</div>
							<div class="fv-plugins-message-container"></div></div>
						</div>

					</div>

					<div class="col-md-6">	

						<div class="form-group row fv-plugins-icon-container has-success">
							<div class="col-md-5"> 
								<label class="p-md-4">Rewards</label> 
							</div>
							
							<div class="col-md-7">
								<select class="form-control">
									<option>Mobile Phone</option>
									<option>1000</option>
									<option>5000</option>
								</select>
							<div class="fv-plugins-message-container"></div></div>
						</div>

					</div>

					<div class="col-md-6">	

						<div class="form-group row fv-plugins-icon-container has-success">
							<div class="col-md-5"> 
								<label class="p-md-4">Eligibility</label> 
							</div>
							
							<div class="col-md-7">
								<select class="form-control">
									<option>Select Number of Sales</option>
									<option>1000</option>
									<option>5000</option>
								</select>
							<div class="fv-plugins-message-container"></div></div>
						</div>

					</div>

					<div class="col-md-6">	

						<div class="form-group row fv-plugins-icon-container has-success">
							<div class="col-md-5"> 
								<label class="p-md-4">Program Details</label> 
							</div>
							
							<div class="col-md-7">
								<input type="text" class="form-control form-control-solid form-control-lg" name="mb_id" id="mb_id" placeholder="Loyalty Program details here" value="" >
							<div class="fv-plugins-message-container"></div></div>
						</div>

					</div>

				</div>

				<div class="card-footer">
					<button type="reset" class="btn btn-primary mr-2">Submit</button>
					<button type="reset" class="btn btn-secondary">Cancel</button>
				</div>
			</div>
		</div>

	</div>

	@endsection
	

	{{-- Scripts Section --}}
	@section('scripts')

		<!--begin::Page Scripts(used by this page)-->
			<script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}" type="text/javascript"></script>
		<!--end::Page Scripts-->

	@endsection


