<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NavPrivacy extends Model {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'nav_privacy';

    protected $guarded = array('id');

    public static function isPublic($nav)
    {
        $nav = NavPrivacy::where('navigation', $nav)->first();

        $isPublic = false;

        if($nav->public == 1) {
            $isPublic = true;
        }

        return $isPublic;
    }
}