<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Storage;

Use DB;

Use File;

Use Auth;

use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Role;

use Spatie\Permission\Models\Permission;


class AjaxController extends Controller
{
    public function __construct(){
        //parent::__construct();
        //$this->middleware('custom.auth');
    }

    public function converted_by($member_id){
        $query = "SELECT u.id AS id , u.first_name AS text from interceptions AS i
                    INNER JOIN users AS u on u.id = i.agent
                    INNER JOIN truckers AS t on t.cnic = i.cnic
                    WHERE t.member_id = '". $member_id ."'";

        $parts = DB::select(DB::raw($query));

        $this->ajax_response($parts);
    }

    public function get_the_uer_members(){
        $q1 = "SELECT u_r.id, u_r.name, count(*) AS total FROM users AS u INNER JOIN roles AS u_r on u_r.id = u.role_id GROUP BY role_id";
        $parts = DB::select(DB::raw($q1));

        $q2 = "SELECT count(*) AS total FROM truckers";
        $parts2 = DB::select(DB::raw($q2));

        $parts[] = array('id' => 9, 'total' => $parts2[0]->total, 'role' => 'trucker' );

        return $this->ajax_response($parts);
    }

    /*
    * Begin Ajax Charts
    */

    public function mechanic_interceptions_top_charts(Request $request){
        $data = $request->all();

        $return = array();

        if (!isset($data['role_id'])) {
            $data['role_id'] = 0;
        }

        if (!isset($data['city'])) {
            $data['city'] = 'All Cities';
        }

        if (!isset($data['start'])) {
            $data['start'] = 0;
        }

        if (!isset($data['end'])) {
            $data['end'] = 0;
        }

        $return['interceptions']            = $this->get_the_mechanic_interceptions($data['start'], $data['end'], $data['city'], $data['role_id']);

        $return['converted_interceptions']  = $this->get_the_converted_mechanic_interceptions($data['start'], $data['end'], $data['city'], $data['role_id']);

        $return['top_brands']               = $this->get_the_top_brands($data['start'], $data['end'], $data['city'], $data['role_id']);

        $return['top_users']                = $this->get_the_top_mechanic_users($data['start'], $data['end'], $data['city'], $data['role_id']);

        $return['top_cities']               = $this->get_top_mechanic_cities($data['start'], $data['end'], $data['city'], $data['role_id']);

        //working
        $this->ajax_response($return);
    }

    public function interceptions_top_charts(Request $request){
        $data = $request->all();

        $return = array();

        if (!isset($data['role_id'])) {
            $data['role_id'] = 0;
        }

        if (!isset($data['city'])) {
            $data['city'] = 'All Cities';
        }

        if (!isset($data['start'])) {
            $data['start'] = 0;
        }

        if (!isset($data['end'])) {
            $data['end'] = 0;
        }

        $return['interceptions']            = $this->get_the_interceptions($data['start'], $data['end'], $data['city'], $data['role_id']);

        $return['converted_interceptions']  = $this->get_the_converted_interceptions($data['start'], $data['end'], $data['city'], $data['role_id']);

        $return['top_brands']               = $this->get_the_top_brands($data['start'], $data['end'], $data['city'], $data['role_id']);

        $return['top_users']                = $this->get_the_top_users($data['start'], $data['end'], $data['city'], $data['role_id']);

        $return['top_cities']               = $this->get_top_cities($data['start'], $data['end'], $data['city'], $data['role_id']);

        //working
        $this->ajax_response($return);
    }

    public function get_dashboard_stats(Request $request){

        $data = $request->all();
        $return = array();
        date_default_timezone_set("Asia/Karachi");
        $today = date('Y-m-d');
        /*Start of the dashboard data*/
        if($data['start'] == '2020-01-01' && $data['end'] == $today){
            // get all time stats
            $return['activity']                  = $this->get_all_dashboard_activity_labels();
            $return['sales']                     = $this->get_all_dashboard_sales();
            $return['top_brands']                = $this->get_all_the_top_brands();
            $return['top_users']                 = $this->get_all_the_top_users();
            $return['top_cities']                = $this->get_all_top_cities();
            $return['registered_mechanics']      = $this->get_all_registered_mechanics($data['start'], $data['end']);
            $return['customers']                 = $this->get_all_data_new_old_customer();
            $return['activity_list']             = $this->get_all_activity();
            //$return['interceptions']           = $this->get_the_interceptions($data['start'], $data['end'], $data['city'], $data['role_id']);
            //$return['converted_interceptions'] = $this->get_the_converted_interceptions($data['start'], $data['end'], $data['city'], $data['role_id']);
            $this->ajax_response($return);
        }

        if (!isset($data['role_id'])) {
            $data['role_id'] = 0;
        }

        if (!isset($data['city'])) {
            $data['city'] = 'All Cities';
        }

        if (!isset($data['start']) || $data['start'] == 0) {
            $data['start'] = $today;
        }

        if (!isset($data['end']) || $data['end'] == 0) {
            $data['end'] = $today;
        }

        $return['activity']                 = $this->get_dashboard_activity_labels($data['start'], $data['end'], $data['city'], $data['role_id']);

        $return['sales']                    = $this->get_dashboard_sales($data['start'], $data['end'], $data['city'], $data['role_id']);

        //$return['interceptions']            = $this->get_the_interceptions($data['start'], $data['end'], $data['city'], $data['role_id']);

        //$return['converted_interceptions']  = $this->get_the_converted_interceptions($data['start'], $data['end'], $data['city'], $data['role_id']);

        $return['top_brands']               = $this->get_the_top_brands($data['start'], $data['end'], $data['city'], $data['role_id']);

        $return['top_users']                = $this->get_the_top_users($data['start'], $data['end'], $data['city'], $data['role_id']);

        $return['top_cities']               = $this->get_top_cities($data['start'], $data['end'], $data['city'], $data['role_id']);

        $return['registered_mechanics']     = $this->get_all_registered_mechanics($data['start'], $data['end']);

        $return['customers']                = $this->get_data_new_old_customer($data['start'], $data['end'], $data['city'], $data['role_id']);

        $return['activity_list']            = $this->get_activity($data['start'], $data['end']);

        $this->ajax_response($return);

    }

