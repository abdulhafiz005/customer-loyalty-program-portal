<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use App\Interception;

Use DB;

Use Auth;
Use App\cities;
Use App\UserRole as role;

class InterceptionController extends Controller
{

	public function __construct(){
		//parent::__construct();
		$this->middleware('custom.auth');
	}


	public function interception(){
		$page_title = "Interception";

		config([
			'menu_header.items' => [
				'items' => [
					'title'     => 'Home',
					'root'      => true,
					'page'      => '/dashboard',
					'new-tab'   => false
				]
			]
		]);

		config(['layout.ar.main' => 'true']);

		$page_breadcrumbs[] = array(
			'title' => 'Dashboard',
			'page' => '/dashboard'
		);

		$page_breadcrumbs[] = array(
			'title' => 'Interceptions',
			'page' => '/interception'
		);

		return view('pages.interception', 
				compact('page_title', 'page_breadcrumbs') );
	}


	public function interception_details($id){
		$page_title = "Trucker Interception";

		$UserRole = \App\UserRole::findOrFail(Auth::user()->role_id);
		if($UserRole -> hasPermissionTo('Dashboard')){
			$page_breadcrumbs[] = array(
				'title' => 'Dashboard',
				'page' => '/dashboard'
			);
		}

		$page_breadcrumbs[] = array(
			'title' => 'Interceptions',
			'page' => '/truckers-interceptions'
		);

		$page_breadcrumbs[] = array(
			'title' => 'Interceptions Detail',
			'page' => '#'
		);

		$data     = Interception::findOrFail($id);
		$original = $data->getOriginal();

		$query = "SELECT iq.id, iq.question, ia.answer FROM intanswers AS ia
					INNER JOIN questions AS iq on iq.id = ia.question_id
					WHERE ia.interception_id = $id";

		$parts = DB::select(DB::raw($query));

		$query = "SELECT interception_feedback.*, users.first_name
			FROM interception_feedback
				INNER JOIN interceptions on interceptions.id = interception_feedback.interception_id
					INNER JOIN users on users.id = interceptions.agent
						WHERE interception_feedback.interception_id = $id";

		$feedback          = DB::select(DB::raw($query));
		$send['p_details'] = $original;
		$send['parts']     = $parts;
		$send['feedback']  = $feedback;

		return view('pages.interception-details',
				compact('page_title', 'page_breadcrumbs', 'parts', 'feedback', 'data') );
	}

	public function mechanic_interception_details($id){
		$page_title = "Mechanic Interception";

		$UserRole = \App\UserRole::findOrFail(Auth::user()->role_id);
		if($UserRole -> hasPermissionTo('Dashboard')){
			$page_breadcrumbs[] = array(
				'title' => 'Dashboard',
				'page' => '/dashboard'
			);
		}

		$page_breadcrumbs[] = array(
			'title' => 'Interceptions',
			'page' => '/mechanics-interceptions'
		);

		$page_breadcrumbs[] = array(
			'title' => 'Interceptions Detail',
			'page' => '#'
		);

		$data     = \App\mechanic_interceptions::findOrFail($id);
		$original = $data->getOriginal();

		$query = " SELECT i.id as interception_id, m.* FROM mechanic_interceptions AS i
					INNER JOIN mechanics AS m on i.mechanic_id = m.id
					WHERE i.id = $id";

		$parts = DB::select(DB::raw($query));

		$query = "SELECT mechanic_interception_feedback.*, users.first_name
					FROM mechanic_interception_feedback
						INNER JOIN mechanic_interceptions on mechanic_interceptions.id = mechanic_interception_feedback.interception_id
							INNER JOIN users on users.id = mechanic_interceptions.agent
								WHERE mechanic_interception_feedback.interception_id = $id";

		$feedback          = DB::select(DB::raw($query));
		$send['p_details'] = $original;
		$send['parts']     = $parts;
		$send['feedback']  = $feedback;

		return view('pages.mechanic-interception-details',
				compact('page_title', 'page_breadcrumbs', 'parts', 'feedback', 'data') );
	}

	public function truckers_interceptions(){
		$page_title = "Trucker Interceptions";

		config([
			'menu_header.items' => [
				'items' => [
					'title'     => 'Home',
					'root'      => true,
					'page'      => '/dashboard',
					'new-tab'   => false
				]
			]
		]);

		config(['layout.ar.main' => 'true']);

		$UserRole = \App\UserRole::findOrFail(Auth::user()->role_id);
		if($UserRole -> hasPermissionTo('Dashboard')){
			$page_breadcrumbs[] = array(
				'title' => 'Dashboard',
				'page' => '/dashboard'
			);
		}

		$page_breadcrumbs[] = array(
			'title' => 'Trucker Interceptions',
			'page' => '/truckers-interceptions'
		);

		$cities = cities::all();

		$role = \App\UserRole::findOrFail(Auth::user()->role_id);

		return view('pages.trucker_interceptions', 
				compact('page_title', 'page_breadcrumbs', 'cities', 'role') );
	}

	public function mechanics_interceptions(){
		$page_title = "Mechanics Interceptions";

		config([
			'menu_header.items' => [
				'items' => [
					'title'     => 'Home',
					'root'      => true,
					'page'      => '/dashboard',
					'new-tab'   => false
				]
			]
		]);

		config(['layout.ar.main' => 'true']);

		$UserRole = \App\UserRole::findOrFail(Auth::user()->role_id);
		if($UserRole -> hasPermissionTo('Dashboard')){
			$page_breadcrumbs[] = array(
				'title' => 'Dashboard',
				'page' => '/dashboard'
			);
		}

		$page_breadcrumbs[] = array(
			'title' => 'Mechanics Interceptions',
			'page' => '/mechanics-interceptions'
		);

		$cities = cities::all();

		$role = role::find(Auth::user()->role_id);

		return view('pages.mechanic_interceptions', 
				compact('page_title', 'page_breadcrumbs', 'cities', 'role') );
	}
}
