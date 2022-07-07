<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Activity;
use URL;
use App\UserRole;
use App\question_sets_roles;
use App\Intquestion;
use App\question_sets;
use App\questions;
use App\Interception;
use App\Trucker;
use App\TruckerTruck;
use App\Truck;
use App\Mechanic;
use App\Intanswer;
use App\questions_radio_options;
use Storage;

Use File;

//use DateTime;


class UserController extends Controller {

	public $successStatus = 201;
	public $failStatus = 400;

	/**
	* login api
	*
	* @return \Illuminate\Http\Response
	*/

	public function __construct(){
		//parent::__construct();
        config(['app.timezone' => 'Asia/Karachi']);
	}

	public function login(){

		$credentials = array(
			'user_name' => request('first_name'),
			'password' 	 => request('password')
		);

		if (Auth::attempt ( $credentials )) {
			$user = Auth::user();

			// Get User & Role
			// $user = \App\User::find(Auth::user()->id);
			// $user_role = \App\UserRole::find(Auth::user()-> role_id);

			if(!in_array(Auth::user()->role_id, [2, 3, 4, 5]) || Auth::user()->status != 1){
				return response()->json(['error'=>'Unauthorised to use this app'], 401);
			}

			$success['token'] =  $user->createToken('MyApp')->accessToken;
			return response()->json(['success' => $success], $this->successStatus);
		}else{
			return response()->json(['error'=>'Invalid Username or Password'], 401);
		}
	}

	/**
	* details api
	*
	* @return \Illuminate\Http\Response
	*/

	public function details()
	{
		if (!$user = Auth::user())
			return response()->json(['error'=>'Unauthorised'], 401);

			// Get User & Role
			$user = \App\User::find(Auth::user()->id);
			$user_role = \App\UserRole::find(Auth::user()-> role_id);

			if(!in_array(Auth::user()->role_id, [2, 3, 4, 5]) || Auth::user()->status != 1){
				return response()->json(['error'=>'Unauthorised to use this app'], 401);
			}

			$question_sets = DB::table('question_sets_roles')->leftJoin('question_sets', 'question_sets.id', '=', 'question_sets_roles.question_set_id')
			->select('question_sets.id', 'question_sets.title')->where('question_sets_roles.role_id', $user->role_id)->get()->toArray();

			if($user->role_id == 3)
			{
				$total_interceptions_q = "SELECT Count(*) AS total
											FROM `mechanic_interceptions`
											WHERE agent = {$user->id}";

				$total_interceptions_q = DB::select(DB::raw($total_interceptions_q));
				$total_pending = 0;
				$total_interceptions = $total_interceptions_q[0] -> total;

				// get regisrered ustaad
				$ustaad_q = "SELECT Count(*) as total
							FROM `users` where assign_to = {$user->id}";

			    $ustaad_q = DB::select(DB::raw($ustaad_q));

				if (!empty($ustaad_q))
					$total_converted = $ustaad_q[0] -> total;
				else
					$total_converted = 0;
			}
			else
			{
				$total_interceptions_q = "SELECT Count(*) AS total, interception_status FROM `interceptions`
					WHERE agent = {$user->id} group by interception_status";

				$total_interceptions_q = DB::select(DB::raw($total_interceptions_q));
				$total_converted = 0;
				$total_pending = 0;
				foreach($total_interceptions_q as $total){
					if($total->interception_status == 'converted'){
						$total_converted = $total->total;
					}else if($total->interception_status == 'pending'){
						$total_pending = $total->total;
					}
				}
				$total_interceptions = ((int)$total_converted) + ((int)$total_pending);
			}

			$lp_query = \App\lp_earned::where('user_id', Auth::user()->id)->get()->sum("points_earned");

			$query_max_lp = "SELECT point_limit FROM lp_points where role_id = ". Auth::user()->role_id . " AND point_limit > ".$lp_query." limit 0,1";
			$result3 = DB::select(DB::raw($query_max_lp));

			if(isset($result3[0]->point_limit)){
				$result3 = $result3[0]->point_limit;
			}else{
				$result3 = 500;
			}

			$success['user_details'] = array(
				'id' 		 			=> Auth::user()->id,
				'first_name' 			=> $user -> first_name,
				'last_name'	 			=> $user -> last_name,
				'role'		 			=> $user_role -> name,
				'sets'		 			=> $question_sets,
				'total_converted' 		=> $total_converted,
				'total_interception'	=> $total_interceptions,
				'loyalty_point'			=> ['max_point' => $result3, 'total_gained_point' => $lp_query],
			);

			return response()->json(['success' => $success], $this->successStatus);
	}

