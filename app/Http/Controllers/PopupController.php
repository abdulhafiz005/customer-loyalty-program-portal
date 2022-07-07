<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use Auth;

use Metronic;

class PopupController extends Controller
{
    public function __construct(){
        //parent::__construct();
        $this->middleware('custom.auth');
    }

    public function mechanic_form(){
        return '    <input type="hidden" name="user_id" value="'.request('user_id').'">
                    <div class="card-body pt-3 pb-3">

                        <div class="col-md-8">

                            <div class="form-group row fv-plugins-icon-container has-success">
                                <div class="col-md-3">
                                    <label class="p-md-4">Product Name</label>
                                </div>

                                <div class="col-md-7">

                                    <select class="form-control" name="product" required>
                                        <option value="1">Shell Rimula R4X 20W-50</option>
                                        <option value="2">Shell Rimula R1</option>
                                        <option value="3">Shell Rimula R2 Extra</option>
                                        <option value="4">Shell Rimula R4X 15W-40</option>
                                    </select>

                                </div>
                            </div>

                        </div>

                        <div class="col-md-8">

                            <div class="form-group row fv-plugins-icon-container has-success">
                                <div class="col-md-3">
                                    <label class="p-md-4">Varirant</label>
                                </div>

                                <div class="col-md-7">
                                    <select class="form-control" name="variant" required>
                                        <option value="1">1L</option>
                                        <option value="4">4L</option>
                                        <option value="10">10L</option>
                                        <option value="20">20L</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-8">
                            <div class="form-group row fv-plugins-icon-container has-success">
                                <div class="col-md-3">
                                    <label class="p-md-4">Quantity</label>
                                </div>

                                <div class="col-md-7">
                                    <div class="custom-file">
                                        <input type="text" class="form-control form-control-solid form-control-lg" name="quantity" id="kt_touchspin_3" placeholder="" value="" >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group row fv-plugins-icon-container has-success">
                                <div class="col-md-3">
                                    <label class="p-md-4">Attachment</label>
                                </div>

                                <div class="col-md-7">
                                <input  type="file" id="files" name="attachment[]" id="kt_uppy_5_input_control" multiple required><br><br>

                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                    </div>

                '; exit;
    }

    public function user_management(Request $request){
    	
    	$id = $request->input('user_id');
    	$user = \App\User::find($id);
		$mechanicSupervisors = \App\User::where('role_id', 3)->get();

		$return = "
            <input type='hidden' name='user' value='". $request->input('user_id') ."' />
			<div class='row'>
				<div class='col-md-12 mb-5'>
					<label> <h6> First Name </h6></label>
					<input type='text' name='first_name' class='form-control form-control-solid' value='". $user->first_name ."'/>
				</div> 

				<div class='col-md-12 mb-5'>
					<label> <h6> Last Name </h6></label>
					<input type='text' name='last_name' class='form-control form-control-solid' value='". $user->last_name ."'/>
				</div> 
			</div>

			<div class='row'>
				<div class='col-md-12 mb-5'>
					<label> <h6> Password </h5></label>
					<input type='text' name='password' class='form-control form-control-solid'  value='". $user->password_text ."'/>
				</div> 
			</div>


			<div class='row'>
				<div class='col-md-12 mb-5'>
					<label> <h6> User Type </h6></label>
					<select class='form-control form-control-solid' name='user_type'>
						<option value='1'".  ($user->role_id == 1 ? ' selected ' : '') ." >Administrator</option>
						<option value='2'".  ($user->role_id == 2 ? ' selected ' : '') ." >Brand Ambassador</option>
                        <option value='4'".  ($user->role_id == 4 ? ' selected ' : '') ." >Ustad Mechanic</option>
                        <option value='3'".  ($user->role_id == 3 ? ' selected ' : '') ." >Mechanic Supervisor</option>
                        <option value='5'".  ($user->role_id == 5 ? ' selected ' : '') ." >Safeer Truck Driver</option> 
						<option value='8'".  ($user->role_id == 8 ? ' selected ' : '') ." >Rimula Center</option>
					</select>
				</div> 
			</div>
			
			<div class='row'>
				<div class='col-md-12 mb-5'>
					<label> <h6> User Status </h6></label>
					<select class='form-control form-control-solid' name='status'>";
						if($user->status == 1){
							$return .= "<option value='1' selected>Active</option>
							<option value='0'>Inactive</option>";
						}else{
							$return .= "<option value='1'>Active</option>
							<option value='0' selected>Inactive</option>";
						}
					$return .= "</select>
				</div> 
			</div>";

			if($user-> role_id == 4){
				$return .= "<div class='row'>
				<div class='col-md-12 mb-5'>
					<label> <h6> Assign To </h6></label>
					<select class='form-control form-control-solid' name='assign_to'>";
						foreach($mechanicSupervisors as $mS){
							$return .= "<option value='".$mS->id."' >".$mS->first_name." ".$mS->last_name."</option>";
						}
					$return .= "</select>
				</div> 
			</div>";
			}

            $return .= "<div class='card-footer'>
                <button type='submit' class='btn btn-primary mr-2'>Submit</button>
            </div>
		";

		return $return;
    }

