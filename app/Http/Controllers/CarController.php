<?php


namespace App\Http\Controllers;


use App\Models\Autok;

use App\Models\Biztositas;
use App\Models\Dokumentumok;
use App\Models\Dokumentumokview;
use App\Models\Muszaki;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CarController
{
    public function documents()
    {
        $dokumentumok = DB::select(DB::raw("SELECT max(tipus_id) as tipus_id, max(tol) as tol, max(ig) as ig FROM `dokumentumokview` WHERE auto_id = ".session('car_id',0)." GROUP by tipus_id"));
        return view('car.documents', compact('dokumentumok'));
    }

    public function carinfo()
    {
        $car = Autok::where('azonosito',session('car_id', 0)) ->first();
        return view('car.carinfo', compact('car'));
    }

    public function setcarselect(Request $request)
    {
       $car = Autok::where('azonosito',$request->post('azonosito'))->first();
       if(!empty($car)){
           $car = $car->toArray();
           $request->session()->put('car_id', $car['azonosito']);
           return json_encode(['success' => true]);
       }else{
           return json_encode(['success' => false]);
       }
    }
}
