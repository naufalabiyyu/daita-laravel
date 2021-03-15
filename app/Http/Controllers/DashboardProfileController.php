<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Province;

class DashboardProfileController extends Controller
{
    public function account()
    {
        $user = Auth::user();
        $provinsi = Province::all(); 

        return view('pages.dashboard-profile',[
            'user' => $user,
            'provinsi' => $provinsi
        ]);
    }

    public function getCity($id) {
        $cities = City::where('province_id','=', $id)->pluck('city_name','id');

        return json_encode($cities);
    }

    public function update(Request $request, $redirect)
    {
        $data = $request->all();

        $item = Auth::user();

        $item->update($data);

        return redirect()->route($redirect);
    }
}