    public function get_the_user_member_graph(Request $request){
        $brand_ambassador = "SELECT count(*) AS y, DATE_FORMAT(created_at, '%b') AS x FROM users as u where u.role_id = 2 GROUP BY MONTH(u.created_at)";
        $brand_ambassador = DB::select(DB::raw($brand_ambassador));

        $total_ustad = "SELECT count(*) AS y, DATE_FORMAT(created_at, '%b') AS x FROM users as u where u.role_id = 4 GROUP BY MONTH(u.created_at)";
        $total_ustad = DB::select(DB::raw($total_ustad));

        $truckers = "SELECT count(*) AS y, DATE_FORMAT(created_at, '%b') as x FROM truckers GROUP BY  MONTH(created_at)";
        $truckers = DB::select(DB::raw($truckers));


        $response = array(
            'brand_ambassador' => $brand_ambassador,
            'total_ustad'      => $total_ustad,
            'truckers'         => $truckers
        );

        return $this->ajax_response($response);

    }


    public function ger_trucker_chart(Request $request){
        $data = $request->all();

        $today = date('Y/m/d');

        if (!isset($data['start']) || $data['start'] == 0) {
            $data['start'] = $today;
        }

        if (!isset($data['end']) || $data['end'] == 0) {
            $data['end'] = $today;
        }

        if(!isset($data['city'])){
            $data['city'] = 'All Cities';
        }

        $return['truckerInterceptionsResponse'] = $this->get_trucker_interceptions($data['start'], $data['end']);

        $return['truckerSales']         = $this->get_trucker_sales($data['start'], $data['end'], $data['city']);

        return $this->ajax_response($return);

    }

    /*
    * Begin Ajax Form Submit
    */

    public function mechanic_form_submit(Request $request){
        $data = $request->all();
        $user = \App\Mechanic::find($data['user_id']);
        try{

            $evidence = array();

            if($request->hasFile('attachment')) {

                $cover = $request->file('attachment');
                foreach ($cover as $value) {
                    $extension = $value->getClientOriginalExtension();
                    Storage::disk('public')->put($value->getFilename().'.'.$extension,  File::get($value));

                    $evidence[] = $value->getFilename().'.'.$extension;
                }
            }

            $purchase = new \App\Purchase;

            $purchase->user_id = $data['user_id'];
            $purchase->product_id = $data['product'];
            $purchase->quantity = $data['quantity'];
            $purchase->variant = $data['variant'];
            $purchase->type = $user->type;
            $purchase->created_by = Auth::user()->id;

            if ($request->hasFile('attachment')) {
                $purchase->evidence_p  = serialize($evidence);
            }

            $purchase->save();

            $response['status'] = "success";

            $response['msg'] = "Purchase Completed";

            //return redirect('trucker-profile-add')->with('success',"Insert successfully");
            return $this->ajax_response($response);
        }catch(Exception $e){
            $response['status'] = "failed";
            $response['msg'] = "Unable To Complete Purchase";
            //return redirect('trucker-profile-add')->with('danger',"operation failed");
            return $this->ajax_response($response);
        }

    }

    public function trucker_form_submit(Request $request){
        $data = $request->all();
        $user = \App\Trucker::find($data['user_id']);
        $mechanic = \App\User::find($data['ustad_mechanic']);

        try{

            $evidence = array();

            if($request->hasFile('attachment')) {

                $cover = $request->file('attachment');
                foreach ($cover as $value) {
                    $extension = $value->getClientOriginalExtension();
                    Storage::disk('public')->put($value->getFilename().'.'.$extension,  File::get($value));

                    $evidence[] = $value->getFilename().'.'.$extension;
                }
            }

            $purchase = new \App\Purchase;

            $purchase->user_id = $data['user_id'];
            $purchase->product_id = $data['product'];
            $purchase->quantity = $data['quantity'];
            $purchase->variant = $data['variant'];
            $purchase->type = $user->type;
            $purchase->converted_by = $mechanic -> id;
            $purchase->created_by = Auth::user()->id;

            if (isset($data['vehicle_id'])) {
                $purchase->vehicle_number          = $this->insert_trucker_truck( $data['vehicle_id'], $data['user_id'] );
            }else{
                $purchase->vehicle_number          = $user->truck_no;
            }


            if (isset($data['d_o_b'])) {
                $purchase->created_at = $data['d_o_b'];
            }

            if ($request->hasFile('attachment')) {
                $purchase->evidence_p  = serialize($evidence);
            }

            $purchase->save();

            //Loyalty Points for Mechanic Ustad
            //$user = Auth::user();

            $lp_quantity = $data['quantity'] * $data['variant'];
            $lp_ = \App\lp_product::where(
                    array(
                            'product_id' => $data['product'],
                            'role_id' => $mechanic->role_id
                        ))->get()->toArray();

            if (isset($lp_[0]['points'])) {

                $lp_earned = new \App\lp_earned;
                $lp_earned->user_id = $mechanic -> id;
                $lp_earned->role_id = $mechanic->role_id;
                $lp_earned->purchase_id = $purchase->id;
                $lp_earned->points_earned = $lp_[0]['points'] * $lp_quantity;

                $lp_earned->save();

            }

            $response['status'] = "success";

            $response['msg'] = "Purchase Completed";

            $interception                      = new \App\Interception;
            $interception->name                = $user->first_name;
            $interception->agent               = $data['ustad_mechanic'];

            if (isset($data['vehicle_id'])) {
                $interception->vehicle_no      = $data['vehicle_id'];
            }

            $interception->contact_no          = $user->contact;
            $interception->location            = $mechanic -> location_to_be_place;
            $interception->switch_from         = $data['switch_to_shell'];
            $interception->type                = $user->type;
            $interception->interception_status = $data['switch_to_shell'] == 'Shell' ? 'existing' : 'converted';
            $interception->cnic                = $user->cnic;

            if (isset($data['d_o_b'])) {
                $interception->created_at = $data['d_o_b'];
            }

            $interception->save();

            return $this->ajax_response($response);
        }catch(Exception $e){
            $response['status'] = "failed";
            $response['msg'] = "Unable To Complete Purchase";
            return $this->ajax_response($response);
        }

    }

