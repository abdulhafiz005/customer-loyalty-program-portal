<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use Validator;

use Illuminate\Support\Str;

use App\User;

use App\ModuleAcl;
use DB;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
	public function __construct(){
		$this->middleware('custom.auth');
	}

	public function add_user(Request $request){

		$data = $request->input();

		$rules = [
			'first_name' 		=> 'required|string',
			'last_name' 		=> 'required|string',
			'phone'				=> 'required|numeric|unique:users',
			'cnic'				=> 'required|numeric|unique:users',
			'd_o_b'				=> 'required',
			'birth_city' 		=> 'required',
			'loyalty_program'	=> 'required',
			'password_text'		=> 'required|string|min:8|alpha_dash',
		];

		if($data['loyalty_program'] == 4){
			$rules['assignTo'] = 'required';
		}

		$messages = array(
			'd_o_b.required' 		=> 'The date of birth field is required.',
		);

		$validator = Validator::make($request->all(), $rules, $messages);

		if ($validator->fails()) {
			return redirect()->back()
			->withInput()
			->withErrors($validator)->with('danger',"Operation failed");
		}

		try{

			//$password = Str::random(8);

			$already = User::where('first_name', $data['first_name'])->get()->count();

			if ($already > 0) {
				$already++;
				$new_username = $data['first_name'].$already;
			}else{
				$new_username = $data['first_name'].'1';
			}

			$user = new User;
			$user->first_name 			= $data['first_name'];
			$user->last_name 			= $data['last_name'];
			$user->user_name			= $new_username;
			$user->phone               = $data['phone'];
			$user->cnic 				= $data['cnic'];
			$user->d_o_b 				= date('Y-m-d', strtotime($data['d_o_b']));
			$user->b_city 				= $data['birth_city'];
			$user->role_id 				= $data['loyalty_program'];
			$user->location_to_be_place = $data['location_to_place'];
			$user->password_text 		= $data['password_text'];
			$user->password 			= Hash::make($data['password_text']);
			$user->status				= 1;
			if($data['loyalty_program'] == 4){
				$user->assign_to = $data['assignTo'];
			}
			$user->save();

			if($data['loyalty_program'] == 5){
				$user->loyalty_card_number = "STD".substr("0000000000", 0, - strlen((string)$user->id)).$user->id;
				$user->update();				
			}

			if($data['loyalty_program'] == 4){
				$user->loyalty_card_number = "UM".substr("0000000000", 0, - strlen((string)$user->id)).$user->id;
				$user->update();
			}

			$user_role = \App\UserRole::find($data['loyalty_program']);

			$user_hasrole = \App\User::find($user->id);

			$user_hasrole->assignRole($user_role->name);

			return redirect()->back()->with('success',"Operation successfull Username: ". $new_username ." Password : ".$data['password_text']);
		}catch(Exception $e){
			return redirect()->back()->with('danger',"Operation failed");
		}

	}


	public function update_permissions(Request $request){
		$role = \App\UserRole::findOrFail($request -> role);
		$pervious_permissions = DB::table('model_has_permissions')
			->where('model_id', $role -> id)
				->where('model_type', 'App\UserRole')->delete();

		foreach($request -> permission as $p){
			$role -> givePermissionTo($p);
		}

		return redirect() -> back() -> with('success',"Permissions assigned successfully.");

	}

	public function update_user(Request $request){
		// $rules = [
		// 	'user_id'			=> 'required|string',
		// 	'first_name' 		=> 'required|string',
		// 	'last_name' 		=> 'required|string',
		// 	'user_name'			=> 'required',
		// 	'phone'				=> 'required|numeric',
		// 	'cnic'				=> 'required|numeric',
		// 	'd_o_b'				=> 'required',
		// 	'birth_city' 		=> 'required',
		// 	'loyalty_program'	=> 'required',
		// 	'password_text'		=> 'required|string|min:8|alpha_dash',
		// 	'location_to_place'	=> 'required',
		// ];

		// if($request -> loyalty_program == 4){
		// 	$rules['assignTo'] = 'required';
		// }

		// $messages = array(
		// 	'd_o_b.required' 		=> 'The date of birth field is required.',
		// );

		// $validator = Validator::make($request->all(), $rules, $messages);

		// if ($validator->fails()) {
		// 	return redirect()->back()
		// 	->withInput()
		// 	->withErrors($validator)->with('danger',"Operation failed");
		// }

		$user = \App\User::findOrFail($request->user_id);
		if(!empty($request -> first_name)){
			$user -> first_name = $request -> first_name;
		}
		if(!empty($request -> last_name)){
			$user -> last_name = $request -> last_name;
		}
		if(!empty($request -> user_name)){
			$user -> user_name = $request -> user_name;
		}
		if(!empty($request -> phone)){
			$user -> phone = $request -> phone;
		}
		if(!empty($request -> cnic)){
			$user -> cnic = $request -> cnic;
		}
		if(!empty($request -> d_o_b)){
			$user -> d_o_b = date('Y-m-d', strtotime($request -> d_o_b));
		}
		if(!empty($request -> birth_city)){
			$user -> b_city = $request -> birth_city;
		}
		if(!empty($request -> loyalty_program)){
			$user -> role_id = $request -> loyalty_program;
		}
		if(!empty($request -> location_to_place)){
			$user -> location_to_be_place = $request -> location_to_place;
		}
		if(!empty($request -> password_text)){
			$user -> password_text = $request -> password_text;
			$user -> password = Hash::make($request -> password_text);
		}
		if(!empty($request -> status)){
			$user -> status = $request -> status;
		}
		if($request -> loyalty_program == 4){
			$user -> assign_to = $request -> assignTo;
		}
		$user -> update();
	
		
		DB::table('model_has_roles') -> where('model_id', $request->user_id) -> delete();
	

		$role = \App\UserRole::find($request -> loyalty_program);
		$user -> assignRole($role -> name);

		return redirect() -> back() -> with('success',"Operation successfull Username: ". $request -> user_name ." Password : ".$request -> password_text);
	}

	public function delete_user($id, $role_id){
		return redirect() -> back() -> with('danger', 'You can not perform this action because this user has some connected data to it.');
		$user = \App\User::findOrFail($id);
		$user -> delete();
		if($role_id == 3){
			return redirect('mechanic-supervisor') -> with('success',"Operation successfull");
		}elseif($role_id == 4){
			return redirect('ustad-mechanic') -> with('success',"Operation successfull");
		}elseif($role_id == 5){
			return redirect('safeer-list') -> with('success',"Operation successfull");
		}elseif($role_id == 2){
			return redirect('brand-ambassador') -> with('success',"Operation successfull");
		}else{
			return redirect('user-management-list') -> with('success',"Operation successfull");
		}
	}
}
