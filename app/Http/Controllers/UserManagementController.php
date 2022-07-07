<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use DB;

Use Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Activity;
use App\cities;
use App\User;
use App\UserRole as role;

class UserManagementController extends Controller
{

	public function __construct(){
		//parent::__construct();
		$this->middleware('custom.auth');
	}
	
	public function user_managment_add(){
		$page_title = "Register User";

		$page_breadcrumbs = array(
			[
				'title' => 'Dashboard',
				'page' => '/dashboard'
			],
			[
				'title' => 'User Management',
				'page' => '/user-managment-list'
			],
			[
				'title' => 'Add New User',
				'page' => '/user-managment-add'
			]
		);

		$cities = cities::all();
		$mechanicSupervisor = User::where('role_id', 3)->get();
		$roles = role::all();

		return view('pages.user-managment-add', compact('page_title', 'page_breadcrumbs', 'cities', 'mechanicSupervisor', 'roles') );
	}

	public function user_managment_list(){
		$page_title = "Register Tucker";
		$page_breadcrumbs = array(
			[
				'title' => 'Dashboard',
				'page' => '/dashboard'
			],
			[
				'title' => 'User Management',
				'page' => '/user-managment-list'
			]
		);

		$users = \App\User::all();

		return view('pages.user-managment-list', compact('page_title', 'page_breadcrumbs', 'users') );
	}

	public function user_managment_permission(){
		$page_title = "Edit Permissions";

		$page_breadcrumbs = array(
			[
				'title' => 'Dashboard',
				'page' => '/dashboard'
			],
			[
				'title' => 'Edit Permissions',
				'page' => '/user-managment-permission'
			]
		);

		$user_roles = \App\UserRole::all();

		return view('pages.user-managment-permission', compact('page_title', 'page_breadcrumbs', 'user_roles') );
	}

	public function get_permissions($role){
		$permissions =	DB::table('permissions')->get();
		$role = \App\UserRole::findOrFail($role);
		$cPermissions = [
						'Dashboard', 
						'Purchase',
						'Read Interception', 
						'User', 
						'Trucker', 
						'Mechanic', 
						'Cities', 
						'Safeer', 
						'Ustad', 
						'Convert Mechanic', 
						'Convert Trucker', 
						'Supervisor', 
						'Export Data', 
						'Brand Ambassador',
		];
		$return = "";
		
		$return = '<table class="table">';
		$return .= '<thead>
						<tr>
							<td>
								<strong>
									Permissions
								</strong>
							</td>
							<td>
								<strong>
									Read
								</strong>
							</td>
							<td>
								<strong>
									Write
								</strong>
							</td>
						</tr>
					</thead>';
		$return .= '<tbody>';

		foreach($cPermissions as $permission){
			$unique = rand();

			$return .= '<tr>
							<td>';
								$return .= $permission;
				$return .= '</td>
							<td>';
					if(!in_array($permission, ["Convert Mechanic", "Convert Trucker"])){
						$return .= '<input class="form-check-input ml-2" type="checkbox" '; 
						if(in_array($permission, ["Dashboard", "Read Interception", "Export Data"])){
							$return .= 'value="'.$permission.'"';
							if($role -> hasPermissionTo($permission)){
								$return .= ' checked ';
							}
						}else{
							$return .= 'value="Read '.$permission.'"';
							if($role -> hasPermissionTo('Read '.$permission)){
								$return .= ' checked ';
							}
						}
						$return .= ' name="permission[]" id="flexCheck'.$unique.'">';
					}
				$return .= '</td>
							<td>';
					if(!in_array($permission, ["Dashboard", "Read Interception", "Export Data"])){
						$return .= '<input class="form-check-input ml-2" type="checkbox" ';
						if(in_array($permission, ["Convert Mechanic", "Convert Trucker"])){
							$return .= 'value="'.$permission.'"';
							if($role -> hasPermissionTo($permission)){
								$return .= ' checked ';
							}
						}else{
							$return .= 'value="Write '.$permission.'"';
							if($role -> hasPermissionTo('Write '.$permission)){
								$return .= ' checked ';
							}
						}
						$return .= ' name="permission[]" id="flexCheck'.$unique.'">';
					}
				$return .= '</td>
						</tr>';



			// if($role -> hasPermissionTo($permission -> name)){
			// 	$return .= '
			// 	<div class="form-check form-check-inline">
			// 		<input class="form-check-input" type="checkbox" checked value="'.$permission -> name.'" name="permission[]" id="flexCheck'.$unique.'">
			// 		<label class="form-check-label" for="flexCheck'.$unique.'">
			// 		'.$permission -> name.'
			// 		</label>
			// 	</div>';
			// }else{
			// 	$return .= '
			// 	<div class="form-check form-check-inline">
			// 		<input class="form-check-input" type="checkbox" value="'.$permission -> name.'" name="permission[]" id="flexCheck'.$unique.'">
			// 		<label class="form-check-label" for="flexCheck'.$unique.'">
			// 		'.$permission -> name.'
			// 		</label>
			// 	</div>';
			// }
		}
		$return .= '</tbody>
				</table>';
		return $return;
	}

