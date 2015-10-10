<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductReviews extends Model {
    /**
     * The database table used by the model.
     *
     * @var string
     */
//    protected $table = 'invoice_details';

    protected $guarded = array('id');

    public function products()
    {
        return $this->belongsTo('App\Models\Products', 'product_id', 'id');
    }
}