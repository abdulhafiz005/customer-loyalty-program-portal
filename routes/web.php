<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*
|**********************
| AUTH ROUTES
|**********************
*/

Route::get('/', 'AuthController@index');

Route::get('auth/login', ['as' => 'login', 'uses' => 'AuthController@getLogin'] ) -> name('login');

Route::post('auth/login', 'AuthController@postLogin');

Route::get('auth/logout', 'AuthController@getLogout');

//Route::get('auth/hash', 'AuthController@create_hash');
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});

/*
|**********************************
| Inner Pages ROUTES GET
|**********************************
*/

//Route::get('/', 'PagesController@index');

Route::group(['middleware' => 'role_has_permissions:Dashboard'], function (){
    Route::get('/dashboard',                    'DashboardController@dashboard')->name('dashboard');
});

Route::group(['middleware' => 'role_has_permissions:Read Interception'], function (){
    Route::get('/truckers-interceptions', 'InterceptionController@truckers_interceptions')->name('truckers_interceptions');
    Route::get('/mechanics-interceptions', 'InterceptionController@mechanics_interceptions')->name('mechanics_interceptions');
    Route::get('/interception-details/{id}', 'InterceptionController@interception_details')->name('interception-details.id');
    //Datatable
    Route::any('/ajax-interception-list',      'DatatableController@ajax_datatable_interception_list')->name('ajax-interception-list');
    //popup
    Route::post('/ajax-interception-details',    'PopupController@interception_details')->name('ajax-interception-details');

    Route::get('/ajax-converted-by/{member_id}', 'AjaxController@converted_by')->name('ajax-converted-by');
    Route::get('/ajax-interception-chart', 'AjaxController@interceptions_top_charts')->name('ajax-interception-chart');
    Route::get('/ajax-mechanic-interception-chart', 'AjaxController@mechanic_interceptions_top_charts')->name('ajax-mechanic-interception-chart');

    Route::post('/ajax-mechanic-interceptions',          'DatatableController@ajax_datatable_mechanic_interceptions')->name('ajax-mechanic-interceptions');
    Route::get('/mechanic-interception-details/{id}', 'InterceptionController@mechanic_interception_details')->name('/mechanic-interception-details/{id}');
});

Route::group(['middleware' => 'role_has_permissions:Write Trucker'], function (){
    Route::get('/trucker-profile-add',          'TruckerController@trucker_profile_add')->name('trucker-profile-add');
    Route::post('/add_trucker',                 'TruckerController@add_trucker')->name('add_trucker');
});

Route::group(['middleware' => 'role_has_permissions:Export Data'], function (){
    Route::get('/export-ms-timelog/{user_id}/{from}/{to}', 'UserManagementController@export_excel')->name('export-ms-timelog');
});

Route::group(['middleware' => 'role_has_permissions:Read Cities'], function (){
    Route::get('/city-listing', 'UserManagementController@cities_listing')->name('city-listing');
    Route::post('/ajax-cities-list', 'DatatableController@ajax_datatable_cities_list')->name('ajax-cities-list');
});

Route::group(['middleware' => 'role_has_permissions:Write Cities'], function (){
    Route::get('/delete-ajax-city/{id}', 'DatatableController@delete_ajax_city')->name('delete-ajax-city');
    Route::post('/ajax-add-new-city', 'UserManagementController@add_new_city')->name('ajax-add-new-city');
});

Route::group(['middleware' => 'role_has_permissions:Write User'], function (){
    Route::get('/user-management-add',          'UserManagementController@user_managment_add')->name('user-management-add');
    Route::get('/user-management-permission',   'UserManagementController@user_managment_permission')->name('user-management-permission');
    Route::get('/get-permissions/{role}',   'UserManagementController@get_permissions')->name('get-permissions');
    Route::post('/update-permissions',             'UserController@update_permissions')->name('update-permissions');
    Route::get('/ajax-user-list-popup',          'PopupController@user_management')->name('ajax-user-list-popup');
    Route::post('/ajax-user-update-submit', 'AjaxController@user_profile_update')->name('ajax-user-update-submit');
    Route::get('user-management-edit/{id}', 'UserManagementController@user_management_edit')->name('user-management-edit.id');
    Route::post('user-management-update', 'UserController@update_user')->name('user-management-update');
    Route::get('delete-user/{id}/{role_Id}', 'UserController@delete_user')->name('delete-user');
    Route::post('/add_user',                    'UserController@add_user')->name('add_user');
});

