<?php


namespace App\Http\Controllers;


use App\Models\Futasteljesitmeny;
use App\Models\Szerviz;
use App\Models\Tankolas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController
{
    public function index()
    {
        $auto_id = session('car_id',0);
        $minkm= Futasteljesitmeny::where('auto_azonosito', $auto_id)->max('km_ora');//DB::select ("Select max(km_ora) as maxkmora from tankolas where auto_azonosito=?", ['auto_azonosito' => $auto_id]);
        return view('service.index', compact('minkm'));
    }

    public function postservice(Request $request){
        $validator = \Validator::make($request->all(), [
            'nev' => 'required',
            'km_ora' => 'required|numeric',
            'ar' => 'required|numeric',
        ]);
        $auto_id = session('car_id',0);

        $validator->after(function($validator) use($request, $auto_id) {
            $minkm= Futasteljesitmeny::where('auto_azonosito', $auto_id)->max('km_ora');
            if(floatval($request->post('km_ora')) < floatval($minkm))
            {
                $validator->errors()->add('km_ora', 'Nem lehet kisebb mint az elöző kmóra állás!');
            }
        });

        if ($validator->fails()) {
            return response()->json($validator->messages(), 418);
        }

        $szerviz = New Szerviz();
        $szerviz->user_id= Auth::id();
        $szerviz->auto_azonosito = $auto_id;
        $szerviz->km_ora = $request->post('km_ora');
        $szerviz->nev = $request->post('nev');
        $szerviz->ar = $request->post('ar');
        $szerviz->leiras = empty($request->post('leiras'))?null:$request->post('leiras');
        $szerviz->save();
        $minkm= Futasteljesitmeny::where('auto_Azonosito', $auto_id)->max('km_ora');//DB::select ("Select max(km_ora) as maxkmora from tankolas where auto_azonosito=?", ['auto_azonosito' => $auto_id]);
        return json_encode(['km' => $minkm]);
    }
}
