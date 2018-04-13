<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogShipmentStatus extends Model
{
	protected $table		= 'log_shipment_status';
	protected $primaryKey	= "id";
	protected $fillable		= ['id','fk_shipment','shipment_status_from','shipment_status_to','created_at', 'updated_at'];
}
