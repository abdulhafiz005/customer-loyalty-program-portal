<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //inserting permissions.
        DB::table('permissions')->insert(array('name' => 'Dashboard', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
        DB::table('permissions')->insert(array('name' => 'Read Purchase', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
        DB::table('permissions')->insert(array('name' => 'Write Purchase', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
        DB::table('permissions')->insert(array('name' => 'Read Interception', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
        DB::table('permissions')->insert(array('name' => 'Read User', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
        DB::table('permissions')->insert(array('name' => 'Write User', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
        DB::table('permissions')->insert(array('name' => 'Read Trucker', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
        DB::table('permissions')->insert(array('name' => 'Write Trucker', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
        DB::table('permissions')->insert(array('name' => 'Read Mechanic', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
        DB::table('permissions')->insert(array('name' => 'Write Mechanic', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
        DB::table('permissions')->insert(array('name' => 'Read Cities', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
        DB::table('permissions')->insert(array('name' => 'Write Cities', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
        DB::table('permissions')->insert(array('name' => 'Read Safeer', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
        DB::table('permissions')->insert(array('name' => 'Write Safeer', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
        DB::table('permissions')->insert(array('name' => 'Read Ustad', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
        DB::table('permissions')->insert(array('name' => 'Write Ustad', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
        DB::table('permissions')->insert(array('name' => 'Convert Mechanic', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
        DB::table('permissions')->insert(array('name' => 'Convert Trucker', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
        DB::table('permissions')->insert(array('name' => 'Read Supervisor', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
        DB::table('permissions')->insert(array('name' => 'Write Supervisor', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
        DB::table('permissions')->insert(array('name' => 'Read Brand Ambassador', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
        DB::table('permissions')->insert(array('name' => 'Write Brand Ambassador', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));
        DB::table('permissions')->insert(array('name' => 'Export Data', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),));

        //inserting model_has_permissions
        // DB::table('model_has_permissions')->insert(array('permission_id' => '22', 'model_type' => 'App\UserRole', 'model_id' => 1,));
        // DB::table('model_has_permissions')->insert(array('permission_id' => '26', 'model_type' => 'App\UserRole', 'model_id' => 1,));
        // DB::table('model_has_permissions')->insert(array('permission_id' => '27', 'model_type' => 'App\UserRole', 'model_id' => 1,));
    }
}
