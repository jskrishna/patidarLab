$(document).ready(function() {

    //report

    var table = $('.dt-responsive').DataTable({
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search Patient..."
        },
        responsive: true,

        "order": [
            [2, "desc"]
        ],
        // "columnDefs": [
        //     { responsivePriority: 1, targets: 0 },
        //     { responsivePriority: 2, targets: 10 }
        // ],
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
                "data": "report_status"
            },
            {
                "data": "payment"
            },
            {
                "data": "print"
            },
            {
                "data": "action"
            },
        ],
        "lengthMenu": [
            [5, 10, 50, -1],
            [5, 10, 50, "All"]
        ],

        "ordering": true,
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
            { responsivePriority: 2, targets: 5 }
        ]
    });

    // patients datatable
    var docTable = $('.dt-responsive1').DataTable({
        responsive: true,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search Patients..."
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
            { responsivePriority: 2, targets: 5 }
        ]
    });
});