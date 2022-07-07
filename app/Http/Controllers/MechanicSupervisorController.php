<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\UserRole as role;

class MechanicSupervisorController extends Controller
{
    public function __construct(){
		$this->middleware('custom.auth');
	}

	function mechanic_supervisor(){
		$page_title = "Mechanic Supervisors";

		$UserRole = \App\UserRole::findOrFail(Auth::user()->role_id);

		if($UserRole -> hasPermissionTo('Dashboard')){
			$page_breadcrumbs[] = array(
				'title' => 'Dashboard',
				'page' => '/dashboard'
			);
		}

		$page_breadcrumbs[] = array(
			'title' => 'Mechanic Supervisor',
			'page' => '#'
		);

		//config(['layout.ar.main' => 'true']);
		$role = role::find(Auth::user()->role_id);

		return view('pages.mechanic-supervisor-list', compact('page_title', 'page_breadcrumbs', 'role') );
	}
}
