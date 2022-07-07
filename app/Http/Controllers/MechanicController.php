<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mechanic;

use Validator;

use Storage;
use DB;
use File;
use Auth;
use App\UserRole as role;

class MechanicController extends Controller
{
	public function __construct(){
		$this->middleware('custom.auth');
	}

	public function mechanic_add(){
		$page_title = "Register Tucker";

		$page_breadcrumbs = array(
			[
				'title' => 'Dashboard',
				'page' => '/dashboard'
			],
			[
				'title' => 'Mechanic Profile',
				'page' => '#'
			]
		);

		return view('pages.user-mechanic-add', compact('page_title', 'page_breadcrumbs') );
	}

	public function mechanic_list(){
		$page_title = "Mechanic List";

		$role = role::find(Auth::user()->role_id);
		if($role -> hasPermissionTo('Dashboard')){
			$page_breadcrumbs = array(
				[
					'title' => 'Dashboard',
					'page' => '/dashboard'
				],
				[
					'title' => 'Mechanic List',
					'page' => '#'
				]
			);
		}else{
			$page_breadcrumbs = array(
				[
					'title' => 'Mechanic List',
					'page' => '#'
				]
			);
		}
		return view('pages.user-mechanic-list', compact('page_title', 'page_breadcrumbs', 'role') );
	}

	public function mechanic_history(){
		$page_title = "Mechanic History";

		$page_breadcrumbs = array(
			[
				'title' => 'Dashboard',
				'page'  => '/dashboard'
			],
			[
				'title' => 'Mechanic History',
				'page'  => '#'
			]
		);

		return view('pages.user-mechanic-history-list', compact('page_title', 'page_breadcrumbs') );
	}

    public function add_mechanic(Request $request){
		$data = $request->input();

		$rules = [
			'first_name' 	=> 'required|string',
			//'truck_no'		=> 'required|unique:truckers',
			'cnic'			=> 'required|numeric|unique:mechanics',
			'shop_name'		=> 'required',
			'number'		=> 'required',
		];

		$validator = Validator::make($request->all(),$rules);

		if ($validator->fails()) {
			return redirect('mechanic-add')
				->withInput()
					->withErrors($validator)->with('danger',"Operation failed");
		}

		if($request->hasFile('profile_p')) {
			/*$image_name = $request->file('profile_p')->getClientOriginalName();              
			$image_path = $request->file('profile_p')->store('public');*/
			$cover = $request->file('profile_p');
			$extension = $cover->getClientOriginalExtension();
			Storage::disk('public')->put($cover->getFilename().'.'.$extension,  File::get($cover));
		}

		try{

			$trucker = new Mechanic;
			$trucker->name 	= $data['first_name'];
			$trucker->cnic 			= $data['cnic'];
			$trucker->shop_name 	= $data['shop_name'];
			$trucker->contact 		= $data['number'];
			$trucker->city 		= $data['birth_city'];
			$trucker->type 		= 2;
			//$trucker->member_id 	= 'MU'-$data['member_id'];

			if ($request->hasFile('profile_p')) {
				$trucker->profile_p		= $cover->getFilename().'.'.$extension;
			}

			$trucker->status		= '1';

			$trucker->save();

			return redirect('mechanic-add')->with('success',"Insert successfully");
		}catch(Exception $e){
				return redirect('mechanic-add')->with('danger',"operation failed");
		}
	}

	public function mechanic_details($mechanic_id){
		$page_title = "View Mechanic";

		$page_breadcrumbs[] = array(
			'title' => 'Dashboard',
			'page' => '/dashboard'
		);

		$page_breadcrumbs[] = array(
			'title' => 'Mechanics',
			'page' => '/mechanic-list'
		);

		$page_breadcrumbs[] = array(
			'title' => 'Mechanic Profile Detail',
			'page' => '#'
		);

		$mechanic = \App\Mechanic::findOrFail($mechanic_id);

		$data = $mechanic->getOriginal();

		$interception_query = "SELECT m.name, m.shop_name, u.first_name, u.last_name, i.created_at
								FROM mechanic_interceptions AS i
									Left JOIN mechanics As m on m.id = i.mechanic_id 
									Left JOIN users AS u on u.id = i.agent
										where m.cnic = '". $data['cnic'] ."'";

		$interception_query = DB::select(DB::raw($interception_query));


		$interception_feedback = "SELECT mechanic_interception_feedback.*, users.first_name
									FROM mechanic_interception_feedback
										LEFT JOIN mechanic_interceptions on mechanic_interceptions.id = mechanic_interception_feedback.interception_id
											LEFT JOIN mechanics on mechanic_interceptions.mechanic_id = mechanics.id
												LEFT JOIN users on users.id = mechanic_interceptions.agent
													WHERE mechanic_interception_feedback.interception_id in (SELECT mechanic_interceptions.id
														FROM mechanic_interceptions
															LEFT JOIN mechanics on mechanics.id = mechanic_interceptions.mechanic_id
																WHERE mechanics.cnic = '". $data['cnic'] ."' )";

		$interception_feedback = DB::select(DB::raw($interception_feedback));

		return view('pages.mechanic-profile-detail',
					compact('page_title', 'page_breadcrumbs', 'mechanic', 'interception_feedback', 'interception_query', 'data') );
	}
}
