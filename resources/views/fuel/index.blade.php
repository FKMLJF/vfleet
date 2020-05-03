
<div class="card" style="height: 100%" >
    <!--Card content-->
    <div class="card-body px-lg-5" >
        <!-- Form -->
        <form class="text-center" style="color: #757575;" action="#!">

            <div class="md-form">
                <input type="text" id="kmora" class="form-control">
                <label for="kmora">Km óra állása. Minimum: {{$minkm}}</label>
                @if(!empty($kmora))
                <div class="invalid-feedback">
                   {{$kmora}}
                </div>
                    @endif
            </div>

            <div class="md-form">
                <input type="text" id="tankoltliter" class="form-control">
                <label for="tankoltliter">Tankolt liter</label>
                @if(!empty($tankoltliter))
                    <div class="invalid-feedback">
                        {{$tankoltliter}}
                    </div>
                @endif
            </div>

            <div class="md-form">
                <input type="number" id="ar" class="form-control">
                <label for="ar">Ár</label>
                @if(!empty($ar))
                    <div class="invalid-feedback">
                        {{$ar}}
                    </div>
                @endif
            </div>



            <!-- Sign in button -->
            <button class="btn blue-gradient  btn-block my-4 waves-effect z-depth-0" onclick="postfuel()" style="border-radius: 30px" type="button">Mentés</button>


        </form>
        <!-- Form -->

    </div>

</div>

