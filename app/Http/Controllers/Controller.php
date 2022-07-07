<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function add_activity($activity, $alert=0){
		$acticvty = new \App\Activites;
		$acticvty->acticvty = $activity;
		if ($alert !== 0) {
			$acticvty->if_alert = 1;
		}
		
		$acticvty->status = 1;
		$acticvty->save();

    }

	public function thousandsCurrencyFormat($num) {

		if($num>1000) {

			$x = round($num);
			$x_number_format = number_format($x);
			$x_array = explode(',', $x_number_format);
			$x_parts = array('k', 'm', 'b', 't');
			$x_count_parts = count($x_array) - 1;
			$x_display = $x;
			$x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
			$x_display .= $x_parts[$x_count_parts - 1];

			return $x_display;

		}

		return $num;
	}


	public function insert_trucker_truck($truck_name, $trucker_id=0, $trucker_cnic=0){


		if ($trucker_cnic != 0) {
			$getTruckerId = \App\Trucker::where('cnic', $trucker_cnic)->get()->toArray();
			if (!empty($getTruckerId)) {
				$trucker_id = $getTruckerId[0]['id'];
			}
		}
		
		$get_truck = \App\Truck::where('truck_name', $truck_name)->get()->toArray();

		//print_r($get_truck); exit;

		if (!empty($get_truck)) {
			$truck = \App\TruckerTruck::where('truck_id', $get_truck[0]['id'])->where('trucker_id', $trucker_id)->get()->toArray();

			if (!empty($truck)) {
				return $get_truck[0]['id'];
			}else{
				$trucker_ = new \App\TruckerTruck();
				$trucker_->trucker_id = $trucker_id;
				$trucker_->truck_id = $get_truck[0]['id'];
				$trucker_->save();

				return $get_truck[0]['id'];
			}

		}else{
			//Add Truck and then add TruckerTruck

			$add_truck = new \App\Truck();
			$add_truck->truck_name = $truck_name;
			$add_truck->vehicle_no = $truck_name;
			$add_truck->save();

			$trucker_ = new \App\TruckerTruck();
			$trucker_->trucker_id = $trucker_id;
			$trucker_->truck_id = $add_truck->id;
			$trucker_->save();

			return $add_truck->id;
		}

		
	}
}
