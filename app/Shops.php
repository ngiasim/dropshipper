<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shops extends Model
{
	protected $table		= 'shops';
	protected $primaryKey	= "shop_id";
	protected $fillable		= ['shop_id','fk_user','shop_name','platform','api_key', 'secret_key','site_address','verified','response','shared_key'];
}
