<!-- Material form register -->
<div class="card m-2 waves-effect ">

    <!--Card content-->
    <div class="card-body px-lg-5 pt-0">

        <!-- Form -->
        <form class="text-center" style="color: #757575;" action="#!">

            <div class="form-row">
                <div class="col">
                    <!-- First name -->
                    <div class="md-form">
                        <input type="text" id="rendszam" class="form-control" readonly value="{{$car->rendszam}}">
                        <label for="rendszam" class="active">Rendszám</label>
                    </div>
                </div>
                <div class="col">
                    <!-- Last name -->
                    <div class="md-form">
                        <input type="text" id="uzemmod" class="form-control" readonly value="{{$car->uzemmod}}">
                        <label for="uzemmod" class="active">Üzemmód</label>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <!-- First name -->
                    <div class="md-form">
                        <input type="text" id="marka" class="form-control" readonly value="{{$car->marka}}">
                        <label for="marka" class="active">Márka</label>
                    </div>
                </div>
                <div class="col">
                    <!-- Last name -->
                    <div class="md-form">
                        <input type="text" id="tipus" class="form-control" readonly value="{{$car->tipus}}">
                        <label for="tipus" class="active">Típus</label>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <!-- First name -->
                    <div class="md-form">
                        <input type="text" id="hengerurtartalom" class="form-control" readonly value="{{$car->hengerurtartalom}}">
                        <label for="hengerurtartalom" class="active">Hengerürtartalom</label>
                    </div>
                </div>
                <div class="col">
                    <!-- Last name -->
                    <div class="md-form">
                        <input type="text" id="teljesitmeny" class="form-control" readonly value="{{$car->teljesitmeny}} le">
                        <label for="teljesitmeny" class="active">Teljesítmény</label>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <!-- First name -->
                    <div class="md-form">
                        <input type="text" id="tomeg" class="form-control" readonly value="{{number_format($car->tomeg,0,","," ")}} Kg">
                        <label for="tomeg" class="active">Tömeg</label>
                    </div>
                </div>
                <div class="col">
                    <!-- Last name -->
                    <div class="md-form">
                        <input type="text" id="egyutestomeg" class="form-control" readonly value="{{number_format($car->egyuttestomeg,0,","," ")}} Kg">
                        <label for="egyutestomeg" class="active">Együttes tömeg</label>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <!-- First name -->
                    <div class="md-form">
                        <input type="text" id="alvazszam" class="form-control" readonly value="{{$car->alvazszam}}">
                        <label for="alvazszam" class="active">Alvázszám</label>
                    </div>
                </div>
                <div class="col">
                    <!-- Last name -->
                    <div class="md-form">
                        <input type="text" id="motorszam" class="form-control" readonly value="{{$car->motorszam}}">
                        <label for="motorszam" class="active">Motorszám</label>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <!-- First name -->
                    <div class="md-form">
                        <input type="text" id="forgalomba_helyzes_ev" class="form-control" readonly value="{{$car->forgalomba_helyezes_ev}}">
                        <label for="marka" class="active">Forgalomba helyezés</label>
                    </div>
                </div>
                <div class="col">
                    <!-- Last name -->
                    <div class="md-form">
                        <input type="text" id="gyartas_ev" class="form-control" readonly value="{{$car->gyartas_ev}}">
                        <label for="tipus" class="active">Gyártás év</label>
                    </div>
                </div>
            </div>


        </form>
        <!-- Form -->

    </div>

</div>
<!-- Material form register -->
