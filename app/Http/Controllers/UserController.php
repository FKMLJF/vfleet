<?php

namespace App\Http\Controllers;


use App\Fuel;
use App\Models\Autok;
use App\Models\Muszaki;
use App\Service;
use App\User;
use http\Env\Response;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Redirect;


class UserController extends Controller
{
    use AuthenticatesUsers;

    public function login(Request $request)
    {

        $credentials = ['email' => $request->post('email'), 'password' => $request->post('password')];
        if ($this->guard('web')->attempt($credentials)) {
            if((session('car_id', 0) != 0))
            {
                $car = Autok::where('azonosito',session('car_id', 0))->first();
                $request->session()->put('loged-in', true);
                $muszaki = Muszaki::where('auto_azonosito', '=', session('car_id',0))->first();
                $tankolas_havi_kts = DB::table('tankolas')
                    ->select(DB::raw('sum(osszeg) ar '))
                    ->where('auto_azonosito','=', session('car_id', 0))
                    ->whereRaw('MONTH(inserted_at) = MONTH(CURRENT_DATE()) ')
                    ->whereRaw('YEAR(inserted_at) = YEAR(CURRENT_DATE()) ')
                    ->get();
                $szerviz_havi_kts = DB::table('szerviz')
                    ->select(DB::raw('sum(ar) ar '))
                    ->where('auto_azonosito','=', session('car_id', 0))
                    ->whereRaw('MONTH(created_at) = MONTH(CURRENT_DATE()) ')
                    ->whereRaw('YEAR(created_at) = YEAR(CURRENT_DATE()) ')
                    ->get();
                return view("home.index", compact("car", 'muszaki', 'tankolas_havi_kts', 'szerviz_havi_kts'));
            }
            else{
            $user = User::all()->where('id', '=', Auth::id())->first()->toArray();
            $cars = Autok::where('user_id', $user['id'])
                ->orWhere('user_id', $user['root_user'])->get()->toArray();

            return view('car.carselect', compact('cars'));
            }
        } else if (Auth::guard('web')->check()) {
            if((session('car_id', 0) != 0))
            {
                $car = Autok::where('azonosito',session('car_id', 0))->first();
                $request->session()->put('loged-in', true);
                $muszaki = Muszaki::where('auto_azonosito', '=', session('car_id',0))->first();
                $tankolas_havi_kts = DB::table('tankolas')
                    ->select(DB::raw('sum(osszeg) ar '))
                    ->where('auto_azonosito','=', session('car_id', 0))
                    ->whereRaw('MONTH(inserted_at) = MONTH(CURRENT_DATE()) ')
                    ->whereRaw('YEAR(inserted_at) = YEAR(CURRENT_DATE()) ')
                    ->get();
                $szerviz_havi_kts = DB::table('szerviz')
                    ->select(DB::raw('sum(ar) ar '))
                    ->where('auto_azonosito','=', session('car_id', 0))
                    ->whereRaw('MONTH(created_at) = MONTH(CURRENT_DATE()) ')
                    ->whereRaw('YEAR(created_at) = YEAR(CURRENT_DATE()) ')
                    ->get();
                return view("home.index", compact("car", 'muszaki', 'tankolas_havi_kts', "szerviz_havi_kts"));
            }
            else{
                $muszaki = Muszaki::where('auto_azonosito', '=', session('car_id',0))->first();
            $user = User::all()->where('id', '=', Auth::id())->first()->toArray();
            $cars = Autok::where('user_id', $user['id'])
                ->orWhere('user_id', $user['root_user'])->get()->toArray();

            return view('car.carselect', compact('cars'));
            }
        } else {

            $error = empty($request->post('loginbtn'))?null:"Hibás e-mail vagy jelszó!";
            Auth::logout();
            \Session::flush();
            return view('login', compact('error'));
        }
    }

    public function check()
    {
        if (session('loged-in', false) && (session('car_id', 0) != 0)) {
            return json_encode(["visible" => true]);
        }
        else{
            return json_encode(["visible" => false]);
        }
    }

