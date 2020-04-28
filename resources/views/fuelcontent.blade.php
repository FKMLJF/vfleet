
<form action="{{route('postfuel')}}" method="POST">
    @csrf
    <div class="form-group row">
        <label for="fuell" class="col-sm-2 col-form-label">Tankol Liter</label>
        <div class="col-sm-10">
            <input type="text" pattern="[0-9]+" value="{{ old('fuel') }}" class="form-control {{ $errors->has('fuel') ? ' is-invalid' : '' }}" name="fuel" onchange="caclFuelPrice()" id="fuel" placeholder="Tankolt Liter" required>

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
    <div class="form-group row">
        <label for="price" class="col-sm-2 col-form-label">Összeg</label>
        <div class="col-sm-10">
            <input type="text"  pattern="[0-9]+" value="{{ old('price') }}" class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" id="price" onchange="caclFuelPrice()" placeholder="Összeg" required>

            @if ($errors->has('price'))

                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Hiba!</strong> {{ $errors->first('price') }} 😐

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
            <input type="text" pattern="[0-9]+" value="{{ old('kmhour') }}" class="form-control {{ $errors->has('kmhour') ? ' is-invalid' : '' }}" name="kmhour" id="kmhour"  placeholder="Utolsó rögzített: {{number_format(session('last_fuel'),0,","," ")}} KM" required>

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
        <label for="pricel" class="col-sm-2 col-form-label">Liter Ár</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" value="{{ old('pricel') }}" name="pricel" id="pricel" placeholder="Liter Ár" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label for="date" class="col-sm-2 col-form-label">Rögzítés Dátuma</label>
        <div class="col-sm-10">
            <input type="date"  class="form-control" value="{{ ((empty(old('date')))?date('Y-m-d'):old('date') ) }}" id="date"  name="date" placeholder="Rögzítés Dátuma"  required>
        </div>
    </div>


    <div class="form-group row mb-4">
        <div class="col-md-8 offset-md-4">
            <button type="submit" id="sbutton" class="btn btn-success btn-block">
                {{ __('Rögzítés') }}
            </button>


        </div>
    </div>
</form>
