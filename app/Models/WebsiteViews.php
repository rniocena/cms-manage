<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteViews extends Model {
    /**
     * The database table used by the model.
     *
     * @var string
     */
//    protected $table = 'invoice_details';

    protected $guarded = array('id');

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}