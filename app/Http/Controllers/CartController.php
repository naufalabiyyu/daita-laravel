<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Product;
use App\Cart;
use App\Province;
use App\City;

use Illuminate\Support\Facades\Auth;

use Darryldecode\Cart\CartCondition;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class CartController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {   
        $carts = Cart::with(['product.galleries','user'])
                        ->where('users_id', Auth::user()->id)
                        ->get();
        $user = Auth::user();
        
        if($request->origin && $request->destination && $request->weight && $request->courier){
            $origin = $request->origin;
            $destination = $request->destination;
            $weight = $request->weight;
            $courier = $request->courier; 
            
            $response = Http::asForm()->withHeaders([
                'key' => 'b891c30147a00276f0e7c65836414217'
            ])->post('https://api.rajaongkir.com/starter/cost', [
                'origin' => $origin,
                'destination' => $destination,
                'weight' => $weight,
                'courier' => $courier
    
            ]);
            
            $cekongkir = $response['rajaongkir']['results'][0]['costs'];
        } else{
            $origin = '';
            $destination = '';
            $weight = '';
            $courier = '';   
            $cekongkir = null;
        }
        
        $provinsi = Province::all(); 

        return view('pages.cart', [
            'carts' => $carts,
            'user' => $user,
            'provinsi' => $provinsi,
            'cekongkir' => $cekongkir
        ]);
    }

    public function ajax($id) {
        $cities = City::where('province_id','=', $id)->pluck('city_name','id');

        return json_encode($cities);
    }

    public function update(Request $request, $id){
        $cart = Cart::findOrFail($id);
        $cart->update([
            'quantity' => $request->quantity
        ]);
    }

    public function delete(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);

        $cart->delete();

        return redirect()->route('cart');
    }

    public function success()
    {
        return view('pages.success');
    }
}
