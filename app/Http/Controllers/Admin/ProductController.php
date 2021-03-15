<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\ProductGallery;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use illuminate\Support\Facades\Storage;

use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(request()-> ajax())
        // {
        //     $query = Product::query();
        //     // ->withTrashed(); // untuk mengambalikan data menggunakan softdeletes;
        //     // $query = product::with(['user']);

        //     return DataTables::of($query)
        //         ->addColumn('action', function($item) {
        //             return '
        //                 <div class="btn-group">
        //                     <div class="dropdown">
        //                         <button class="btn btn-primary dropdown-toggle mr-1 mb-1"
        //                             type="button"
        //                             data-toggle="dropdown">
        //                             Aksi
        //                         </button>
        //                         <div class="dropdown-menu">
        //                             <a class="dropdown-item" href="' . route('product.edit', $item->id) .  '">
        //                             Sunting
        //                             </a>
        //                             <form action="' . route('product.destroy', $item->id) .'" method="POST">
        //                                 ' . method_field('delete') . csrf_field() . '
        //                                 <button type="submit" class="dropdown-item text-danger">
        //                                     Hapus
        //                                 </button>
        //                             </form>
        //                         </div>
        //                     </div>
        //                 </div>
        //             ';
        //         })
        //         ->rawColumns(['action'])
        //         ->make();
        // }
        // return view('pages.admin.product.index');

        $products = Product::with(['galleries'])->get();
        return view('pages.admin.product.dashboard-product', [
            'products' => $products
        ]);

        
    }

    public function details(Request $request, $id)
    {
        $product = Product::with(['galleries'])->findOrFail($id);
        
        // dd($product);
        return view('pages.admin.product.dashboard-product-detail', [
            'product' => $product
        ]);
    }

    public function uploadGallery(Request $request)
    {
        $data = $request->all();

        $data['photos'] = $request->file('photos')->store('assets/product', 'public'); // jalankan php artisan storage:link 

        ProductGallery::create($data);

        return redirect()->route('dashboard-product-details', $request->products_id);
    }

    public function deleteGallery(Request $request, $id)
    {
        $item = ProductGallery::findOrFail($id);
        $item->delete();

        return redirect()->route('dashboard-product-details', $item->products_id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        // return view('pages.admin.product.create');
        return view('pages.admin.product.dashboard-product-create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        // $data = $request->all();

        // $data['slug'] = Str::slug($request->name);

        // Product::create($data);

        // return redirect()->route('product.index');

        $data = $request->all();

        $data['slug'] = Str::slug($request->name);
        $product = Product::create($data);

        $gallery = [
            'products_id' => $product->id,
            'photos' => $request->file('photos')->store('assets/product','public')
        ];

        ProductGallery::create($gallery);

        return redirect()->route('dashboard-product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Product::findOrFail($id);

        return view('pages.admin.product.edit' , [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(productRequest $request, $id)
    {
        // $data = $request->all();

        // $item = Product::findOrFail($id);

        // $data['slug'] = Str::slug($request->name);  

        // $item->update($data);

        // return redirect()->route('dashboard-product');
        
        $data = $request->all();

        $item = Product::findOrFail($id);

        $data['slug'] = Str::slug($request->name);  

        $item->update($data);

        return redirect()->route('dashboard-product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = product::findOrFail($id);
        $item->delete();

        return redirect()->route('product.index');
    }
}