    public function trucker_management(Request $request){
        
        $id = $request->input('user_id');
        $user = \App\Trucker::find($id);
        $vehicle = \App\Truck::all();

        $return = "
            <input type='hidden' name='user' value='". $request->input('user_id') ."' />
            <div class='row'>
                <div class='col-md-12 mb-5'>
                    <label> <h6> First Name </h6></label>
                    <input type='text' name='first_name' class='form-control form-control-solid' value='". $user->first_name ."'/>
                </div> 

                <div class='col-md-12 mb-5'>
                    <label> <h6> Last Name </h6></label>
                    <input type='text' name='last_name' class='form-control form-control-solid' value='". $user->last_name ."'/>
                </div> 
            </div>

            <div class='row'>
                <div class='col-md-12 mb-5'>
                    <label> <h6> Contact </h5></label>
                    <input type='text' name='contact' class='form-control form-control-solid'  value='". $user->contact ."'/>
                </div> 
            </div>


            <div class='row'>
                <div class='col-md-12 mb-5'>
                    <label> <h6> Truck No </h6></label>
                    <select class='form-control' name='vehicle_id' required id='vehicle_id'>
                        <option> </option>'";
                        foreach ($vehicle as $key => $value) {
                            $return .= " <option value='". $value->truck_name ."' ". ($value->id == $user->truck_no ? 'selected' : '') ." >". $value->truck_name." </option>";
                        }

                        $return .= "
                    </select>
                </div> 
            </div>

            <div class='card-footer'>
                <button type='submit' class='btn btn-primary mr-2'>Submit</button>
            </div>
        ";

        return $return;
    }


