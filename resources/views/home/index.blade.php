<div class="container">
    <div class="row">

        <div class="col-12  pt-3  text-center" onclick="fuel()">
            <p>
                <button class="blue-gradient btn p-2 text-center waves-effect waves-light"
                        style="width: 97%!important; border-radius: 60px;">
                    <h5 class="text-white">Tankolás</h5>
                    @if(!empty($tankolas_havi_kts[0]->ar))
                    <span class="text-white" style="font-size: 12px">{{number_format($tankolas_havi_kts[0]->ar,0,"."," ")}} Ft (e havi)</span>
                    @else
                        <span class="text-white" style="font-size: 12px">0 Ft (e havi)</span>
                    @endif

                    <i class="fas fa-gas-pump text-white menu-icon"></i>
                </button>
            </p>
        </div>

        <div class="col-12 text-center" onclick="service()">
            <p>
                <button class="blue-gradient btn p-2 text-center waves-effect waves-light"
                        style="width: 97%!important; border-radius: 60px;">
                    <h5 class="text-white">Munkalapok</h5>
                    @if(!empty($szerviz_havi_kts[0]->ar))
                        <span class="text-white" style="font-size: 12px">{{number_format($szerviz_havi_kts[0]->ar,0,"."," ")}} Ft (e havi)</span>
                    @else
                        <span class="text-white" style="font-size: 12px">0 Ft (e havi)</span>
                    @endif
                    <i class="fas fa-wrench text-white menu-icon"></i>
                </button>
            </p>
        </div>

        <div class="col-12 text-center" onclick="carinfo()" >
            <p>
                <button class="blue-gradient btn p-2 text-center waves-effect waves-light"
                        style="width: 97%!important; border-radius: 60px;">
                    <h5 class="text-white">{{$car->rendszam}}</h5>
                    <span class="text-white" style="font-size: 12px">Információk a járműröl</span>
                    <i class="fas fa-car text-white menu-icon"></i>
                </button>
            </p>
        </div>

        <div class="col-12  text-center" onclick="documents()">
            <p>
                <button class="blue-gradient btn p-2 text-center waves-effect waves-light"
                        style="width: 97%!important; border-radius: 60px;">
                    <h5 class="text-white pt-1">Dokumentumok</h5>
                    <span class="text-white" style="font-size: 12px">&nbsp;</span>
                    <i class="fas fa-file text-white menu-icon"></i>
                </button>
            </p>
        </div>

        <div class="col-12 text-center" onclick="hiba()">
            <p>
                <button class="blue-gradient btn p-2 text-center waves-effect waves-light"
                        style="width: 97%!important; border-radius: 60px;">
                    <h5 class="text-white">Hibabejelentés</h5>

                    @if(!empty($hibacnt[0]->cnt))
                        <span class="text-white" style="font-size: 12px">{{number_format($hibacnt[0]->cnt,0,"."," ")}} db (e havi)</span>
                    @else
                        <span class="text-white" style="font-size: 12px">0 db (e havi)</span>
                    @endif

                    <i class="fas fa-bug text-white menu-icon"></i>
                </button>
            </p>
        </div>

    </div>
</div>
