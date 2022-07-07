<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\User;
use Hash;
use Auth;
use Redirect;
use Session;
use Validator;

//use Spatie\Permission\Models\Role;
//use Spatie\Permission\Models\Permission;

class AuthController extends Controller
{

	public function getLogin(){
		$page_title = 'Login';
		return view( 'pages.login', compact('page_title') );
	}

    public function postLogin(Request $request) {

		$rules = array (
			'username' => 'required',
			'password' => 'required'
		);

		/*$rules = array (
			'email' => 'required|unique:users|email',
			'username' => 'required|unique:users|alpha_num|min:4',
			'password' => 'required|min:6|confirmed'
		);*/

		$validator = Validator::make( $request->all() , $rules );

		if ( $validator->fails() ) {
			return Redirect::back()->withErrors( $validator, 'login' )->withInput();

		} else {

			$credentials = array(
				'user_name' => $request->get( 'username' ),
				'password' => $request->get( 'password' )
			);

			//print_r(Auth::attempt ( $credentials ));
			//exit;

			if (Auth::attempt ( $credentials )) {

				$authenticated = array(
					'name' 				=> $request->get('username'),
					'user_id'			=> Auth::user()->id,
					'is_authenticated' 	=> base64_encode('yes'),
					'role'				=> Auth::user()->role_id,
				);

				//$data = \App\User::find(Auth::user()->id)->user_role_modules->toArray();

				//$allowed = array();

				/*foreach($data as $rows){
					$pages = \App\Page::where('module_id', $rows['module_id'])->get()->toArray();
					foreach ($pages as $key => $value) {
						$allowed[] = $value['page_url'];
					}
				}*/

				//$authenticated['allowed'] = $allowed;
				if(Auth::user()->status != 1){
					Session::flash ( 'message', "Sorry! , Your account is suspended." );
					Auth::logout();
					return Redirect::back();
				}


				session ( $authenticated );

				return redirect('/');
			} else {

				Session::flash ( 'message', "Invalid Credentials , Please try again." );
				return Redirect::back();

			}
		}
    }

	public function getLogout() {
		Session::flush();
		Auth::logout();
		return redirect('/auth/login');
	}

	public function index(){
		if (Auth::user()) {
			$role = \App\UserRole::findOrFail(Auth::user()->role_id);
			if($role -> hasPermissionTo('Dashboard')){
			 	return redirect()->route('dashboard');
			}else{
				return redirect()->route('sale');
			}
			// switch (Auth::user()->role_id) {
			// 	case 1:
			// 		return redirect()->route('dashboard');
			// 		break;
				
			// 	// case 3:
			// 	// 	return redirect()->route('trucker-profile');
			// 	// 	break;

			// 	case 8:
			// 		return redirect()->route('purchase');
			// 		break;

			// 	case 9:
			// 		return redirect()->route('dashboard');
			// 		break;

			// 	default:
			// 		return redirect()->route('dashboard');
			// 		break;
			// }
        }else{
            Session::flush();
			Auth::logout();
			return redirect('/auth/login');
        }
	}

	public function create_hash(){
		/*$password = Hash::make('password');
		echo $password;
		exit;*/

		/*
		$roles = array(
			'Administrator',
			'Brand Ambassador',
			'Mechanic Supervisor',
			'Ustad Mechanic',
			'Safeer Truck Driver',
			'Truck Driver',
			'Customer Care',
			'Rimula Center',
			'Rimula Brand Manager',
		);

		foreach ($roles as $key => $value) {
			Role::create(['name' => $value]);
		}
		*/


		/*
		$permission1 = Permission::create(['name' => 'Create Client']);
		$permission2 = Permission::create(['name' => 'View Invoice']);
		$permission3 = Permission::create(['name' => 'Add Product']);

		$role = Role::findById(1);
		$role->givePermissionTo([$permission1, $permission2, $permission3]);*/

		/*$permissions = array(
			'Dashboard',
			'Purchase',
			'Purchase Details',
			'Make Purchase',
			'Interception',
			'Interception details',
			'Trucker Profile',
			'Trucker Profile Detail',
			'Trucker Profile Add',
			'Add Trucker',
			'Truck Profile',
			'User Management Add',
			'User Management List',
			'User Management Permission',
			'User Managment Details',
			'User Permission',
			'Loyalty Program User Awarded',
			'Mechanic Add',
			'Mechanic List',
			'Mechanic History List',
			'Add Mechanic',
			'Add User'
		);

		foreach ($permissions as $key => $value) {
			Permission::create(['name' => $value]);
		}*/

		/*$ambassadorpermissions = array(
			'Dashboard',
			'Purchase',
			'Purchase Details',
			'Make Purchase',
			'Interception',
			'Interception details',
			'Trucker Profile',
			'Trucker Profile Detail',
			'Trucker Profile Add',
			'Add Trucker',
			'Truck Profile',
			'User Management Add',
			'User Management List',
			'User Management Permission',
			'User Managment Details',
			'User Permission',
			'Loyalty Program User Awarded',
			'Mechanic Add',
			'Mechanic List',
			'Mechanic History List',
			'Add Mechanic',
			'Add User'
		);
	
		$ambassador = Role::findById(1);
		$ambassador->givePermissionTo($ambassadorpermissions);


		$user3permissions = array(
			'Trucker Profile',
			'Trucker Profile Detail',
			'Trucker Profile Add',
			//'Add Trucker',
			'Truck Profile',
		);

		$user3 = Role::findById(3);
		$user3->givePermissionTo($user3permissions);


		$user7permissions = array(
			'Dashboard',
			'Purchase',
			'Purchase Details',
			'Make Purchase',
			'Interception',
			'Interception details',
		);

		$user7 = Role::findById(7);
		$user7->givePermissionTo($user7permissions);


		$user8permissions = array(
			'Purchase',
			'Purchase Details',
			'Make Purchase',
			'Trucker Profile',
			'Trucker Profile Detail',
			'Trucker Profile Add',
			'Add Trucker',
			'Truck Profile',
		);

		$user8 = Role::findById(8);
		$user8->givePermissionTo($user8permissions);

		$user9permissions = array(
			'Dashboard',
			'Interception',
			'Interception details',
			'Trucker Profile',
			'Trucker Profile Detail',
			'Trucker Profile Add',
			'Add Trucker',
			'Truck Profile',
		);

		$user9 = Role::findById(9);
		$user9->givePermissionTo($user9permissions);*/

		/*$users = \App\User::where('role_id', 1)->get()->toArray();

		foreach ($users as $key => $value) {
			$u = \App\User::find($value['id']);
			$u->assignRole('Administrator');
		}

		$users = \App\User::where('role_id', 3)->get()->toArray();

		foreach ($users as $key => $value) {
			$u = \App\User::find($value['id']);
			$u->assignRole('Mechanic Supervisor');
		}

		$users = \App\User::where('role_id', 4)->get()->toArray();

		foreach ($users as $key => $value) {
			$u = \App\User::find($value['id']);
			$u->assignRole('Ustad Mechanic');
		}


		$users = \App\User::where('role_id', 9)->get()->toArray();

		foreach ($users as $key => $value) {
			$u = \App\User::find($value['id']);
			$u->assignRole('Rimula Brand Manager');
		}*/
	}
}
