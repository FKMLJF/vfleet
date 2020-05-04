
<div class="card" style="height: 100%" >
    <!--Card content-->
    <div class="card-body px-lg-5" >
        <!-- Form -->
        <form class="text-center" style="color: #757575;" action="#!">

            <div class="md-form">
                <input autofocus  type="text" id="km_ora" class="form-control">
                <label for="kmora"><strong class="text-danger">*</strong> Km óra állása. Minimum: <i class="km">{{number_format($minkm, 0,",", " ")}}</i></label>
            </div>

            <div class="md-form">
                <input autofocus  type="text" id="liter" class="form-control">
                <label for="tankoltliter"><strong class="text-danger">*</strong> Tankolt liter</label>
            </div>

            <div class="md-form">
                <input autofocus  type="number" id="ar" class="form-control">
                <label for="ar"><strong class="text-danger">*</strong> Ár</label>
            </div>



            <!-- Sign in button -->
            <button class="btn blue-gradient  btn-block my-4 waves-effect z-depth-0" onclick="postfuel()" style="border-radius: 30px" type="button">Mentés</button>

            <div class="alert-success p-2" style="display: none; border-radius: 30px">Sikeres mentés!</div>
        </form>
        <!-- Form -->

    </div>

</div>

