<?php namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WebsiteViews;
use Illuminate\Support\Facades\View;

class HomeController extends Controller {

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

	public function anyIndex()
	{
		$user_id = NULL;

		if(User::check()) {
			$user_id = User::get()->id;
		}

		$website_views = new WebsiteViews();

		$website_views->user_id = $user_id;
		$website_views->save();

		return View::make('home.home');
	}

}
