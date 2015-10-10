<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetails extends Model {
    /**
     * The database table used by the model.
     *
     * @var string
     */
//    protected $table = 'invoice_details';

    protected $guarded = array('id');

    public function invoice_items()
    {
        return $this->hasMany('App\Models\InvoiceItems', 'invoice_id', 'id');
    }
}