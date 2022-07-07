<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use App\Purchase;

use Validator;

use File;

use Storage;

use DB;

Use Auth;

class PurchaseController extends Controller
{
    public function __construct(){
    	$this->middleware('custom.auth');
    }

    public function purchase(){
        $page_title = 'Make Sale';

		$UserRole = \App\UserRole::findOrFail(Auth::user()->role_id);
		if($UserRole -> hasPermissionTo('Dashboard')){
			$page_breadcrumbs = array(
				[
					'title' => 'Dashboard',
					'page' => '/dashboard'
				],
				[
					'title' => 'Make Sale',
					'page' => '/sale'
				]
			);
		}else{
			$page_breadcrumbs = array(
				[
					'title' => 'Make Sale',
					'page' => '/sale'
				]
			);
		}

        $products = \App\Product::all();

        return view('pages.purchase-1', compact('page_title', 'page_breadcrumbs', 'products') );
    }

	public function purchase_from_interception($id){
		$page_title = 'Make Sale';

		$UserRole = \App\UserRole::findOrFail(Auth::user()->role_id);
		if($UserRole -> hasPermissionTo('Dashboard')){
			$page_breadcrumbs = array(
				[
					'title' => 'Dashboard',
					'page' => '/dashboard'
				],
				[
					'title' => 'Make Sale',
					'page' => '/sale'
				]
			);
		}else{
			$page_breadcrumbs = array(
				[
					'title' => 'Make Sale',
					'page' => '/sale'
				]
			);
		}

		$interception = \App\Interception::findOrFail($id);
        $products = \App\Product::all();

		$already = DB::table('trucks') -> leftJoin('trucker_trucks', 'trucks.id', '=', 'trucker_trucks.truck_id')
		-> leftJoin('truckers', 'truckers.id', '=', 'trucker_trucks.trucker_id') -> select('truckers.*', 'trucks.vehicle_no')
		-> where('truckers.id', $interception -> trucker_id) -> first();

		if ($already !== null) {
			$already_Interceptions = \App\Interception::where('trucker_id', $already -> id) -> orderBy('id', 'DESC') -> first();
		}else{
			abort('404');
		}
		$agent = \App\User::findOrFail($already_Interceptions -> agent);
		$role = \App\UserRole::findOrFail($agent -> role_id);

		$response = array(
				'first_name' => $already -> first_name." ".$already -> last_name,
				'id'         => $already -> id,
				'truck_no'   => $already -> vehicle_no,
				'member_id'  => $already -> id,
				'agent_name'=> $agent	->	first_name .' '. $agent -> last_name,
				'agent_role'=> $role	->	name,
		);

        return view('pages.purchase-1', compact('page_title', 'page_breadcrumbs', 'products', 'response') );
	}

    public function purchase_detail($id){
        $page_title = "Purchase Created";

		$UserRole = \App\UserRole::findOrFail(Auth::user()->role_id);
		if($UserRole -> hasPermissionTo('Dashboard')){
			$page_breadcrumbs[] = array(
				'title' => 'Dashboard',
				'page' => '/dashboard'
			);
		}

        $page_breadcrumbs[] = array(
            'title' => 'Sale',
            'page' => '/sale'
        );
        $purchase = Purchase::findOrFail($id);
		$previous_purchases = Purchase::where('vehicle_number', $purchase->vehicle_number)->get();
		$gifts = \App\gifts::where('trucker_id', $purchase -> trucker -> id) -> get();
        return view('pages.purchase-2', compact('page_title', 'page_breadcrumbs', 'purchase', 'previous_purchases', 'gifts') );
    }

	public function assign_trucker_gift(Request $request){
		$trucker = \App\Trucker::findOrFail($request -> trucker_id);
		$gift = new \App\gifts();
		$gift -> name =  $request -> name;
		$gift -> trucker_id = $trucker -> id;
		if($request->hasFile('evidence_p')) {
			$cover = $request->file('evidence_p');
			$extension = $cover->getClientOriginalExtension();
			$gift -> evidence = serialize($cover->getFilename().'.'.$extension);
		}
		$gift -> save();

		if($request->hasFile('evidence_p')) {
			$cover = $request->file('evidence_p');
			$extension = $cover->getClientOriginalExtension();
			Storage::disk('public')->put($cover->getFilename().'.'.$extension,  File::get($cover));
		}

		return redirect()->back();
	}