	public function user_managment_details($id){
		$page_title = "User Details";

		//preventing error
		\App\User::findOrFail($id);
		$purchase = \App\Purchase::where('converted_by', $id)->get();

		$interception = \App\Interception::where('agent', $id)->get();

		$role = role::find(Auth::user()->role_id);

		$converted_interception = \App\Interception::where('agent', $id)->where('interception_status', 'converted') -> get();

		$purchase_history = "SELECT pro.product_name, p.quantity, p.variant, (p.quantity * p.variant) AS liters, 
								t.first_name as trucker_name, t.cnic, p.created_at  
								FROM purchases AS p 
									INNER JOIN products AS pro on pro.id = p.product_id
									INNER JOIN truckers AS t on t.id = p.user_id
										WHERE p.converted_by = ".$id;

		$purchase_history = DB::select(DB::raw($purchase_history));

		$points_query = "select sum(points_earned) as points from lp_user_earned where user_id = ".$id;

		$points = DB::select(DB::raw($points_query));

		$data = \App\User::find($id);
		$user_role = \App\UserRole::findOrFail($data -> role_id);

		if ($data->role_id == 4) {
			$lp_query = \App\lp_earned::where('user_id', $id)->get()->sum("points_earned");
		}else{
			$lp_query = '';
		}

		$page_breadcrumbs = array(
			[
				'title' => 'Dashboard',
				'page'  => '/dashboard',
			],
			[
				'title' => 'User',
				'page'  => '#'
			]
		);

		return view('pages.user-profile', 
		compact('page_title', 'page_breadcrumbs', 'purchase', 'interception', 'converted_interception', 'data', 'purchase_history', 'lp_query', 'role', 'points', 'user_role'));
	}

