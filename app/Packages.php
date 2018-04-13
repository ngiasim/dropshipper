<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
	protected $table		= 'packages';
	protected $primaryKey	= "id";
	protected $fillable		= ['id','package_name','package_code','description','min_delivery_days', 'max_delivery_days','created_at','updated_at'];
}