    public function add_purchase(Request $request){
		$data = $request->input();

		$rules = [
			//'converted_by' 				=> 'required|string',
			/*'outlet_location' 			=> 'required|string',*/
			'vehicle_name'				=> 'required',
			'vehicle_current_mileage' 	=> 'required',
			'next_oil_change' 			=> 'required',
			'variant' 			=> 'required',
			'quantity' 			=> 'required',
			'evidence_p' 			=> 'required',
		];

		$validator = Validator::make($request->all(),$rules);


		if ($validator->fails()) {

			return redirect('purchase')
			->withInput()
			->withErrors($validator);
		}

		if($request->hasFile('evidence_p')) {
			$cover = $request->file('evidence_p');
			$extension = $cover->getClientOriginalExtension();
			Storage::disk('public')->put($cover->getFilename().'.'.$extension,  File::get($cover));
		}

		try{
			$purchase = new Purchase;

			$purchase->user_id 				= $data['member_id'];
			$purchase->product_id 				= $data['checkbox_select'];

			if (isset($data['converted_by'])) {
				$purchase->converted_by 			= $data['converted_by'];
			}

			/*$purchase->outlet_location 			= $data['outlet_location'];*/

			$purchase->vehicle_number 			= $data['vehicle_name'];
			$purchase->vehicle_current_milage 	= $data['vehicle_current_mileage'];
			$purchase->next_oil_change 			= $data['next_oil_change'];
			$purchase->quantity 				= $data['quantity'];
            $purchase->variant 					= $data['variant'];
			$purchase->evidence_p 				= serialize($cover->getFilename().'.'.$extension);
			$purchase->type 					= 1;
			$purchase->status 					= '1';
			$purchase->created_by 				= Auth::user()->id;


			$purchase->save();

			$product = \App\Product::find($data['checkbox_select']);
			$trucker = \App\Trucker::find($data['member_id']);

			$string = $trucker->member_id.' Purchase Completed '.$product->product_name;

			$this->add_activity($string, 1);

			$purchar_converted_query = "select i.id as id, i.agent as agent, u.first_name as text, u.role_id from interceptions as i
                inner join users as u on u.id = i.agent
                inner join truckers as t on t.id = i.trucker_id  where t.id = '". $data['member_id'] ."' order by i.id DESC limit 0, 1";

        	$parts = DB::select(DB::raw($purchar_converted_query));

        	if (!empty($parts)) {
        		$interceptions = \App\Interception::find($parts[0]->id);
				if($interceptions -> interception_status == "pending"){

					$interceptions->interception_status = 'converted';
					$interceptions->save();
	
					\App\Purchase::where('id' , $purchase -> id)
						  ->update([ 'converted_by' => $parts[0]->agent ]);

					$lp_quantity = $data['quantity'] * $data['variant'];
					$lp_ = \App\lp_product::where(
							array(
									'product_id' => $data['checkbox_select'],
									'role_id' => $parts[0]->role_id
								))->get()->toArray();
		
					if (isset($lp_[0]['points'])) {
		
						$lp_earned = new \App\lp_earned;
						$lp_earned->user_id = $parts[0]->agent;
						$lp_earned->role_id = $parts[0]->role_id;
						$lp_earned->purchase_id = $purchase->id;
						$lp_earned->points_earned = $lp_[0]['points'] * $lp_quantity;
		
						$lp_earned->save();
		
					}
				}
				
        	}else{

        		\App\Purchase::where('id' , $purchase->id)
			          ->update([ 'converted_by' => Auth::user()->id ]);
        	}

			return redirect('purchase-details/'.$purchase->id)->with('success',"Purchase Successfully Completed");


		}catch(Exception $e){
			return redirect('purchase')->with('danger',"Operation failed");

		}

    }

	public function ajax_check_member(Request $request){
		if(!$request->ajax()){
			die;
		}

		// $already = \App\Trucker::where('cnic', $request->get('cnic'))->first();
		if (trim($request->get('cnic')) != '')
		{
			$already = DB::table('truckers') -> leftJoin('trucker_trucks', 'truckers.id', '=', 'trucker_trucks.trucker_id')
										-> leftJoin('trucks', 'trucks.id', '=', 'trucker_trucks.truck_id')
										-> select('truckers.*', 'trucks.vehicle_no')
										-> where('truckers.cnic', $request->get('cnic'))
										-> first();
		}
		else if (trim($request->get('truck_id')) != '')
		{
			$already = DB::table('truckers') -> leftJoin('trucker_trucks', 'truckers.id', '=', 'trucker_trucks.trucker_id')
										-> leftJoin('trucks', 'trucks.id', '=', 'trucker_trucks.truck_id')
										-> select('truckers.*', 'trucks.vehicle_no')
										-> where('trucks.vehicle_no', $request->get('truck_id'))
										-> first();
		}

		if ($already !== null) {
			// $already = $already->toArray();
			$already_Interceptions = \App\Interception::where('trucker_id', $already -> id) -> orderBy('id', 'DESC') -> first();
			$agent = \App\User::find($already_Interceptions->agent);
			$role = \App\UserRole::find($agent->role_id);

			$response = array(
				'status' => 'success',
				'data'   => array(
					'first_name' => $already -> first_name." ".$already -> last_name,
					'id'         => $already -> id,
					'truck_no'   => $already -> vehicle_no,
					'member_id'  => $already -> id,
					'agent_name'=> $agent -> first_name .' '. $agent -> last_name,
					'agent_role'=> $role ->	name,
				),
			);
		}else{
			$response = array(
				'status' => 'Failed'
			);
		}

		$this->ajax_response($response);
	}
	/*
	 * Function to return return array using truck id
	 */
    public function ajax_check_member_truck_id(Request $request){
        if(!$request->ajax()){
            die;
        }

        // $already = \App\Trucker::where('truck_no', $request->get('truck_id'))->first();

		$already = DB::table('trucks')->leftJoin('trucker_trucks', 'trucks.id', '=', 'trucker_trucks.truck_id')
		->leftJoin('truckers', 'truckers.id', '=', 'trucker_trucks.trucker_id')->select('truckers.*', 'trucks.vehicle_no')
		->where('trucks.vehicle_no', $request->get('truck_id'))->first();

        if ($already !== null) {
            // $already = $already->toArray();
			$already_Interceptions = \App\Interception::where('trucker_id', $already -> id) -> orderBy('id', 'DESC') -> first();
			$agent = \App\User::find($already_Interceptions->agent);
			$role = \App\UserRole::find($agent->role_id);

            $response = array(
                'status' => 'success',
                'data'   => array(
                    'first_name' => $already -> first_name." ".$already -> last_name,
                    'id'         => $already -> id,
                    'truck_no'   => $already -> vehicle_no,
                    'member_id'  => $already -> id,
					'agent_name'=> $agent	->	first_name .' '. $agent -> last_name,
					'agent_role'=> $role	->	name,
                ),
            );
        }else{
            $response = array(
                'status' => 'Failed'
            );
        }

        $this->ajax_response($response);
    }

	private function ajax_response($data){
    	echo json_encode($data);
    	exit;
    }
}
