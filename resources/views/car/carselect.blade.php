<!-- Card -->
<div class="card m-2 blue-gradient text-white">

    <!-- Card image -->
    <div class="view overlay text-center">
        <i class="fas fa-car-alt" style="font-size: 120px; opacity: 0.2"></i>
    </div>

    <!-- Card content -->
    <div class="card-body">
        <!-- Title -->
        <h4 class="card-title">Gépjármű választás</h4>
        <!-- Text -->
        <select class="mdb-select custom-select waves-effect waves-light" id="carselect" style="border-radius: 30px">
            <option value="" disabled selected>Válaszon járművet</option>
            @foreach($cars as $car)
                <option value="{{$car['azonosito']}}">{{$car['rendszam']}} ({{$car['marka']}} {{$car['tipus']}})</option>
                @endforeach
        </select>

        <button class="btn btn-white mt-3 waves-effect waves-light float-right" onclick="selectcar()" style="border-radius: 30px">Kiválaszt</button>
    </div>

</div>
