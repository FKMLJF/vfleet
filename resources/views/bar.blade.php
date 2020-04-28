<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{-- <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />--}}


    <title>barcode</title>
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


<div id="fueldiv">


    <form id="fuelform"  action="{{route('postimage')}}"  enctype="multipart/form-data" method="POST">
        @csrf
        <div class="form-group row">
            <label for="fuell" class="col-sm-2 col-form-label">Kép</label>
            <div class="col-sm-10">


                    <input type="file" name="img" accept="image/*" capture class="form-control-file" id="exampleFormControlFile1">

                @if ($errors->has('fuel'))

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Hiba!</strong> {{ $errors->first('fuel') }} 😐

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group row mb-4">
            <div class="col-md-8 offset-md-4">
                <button type="submit" id="sbutton" class="btn btn-success btn-block">
                    {{ __('Küldés') }}
                </button>


            </div>
        </div>

    </form>

</div>


</body>
</html>

