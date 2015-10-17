<?php namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class ContactController extends Controller {

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

    public function anyContact()
    {
        return View::make('contact.contact');
    }

    public function anySendMessage()
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ];

        $validator = Validator::make(Input::all(), $rules);

        if(!$validator->fails()) {

            $name = Input::get('name');
            $email = Input::get('email');
            $email_text = Input::get('message');

            $data = [
                'name' => $name,
                'email' => $email,
                'email_text' => $email_text
            ];

            Mail::send('contact.contact_template', $data, function($message) use($data) {

                $message->from($data['email'], 'Laravel');
                $message->to(env('MAIL_FROM'), env('MAIL_NAME'))->subject('FROM SMARTCCTVALARM Contact Form');
            });

            return Redirect::back()->with('success', true);
        } else {
            return Redirect::back()->withErrors($validator->messages())->withInput(Input::all());
        }
    }
}
