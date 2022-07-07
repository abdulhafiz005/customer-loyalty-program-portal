<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use Auth;

use Datatables;

use DB;
use URL;
use App\cities;
use App\UserRole as role;

class DatatableController extends Controller
{

	public function __construct(){
		$this->middleware('custom.auth');
	}

	public function ajax_datatable_user_list(Request $request){

		$data = $request->all();

		$where = "";
		$l = 0;

		if (isset($data['date_filter'])) {
			$where = " where DATE(users.created_at) > '".date("Y-m-d",strtotime($data['date_filter']))."'";
		}

		if (isset($data['role_id'])) {

			if ($where == "") {
				$where .= " WHERE ";
			}else{
				$where .= " AND ";
			}

			$where .= " users.role_id = ".$data['role_id'];
		}

		$statistics_sql = 'SELECT users.id,
									users.user_name,
									users.first_name,
									users.last_name,
									users.cnic,
									users.d_o_b,
									roles.name as role,
									-- users.password_text,
									users.location_to_be_place,
									count(purchases.id) as `purchases`,
									SUM(purchases.quantity * purchases.variant) as liters,
									users.status,
									DATE_FORMAT(users.created_at, "%d-%m-%Y") as `date`
							FROM `users`
							LEFT JOIN roles on roles.id = users.role_id
							left Join purchases on purchases.converted_by = users.id
							'. $where ." Group By users.id ORDER BY users.id DESC";


		$parts = DB::select(DB::raw($statistics_sql));

		/*return Datatables::of($feedbacks)->toJson();
		// FOR YAJRA DATATABLES VERSION < 7.0
		return Datatables::of($feedbacks)->make(true);*/

		// Datatables::of($parts)->make();
		//return Datatables::of($parts)->make(true);

		return Datatables::of($parts)->addColumn('action', function ($query) {
			return '<a href="'. route("user-management-edit.id", $query->id) .'" class="btn btn-sm btn-danger user_action btn-light btn-clean btn-icon">
						<i class="fas fa-edit" title="Edit"></i>
					</a>';
			})
		->make(true);
	}

	//

	public function ajax_datatable_mechanic_interception_list(){

		$data = $request->all();

		if ($data['type'] != "") {
			$where = " WHERE users.role_id = ". $data['type'];
		}

        if ($data['startDate'] !== 0 && $data['endDate'] !== 0)
        {
        	$where .= " AND DATE(interceptions.created_at) BETWEEN '". $data['startDate'] ."' AND '". $data['endDate'] ."' ";
        }

		if ($data['city'] != "All Cities") {
			$where .= " AND interceptions.location = '". $data['city'] ."' AND ";
		}

		$query = "SELECT interceptions.id,
						interceptions.name,
						interceptions.vehicle_no,
						interceptions.contact_no,
						interceptions.location,
						users.first_name,
						interceptions.interception_status
					FROM interceptions
					INNER JOIN users on users.id = interceptions.agent
					$where ORDER BY interceptions.id DESC";

		$parts = DB::select(DB::raw($query));

		return Datatables::of($parts)
			->addColumn('action', function ($query) {

				$return = '<div class="d-flex">';

					$return .= '<a href="' . route("interception-details.id", $query->id) . '" class="btn btn-sm btn-danger btn-light btn-clean btn-icon">
									<i class="icon-ll far fa-eye"> </i>
								</a>';

				$return .= '</div>';

				return $return;
			})
			->make(true);

	}

	public function ajax_datatable_role_list(Request $request){

		$data = $request->all();
		//dd($data);
		$where = "";
		$l = 0;

		if (isset($data['date_filter']) && $data['date_filter'] != '') {
			$where = " where DATE(users.created_at) > '".date("Y-m-d",strtotime($data['date_filter']))."'";
		}

		if (isset($data['role_id'])) {

			if ($where == "") {
				$where .= " WHERE ";
			}else{
				$where .= " AND ";
			}

			$where .= " users.role_id = ".$data['role_id'];
		}

		$statistics_sql = 'SELECT users.id,
								  assign_to.id as assign_to_Id,
                                  users.user_name,
                                  users.first_name,
                                  users.last_name,
								  users.loyalty_card_number,
								  assign_to.first_name as assign_to_first_name,
								  assign_to.last_name as assign_to_last_name,
                                  users.phone,
                                  users.cnic,
                                  users.d_o_b,
                                  roles.name,
                                  users.password_text,
                                  users.location_to_be_place,
								  DATE_FORMAT(users.created_at, "%d-%m-%Y") date,
									count(purchases.id) as `purchases`,
									Sum(purchases.quantity * purchases.variant) as liters,
									Sum(lp.points_earned) as points
							FROM `users`
							Left JOIN users as assign_to on users.assign_to = assign_to.id
							Left JOIN roles on roles.id = users.role_id
							Left Join purchases on purchases.converted_by = users.id
							left JOIN lp_user_earned lp on  users.id = lp.user_id and purchases.id = lp.purchase_id
							'.$where ."  Group By users.id ORDER BY users.id DESC";


		$parts = DB::select(DB::raw($statistics_sql));

		/*return Datatables::of($feedbacks)->toJson();
		// FOR YAJRA DATATABLES VERSION < 7.0
		return Datatables::of($feedbacks)->make(true);*/

		// Datatables::of($parts)->make();
		//return Datatables::of($parts)->make(true);

		return Datatables::of($parts)->addColumn('action', function ($query) {
			return '<a href="'. route("user-management-edit.id", $query->id) .'" class="btn btn-sm btn-danger user_action btn-light btn-clean btn-icon">
						<i class="fas fa-edit" title="Edit"></i>
					</a>';
			})
		->make(true);
	}

