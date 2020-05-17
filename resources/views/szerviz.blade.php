@extends('layout')

@section('headerbar')
    <h5 class="font-weight-light text-center text-primary" id="welcomep"> Gyorsmunkalap Rögzítése</h5>
@endsection

@section('servicecontent')
    @if(\Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {!! \Session::get('success') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div id="servicediv">
        <div id="spindiv" class="text-center">
            <p>
            <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
            </p>
        </div>

        <form id="fuelform" style="display: none" action="{{route('postservice')}}" method="POST">
            @csrf
            <div class="form-group row">
                <label for="fuell" class="col-sm-2 col-form-label">Költség</label>
                <div class="col-sm-10">
                    <input type="text" pattern="[0-9]+" value="{{ old('serviceprice') }}" class="form-control {{ $errors->has('serviceprice') ? ' is-invalid' : '' }}" name="serviceprice" onchange="onch()" id="serviceprice" placeholder="Szervízköltség" required>

                    @if ($errors->has('serviceprice'))

                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Hiba!</strong> {{ $errors->first('serviceprice') }} 😐

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="price" class="col-sm-2 col-form-label">Leírás</label>
                <div class="col-sm-10">

                        <textarea class="form-control" id="description" onchange="onch()" required  name="description" rows="6"></textarea>

                    @if ($errors->has('description'))

                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Hiba!</strong> {{ $errors->first('description') }} 😐

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="price" class="col-sm-2 col-form-label">KM Óra Állás</label>
                <div class="col-sm-10">
                    <input type="tel" pattern="[0-9]*" value="{{ old('kmhour') }}" onchange="onch()" class="form-control {{ $errors->has('kmhour') ? ' is-invalid' : '' }}" name="kmhour" id="kmhour"  placeholder="Utolsó rögzített: {{number_format(session('last_fuel'),0,","," ")}} KM" required>

                    @if ($errors->has('kmhour'))

                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Hiba!</strong> {{ $errors->first('kmhour') }}

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="date" class="col-sm-2 col-form-label">Rögzítés Dátuma</label>
                <div class="col-sm-10">
                    <input type="date"  class="form-control" value="{{ ((empty(old('date')))?date('Y-m-d'):old('date') ) }}" id="date"  name="date" placeholder="Rögzítés Dátuma"  required>
                </div>
            </div>

            <button type="submit" style="display: none" id="sbutton"></button>

        </form>

    </div>

@endsection
@section('float')
    <a href="#" id="sbutton02" class="float" >
        <i class="fas fa-check my-float text-white"></i>
    </a>
    <a href="#" id="sbuttonesc" class="float-red" style="display: none">
        <i class="fas fa-times my-float text-white"></i>
    </a>
@endsection


@section('footerbar')
    <div data-id="home" class="pt-2 navi col-4 bg-transparent"><span style="font-size: 16px" class="fas fa-car text-primary"></span><br>Garázs</div>
    <div data-id="fuel" class="pt-2 navi col-4 bg-transparen"><span style="font-size: 16px" class="fas fa-gas-pump text-success"></span><br>Új Tankolás</div>
    <div data-id="service" class="pt-2 col-4 bg-light text-secondary"><span style="font-size: 16px" class="fas fa-tools text-danger"></span><br>Szervíz</div>
@endsection

@section('jsscript')
    <script>
        function onch()
        {
            if($('#serviceprice').val() != '' || $('#description').val() != ''|| $('#kmhour').val() != '')
            {
                $('#sbuttonesc').show();
            }
            else {
                $('#sbuttonesc').hide();
            }
        }

        $(document).ready(function () {
            onch();
            $('#sbutton02').on("click", function () {
                $('#sbutton').click();
            });
            $('#sbuttonesc').on("click", function () {
                $(this).hide();
                $('#serviceprice').val('');
                $('#description').val('');
                $('#kmhour').val('');
            });
            setTimeout(function(){
                $("#fuelform").show();
                $("#spindiv").hide();

            }, 300);

            $( ".alert-success" ).fadeOut( 4000, "linear");
        });


    </script>
@endsection
