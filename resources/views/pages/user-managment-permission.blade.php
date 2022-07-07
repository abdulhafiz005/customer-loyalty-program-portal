{{-- Extends layout --}}
	@extends('layout.default')

	{{-- Content --}}
	@section('content')

	{{-- Dashboard 1 --}}
<style>
table, th, td {
  border: 1px solid black;
  padding: 5px;
}
</style>
	<div class="row">

		<div class="col-md-12">
			<div class="card card-custom gutter-b">

				<div class="card-header">
					<div class="card-title">
						<h3 class="card-label">Edit Permissions</h3>
					</div>
				</div>

				<form method="post" action="{{ URL::to('update-permissions') }}" >
				    <!--begin::Body-->
				    <div class="card-body pt-3 pb-3">

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

			    		{{ csrf_field() }}

                        <div class="col-md-8">
							<div class="form-group row fv-plugins-icon-container has-success">
								<div class="col-md-3">
									<label class="p-md-4">Role</label>
								</div>
								<div class="col-md-7">
									<select class="form-control @error('role') is-invalid @enderror" name="role" id="role" onchange="getCurrentPermissions(this);">
										<option value="" selected disabled>Select User Role</option>
										@foreach($user_roles as $role)
											<option value="{{ $role -> id }}">{{ $role -> name }}</option>
										@endforeach
									</select>
									@error('role')
										<div class="v-plugins-message-container text-danger mt-2">{{ $message }}</div>
									@enderror
								</div>
							</div>
						</div>

						<div class="col-md-8">
							<div class="form-group row fv-plugins-icon-container has-success">
								<div class="col-md-3">
									<label class="p-md-4">Permissions</label>
								</div>
								<div class="col-md-7 mt-4">
                                    <div class="form-group @error('permission') is-invalid @enderror" name="permission" id="permission">
                                        <div id="permissions_div">
                                        </div>
                                    </div>
									@error('permission')
										<div class="v-plugins-message-container text-danger mt-2">{{ $message }}</div>
									@enderror
								</div>
							</div>
						</div>
					</div>

					<div class="card-footer">
						<button type="submit" class="btn btn-primary mr-2">Update</button>
						<button type="reset" class="btn btn-secondary"><a href="{{ url()->previous() }}">Cancel</a></button>
					</div>

				</form>

			</div>
		</div>

	</div>

	@endsection


	{{-- Scripts Section --}}
	@section('scripts')

		<!--begin::Page Scripts(used by this page)-->
			<script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}" type="text/javascript"></script>
			<script src="{{ asset('js/pages/crud/forms/widgets/select2.js') }}"></script>
		<!--end::Page Scripts-->

		<script type="text/javascript">
			$(function(){
				$('#role').select2({
					multiple: false,
				});
			});

			function getCurrentPermissions(button){
				$.ajax({
					type: "GET",
					url: "{{URL::to('get-permissions')}}"+"/"+button.value,                
					cache: true,
					success: function(response) {
						document.getElementById('permissions_div').innerHTML = response;
					}
				});
			}
		</script>

	@endsection


