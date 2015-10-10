<?php namespace App\Http\Controllers;

use App\Models\ProductImages;
use App\Models\ProductReviews;
use App\Models\Products;
use App\Models\ProductTypes;
use App\Models\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Webpatser\Uuid\Uuid;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller {

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

    public function anyManageShop()
    {
        $product_types = ProductTypes::where('hidden', 0)->orderBy('name', 'ASC')->get();

        $success_msg = [];

        $error_msg = [];

        $rules = [
            'product_name' => 'required',
            'product_category' => 'required',
            'short_description' => 'required',
            'product_description' => 'required',
            'price' => 'required',
            'quantity' => 'required|numeric'
        ];

        $validator = Validator::make(Input::all(), $rules);

        if(Request::method() == 'POST') {
            if(!$validator->fails()) {
                $category_select = Input::get('product_category');

                $category = ProductTypes::find($category_select);

                if($category) {
                    /** @var Products $product */
                    $product = new Products();

                    $product->uid = Uuid::generate()->string;
                    $product->name = Input::get('product_name');
                    $product->short_description = Input::get('short_description');
                    $product->description = Input::get('product_description');
                    $product->price_in_cents = Input::get('price') * 100;
                    $product->quantity = Input::get('quantity');
                    $product->product_type_id = $category->id;
                    $product->allow_review = 1;

                    $product->save();

                    if($product->save()) {

                        if (Input::file('main_product_image')) {
                            $filename = Input::file('main_product_image')->getClientOriginalName();
                            $destination = storage_path() . '/app/upload/';
                            $file_path = Input::file('main_product_image')->move($destination, $filename);
//                            $diskLocal = Storage::disk('local');

                            $product_image = new ProductImages();

                            $product_image->url = $filename;
                            $product_image->product_id = $product->id;
                            $product_image->name = $filename;
                            $product_image->is_primary = 1;

                            $product_image->save();
                        }
                    }

                    $success_msg[] = 'Product Added!';
                } else {
                    $error_msg[] = 'Whoops! Sorry, product category not found';
                }
            } else {
                return Redirect::back()->withErrors($validator->messages())->withInput(Input::all());
            }
        }

        return View::make('shop.manage_store', [
            'product_types' => $product_types,
            'success_msg' => $success_msg,
            'error_msg' => $error_msg
        ]);
    }

    public function anyProduct($type)
    {
        $product_type = ProductTypes::where('name', $type)->first();

        $products = NULL;
        $error_msg = [];
        $main_image = NULL;
        $product_main_image = NULL;

        if($product_type) {
            $products = Products::
                where('product_type_id', $product_type->id)
                ->get();

            foreach($products as $product) {
                $product_main_image = ProductImages::
                    where('product_id', $product->id)
                    ->where('is_primary', 1)
                    ->first();
            }

            if($product_main_image) {
                $main_image = $product_main_image->url;
            }

        } else {
            $error_msg[] = 'Product type not found.';
        }

        return View::make('shop.manage_products', [
            'products' => $products,
            'error_msg' => $error_msg,
            'main_image' => '../../../storage/app/upload/' . $main_image
        ]);
    }

    public function anyProductDescription($product_uid)
    {
        $product = Products::where('uid', $product_uid)->first();

        $error_msg = [];

        $reviews = NULL;

        $main_image = NULL;

        if(!$product) {
            $error_msg[] = 'Sorry, product not found.';
        } else {
            $reviews = ProductReviews::
                where('product_id', $product->id)
                ->where('approved', 1)
                ->get();

            $product_main_image = ProductImages::
            where('product_id', $product->id)
                ->where('is_primary', 1)
                ->first();

            $main_image = $product_main_image->url;

        }

        return View::make('shop.product_view', [
            'product' => $product,
            'error_msg' => $error_msg,
            'reviews' => $reviews,
            'main_image' => '../../../storage/app/upload/' . $main_image
        ]);
    }
}
