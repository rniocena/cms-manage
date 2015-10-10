<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceTypes extends Model {
    /**
     * The database table used by the model.
     *
     * @var string
     */
//    protected $table = 'invoice_details';

    protected $guarded = array('id');

    public function bookings()
    {
        return $this->hasMany('App\Models\Bookings', 'service_type_id', 'id');
    }
}