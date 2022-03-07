$(document).ready(function () {
    var table = $('.dt-responsive').DataTable({
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search Patient..."
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
        "fnRowCallback": function (nRow, aData, iDisplayIndex) {
            $("td:first", nRow).html(iDisplayIndex + 1);
            return nRow;
        },
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
            [20, 50, -1],
            [20, 50, "All"]
        ],
        "ordering": true,
    });

    //report-filter
    $('.report-filter .filter-item').click(function () {
        var value = $(this).data('value');
        table.columns(7).search(value).draw();
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
        },],
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


$(function () {
    $('.accordion-body input:text:first').focus();
    var $inp = $('input:text');
    $inp.bind('keydown', function (e) {
        var key = e.which;
        if (key == 40) {
            e.preventDefault();
            var nxtIdx = $inp.index(this) + 1;
            $(":input:text:eq(" + nxtIdx + ")").focus();
            console.log(key);
        }
    });
    $inp.bind('keyup', function (e) {
        var key = e.which;
        if (key == 38) {
            e.preventDefault();
            var nxtIdx = $inp.index(this) - 1;
            $(":input:text:eq(" + nxtIdx + ")").focus();
            console.log(key);
        }
    });
});
