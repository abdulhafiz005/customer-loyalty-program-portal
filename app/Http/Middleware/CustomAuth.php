<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

//use Redirect;

//use Session;

//use Route;

class CustomAuth
{
	/**
	* Handle an incoming request.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  \Closure  $next
	* @return mixed
	*/

	public function handle($request, Closure $next)
	{
		if (!Auth::check()) {
			return redirect()->route('login');
		}

		$user = Auth::user();
		$role = \App\UserRole::findOrFail($user -> role_id);

		$items = array();

		if($role -> hasPermissionTo('Dashboard')){
			$items[] = [
				'title'     => 'Dashboard',
				'root'      => true,
				'icon'      => 'media/svg/icons/Layout/Layout-4-blocks.svg',
				'page'      => '/dashboard',
				'new-tab'   => false
			];
		}

		if($role -> hasPermissionTo('Write Purchase')){

			$items[] = [
				'title'     => 'New Sale',
				'root'      => true,
				'icon'      => 'media/svg/icons/Layout/Layout-arrange.svg',
				'page'      => '/sale',
				'new-tab'   => false
			];
		}

		if($role -> hasPermissionTo('Read Interception')){

			$items[] = [
				'title'     => 'Interceptions',
				'root'      => true,
				'icon'      => 'media/svg/icons/General/Settings-1.svg',
				'new-tab'   => false,
				'submenu'	=> [
					[
						'title' => 'Truckers',
						'page'	=> '/truckers-interceptions',
					],
					[
						'title' => 'Mechanics',
						'page'	=> '/mechanics-interceptions',
					],
					// [
					// 	'title' => 'demo',
					// 	'page'	=> '/interception',
					// ]
				]
			];
		}

		if($role -> hasPermissionTo('Read User') && $role -> hasPermissionTo('Write User')){

			$items[] = [
				'title'     => 'User Management',
				'root'      => true,
				'icon'      => 'media/svg/icons/Shopping/Box2.svg',
				'new-tab'   => false,
				'submenu' => [
					[
						'title' => 'List',
						'page' => '/user-management-list'
					],
					[
						'title' => 'Add New',
						'page' => '/user-management-add'
					],
					// [
					// 	'title' => 'Edit Permission',
					// 	'page' => '/user-management-permission'
					// ]
				],
			];
		}

		if($role -> hasPermissionTo('Read Trucker') && $role -> hasPermissionTo('Write Trucker')){

			$items[] = [
				'title'     => 'Truckers',
				'root'      => true,
				'icon'      => 'media/svg/icons/Shopping/Box1.svg',
				'new-tab'   => false,
				'submenu' => [
					[
						'title' => 'Add Trucker',
						'page' => '/trucker-profile-add'
					],
					[
						'title' => 'Trucker List',
						'page' => '/trucker-profile'
					],
				],

			];
		}

		if($role -> hasPermissionTo('Read Trucker') && !$role -> hasPermissionTo('Write Trucker')){

			$items[] = [
				'title'     => 'Truckers',
				'page'		=>	'/trucker-profile',
				'root'      => true,
				'icon'      => 'media/svg/icons/Shopping/Box1.svg',
				'new-tab'   => false,
			];
		}

		if($role -> hasPermissionTo('Read Safeer')){

			$items[] = [
				'title'     => 'Safeer Truck Drivers',
				'page'		=>	'/safeer-list',
				'root'      => true,
				'icon'      => 'media/svg/icons/Shopping/Box1.svg',
				'new-tab'   => false,
			];
		}

		if($role -> hasPermissionTo('Read Mechanic')){
			$items[] = [
				'title'		=>		'Mechanics',
				'page'		=>		'/mechanic-list',
				'root'		=>		true,
				'icon'		=>		'media/svg/icons/Shopping/Box2.svg',
				'new-tab'	=>		false,
			];
		}

		if($role -> hasPermissionTo('Read Ustad')){
			$items[] = [
				'title' => 'Ustad Mechanic',
				'page' => '/ustad-mechanic',
				'root'      => true,
				'icon'      => 'media/svg/icons/Shopping/Box2.svg',
				'new-tab'   => false,
			];
		}

		if($role -> hasPermissionTo('Read Brand Ambassador')){
			$items[] = [
				'title' => 'Brand Ambassador',
				'page' => '/brand-ambassador',
				'root'      => true,
				'icon'      => 'media/svg/icons/Shopping/Box2.svg',
				'new-tab'   => false,
			];
		}

		if($role -> hasPermissionTo('Read Supervisor')){
			$items[] = [
				'title' => 'Mechanic Supervisor',
				'page' => '/mechanic-supervisor',
				'root'      => true,
				'icon'      => 'media/svg/icons/Shopping/Box2.svg',
				'new-tab'   => false,
			];
		}

		if ($role -> hasPermissionTo('Read Cities'))
		{
			$items[] = [
				'title' => 'Cities',
				'page' => '/city-listing',
				'root'      => true,
				'icon'      => 'media/svg/icons/Shopping/Box2.svg',
				'new-tab'   => false,
			];
		}

		// if($user->can('Mechanic List')){

		// 	$items[] = [
		// 		'title'     => 'Mechanics',
		// 		'root'      => true,
		// 		'icon'      => 'media/svg/icons/Shopping/Box2.svg',
		// 		'new-tab'   => false,
		// 		'submenu' => [
		// 			[
		// 				'title' => 'Add Mechanic',
		// 				'page' => '/mechanic-add'
		// 			],
		// 			[
		// 				'title' => 'Mechanics List',
		// 				'page' => '/mechanic-list'
		// 			]
		// 		],

		// 	];

		// 	$items[] = [
		// 		'title' => 'History',
		// 		'page' => '/mechanic-history-list',
		// 		'root'      => true,
		// 		'icon'      => 'media/svg/icons/Shopping/Box2.svg',
		// 		'new-tab'   => false,
		// 	];
		// }

		$items[] = [
			'title'     => 'Logout',
			'root'      => true,
			'icon'      => 'media/svg/icons/Files/Folder.svg',
			'page'      => 'auth/logout',
			'new-tab'   => false,
		];

		config([
			'menu_aside.items' => [
				'items'	=> $items
			]
		]);

		/*
			if (!Auth::check()) {
				return redirect()->route('login');
			}

			$data = Session::all();

			$result = false;

			foreach ($data['allowed'] as $key => $value) {
				if(Route::current()->getName() == $value || Route::current()->getName() == 'dashboard' ||  Route::current()->getName() == 'ajax-dashboard-stats'){
					$result = true;
				}    
			}

			if ($result != true) {
				return redirect()->route('dashboard');
			}

			@if(Session::get('role') == 3)
				{{ Menu::renderVerMenu(config('menu_aside_3.items')) }}
			@endif
		*/

		return $next($request);

	}
}
