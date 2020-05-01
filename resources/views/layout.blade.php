
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>VFleet</title>
    <!-- MDB icon -->
    <link rel="icon" href="{{asset('favicon.ico')}}" type="image/x-icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="{{asset('css/mdb.min.css')}}">
    <!-- Your custom styles (optional) -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <style>
        .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
        .toggle.ios .toggle-handle { border-radius: 20px; }
        i.menu-icon{
            position: absolute;
            bottom: 8%;
            right: 4%;
            font-size: 600%;
            opacity: 0.3;
        }
        div.logo{
            height: 100%; width: auto;
            background-size: contain;
            background-image: url(images/vfleet.png);
            background-repeat: no-repeat;
        }

        #header{
            display: none;
            position: absolute;
            top:0px;
            height: 50px;
            width: 100%;
            overflow: hidden;
        }

        .toggle-handle{
            background: #4285f4 !important;
        }
    </style>
</head>
<body style="height:100%; width:100%">
<div id="header" class="blue-gradient p-1 text-left" >
    <div class="logo pt-2">
        <span class="text-white pl-5" id="menu-title">VFleet Flotta Menedzsment</span>
    </div>
</div>
<div id="content" style="overflow-y: auto; top:0px; left: 0px; right: 0px; bottom: 50px; position: absolute;background-image: radial-gradient(circle, #ffffff, #f8f8fd, #f1f2fc, #e7ecfa, #dde7f9);">
    <div class="card" style="height: 100%" >

        <h5 class="card-header blue-gradient white-text text-center py-4 mb-3">
            Flotta menedzsment egyszerűen
        </h5>

        <!--Card content-->
        <div class="card-body px-lg-5" style="padding-top: 20%; background-image: url(images/vfleetdark.png); background-repeat: no-repeat;
background-size: 80px; background-position-x: center">

            <!-- Form -->
            <form class="text-center" style="color: #757575;" action="#!">

                <!-- Email -->
                <div class="md-form">
                    <input type="email" id="materialLoginFormEmail" class="form-control">
                    <label for="materialLoginFormEmail">E-mail</label>
                </div>

                <!-- Password -->
                <div class="md-form">
                    <input type="password" id="materialLoginFormPassword" class="form-control">
                    <label for="materialLoginFormPassword">Password</label>
                </div>

                <div class="d-flex ">
                    <div>
                        <!-- Remember me -->

                        <input type="checkbox" data-on="Igen" data-off="Nem" data-onstyle="bg-white" data-size="small" data-offstyle="bg-white" data-toggle="toggle" data-style="ios">
                        <label class="form-check-label" for="materialUnchecked">Jegyezz meg!</label>

                    </div>
                    <!-- <div>

                        <a href="">Forgot password?</a>
                    </div> -->
                </div>

                <!-- Sign in button -->
                <button class="btn blue-gradient  btn-block my-4 waves-effect z-depth-0" id="login" style="border-radius: 30px" type="button">Bejelentkezés</button>


            </form>
            <!-- Form -->

        </div>

    </div>
</div>
<div id="footer" class="blue-gradient p-1 text-center" style="display: none; position: absolute; bottom:0px; height: 50px; width: 100%; overflow: hidden">
    <p>
    <button style="width: 23%; height: 100%; background: transparent!important; margin: 0px !important; padding: 0px!important;" class="btn btn-white"  onclick="home()" >
        <i class="fas fa-home text-white" style="opacity: 0.5; font-size: 30px"></i>
    </button>
        <button style="width: 25%; height: 100%; background: transparent!important; margin: 0px !important; padding: 0px!important;" class="btn btn-white" onclick="fuel()" >
            <i class="fas fa-gas-pump text-white" style="opacity: 0.5; font-size: 30px"></i>
        </button>
        <button style="width: 25%; height: 100%; background: transparent!important; margin: 0px !important; padding: 0px!important;" class="btn btn-white" onclick="service()"  >
            <i class="fas fa-wrench text-white" style="opacity: 0.5; font-size: 30px"></i>
        </button>
        <button style="width: 23%; height: 100%; background: transparent!important; margin: 0px !important; padding: 0px!important;" class="btn btn-white"  >
            <i class="fas fa-user text-white" style="opacity: 0.5; font-size: 30px"></i>
        </button>
    </p>
</div>

<!-- jQuery -->
<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="{{asset('js/mdb.min.js')}}"></script>

<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<!-- Your custom scripts (optional) -->
<script type="text/javascript">
    function home(){
        $.ajax({
            url: "{{route('home.index')}}",
            method: 'POST',
            data: {
                _token: "{{csrf_token()}}",
            },
            context: document.body
        }).done(function (data) {
            $('#content').html(data);
            $('#content').css('top', '50px');
            $('#menu-title').text('VFleet Flotta Menedzsment');
            $('#footer').show();
            $('#header').show();
        });
    }

    function fuel(){
        $.ajax({
            url: "{{route('fuel.index')}}",
            method: 'POST',
            data: {
                _token: "{{csrf_token()}}",
            },
            context: document.body
        }).done(function (data) {
            $('#content').html(data);
            $('#content').css('top', '50px');
            $('#menu-title').text('Tankolás');
            $('#footer').show();
            $('#header').show();
        });
    }

    function service(){
        $.ajax({
            url: "{{route('service.index')}}",
            method: 'POST',
            data: {
                _token: "{{csrf_token()}}",
            },
            context: document.body
        }).done(function (data) {
            $('#content').html(data);
            $('#content').css('top', '50px');
            $('#footer').show();
            $('#header').show();
            $('#menu-title').text('Szervízlap rörgzítése');
        });
    }
    $(document).ready(function() {

      $('#login').on("click", function () {
            home();
      });
    });
</script>
</body>
</html>
