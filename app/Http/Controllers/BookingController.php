<?php namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\ServiceTypes;
use App\Models\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Webpatser\Uuid\Uuid;

class BookingController extends Controller {

    protected $roles = null;
    protected $super_admin = false;

    public function __construct()
    {
        // Require that the user is a guest (logged out)
        $this->middleware('guest', ['only' => ['getLogin', 'postLogin']]);

        // Require that the user is logged in
        $this->middleware('auth', ['only' => ['getLogout', 'getProfile']]);

        if(User::get()) {

//            $this->roles = User::get()->checkRole(Seller::get()->id, User::get()->id);

            $this->super_admin = User::get()->isSuperAdmin(User::$user->id);
        }

//        View::share('user_roles', $this->roles);

        View::share('super_admin', $this->super_admin);
    }

    public function anyBooking()
    {
        $error_msg = [];
        $success_msg = [];

        $service_types = ServiceTypes::all();

        if(Request::isMethod('POST')) {

            $rules = [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'suburb' => 'required',
                'city' => 'required',
                'booking_date' => 'required',
                'service_type_id' => 'required'
            ];

            $validator = Validator::make(Input::all(), $rules);

            if(!$validator->fails()) {
                $booking_date = Input::get('booking_date');

                $user_booking_count = Bookings::
                    where('user_id', User::get()->id)
                    ->where('pending', 1)
                    ->where('booking_date', date('Y-m-d', strtotime($booking_date)))
                    ->count();

                if($user_booking_count >= 1) {
                    $error_msg[] = 'Sorry. Our system shows you have a pending booking. We are currently processing your service booking
                        and will contact you within 48 hours.';
                } else {
                    $booking = new Bookings(Input::all());

                    $booking->uid = Uuid::generate()->string;
                    $booking->user_id = User::get()->id;
                    $booking->pending = 1;
                    $booking->booking_date = date('Y-m-d', strtotime(Input::get('booking_date')));
                    $booking->save();

                    if($booking) {
                        $success_msg[] = 'Great! We have received your service booking. You should be able to hear from us in the next 48 hours.';
                    } else {
                        $error_msg[] = 'Whoops! There was an error in your booking. Please try again.';
                    }
                }
            } else {
                return Redirect::back()->withErrors($validator->messages())->withInput(Input::all());
            }
        }

        if (User::check()) {
            return View::make('booking.booking',[
                'user' => User::get(),
                'service_types' => $service_types,
                'error_msg' => $error_msg,
                'success_msg' => $success_msg
            ]);
        } else {
            return Redirect::to('/user/login');
        }
    }

    public function anyManageBookings()
    {
        $bookings = Bookings::where('deleted_at', NULL)->paginate(25);

        foreach($bookings as $booking) {
            $tz = new \DateTimeZone('NZ');

            // For Pending
            $pending_convert = new \DateTime($booking->created_at);
            $pending_convert->setTimezone($tz);

            $booking->pending_convert = $pending_convert->format('D, d M, Y g:i A');

            // consulted
            if($booking->consulted_at) {
                $consulted_convert = new \DateTime($booking->consulted_at);
                $consulted_convert->setTimezone($tz);

                $booking->consulted_convert = $consulted_convert->format('D, d M, Y g:i A');
            }

            if($booking->completed_at) {
                $completed_convert = new \DateTime($booking->completed_at);
                $completed_convert->setTimezone($tz);

                $booking->completed_convert = $completed_convert->format('D, d M, Y g:i A');
            }

            if($booking->cancelled_at) {
                $cancelled_convert = new \DateTime($booking->cancelled_at);
                $cancelled_convert->setTimezone($tz);

                $booking->cancelled_convert = $cancelled_convert->format('D, d M, Y g:i A');
            }
        }

        return view('booking.manage', [
            'bookings' => $bookings,
            'success' => 'pending'
        ]);
    }

    public function anyUpdateStatus($booking_uid, $status)
    {
        $booking = Bookings::
            where('uid', '=', $booking_uid)
            ->first();

        $error_msg = [];

        $tz = new \DateTimeZone('NZ');

        $now = new \DateTime(date('Y-m-d H:i:s'));
        $now->setTimezone($tz);

        $current_date_time = $now->format('Y-m-d H:i:s');

        $success = false;

        $booking_date = Input::get('booking_date');
        $booking_time = Input::get('booking_time');

        if(Request::method() == 'GET') {
            return view('booking.update_status', [
                'booking' => $booking,
                'success' => $success,
                'status' => $status,
                'error_msg' => $error_msg
            ]);
        } else {

            if ($booking) {
                if ($status == 'consulted') {
                    $booking->pending = 0;
                    $booking->consulted = 1;
                    $booking->completed = 0;
                    $booking->cancelled = 0;

                    $booking->consulted_at = $current_date_time;

                    $booking->save();

                    $success = true;
                } elseif ($status == 'completed') {

                    if ($booking_date && $booking_time) {
                        $booking->pending = 0;
                        $booking->consulted = 0;
                        $booking->completed = 1;
                        $booking->cancelled = 0;

                        $booking->completed_at = $current_date_time;

                        $booking->booking_date = date('Y-m-d', strtotime($booking_date));
                        $booking->booking_time = date('H:i:s', strtotime($booking_time));

                        $booking->save();

                        $success = true;
                    } else {
                        $error_msg[] = 'Booking date and booking time are required.';

                        $success = false;
                    }
                } elseif ($status == 'cancelled') {

                    $booking->pending = 0;
                    $booking->consulted = 0;
                    $booking->completed = 0;
                    $booking->cancelled = 1;

                    $booking->cancelled_at = $current_date_time;

                    $booking->save();

                    $success = true;
                } else {
                    $error_msg[] = 'No status selected';

                    $success = false;
                }

                if ($success) {
                    return Redirect::back()->with('success', $success);
                } else {
                    return view('booking.update_status', [
                        'booking' => $booking,
                        'success' => $success,
                        'status' => $status,
                        'error_msg' => $error_msg
                    ]);
                }
            } else {
                return Redirect::back()->with([
                    'success', $success,
                    'error_msg', $error_msg
                ]);
            }
        }
    }
}
