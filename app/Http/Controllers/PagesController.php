<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use DB;

Use Auth;

class PagesController extends Controller
{

    public function __construct(){
        //parent::__construct();
        $this->middleware('custom.auth');
    }

    public function index(){
        
    }

    public function loyalty_program_user_awarded(){
        $page_title = "Register Tucker";

        $page_breadcrumbs = array(
            [
                'title' => 'Dashboard',
                'page' => '/dashboard'
            ],
            [
                'title' => 'Loyalty Program',
                'page' => '#'
            ],
            [
                'title' => 'Loyalty Program User Awarded',
                'page' => '/loyalty-program-user-awarded'
            ]
        );

        return view('pages.loyalty-program-user-awarded', compact('page_title', 'page_breadcrumbs') );
    }

    public function loyalty_program_add(){
        $page_title = "Register Tucker";

        $page_breadcrumbs = array(
            [
                'title' => 'Dashboard',
                'page' => '/dashboard'
            ],
            [
                'title' => 'Loyalty Program',
                'page' => '#'
            ],
            [
                'title' => 'Add New Loyalty Program',
                'page' => '#'
            ]
        );

        return view('pages.loyalty-program-add', compact('page_title', 'page_breadcrumbs') );
    }

}
