<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $products = Product::with(['galleries'])->take(8)->get();
        $products = Product::with(['galleries'])->paginate(16);

        return view('pages.home', [
            'products' => $products
        ]);
    }
}
