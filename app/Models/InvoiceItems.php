<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItems extends Model {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'invoice_items';

    protected $guarded = array('id');

    public function invoice()
    {
        return $this->belongsTo('App\Models\InvoiceDetails', 'invoice_id', 'id');
    }
}