	public function add_trucker($cnic = "", $contact = "", $truck_no = "")
	{
		$trucker = new Trucker;
		$trucker -> fresh();

		// echo "Adding new trucker {$trucker -> id}\n";

		if (!empty($cnic))
			$trucker -> cnic = $cnic;

		if (!empty($contact))
			$trucker -> contact = $contact;

		if (!empty($truck_no))
			$trucker -> truck_no = $truck_no;

		$trucker -> save();

		if (empty($truck_no))
			return $trucker -> id;

		$truck = Truck::firstOrNew(['vehicle_no' => $truck_no]);
		$truck -> truck_name = $truck_no;
		$truck -> trucker_id = $trucker -> id;
		$truck -> save();

		// add the record in the relations table

		$truckerTruck = new TruckerTruck();
		$truckerTruck -> trucker_id = $trucker -> id;
		$truckerTruck -> truck_id   = $truck -> id;
		$truckerTruck -> save();


		return $trucker -> id;
	}

	public function add_mechanic($cnic = "", $contact_no = ""){
		$mechanic = new Mechanic();
		$mechanic->cnic = $cnic;
		$mechanic->contact = $contact_no;
		$mechanic->save();
	}

	public function start_mechanic_interception(){
		$question_sets = DB::table('question_sets_roles')->leftJoin('question_sets', 'question_sets.id', '=', 'question_sets_roles.question_set_id')
		->select('question_sets.id', 'question_sets.title')->where('question_sets_roles.role_id', 3)->first();
		
		$total_questions = questions::where('question_set_id', $question_sets->id)->orderBy('order_id', 'asc')->get();

		$unanswered_questions_to_return = [];

		foreach($total_questions as $question){
			if($question->field_type == "radio")
			{
				$radio_options = questions_radio_options::where('question_id', $question->id)->get();

				// reset fetched options
				$options = [];

				foreach ($radio_options as $option)
				{
					$options[] = $option -> option;
				}
				$question -> radio_options = $options;
			}
			array_push($unanswered_questions_to_return, $question);
		}

		$mechanic = new \App\Mechanic();
		$mechanic->city = Auth::user()->location_to_be_place;
		$mechanic->save();

		$mechanic_interception = new \App\mechanic_interceptions();
		$mechanic_interception->mechanic_id = $mechanic->id;
		$mechanic_interception->agent = Auth::user()->id;
		$mechanic_interception->save(); 

		$return["interception_id"]    = $mechanic_interception->id;
		$return["total_questions"]    = $total_questions->count();
		$return["questions_answered"] = 0;
		$return["questions"]          = $unanswered_questions_to_return;

		return response()->json(['success' => $return], 200);

	}