Route::group(['middleware' => 'role_has_permissions:Read User'], function (){
    Route::get('/user-management-list',         'UserManagementController@user_managment_list')->name('user-management-list');
    Route::post('/ajax-user-list',              'DatatableController@ajax_datatable_user_list')->name('ajax-user-list');
    Route::get('/ajax-get-the-user-member-graph',   'AjaxController@get_the_user_member_graph')->name('ajax-get-the-user-member-graph');
    Route::get('/ajax-get-user-member',             'AjaxController@get_the_uer_members')->name('ajax-get-user-member');
    Route::post('/ajax-user-time-log', 'AjaxController@get_user_time_log')->name('ajax-user-time-log');
    Route::post('/ajax-get-time-log', 'AjaxController@get_the_time_line')->name('ajax-get-time-log');
    

    //old routes
    // Route::get('/loyalty-program-user-awarded', 'PagesController@loyalty_program_user_awarded')->name('loyalty-program-user-awarded');
    // Route::get('/loyalty-program-add',          'PagesController@loyalty_program_add')->name('loyalty-program-add');
});

Route::group(['middleware' => 'role_has_permissions:Write Trucker'], function (){
    Route::get('/ajax-trucker-list-popup',          'PopupController@trucker_management')->name('ajax-trucker-list-popup');
    Route::post('/ajax-trucker-update-submit', 'AjaxController@trucker_profile_update')->name('ajax-trucker-update-submit');
});

Route::group(['middleware' => 'role_has_permissions:Read Trucker'], function (){
    Route::get('/trucker-profile-detail/{id}',  'TruckerController@trucker_profile_detail')->name('trucker-profile-detail.id');
    Route::any('/ajax-trucker-list',           'DatatableController@ajax_datatable_trucker_list')->name('ajax-trucker-list');
    Route::get('ajax-trucker-chart', 'AjaxController@ger_trucker_chart')->name('ajax-trucker-chart');
    Route::post('/ajax-trucker-profile-detail',  'PopupController@trucker_details')->name('ajax-trucker-profile-detail');
    Route::get('/trucker-profile',              'TruckerController@trucker_profile')->name('trucker-profile');
});

Route::group(['middleware' => 'role_has_permissions:Write Purchase'], function (){
    Route::get('/sale',              'PurchaseController@purchase')->name('sale');
    Route::post('/make_purchase',        'PurchaseController@add_purchase')->name('make_purchase');
    Route::post('assign-trucker-gift', 'PurchaseController@assign_trucker_gift')->name('assign-trucker-gift.id');
    Route::post('/ajax-check-member',    'PurchaseController@ajax_check_member')->name('ajax-check-member');
    Route::post('/ajax-check-member-truck_id',    'PurchaseController@ajax_check_member_truck_id')->name('ajax-check-member_truck_id');
    Route::post('/ajax-trucker-form-submit', 'AjaxController@trucker_form_submit')->name('ajax-trucker-form-submit');
    Route::get('/ajax-trucker-form',             'PopupController@trucker_form')->name('ajax-trucker-form');
});

Route::group(['middleware' => 'role_has_permissions:Read Purchase'], function (){
    Route::get('/purchase-details/{id}', 'PurchaseController@purchase_detail')->name('purchase-details');
});

Route::group(['middleware' => 'role_has_permissions:Read Ustad'], function (){
    Route::get('/ustad-mechanic',               'UstadMechanicController@ustad_mechanic')->name('ustad-mechanic');
});

Route::group(['middleware' => 'role_has_permissions:Read Supervisor'], function (){
    Route::get('/mechanic-supervisor',               'MechanicSupervisorController@mechanic_supervisor')->name('mechanic-supervisor');
});

Route::group(['middleware' => 'role_has_permissions:Read Supervisor, Read Safeer, Read Ustad, Read User'], function (){
    Route::post('/ajax-role-list',              'DatatableController@ajax_datatable_role_list')->name('ajax-role-list');
    Route::get('/user-managment-details/{id}',  'UserManagementController@user_managment_details')->name('user-managment-details.id');
    Route::get('/ajax-dashboard-stats', 'AjaxController@get_dashboard_stats')->name('ajax-dashboard-stats');
});

