
    <div class="card" style="height: 100%" >
        <!--Card content-->
        <div class="card-body px-lg-5" >

            <!-- Form -->
            <form class="text-center" style="color: #757575;" action="#!">

                <div class="md-form">
                    <input type="text" id="nev" autofocus  class="form-control">
                    <label for="nev" onclick="$(this).toggleClass('active')" class="always-focus"><strong class="text-danger">*</strong> Rövid leírás</label>
                </div>

                <div class="md-form">
                    <input type="number"  inputmode="numeric" pattern="[0-9]*" autofocus  id="ar" class="form-control">
                    <label for="ar" onclick="$(this).toggleClass('active')"><strong class="text-danger">*</strong> Ár</label>
                </div>

                <div class="md-form">
                    <input type="number"  inputmode="numeric" pattern="[0-9]*" autofocus  id="km_ora" class="form-control">
                    <label for="km_ora" onclick="$(this).toggleClass('active')"><strong class="text-danger">*</strong> Km óra (<i class="km"> Minimum: {{number_format($minkm, 0,",", " ")}} </i>)</label>
                </div>

                <div class="md-form">
                    <textarea id="leiras" autofocus  class="md-textarea form-control" rows="9"></textarea>
                    <label for="leiras" onclick="$(this).toggleClass('active')">Leírás</label>
                </div>


                <!-- Sign in button -->
                <button class="btn blue-gradient  btn-block  waves-effect z-depth-0 save-btn" style="border-radius: 30px" onclick="postservice()" type="button">Mentés</button>
                <div class="alert-success p-2" style="display: none; border-radius: 30px">Sikeres mentés!</div>


            </form>
            <!-- Form -->

        </div>

    </div>

