<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model {
    /**
     * The database table used by the model.
     *
     * @var string
     */
//    protected $table = 'invoice_details';

    protected $guarded = array('id');

    public function productReviews()
    {
        return $this->hasMany('App\Models\ProductReviews', 'product_id', 'id');
    }

    public function ProductImages()
    {
        return $this->hasMany('App\Models\ProductImages', 'product_id', 'id');
    }

    public function ProductTypes()
    {
        return $this->belongsTo('App\Models\ProductTypes', 'product_type_id', 'id');
    }
}