Route::group(['middleware' => 'role_has_permissions:Read Mechanic'], function (){
    Route::get('/mechanic-list',         'MechanicController@mechanic_list')->name('mechanic-list');
    Route::post('/ajax-mechanic-list',          'DatatableController@ajax_datatable_mechanic_list')->name('ajax-mechanic-list');
    Route::get('/mechanic-details/{mechanic_id}', 'MechanicController@mechanic_details')->name('mechanic-details');
});

Route::group(['middleware' => 'role_has_permissions:Read Safeer'], function (){
    Route::get('/safeer-list', 'UserManagementController@safeer_list')->name('safeer-list');
});

Route::group(['middleware' => 'role_has_permissions:Convert Mechanic'], function (){
    Route::post('/add_user',                    'UserController@add_user')->name('add_user');
    Route::get('/convert-to-ustad/{id}', 'UserManagementController@convert_to_ustad')->name('convert-to-ustad.id');
});

Route::group(['middleware' => 'role_has_permissions:Convert Trucker'], function (){
    Route::post('/add_user',                    'UserController@add_user')->name('add_user');
    Route::get('/convert-to-safeer/{id}', 'UserManagementController@convert_to_safeer')->name('convert-to-safeer.id');
});

Route::group(['middleware' => 'role_has_permissions:Read Brand Ambassador'], function (){
    Route::get('/brand-ambassador', 'UserManagementController@brand_ambassador')->name('brand-ambassador');
});
// Route::group(['middleware' => ['role:Administrator']], function () {
    // Route::get('/truckers-interceptions', 'InterceptionController@truckers_interceptions')->name('truckers_interceptions');
    // Route::get('/mechanics-interceptions', 'InterceptionController@mechanics_interceptions')->name('mechanics_interceptions');
    // // Route::get('/interception',              'InterceptionController@interception')->name('interception');
    // Route::get('/interception-details/{id}', 'InterceptionController@interception_details')->name('interception-details.id');
    // //Datatable
    // Route::any('/ajax-interception-list',      'DatatableController@ajax_datatable_interception_list')->name('ajax-interception-list');
    // //popup
    // Route::post('/ajax-interception-details',    'PopupController@interception_details')->name('ajax-interception-details');

    // Route::get('/trucker-profile-add',          'TruckerController@trucker_profile_add')->name('trucker-profile-add');
    // Route::post('/add_trucker',                 'TruckerController@add_trucker')->name('add_trucker');

    //ajax
    // Route::post('/ajax-user-time-log', 'AjaxController@get_user_time_log')->name('ajax-user-time-log');
    //cities route
    // Route::get('/city-listing', 'UserManagementController@cities_listing')->name('city-listing');
    // //ajax
    // Route::post('/ajax-cities-list', 'DatatableController@ajax_datatable_cities_list')->name('ajax-cities-list');
    // Route::get('/delete-ajax-city/{id}', 'DatatableController@delete_ajax_city')->name('delete-ajax-city');

    // Route::get('/user-management-add',          'UserManagementController@user_managment_add')->name('user-management-add');
    // Route::get('/user-management-list',         'UserManagementController@user_managment_list')->name('user-management-list');
    // Route::get('/user-management-permission',   'UserManagementController@user_managment_permission')->name('user-management-permission');
    // Route::get('/get-permissions/{role}',   'UserManagementController@get_permissions')->name('get-permissions');
    // Route::post('/update-permissions',             'UserController@update_permissions')->name('update-permissions');
    //Datatable
    // Route::post('/ajax-user-list',              'DatatableController@ajax_datatable_user_list')->name('ajax-user-list');
    //ajax
    // Route::get('/ajax-get-the-user-member-graph',   'AjaxController@get_the_user_member_graph')->name('ajax-get-the-user-member-graph');
    // Route::get('/ajax-get-user-member',             'AjaxController@get_the_uer_members')->name('ajax-get-user-member');
    // Route::get('/export-ms-timelog/{user_id}/{from}/{to}', 'UserManagementController@export_excel')->name('export-ms-timelog');
    // Route::post('/ajax-add-new-city', 'UserManagementController@add_new_city')->name('ajax-add-new-city');

    // Route::get('/ajax-trucker-list-popup',          'PopupController@trucker_management')->name('ajax-trucker-list-popup');
    // Route::get('/ajax-user-list-popup',          'PopupController@user_management')->name('ajax-user-list-popup');
    // Route::post('/ajax-user-update-submit', 'AjaxController@user_profile_update')->name('ajax-user-update-submit');
    // Route::post('/ajax-trucker-update-submit', 'AjaxController@trucker_profile_update')->name('ajax-trucker-update-submit');
    // Route::get('/loyalty-program-user-awarded', 'PagesController@loyalty_program_user_awarded')->name('loyalty-program-user-awarded');
    // Route::get('/loyalty-program-add',          'PagesController@loyalty_program_add')->name('loyalty-program-add');

    // Route::get('/ajax-converted-by/{member_id}', 'AjaxController@converted_by')->name('ajax-converted-by');
    // Route::get('/ajax-interception-chart', 'AjaxController@interceptions_top_charts')->name('ajax-interception-chart');
    // Route::get('/ajax-mechanic-interception-chart', 'AjaxController@mechanic_interceptions_top_charts')->name('ajax-mechanic-interception-chart');

    // Route::get('user-management-edit/{id}', 'UserManagementController@user_management_edit')->name('user-management-edit.id');
    // Route::post('user-management-update', 'UserController@update_user')->name('user-management-update');
    // Route::get('delete-user/{id}/{role_Id}', 'UserController@delete_user')->name('delete-user');
