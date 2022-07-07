<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interception extends Model
{
    public function user_detail(){
    	return $this->hasOne(User::class, 'id', 'agent');
    }
}
