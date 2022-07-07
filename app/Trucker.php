<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trucker extends Model
{
	protected $filable = [
		'first_name', 'last_name', 'cnic', 'truck_no', 'truck_id', 'member_id', 'd_o_b', 'b_city', 'driving_exp', 'profile_p', 'comments', 'status', 'contact', 'loyalty_interest', 'interested_switching'
	];


	/*public function get_interception(){
		return $this->hasOne(Interception::class, 'truck_no', 'vehicle_no');
	}*/

	public function get_truck(){
		return $this->hasOne(Truck::class);
	}
}
