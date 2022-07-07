<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;
use App\UserRole as role;
use Auth;

class UstadMechanicController extends Controller
{
	public function __construct(){
		$this->middleware('custom.auth');
	}

	function ustad_mechanic(){
		$page_title = "View Ustad Mechanics";

		$role = role::find(Auth::user()->role_id);

		if($role -> hasPermissionTo('Dashboard')){
			$page_breadcrumbs[] = array(
				'title' => 'Dashboard',
				'page' => '/dashboard'
			);
		}

		$page_breadcrumbs[] = array(
			'title' => 'Ustad Mechanic',
			'page' => '#'
		);

		//config(['layout.ar.main' => 'true']);

		return view('pages.ustad-mechanic-list', compact('page_title', 'page_breadcrumbs', 'role') );
	}
}

