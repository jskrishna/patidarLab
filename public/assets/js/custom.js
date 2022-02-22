
  $('.dt-responsive').DataTable({
    language: {
      search: "_INPUT_",
        searchPlaceholder: "Search Patient..."
  },
  "bPaginate": true,
    "bLengthChange": true,
    "bFilter": true,
    "bInfo": false,
    "bAutoWidth": false,
    "lengthMenu": [[7, 20, 50, -1], [7, 20, 50, "All"]],
    "ordering": true
  });
  