// });

// Route::group(['middleware' => ['role:Administrator|Rimula Brand Manager']], function () {
//     Route::get('/dashboard',                    'DashboardController@dashboard')->name('dashboard');
// });

// Route::group(['middleware' => ['role:Administrator|Rimula Center|Rimula Brand Manager']], function () {
    // Route::get('/purchase',              'PurchaseController@purchase')->name('purchase');
    // Route::get('/purchase-details/{id}', 'PurchaseController@purchase_detail')->name('purchase-details');
    // Route::post('/make_purchase',        'PurchaseController@add_purchase')->name('make_purchase');
    // Route::get('assign-trucker-gift/{id}', 'PurchaseController@assign_trucker_gift')->name('assign-trucker-gift.id');

    //ajax
    // Route::post('/ajax-check-member',    'PurchaseController@ajax_check_member')->name('ajax-check-member');
    // Route::post('/ajax-check-member-truck_id',    'PurchaseController@ajax_check_member_truck_id')->name('ajax-check-member_truck_id');
    // Route::get('/trucker-profile',              'TruckerController@trucker_profile')->name('trucker-profile');
    // Route::get('/trucker-profile-detail/{id}',  'TruckerController@trucker_profile_detail')->name('trucker-profile-detail.id');
    // Route::get('/truck-profile',                'TruckController@truck_profile')->name('truck-profile');
    //Datatable
    // Route::any('/ajax-trucker-list',           'DatatableController@ajax_datatable_trucker_list')->name('ajax-trucker-list');
    //ajax
    // Route::get('ajax-trucker-chart', 'AjaxController@ger_trucker_chart')->name('ajax-trucker-chart');
    //popup
    // Route::post('/ajax-trucker-profile-detail',  'PopupController@trucker_details')->name('ajax-trucker-profile-detail');
    //ajax-user-mechanic-list
    // Route::get('/ustad-mechanic',               'UstadMechanicController@ustad_mechanic')->name('ustad-mechanic');
    // Route::get('/mechanic-supervisor',               'MechanicSupervisorController@mechanic_supervisor')->name('mechanic-supervisor');
    //ajax
    // Route::post('/ajax-role-list',              'DatatableController@ajax_datatable_role_list')->name('ajax-role-list');

    // Route::get('/mechanic-list',         'MechanicController@mechanic_list')->name('mechanic-list');
    //Datatable
    // Route::post('/ajax-mechanic-list',          'DatatableController@ajax_datatable_mechanic_list')->name('ajax-mechanic-list');
    // Route::get('/mechanic-details/{mechanic_id}', 'MechanicController@mechanic_details')->name('mechanic-details');

    // Route::post('/add_user',                    'UserController@add_user')->name('add_user');

    // Route::get('/user-managment-details/{id}',  'UserManagementController@user_managment_details')->name('user-managment-details.id');

    //ajax
    // Route::get('/ajax-dashboard-stats', 'AjaxController@get_dashboard_stats')->name('ajax-dashboard-stats');
    // Route::post('/ajax-get-time-log', 'AjaxController@get_the_time_line')->name('ajax-get-time-log');

    // Route::post('/ajax-trucker-form-submit', 'AjaxController@trucker_form_submit')->name('ajax-trucker-form-submit');
    // Route::get('/ajax-trucker-form',             'PopupController@trucker_form')->name('ajax-trucker-form');
    // Route::get('/safeer-list', 'UserManagementController@safeer_list')->name('safeer-list');
