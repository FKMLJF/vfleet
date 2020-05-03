<div class="card" id="loginform"  style="height: 100%; {{\Auth::guard('web')->check()? 'display: none' : ''}}" >

    <h5 class="card-header blue-gradient white-text text-center py-4 mb-3">
        Flotta menedzsment egyszerűen
    </h5>

    <!--Card content-->
    <div class="card-body px-lg-5" style="padding-top: 20%; background-image: url(images/vfleetdark.png); background-repeat: no-repeat;
background-size: 80px; background-position-x: center">

        <!-- Form -->
        <form class="text-center" style="color: #757575;" action="{{route('login')}}" method="POST">

            <!-- Email -->
            <div class="md-form">
                <input type="email" id="email" name="email" class="form-control">
                <label for="email" class="thisislabel">E-mail cím</label>
            </div>

            <!-- Password -->
            <div class="md-form">
                <input type="password" id="password"  name="password" class="form-control">
                <label for="password" >Jelszó</label>
            </div>

            <div class="d-flex ">
                <div>
                    <!-- Remember me -->

                    <input type="checkbox" class="toggle-btn" id="remember">
                    <label class="form-check-label" >Jegyezz meg!</label>

                </div>
                <!-- <div>

                    <a href="">Forgot password?</a>
                </div> -->
            </div>

            <!-- Sign in button -->
            <button class="btn blue-gradient  btn-block my-4 waves-effect z-depth-0" id="login" onclick="home();setRemember()" style="border-radius: 30px" type="button">Bejelentkezés</button>


        </form>
        <!-- Form -->

    </div>

</div>
