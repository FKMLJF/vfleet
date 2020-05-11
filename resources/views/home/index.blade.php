<div class="container">
    <div class="row">

        <div class="col-12  pt-3  text-center" onclick="fuel()">
            <p>
                <button class="blue-gradient btn p-4 text-center waves-effect waves-light"
                        style="width: 97%!important; border-radius: 60px;">
                    <h5 class="text-white">Tankolás</h5>
                    @if(!empty($tankolas_havi_kts[0]->ar))
                    <span class="text-white" style="font-size: 16px">{{number_format($tankolas_havi_kts[0]->ar,0,"."," ")}} Ft (e havi)</span>
                    @else
                        <span class="text-white" style="font-size: 16px">0 Ft (e havi)</span>
                    @endif

                    <i class="fas fa-gas-pump text-white menu-icon"></i>
                </button>
            </p>
        </div>

        <div class="col-12 text-center" onclick="service()">
            <p>
                <button class="blue-gradient btn p-4 text-center waves-effect waves-light"
                        style="width: 97%!important; border-radius: 60px;">
                    <h5 class="text-white">Szervíz</h5>
                    @if(!empty($szerviz_havi_kts[0]->ar))
                        <span class="text-white" style="font-size: 16px">{{number_format($szerviz_havi_kts[0]->ar,0,"."," ")}} Ft (e havi)</span>
                    @else
                        <span class="text-white" style="font-size: 16px">0 Ft (e havi)</span>
                    @endif
                    <i class="fas fa-wrench text-white menu-icon"></i>
                </button>
            </p>
        </div>

        <div class="col-12 text-center" onclick="carinfo()" >
            <p>
                <button class="blue-gradient btn p-4 text-center waves-effect waves-light"
                        style="width: 97%!important; border-radius: 60px;">
                    <h5 class="text-white">{{$car->rendszam}}</h5>
                    <span class="text-white" style="font-size: 16px">Információk a járműröl</span>
                    <i class="fas fa-car text-white menu-icon"></i>
                </button>
            </p>
        </div>

        <div class="col-12  text-center" onclick="documents()">
            <p>
                <button class="blue-gradient btn p-4 text-center waves-effect waves-light"
                        style="width: 97%!important; border-radius: 60px;">
                    <h5 class="text-white">Dokumentumok</h5>
                    @if(!empty($muszaki))
                    <span class="text-white" style="font-size: 12px">Müszaki vizsga érvényesség: {{substr($muszaki->meddig,0,10)}}</span>
                   @endif
                    <br>
                    @if(!empty($kgfb))
                    <span class="text-white" style="font-size: 12px">Biztositás érvényesség: {{substr($kgfb->meddig,0,10)}}</span>
                    @endif
                    <i class="fas fa-users text-white menu-icon"></i>
                </button>
            </p>
        </div>

    </div>
</div>
