<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use \App\Product;

class Purchase extends Model
{
    protected $filable = [
		'trucker_id', 'product_id', 'converted_by', 'outlet_location', 'vehicle_number', 'vehicle_current_milage', 'next_oil_change', 'evidence_p', 'status'
	];


	public function product(){
		return $this->belongsTo(Product::class);
	}


	public function trucker(){
		return $this->belongsTo(Trucker::class, 'user_id');
	}
}
