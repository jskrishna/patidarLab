$(document).ready(function() {
    var table = $('.dt-responsive').DataTable({
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search Patient..."
        },
        "order": [
            [1, "desc"]
        ],
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bInfo": false,
        "bAutoWidth": false,
        "lengthMenu": [
            [7, 20, 50, -1],
            [7, 20, 50, "All"]
        ],
        "ordering": true,
    });
    var tables = $('.dt-responsives').DataTable({
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search Doctors..."
        },
        "order": [
            [1, "desc"]
        ],
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bInfo": false,
        "bAutoWidth": false,
        "lengthMenu": [
            [7, 20, 50, -1],
            [7, 20, 50, "All"]
        ],
        "ordering": true,
    });

    //report-filter
    $('.report-filter .filter-item').click(function() {
        var value = $(this).data('value');
        table.columns(6).search(value).draw();
    })


    $('.report-edit').DataTable({
        "bPaginate": false,
        "bFilter": false,
        "bInfo": false,
        "ordering": false,
        columnDefs: [{
            width: 200,
            targets: 0,
            orderable: false,
            className: 'select-checkbox',
        }, ],
        select: {
            style: 'os',
            selector: 'td:first-child'
        },
        order: [
            [1, 'asc']
        ]
    });

    $('.bill-edit').DataTable({
        "bPaginate": false,
        "bFilter": false,
        "bInfo": false,
        "ordering": false,
        columnDefs: [
            { width: 200, targets: 0 }
        ],
    });
});