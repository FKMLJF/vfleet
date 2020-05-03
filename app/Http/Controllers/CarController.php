<?php


namespace App\Http\Controllers;


use App\Models\Autok;

use App\Models\Muszaki;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController
{
    public function documents()
    {
        $muszaki = Muszaki::where('auto_azonosito', '=', session('car_id',0))->first();
        $kgfb = null;
        return view('car.documents', compact('muszaki', 'kgfb'));
    }

    public function carinfo()
    {
        $car = Autok::where('azonosito',session('car_id', 0))->first();
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
