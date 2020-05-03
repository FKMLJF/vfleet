
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>VFleet</title>
    <!-- MDB icon -->
    <link rel="icon" href="{{asset('favicon.ico')}}?id={{env('ASSET_FLAG')}}" type="image/x-icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}?id={{env('ASSET_FLAG')}}">
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="{{asset('css/mdb.min.css')}}?id={{env('ASSET_FLAG')}}">
    <!-- Your custom styles (optional) -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}?id={{env('ASSET_FLAG')}}">

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
        <i class="fas fa-arrow-left text-white waves-effect"  onclick="home()" style="position: absolute;
    left: 16px;
    top: 16px; display: none"></i>
    </div>
</div>
<div id="content" style="overflow-y: auto; {{\Auth::guard('web')->check()? 'top:50px;' : 'top:0px;'}} left: 0px; right: 0px; bottom: 50px; position: absolute;background-image: radial-gradient(circle, #ffffff, #f8f8fd, #f1f2fc, #e7ecfa, #dde7f9);">

</div>
<div id="footer" class="blue-gradient p-1 text-center" style="position: absolute; bottom:0px; height: 50px; width: 100%; overflow: hidden">
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
        <button style="width: 23%; height: 100%; background: transparent!important; margin: 0px !important; padding: 0px!important;" class="btn btn-white" onclick="profil()" >
            <i class="fas fa-user text-white" style="opacity: 0.5; font-size: 30px"></i>
        </button>
    </p>
</div>

<!-- jQuery -->
<script type="text/javascript" src="{{asset('js/jquery.min.js')}}?id={{env('ASSET_FLAG')}}"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="{{asset('js/popper.min.js')}}?id={{env('ASSET_FLAG')}}"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}?id={{env('ASSET_FLAG')}}"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="{{asset('js/mdb.min.js')}}?id={{env('ASSET_FLAG')}}"></script>

