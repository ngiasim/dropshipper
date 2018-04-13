<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
	protected $table		= 'orders';
	protected $primaryKey	= "id";
	protected $fillable		= ['id','email','total_price','subtotal_price','total_weight', 'total_tax','currency','financial_status','confirmed','total_discounts','order_id','name','order_number','source_url','device_id','app_id','processing_method','order_status_url','tracking_number','line_items'];
}
