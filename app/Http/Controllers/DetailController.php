<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $id)
    {
        $product = Product::with(['galleries'])->where('slug',$id)->firstOrFail();
        return view('pages.detail', [
            'product' => $product 
        ]);
    }

    public function add(Request $request, $id)
    {

        $userId = Auth::user()->id;

        $data = $request->all();

        // Cari dulu produk yang ada di keranjang
        // Kalo ID nya sama dengan yang mau ditambahkan lagi
        // Maka tambahkan quantitynya aja
        $produkDiKeranjang = Cart::where(['products_id' => $id, 'users_id' => $userId])->first();

        // dd($produkDiKeranjang);

        if ($produkDiKeranjang) {
            $quantityProdukDiKeranjang = $produkDiKeranjang->quantity;
            $quantitySekarang = $quantityProdukDiKeranjang + 1;
            
            // Update quantity
            Cart::where(['products_id' => $id, 'users_id' => $userId])->update(['quantity' => $quantitySekarang]);
        } else {
            $data = [
                'products_id' => $id,
                'users_id' => $userId,
                'quantity' => $data['quantity']
            ];
    
            Cart::create($data);
        }
        return redirect()->route('cart');
    }
}
