$(document).ready(function() {

    //report

    var table = $('.dt-responsive').DataTable({
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search Patient..."
        },
        // "order": [
        //     [2, "desc"]
        // ],
        responsive: {
            details: {
                type: "column",
                target: 0,
            },
        },
        processing: true,
        serverSide: true,
        ajax: {
            url: serverSideUrl,
            dataSrc: 'data'
        },
        columns: [{
                "data": "id"
            },
            {
                "data": "name"
            },
            {
                "data": "reportdate"
            },
            {
                "data": "amount"
            },
            {
                "data": "referral"
            },
            {
                "data": "test_status"
            },
            {
                "data": "payment"
            },
            {
                "data": "action"
            },
        ],
        columnDefs: [{
                responsivePriority: 1,
                targets: -1,
            },
        ],
        "lengthMenu": [
            [10, 20, 50, -1],
            [10, 20, 50, "All"]
        ],

        // "ordering": true,
        "fnRowCallback": function(nRow, aData, iDisplayIndex) {
            $("td:first", nRow).html(iDisplayIndex + 1);
            return nRow;
        },


    });

    //report-filter
    $('#report-filter .filter-item').click(function() {
        var value = $(this).data('value');
        table.search(value).draw();
    })

    $(".custom-filter").on('change', function() {
        var value = $(this).val();
        if (value != 'Custom') {
            table.search(value).draw();
        } else {
            $('#fdate').focus();
        }
    })
    $('#filter').click(function() {
        var fdate = $('#fdate').val();
        var tdate = $('#tdate').val();
        if (tdate != '' && fdate != '') {
            var value = fdate + ' To ' + tdate;
            table.search(value).draw();
        } else {
            if (fdate == '') {
                $('#fdate').focus();
            } else {
                $('#tdate').focus();
            }
        }
    })


    //report table js
    $('.table tbody').on('mouseover', 'tr', function() {
        $('[data-toggle="tooltip"]').tooltip({
            trigger: 'hover',
            html: true
        });
    });
    // doctors datatable
    $('.dt-responsives').DataTable({
        responsive: true,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search Doctors..."
        },
        "order": [
            [2, "desc"]
        ],
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bInfo": false,
        "bAutoWidth": false,
        "lengthMenu": [
            [20, 50, -1],
            [20, 50, "All"]
        ],
        "ordering": true,
        "fnRowCallback": function(nRow, aData, iDisplayIndex) {
            $("td:first", nRow).html(iDisplayIndex + 1);
            return nRow;
        },
        "columnDefs": [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: 6 }
        ]
    });


    // roles datatable
    var rolTable = $('.dt-responsive2').DataTable({
        responsive: true,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search User Name..."
        },
        "order": [
            [2, "desc"]
        ],
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bInfo": false,
        "bAutoWidth": false,
        "lengthMenu": [
            [20, 50, -1],
            [20, 50, "All"]
        ],
        "ordering": true,
        "fnRowCallback": function(nRow, aData, iDisplayIndex) {
            $("td:first", nRow).html(iDisplayIndex + 1);
            return nRow;
        },
        "columnDefs": [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: 6 }
        ]
    });

    // patients datatable
    var docTable = $('.dt-responsive1').DataTable({
        responsive: true,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search..."
        },
        "order": [
            [2, "desc"]
        ],
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bInfo": false,
        "bAutoWidth": false,
        "lengthMenu": [
            [20, 50, -1],
            [20, 50, "All"]
        ],
        "ordering": true,
        "fnRowCallback": function(nRow, aData, iDisplayIndex) {
            $("td:first", nRow).html(iDisplayIndex + 1);
            return nRow;
        },
        "columnDefs": [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: 6 }
        ]
    });

    var patient_single = $('.patient-single-table').DataTable({
        responsive: true,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search..."
        },
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bInfo": false,
        "bAutoWidth": false,
        "lengthMenu": [
            [20, 50, -1],
            [20, 50, "All"]
        ],
        "fnRowCallback": function(nRow, aData, iDisplayIndex) {
            $("td:first", nRow).html(iDisplayIndex + 1);
            return nRow;
        },
        "columnDefs": [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: 4 }
        ]
    });


    
});