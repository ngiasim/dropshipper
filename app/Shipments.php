<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipments extends Model
{
	protected $table		= 'shipments';
	protected $primaryKey	= "id";
	protected $fillable		= ['id','fk_order','tracking_number','shipment_status','created_at', 'updated_at','fulfillment_id'];
}
