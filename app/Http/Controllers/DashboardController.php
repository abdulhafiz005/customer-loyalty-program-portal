<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use \App\Product;

Use DB;

Use Auth;
Use App\cities;

class DashboardController extends Controller
{

	public function __construct(){
		//parent::__construct();
		$this->middleware('custom.auth');
	}

	public function dashboard(){
		$page_title = 'Dashboard';

		$page_breadcrumbs[] = array(
			'title' => 'Dashboard',
			'page' => '/dashboard'
		);

		config(['layout.ar.main' => 'true']);

		$activities = \App\Activites::orderBy('id', 'desc')->take(6)->get();
		$alerts     = \App\Activites::where('if_alert', 1)->orderBy('id', 'desc')->take(6)->get();

		$total_interceptions_karachi 	= \App\Interception::where('location', 'Karachi')->get()->count();
		$total_interceptions_lahore 	= \App\Interception::where('location', 'Lahore')->get()->count();
		$total_interceptions_islamabad 	= \App\Interception::where('location', 'Islamabad')->get()->count();

		$cities = cities::all();

		if(Auth::user()->role_id == 8 || Auth::user()->role_id == 3){
			return view('pages.dashboard_redirect', 
				compact('page_title', 'page_breadcrumbs', 'activities', 'alerts') );

		}else{
			return view('pages.dashboard', compact('page_title', 'page_breadcrumbs', 'activities', 'alerts', 'total_interceptions_islamabad', 'total_interceptions_karachi', 'total_interceptions_lahore', 'cities') );
			
		}

	}
}