<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<!-- Your custom scripts (optional) -->
<script type="text/javascript">
    function visibleCheck() {
        $.ajax({
            url: "{{route('check')}}?id={{env('ASSET_FLAG')}}",
            method: 'POST',
            data: {
                _token: "{{csrf_token()}}",
            },
            context: document.body
        }).done(function (data) {
            data = JSON.parse(data);
            if(data.visible){
                $('#header').show();
                $('#footer').show();
                $('#content').css('top', '50px');
            }
            else{
                $('#content').css('top', '0px');
                $('#header').hide();
                $('#footer').hide();
            }
        });
    }

    function home(btn=false){
        $.when($.ajax({
            url: "{{route('log-in')}}?id={{env('ASSET_FLAG')}}",
            method: 'POST',
            data: {
                _token: "{{csrf_token()}}",
                email: $("#email").val(),
                password: $("#password").val(),
                loginbtn: btn?true:null,
            },
            context: document.body
        }).done(function (data) {
            $('#content').html(data);
            $('#menu-title').text('VFleet Flotta Menedzsment');
            $('.logo').css("background-image", "url(images/vfleet.png)");
            $('.fa-arrow-left').hide();
            $('.toggle-btn').bootstrapToggle({
                on: 'Igen',
                off: 'Nem',
                onstyle: 'bg-white',
                offstyle: 'bg-white',
                style: "ios",
                size: "small",
            });
            visibleCheck();
        })).then(function () {
            remember();
        });
    }
    function logout(){
        $.when($.ajax({
            url: "{{route('logout')}}?id={{env('ASSET_FLAG')}}",
            method: 'POST',
            data: {
                _token: "{{csrf_token()}}"
            },
            context: document.body
        }).done(function (data) {
            $('#content').html(data);
            $('#menu-title').text('VFleet Flotta Menedzsment');
            $('#content').css('top', '0px');
            $('#header').hide();
            $('#footer').hide();
        })).then(function () {
            remember();
            $('.toggle-btn').bootstrapToggle({
                on: 'Igen',
                off: 'Nem',
                onstyle: 'bg-white',
                offstyle: 'bg-white',
                style: "ios",
                size: "small",
            });
        });
    }

    function fuel(){
        $.ajax({
            url: "{{route('fuel.index')}}?id={{env('ASSET_FLAG')}}",
            method: 'POST',
            data: {
                _token: "{{csrf_token()}}",
            },
            context: document.body
        }).done(function (data) {
            $('#content').html(data);
            $('.logo').css("background-image", "none");
            $('.fa-arrow-left').show();
            visibleCheck();
            $('#menu-title').text('Tankolás');

        });
    }

    function postfuel(){
        $.ajax({
            url: "{{route('fuel.postfuel')}}?id={{env('ASSET_FLAG')}}",
            method: 'POST',
            data: {
                _token: "{{csrf_token()}}",
                km_ora: $('#kmora').val(),
                liter: $('#tankoltliter').val(),
                ar: $('#ar').val(),
            },
            context: document.body
        }).done(function (data) {
            $('#content').html(data);
            $('.logo').css("background-image", "none");
            $('.fa-arrow-left').show();
            visibleCheck();
            $('#menu-title').text('Tankolás');

        });
    }

    function car(){
        $.ajax({
            url: "{{route('car.carselect')}}?id={{env('ASSET_FLAG')}}",
            method: 'POST',
            data: {
                _token: "{{csrf_token()}}",
            },
            context: document.body
        }).done(function (data) {
            $('#content').html(data);
            $('.logo').css("background-image", "none");
            $('.fa-arrow-left').show();
            visibleCheck();
            $('#menu-title').text('Jármű választása');

        });
    }

    function selectcar(){
        $.ajax({
            url: "{{route('car.setcarselect')}}?id={{env('ASSET_FLAG')}}",
            method: 'POST',
            data: {
                _token: "{{csrf_token()}}",
                azonosito: $('#carselect option:selected').val()
            },
            context: document.body
        }).done(function (data) {
            data = JSON.parse(data);
            if(data.success)
            {
                home();
            }

        });
    }

    function service(){
        $.ajax({
            url: "{{route('service.index')}}?id={{env('ASSET_FLAG')}}",
            method: 'POST',
            data: {
                _token: "{{csrf_token()}}",
            },
            context: document.body
        }).done(function (data) {
            $('#content').html(data);
            $('.logo').css("background-image", "none");
            $('.fa-arrow-left').show();
            visibleCheck();
            $('#menu-title').text('Szervízlap rörgzítése');
        });
    }

    function profil(){
        $.ajax({
            url: "{{route('home.profil')}}?id={{env('ASSET_FLAG')}}",
            method: 'POST',
            data: {
                _token: "{{csrf_token()}}",
            },
            context: document.body
        }).done(function (data) {
            $('#content').html(data);
            $('.logo').css("background-image", "none");
            $('.fa-arrow-left').show();
            visibleCheck();
            $('#menu-title').text('Profil');
        });
    }

    function documents(){
        $.ajax({
            url: "{{route('car.documents')}}?id={{env('ASSET_FLAG')}}",
            method: 'POST',
            data: {
                _token: "{{csrf_token()}}",
            },
            context: document.body
        }).done(function (data) {
            $('#content').html(data);
            $('.logo').css("background-image", "none");
            $('.fa-arrow-left').show();
            visibleCheck();
            $('#menu-title').text('Kapcsolódó dokumentumok');
        });
    }

    function carinfo(){
        $.ajax({
            url: "{{route('car.carinfo')}}?id={{env('ASSET_FLAG')}}",
            method: 'POST',
            data: {
                _token: "{{csrf_token()}}",
            },
            context: document.body
        }).done(function (data) {
            $('#content').html(data);
            $('.logo').css("background-image", "none");
            $('.fa-arrow-left').show();
            visibleCheck();
            $('#menu-title').text('Járműadatok');
        });
    }

    $(document).ready(function() {
        home();
        visibleCheck();
        remember();
     });

    function remember() {
        console.warn(localStorage.getItem('remember'));
            if (localStorage.getItem('remember') != null) {
                var tmb = JSON.parse(localStorage.getItem('remember'));
                $('#remember').attr('checked', 'checked');
                $('#email').val(tmb[0]);
                $('#password').val(tmb[1]);
                $('.toggle').removeClass('off');
                $('#remember').bootstrapToggle('on');

                $('#email').siblings('label').first().addClass('active');
                $('#password').siblings('label').first().addClass('active');
            } else {
                $('#remember').removeAttr('checked');
                $('#email').val('');
                $('#password').val('');
            }
    }
    function setRemember() {
        if ($('#remember').is(':checked') && $('#email').val() != '' && $('#password').val() != '') {
            var datas = [ $('#email').val(), $('#password').val()];
            localStorage.setItem('remember', JSON.stringify(datas));
        } else {
            localStorage.removeItem('remember')
        }
    }
</script>
</body>
</html>
