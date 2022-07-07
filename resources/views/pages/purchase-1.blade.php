{{-- Extends layout --}}

@extends('layout.default')

@section('styles')
	<link type="text/css" rel="stylesheet" href="{{ asset('css/pages/wizard/wizard-4.css') }}">
@endsection

{{-- Content --}}

@section('content')

	{{-- Purchase 1 --}}
	<div id="loader_ajax" style="position: absolute;top:0px;left:0px;width: 100%;height: 100%;background: black;opacity: .5;z-index: 9999; display:none;">
		<div class="spinner spinner-primary spinner-lg" style="position: fixed;left: 55%;top: 40%;"></div>
	</div>
	<div class="d-flex flex-column-fluid">
		<!--begin::Container-->
		<div class=" container ">
			<div class="card card-custom card-transparent">
				<div class="card-body p-0">

					@if(session()->has('success'))
						<div class="alert alert-success">
							{{ session()->get('success') }}
						</div>
					@endif

					@if(session()->has('danger'))
						<div class="alert alert-danger">
							{{ session()->get('danger') }}
						</div>
					@endif

					@foreach ($errors->all() as $error)
						<div class="alert alert-warning">
							{{ $error }}
						</div>
					@endforeach

					<!--begin: Wizard-->
					<div class="wizard wizard-4" id="kt_wizard_v4" data-wizard-state="first" data-wizard-clickable="true">

						<!--begin: Wizard Nav-->
						<div class="wizard-nav">
							<div class="wizard-steps">

								<!--begin::Wizard Step 1 Nav-->
								<div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
									<div class="wizard-wrapper">
										<div class="wizard-number"> 1 </div>
										<div class="wizard-label">
											<div class="wizard-title"> Member Info </div>
										</div>
									</div>
								</div>
								<!--end::Wizard Step 1 Nav-->

								<!--begin::Wizard Step 2 Nav-->
								<div class="wizard-step" data-wizard-type="step" data-wizard-state="pending">
									<div class="wizard-wrapper">
										<div class="wizard-number"> 2 </div>
										<div class="wizard-label">
											<div class="wizard-title"> Select Product </div>
										</div>
									</div>
								</div>
								<!--end::Wizard Step 2 Nav-->

								<!--begin::Wizard Step 3 Nav-->
								<div class="wizard-step" data-wizard-type="step" data-wizard-state="pending">
									<div class="wizard-wrapper">
										<div class="wizard-number"> 3 </div>
										<div class="wizard-label">
											<div class="wizard-title"> Enter Information </div>
										</div>
									</div>
								</div>
								<!--end::Wizard Step 3 Nav-->

							</div>
						</div>
						<!--end: Wizard Nav-->

						<!--begin: Wizard Body-->
						<div class="card card-custom card-shadowless rounded-top-0">
							<div class="card-body p-0">
								<div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
									<div class="col-xl-12">

										<!--begin: Wizard Form-->
										<form class="form mt-0  fv-plugins-bootstrap fv-plugins-framework" id="kt_form" method="post" action="{{action('PurchaseController@add_purchase')}}" onkeydown="return event.key != 'Enter';" enctype="multipart/form-data">

											{{ csrf_field() }}

											<!--begin: Wizard Step 1-->
											<div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">

												<!--begin::Input-->
												<div class="form-group fv-plugins-icon-container">
													<label>CNIC</label>
													<input type="text" class="form-control form-control-solid form-control-lg" id="cnic" name="cnic" placeholder="Enter CNIC Number" value="">
													<div class="fv-plugins-message-container"></div>
												</div>
                                                <div class="form-group fv-plugins-icon-container">
                                                    <label>Truck No</label>
                                                    <input type="text" class="form-control form-control-solid form-control-lg" id="truck_number" name="truck_number" placeholder="Enter Truck Number" value="">
                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
												<!--end::Input-->
											</div>
											<!--end: Wizard Step 1-->

											<!--begin: Wizard Step 2-->
											<div class="pb-5" data-wizard-type="step-content">
												<div class="mb-10 font-weight-bold text-dark font-size-h5">Select Product</div>

												<!--begin::Input-->
												<div class="col-md-12 shell_grid form-group">
													<ul>
														@php($count=0)
														@foreach($products as $product)
															@php($count++)
															<li>
																<input type="radio" id="myCheckbox{{$count}}" name="checkbox_select" value="{{ $product->id }}" />
																<label for="myCheckbox{{$count}}">
																	<img src="{{ asset($product->product_picture) }}" />
																	<p>{{ $product->product_name }}</p>
																</label>
															</li>
														@endforeach
													</ul>
												</div>
												<!--end::Input-->

											</div>
											<!--end: Wizard Step 3-->

											<!--begin: Wizard Step 4-->
											<div class="pb-5" data-wizard-type="step-content">
												<!--begin::Section-->
												<div class="row">
													<h4 class="col-md-5 mb-10 font-weight-bold text-dark">Personal Detail</h4>
													<h4 class="col-md-6 mb-10 font-weight-bold text-dark">Agent Detail</h4>
												</div>

												<div class="row">

													<div class="col-md-5">

														<div class="form-group row fv-plugins-icon-container has-success">
															<div class="col-md-4">
																<label class="p-md-4">Trucker ID</label>
															</div>

															<div class="col-md-8">
																<input type="text" class="form-control form-control-solid form-control-lg" id="member_id" placeholder="" @if(!empty($response)) value="{{ $response['member_id'] }}" @endif readonly>
																<input type="hidden" name="member_id" @if(!empty($response)) value="{{ $response['id'] }}" @endif>
															</div>
														</div>

														<div class="form-group row fv-plugins-icon-container has-success">
															<div class="col-md-4">
																<label class="p-md-4">Tucker Name</label>
															</div>

															<div class="col-md-8">
																<input type="text" class="form-control form-control-solid form-control-lg" name="tucker_name" id="tucker_name" placeholder="" @if(!empty($response)) value="{{ $response['first_name'] }}" @endif readonly>
															</div>
														</div>

													</div>

													<div class="col-md-5">

														<div class="form-group row fv-plugins-icon-container has-success">
															<div class="col-md-4">
																<label class="p-md-4">Agent Name</label>
															</div>

															<div class="col-md-8">
																<input type="text" class="form-control form-control-solid form-control-lg" id="agent_name" placeholder="" @if(!empty($response)) value="{{ $response['agent_name'] }}" @endif readonly>
																<input type="hidden" name="agent_name">
															</div>
														</div>

														<div class="form-group row fv-plugins-icon-container has-success">
															<div class="col-md-4">
																<label class="p-md-4">Agent Role</label>
															</div>

															<div class="col-md-8">
																<input type="text" class="form-control form-control-solid form-control-lg" name="agent_role" id="agent_role" placeholder="" @if(!empty($response)) value="{{ $response['agent_role'] }}" @endif readonly>
															</div>
														</div>

													</div>

												</div>

												<h4 class="mb-10 font-weight-bold text-dark">Purchase Detail</h4>

												<div class="form-group row fv-plugins-icon-container has-success">
													<div class="col-md-3 d-flex">
														<label class="p-md-4 d-flex" style="align-items: center;">Product</label>
													</div>

													<div class="col-md-3 bg-light-danger">
														<div class="d-flex p-2" style="align-items: center;">
															<img class="update_produt_img" src="{{ asset('media/shell/shell_2.png') }}" width="100px">
															<span class="ml-3"> <span id="update_produt_name"></span>
																<br> <a href="" id="change"> change </a>
															</span>
														</div>

													</div>
												</div>

												<!-- <div class="form-group row fv-plugins-icon-container has-success">
													<div class="col-md-3">
														<label class="p-md-4">Converted By</label>
													</div>

													<div class="col-md-3">
														<select class="form-control select2 is-valid" id="converted_by" name="converted_by">

														</select>
													</div>
												</div> -->

												<!-- <div class="form-group row fv-plugins-icon-container has-success">
													<div class="col-md-3">
														<label class="p-md-4">Outlet Location</label>
													</div>

													<div class="col-md-3">
														<select name="outlet_location" id="outlet_location" class="form-control form-control-solid form-control-lg">
															<option value="">Select</option>
															<option value="Nevada">Duplicate</option>
														</select>
													</div>
												</div> -->

												<div class="form-group row fv-plugins-icon-container has-success">
													<div class="col-md-3">
														<label class="p-md-4">Vehicle Number</label>
													</div>

													<div class="col-md-3">
														<!-- <select class="form-control select2 is-valid" id="kt_select2_1" name="param">

														</select> -->
														<input type="text" class="form-control form-control-solid form-control-lg" name="vehicle_name" id="vehicle_name" placeholder="" @if(!empty($response)) value="{{ $response['truck_no'] }}" @endif readonly>
													</div>
												</div>

												<div class="form-group row fv-plugins-icon-container has-success">
													<div class="col-md-3">
														<label class="p-md-4">Vehicle Current Mileage</label>
													</div>

													<div class="col-md-3">
														<input type="text" class="form-control form-control-solid form-control-lg" name="vehicle_current_mileage" id="vehicle_current_mileage" placeholder="" value="" required>
													</div>
												</div>

												<div class="form-group row fv-plugins-icon-container has-success">
													<div class="col-md-3">
														<label class="p-md-4">Next Oil Change</label>
													</div>

													<div class="col-md-3">
														<input type="date" class="form-control form-control-solid form-control-lg" name="next_oil_change" id="next_oil_change" placeholder="" value="" required>
													</div>
												</div>

												<div class="form-group row fv-plugins-icon-container has-success">
													<div class="col-md-3">
														<label class="p-md-4">Variant</label>
													</div>

													<div class="col-md-3">
														<select class="form-control" name="variant" required>
															<option value="1">1L</option>
															<option value="4">4L</option>
															<option value="10">10L</option>
															<option value="20">20L</option>
														</select>
													</div>
												</div>

												<div class="form-group row fv-plugins-icon-container has-success">
													<div class="col-md-3">
														<label class="p-md-4">Quantity</label>
													</div>

													<div class="col-md-3">
														<div class="custom-file">
															<input type="text" class="form-control form-control-solid form-control-lg" name="quantity" id="kt_touchspin_3" placeholder="" value="1" min="1" max="1000" required>
														</div>
													</div>
												</div>


												<div class="form-group row">
													<div class="col-md-3">
														<label class="p-md-4">Evidence</label>
													</div>

													<div class="col-md-3">
														<div class="custom-file">
															<input type="file" class="custom-file-input" name="evidence_p" id="evidence_p" class="custom-file" required>
															<label class="custom-file-label" for="evidence_p">Choose file</label>
														</div>
													</div>
												</div>


											</div>
											<!--end: Wizard Step 4-->

											<!--begin: Wizard Actions-->
											<div class="d-flex justify-content-between border-top mt-5 pt-10">
												<div class="mr-2">
													<button type="button" class="btn btn-light-primary font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-prev" id="action-prev"> Previous </button>
												</div>

												<div>
													<button type="submit" class="btn btn-success font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-submit" > Submit </button>
													<button type="button" class="btn btn-primary font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-next" id="action-next"> Next </button>
												</div>
											</div>
											<!--end: Wizard Actions-->
										</form>
										<!--end: Wizard Form-->

									</div>
								</div>
							</div>
						</div>
						<!--end: Wizard Bpdy-->

					</div>
					<!--end: Wizard-->
				</div>
			</div>
		</div>
		<!--end::Container-->
	</div>

