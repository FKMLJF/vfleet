<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   {{-- <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />--}}


    <title>mcnc</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    {{--<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>--}}
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7b0a1c503f.js" crossorigin="anonymous"></script>
    <link href="{{asset('css/icheck-bootstrap.css')}}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{asset('css/DataTables/datatables.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/spiner.css')}}"/>
    <script type="text/javascript" src="{{asset('css/DataTables/datatables.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('js/Chart.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.p2r.min.js')}}"></script>
</head>
<body style="height:100%; width:100%">

@yield('float')

<div id="header" style="z-index: 9999; position:absolute; top:0px; left:0px; height:2.5rem; right:0px;overflow:hidden;">
    <div class=" pr-2 pl-2 pt-2">
    @yield('headerbar')
    </div>
</div>





<div id="content" class=" pr-2 pl-2" style="position:absolute; top:3rem; bottom:3rem; left:0px; right:0px; overflow:scroll; overflow-x: hidden">

    @yield('content')
    <div id="carouselExampleControls" class="carousel slide carousel-fade" data-ride="carousel" data-interval="false">
        <div class="carousel-inner">
            <div class="carousel-item active" data-attr="home">
                @yield('homecontent')
            </div>
            <div class="carousel-item" data-attr="fuel">
                @yield('fuelcontent')
            </div>
            <div class="carousel-item">
                @yield('servicecontent')
            </div>
        </div>

    </div>
</div>
<div id="footer" style="position:absolute; bottom:0px; height:3rem; left:0px; right:0px; overflow:hidden;">
    <div class="row text-center pr-2 pl-2">
        @yield('footerbar')

    </div>
</div>
@yield('jsscript')


<script>


    function caclFuelPrice()
    {

        var f = parseFloat($('#fuel').val());
        var p = parseFloat($('#price').val());

        if(p > 1 && f > 1)
        {
            $('#pricel').val((p/f).toFixed(2) + ' HUF / Liter');
        }
        else
        {
            $('#pricel').val(0 + ' HUF / Liter');
        }
    }


   $(document).ready(function () {


       var spin = false;
       $("#header").pullToRefresh({
           refresh:300
       }).on("move.pulltorefresh", function (evt, y) {
           $("#header").css('height', '6.5rem');
           $('#welcomep').hide();
           if (spin == false) {
               spin = true;
               $(this).append('<div style=" width: 100%;" class="text-center" id="spinerspan"><p><div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></p></div>');
               $( "#spinerspan" ).fadeOut( 3000, "linear", function () {
                   location.reload();
               });
           }
       }).on("refresh.pulltorefresh", function (){
               location.reload();
           }).on("end.pulltorefresh", function (evt, y){
               $('#spinerspan').remove();
           spin = false;
           $(this).css('height', '2.5rem');
           $('#welcomep').show();
       });

       $('.carousel-item').removeClass('active');

       switch ( document.location.href) {
           case '{{route('home')}}':
               $('.carousel-item:nth-child(1)').addClass('active');

               break;
           case '{{route('fuel')}}':
               $('.carousel-item:nth-child(2)').addClass('active');

               break;
           case '{{route('service')}}' :
               $('.carousel-item:nth-child(3)').addClass('active');
               break;
       }


        $('.navi').on('click', function () {
            $('.carousel-item').removeClass('active');

            $('.navi').removeClass('bg-light text-secondary bg-transparent');
            $('.navi').addClass('bg-transparent');
            $(this).addClass('bg-light text-secondary');
            $(this).removeClass('bg-transparent');

            switch ($(this).data('id')) {
                case 'home':
                    $('.carousel-item:nth-child(1)').addClass('active');
                    document.location.href = '{{route('home')}}';
                    break;
                case 'fuel':
                    $('.carousel-item:nth-child(2)').addClass('active');
                    document.location.href = '{{route('fuel')}}';
                    break;
                case 'service' :
                    $('.carousel-item:nth-child(3)').addClass('active');
                    document.location.href = '{{route('service')}}';
                    break;
            }
        });
    });
</script>

</body>
</html>
