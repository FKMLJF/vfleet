
<div class="card" style="height: 100%" >
    <!--Card content-->
    <div class="card-body px-lg-5" >
        <!-- Form -->
        <form class="text-center" style="color: #757575;" action="#!">

            <div class="md-form">
                <input autofocus  type="number" inputmode="numeric" pattern="[0-9]*" id="km_ora" class="form-control">
                <label for="kmora" onclick="$(this).toggleClass('active')" class="always-focus"><strong class="text-danger">*</strong> Km óra állása. Minimum: <i class="km">{{number_format($minkm, 0,",", " ")}}</i></label>
            </div>

            <div class="md-form">
                <input autofocus  type="number" inputmode="numeric" pattern="[0-9]*"  id="liter" class="form-control">
                <label for="tankoltliter" onclick="$(this).toggleClass('active')"><strong class="text-danger">*</strong> Tankolt liter</label>
            </div>

            <div class="md-form">
                <input autofocus  type="number" inputmode="numeric" pattern="[0-9]*"  id="ar" class="form-control">
                <label for="ar" onclick="$(this).toggleClass('active')"><strong class="text-danger">*</strong> Ár</label>
            </div>



            <!-- Sign in button -->
            <button class="btn blue-gradient  btn-block  waves-effect z-depth-0 save-btn" onclick="postfuel()" style="border-radius: 30px" type="button">Mentés</button>

            <div class="alert-success p-2" style="display: none; border-radius: 30px">Sikeres mentés!</div>
        </form>
        <!-- Form -->

    </div>

</div>