    public function user_profile_update(Request $request){
        $data = $request->all();
        $user = \App\User::findOrFail($data['user']);

        $user->fill([
            'first_name'           => $data['first_name'],
            'last_name'            => $data['last_name'],
            'role_id'              => $data['user_type'],
            'password_text'        => $data['password'],
            'password'             => Hash::make($data['password']),
            'status'               => $data['status'],
            'assign_to'            => $request -> assign_to,
        ]);

        if($user->save()){
            $user_role = \App\UserRole::find($data['user_type']);

            $user_hasrole = \App\User::find($user->id);

            $user_hasrole->syncRoles($user_role->role);

            $response['status'] = "success";
            $response['msg'] = "Updated Successfully";

            return $this->ajax_response($response);
        }
    }

    public function trucker_profile_update(Request $request){
        $data = $request->all();

        $user = \App\Trucker::findOrFail($data['user']);

        $user->first_name  = $data['first_name'];
        $user->last_name   = $data['last_name'];
        $user->contact     = $data['contact'];

        $user->save();

        if (isset($data['vehicle_id'])) {
            $insert_truck       = $this->insert_trucker_truck( $data['vehicle_id'], $data['user'] );

            \App\Trucker::where('id' , $data['user'])
                ->update([ 'truck_no' => $insert_truck ]);
        }


        if ($user->id) {
            $response['status'] = "success";
            $response['msg'] = "Updated Successfully";

            return $this->ajax_response($response);
        }

    }

    public function get_user_time_log(Request $request){
        $data = $request->all();
        $from = strtotime($data['start']);
        $to = strtotime($data['end']);

        $query = "SELECT a.activity_type as activity, a.lng as lng, a.lat as lat, DATE_FORMAT(a.created_at,'%r') as time, date(a.created_at) as date
        FROM activity as a
        WHERE a.user_id = ".$data['user_id']."
                AND DATE(a.created_at) BETWEEN '". date("Y-m-d", $from)  ."' AND '". date("Y-m-d", $to)  ."'
        ORDER BY a.created_at DESC ";

        $record = DB::select(DB::raw($query));
        return $this->ajax_response($record);
    }

    public function get_the_time_line(Request $request){
        $data = $request->all();
        $from = strtotime($data['from']);
        $to = strtotime($data['to']);
        //date("Y-m-d H:i:s", $timestamp);

        $query = "SELECT a.activity_type, a.lng, a.lat, DATE_FORMAT(a.created_at,'%r') AS created_at
                    FROM activity as a
                    WHERE a.user_id = ".$data['user_id']."
                            AND DATE(a.created_at) BETWEEN '". date("Y-m-d", $from)  ."' AND '". date("Y-m-d", $to)  ."'
                    ORDER BY a.created_at DESC ";

        $record = DB::select(DB::raw($query));

        $response = "";

        $array = array();

        foreach ($record as $key => $value) {

            $response .= "
                <div class='d-flex align-items-center mb-10'>
                    <div class='symbol symbol-40 symbol-light-primary mr-5'>
                        <span class='symbol-label'>
                            <span class='svg-icon svg-icon-xl svg-icon-primary'>
                                <i class='fas fa-graph'></i>
                            </span>
                        </span>
                    </div>
                    <div class='d-flex flex-column font-weight-bold'>
                        <p class='text-dark text-hover-primary mb-1 font-size-lg' data-lng='".$value->lng."' data-lat='".$value->lat."'>". ucfirst($value->activity_type) ." </p>

                        <span class='text-muted'>". $value->created_at ."</span>
                    </div>
                </div>
            ";

            $array[] = ['lat' => $value->lat, 'lng' => $value->lng];
        }

        $return['response'] = $response;
        $return['location'] = $array;

        return $this->ajax_response($return);

    }

    /*
    ** Get The Inerceptions
    **  Only For Ajax Calls
    **  Get all the interceptions from the table for the ajax call
    **  Params
    **         $date_start, $date_end, $city, $role_id
    */

    private function get_the_mechanic_interceptions($date_start=0, $date_end=0, $city='All Cities', $role_id=0){
        $today = date('Y/m/d');

        if ($date_start == 0) {
            $date_start = $today;
        }

        if ($date_end == 0) {
            $date_end = $today;
        }


        $query = " SELECT count(*) AS count, DATE_FORMAT(i.created_at, '%d', '%b') AS label
                    FROM mechanic_interceptions AS i ";

        if ($role_id != 0) {
            $query .= " INNER JOIN users AS u on u.id = i.agent ";
        }

        $query .= " WHERE DATE(i.created_at) BETWEEN '". $date_start ."' AND '". $date_end ."' ";

        if ($role_id != 0) {
            $query .= " AND u.role_id = ". $role_id;
        }

        if ($city != 'All Cities') {
            $query .= " AND u.location_to_be_place = '". $city ."'";
        }

        $query .= " GROUP BY (Day(i.created_at)) ";


        $parts = DB::select(DB::raw($query));

        $return = array();
        foreach ($parts as $key => $value) {
            $return[] = array('y' => $value->count ,'x' => $value->label);
        }

        return $return;
    }

