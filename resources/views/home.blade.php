@extends('layout')

@section('headerbar')
    <p class="font-weight-light text-center" id="welcomep"><span class="float-left" >Üdv {{\Opis\Closure\unserialize(session('user'))->username}}!</span> {{\Opis\Closure\unserialize(session('car'))->rendszam}} <a href="{{route('logout')}}" class="text-danger"><span class="float-right" >Kilépés</span></a></p>
@endsection

@section('homecontent')

    <div class="row pr-2 pl-2">
  <div class="col-12" style="background-image: url(./images/car.svg);
    height: 150px;
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
   ">
      <div class="text-center" style="opacity: 0.75" >

          <span class="float-left fas fa-calendar-alt text-primary" style="font-size: 12px"  ><br><br>{{ \Opis\Closure\unserialize(session('car'))->gyartasiev}}</span>
      <span style="opacity: 1">{{\Opis\Closure\unserialize(session('car'))->marka.' '. \Opis\Closure\unserialize(session('car'))->tipus }}</span>
      <span style="opacity: 1">{{'('. \Opis\Closure\unserialize(session('car'))->uzemanyag.')'}}</span>
          <span class="float-right fas fa-calendar-check text-success" style="font-size: 12px" ><br><br>{{ str_replace('-','.',\Opis\Closure\unserialize(session('car'))->muszakierv)}}</span>
      </div>
  </div></div>
    <div class="row text-center">
        <div class="col-12">
            <hr>
        </div>
        <div class="col-4">
            <span class="fas fa-tachometer-alt text-info" style="font-size: 45px; opacity: 0.75"></span>
            <br> <strong>{{number_format(session('last_fuel'),0,","," ")}} KM</strong>
                    </div>
        <div class="col-4 ">
            <span class="fas fa-gas-pump text-warning" style="font-size: 45px; opacity: 0.75"></span>
            @if(!empty(session('fuel_avg')))
            <br> <strong style="font-size: 12px">{{number_format(session('fuel_avg'),2,","," ")}}L/100KM</strong>
            @else
                <br> <strong style="font-size: 12px">N/a</strong>
            @endif
        </div>


        <div class="col-4 ">
            <span class="fas fa-tools text-danger" style="font-size: 45px; opacity: 0.75"></span>
             <br> <strong>N/a KM</strong>
        </div>

        <div class="col-12">
            <hr>
        </div>

        <div class="col-3 ">
            <p style="font-size: 50px; background-image: url(./images/wheel.svg);height: 30px; opacity: 0.75; background-repeat: no-repeat; background-position: center"></p>
            <p>Felni szett: <br> <strong>{{ \Opis\Closure\unserialize(session('car'))->felniszett}} db</strong></p>
        </div>
        <div class="col-3 ">
            <span class="fas fa-sun text-warning" style="font-size: 32px;margin-bottom: 14px; opacity: 0.75;"></span>
            <br>  <p>Nyárigumi:<br> <strong>{{ \Opis\Closure\unserialize(session('car'))->nyari}} db</strong> </p>
        </div>
        <div class="col-3 ">
            <span class="fas fa-snowflake text-primary" style="font-size: 32px;margin-bottom: 14px; opacity: 0.75;"></span>
            <br> <p>Téligumi:<br> <strong>{{ \Opis\Closure\unserialize(session('car'))->teli}} db</strong> </p>
        </div>
        <div class="col-3 ">
            <span class="fas fa-key text-success" style="font-size: 32px;margin-bottom: 14px; opacity: 0.75;"></span>
            <br>   <p>Pótkulcs:<br><strong>{{ \Opis\Closure\unserialize(session('car'))->potkulcs}} db</strong> </p>
        </div>

        <div class="col-12">
            <hr>
        </div>
        <div class="col-12 text-center" id="tablediv">
            <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
        </div>
        <div class="col-12">
            <hr>
        </div>
        <div class="col-12" id="chartdiv">
            <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
        </div>
    </div>
@endsection

@section('float')
    <a href="#"  style="display: none" id="scroltopbtn" class="float" >
        <i class="	fas fa-angle-up my-float text-white" ></i>
    </a>

@endsection
@section('footerbar')
    <div class="pt-2  col-4 bg-light text-secondary"><span style="font-size: 16px" class="fas fa-car text-primary"></span><br>Garázs</div>
    <div data-id="fuel" class="pt-2 navi col-4 bg-transparent"><span style="font-size: 16px" class="fas fa-gas-pump text-success"></span><br>Új Tankolás</div>
    <div data-id="service" class="pt-2 navi  col-4 bg-transparent"><span style="font-size: 16px" class="fas fa-tools text-danger"></span><br>Szervíz</div>