    public function trucker_form(){

        $users = \App\User::where('role_id', 4)->get();

        $vehicle = \App\Truck::all();

        $return = '    <input type="hidden" name="user_id" value="'.request('user_id').'">
                    <div class="card-body pt-3 pb-3">

                        <div class="col-md-9">

                            <div class="form-group row fv-plugins-icon-container has-success">
                                <div class="col-md-4">
                                    <label class="p-md-4">Product Name</label>
                                </div>

                                <div class="col-md-7">

                                    <select class="form-control" name="product" required>
                                        <option value="2">Shell Rimula R1</option>
                                        <option value="3">Shell Rimula R2 Extra</option>
                                        <option value="4">Shell Rimula R4X 15W-40</option>
                                        <option value="1">Shell Rimula R4X 20W-50</option>
                                    </select>

                                </div>
                            </div>

                        </div>

                        <div class="col-md-9">

                            <div class="form-group row fv-plugins-icon-container has-success">
                                <div class="col-md-4">
                                    <label class="p-md-4">Varirant</label>
                                </div>

                                <div class="col-md-7">
                                    <select class="form-control" name="variant" required>
                                        <option value="1">1L</option>
                                        <option value="4">4L</option>
                                        <option value="10">10L</option>
                                        <option value="20">20L</option>
                                    </select>
                                </div>
                            </div>

                        </div>


                        <div class="col-md-9">
                            <div class="form-group row fv-plugins-icon-container has-success">
                                <div class="col-md-4">
                                    <label class="p-md-4">Quantity</label>
                                </div>

                                <div class="col-md-7">
                                    <div class="custom-file">
                                        <input type="text" class="form-control form-control-solid form-control-lg" name="quantity" id="kt_touchspin_3" placeholder="" value="" min=1 max=1000 >
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-9">

                            <div class="form-group row fv-plugins-icon-container has-success">
                                <div class="col-md-4">
                                    <label class="p-md-4">Ustad Mechanic</label>
                                </div>

                                <div class="col-md-7">
                                    <select class="form-control" name="ustad_mechanic" required id="ustad_mechanic">
                                        <option> </option>';
                                        foreach ($users as $key => $value) {
                                            $return .= '<option value="'. $value->id .'"> '. $value->first_name .' '. $value->last_name .' </option>';
                                        }

                                        $return .= '
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-9">

                            <div class="form-group row fv-plugins-icon-container has-success">
                                <div class="col-md-4">
                                    <label class="p-md-4">Vehicle No</label>
                                </div>

                                <div class="col-md-7">
                                    <select class="form-control" name="vehicle_id" required id="vehicle_id">
                                        <option> </option>';
                                        foreach ($vehicle as $key => $value) {
                                            $return .= '<option value="'. $value->vehicle_no .'"> '. $value->vehicle_no.' </option>';
                                        }

                                        $return .= '
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-9">
                            <div class="form-group row fv-plugins-icon-container has-success">
                                <div class="col-md-4">
                                    <label class="p-md-4">Previous Oil</label>
                                </div>

                                <div class="col-md-7">
                                    <select class="form-control form-control-solid form-control-lg" name="switch_to_shell">
                                        <option>Byco</option>
                                        <option>Castrol</option>
                                        <option>Caltex (DELO)</option>
                                        <option>Total</option>
                                        <option>Black Tiger</option>
                                        <option>PSO</option>
                                        <option>ZiC</option>
                                        <option>KIXX</option>
                                        <option>Hascol</option>
                                        <option>PUMA</option>
                                        <option>Shell</option>
                                        <option>Other</option>
                                    </select>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="form-group row fv-plugins-icon-container has-success">
                                <div class="col-md-4">
                                    <label class="p-md-4">Attachment</label>
                                </div>

                                <div class="col-md-7">
                                    <input  type="file" id="files" name="attachment[]" id="kt_uppy_5_input_control" multiple required><br><br>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="form-group row fv-plugins-icon-container has-success">
                                <div class="col-md-4">
                                    <label class="p-md-4">Date</label>
                                </div>

                                <div class="col-md-7">
                                   <div class="input-group date">
                                        <input type="text" class="form-control" name="d_o_b" id="kt_datepicker_2" readonly="" placeholder="Select date">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="la la-calendar-check-o"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                    </div>

					<script>
						$("#kt_touchspin_3").TouchSpin({
							min: 1,
							max: 100,
						});
					</script>

                '; return $return;
    }