    private function get_the_interceptions($date_start=0, $date_end=0, $city='All Cities', $role_id=0){
        $today = date('Y/m/d');

        if ($date_start == 0) {
            $date_start = $today;
        }

        if ($date_end == 0) {
            $date_end = $today;
        }


        $query = " SELECT count(*) AS count, DATE_FORMAT(i.created_at, '%d', '%b') AS label
                    FROM interceptions AS i ";

        if ($role_id != 0) {
            $query .= " INNER JOIN users AS u on u.id = i.agent ";
        }

        $query .= " WHERE DATE(i.created_at) BETWEEN '". $date_start ."' AND '". $date_end ."' ";

        if ($role_id != 0) {
            $query .= " AND u.role_id = ". $role_id;
        }

        if ($city != 'All Cities') {
            $query .= " AND i.location = '". $city ."'";
        }

        $query .= " GROUP BY (Day(i.created_at)) ";


        $parts = DB::select(DB::raw($query));

        $return = array();
        foreach ($parts as $key => $value) {
            $return[] = array('y' => $value->count ,'x' => $value->label);
        }

        return $return;

    }

    /*
    ** Get The Converted Inerceptions
    **  Only For Ajax Calls
    **  Get all the converted interceptions from the table for the ajax call
    **  Params
    **         $date_start, $date_end, $city, $role_id
    */

    private function get_the_converted_mechanic_interceptions($date_start=0, $date_end=0, $city='All Cities', $role_id=0){
        $today = date('Y/m/d');

        if ($date_start == 0) {
            $date_start = $today;
        }

        if ($date_end == 0) {
            $date_end = $today;
        }


        $query = " SELECT count(*) AS count, DATE_FORMAT(i.created_at, '%d', '%b') AS label
                    FROM mechanic_interceptions AS i";

        if ($role_id != 0) {
            $query .= " INNER JOIN users AS u on u.id = i.agent ";
        }

        $query .= " INNER JOIN mechanics AS m on m.id = i.mechanic_id ";

        $query .= " WHERE DATE(i.created_at) BETWEEN '". $date_start ."' AND '". $date_end ."' ";

        $query .= " AND m.loyalty_interest = 'yes' ";

        if ($role_id != 0) {
            $query .= " AND u.role_id = ". $role_id;
        }

        if ($city != 'All Cities') {
            $query .= " AND m.city = '". $city ."'";
        }

        $query .= " GROUP BY (Day(i.created_at)) ";

        $parts = DB::select(DB::raw($query));

        $return = array();
        foreach ($parts as $key => $value) {
            $return[] = array('y' => $value->count ,'x' => $value->label);
        }

        return $return;
    }

    private function get_the_converted_interceptions($date_start=0, $date_end=0, $city='All Cities', $role_id=0){
        $today = date('Y/m/d');

        if ($date_start == 0) {
            $date_start = $today;
        }

        if ($date_end == 0) {
            $date_end = $today;
        }


        $query = " SELECT count(*) AS count, DATE_FORMAT(i.created_at, '%d', '%b') AS label
                    FROM interceptions AS i";

        if ($role_id != 0) {
            $query .= " INNER JOIN users AS u on u.id = i.agent ";
        }

        $query .= " WHERE DATE(i.created_at) BETWEEN '". $date_start ."' AND '". $date_end ."' ";

        $query .= " AND i.interception_status = 'converted' ";

        if ($role_id != 0) {
            $query .= " AND u.role_id = ". $role_id;
        }

        if ($city != 'All Cities') {
            $query .= " AND location = '". $city ."'";
        }

        $query .= " GROUP BY (Day(i.created_at)) ";

        $parts = DB::select(DB::raw($query));

        $return = array();
        foreach ($parts as $key => $value) {
            $return[] = array('y' => $value->count ,'x' => $value->label);
        }

        return $return;
    }


    /*
    ** Get The Top Brands
    **  Only For Ajax Calls
    **  Get all the converted top brands from interceptions table for the ajax call
    **  Params
    **         $date_start, $date_end, $city, $role_id
    */

    private function get_the_top_brands($date_start=0, $date_end=0, $city='All Cities', $role_id=0){
        $today = date('Y/m/d');

        if ($date_start == 0) {
            $date_start = $today;
        }

        if ($date_end == 0) {
            $date_end = $today;
        }

        $query = "SELECT count(*) AS counts, i.switch_from AS answer
                             FROM interceptions as i ";

        if ($role_id != 0) {
            $query .= " INNER JOIN users as u on u.id = i.agent ";
        }

        $query .= " WHERE DATE(i.created_at) BETWEEN '". $date_start ."' AND '". $date_end ."'";

        $query .= " AND i.interception_status = 'converted' ";

        if ($city != 'All Cities') {
            $query .= " AND location = '". $city ."'";
        }

        if($role_id != 0) {
            $query .= " AND u.role_id = ". $role_id;
        }

        $query .= " GROUP BY (i.switch_from) ORDER BY counts DESC limit 0, 3 ";


        $parts = DB::select(DB::raw($query));

        $switch_from_counts = array();
        $switch_from_label  = array();

        foreach ($parts as $key => $value) {
            if($value->answer != ""){
                $switch_from_counts[] = $value->counts;
                $switch_from_label[]  = $value->answer;
            }
        }

        $return['switch_from_counts'] = $switch_from_counts;
        $return['switch_from_label']  = $switch_from_label;

        return $return;

    }

    /*
    ** Get The Top Users
    **  Only For Ajax Calls
    **  Get all the converted top users from interceptions table for the ajax call
    **  Params
    **         $date_start, $date_end, $city, $role_id
    */

