<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class UserRole extends Model
{
	use HasRoles;
	protected $table = 'roles';


	public function module_acl(){
		return $this->hasMany(ModuleAcl::class, 'role_id');
	}
}