@endsection
@section('jsscript')
    <script>


        $(document).ready(function () {

            $( "#content" ).scroll(function() {
               // console.log($(this).scrollTop());
                if($(this).scrollTop() > 200)
                {
                    //scroltopbtn
                    $( "#scroltopbtn" ).show();
                }
                else
                {
                    $( "#scroltopbtn" ).hide();
                }
            });

            $( "#scroltopbtn" ).on('click',function () {
                $( "#content").animate({ scrollTop: 0 }, "slow");
            });

            setTimeout(function(){
                $.get( "{{route('datatable')}}", function( data ) {
                    $( "#tablediv" ).html( data );
                });
                $.get( "{{route('chart')}}", function( data ) {
                    $( "#chartdiv" ).html( data );
                });
            }, 300);
            setTimeout(function(){

                $.ajax({
                    type:'POST',
                    url:'{{route('postchartdata')}}',
                    data: {'_token': '{{ csrf_token() }}'},
                    success:function(datas){
                        var labels = [];
                        var values = [];
                        labels =JSON.parse(datas)[0];
                        values =JSON.parse(datas)[1];
                        if (labels.length != 0) {
                            if (labels.length == 1) {
                                labels = ['Kezdeti KM'].concat(labels)
                            }
                            if (values.length == 1) {
                                values = [{{ \Opis\Closure\unserialize(session('car'))->kezdeti_km}}].concat(values)
                            }
                            //console.log(values);
                            //console.log(labels);
                            var chart = document.getElementById('chart').getContext('2d'),
                                gradient = chart.createLinearGradient(0, 0, 0, 450);

                            gradient.addColorStop(0, 'rgba(0,123,255,0.91)');
                            gradient.addColorStop(0.25, 'rgba(0,123,255,0.5)');
                            gradient.addColorStop(0.5, 'rgba(0,123,255,0.18)');
                            gradient.addColorStop(0.75, 'rgba(0,123,255,0.09)');
                            gradient.addColorStop(1, 'rgba(255,0,0,0.03)');


                            var data = {
                                labels: labels,
                                datasets: [{
                                    label: 'Km óra állás',
                                    backgroundColor: gradient,
                                    pointBackgroundColor: 'white',
                                    borderWidth: 1,
                                    borderColor: '#007bff',
                                    data: values
                                }]
                            };
                           // console.log(data);

                            var options = {
                                title: {
                                    display: true,
                                    text: 'Futásteljesítmény hetekre bontva ({{date('Y')}}) ',
                                    fontSize: 16,
                                    fontColor: '#007bff'
                                },
                                responsive: true,
                                maintainAspectRatio: true,
                                animation: {
                                    easing: 'easeInOutQuad',
                                    duration: 520
                                },
                                scales: {
                                    xAxes: [{
                                        gridLines: {
                                            color: 'rgba(200, 200, 200, 0.05)',
                                            lineWidth: 1
                                        }
                                    }],
                                    yAxes: [{
                                        gridLines: {
                                            color: 'rgba(200, 200, 200, 0.08)',
                                            lineWidth: 1
                                        },
                                        ticks: {
                                            callback: function (label, index, labels) {
                                                return label / 1000 + 'k';
                                            }
                                        },
                                        scaleLabel: {
                                            display: true,
                                            labelString: '1k = 1000 KM'
                                        }
                                    }]
                                },
                                elements: {
                                    line: {
                                        tension: 0.4
                                    }
                                },
                                legend: {
                                    display: false
                                },
                                point: {
                                    backgroundColor: 'white'
                                },
                                tooltips: {
                                    titleFontFamily: 'Open Sans',
                                    backgroundColor: 'rgba(0,0,0,0.3)',
                                    titleFontColor: 'white',
                                    caretSize: 5,
                                    cornerRadius: 2,
                                    xPadding: 10,
                                    yPadding: 10,
                                    callbacks: {
                                        label: function (tooltipItem, data) {
                                            return 'KM óra állása: ' + tooltipItem.yLabel / 1000 + 'k';
                                        }
                                    }
                                }
                            };


                            var chartInstance = new Chart(chart, {
                                type: 'line',
                                data: data,
                                options: options
                            });
                        }
                    }
                });

            }, 800);


        });


    </script>
@endsection