    private function get_the_top_mechanic_users($date_start=0, $date_end=0, $city='All Cities', $role_id=0){

        $today = date('Y/m/d');

        if ($date_start == 0) {
            $date_start = $today;
        }

        if ($date_end == 0) {
            $date_end = $today;
        }

        $query = "SELECT count(*) as counts, u.first_name
                             FROM mechanic_interceptions as i ";



        $query .= " INNER JOIN users as u on u.id = i.agent ";
        $query .= " INNER JOIN mechanics as m on m.id = i.mechanic_id ";

        $query .= " WHERE DATE(i.created_at) BETWEEN '". $date_start ."' AND '". $date_end ."' ";

        $query .= " AND m.loyalty_interest = 'yes' ";

        if ($city != 'All Cities') {
            $query .= " AND u.location_to_be_place = '". $city ."'";
        }

        if($role_id != 0) {
            $query .= " AND u.role_id = ". $role_id;
        }

        $query .= " GROUP BY (i.agent) ORDER BY counts DESC limit 0, 3 ";

        $parts = DB::select(DB::raw($query));

        $user_counts = array();
        $user_label  = array();

        foreach ($parts as $key => $value) {
            $user_counts[] = $value->counts;
            $user_label[]  = $value->first_name;
        }

        $return['user_counts'] = $user_counts;
        $return['user_label']  = $user_label;

        return $return;
    }

    private function get_the_top_users($date_start=0, $date_end=0, $city='All Cities', $role_id=0){

        $today = date('Y/m/d');

        if ($date_start == 0) {
            $date_start = $today;
        }

        if ($date_end == 0) {
            $date_end = $today;
        }

        $query = "SELECT count(*) as counts, u.first_name
                             FROM interceptions as i ";



        $query .= " INNER JOIN users as u on u.id = i.agent ";

        $query .= " WHERE DATE(i.created_at) BETWEEN '". $date_start ."' AND '". $date_end ."' ";

        $query .= " AND i.interception_status = 'converted' ";

        if ($city != 'All Cities') {
            $query .= " AND location = '". $city ."'";
        }

        if($role_id != 0) {
            $query .= " AND u.role_id = ". $role_id;
        }

        $query .= " GROUP BY (i.agent) ORDER BY counts DESC limit 0, 3 ";

        $parts = DB::select(DB::raw($query));

        $user_counts = array();
        $user_label  = array();

        foreach ($parts as $key => $value) {
            $user_counts[] = $value->counts;
            $user_label[]  = $value->first_name;
        }

        $return['user_counts'] = $user_counts;
        $return['user_label']  = $user_label;

        return $return;
    }

    /*
    ** Get The Citites
    **  Only For Ajax Calls
    **  Get all the converted group by cities from interceptions table for the ajax call
    **  Params
    **         $date_start, $date_end, $city, $role_id
    */

    private function get_top_mechanic_cities($date_start=0, $date_end=0, $city='All Cities', $role_id=0){
        $data = "select mechanics.city as location, COUNT(*) as total_count from mechanics ";
        // $r_q_c = " INNER JOIN interceptions on users.id = interceptions.agent ";
        // $data .= $r_q_c;
        $where_date = " where DATE(mechanics.created_at) BETWEEN '". $date_start ."' AND '". $date_end ."' ";
        $data .= $where_date;
        
        if($city == "All Cities"){
            // $data .= " GROUP BY(location)";
            $data .= " GROUP BY(mechanics.city)";
        }else{
            // $data.= " AND i.location = '".$city."'";
            $data .= " AND mechanics.city = '".$city."'";
        }
        $total_interceptions['all_interceptions'] = DB::select(DB::raw($data));
        return $total_interceptions;
    }

    private function get_top_cities($date_start=0, $date_end=0, $city='All Cities', $role_id=0){
        /*$total_interceptions_karachi    = Interception::where('location', 'Karachi')->get()->count();
        $total_interceptions_lahore     = Interception::where('location', 'Lahore')->get()->count();
        $total_interceptions_islamabad  = Interception::where('location', 'Islamabad')->get()->count();*/

        // $qTotalInterceptionsKarachi = $qTotalInterceptionsLahore = $qTotalInterceptionsIslamabad = "SELECT * FROM interceptions AS i ";

        // $data = "SELECT location, COUNT(*) as total_count From interceptions AS i ";
        $data = "select users.location_to_be_place as location, COUNT(*) as total_count from users ";

        // if ($role_id != 0) {
            // $r_q_c = " INNER JOIN users as u on u.id = i.agent ";
            $r_q_c = " INNER JOIN interceptions on users.id = interceptions.agent ";

        //     $qTotalInterceptionsKarachi   .= $r_q_c;
        //     $qTotalInterceptionsLahore    .= $r_q_c;
        //     $qTotalInterceptionsIslamabad .= $r_q_c;
            $data .= $r_q_c;
        // }

        // $qTotalInterceptionsKarachi     .= " where i.location = 'Karachi' ";
        // $qTotalInterceptionsLahore      .= " where i.location = 'Lahore' ";
        // $qTotalInterceptionsIslamabad   .= " where i.location = 'Islamabad' ";
        $where_date = " where DATE(interceptions.created_at) BETWEEN '". $date_start ."' AND '". $date_end ."' ";
        $data .= $where_date;
        
        if ($role_id != 0) {
            $r_q_w = " AND users.role_id = ". $role_id;
            $data .= $r_q_w;

        //     $qTotalInterceptionsKarachi   .= $r_q_w;
        //     $qTotalInterceptionsLahore    .= $r_q_w;
        //     $qTotalInterceptionsIslamabad .= $r_q_w;
        }

        // $where_date = " AND DATE(i.created_at) BETWEEN '". $date_start ."' AND '". $date_end ."' ";
        // $qTotalInterceptionsKarachi   .= $where_date;
        // $qTotalInterceptionsLahore    .= $where_date;
        // $qTotalInterceptionsIslamabad .= $where_date;

        // //$return['total_karachi_interceptions']   =  count( DB::select(DB::raw($qTotalInterceptionsKarachi)) );
        // //$return['total_lahore_interceptions']    =  count( DB::select(DB::raw($qTotalInterceptionsLahore)) );
        // //$return['total_islamabad_interceptions'] =  count( DB::select(DB::raw($qTotalInterceptionsIslamabad)) );
        // //working

        // $return['total_karachi_interceptions']   =  0;
        // $return['total_lahore_interceptions']    =  0;
        // $return['total_islamabad_interceptions'] =  0;

        if($city == "All Cities"){
            // $data .= " GROUP BY(location)";
            $data .= " GROUP BY(users.location_to_be_place)";
        }else{
            // $data.= " AND i.location = '".$city."'";
            $data .= " AND users.location_to_be_place = '".$city."'";
        }

        // switch ($city) {
        //     case 'Karachi':
        //         $return['total_karachi_interceptions']   =  count( DB::select(DB::raw($qTotalInterceptionsKarachi)) );
        //     break;

        //     case 'Lahore':
        //         $return['total_lahore_interceptions']    =  count( DB::select(DB::raw($qTotalInterceptionsLahore)) );
        //     break;

        //     case 'Islamabad':
        //         $return['total_islamabad_interceptions'] =  count( DB::select(DB::raw($qTotalInterceptionsIslamabad)) );
        //     break;

        //     default:
        //         $return['total_karachi_interceptions']   =  count( DB::select(DB::raw($qTotalInterceptionsKarachi)) );
        //         $return['total_lahore_interceptions']    =  count( DB::select(DB::raw($qTotalInterceptionsLahore)) );
        //         $return['total_islamabad_interceptions'] =  count( DB::select(DB::raw($qTotalInterceptionsIslamabad)) );
        //     break;
        // }

        // return $return;
        $total_interceptions['all_interceptions'] = DB::select(DB::raw($data));
        return $total_interceptions;
    }

