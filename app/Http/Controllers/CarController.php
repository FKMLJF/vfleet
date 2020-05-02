<?php


namespace App\Http\Controllers;


class CarController
{
    public function documents()
    {
        return view('car.documents');
    }

    public function carinfo()
    {
        return view('car.carinfo');
    }
}
