<h5 class="text-center"> Tanoklások </h5>
<table class="table  table-bordered display responsive nowrap" id="fueltable"  cellspacing="0" width="100%">
    <thead class="bg-primary text-white">
    <th style="width: 20px"></th>
    <th>Liter</th>
    <th>Ár</th>
    <th>KM óra</th>
    <th>Dátum</th>
    <th>Rögzítő</th>
    <th class="text-primary">Azonosító</th>
    </thead>
</table>
<hr>
<h5 class="text-center"> Szervizek </h5>
<table class="table  table-bordered display responsive nowrap" id="servicetable"  cellspacing="0" width="100%">
    <thead class="bg-primary text-white">
    <th style="width: 20px"></th>
    <th>Ár</th>
    <th>KM óra</th>
    <th >Leírás</th>

    <th>Dátum</th>
    <th>Rögzítő</th>
    <th class="text-primary">Azonosító</th>
    </thead>
</table>
<script>
    $(document).ready(function () {
        var table = $('#fueltable').DataTable({
            "language":{
                "sEmptyTable": "Nincs rendelkezésre álló adat",
                "sInfo": "Találatok: _START_ - _END_ Összesen: _TOTAL_",
                "sInfoEmpty": "Nulla találat",
                "sInfoFiltered": "(_MAX_ összes rekord közül szűrve)",
                "sInfoPostFix": "",
                "sInfoThousands": " ",
                "sLengthMenu": "_MENU_ találat oldalanként",
                "sLoadingRecords": "Betöltés...",
                "sProcessing": "Feldolgozás...",
                "sSearch": "Keresés:",
                "sZeroRecords": "Nincs a keresésnek megfelelő találat",
                "oPaginate": {
                    "sFirst": "Első",
                    "sPrevious": "Előző",
                    "sNext": "Következő",
                    "sLast": "Utolsó"
                },
                "oAria": {
                    "sSortAscending": ": aktiválja a növekvő rendezéshez",
                    "sSortDescending": ": aktiválja a csökkenő rendezéshez"
                },
                "select": {
                    "rows": {
                        "_": "%d sor kiválasztva",
                        "0": "",
                        "1": "1 sor kiválasztva"
                    }
                },
                "buttons": {
                    "print": "Nyomtatás",
                    "colvis": "Oszlopok",
                    "copy": "Másolás",
                    "copyTitle": "Vágólapra másolás",
                    "copySuccess": {
                        "_": "%d sor másolva",
                        "1": "1 sor másolva"
                    }
                }
            },
            "processing": true,
            "serverSide": true,
            ordering: false,
            "pageLength": 5,
            dom: 'ftpi',
            "ajax":{
                "url": "{{ url('allposts') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"}
            },
            "columns": [
                {
                    "className":      'details-control',
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ''
                },
                { "data": "liter" },
                { "data": "ar" },
                { "data": "km" },
                { "data": "ido" },
                { "data": "user_id" },
                { "data": "id" }
            ]

        });
        var table1 = $('#servicetable').DataTable({
            "language":{
                "sEmptyTable": "Nincs rendelkezésre álló adat",
                "sInfo": "Találatok: _START_ - _END_ Összesen: _TOTAL_",
                "sInfoEmpty": "Nulla találat",
                "sInfoFiltered": "(_MAX_ összes rekord közül szűrve)",
                "sInfoPostFix": "",
                "sInfoThousands": " ",
                "sLengthMenu": "_MENU_ találat oldalanként",
                "sLoadingRecords": "Betöltés...",
                "sProcessing": "Feldolgozás...",
                "sSearch": "Keresés:",
                "sZeroRecords": "Nincs a keresésnek megfelelő találat",
                "oPaginate": {
                    "sFirst": "Első",
                    "sPrevious": "Előző",
                    "sNext": "Következő",
                    "sLast": "Utolsó"
                },
                "oAria": {
                    "sSortAscending": ": aktiválja a növekvő rendezéshez",
                    "sSortDescending": ": aktiválja a csökkenő rendezéshez"
                },
                "select": {
                    "rows": {
                        "_": "%d sor kiválasztva",
                        "0": "",
                        "1": "1 sor kiválasztva"
                    }
                },
                "buttons": {
                    "print": "Nyomtatás",
                    "colvis": "Oszlopok",
                    "copy": "Másolás",
                    "copyTitle": "Vágólapra másolás",
                    "copySuccess": {
                        "_": "%d sor másolva",
                        "1": "1 sor másolva"
                    }
                }
            },
            "processing": true,
            "serverSide": true,
            ordering: false,
            "pageLength": 5,
            dom: 'ftpi',
            "ajax":{
                "url": "{{ url('allpostsservice') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"}
            },
            "columns": [
                {
                    "className":      'details-control',
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ''
                },
                { "data": "ar" },
                { "data": "km" },
                { "data": "leiras" },

                { "data": "timestamp" },
                { "data": "user_id" },
                { "data": "id" }
            ]

        });
    });
</script>