    /*
    ** Get The Dashboard Activity
    **  Only For Ajax Calls
    **  Get all the Dashboard Activity table for the ajax call
    **  Params
    **         $date_start, $date_end, $city, $role_id
    */

    private function get_dashboard_activity_labels($date_start=0, $date_end=0, $city='All Cities', $role_id=0){

        $qPurchaseLiters = "SELECT SUM((p.quantity * p.variant)) AS p_liter
                                FROM `purchases` as p
                                    INNER JOIN users AS u on u.id = p.created_by
                                        WHERE DATE(p.created_at) BETWEEN '". $date_start ."' AND '". $date_end ."'";

        $qTotalBA        = "SELECT count(*) AS t_ba
                                FROM `users`
                                    WHERE role_id = 2 AND DATE(created_at) BETWEEN '". $date_start ."' AND '". $date_end ."' ";

        $qTotalInterceptions = "SELECT count(*) AS t_interceptions
                                    FROM interceptions
                                        WHERE DATE(created_at) BETWEEN '". $date_start ."' AND '". $date_end ."'";

        $qActivityGraph = "SELECT SUM((p.quantity * p.variant)) AS y, DATE_FORMAT(p.created_at, '%b') AS x
                            FROM purchases AS p
                                INNER JOIN users AS u on u.id = p.created_by
                                    WHERE DATE(p.created_at)
                                        BETWEEN '". $date_start ."' AND '". $date_end ."'";

        if ($city != 'All Cities') {
            $qPurchaseLiters .= " AND u.location_to_be_place = '". $city ."'";

            $qTotalInterceptions .= " AND location = '". $city ."'";

            $qActivityGraph .= " AND u.location_to_be_place = '". $city ."'";
        }

        $qActivityGraph .= " GROUP BY MONTH(p.created_at) ";

        $purchase_liters = DB::select(DB::raw($qPurchaseLiters));

        $total_BA = DB::select(DB::raw($qTotalBA));

        $totalInterceptions = DB::select(DB::raw($qTotalInterceptions));

        $activityGraph = DB::select(DB::raw($qActivityGraph));

        $return['purchaseLiters']      = $purchase_liters[0]->p_liter.' L';
        $return['totalBA']             = $this->thousandsCurrencyFormat($total_BA[0]->t_ba);
        $return['totalInterceptions']  = $this->thousandsCurrencyFormat($totalInterceptions[0]->t_interceptions);
        $return['activityGraph']       = $activityGraph;

        return $return;
    }

    /*
    ** Get The Dashboard Activity Registered Mechanics Graph
    **  Only For Ajax Calls
    **  Get all the Dashboard Activity table for the ajax call
    **  Params
    **         $date_start, $date_end, $city, $role_id
    */

    private function get_registered_mechanics($date_start=0, $date_end=0, $city='All Cities', $role_id=0){

        $today = date('Y/m/d');

        if ($date_start == 0) {
            $date_start = $today;
        }

        if ($date_end == 0) {
            $date_end = $today;
        }

        $queryKarachi = $queryLahore = $queryIslamabad = "SELECT * FROM users WHERE role_id = 4 AND location_to_be_place = ";

            $queryKarachi .= " 'Karachi' ";

            $queryLahore  .= " 'Lahore' ";

            $queryIslamabad .= " 'Islamabad' ";

        $query_con = " AND DATE(created_at) BETWEEN '". $date_start ."' AND '". $date_end ."' ";

            $queryKarachi .= $query_con;

            $queryLahore .= $query_con;

            $queryIslamabad .= $query_con;

        switch ($city) {
            case 'Karachi':
                $return['karachi'] = count( DB::select(DB::raw($queryKarachi)) );
            break;

            case 'Lahore':
                $return['lahore'] = count( DB::select(DB::raw($queryLahore)) );
            break;

            case 'Islamabad':
                $return['islamabad'] = count( DB::select(DB::raw($queryIslamabad)) );
            break;

            default:
                $return['karachi'] = count( DB::select(DB::raw($queryKarachi)) );
                $return['lahore'] = count( DB::select(DB::raw($queryLahore)) );
                $return['islamabad'] = count( DB::select(DB::raw($queryIslamabad)) );
            break;
        }

        return $return;
    }

