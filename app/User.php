<?php

namespace App;

use Laravel\Passport\HasApiTokens;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Contracts\Role;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'user_name', 'phone', 'cnic', 'd_o_b', 'b_city', 'role_id', 'location_to_be_place', 'recruited_by', 'status', 'password', 'password_text', 'assign_to'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    /*protected $casts = [
        'email_verified_at' => 'datetime',
    ];*/

    public function user_role(){
        return $this->belongsTo(UserRole::class, 'role_id');
    }

    public function user_role_modules(){
        return $this->hasMany(ModuleAcl::class, 'role_id', 'role_id');
    }

    public function get_pages(){
        return $this->hasMany(Page::class, 'module_id');
    }

    public function get_api_roles(){
        return $this->belongsTo(ApiRole::class, 'role_id', 'id');
    }
}