	public function export_excel($user_id, $from, $to){
		$from =  date($from);
		$to = date($to);
		$data = DB::table('users')->leftJoin('activity', 'activity.user_id', '=', 'users.id')
			->select(DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS Name"), 'activity.activity_type as Activity', 'activity.lng as Longitude', 'activity.lat as Latitude', 'activity.created_at as Time')
			->where("activity.user_id", $user_id)->whereBetween('activity.created_at', [$from, $to])->get();


		$fileName = 'Timelogs.csv';
	 
			 $headers = array(
				 "Content-type"        => "text/csv",
				 "Content-Disposition" => "attachment; filename=$fileName",
				 "Pragma"              => "no-cache",
				 "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
				 "Expires"             => "0"
			 );
	 
			 $columns = array('Name', 'Activity', 'Longitude', 'Latitude', 'Time');
	 
			 $callback = function() use($data, $columns) {
				 $file = fopen('php://output', 'w');
				 fputcsv($file, $columns);
	 
				 foreach ($data as $d) {
					 $row['Name'] = $d->Name;
					 $row['Activity']  = $d->Activity;
					 $row['Longitude']    = $d->Longitude;
					 $row['Latitude']    = $d->Latitude;
					 $row['Time']  = $d->Time;
	 
					 fputcsv($file, array($row['Name'], $row['Activity'], $row['Longitude'], $row['Latitude'], $row['Time']));
				 }
	 
				 fclose($file);
			 };
	 
			 return response()->stream($callback, 200, $headers);
	}

	public function cities_listing(){
		$page_title = "Cities";

		$page_breadcrumbs = array(
			[
				'title' => 'Dashboard',
				'page' => '/dashboard'
			],
			[
				'title' => 'Cities',
				'page' => '#'
			]
		);
		$role = \App\UserRole::findOrFail(Auth::user()->id);
		return view('pages.cities', compact('page_title', 'page_breadcrumbs', 'role') );
	}

	public function add_new_city(){
		$user_id = Auth::user()->id;
		$city = request('city');

		$obj = new cities();
		$obj->city = $city;
		$obj->added_by = $user_id;
		$obj->save();

		return response()->json(["success" => "inserted successfully!"]);
	}

	public function convert_to_safeer($trucker_id){
		$trucker = \App\Trucker::findOrFail($trucker_id);
		$cities = cities::all();
		$page_title = "Convert To Safeer";

		$UserRole = \App\UserRole::findOrFail(Auth::user()->role_id);

		if($UserRole -> hasPermissionTo('Dashboard')){
			$page_breadcrumbs = array(
				[
					'title' => 'Dashboard',
					'page' => '/dashboard'
				],
				[
					'title' => 'Truck Drivers',
					'page' => '/trucker-profile'
				],
				[
					'title' => 'Convert To Safeer',
					'page' => '#'
				]
			);
		}else{
			$page_breadcrumbs = array(
				[
					'title' => 'Truck Drivers',
					'page' => '/trucker-profile'
				],
				[
					'title' => 'Convert To Safeer',
					'page' => '#'
				]
			);
		}
		return view('pages.safeer-truck-driver-add', compact('page_title', 'page_breadcrumbs', 'trucker', 'cities') );
	}

	public function convert_to_Ustad($mechanic_id){
		$mechanic = \App\Mechanic::findOrFail($mechanic_id);
		$cities = cities::all();
		$mechanicSupervisor = User::where('role_id', 3)->get();
		$page_title = "Convert To Ustad";

		$UserRole = \App\UserRole::findOrFail(Auth::user()->role_id);
		if($UserRole -> hasPermissionTo('Dashboard')){
			$page_breadcrumbs = array(
				[
					'title' => 'Dashboard',
					'page' => '/dashboard'
				],
				[
					'title' => 'Mechanics',
					'page' => '/mechanic-list'
				],
				[
					'title' => 'Convert To Ustad',
					'page' => '#'
				]
			);
		}else{
			$page_breadcrumbs = array(
				[
					'title' => 'Mechanics',
					'page' => '/mechanic-list'
				],
				[
					'title' => 'Convert To Ustad',
					'page' => '#'
				]
			);
		}
		return view('pages.ustad-mechanic-add', compact('page_title', 'page_breadcrumbs', 'mechanic', 'cities', 'mechanicSupervisor') );
	}

	public function user_management_edit($user_id){
		$user = \App\User::findOrFail($user_id);
		$cities = cities::all();
		$roles = \App\UserRole::all();
		$mechanicSupervisor = User::where('role_id', 3)->get();
		$page_title = "Edit User";

		$UserRole = \App\UserRole::findOrFail(Auth::user()->role_id);

		if($UserRole -> hasPermissionTo('Write User') && $UserRole -> hasPermissionTo('Dashboard')){
			$page_breadcrumbs = array(
				[
					'title' => 'Dashboard',
					'page' => '/dashboard'
				],
				[
					'title' => 'User Management',
					'page' => '/user-management-list'
				],
				[
					'title' => 'Edit User',
					'page' => '#'
				]
			);
		}else{
			$page_breadcrumbs = array(
				[
					'title' => 'Edit User',
					'page' => '#'
				]
			);
		}
		return view('pages.user-management-edit', compact('page_title', 'page_breadcrumbs', 'user', 'cities', 'roles', 'mechanicSupervisor') );
	}

	public function safeer_list(){
		$role = role::find(Auth::user()->role_id);

		$page_title = "Safeer Truck Drivers";

		$UserRole = \App\UserRole::findOrFail(Auth::user()->role_id);
		if($UserRole -> hasPermissionTo('Dashboard')){
			$page_breadcrumbs = array(
				[
					'title' => 'Dashboard',
					'page' => '/dashboard'
				],
				[
					'title' => 'Safeer Truck Drivers',
					'page' => '#'
				]
			);
		}else{
			$page_breadcrumbs = array(
				[
					'title' => 'Safeer Truck Drivers',
					'page' => '#'
				]
			);
		}
		return view('pages.user-safeer-list', compact('page_title', 'page_breadcrumbs', 'role') );
	}

	public function brand_ambassador(){
		$role = role::find(Auth::user()->role_id);

		$page_title = "Brand Ambassadors";


		$UserRole = \App\UserRole::findOrFail(Auth::user()->role_id);
		if($UserRole -> hasPermissionTo('Dashboard')){
			$page_breadcrumbs = array(
				[
					'title' => 'Dashboard',
					'page' => '/dashboard'
				],
				[
					'title' => 'Brand Ambassadors',
					'page' => '#'
				]
			);
		}else{
			$page_breadcrumbs = array(
				[
					'title' => 'Brand Ambassadors',
					'page' => '#'
				]
			);
		}
		return view('pages.user-ba-list', compact('page_title', 'page_breadcrumbs', 'role') );
	}
}