    private function get_dashboard_sales($date_start=0, $date_end=0, $city='All Cities', $role_id=0){

        $today = date('Y/m/d');

        if ($date_start == 0) {
            $date_start = $today;
        }

        if ($date_end == 0) {
            $date_end = $today;
        }

        $where = "";

        $query = "SELECT SUM((p.quantity * p.variant)) AS y, DATE_FORMAT(p.created_at, '%d %b') AS x
                    FROM purchases AS p
                    INNER JOIN users AS u on u.id = p.created_by
                    WHERE ";

        if ($city != 'All Cities') {
            $where = " AND u.location_to_be_place = '". $city ."'";
        }

        $query .= " DATE(p.created_at) BETWEEN '". $date_start ."' AND '". $date_end ."' ".$where." GROUP BY p.created_at ";

        return DB::select(DB::raw($query));
    }

    private function get_data_new_old_customer($date_start=0, $date_end=0, $city='All Cities', $role_id=0){
        if ($date_start == 0) {
            $date_start = $today;
        }

        if ($date_end == 0) {
            $date_end = $today;
        }

        $where = "";

        if ($city != 'All Cities') {
            $where = " AND u.location_to_be_place = '". $city ."'";
        }

        $where = " WHERE DATE(p.created_at) BETWEEN '". $date_start ."' AND '". $date_end ."' ".$where;

        $query = "SELECT * FROM purchases as p INNER JOIN users AS u on u.id = p.created_by ". $where ."  GROUP BY p.user_id HAVING count(*) ";

        $new = $query."  = 1 ";

        $old = $query." > 1";

        $return['new'] = count(DB::select(DB::raw($new)));

        $return['old'] = count(DB::select(DB::raw($old)));

        return  $return;

    }

    private function get_trucker_interceptions($start, $end){

        $query_con = " AND DATE(i.created_at) BETWEEN '". $start ."' AND '". $end ."' GROUP BY (i.location)";

        $qConverted = "SELECT count(*) AS y, i.location AS x
                            FROM interceptions AS i
                                WHERE i.interception_status = 'converted' AND location != '' ";

        $qExisting = "SELECT count(*) AS y, i.location AS x
                        FROM interceptions AS i
                            WHERE i.interception_status = 'existing' AND location != '' ";

        $qConverted .= $query_con; $qExisting .= $query_con;

        $truckersConverted = DB::select(DB::raw($qConverted));

        $truckersExisting  = DB::select(DB::raw($qExisting));

        $return = array( 'truckersConverted' => $truckersConverted, 'truckersExisting' => $truckersExisting );

        return $return;
    }

    private function get_trucker_sales($start, $end, $city='All Cities'){

        if ($city != 'All Cities') {
            $where = " AND location = '". $city ."' GROUP BY Date(created_at)";
        }else{
            $where = "  GROUP BY Date(created_at)";
        }

        $qshell = "SELECT count(*) AS y , DATE_FORMAT(created_at, '%d %b') AS x
                        FROM `interceptions`
                            WHERE interception_status in ('converted', 'existing') AND DATE(created_at) BETWEEN '". $start ."' AND '". $end ."'". $where;

        $qNShell = "SELECT count(*) AS y , DATE_FORMAT(created_at, '%d %b') AS x
                        FROM `interceptions`
                            WHERE interception_status NOT IN ('converted', 'existing') AND DATE(created_at) BETWEEN '". $start ."' AND '". $end ."'". $where;

        $shell_sales = DB::select(DB::raw($qshell));

        $n_shell_sales  = DB::select(DB::raw($qNShell));

        $return['shell_sales'] = $shell_sales;

        $return['n_shell_sales'] = $n_shell_sales;

        return $return;

    }

    private function get_activity($date_start, $date_end){

        if ($date_start == 0) {
            $date_start = $today;
        }

        if ($date_end == 0) {
            $date_end = $today;
        }

        $qActivity = "SELECT a.activity_type, u.first_name, u.last_name, a.created_at FROM activity as a
                        INNER JOIN users as u ON u.id = a.user_id
                        WHERE DATE(a.created_at) BETWEEN '$date_start' AND '$date_end'
                        GROUP BY a.created_at
                        ORDER BY a.created_at DESC";

        return DB::select(DB::raw($qActivity));
    }

    private function ajax_response($data){
    	echo json_encode($data);
    	exit;
    }
    /*
    ** Get The Dashboard Activity
    **  Only For Ajax Calls
    **  Get all the Dashboard Activity table for the ajax call
    **  Params
    **         $date_start, $date_end, $city, $role_id
    */

