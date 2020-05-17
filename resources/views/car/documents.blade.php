

@if(!empty($dokumentumok))
@foreach($dokumentumok as $item)
<!-- Card -->
<div class="card waves-effect waves-light m-2 blue-gradient text-white">

    <!-- Card image -->
    <div class="view overlay text-center">
        <i class="fas fa-image" style="font-size: 80px; opacity: 0.2"></i>
    </div>

    <!-- Card content -->
    <div class="card-body">
        <!-- Title -->
        <h4 class="card-title">{{$item->tipus_id}}</h4>
        <!-- Text -->
        <p class="card-text text-white">Érvényesség kezdete: <strong style="font-size: 120%">{{$item->tol}}</strong></p>
        <p class="card-text text-white">Érvényesség vége: <strong style="font-size: 120%">{{$item->ig}}</strong></p>
    </div>

</div>
@endforeach
@endif
<!-- Card -->