    public function interception_details(Request $request){

    	$id = $request->input('interception_id');

    	$data = \App\Interception::find($id);

        $orignal = $data->getOriginal();

        $query = "SELECT iq.id, iq.question, ia.answer FROM intanswers AS ia 
                    INNER JOIN intquestions AS iq on iq.id = ia.question_id
                    WHERE ia.interception_id in (SELECT interceptions.id 
                        FROM interceptions 
                            WHERE cnic = '". $orignal['cnic'] ."')";

        $parts = DB::select(DB::raw($query));

        $query = "SELECT interception_feedback.*, users.first_name  
                    FROM interception_feedback
                        INNER JOIN interceptions on interceptions.id = interception_feedback.interception_id
                        INNER JOIN users on users.id = interceptions.agent
                        WHERE interception_feedback.interception_id in (SELECT interceptions.id 
                            FROM interceptions 
                                WHERE cnic = '". $orignal['cnic'] ."' )";

        $feedback = DB::select(DB::raw($query));

    	$return = '
    		<div class="row">

				<div class="col-lg-12 col-xxl-12">
					<div class="card card-custom gutter-b">

					    <div class="card-body pt-2">

					    	<div class="row">
					    		
					    		<div class="col-md-2 text-center" style="border-right: 1px solid #cece;">
									<img src="'.asset("media/users/blank.png").'" width="150px">
									<p class="font-size-h3 pt-3 text-weight-bold">'.  $data->name .'</p>
					    		</div> 

					    		<div class="col-md-10">

					    			<div class="col-md-12">
					    				<i class="icon-l fas fa-layer-group pr-1"></i>
					    				<span class="font-size-h5 font-weight-bold"> Personal Details</span>
					    				
					    				<div class="row">
					    					
					    					<div class="col-md-4 mt-5">
					    						<span class="text-muted">First Name: </span> <br>
					    						<span class="font-size-h6">'. $data->name .'</span>
					    					</div>

					    					<div class="col-md-4 mt-5">
					    						<span class="text-muted">CNIC: </span> <br>';

					    						foreach($parts as $part){
					    							if($part->id == 1 || $part->id == 12 || $part->id == 22){
														$return .= '<span class="font-size-h6">'. $part->answer .'</span>';
													}
												}

					    					$return .= '</div>
					    					
					    				</div>
					    			</div>

					    			<div class="separator separator-solid mt-10 separator-border-3"></div>';

					    			if($data->type == 2 || $data->type == 3){

					    				$return .= ' 

						    			<div class="col-md-12 mt-5">
						    				<i class="icon-l fas fa-truck pr-1"></i>
						    				<span class="font-size-h5 font-weight-bold">Details</span>
						    				<div class="row">
						    					
						    					<div class="col-md-2 mt-5">
						    						<span class="text-muted">Number: </span> <br>';
						    						foreach($parts as $part){
						    							if($part->id == 4 || $part->id == 25){
															$return .= '<span class="font-size-h6">'. $part->answer .'</span>';
						    							}
													}

												$return .= '	
						    					</div>

						    					<div class="col-md-3 mt-5">
						    						<span class="text-muted">Shop Name: </span> <br>';
						    						foreach($parts as $part){
						    							if($part->id == 5 || $part->id == 26){
															$return .= '<span class="font-size-h6">'. $part->answer .'</span>';
						    							}
						    						}

						    					$return .= '
						    					</div>

						    					<div class="col-md-3 mt-5">
						    						<span class="text-muted">City: </span> <br> ';
						    						foreach($parts as $part){
						    							if($part->id == 9 || $part->id == 30){
															$return .= '<span class="font-size-h6">'. $part->answer .'</span>';
						    							}
						    						}

						    					$return .= '
						    					</div>

						    				</div>
						    			</div>

						    			<div class="separator separator-solid mt-10 separator-border-3"></div>';

					    			}

					    			if($data->type == 1) {

					    				$return .= '

						    			<div class="col-md-12 mt-5">
						    				<i class="icon-l fas fa-truck pr-1"></i>
						    				<span class="font-size-h5 font-weight-bold">Vehicle Details</span>
						    				<div class="row">
						    					
						    					<div class="col-md-2 mt-5">
						    						<span class="text-muted">Registration No: </span> <br> ';
						    						foreach($parts as $part){
						    							if($part->id == 13){
															$return .= '<span class="font-size-h6">'. $part->answer .'</span>';
						    							}
													}

													$return .= '
						    					</div>

						    					<div class="col-md-3 mt-5">
						    						<span class="text-muted">Current Lubericant: </span> <br> ';
						    						foreach($parts as $part){
						    							if($part->id == 19){
															$return .= '<span class="font-size-h6">'. $part->answer .'</span>';
														}
													}

													$return .= '
						    					</div>

						    					<div class="col-md-3 mt-5">
						    						<span class="text-muted">Truck Registration Year: </span> <br> ';
						    						foreach($parts as $part){
						    							if($part->id == 17){
															$return .= '<span class="font-size-h6">'. $part->answer .'</span>';
						    							}
													}

													$return .= '
						    					</div>

						    					<div class="col-md-1 mt-5">
						    						<span class="text-muted">Model: </span> <br>';
						    						foreach($parts as $part){
						    							if($part->id == 18){
															$return .= '<span class="font-size-h6">'. $part->answer .'</span>';
														}
													}

													$return .= '
						    					</div>
						    					

						    				</div>
						    			</div>

						    			<div class="separator separator-solid mt-10 separator-border-3"></div>';

					    			} 

					    			$return .= '

					    		</div>

					    	</div>

					    </div>
					    <!--end::Body-->
					</div>
				</div>

				<div class="col-lg-6">

					<div class="card card-custom gutter-b card-stretch">

						<div class="card-header">
							<div class="card-title">
								<h3 class="card-label">Questions</h3>
							</div>
						</div>

						<div class="card-body questions_div">
							<div class="timeline timeline-justified timeline-4">
								<div class="timeline-items"> ';

									foreach($parts as $part){
										$return .= '
											<div class="timeline-item">
												<div class="timeline-badge">
													<div class="bg-primary"></div>
												</div>
												<div class="timeline-content">
													<p class="font-size-h6 m-0">'. $part->question .'</p>
													<p class="text-muted mb-0">'. $part->answer .'</p>
												</div>
											</div>';
									}

									$return .= '

								</div>
							</div>
		            	</div>
		        	</div>

		    	</div>


		    	<div class="col-lg-6">
					<div class="card card-custom gutter-b card-stretch">

						<div class="card-header">
							<div class="card-title">
								<h3 class="card-label">Feedback</h3>
							</div>
							<div class="card-toolbar">
								<span class="text-muted mr-2"> Interception Status </span> <span class="btn btn-success btn-xs pt-1 pb-1 pl-2 pr-2  font-weight-bold btn-pill">' .$data->interception_status .'</span>

							</div>
						</div>

						<div class="card-body">
							<div class="timeline timeline-justified timeline-4">
								<div class="timeline-items">';

									foreach($feedback as $feed){

										if($feed->feedback_url != ''){

											$return .= '		
											<div class="timeline-item">
												<div class="timeline-badge">
													<div class="bg-primary"></div>
												</div>
												<div class="timeline-content">
													<p class="font-size-h6 m-0">
														<audio controls>
															<source src="'. url('storage/'.$feed->feedback_url) .'" type="audio/ogg">
															<source src="'. url('storage/'.$feed->feedback_url) .'" type="audio/mpeg">
														</audio>	
													</p>
													<span class="text-muted"><!-- 2 hour ago --> by </span> <span class="text-info"> {{ $feed->first_name }} </span>
												</div>
											</div>';
										}

										$return .= '

										<div class="timeline-item">
											<div class="timeline-badge">
												<div class="bg-primary"></div>
											</div>
											<div class="timeline-content">
												<p class="font-size-h6 m-0">'.$feed->feedback_text .'</p>
													<span class="text-muted"><!-- 2 hour ago --> by </span> <span class="text-info">'. $feed->first_name .'</span>
											</div>
										</div>';
									}

									$return .= '
								</div>
							</div>

		            	</div>
		        	</div>

		    	</div>

			</div>
    	';


    	return $return;
    }