    public function logout()
    {
         Auth::logout();
         \Session::flush();
         return view('login');
    }
   /* public function Login(Request $r)
    {

        $users = DB::select('Select * from users');
        if (count($users) == 0)
        {
            DB::insert("insert into users (username, password) values (?,?)", array('root', md5('metal123')));
        }

        $validator = \Validator::make($r->all(), [
            'username' => 'required',
            'password' => 'required',
            'rendszam' => 'required',
        ]);

        $validator->after(function($validator) use($r) {
            $user = DB::select('Select * from users where username = :username', array('username' => $r->post('username')));
            if(empty($user))
            {
                $validator->errors()->add('username', 'Rossz felhasználónevet adtál meg!');


            }
            else
            {
                if($user[0]->password != md5($r->post('password')))
                {
                    $validator->errors()->add('password', 'Rossz jelszót adtál meg!');
                }
                else{
                    $car = DB::select('Select * from cars where rendszam = :rendszam', array('rendszam' => $r->post('rendszam')));

                    $r->session()->put('user',serialize($user[0]));
                    if(empty($car))
                    {
                        $validator->errors()->add('rendszam', 'Ez a rendszám nem létezik!');

                    }
                    else{
                        $r->session()->put('car',serialize($car[0]));
                    }
                }
            }

           // $user->select('Select * from users where password = :password', array('password' => md5($r->post('password'))));

        });

        if ($validator->fails()) {
          //  dd($validator->errors());
            return redirect('login')
                ->withErrors($validator)
                ->withInput();
        }




        $r->session()->put('userlogin', true);

        return redirect('home');
    }*/
    public function home(Request $request)
    {

      /*  $array = 0;
        if (Hash::check('test', bcrypt('test'))) {
            $array ++;
        }
        if (Hash::check('test', bcrypt('test'))) {
            $array ++;
        }
        dd($array);*/
        $last_fuel = DB::select('Select * from fuel where car_id = :car_id  order by id desc limit 10', array('car_id' => unserialize($request->session()->get('car'))->id));
    //    dd($last_fuel);
        if(count($last_fuel) > 1)
        {
            $request->session()->put('last_fuel', intval($last_fuel[0]->km) );
          $kmcnt = intval($last_fuel[0]->km) - intval($last_fuel[count($last_fuel)-1]->km) ;
          $fuelcnt = 0;
          $v =0;
          foreach ($last_fuel as $item)
          {
              if($v < count($last_fuel)-1)
              {
                  $fuelcnt += $item->liter;
                  $v++;
              }

          }

            $request->session()->put('fuel_avg',($fuelcnt/$kmcnt)*100);
        }
        else
        {
            //unserialize($request->session()->get('car'))->kezdeti_km ;
            $request->session()->put('last_fuel', unserialize($request->session()->get('car'))->kezdeti_km  );
            $request->session()->forget('fuel_avg');

        }
        return view('home');
    }
    public function postfuel(Request $request)
        {
            $validator = \Validator::make($request->all(), [
                'fuel' => 'required',
                'price' => 'required',
            ]);



            $validator->after(function($validator) use($request) {
                if (intval($request->post('fuel')) < 0)
                {$validator->errors()->add('fuel', 'Tankolt Liter nem lehet negatív!');}
                $last_fuel = DB::select('Select * from fuel where car_id = :car_id  order by id desc limit 1', array('car_id' => unserialize($request->session()->get('car'))->id));
                if(count($last_fuel) > 0)
                { if(intval($last_fuel[0]->km) > intval($request->post('kmhour')))
                {
                    $validator->errors()->add('kmhour', 'A megadott km óra állás kisebb mint a legutólsó tankolásé!');
                }else if(intval($last_fuel[0]->km) == intval($request->post('kmhour')))
                {
                    $validator->errors()->add('kmhour', 'A megadott km óra állás ugyan annyi mint a legutólsó tankolásé!');
                }

                    if((intval($last_fuel[0]->km)  + 1000) < intval($request->post('kmhour')))
                    {
                        $validator->errors()->add('kmhour', 'Valószínű kihagytál egy tankolást :( , nem mehettél 1000 KM-nél többet a legutolsó tankolás óta, tankolás nélkül. Vagy igen?');
                    }
                }
                else
                {
                    if(intval($request->post('kmhour')) < unserialize($request->session()->get('car'))->kezdeti_km )
                    {
                        $validator->errors()->add('kmhour', 'A megadott km óra állás kisebb mint a legutólsó tankolásé!');
                    }
                    if((unserialize($request->session()->get('car'))->kezdeti_km  + 1000) < intval($request->post('kmhour')))
                    {
                        $validator->errors()->add('kmhour', 'Valószínű kihagytál egy tankolást :( , nem mehettél 1000 KM-nél többet a legutolsó tankolás óta, tankolás nélkül. Vagy igen?');
                    }
                }
            });

            if ($validator->fails()) {
                //  dd($validator->errors());
                return redirect('fuel')
                    ->withErrors($validator)
                    ->withInput($request->input());
            }
            DB::table('fuel')
                ->Insert(
                    [
                        'liter' => $request->post('fuel'),
                        'ar' => $request->post('price'),
                        'km' => $request->post('kmhour'),
                        'car_id' => unserialize($request->session()->get('car'))->id,
                        'user_id' => unserialize($request->session()->get('user'))->id,
                        'ido' => $request->post('date'),
                    ]
                );
            $request->session()->put('last_fuel', intval($request->post('kmhour')));

        return Redirect::to('fuel')->with('success', 'Sikeres rögzítés!');
        }
    public function allPosts(Request $request)
    {



        $columns = array(
            0 =>'liter',
            1 =>'ar',
            2=> 'km',
            3=> 'ido',
            4=> 'user_id',
            5=> 'id',
        );

        $totalData = Fuel::where('car_id', '=',  unserialize($request->session()->get('car'))->id)
            ->where('liter', '>', '0')
            ->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
     //   $order = $columns[$request->input('order.0.column')];
     //   $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {
            $posts = Fuel::where('car_id', '=',  unserialize($request->session()->get('car'))->id)
                ->where('liter', '>', '0')
                ->offset($start)
                ->limit($limit)
                ->orderBy('id','desc')
                ->get();
        }
        else {
            $search = $request->input('search.value');

            $sr = DB::select('select id from users where username = :username', array('username' => $search));
            $uid = '---121312';
            if(count($sr))
            {
                $uid =  $sr[0]->id;
            }
            $posts =  Fuel::where('car_id', '=',  unserialize($request->session()->get('car'))->id)
                ->where('liter','LIKE',"%{$search}%")
                ->where('liter', '>', '0')
                ->orWhere('ido', 'LIKE',"%{$search}%")
                ->orWhere('km', 'LIKE',"%{$search}%")
                ->orWhere('id', 'LIKE',"%{$search}%")
                ->orWhere('user_id', 'LIKE',"%{$uid}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy('id','desc')
                ->get();

            $totalFiltered = Fuel::where('car_id', '=',  unserialize($request->session()->get('car'))->id)
                ->where('liter', '>', '0')
                ->where('liter','LIKE',"%{$search}%")
                ->orWhere('id','LIKE',"%{$search}%")
                ->orWhere('ido', 'LIKE',"%{$search}%")
                ->orWhere('km', 'LIKE',"%{$search}%")
                ->orWhere('id', 'LIKE',"%{$search}%")
                ->orWhere('user_id', 'LIKE',"%{$uid}%")
                ->count();
        }

        $data = array();
        if(!empty($posts))
        {
            foreach ($posts as $post)
            {
              //  $show =  route('posts.show',$post->id);
       //         $edit =  route('posts.edit',$post->id);

                $nestedData['liter'] = $post->liter;
                $nestedData['ar'] = $post->ar;
                $nestedData['km'] = $post->km;
                $nestedData['ido'] = substr($post->ido,0,11);
                $nestedData['user_id'] = DB::select('select username from users where id = :user_id', array('user_id' => $post->user_id))[0]->username;
                $nestedData['id'] = $post->id;
                /*$nestedData['body'] = substr(strip_tags($post->body),0,50)."...";
                $nestedData['created_at'] = date('j M Y h:i a',strtotime($post->created_at));
                /*$nestedData['options'] = "&emsp;<a href='{$show}' title='SHOW' ><span class='glyphicon glyphicon-list'></span></a>
                                          &emsp;<a href='{$edit}' title='EDIT' ><span class='glyphicon glyphicon-edit'></span></a>";*/
                $data[] = $nestedData;

            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);

    }
    public function allPostsService(Request $request)
    {



        $columns = array(

            0 =>'ar',
            1=> 'km',
            2 =>'leiras',


            3=> 'timestamp',
            4=> 'user_id',
            5=> 'id',
        );

        $totalData = Service::where('car_id', '=',  unserialize($request->session()->get('car'))->id)
            ->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        //   $order = $columns[$request->input('order.0.column')];
        //   $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {
            $posts = Service::where('car_id', '=',  unserialize($request->session()->get('car'))->id)
                ->offset($start)
                ->limit($limit)
                ->orderBy('id','desc')
                ->get();
        }
        else {
            $search = $request->input('search.value');

            $sr = DB::select('select id from users where username = :username', array('username' => $search));
            $uid = '---121312';
            if(count($sr))
            {
                $uid =  $sr[0]->id;
            }
            $posts =  Service::where('car_id', '=',  unserialize($request->session()->get('car'))->id)
                ->where('timestamp', 'LIKE',"%{$search}%")
                ->orWhere('km', 'LIKE',"%{$search}%")
                ->orWhere('id', 'LIKE',"%{$search}%")
                ->orWhere('user_id', 'LIKE',"%{$uid}%")
                ->orWhere('description', 'LIKE',"%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy('id','desc')
                ->get();

            $totalFiltered = Service::where('car_id', '=',  unserialize($request->session()->get('car'))->id)
                ->where('timestamp', 'LIKE',"%{$search}%")
                ->orWhere('km', 'LIKE',"%{$search}%")
                ->orWhere('id', 'LIKE',"%{$search}%")
                ->orWhere('description', 'LIKE',"%{$search}%")
                ->orWhere('user_id', 'LIKE',"%{$uid}%")
                ->count();
        }

        $data = array();
        if(!empty($posts))
        {
            foreach ($posts as $post)
            {
                //  $show =  route('posts.show',$post->id);
                //         $edit =  route('posts.edit',$post->id);

                $nestedData['leiras'] = $post->leiras;
                $nestedData['ar'] = $post->ar;
                $nestedData['km'] = $post->km;
                $nestedData['timestamp'] = substr($post->timestamp,0,11);
                $nestedData['user_id'] = DB::select('select username from users where id = :user_id', array('user_id' => $post->user_id))[0]->username;
                $nestedData['id'] = $post->id;
                /*$nestedData['body'] = substr(strip_tags($post->body),0,50)."...";
                $nestedData['created_at'] = date('j M Y h:i a',strtotime($post->created_at));
                /*$nestedData['options'] = "&emsp;<a href='{$show}' title='SHOW' ><span class='glyphicon glyphicon-list'></span></a>
                                          &emsp;<a href='{$edit}' title='EDIT' ><span class='glyphicon glyphicon-edit'></span></a>";*/
                $data[] = $nestedData;

            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);

    }
    public function datatable(){
        return view('datatable');
    }
    public function chart(){
        return view('chart');
    }
    public function postchartdata(Request $request)
    {
        $kmchart = DB::select("SELECT max(km) as km, CONCAT(week(ido),'. hét') as weeks FROM fuel WHERE car_id = :car_id and YEAR(NOW()) = YEAR(ido) GROUP by weeks ", array('car_id' => unserialize($request->session()->get('car'))->id));
        $label = array();
        $value = array();
        foreach ($kmchart as $item)
        {
            $label []= $item->weeks;
            $value []= $item->km;
        }

      // $labels = implode(",", $label);
       // $values = implode(",", $value);

        return json_encode(array($label, $value));
    }


    public function postservice(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'serviceprice' => 'required',
            'description' => 'required',
            'kmhour' => 'required',
        ]);



        $validator->after(function($validator) use($request) {
            if (intval($request->post('serviceprice')) < 0)
            {$validator->errors()->add('serviceprice', 'Szervízköltség nem lehet negatív!');}
            $last_fuel = DB::select('Select * from fuel where car_id = :car_id  order by id desc limit 1', array('car_id' => unserialize($request->session()->get('car'))->id));
            if(count($last_fuel) > 0)
            { if(intval($last_fuel[0]->km) > intval($request->post('kmhour')))
            {
                $validator->errors()->add('kmhour', 'A megadott km óra állás kisebb mint a legutólsó tankolásé!');
            }else if(intval($last_fuel[0]->km) == intval($request->post('kmhour')))
            {
                $validator->errors()->add('kmhour', 'A megadott km óra állás ugyan annyi mint a legutólsó tankolásé!');
            }

                if((intval($last_fuel[0]->km)  + 1000) < intval($request->post('kmhour')))
                {
                    $validator->errors()->add('kmhour', 'Valószínű kihagytál egy tankolást :( , nem mehettél 1000 KM-nél többet a legutolsó tankolás óta, tankolás nélkül. Vagy igen?');
                }
            }
            else
            {
                if(intval($request->post('kmhour')) < unserialize($request->session()->get('car'))->kezdeti_km )
                {
                    $validator->errors()->add('kmhour', 'A megadott km óra állás kisebb mint a legutólsó tankolásé!');
                }
                if((unserialize($request->session()->get('car'))->kezdeti_km  + 1000) < intval($request->post('kmhour')))
                {
                    $validator->errors()->add('kmhour', 'Valószínű kihagytál egy tankolást :( , nem mehettél 1000 KM-nél többet a legutolsó tankolás óta, tankolás nélkül. Vagy igen?');
                }
            }
        });

        if ($validator->fails()) {
            //  dd($validator->errors());
            return redirect('service')
                ->withErrors($validator)
                ->withInput($request->input());
        }
        DB::table('service')
            ->Insert(
                [
                    'leiras' => $request->post('description'),
                    'ar' => $request->post('serviceprice'),
                    'km' => $request->post('kmhour'),
                    'car_id' => unserialize($request->session()->get('car'))->id,
                    'user_id' => unserialize($request->session()->get('user'))->id,
                    'timestamp' => $request->post('date'),
                ]
            );
        $request->session()->put('last_fuel', intval($request->post('kmhour')));

        return Redirect::to('service')->with('success', 'Sikeres rögzítés!');
    }
}