	public function interception_start(){

		// get total questions for the user type - by user id / role id

		// get all previous interceptions
		// get all answers from all interceptions returned

		// if no interceptions found, create trucker , get trucker id
			// create interception, get interception id

		// else
			// create interception, get id
			// get trucker id from interception id


			// get remaining questions


		// send response
		$user_id = Auth::user()->id;
		$role_id = Auth::user()->role_id;

		if($role_id == 3){
			return $this -> start_mechanic_interception();
		}

		$question_set_id = request('set_id');
		$cnic            = request('cnic');
		$contactNo       = request('contact_no');
		$truckNo         = request('truck_no');

		if (empty($question_set_id))
			return response()->json(['error'=>'Operation Unsuccessfull'], $this -> failStatus);

		if (empty($cnic) && empty ($contactNo) && empty($truckNo))
			return response()->json(['error'=>'Operation Unsuccessfull'], $this -> failStatus);

		// $all_questions = questions::where('question_set_id', $question_set_id)->get();
		$total_questions = questions::where('question_set_id', $question_set_id)->orderBy('order_id', 'asc')->get();

		$profile_type = \App\question_sets::where('id', $question_set_id) -> first();

		// get trucker id
		// get all interception ids by the trucker id
		// get all answers for all interception ids

		// create new interception for the trucker id

		// return interception id and remaining questions

	
		if(empty($trucker_id) && $cnic != ""){
			$Trucker = Trucker::where('cnic', $cnic)->first();
			if (!empty ($Trucker))
				$trucker_id = $Trucker -> id;
		}
		if(empty($trucker_id) && $contactNo != ""){
			$Trucker = Trucker::where('contact', $contactNo)->first();
			if (!empty ($Trucker))
				$trucker_id = $Trucker -> id;
		}
		if(empty($trucker_id) && $truckNo != ""){
			$Trucker = DB::table('truckers')->leftJoin('trucker_trucks', 'trucker_trucks.trucker_id', '=', 'truckers.id')
				->leftJoin('trucks', 'trucker_trucks.truck_id', '=', 'trucks.id')
				->select('truckers.id')->where('trucks.vehicle_no', $truckNo)->first();
			if (!empty ($Trucker))
				$trucker_id = $Trucker -> id;
		}

		if(empty($trucker_id))
		{
			// echo 'trucker not found - adding ';
			// this is a new interception
			switch ($profile_type -> profile_type)
			{
				case 'trucker' :
					$trucker_id = $this -> add_trucker($cnic, $contactNo, $truckNo);
				break;

				case 'mechanic':
					// add_mechanic($cnic, $contactNo);
					return response()->json(['error'=>'Please use the web interface.'], $this -> failStatus);	
				break;
				default :
					return response()->json(['error'=>'Operation Unsuccessfull'], $this -> failStatus);	
				break;
			}
		}
		// else
		// 	echo 'trucker found ';

		// echo $trucker_id;

		$all_previous_interceptions = Interception::where('trucker_id', $trucker_id)->get();
		// print_r($all_previous_interceptions);
		$interception_ids = [];

		// create array of all previous interception ids
		foreach ($all_previous_interceptions as $interceptions)
		{
			$interception_ids[] = $interceptions -> id;
		}


		if (count($interception_ids) > 0)
		{
			$interception_ids = implode(', ', $interception_ids);
			
			$unanswered_questions = DB::select(DB::raw("SELECT * FROM questions WHERE id NOT IN
														(SELECT question_id FROM intanswers
															WHERE interception_id IN ($interception_ids))
															AND question_set_id = $question_set_id
															ORDER BY order_id ASC"));
			// the raw query returns an array of sets
			// $unanswered_count = count($unanswered_questions);
		}
		else
		{
			// no answer found
			$unanswered_questions = $total_questions;

			// $total_questions is an object returned by eloquent
			// $unanswered_count = $unanswered_questions -> count();
		}

		// print_r($unanswered_questions);

		// create new interception and get the id
		$newInterception               = new Interception();
		$newInterception -> cnic       = $cnic;
		$newInterception -> contact_no = $contactNo;
		$newInterception -> vehicle_no = $truckNo;
		$newInterception -> agent      = $user_id;
		$newInterception -> type       = $question_set_id;
		$newInterception -> trucker_id = $trucker_id;
		$newInterception -> location   = Auth::user() -> location_to_be_place; // add the location from agent's location_to_be_place

		$newInterception->save();

		$interception_id = $newInterception->id;

		$unanswered_questions_to_return = [];
		foreach($unanswered_questions as $question)
		{
			// check if cnic provided with the call
			if ($question -> id == 16 && !empty($cnic))
			{
				// echo "adding cnic $cnic to int: $interception_id\n";
				// add cnic
				$this -> interception_add_answer($cnic, 16, $interception_id);
				continue;
			}

			// check if phone no provided with the call
			if ($question -> id == 11 && !empty($contactNo))
			{
				// echo "adding phone $contactNo to int: $interception_id\n";
				// add phone no
				$this -> interception_add_answer($contactNo, 11, $interception_id);
				continue;
			}

			// check if truck no provided with the call
			if ($question -> id == 12 && !empty($truckNo))
			{
				// echo "adding truck no $truckNo to int: $interception_id\n";
				// add truck no
				$this -> interception_add_answer($truckNo, 12, $interception_id);
				continue;
			}

			if($question->field_type == "radio")
			{
				$radio_options = questions_radio_options::where('question_id', $question->id)->get();

				// reset fetched options
				$options = [];

				foreach ($radio_options as $option)
				{
					$options[] = $option -> option;
				}
				$question -> radio_options = $options;
			}
			array_push($unanswered_questions_to_return, $question);
		}

		$return["interception_id"]    = $interception_id;
		$return["total_questions"]    = $total_questions->count();
		$return["questions_answered"] = $return["total_questions"] - count ($unanswered_questions_to_return);
		$return["questions"]          = $unanswered_questions_to_return;

		return response()->json(['success' => $return], 200);
	}

	public function interception_add_answer($answer, $question_id, $interception_id)
	{
		$intanswer     = new \App\Intanswer;
		$questions_set = new question_sets;
		$question      = \App\questions::find($question_id);
		// get profile type to update the correct table with the answer value
		$question_set = $questions_set::find($question -> question_set_id);
		// process the answer and add it to the correct column
		switch ($question_set -> profile_type)
		{
			case 'trucker' :
				$this -> process_answer_trucker($question -> profile_column, $answer, $interception_id);
			break;
			case 'mechanic' :
				return $this -> process_answer_mechanic($question -> profile_column, $answer, $interception_id);
			break;
		}
		// save the answer in the answers table
		$intanswer -> question_id     = $question_id;
		$intanswer -> answer          = $answer;
		$intanswer -> interception_id = $interception_id;
		if ($intanswer -> save()) {
			return response()->json(['success' => 'Operation Successfull'], $this -> successStatus);
		}else{
			return response()->json(['error'=>'Operation Unsuccessfull'], $this -> failStatus);
		}
	}
	
	public function interception_add_answer_middleware()
	{
		if (request('answer') == '' || request('question_id') == '' || request('interception_id') == '')
			return response()->json(['error'=>'Operation Unsuccessfull'], $this -> failStatus);
		
		return $this -> interception_add_answer(request('answer'), request('question_id'), request('interception_id'));
		// $intanswer     = new \App\Intanswer;
		// $questions_set = new question_sets;
		// $question      = \App\questions::find(request('question_id'));
		// // get profile type to update the correct table with the answer value
		// $question_set = $questions_set::find($question -> question_set_id);
		// // process the answer and add it to the correct column
		// switch ($question_set -> profile_type)
		// {
		// 	case 'trucker' :
		// 		$this -> process_answer_trucker($question -> profile_column, request('answer'), request('interception_id'));
		// 	break;
		// 	case 'mechanic' :
		// 		return $this -> process_answer_mechanic($question -> profile_column, request('answer'), request('interception_id'));
		// 	break;
		// }
		// // save the answer in the answers table
		// $intanswer -> question_id     = request('question_id');
		// $intanswer -> answer          = request('answer');
		// $intanswer -> interception_id = request('interception_id');
		// if ($intanswer -> save()) {
		// 	return response()->json(['success' => 'Operation Successfull'], $this -> successStatus);
		// }else{
		// 	return response()->json(['error'=>'Operation Unsuccessfull'], $this -> failStatus);
		// }
	}
	public function process_answer_trucker($column, $answer, $interception_id)
	{
		// echo "processing answer for int: $interception_id, column: $column, answer: $answer\n";

		$Interception = Interception::find($interception_id);
		if(empty($Interception))
			return response()->json(['error'=>'Operation Unsuccessfull'], $this -> failStatus);

		$trucker_id   = $Interception -> trucker_id;

		$Trucker      = Trucker::find($trucker_id);

		if ($column == 'vehicle_no')
			$answer = strtoupper($answer);

		if ($column == 'first_name' || $column == 'last_name')
			$answer = ucwords($answer);

		// echo "adding answer to trucker id: $trucker_id\n";
		switch ($column) {
			case 'vehicle_no' :
				// create the truck if not exists
				$Truck = Truck::firstOrCreate(['vehicle_no' => $answer]);

				// update truck_id in trucker's table just to be safe
				$Truck -> trucker_id = $Trucker -> id;
				$Truck -> save();
				// Add truck to trucker's profile
				$TruckerTruck = new TruckerTruck;
				$TruckerTruck -> trucker_id = $Trucker -> id;
				$TruckerTruck -> truck_id = $Truck -> id;
				$TruckerTruck -> save();
			break;
			case 'vehicle_brand' :
				$truck_id = TruckerTruck::where('trucker_id', $Trucker -> id) -> orderByDesc('id') -> first() -> truck_id;
				$truck = Truck::find($truck_id);
				if(empty($truck))
					return response()->json(['error' => 'Truck not found'], $this -> failStatus);
				$truck->vehicle_brand = $answer;
				$truck->update();
			break;
			case 'vehicle_model' :
				$truck_id = TruckerTruck::where('trucker_id', $Trucker -> id) -> orderByDesc('id') -> first() -> truck_id;
				$truck = Truck::find($truck_id);
				if(empty($truck))
					return response()->json(['error' => 'Truck not found'], $this -> failStatus);
				$truck->vehicle_model = $answer;
				$truck->update();
			break;
			case 'current_oil' :

				// save into interceptions table for backward compatibility : switch_from
				$Interception -> switch_from = $answer;
				$Interception -> save();
				// get truck from trucker_id
				$TruckerTruck = new TruckerTruck;
				$TruckerTruck = $TruckerTruck::where('trucker_id', $Trucker -> id) -> orderByDesc('id') -> first();

				// if no truck is found
				if (empty($TruckerTruck -> truck_id))
					break;

				$Truck = Truck::where('id', $TruckerTruck -> truck_id) -> first();
				$Truck -> current_oil = $answer;
				$Truck -> save();
			break;
			default :
				// echo "updating trucker {$Trucker -> id} column: $column, answer: $answer\n";
				// save into the respective column in the trucker's table
				$Trucker -> $column = $answer;
				$Trucker -> save();
			break;
		}
	}

	public function process_answer_mechanic($column, $answer, $interception_id) {
		$mechanic_id = \App\mechanic_interceptions::where('id', $interception_id) -> orderByDesc('id') -> first() ->mechanic_id;
		$mechanic = \App\Mechanic::find($mechanic_id);
		if($column == "first_name"){
			$mechanic->name = ucwords($answer);
			$mechanic->update();
		}else if($column == "last_name"){
			$firstName = $mechanic->name;
			$mechanic->name = $firstName." ".ucwords($answer);
			$mechanic->update();
		}else{
			$mechanic->$column = $answer;
			$mechanic->update();
		}
		return response()->json(['success' => 'Operation Successfull'], $this -> successStatus);
	}

	public function feedback_add(Request $request){

		$file_url = "";

		if ($request->file('file_audio')) {
			$cover = $request->file('file_audio');
			$extension = $cover->getClientOriginalExtension();
			Storage::disk('public')->put($cover->getFilename().'.'.$extension,  File::get($cover));

			$file_url = $cover->getFilename().'.'.$extension;
		}


		$feedback_text = "";
		if(request('feedback_text')){
			$feedback_text = request('feedback_text');
		}

		$interception_id = request('interception_id');

		if(Auth::user()->role_id != 3){
			$interception_feedback = new \App\InterceptionFeedback;
		}else{
			$interception_feedback = new \App\MechanicInterceptionFeedback;
		}

		$interception_feedback->feedback_url 	= $file_url;
		$interception_feedback->feedback_text 	= $feedback_text;
		$interception_feedback->interception_id = $interception_id;

		$data = \App\Interception::find($interception_id);

		$user = \App\User::find(Auth::user()->id)->toArray();

		if ( $interception_feedback->save() ) {
			if(Auth::user()->role_id != 3){
				$this->add_activity('Feedback '.$data['cnic']. ' By '.$user['first_name']);
			}else{
				$this->add_activity('Feedback Added By '.$user['first_name']);
			}
			return response()->json(['success' => 'Operation Successfull'], $this->successStatus);
		}else{
			return response()->json(['error'=>'Operation Unsuccessfull'], 401);
		}

	}

	public function add_activity($activity, $alert=0){

		$acticvty = new \App\Activites;
		$acticvty->acticvty = $activity;
		if ($alert != 0) {
			$acticvty->if_alert = $alert;
		}

		$acticvty->status = 1;
		$acticvty->save();

    }

    public function get_questions(Request $request){
    	$data = $request->all();
		// set id = question_set
    	$query = "SELECT @a:=@a+1 sr, id, question, q_type FROM questions, (SELECT @a:= 0) AS a where user_type = ".$data['question_set'];

    	$return['success'] = 'Operation Successfull';
    	$return['rows'] = DB::select(DB::raw($query));

    	return response()->json($return , $this->successStatus);
    }

	private function add_mechanic_update_contact_no($contact_no, $type){
		if($contact_no != ""){
    		$record = \App\Mechanic::where('contact', $contact_no)->get()->toArray();

	    	if(empty($record)){
	    		$add = new \App\Mechanic;
	    		$add->contact = $contact_no;
	    		$add->type = $type;
	    		$add->save();

	    		if($add->id){
	    			\App\Mechanic::where('id', $add->id)->update(['member_id' =>'MU-'.$add->id]);
	    		}
	    	}

    	}
	}

	private function add_mechanic_update_shop_name($shop_name, $type){
		if($shop_name != ""){
    		$record = \App\Mechanic::where('shop_name', $shop_name)->get()->toArray();

	    	if(empty($record)){
	    		$add = new \App\Mechanic;
	    		$add->shop_name = $shop_name;
	    		$add->type = $type;
	    		$add->save();

	    		if($add->id){
	    			\App\Mechanic::where('id', $add->id)->update(['member_id' =>'MU-'.$add->id]);
	    		}
	    	}

    	}
	}


    public function activity_log(Request $request){
    	$data = $request->all();

    	$activity = new \App\Activity;

    	$date_time = new \DateTimeZone('Asia/Karachi');
    	$date = new \DateTime("now", $date_time  );

    	$activity->activity_type	= ($data['type'] != '') ? $data['type'] : 'Active' ;
     	$activity->activity_id		= (isset($data['record_id']) && $data['record_id'] != '') ? $data['record_id'] : '0';
    	$activity->lng				= ($data['lng'] != '') ? $data['lng'] : 'Active' ;
    	$activity->lat				= ($data['lat'] != '') ? $data['lat'] : 'Active' ;
    	$activity->user_id			= Auth::user()->id;
    	$activity->device			= 'Mobile';
    	$activity->created_at 		= $date->format('Y-m-d H:i:s');


		//echo $date->format('Y-m-d H:i:s');

    	if($activity->save()){
    		return response()->json(['success' => 'Operation Successfull'], $this->successStatus);
    	}else{
    		return response()->json(['error'=>'Operation Unsuccessfull'], 401);
    	}

    }

	public function get_interceptions(Request $request)
	{
		if(Auth::user()->role_id != 3){
			$interceptions = DB::table('interceptions')->leftJoin('truckers', 'interceptions.trucker_id', '=', 'truckers.id')
			->leftJoin('trucks', 'interceptions.trucker_id', '=', 'trucks.trucker_id')
			->select('interceptions.id',
						DB::raw("IFNULL(CONCAT(truckers.first_name, ' ',truckers.last_name), 'No Data.') AS Name"),
						DB::raw('IFNULL(trucks.vehicle_no, "No Data.") as "Truck Number"'),
						DB::raw('IFNULL(truckers.contact, "No Data.") as "Contact Number"'),
						DB::raw('IFNULL(interceptions.location, "No Data.") as "Location"'),
						DB::raw('IFNULL(interceptions.cnic, "No Data.") as "CNIC Number"'),
						DB::raw('IFNULL(interceptions.interception_status, "No Data.") as "Status"'),
						DB::raw('IFNULL(interceptions.switch_from, "No Data.") as "Current Oil"'),
						DB::raw('IFNULL(truckers.loyalty_interest, "No Data.") as "Want to become Safeer?"'),
						DB::raw('IFNULL(truckers.interested_switching, "No Data.") as "Interested In Rimula?"'),
						DB::raw('DATE_FORMAT(interceptions.created_at,"%Y-%m-%d") AS "Interception Date"'),
					)->where('agent', Auth::user()->id)->orderBy('id', 'DESC')->paginate(10);
		}else{
			$interceptions = DB::table('mechanic_interceptions')->leftJoin('mechanics', 'mechanic_interceptions.mechanic_id', '=', 'mechanics.id')
			->select('mechanic_interceptions.id',
						DB::raw("IFNULL(mechanics.name, 'No Data.') AS Name"),
						DB::raw('IFNULL(mechanics.shop_name, "No Data.") as "Shop Name"'),
						DB::raw('IFNULL(mechanics.contact, "No Data.") as "Contact Number"'),
						DB::raw('IFNULL(mechanics.city, "No Data.") as "Location"'),
						DB::raw('IFNULL(mechanics.cnic, "No Data.") as "CNIC Number"'),
						DB::raw('IFNULL(mechanics.daily_trucks_traffic, "No Data.") as "Daily Trucks Traffic"'),
						DB::raw('IFNULL(mechanics.daily_oil_changes, "No Data.") as "Daily Oil Changes"'),
						DB::raw('IFNULL(mechanics.rimula_users, "No Data.") as "How many of them use Rimula?"'),
						DB::raw('IFNULL(mechanics.loyalty_interest, "No Data.") as "Want to become Ustad?"'),
						DB::raw('IFNULL(mechanics.married, "No Data.") as "Marital Status"'),
						DB::raw('DATE_FORMAT(mechanic_interceptions.created_at,"%Y-%m-%d") AS "Interception Date"'),
					)->where('mechanic_interceptions.agent', Auth::user()->id)->orderBy('id', 'DESC')->paginate(10);
		}

		// $interceptions->getCollection()->transform(function ($value) {
		// 	$currentPageRows = [];
		// 	foreach ($value as $int){
		// 		array_push($currentPageRows, [
		// 			'interception_id' => $int->id,
		// 			'Name' => trim($int->first_name . ' ' . $int->last_name),
		// 			'Truck Number' => $int->vehicle_no,
		// 			'Contact Number' => $int->contact_no,
		// 			'Location' => $int->location,
		// 			'CNIC Number' => $int->interception_status,
		// 			'Current Oil' => $int->switch_from,
		// 			'Interested In Loyalty Program' => $int->loyalty_interest,
		// 			'Date' => $int->created_at,
		// 		]);
		// 	}
		// 	return $currentPageRows;
		// });



		// $data = [];

		// $map = $query->map(function($items){
		// 	$data['Name'] = $items -> firstName;
		// 	$data['user_lastName'] = $items -> lastName;
		// 	return $data;
		//  });

		// foreach ($interceptions as $int){
			// $interceptions['data'][$key] -> Name = trim($int['first_name'] . ' ' . $int['last_name']);
			
			

			// array_push($currentPageRows, [
			// 	'interception_id' => $int->id,
			// 	'Name' => trim($int->first_name . ' ' . $int->last_name),
			// 	'Truck Number' => $int->vehicle_no,
			// 	'Contact Number' => $int->contact_no,
			// 	'Location' => $int->location,
			// 	'CNIC Number' => $int->interception_status,
			// 	'Current Oil' => $int->switch_from,
			// 	'Interested In Loyalty Program' => $int->loyalty_interest,
			// 	'Date' => $int->created_at,
			// ]);
		//}
		// $return[]['Name'] = trim($interception['first_name'] . ' ' . $interception['first_name']);
		
		
		// $interceptions->data = $currentPageRows;

		return response()->json(['success' => $interceptions], 200);
	}

	public function get_feedbacks($interception_id)
	{
		if(Auth::user()->role_id != 3){
			$Interception = \App\Interception::find($interception_id);
		}else{
			$Interception = \App\mechanic_interceptions::find($interception_id);
		}

		if (empty($Interception)){
			return response()->json(['error'=>'No feedback'], $this -> failStatus);
		}

		if(Auth::user()->role_id != 3){
			$all_previous_interceptions = \App\Interception::where('trucker_id', $Interception -> trucker_id)->get();
		}else{
			$all_previous_interceptions = \App\mechanic_interceptions::where('mechanic_id', $Interception -> mechanic_id)->get();
		}
		// print_r($all_previous_interceptions);
		$interception_ids = [];

		// create array of all previous interception ids
		foreach ($all_previous_interceptions as $interceptions)
		{
				$interception_ids[] = $interceptions -> id;
		}

		
		if (count($interception_ids) <= 0)
		{
			return response()->json(['error'=>'No feedback'], $this -> failStatus);
		}

		if(Auth::user()->role_id != 3){
			$feedbacks = \App\InterceptionFeedback::select('id', 'feedback_url', 'feedback_text')
			->whereIn('interception_id', $interception_ids)->get();
		}else{
			$feedbacks = \App\MechanicInterceptionFeedback::select('id', 'feedback_url', 'feedback_text')
			->whereIn('interception_id', $interception_ids)->get();
		}
		$feedbacks_to_return = [];
		$url = "";
		foreach($feedbacks as $feedback){
			if (Storage::disk('public')->exists($feedback->feedback_url)) {
				$url = URL::to('storage/'.$feedback->feedback_url);
			}else{
				$url = "";
			}
			$text = $feedback->feedback_text;
			$id = $feedback->id;
			array_push($feedbacks_to_return, ['id' => $id, 'feedback_mp3' => $url, 'feedback_text' => $text,]);
		}
		return response()->json(['success' => $feedbacks_to_return], 200);
	}

	public function get_previous_answers($interception_id){
		$query = "SELECT iq.id, iq.question, ia.answer
			FROM intanswers AS ia
			INNER JOIN intquestions AS iq on iq.id = ia.question_id ";
		$query .= "WHERE ia.interception_id = ".$interception_id;
		$previous_answers = DB::select(DB::raw($query));
		return response()->json(['success' => $previous_answers]);
	}
}
