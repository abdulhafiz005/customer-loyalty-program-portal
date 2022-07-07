<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cities;

class TruckController extends Controller
{
	public function __construct(){
		$this->middleware('custom.auth');
	}
	
	public function truck_profile(){
		$page_title = "Register Tucker";

		$page_breadcrumbs[] = array(
			'title' => 'Dashboard',
			'page' => '/dashboard'
		);

		$page_breadcrumbs[] = array(
			'title' => 'Truck Profile',
			'page' => '#'
		);

		$cities = cities::all();

		return view('pages.truck-profile', compact('page_title', 'page_breadcrumbs', 'cities') );
	}
}
