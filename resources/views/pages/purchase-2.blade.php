{{-- Extends layout --}}

@extends('layout.default')

{{-- Content --}}

@section('content')

	{{-- Purchase 1 --}}

	<div class="d-flex flex-column-fluid">
		<!--begin::Container-->
		<div class=" container ">
			<div class="card card-custom card-transparent">
				<div class="card-body p-0">

					<div class="card card-custom example example-compact">
						<div class="card-header">
							<h3 class="card-title">Sale Details</h3>
							@if($gifts -> count() < 3 &&  
									in_array($previous_purchases -> count(), [1, 2, 3]) && 
										$previous_purchases -> count() > $gifts -> count())
								<button type="button" style="float:right;" class="btn btn-primary mt-5 mb-5" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Assign Gift</button>
							@endif
						</div>
						<!--begin::Form-->
						<form class="form">
							<div class="card-body">

								<h3 class="mb-10 font-weight-bolder text-dark">Personal Details</h3>

								<div class="row">
									<div class="col-md-9">
										
										<div class="col-md-12 row">

											<div class="col-md-2 mb-10 font-size-sm font-weight-bold">
												Trucker ID <br>
												<span class="font-size-sm text-muted">{{ $purchase->trucker->id }}</span>
											</div>

											<div class="col-md-2 mb-10 font-size-sm font-weight-bold">
												Tucker Name <br>
												<span class="font-size-sm text-muted">{{ $purchase->trucker->first_name }} {{ $purchase->trucker->last_name }}</span>
											</div>

											<div class="col-md-2 mb-10 font-size-sm font-weight-bold">
												Total Purchases <br>
												<span class="font-size-sm text-muted">{{ $previous_purchases->count() }}</span>
											</div>

											<div class="col-md-2 mb-10 font-size-sm font-weight-bold">
												Gifts <br>
													<span class="font-size-sm text-muted">{{ $gifts -> count() }}</span>
											</div>
										</div>

										<div class="col-md-12 row">

										<!-- 	<div class="col-md-2 mb-10 font-size-sm font-weight-bold">
												Converted By <br>
												<span class="font-size-sm text-muted">{{ $purchase->converted_by }}</span>
											</div>
											<div class="col-md-2 mb-10 font-size-sm font-weight-bold">
												Outlet Location <br>
												<span class="font-size-sm text-muted">{{ $purchase->outlet_location }}</span>
											</div> -->
											<div class="col-md-2 mb-10 font-size-sm font-weight-bold">
												Vehicle Number <br>
												<span class="font-size-sm text-muted">{{ $purchase->vehicle_number }}</span>
											</div>

											<div class="col-md-3 mb-10 font-size-sm font-weight-bold">
												Vehicle Current Mileage <br>
												<span class="font-size-sm text-muted">{{ $purchase->vehicle_current_milage }}</span>
											</div>

											<div class="col-md-3 mb-10 font-size-sm font-weight-bold">
												Next Oil Change <br>
												<span class="font-size-sm text-muted">{{ $purchase->next_oil_change }}</span>
											</div>

											<div class="col-md-4 mb-10">
												<div class="d-flex p-5 bg-light-danger p-2 rounded" style="align-items: center;">
													<img src="{{ asset($purchase->product->product_picture) }}" width="60px">
													<span class="ml-3 font-size-lg font-weight-bold"> {{ $purchase->product->product_name }} </span>	
												</div>
												
											</div>

										</div>


									</div>

									<div class="col-md-3">
										<h5 class="display-5">Evidence</h5>

										<div class="p-5 text-center">
											@if( is_array(unserialize($purchase->evidence_p)) )
												@foreach(unserialize($purchase->evidence_p) as $leader)
													<img src="{{ url('storage/'.$leader) }}" width="100%">
													@break
												@endforeach
											@else
												<img src="{{ url('storage/'.unserialize($purchase->evidence_p)) }}" width="100%">
											@endif
										</div>
									</div>

								</div>

								@if($gifts -> count() > 0)	
									<h3 class="mb-10 font-weight-bolder text-dark">Gifts</h3>
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

							</div>

						</form>
						<!--end::Form-->
					</div>
				</div>
			</div>
		</div>
		<!--end::Container-->
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
			<input type="hidden" value="{{$purchase->trucker->id}}" name="trucker_id" />
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
<script>
	document.getElementById("submit-gift").addEventListener("click", function () {
		document.getElementById("submit-gift-form").click();
	});
</script>
@endsection
{{-- Scripts Section --}}

@section('scripts')
	<script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
@endsection


