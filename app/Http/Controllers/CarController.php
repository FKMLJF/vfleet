<?php


namespace App\Http\Controllers;


use App\Models\Autok;

use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController
{
    public function documents()
    {
        $user = User::all()->where('id', '=', Auth::id())->first()->toArray();
        $cars = Autok::where('user_id', $user['id'])
            ->orWhere('user_id', $user['root_user'])->get()->toArray();
        return view('car.documents');
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
