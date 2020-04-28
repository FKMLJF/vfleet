@extends('layout')

@section('headerbar')
    <p class="font-weight-light text-center"><span class="float-left"><strong class="text-primary">VFleet</strong> - Flotta követés és menedzsment.</span></p>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Belépés') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('Felhasználónév') }}</label>

                                <div class="col-md-6">
                                    <input id="username" type="text"  class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username"  value="{{ old('username') }}" required autofocus>

                                    @if ($errors->has('username'))

                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>Hiba!</strong> {{ $errors->first('username') }} 😐

                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Jelszó') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" value="{{ old('password') }}" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))

                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>Hiba!</strong> {{ $errors->first('password') }} 😐

                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Rendszám') }}</label>

                                <div class="col-md-6">
                                    <input id="rendszam" type="text" class="form-control{{ $errors->has('rendszam') ? ' is-invalid' : '' }}" name="rendszam" required>

                                    @if ($errors->has('rendszam'))

                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>Hiba!</strong> {{ $errors->first('rendszam') }} 😐

                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">

                                    <div class="checkbox  icheck-primary">

                                        <input type="checkbox" id="remember" name="remember" >

                                        <label for="primary1">{{ __('Jegyezz meg!') }}</label>

                                    </div>

                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" id="sbutton" class="btn btn-primary btn-block">
                                        {{ __('Belépés') }}
                                    </button>


                                </div>
                            </div>




                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    $(document).ready(function () {


        $("#remember").prop("checked", false);
        if (localStorage.getItem("username") != '')
        {
            $("#username").val(localStorage.getItem("username"));
            $("#password").val( localStorage.getItem("password"));
           $("#rendszam").val(  localStorage.getItem("rendszam"));
            $("#remember").prop("checked", true);
        }
        else {
            $("#username").val('');
            $("#password").val('');
            $("#rendszam").val('');

        }
        $('#sbutton').on('click', function () {
            $('#sbutton').text('');
            $('#sbutton').append('<span class="fas fa-spin fa-cog"></span>');
            if ($("#remember").prop("checked") == true)
            {
                localStorage.setItem("username", $("#username").val());
                localStorage.setItem("password", $("#password").val());
                localStorage.setItem("rendszam", $("#rendszam").val());
            }
            else
            {
                localStorage.removeItem('username');
                localStorage.removeItem('password');
                localStorage.removeItem('rendszam');
            }
        });

        $('.icheck-primary').on('click', function () {
            $("#remember").prop("checked",(!$("#remember").prop("checked")));
        });
    });
</script>
@endsection