@endsection

{{-- Scripts Section --}}

@section('scripts')
	<script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/pages/custom/wizard/wizard-4.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/pages/crud/forms/widgets/select2.js') }}"></script>

	<script type="text/javascript">

		$("input[name='quantity']").TouchSpin({
			min: 1,
			max: 100,
		});

		$(document).ready(function()
		{
			@if(!empty($response))
				localStorage.setItem("page", 1);
				document.getElementById("action-next").click();
				document.getElementById('action-next').style.display = 'block';
			@else
				localStorage.setItem("page", 0);
				document.getElementById('action-next').style.display = 'none';
			@endif

			$("#action-next").attr('disabled', true);

			//setup before functions
			var typingTimer;                //timer identifier
			var doneTypingInterval = 1000;  //time in ms (1 seconds)

			$('#cnic, #truck_number').on('keyup', function()
			{
				console.log('start typing');
				clearTimeout(typingTimer);
				if ($('#cnic').val() || $('#truck_number').val()) {
					console.log('calling');
			        typingTimer = setTimeout(doneTyping, doneTypingInterval);
			    }
			});

			function doneTyping()
			{
				console.log('called');
				document.getElementById('loader_ajax').style.display = 'block';
				var cnic     = $('#cnic').val();
				var truck_id = $('#truck_number').val();
				$('#cnic').removeClass('is-invalid');
				$('#truck_number').removeClass('is-invalid');
				$.ajax({
					url: "{{ route('ajax-check-member') }}",
					type: "POST",
					data: {
						_token: "{{ csrf_token() }}",
						cnic: cnic,
						truck_id: truck_id
					},
					success: function(response){
						var rs = JSON.parse(response);
						// console.log(rs);
						if(rs.status=='success')
						{
							console.log("success");
							document.getElementById('loader_ajax').style.display = 'none';
							$('#action-next').removeAttr('disabled');
							document.getElementById('action-next').style.display = 'block';
							$('#tucker_name').val(rs.data.first_name);
							$('input[name="member_id"]').val(rs.data.id);
							$('#vehicle_name').val(rs.data.truck_no);
							$('#member_id').val(rs.data.member_id);
							$('#agent_name').val(rs.data.agent_name);
							$('#agent_role').val(rs.data.agent_role);

							/*$.getJSON( "ajax-converted-by/"+mId, function(respond) {
								$('#converted_by').select2({
									multiple: true,
									data: respond
								});
							});*/

						}
						else {
							document.getElementById('loader_ajax').style.display = 'none';
							//$('#cnic').val('');
							$('#cnic').addClass('is-invalid');
							$('#truck_number').addClass('is-invalid');
							$("#action-next").attr('disabled', true);
							document.getElementById('action-next').style.display = 'none';
						}

					}
				});
			}

			$('#change').on('click', function(){
				$("#action-prev").click();
				return false;
			});

			$('input[name="checkbox_select').on('click', function(){
				if($('input[name="checkbox_select"]:checked').length > 0){
					$("#action-next").removeAttr('disabled');
					var id = $(this).attr('id');
					var src = $('label[for="'+id+'"]').children('img').attr('src');
					$('.update_produt_img').attr('src', src);
					$('label[for="'+id+'"]').children('p').html();
					$('#update_produt_name').html($('label[for="'+id+'"]').children('p').html());
				}else{
					$("#action-next").attr('disabled', true);
				}
			});

			$("#action-next").on('click', function(e){

				var page = localStorage.getItem("page");
				page     = parseInt(page) + 1;
				localStorage.setItem("page", page);
				//console.log('page:- '+ page);

				if (page == 1) {
					localStorage.setItem("mId", $('#mId').val());

					if($('input[name="checkbox_select"]:checked').length == 0){
						$("#action-next").attr('disabled', true);
					}
				}
				console.log("page: "+page);
				if (page == 2) {
					document.getElementById('action-next').style.display = 'none';
				}
			});

			$("#action-prev").on('click', function(){
				$("#action-next").attr('disabled', false);
				document.getElementById('action-next').style.display = 'block';
				var page = localStorage.getItem("page");
				page = parseInt(page) - 1;
				localStorage.setItem("page", page);
			});

			$(".wizard-step").on('click', function(e){
				e.preventDefault();
				return false;
			});

			$('#kt_touchspin_3').TouchSpin({
				buttondown_class: 'btn btn-secondary',
				buttonup_class: 'btn btn-secondary',
				min: -1000000000,
				max: 1000000000,
				stepinterval: 50,
				maxboostedstep: 10000000
			});
		});
	</script>
@endsection


