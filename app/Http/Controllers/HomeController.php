<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// buat payment gateway
use Stripe;
use Session;

class HomeController extends Controller
{
    //
    public function index(){
        // ngitung jumlah user berdasarkan row usertype
        $user = User::where('usertype', 'user')->get()->count();

        // ngitung jumlah product
        $product = Product::all()->count();

        // ngitung jumlah product
        $order = Order::all()->count();
        $delivered = Order::where('status', 'Delivered')->get()->count();


        return view('admin.index', compact('user', 'product', 'order', 'delivered'));
    }

    // route my orders
    public function myorders(){
        $user = Auth::user()->id;

        $count = Cart::where('user_id', $user)->get()->count();

        $order = Order::where('user_id', $user)->get();

        return view('home.order', compact('count', 'order'));
    }

    public function home() {
        $product = Product::all();

        // count buat hitung cart
        if(Auth::id())
        {
            $user = Auth::user();

            $userid = $user->id;

            $count = Cart::where('user_id', $userid)->count();
        }

        else
        {
            $count = '';
        }

        return view('home.index', compact('product', 'count'));
    }

    public function login_home(){
        $product = Product::all();

        // count buat hitung cart
        if(Auth::id())
        {
            $user = Auth::user();

            $userid = $user->id;

            $count = Cart::where('user_id', $userid)->count();
        }

        else
        {
            $count = '';
        }

        return view('home.index', compact('product', 'count'));

    }

    public function product_details($id){
        $data = Product::find($id);

        // count buat hitung cart
        if(Auth::id())
        {
            $user = Auth::user();

            $userid = $user->id;

            $count = Cart::where('user_id', $userid)->count();
        }

        else
        {
            $count = '';
        }

        return view('home.product_details', compact('data', 'count'));
    }

    // add to cart
    public function add_cart($id){
        // ngambil id produk berdasarkan yang di kirim melalui url
        $product_id = $id;

        // verifikasi apakah user udah authentifikasi
        $user = Auth::user();
        $user_id = $user->id;

        $data = new Cart;
        // user_id berdasarkan yang ada di database
        $data->user_id = $user_id;
        // product->id berdasarkan yang ada di database
        $data->product_id = $product_id;

        $data->save();
        // notif succes dari toastr
        toastr()->timeOut(10000)->closeButton()->success('Product Added to the Cart successfully.');

        return redirect()->back();
    }

    // my cart / cart detail
    public function mycart(){

        // count buat hitung cart
        if(Auth::id())
        {
            $user = Auth::user();

            $userid = $user->id;

            $count = Cart::where('user_id', $userid)->count();

            $cart = Cart::where('user_id', $userid)->get();
        }

        else
        {
            $count = '';
        }

        return view('home.mycart', compact('count', 'cart'));
    }

    // buat delete cart
    public function delete_cart($id){
        $data = Cart::find($id);

        // hapus gambar dari folder public
        $image_path = public_path('products/'.$data->product->image);
        if(file_exists($image_path)){
            unlink($image_path);
        }

        $data->delete();
        // notif succes delete dari toastr
        toastr()->timeOut(10000)->closeButton()->warning('Cart deleted successfully.');
        return redirect()->back();
    }

    // confirm order
    public function comfirm_order(Request $request){
        // ngambil data dari name yg ada di file mycart.blade
        $name = $request->name;
        $address = $request->address;
        $phone = $request->phone;

        $userid = Auth::user()->id;

        $cart = Cart::where('user_id', $userid)->get();

        foreach($cart as $carts){

            $order = new Order;

            // $name. $address namgbil dari variabel yang diatas. -name, rec_address sesuai yg di database
            $order->name = $name;
            $order->rec_address = $address;
            $order->phone = $phone;

            $order->user_id = $userid;
            $order->product_id = $carts->product_id;

            $order->save();

        }

        // hapus data dari tabel cart setelah di order dan tampilan cart
        $cart_remove = cart::where('user_id', $userid)->get();

        foreach($cart_remove as $remove){
            $data = Cart::find($remove->id);

            $data->delete();
        }
       
        // notif succes delete dari toastr
        toastr()->timeOut(10000)->closeButton()->success('Product Ordered successfully.');
        return redirect()->back();

    }

    // buat payment gateway
    public function stripe($value)
    {
        return view('home.stripe', compact('value'));
    }

    // tombol sumbit payment gateway
    public function stripePost(Request $request, $value)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $value * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment successfuly." 
        ]);

         // ngambil data dari name yg ada di file mycart.blade
         $name = Auth::user()->name;
         $phone = Auth::user()->phone;
         $address = Auth::user()->address;
 
         $userid = Auth::user()->id;
 
         $cart = Cart::where('user_id', $userid)->get();
 
         foreach($cart as $carts){
 
             $order = new Order;
 
             // $name. $address namgbil dari variabel yang diatas. -name, rec_address sesuai yg di database
             $order->name = $name;
             $order->rec_address = $address;
             $order->phone = $phone;
 
             $order->user_id = $userid;

             $order->payment_status = "paid";

             $order->product_id = $carts->product_id;
 
             $order->save();
 
         }
 
         // hapus data dari tabel cart setelah di order dan tampilan cart
         $cart_remove = cart::where('user_id', $userid)->get();
 
         foreach($cart_remove as $remove){
             $data = Cart::find($remove->id);
 
             $data->delete();
         }
        
         // notif succes delete dari toastr
         toastr()->timeOut(10000)->closeButton()->success('Payment successfully.');
         return redirect('mycart');
    }
}
