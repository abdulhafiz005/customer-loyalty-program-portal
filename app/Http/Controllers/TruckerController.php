<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Trucker;

use Validator;

use Storage;

use DB;
use Auth;

use File;
use App\cities;
use App\UserRole as role;

class TruckerController extends Controller
{
	public function __construct(){
		$this->middleware('custom.auth');
	}

	public function trucker_profile(){
		$page_title = "Register Trucker";

		$role = role::find(Auth::user()->role_id);
		if($role -> hasPermissionTo('Dashboard')){
			$page_breadcrumbs[] = array(
				'title' => 'Dashboard',
				'page' => '/dashboard'
			);
		}

		$page_breadcrumbs[] = array(
			'title' => 'Trucker Profiles',
			'page' => '/trucker-profile'
		);

		config(['layout.ar.main' => 'true']);

		$cities = cities::all();

		return view('pages.trucker-profile', compact('page_title', 'page_breadcrumbs', 'cities', 'role') );
	}

	public function trucker_profile_detail($id){
		$page_title = "View Trucker";

		$UserRole = \App\UserRole::findOrFail(Auth::user()->role_id);
		if($UserRole -> hasPermissionTo('Dashboard')){
			$page_breadcrumbs[] = array(
				'title' => 'Dashboard',
				'page' => '/dashboard'
			);
		}

		$page_breadcrumbs[] = array(
			'title' => 'Trucker Profile',
			'page' => '/trucker-profile'
		);

		$page_breadcrumbs[] = array(
			'title' => 'Trucker Profile Detail',
			'page' => '#'
		);

		$trucker = Trucker::find($id);

		$data = $trucker->getOriginal();

		$interception_query = "SELECT i.name, i.vehicle_no, u.first_name, u.last_name, i.created_at
								FROM interceptions AS i
									INNER JOIN users AS u on u.id = i.agent
										where i.trucker_id = ".$id;

		$interception_query = DB::select(DB::raw($interception_query));

		$interception_questions = "SELECT iq.id, iq.question, ia.answer FROM intanswers AS ia
									INNER JOIN questions AS iq on iq.id = ia.question_id
										WHERE ia.interception_id in (SELECT interceptions.id
											FROM interceptions
												WHERE trucker_id = ".$id.")";

		$interception_questions = DB::select(DB::raw($interception_questions));


		$interception_feedback = "SELECT interception_feedback.*, users.first_name
									FROM interception_feedback
										INNER JOIN interceptions on interceptions.id = interception_feedback.interception_id
											INNER JOIN users on users.id = interceptions.agent
												WHERE interception_feedback.interception_id in (SELECT interceptions.id
													FROM interceptions
														WHERE trucker_id = ".$id." )";

		$interception_feedback = DB::select(DB::raw($interception_feedback));

		$purchase_ = "SELECT pro.product_name, p.variant, DATE_FORMAT(p.created_at, '%d %b %Y') as created_at
						FROM purchases AS p
							INNER JOIN truckers AS t on t.id = p.user_id
								INNER JOIN products AS pro on pro.id = p.product_id
										WHERE (p.type = 1 OR p.type = 6) AND t.id = ".$data['id'];

		$purchase_ = DB::select(DB::raw($purchase_));


		$total_purchases = \App\Purchase::where('user_id', $id)->get();

		$total_purchases = $total_purchases->count();

		$gifts = \App\gifts::where('trucker_id', $id) -> get();

		$total_interceptions = \App\Interception::where('id', $id)->get();
		$total_interceptions = $total_interceptions->count();

		$role = \App\UserRole::findOrFail(Auth::user() -> role_id);

		return view('pages.trucker-profile-detail',
					compact('page_title', 'page_breadcrumbs', 'data', 'interception_query', 'interception_questions', 'interception_feedback', 'purchase_', 'total_purchases', 'total_interceptions', 'trucker', 'gifts', 'role', 'id') );
	}

	public function trucker_profile_add(){
		$page_title = "Register Tucker";

		$UserRole = \App\UserRole::findOrFail(Auth::user()->role_id);
		if($UserRole -> hasPermissionTo('Dashboard')){
			$page_breadcrumbs[] = array(
				'title' => 'Dashboard',
				'page' => '/dashboard'
			);
		}

		$page_breadcrumbs[] = array(
			'title' => 'Trucker Profile',
			'page' => '/trucker-profile'
		);

		$page_breadcrumbs[] = array(
			'title' => 'Add New Trucker',
			'page' => '#'
		);

		$trucks = \App\Truck::all();

		return view('pages.trucker-profile-add', compact('page_title', 'page_breadcrumbs', 'trucks') );
	}

	public function add_trucker(Request $request){

		$data = $request->input();

		$rules = [
			'first_name' 	=> 'required|string',
			'last_name' 	=> 'required|string',
			//'truck_no'		=> 'required|unique:truckers',
			'truck_no'		=> 'required',
			'cnic'			=> 'required|numeric',
			//'birth_city' 	=> 'required',
			'driving_exp' 	=> 'required',
			'comments' 		=> 'required',
			'd_o_b'			=> 'required',
			'contact' 		=> 'required',
			//'birth_city'	=> 'required',
		];

		$messages = array(
			'd_o_b.required' 		=> 'The date of birth field is required.',
			'driving_exp.required' 	=> 'The driving experience field is required.',
			'truck_no.required' 	=> 'The truck number field is required.',
		);

		$validator = Validator::make($request->all(),$rules, $messages);

		if ($validator->fails()) {
			return redirect('trucker-profile-add')
				->withInput()
					->withErrors($validator)->with('danger',"Operation failed");
		}

		if($request->hasFile('profile_p')) {
			$cover = $request->file('profile_p');
			$extension = $cover->getClientOriginalExtension();
			Storage::disk('public')->put($cover->getFilename().'.'.$extension,  File::get($cover));
		}

		try{

			$trucker = new Trucker;
			$trucker->first_name 	= $data['first_name'];
			$trucker->last_name 	= $data['last_name'];
			$trucker->cnic 			= $data['cnic'];

			//$trucker->truck_no 		= $data['truck_no'];*

			$trucker->d_o_b 		= date('Y-m-d', strtotime($data['d_o_b']));
			$trucker->b_city 		= $data['birth_city'];
			$trucker->driving_exp 	= $data['driving_exp'];
			$trucker->comments 		= $data['comments'];
			$trucker->contact 		= $data['contact'];

			//$trucker->member_id 	= $data['member_id'];

			$trucker->status		= '1';

			if ($request->hasFile('profile_p')) {
				$trucker->profile_p		= $cover->getFilename().'.'.$extension;
			}else{
				$trucker->profile_p		= 'img_avatar.png';
			}

			$trucker->save();

			if(!isset($data['member_id']) || $data['member_id'] == ""){
				Trucker::where('id' , $trucker->id)
				->update([ 'member_id' => 'MU-'.$trucker->id ]);
			}

			if (isset($data['truck_no'])) {
				$insert_truck 		= $this->insert_trucker_truck( $data['truck_no'], $trucker->id );

				Trucker::where('id' , $trucker->id)
				->update([ 'truck_no' => $insert_truck ]);
				$truck = \App\Truck::findOrFail($insert_truck);
				$truck -> trucker_id = $trucker -> id;
				$truck -> update();
			}

			return redirect('trucker-profile-detail/'.$trucker->id)->with('success',"Insert successfully");

		}catch(Exception $e){
			return redirect('trucker-profile-add')->with('danger',"operation failed");

		}

	}

}
