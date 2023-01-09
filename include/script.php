<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="./resource/vendor/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./resource/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="./resource/asset/js/adminlte.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="./resource/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="./resource/vendor/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="./resource/vendor/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="./resource/vendor/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="./resource/vendor/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="./resource/vendor/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="./resource/vendor/jszip/jszip.min.js"></script>
<script src="./resource/vendor/pdfmake/pdfmake.min.js"></script>
<script src="./resource/vendor/pdfmake/vfs_fonts.js"></script>
<script src="./resource/vendor/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="./resource/vendor/datatables-buttons/js/buttons.print.min.js"></script>
<script src="./resource/vendor/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, "paging": true,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "pageLength"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>

</html>