	public function ajax_datatable_interception_list(Request $request){
		//ajax-interception-list
		$data = $request->all();

		if ($data['type'] != "") {
			$where = " WHERE users.role_id = ". $data['type'];
		}
		else
		{
			$where = " WHERE users.role_id = 2";
		}

        if ($data['startDate'] !== 0 && $data['endDate'] !== 0)
        {
        	$where .= " AND DATE(interceptions.created_at) BETWEEN '". $data['startDate'] ."' AND '". $data['endDate'] ."' ";
        }

		if ($data['city'] != "All Cities") {
			$where .= " AND interceptions.location = '". $data['city'] ."' ";
		}

		$query = "SELECT interceptions.id,
						truckers.first_name trucker_first_name,
						truckers.last_name trucker_last_name,
						interceptions.agent,
						interceptions.trucker_id,
						interceptions.vehicle_no,
						interceptions.contact_no,
						interceptions.cnic,
						interceptions.location,
						DATE_FORMAT(interceptions.created_at, '%d-%m-%Y') date,
						users.first_name agent_first_name,
						users.last_name agent_last_name,
						interceptions.interception_status
					FROM interceptions
					INNER JOIN users on users.id       = interceptions.agent
					INNER JOIN truckers on truckers.id = interceptions.trucker_id
					$where ORDER BY interceptions.id DESC";

		$parts = DB::select(DB::raw($query));

		return Datatables::of($parts)
			-> addColumn('action', function ($query) {

				$return = '<div class="d-flex">';

					$return .= '<a href="' . route("interception-details.id", $query->id) . '" class="btn btn-sm btn-danger btn-light btn-clean btn-icon">
									<i class="icon-ll far fa-eye"> </i>
								</a>';

				$return .= '</div>';

				return $return;
			}) -> make(true);
	}

	public function ajax_datatable_trucker_list(Request $request){
		$data    = $request->all();
		$filters = [];
		$where   = '';

        if (isset($data['startDate']) && isset($data['endDate']) && $data['startDate'] !== 0 && $data['endDate'] !== 0)
        {
        	$filters[] = "DATE(trucker.created_at) BETWEEN '$data[startDate]' AND '$data[endDate]'";
        }

		if (isset($data['city']) && $data['city'] != "All Cities") {
			$filters[] = "trucker.b_city = '$data[city]'";
		}

		if (count($filters) > 0)
		{
			$where = " WHERE " . implode(' AND ', $filters);
		}

		$query = "SELECT trucker.id as id,
						trucker.first_name,
						trucker.last_name,
						trucker.cnic,
						trucker.contact,
						truck.vehicle_no,
						trucker.member_id,
						trucker.d_o_b,
						DATE_FORMAT(trucker.created_at, '%d-%m-%Y') date_added,
						trucker.b_city,
						trucker.driving_exp,
						(SELECT count(*) FROM `purchases` WHERE `purchases`.`user_id` = `trucker`.`id`) AS count
						FROM truckers trucker
						LEFT JOIN trucks AS truck on truck.trucker_id = trucker.id $where ORDER BY id DESC";

		$parts = DB::select(DB::raw($query));

		$role = role::find(Auth::user()->role_id);

		if($role -> hasPermissionTo('Convert Trucker') && $role -> hasPermissionTo('Write Purchase')){
			return Datatables::of($parts)
				->addColumn('action', function ($query) {
					return '<div style="display:flex;"><a href="javascript:;" onclick="getPurchaseForm('.$query->id.')" id="addition_DT" class="btn btn-sm btn-danger btn-light btn-clean btn-icon"><i id="add_p" class="fas fa-oil-can" title="Add Purchase"></i></a>&nbsp;&nbsp;<a href="'.URL::to("convert-to-safeer/".$query->id).'" id="addition_DT" class="btn btn-sm btn-danger btn-light btn-clean btn-icon"><i class="fas fa-user-nurse" title="Convert To Safeer"></i></a></div>';
			})
			->make(true);
		}else{
			return Datatables::of($parts)
				->addColumn('action', function ($query) {
					return '<div style="display:flex;"><a href="javascript:;" onclick="getPurchaseForm('.$query->id.')" id="addition_DT" class="btn btn-sm btn-danger btn-light btn-clean btn-icon"><i id="add_p" class="fas fa-oil-can" title="Add Purchase"></i></div>';
			})
			->make(true);
		}
    }