    private function get_all_dashboard_activity_labels(){

        $qPurchaseLiters = "SELECT SUM((p.quantity * p.variant)) AS p_liter
                                FROM `purchases` as p
                                    INNER JOIN users AS u on u.id = p.created_by";

        $qTotalBA        = "SELECT count(*) AS t_ba
                                FROM `users`
                                    WHERE role_id = 2 AND DATE(created_at)";

        $qTotalInterceptions = "SELECT count(*) AS t_interceptions
                                    FROM interceptions";

        $qActivityGraph = "SELECT SUM((p.quantity * p.variant)) AS y, DATE_FORMAT(p.created_at, '%b') AS x
                            FROM purchases AS p
                                INNER JOIN users AS u on u.id = p.created_by";

        $qActivityGraph .= " GROUP BY MONTH(p.created_at) ";

        $qloyalty_members = "SELECT count(*) as l_members FROM `users` WHERE role_id = 4 or role_id = 5 AND DATE(created_at)";

        $purchase_liters = DB::select(DB::raw($qPurchaseLiters));

        $total_BA = DB::select(DB::raw($qTotalBA));

        $totalInterceptions = DB::select(DB::raw($qTotalInterceptions));

        $activityGraph = DB::select(DB::raw($qActivityGraph));

        $loyalty_members = DB::select(DB::raw($qloyalty_members));

        $return['purchaseLiters']      = $purchase_liters[0]->p_liter.' L';
        $return['totalBA']             = $this->thousandsCurrencyFormat($total_BA[0]->t_ba);
        $return['totalInterceptions']  = $this->thousandsCurrencyFormat($totalInterceptions[0]->t_interceptions);
        $return['activityGraph']       = $activityGraph;
        $return['loyalty_members']     = $loyalty_members[0] -> l_members;
        return $return;
    }
    private function get_all_dashboard_sales(){

        $query = "SELECT SUM((p.quantity * p.variant)) AS y, DATE_FORMAT(p.created_at, '%d %b') AS x
                    FROM purchases AS p
                    INNER JOIN users AS u on u.id = p.created_by GROUP BY p.created_at";

        return DB::select(DB::raw($query));
    }
    /*
    ** Get The Top Brands
    **  Only For Ajax Calls
    **  Get all the converted top brands from interceptions table for the ajax call
    **  Params
    **         $date_start, $date_end, $city, $role_id
    */

    private function get_all_the_top_brands(){
        $query = "SELECT count(*) AS counts, i.switch_from AS answer
                             FROM interceptions as i ";

        $query .= " GROUP BY (i.switch_from) ORDER BY counts DESC limit 0, 3 ";

        $parts = DB::select(DB::raw($query));

        $switch_from_counts = array();
        $switch_from_label  = array();

        foreach ($parts as $key => $value) {
            if($value->answer != ""){
                $switch_from_counts[] = $value->counts;
                $switch_from_label[]  = $value->answer;
            }
        }

        $return['switch_from_counts'] = $switch_from_counts;
        $return['switch_from_label']  = $switch_from_label;

        return $return;

    }
    /*
    ** Get The Top Users
    **  Only For Ajax Calls
    **  Get all the converted top users from interceptions table for the ajax call
    **  Params
    **         $date_start, $date_end, $city, $role_id
    */

    private function get_all_the_top_users(){

        $query = "SELECT count(*) as counts, u.first_name
                             FROM interceptions as i ";



        $query .= " INNER JOIN users as u on u.id = i.agent ";

        $query .= " GROUP BY (i.agent) ORDER BY counts DESC limit 0, 3 ";

        $parts = DB::select(DB::raw($query));

        $user_counts = array();
        $user_label  = array();

        foreach ($parts as $key => $value) {
            $user_counts[] = $value->counts;
            $user_label[]  = $value->first_name;
        }

        $return['user_counts'] = $user_counts;
        $return['user_label']  = $user_label;

        return $return;
    }
    /*
    ** Get The Citites
    **  Only For Ajax Calls
    **  Get all the converted group by cities from interceptions table for the ajax call
    **  Params
    **         $date_start, $date_end, $city, $role_id
    */

    private function get_all_top_cities(){
        // $qTotalInterceptionsKarachi = $qTotalInterceptionsLahore = $qTotalInterceptionsIslamabad = "SELECT * FROM interceptions AS i ";
        // $qTotalInterceptionsKarachi     .= " where i.location = 'Karachi' ";
        // $qTotalInterceptionsLahore      .= " where i.location = 'Lahore' ";
        // $qTotalInterceptionsIslamabad   .= " where i.location = 'Islamabad' ";

        // $return['total_karachi_interceptions']   =  0;
        // $return['total_lahore_interceptions']    =  0;
        // $return['total_islamabad_interceptions'] =  0;
        // $return['total_karachi_interceptions']   =  count( DB::select(DB::raw($qTotalInterceptionsKarachi)) );
        //         $return['total_lahore_interceptions']    =  count( DB::select(DB::raw($qTotalInterceptionsLahore)) );
        //         $return['total_islamabad_interceptions'] =  count( DB::select(DB::raw($qTotalInterceptionsIslamabad)) );

        // return $return;

        //$data = "SELECT location, COUNT(*) as total_count FROM interceptions AS i INNER JOIN users as u on u.id = i.agent GROUP BY(location)";
        $data = "select users.location_to_be_place as location, COUNT(*) as total_count from interceptions INNER JOIN users on users.id = interceptions.agent GROUP BY(users.location_to_be_place)";
        $res['all_interceptions'] = DB::select(DB::raw($data));
        return $res;
    }
     /*
    ** Get The Dashboard Activity Registered Mechanics Graph
    **  Only For Ajax Calls
    **  Get all the Dashboard Activity table for the ajax call
    **  Params
    **         $date_start, $date_end, $city, $role_id
    */

    private function get_all_registered_mechanics($date_start, $date_end)
    {
        // role 4 = ustaad mechanics
        $query = "SELECT location_to_be_place as location, COUNT(*) as count
                    FROM users
                    WHERE role_id = 4
                    AND DATE(created_at) BETWEEN '$date_start' AND '$date_end'
                    GROUP BY(location_to_be_place)";

        $return['locations'] = DB::select(DB::raw($query));
        return $return;
    }
    private function get_all_data_new_old_customer(){

        $query = "SELECT * FROM purchases as p INNER JOIN users AS u on u.id = p.created_by GROUP BY p.user_id HAVING count(*) ";

        $new = $query."  = 1 ";

        $old = $query." > 1";

        $return['new'] = count(DB::select(DB::raw($new)));

        $return['old'] = count(DB::select(DB::raw($old)));

        return  $return;

    }
    private function get_all_activity(){

        $qActivity = "SELECT a.activity_type, u.first_name, u.last_name, a.created_at FROM activity as a
                        INNER JOIN users as u ON u.id = a.user_id
                        GROUP BY a.created_at
                        ORDER BY a.created_at DESC";

        return DB::select(DB::raw($qActivity));
    }







}