// });

// Route::group(['middleware' => ['role:Administrator|Rimula Center']], function () {
    // Route::get('/convert-to-safeer/{id}', 'UserManagementController@convert_to_safeer')->name('convert-to-safeer.id');
    // Route::get('/convert-to-ustad/{id}', 'UserManagementController@convert_to_ustad')->name('convert-to-ustad.id');
// });


/*Route::group(['middleware' => ['permission:Mechanic Add|Mechanic List|Mechanic History List|Add Mechanic']], function () {
    Route::get('/mechanic-add',          'MechanicController@mechanic_add')->name('mechanic-add');
    Route::get('/mechanic-list',         'MechanicController@mechanic_list')->name('mechanic-list');
    Route::get('/mechanic-history-list', 'MechanicController@mechanic_history')->name('mechanic-history-list');
    Route::post('/add_mechanic',          'MechanicController@add_mechanic')->name('add_mechanic');

        //Datatable
    Route::post('/ajax-mechanic-list',          'DatatableController@ajax_datatable_mechanic_list')->name('ajax-mechanic-list');
    Route::post('/ajax-mechanic-history-list',  'DatatableController@ajax_datatable_history_mechanic')->name('ajax-mechanic-history-list');

        //ajax
    Route::post('/ajax-mechanic-form-submit', 'AjaxController@mechanic_form_submit')
            ->name('ajax-mechanic-form-submit');

        //popup
    Route::get('/ajax-mechanic-form',            'PopupController@mechanic_form')->name('ajax-mechanic-form');


});*/

// Route::get('/cache', function (){
//     app()['cache']->forget('spatie.permission.cache');
// });

// Route::get('/insertPermissions', function (){
//     // Reset cached roles and permissions
//     app()['cache']->forget('spatie.permission.cache');
//     DB::table('permissions')->insert(array('name' => 'Dashboard', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
//     DB::table('permissions')->insert(array('name' => 'Read Purchase', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
//     DB::table('permissions')->insert(array('name' => 'Write Purchase', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
//     DB::table('permissions')->insert(array('name' => 'Read Interception', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
//     DB::table('permissions')->insert(array('name' => 'Read User', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
//     DB::table('permissions')->insert(array('name' => 'Write User', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
//     DB::table('permissions')->insert(array('name' => 'Read Trucker', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
//     DB::table('permissions')->insert(array('name' => 'Write Trucker', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
//     DB::table('permissions')->insert(array('name' => 'Read Mechanic', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
//     DB::table('permissions')->insert(array('name' => 'Write Mechanic', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
//     DB::table('permissions')->insert(array('name' => 'Read Cities', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
//     DB::table('permissions')->insert(array('name' => 'Write Cities', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
//     DB::table('permissions')->insert(array('name' => 'Read Safeer', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
//     DB::table('permissions')->insert(array('name' => 'Write Safeer', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
//     DB::table('permissions')->insert(array('name' => 'Read Ustad', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
//     DB::table('permissions')->insert(array('name' => 'Write Ustad', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
//     DB::table('permissions')->insert(array('name' => 'Convert Mechanic', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
//     DB::table('permissions')->insert(array('name' => 'Convert Trucker', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
//     DB::table('permissions')->insert(array('name' => 'Read Supervisor', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
//     DB::table('permissions')->insert(array('name' => 'Write Supervisor', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
//     DB::table('permissions')->insert(array('name' => 'Read Brand Ambassador', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
//     DB::table('permissions')->insert(array('name' => 'Write Brand Ambassador', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
//     DB::table('permissions')->insert(array('name' => 'Export Data', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));

// });

Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');

Route::get('storage/{filename}', function ($filename)
{
    $path = storage_path('app/public/'.$filename);

    if (!File::exists($path)) {
        abort(404);
    	//echo "notfound";
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});


// Quick search dummy route to display html elements in search dropdown (header search)
Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');