	public function ajax_datatable_mechanic_list(Request $request){

		$data = $request->all();
		$where = "";
		if(!empty($data['startDate'])){
			if ($data['startDate'] !== 0 && $data['endDate'] !== 0)
			{
				$where .= " WHERE DATE(m.created_at) BETWEEN '". $data['startDate'] ."' AND '". $data['endDate'] ."' ";
			}
	
			if ($data['city'] != "All Cities") {
				$where .= " AND m.city = '". $data['city'] ."' ";
			}
		}

		$l = 0;

		$statistics_sql = "SELECT m.id, m.name, m.shop_name, CONCAT(u.first_name, ' ',u.last_name) as agent_name, u.id as agent_id, m.contact, m.cnic, m.city, m.daily_trucks_traffic, m.daily_oil_changes, m.rimula_users, m.married, m.loyalty_interest, DATE_FORMAT(m.created_at, '%d-%m-%Y') `date`
							FROM `mechanics` as m
							Inner Join mechanic_interceptions as i on m.id = i.mechanic_id
							Inner Join users as u on i.agent = u.id
							$where ORDER BY id DESC";

		$parts = DB::select(DB::raw($statistics_sql));

		return Datatables::of($parts)->addColumn('action', function ($query) {
			return '<a href="'.URL::to('convert-to-ustad/'.$query->id).'" class="btn btn-sm btn-danger user_action btn-light btn-clean btn-icon"><i class="fas fa-user-nurse" title="Convert To Ustad"></i></a>';
		})
		->make(true);
	}

	public function ajax_datatable_mechanic_interceptions(Request $request){

		$data = $request->all();
		$where = "";
		if(!empty($data['startDate'])){
			if ($data['startDate'] !== 0 && $data['endDate'] !== 0)
			{
				$where .= " WHERE DATE(m.created_at) BETWEEN '". $data['startDate'] ."' AND '". $data['endDate'] ."' ";
			}
	
			if ($data['city'] != "All Cities") {
				$where .= " AND m.city = '". $data['city'] ."' ";
			}
		}

		$l = 0;

		$statistics_sql = "SELECT mi.id as mechanic_interception_id, m.id, m.name, m.shop_name, CONCAT(u.first_name, ' ',u.last_name) as agent_name, u.id as agent_id, m.contact, m.cnic, m.city, m.daily_trucks_traffic, m.daily_oil_changes, m.rimula_users, m.married, m.loyalty_interest, DATE_FORMAT(m.created_at, '%d-%m-%Y') `date`
							FROM `mechanic_interceptions` as mi
							INNER JOIN mechanics as m on mi.mechanic_id = m.id
							Inner Join mechanic_interceptions as i on m.id = i.mechanic_id
							Inner Join users as u on i.agent = u.id
							$where ORDER BY id DESC";

		$parts = DB::select(DB::raw($statistics_sql));

		return Datatables::of($parts)->addColumn('action', function ($query) {
			return '<a href="'.URL::to('mechanic-interception-details/'.$query->mechanic_interception_id).'" class="btn btn-sm btn-danger user_action btn-light btn-clean btn-icon"><i class="icon-ll far fa-eye" title="View Details"></i></a>';
		})
		->make(true);
	}

	public function ajax_datatable_cities_list(Request $request){

		$statistics_sql = "SELECT users.id, cities.id as city_id, cities.city, users.first_name, users.last_name, DATE_FORMAT(cities.created_at, '%d-%m-%Y') `date`
							FROM `cities` 
							Left Join users on cities.added_by = users.id 
							ORDER BY cities.id DESC";

		$parts = DB::select(DB::raw($statistics_sql));

		return Datatables::of($parts)->addColumn('action', function ($query) {
			return '<a href="'.URL::to('delete-ajax-city/'.$query->city_id).'" data-id = "'. $query->city_id .'" class="btn btn-sm btn-danger user_action btn-light btn-clean btn-icon"><i class="glyphicon glyphicon-delete" title="delete"></i> <i class="icon-ll far fa-trash-alt"> </a>';
		})
		->make(true);
	}

	public function ajax_datatable_history_mechanic(){

		$statistics_sql = 'SELECT * FROM `mechanic_history` ORDER BY id ASC';

		$parts = DB::select(DB::raw($statistics_sql));

		return Datatables::of($parts)->make(true);

	}

	public function delete_ajax_city($id){
		cities::findOrFail($id)->delete();
		return redirect()->back();
	}
}
