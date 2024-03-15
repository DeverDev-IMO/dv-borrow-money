<!-- /.content-wrapper -->
<!-- <footer class="main-footer">
  <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 3.2.0
  </div>
</footer> -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="public/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="public/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="public/plugins/select2/js/select2.full.min.js"></script>
<!-- ChartJS -->
<script src="public/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<!-- <script src="public/plugins/sparklines/sparkline.js"></script> -->
<!-- JQVMap -->
<!-- <script src="public/plugins/jqvmap/jquery.vmap.min.js"></script> -->
<!-- <script src="public/plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->
<!-- jQuery Knob Chart -->
<script src="public/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="public/plugins/moment/moment.min.js"></script>
<script src="public/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="public/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="public/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="public/dist/js/pages/dashboard.js"></script> -->
</body>

</html>

<!-- ////////////////////////custom/////////////////////////// -->
<script src="config/config.js"></script>
<script src="core/functions.js"></script>
<script src="core/JSaction.js"></script>
<script src="core/JSusers.js"></script>
<script src="core/JSsetprename.js"></script>
<script src="core/JSsetstatusmarry.js"></script>
<script src="core/JSsetstatusaddress.js"></script>
<script src="core/JSsetcohabiting.js"></script>
<script src="core/JSsetstatuswork.js"></script>
<script src="core/JSsetlinework.js"></script>
<script src="core/JScontract.js"></script>
<script src="core/JSpersonnel.js"></script>
<script src="core/JSdocumentcard.js"></script>
<script src="core/JSpayments.js"></script>
<script src="core/JSclosebalance.js"></script>
<script src="core/calculates.js"></script>
<script src="core/summarizecollect.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="core/jquery-entertotab.js"></script>

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="core/DataTables.js"></script>

<script src="public/bootstrap-autocomplete/bootstrap-autocomplete.js"></script>
<script src="public/bootstrap-autocomplete/source.js"></script>
<script src="public/bootstrap-autocomplete/timezone.js"></script>
<script src="public/bootstrap-autocomplete/mock.js"></script>
<script>
  $(function() {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    // $(".js-example-tags").select2({
    //   tags: true,
    //   theme: 'bootstrap4'
    // });
    // $('.js-example-tags').select2('open');
    $('.js-example-tags').select2({
      tags: true,
      theme: 'bootstrap4'
    });


  });
</script>

<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>