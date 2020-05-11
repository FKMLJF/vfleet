<!-- Card -->
@if(!empty($muszaki))
<div class="card  waves-effect waves-light m-2 blue-gradient text-white">

    <!-- Card image -->
    <div class="view overlay text-center">
        <i class="fas fa-image" style="font-size: 120px; opacity: 0.2"></i>
    </div>

    <!-- Card content -->
    <div class="card-body">

        <!-- Title -->
        <h4 class="card-title">Műszaki vizsga</h4>
        <!-- Text -->
        <p class="card-text text-white">Érvényesség kezdete: {{substr($muszaki->mettol, 0, 10)}}</p>
        <p class="card-text text-white">Érvényesség vege: {{substr($muszaki->meddig, 0, 10)}}</p>

    </div>

</div>
@endif
<!-- Card -->

@if(!empty($kgfb))

<!-- Card -->
<div class="card waves-effect waves-light m-2 blue-gradient text-white">

    <!-- Card image -->
    <div class="view overlay text-center">
        <i class="fas fa-image" style="font-size: 120px; opacity: 0.2"></i>
    </div>

    <!-- Card content -->
    <div class="card-body">
        <!-- Title -->
        <h4 class="card-title">Kötlező biztosítás</h4>
        <!-- Text -->
        <p class="card-text text-white">Érvényesség kezdete: {{substr($kgfb->mettol,0,10)}}</p>
        <p class="card-text text-white">Érvényesség vége: {{substr($kgfb->meddig,0,10)}}</p>
    </div>

</div>
@endif
<!-- Card -->
