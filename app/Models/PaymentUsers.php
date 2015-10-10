<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Billable;
use Laravel\Cashier\Contracts\Billable as BillableContract;

class PaymentUsers extends Model implements BillableContract {

    use Billable;

    protected $dates = ['trial_ends_at', 'subscription_ends_at'];

}