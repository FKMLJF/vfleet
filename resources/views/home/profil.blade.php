
    <div class="card m-3 " style="background-image: url(images/vfleetdark.png);
    padding-top: 124px;
    background-repeat: no-repeat;
    background-position-x: center;
    background-position-y: top;
    background-size: 100px;/*height: 100%;
    background-color: transparent;box-shadow: none;*/">



        <!-- Card content -->
        <div class="card-body">

            <!-- Title -->
            <h4 class="card-title"><a>VFleet</a></h4>
            <!-- Text -->
            <p class="card-text">Felhasználó: {{$user->email}}</p>

            <p class="card-text">App verzió: {{env('APP_VERSION')}}</p>
            <!-- Button -->
            <button class="btn btn-danger waves-effect waves-light float-right" onclick="logout()" style="border-radius: 30px">Kilépés</button>

        </div>

    </div>