    public function trucker_details(Request $request){
    	$id = $request->input('trucker_id');

    	$trucker = \App\Trucker::find($id);

        $data = $trucker->getOriginal();

        $interception_query = "SELECT i.name, i.vehicle_no, u.first_name, u.last_name, i.created_at 
                                FROM interceptions AS i 
                                INNER JOIN users AS u on u.id = i.agent 
                                where i.cnic = '". $data['cnic'] ."'";

        $interception_query = DB::select(DB::raw($interception_query));

        $interception_questions = "SELECT iq.id, iq.question, ia.answer FROM intanswers AS ia 
                                    INNER JOIN intquestions AS iq on iq.id = ia.question_id
                                    WHERE ia.interception_id in (SELECT interceptions.id 
                                    FROM interceptions 
                                    WHERE cnic = '". $data['cnic'] ."')";

        $interception_questions = DB::select(DB::raw($interception_questions));


        $interception_feedback = "SELECT interception_feedback.*, users.first_name  
                                    FROM interception_feedback
                                        INNER JOIN interceptions on interceptions.id = interception_feedback.interception_id
                                        INNER JOIN users on users.id = interceptions.agent
                                        WHERE interception_feedback.interception_id in (SELECT interceptions.id 
                                            FROM interceptions 
                                                WHERE cnic = '". $data['cnic'] ."' )";

        $interception_feedback = DB::select(DB::raw($interception_feedback));

        $purchase_ = "SELECT pro.product_name, DATE_FORMAT(p.created_at, '%d %b %Y') as created_at, u.first_name 
                        FROM purchases AS p 
                        INNER JOIN truckers AS t on t.id = p.user_id 
                        INNER JOIN products AS pro on pro.id = p.product_id 
                        INNER JOIN users as u on u.id = p.converted_by 
                        WHERE p.type = 1 AND t.id = ".$data['id'];

        $purchase_ = DB::select(DB::raw($purchase_));


        $return = '';


        $return .= '
        <div class="col-lg-12 col-xxl-12">
			<div class="card card-custom gutter-b">
			    <div class="card-body pt-2">

			    	<div class="row">
			    		
			    		<div class="col-md-3 text-center" style="border-right: 1px solid #cece;">
							<img src="'.asset('media/users/blank.png').'" width="150px">
							<p class="font-size-h3 pt-3 text-weight-bold">'. $data['first_name'] .'</p>
							
							<a href="#" class="btn btn-primary font-weight-bolder">
								'.Metronic::getSVG("media/svg/icons/Code/Plus.svg", "svg-icon-2x svg-icon-danger my-2 p-1").'
                               Add Note</a>
			    		</div>

			    		<div class="col-md-9">

			    			<div class="col-md-12">
			    				'. Metronic::getSVG("media/svg/icons/Design/Layers.svg", "svg-icon-2x svg-icon-danger my-2 p-1") .' 
			    				<span class="font-size-h5 font-weight-bold">Personal Details</span>
			    				
			    				<div class="row">
			    					
			    					<div class="col-md-2 mt-5">
			    						<span class="text-muted font-size-sm">First Name: </span> <br>
			    						<span class="font-size-lg">'. $data['first_name'] .'</span>
			    					</div>

			    					<div class="col-md-2 mt-5">
			    						<span class="text-muted font-size-sm">Last Name: </span> <br>
			    						<span class="font-size-lg">'. $data['last_name'] .'</span>
			    					</div>

			    					<div class="col-md-3 mt-5">
			    						<span class="text-muted font-size-sm">CNIC: </span> <br>
			    						<span class="font-size-lg">'. $data['cnic'] .'</span>
			    					</div>

			    					<div class="col-md-3 mt-5">
			    						<span class="text-muted font-size-sm">Date of Birth: </span> <br>
			    						<span class="font-size-lg">'. $data['d_o_b'] .'</span>
			    					</div>

			    					<div class="col-md-2 mt-5">
			    						<span class="text-muted font-size-sm">Birth City: </span> <br>
			    						<span class="font-size-lg">'. $data['b_city'] .'</span>
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
			    						<span class="font-size-lg">'. $interception_query[0]->vehicle_no  .'</span>
			    					</div>

			    					<div class="col-md-4 mt-5">
			    						<span class="text-muted font-size-sm">Driving Experience: </span> <br>
			    						<span class="font-size-lg">'. $data['driving_exp'] .' Years</span>
			    					</div>

			    					<!-- <div class="col-md-4 mt-5">
			    						<span class="text-muted font-size-sm">Frequent Routes: </span> <br>
			    						<span class="btn btn-secondary font-size-sm">Islamabad</span>
			    						<span class="btn btn-secondary font-size-sm">Peshawar</span>
			    					</div> -->

			    				</div>
			    			</div>

			    			<div class="separator separator-solid mt-10 separator-border-3"></div>

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
			    			</div>

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
			    <div class="card-body pl-3 pt-2 pr-2"> ';

			        foreach( $interception_query as $interceptions ){
			        	$return .= '
					        <div class="d-flex align-items-center space_border">
					            <span class="bullet bullet-bar bg-info align-self-stretch mr-3"></span>
					            <div class="d-flex flex-column flex-grow-1">
					                <a href="#" class="text-dark-65 text-hover-primary font-weight-bold font-size-lg mb-1">
					                    '. $data['first_name'] .' intrepted by Safeer Truck
					                </a>
					                <div class="d-flex">
					                	<span class="text-muted font-size-xs pr-1"> 
					                		'. Carbon\Carbon::parse($interceptions->created_at)->diffForHumans() .' by  
					                	</span> 
					                	<span class="text-info font-size-xs">'. $interceptions->first_name. ' '. $interceptions->last_name .'</span>
					                </div>
					            </div>
					        </div>';
			        }
			        $return .= '
			    </div>
			</div>
         </div>

		<div class="col-lg-3 pr-0">

			<div class="card card-custom card-stretch gutter-b">

				<div class="card-header">
					<div class="card-title">
						<h3 class="card-label">Questionnaire History</h3>
					</div>
				</div>

				<div class="card-body p-2 card_body_fixed">
					<div class="timeline timeline-justified timeline-4">
						<div class="timeline-items">  ';

							foreach($interception_questions as $int_question){
								$return .= '
								<div class="timeline-item">
									<div class="timeline-badge">
										<div class="bg-primary"></div>
									</div>
									<div class="timeline-content p-3">
										<p class="font-size-sm mb-2">'. $int_question->question .'</p>
										<p class="text-muted font-size-xs">'. $int_question->answer .'</p>
									</div>
								</div>';
							}

							$return .= '
						</div>
					</div>
            	</div>
        	</div>
    	</div>

    	<div class="col-lg-3 pr-0">

			<div class="card card-custom card-stretch gutter-b">

				<div class="card-header">
					<div class="card-title">
						<h3 class="card-label">Feedback</h3>
					</div>
				</div>

				<div class="card-body p-2 card_body_fixed">
					<div class="timeline timeline-justified timeline-4">
						<div class="timeline-items">';

							foreach($interception_feedback as $int_feedback){
								$return .= '
								<div class="timeline-item">
									<div class="timeline-badge">
										<div class="bg-primary"></div>
									</div>
									<div class="timeline-content p-3">
										<p class="font-size-sm mb-1">'. $feed->feedback_text .'</p>
										<span class="text-muted font-size-xs">
											'. Carbon\Carbon::parse($int_feedback->created_at)->diffForHumans() .' by 
										</span> 
										<span class="text-info font-size-xs"> '. $int_feedback->first_name .' </span>
									</div>
								</div>';

							}
							$return .= '
						</div>
					</div>
            	</div>
        	</div>

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
						<ul class="p_history pl-3">';

							foreach($purchase_ as $p){
								$return .= '
								<li class="pb-5 d-flex">
									<i class="fas fa-circle icon-nm mt-5 mr-3"></i>
									<div class="d-flex flex-column flex-grow-1">

										<a href="#" class="text-dark-65 text-hover-primary font-weight-bold font-size-lg mb-1">'. $p->product_name .' </a>
										<div class="d-flex">
											<span class="text-muted font-size-xs pr-1">'. $p->created_at .' </span> 
											<span class="text-info font-size-xs">'. $p->first_name .'</span>
										</div>

									</div>
								</li>';
							}
							$return .= '

						</ul>
					</div>
            	</div>
        	</div>
    	</div>';

    	return $return;

    }
        
}
