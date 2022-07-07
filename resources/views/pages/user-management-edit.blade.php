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
						<h3 class="card-label">Update User</h3>
					</div>
                    <button type="button" class="btn btn-danger mr-2 mt-4 mb-4" data-toggle="modal" data-target="#exampleModal">Delete</button>
				</div>

				<form method="post" action="{{action('UserController@update_user')}}" >
                    <input type="text" value="{{$user->id}}" name="user_id" style="display:none;"/>
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
									<label class="p-md-4">First Name</label>
								</div>

								<div class="col-md-7">
									<input type="text" value="{{$user->first_name}}" class="form-control form-control-solid form-control-lg @error('first_name') is-invalid @enderror" name="first_name" id="first_name">
									@error('first_name')
										<div class="v-plugins-message-container text-danger mt-2">{{ $message }}</div>
									@enderror
								</div>
							</div>

						</div>

						<div class="col-md-8">

							<div class="form-group row fv-plugins-icon-container has-success">
								<div class="col-md-3">
									<label class="p-md-4">Last Name</label>
								</div>

								<div class="col-md-7">
									<input type="text" class="form-control form-control-solid form-control-lg @error('first_name') is-invalid @enderror" name="last_name" id="last_name"
										value="{{  $user->last_name }}" >
									@error('last_name')
										<div class="v-plugins-message-container text-danger mt-2">{{ $message }}</div>
									@enderror
								</div>
							</div>

						</div>

                        <div class="col-md-8">

                            <div class="form-group row fv-plugins-icon-container has-success">
                                <div class="col-md-3">
                                    <label class="p-md-4">User Name</label>
                                </div>

                                <div class="col-md-7">
                                    <input type="text" class="form-control form-control-solid form-control-lg @error('user_name') is-invalid @enderror" name="user_name" id="user_name"
                                        value="{{  $user->user_name }}" >
                                    @error('user_name')
                                        <div class="v-plugins-message-container text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>

						<div class="col-md-8">

							<div class="form-group row fv-plugins-icon-container has-success">
								<div class="col-md-3">
									<label class="p-md-4">Phone</label>
								</div>

								<div class="col-md-7">
									<input type="text" class="form-control form-control-solid form-control-lg @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="" value="{{ str_replace('-', '', $user->phone) }}" >
									@error('phone')
									<div class="v-plugins-message-container text-danger mt-2">{{ $message }}</div>
									@enderror
								</div>
							</div>

						</div>

						<div class="col-md-8">

							<div class="form-group row fv-plugins-icon-container has-success">
								<div class="col-md-3">
									<label class="p-md-4">CNIC</label>
								</div>

								<div class="col-md-7">
									<input type="text" class="form-control form-control-solid form-control-lg @error('cnic') is-invalid @enderror" name="cnic" id="cnic" placeholder="" value="{{ str_replace('-', '', $user->cnic) }}" >
									@error('cnic')
										<div class="v-plugins-message-container text-danger mt-2">{{ $message }}</div>
									@enderror
                                    <input type="text" name="loyalty_program" id="loyalty_program" value="5" style="display:none;">
								</div>
							</div>

						</div>

						<div class="col-md-8">

							<div class="form-group row fv-plugins-icon-container has-success">
								<div class="col-md-3">
									<label class="p-md-4">Password</label>
								</div>

								<div class="col-md-7">
									<input type="text" class="form-control form-control-solid form-control-lg @error('password_text') is-invalid @enderror" name="password_text" id="password_text" placeholder="Password" value="{{ $user->password_text }}" >
									@error('password_text')
										<div class="v-plugins-message-container text-danger mt-2">{{ $message }}</div>
									@enderror
								</div>
							</div>

						</div>

						<div class="col-md-8">

							<div class="form-group row fv-plugins-icon-container has-success">
								<div class="col-md-3">
									<label class="p-md-4">Date of Birth</label>
								</div>

								<div class="col-md-7">
									<div class="input-group date">
										<input type="text" class="form-control @error('d_o_b') is-invalid @enderror" name="d_o_b" id="kt_datepicker_2" readonly="" placeholder="Select date" value="{{ date('m/d/Y', strtotime($user -> d_o_b)) }}">
										<div class="input-group-append">
											<span class="input-group-text">
												<i class="la la-calendar-check-o"></i>
											</span>
										</div>
									</div>
									@error('d_o_b')
										<div class="v-plugins-message-container text-danger mt-2">{{ $message }}</div>
									@enderror
								</div>
							</div>

						</div>

						<div class="col-md-8">

							<div class="form-group row fv-plugins-icon-container has-success">
								<div class="col-md-3">
									<label class="p-md-4">Birth City</label>
								</div>

								<div class="col-md-7">
									<select class="form-control @error('birth_city') is-invalid @enderror" name="birth_city" id="birth_city">
										<option value="{{$user->b_city}}" selected>{{$user->b_city}}</option>
										<option value="Islamabad">Islamabad</option>
										<option value="" disabled>Punjab Cities</option>
										<option value="Ahmed Nager Chatha">Ahmed Nager Chatha</option>
										<option value="Ahmadpur East">Ahmadpur East</option>
										<option value="Ali Khan Abad">Ali Khan Abad</option>
										<option value="Alipur">Alipur</option>
										<option value="Arifwala">Arifwala</option>
										<option value="Attock">Attock</option>
										<option value="Bhera">Bhera</option>
										<option value="Bhalwal">Bhalwal</option>
										<option value="Bahawalnagar">Bahawalnagar</option>
										<option value="Bahawalpur">Bahawalpur</option>
										<option value="Bhakkar">Bhakkar</option>
										<option value="Burewala">Burewala</option>
										<option value="Chillianwala">Chillianwala</option>
										<option value="Chakwal">Chakwal</option>
										<option value="Chichawatni">Chichawatni</option>
										<option value="Chiniot">Chiniot</option>
										<option value="Chishtian">Chishtian</option>
										<option value="Daska">Daska</option>
										<option value="Darya Khan">Darya Khan</option>
										<option value="Dera Ghazi Khan">Dera Ghazi Khan</option>
										<option value="Dhaular">Dhaular</option>
										<option value="Dina">Dina</option>
										<option value="Dinga">Dinga</option>
										<option value="Dipalpur">Dipalpur</option>
										<option value="Faisalabad">Faisalabad</option>
										<option value="Fateh Jhang">Fateh Jang</option>
										<option value="Ghakhar Mandi">Ghakhar Mandi</option>
										<option value="Gojra">Gojra</option>
										<option value="Gujranwala">Gujranwala</option>
										<option value="Gujrat">Gujrat</option>
										<option value="Gujar Khan">Gujar Khan</option>
										<option value="Hafizabad">Hafizabad</option>
										<option value="Haroonabad">Haroonabad</option>
										<option value="Hasilpur">Hasilpur</option>
										<option value="Haveli">Haveli</option>
										<option value="Lakha">Lakha</option>
										<option value="Jalalpur">Jalalpur</option>
										<option value="Jattan">Jattan</option>
										<option value="Jampur">Jampur</option>
										<option value="Jaranwala">Jaranwala</option>
										<option value="Jhang">Jhang</option>
										<option value="Jhelum">Jhelum</option>
										<option value="Kalabagh">Kalabagh</option>
										<option value="Karor Lal Esan">Karor Lal Esan</option>
										<option value="Kasur">Kasur</option>
										<option value="Kamalia">Kamalia</option>
										<option value="Kamoke">Kamoke</option>
										<option value="Khanewal">Khanewal</option>
										<option value="Khanpur">Khanpur</option>
										<option value="Kharian">Kharian</option>
										<option value="Khushab">Khushab</option>
										<option value="Kot Adu">Kot Adu</option>
										<option value="Jauharabad">Jauharabad</option>
										<option value="Lahore">Lahore</option>
										<option value="Lalamusa">Lalamusa</option>
										<option value="Layyah">Layyah</option>
										<option value="Liaquat Pur">Liaquat Pur</option>
										<option value="Lodhran">Lodhran</option>
										<option value="Malakwal">Malakwal</option>
										<option value="Mamoori">Mamoori</option>
										<option value="Mailsi">Mailsi</option>
										<option value="Mandi Bahauddin">Mandi Bahauddin</option>
										<option value="mian Channu">Mian Channu</option>
										<option value="Mianwali">Mianwali</option>
										<option value="Multan">Multan</option>
										<option value="Murree">Murree</option>
										<option value="Muridke">Muridke</option>
										<option value="Mianwali Bangla">Mianwali Bangla</option>
										<option value="Muzaffargarh">Muzaffargarh</option>
										<option value="Narowal">Narowal</option>
										<option value="Okara">Okara</option>
										<option value="Renala Khurd">Renala Khurd</option>
										<option value="Pakpattan">Pakpattan</option>
										<option value="Pattoki">Pattoki</option>
										<option value="Pir Mahal">Pir Mahal</option>
										<option value="Qaimpur">Qaimpur</option>
										<option value="Qila Didar Singh">Qila Didar Singh</option>
										<option value="Rabwah">Rabwah</option>
										<option value="Raiwind">Raiwind</option>
										<option value="Rajanpur">Rajanpur</option>
										<option value="Rahim Yar Khan">Rahim Yar Khan</option>
										<option value="Rawalpindi">Rawalpindi</option>
										<option value="Sadiqabad">Sadiqabad</option>
										<option value="Safdarabad">Safdarabad</option>
										<option value="Sahiwal">Sahiwal</option>
										<option value="Sangla Hill">Sangla Hill</option>
										<option value="Sarai Alamgir">Sarai Alamgir</option>
										<option value="Sargodha">Sargodha</option>
										<option value="Shakargarh">Shakargarh</option>
										<option value="Sheikhupura">Sheikhupura</option>
										<option value="Sialkot">Sialkot</option>
										<option value="Sohawa">Sohawa</option>
										<option value="Soianwala">Soianwala</option>
										<option value="Siranwali">Siranwali</option>
										<option value="Talagang">Talagang</option>
										<option value="Taxila">Taxila</option>
										<option value="Toba Tek  Singh">Toba Tek Singh</option>
										<option value="Vehari">Vehari</option>
										<option value="Wah Cantonment">Wah Cantonment</option>
										<option value="Wazirabad">Wazirabad</option>
										<option value="" disabled>Sindh Cities</option>
										<option value="Badin">Badin</option>
										<option value="Bhirkan">Bhirkan</option>
										<option value="Rajo Khanani">Rajo Khanani</option>
										<option value="Chak">Chak</option>
										<option value="Dadu">Dadu</option>
										<option value="Digri">Digri</option>
										<option value="Diplo">Diplo</option>
										<option value="Dokri">Dokri</option>
										<option value="Ghotki">Ghotki</option>
										<option value="Haala">Haala</option>
										<option value="Hyderabad">Hyderabad</option>
										<option value="Islamkot">Islamkot</option>
										<option value="Jacobabad">Jacobabad</option>
										<option value="Jamshoro">Jamshoro</option>
										<option value="Jungshahi">Jungshahi</option>
										<option value="Kandhkot">Kandhkot</option>
										<option value="Kandiaro">Kandiaro</option>
										<option value="Karachi">Karachi</option>
										<option value="Kashmore">Kashmore</option>
										<option value="Keti Bandar">Keti Bandar</option>
										<option value="Khairpur">Khairpur</option>
										<option value="Kotri">Kotri</option>
										<option value="Larkana">Larkana</option>
										<option value="Matiari">Matiari</option>
										<option value="Mehar">Mehar</option>
										<option value="Mirpur Khas">Mirpur Khas</option>
										<option value="Mithani">Mithani</option>
										<option value="Mithi">Mithi</option>
										<option value="Mehrabpur">Mehrabpur</option>
										<option value="Moro">Moro</option>
										<option value="Nagarparkar">Nagarparkar</option>
										<option value="Naudero">Naudero</option>
										<option value="Naushahro Feroze">Naushahro Feroze</option>
										<option value="Naushara">Naushara</option>
										<option value="Nawabshah">Nawabshah</option>
										<option value="Nazimabad">Nazimabad</option>
										<option value="Qambar">Qambar</option>
										<option value="Qasimabad">Qasimabad</option>
										<option value="Ranipur">Ranipur</option>
										<option value="Ratodero">Ratodero</option>
										<option value="Rohri">Rohri</option>
										<option value="Sakrand">Sakrand</option>
										<option value="Sanghar">Sanghar</option>
										<option value="Shahbandar">Shahbandar</option>
										<option value="Shahdadkot">Shahdadkot</option>
										<option value="Shahdadpur">Shahdadpur</option>
										<option value="Shahpur Chakar">Shahpur Chakar</option>
										<option value="Shikarpaur">Shikarpaur</option>
										<option value="Sukkur">Sukkur</option>
										<option value="Tangwani">Tangwani</option>
										<option value="Tando Adam Khan">Tando Adam Khan</option>
										<option value="Tando Allahyar">Tando Allahyar</option>
										<option value="Tando Muhammad Khan">Tando Muhammad Khan</option>
										<option value="Thatta">Thatta</option>
										<option value="Umerkot">Umerkot</option>
										<option value="Warah">Warah</option>
										<option value="" disabled>Khyber Cities</option>
										<option value="Abbottabad">Abbottabad</option>
										<option value="Adezai">Adezai</option>
										<option value="Alpuri">Alpuri</option>
										<option value="Akora Khattak">Akora Khattak</option>
										<option value="Ayubia">Ayubia</option>
										<option value="Banda Daud Shah">Banda Daud Shah</option>
										<option value="Bannu">Bannu</option>
										<option value="Batkhela">Batkhela</option>
										<option value="Battagram">Battagram</option>
										<option value="Birote">Birote</option>
										<option value="Chakdara">Chakdara</option>
										<option value="Charsadda">Charsadda</option>
										<option value="Chitral">Chitral</option>
										<option value="Daggar">Daggar</option>
										<option value="Dargai">Dargai</option>
										<option value="Darya Khan">Darya Khan</option>
										<option value="dera Ismail Khan">Dera Ismail Khan</option>
										<option value="Doaba">Doaba</option>
										<option value="Dir">Dir</option>
										<option value="Drosh">Drosh</option>
										<option value="Hangu">Hangu</option>
										<option value="Haripur">Haripur</option>
										<option value="Karak">Karak</option>
										<option value="Kohat">Kohat</option>
										<option value="Kulachi">Kulachi</option>
										<option value="Lakki Marwat">Lakki Marwat</option>
										<option value="Latamber">Latamber</option>
										<option value="Madyan">Madyan</option>
										<option value="Mansehra">Mansehra</option>
										<option value="Mardan">Mardan</option>
										<option value="Mastuj">Mastuj</option>
										<option value="Mingora">Mingora</option>
										<option value="Nowshera">Nowshera</option>
										<option value="Paharpur">Paharpur</option>
										<option value="Pabbi">Pabbi</option>
										<option value="Peshawar">Peshawar</option>
										<option value="Saidu Sharif">Saidu Sharif</option>
										<option value="Shorkot">Shorkot</option>
										<option value="Shewa Adda">Shewa Adda</option>
										<option value="Swabi">Swabi</option>
										<option value="Swat">Swat</option>
										<option value="Tangi">Tangi</option>
										<option value="Tank">Tank</option>
										<option value="Thall">Thall</option>
										<option value="Timergara">Timergara</option>
										<option value="Tordher">Tordher</option>
										<option value="" disabled>Balochistan Cities</option>
										<option value="Awaran">Awaran</option>
										<option value="Barkhan">Barkhan</option>
										<option value="Chagai">Chagai</option>
										<option value="Dera Bugti">Dera Bugti</option>
										<option value="Gwadar">Gwadar</option>
										<option value="Harnai">Harnai</option>
										<option value="Jafarabad">Jafarabad</option>
										<option value="Jhal Magsi">Jhal Magsi</option>
										<option value="Kacchi">Kacchi</option>
										<option value="Kalat">Kalat</option>
										<option value="Kech">Kech</option>
										<option value="Kharan">Kharan</option>
										<option value="Khuzdar">Khuzdar</option>
										<option value="Killa Abdullah">Killa Abdullah</option>
										<option value="Killa Saifullah">Killa Saifullah</option>
										<option value="Kohlu">Kohlu</option>
										<option value="Lasbela">Lasbela</option>
										<option value="Lehri">Lehri</option>
										<option value="Loralai">Loralai</option>
										<option value="Mastung">Mastung</option>
										<option value="Musakhel">Musakhel</option>
										<option value="Nasirabad">Nasirabad</option>
										<option value="Nushki">Nushki</option>
										<option value="Panjgur">Panjgur</option>
										<option value="Pishin valley">Pishin Valley</option>
										<option value="Quetta">Quetta</option>
										<option value="Sherani">Sherani</option>
										<option value="Sibi">Sibi</option>
										<option value="Sohbatpur">Sohbatpur</option>
										<option value="Washuk">Washuk</option>
										<option value="Zhob">Zhob</option>
										<option value="Ziarat">Ziarat</option>
										</select>
									</select>
									@error('birth_city')
										<div class="v-plugins-message-container text-danger mt-2">{{ $message }}</div>
									@enderror
								</div>
							</div>

						</div>


                        <div class="col-md-8">
							<div class="form-group row fv-plugins-icon-container has-success">
								<div class="col-md-3">
									<label class="p-md-4">User Role</label>
								</div>
								<div class="col-md-7">
									<select class="form-control @error('loyalty_program') is-invalid @enderror" name="loyalty_program" id="loyalty_program" onchange="DisplayAssignee(this);">
										<option value="" disabled>User role</option>
										@foreach($roles as $role)
                                            @if($user->role_id == $role->id)
                                                <option value="{{$role->id}}" selected>{{$role->name}}</option>
                                            @else
											    <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endif
										@endforeach
									</select>
									@error('loyalty_program')
										<div class="v-plugins-message-container text-danger mt-2">{{ $message }}</div>
									@enderror
								</div>
							</div>
						</div>

						<div class="col-md-8">
							<div class="form-group row fv-plugins-icon-container has-success">
								<div class="col-md-3">
									<label class="p-md-4">Status</label>
								</div>
								<div class="col-md-7">
                                    <div class="form-group @error('status') is-invalid @enderror" name="status" id="status">
                                        <div class="radio-inline">
                                            <label class="radio">
                                                <input type="radio" name="status" @if($user->status == 1) checked @endif value="1"/>
                                                <span></span>
                                                Active
                                            </label>
                                            <label class="radio">
                                                <input type="radio" name="status" @if($user->status == 0) checked @endif value="0"/>
                                                <span></span>
                                                Inactive
                                            </label>
                                        </div>
                                    </div>
									@error('status')
										<div class="v-plugins-message-container text-danger mt-2">{{ $message }}</div>
									@enderror
								</div>
							</div>
						</div>

						<div class="col-md-8" id="mechanicSupervisorsForUstasMechanics" @if($user->role_id != 4) style="display:none;" @endif>
							<div class="form-group row fv-plugins-icon-container has-success">
								<div class="col-md-3">
									<label class="p-md-4">Assign to</label>
								</div>
								<div class="col-md-7">
									<select class="form-control @error('assignTo') is-invalid @enderror" name="assignTo" id="assignTo">
										<option value="" disabled @if($user->assign_to == '') selected="selected" @endif>Select Mechanic Supervisor</option>
										@foreach($mechanicSupervisor as $mS)
                                            @if($user->assign_to == $mS->id)
											    <option value="{{$mS->id}}" selected>{{$mS->first_name}} {{$mS->last_name}}</option>
                                            @else
											    <option value="{{$mS->id}}">{{$mS->first_name}} {{$mS->last_name}}</option>
                                            @endif
										@endforeach
									</select>
									@error('assignTo')
										<div class="v-plugins-message-container text-danger mt-2">{{ $message }}</div>
									@enderror
								</div>
							</div>
						</div>


						<div class="col-md-8">

							<div class="form-group row fv-plugins-icon-container has-success">
								<div class="col-md-3">
									<label class="p-md-4">Location to be Placed</label>
								</div>

								<div class="col-md-7">
									<!-- <input type="text" class="form-control form-control-solid form-control-lg @error('location_to_place') is-invalid @enderror" name="location_to_place" id="location_to_place" placeholder="Add a tag" value="{{  old('location_to_place') }}" > -->
									<select class="form-control @error('location_to_place') is-invalid @enderror" name="location_to_place" id="location_to_place">
										<option value="" disabled>Select The City</option>
                                            @foreach($cities as $city)
                                                @if($user->location_to_be_place == $city->city)
                                                    <option value="{{$city->city}}" selected>{{$city->city}}</option>
                                                @else
                                                    <option value="{{$city->city}}">{{$city->city}}</option>
                                                @endif
                                            @endforeach
										</select>
									</select>
									@error('location_to_place')
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">This action can't be reversed.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this user?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-primary"><a href="{{URL::to('delete-user/'.$user->id.'/'.$user->role_id)}}" style="color:white;">Yes</a></button>
      </div>
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
				$('#birth_city, #location_to_place, #loyalty_program, #assignTo').select2({
					multiple: false,
				});
			});

            function DisplayAssignee(radio){
				var sp = document.getElementById('mechanicSupervisorsForUstasMechanics');
				if(radio.value == 4){
					sp.style.display = "block";
				}else{
					sp.style.display = "none";
				}
			}
		</script>

	@endsection


