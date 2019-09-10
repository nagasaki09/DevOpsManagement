
{{-- javascriptの読み込み --}}
@section('js')

<!-- Laravel Scripts -->
<script type="text/javascript" src="{{ asset('js/app.js') }}" defer></script>
<!-- METISMENU SCRIPTS -->
<script type="text/javascript" src="{{ asset('js/jquery.metisMenu.js') }}"></script>
<!-- MORRIS CHART SCRIPTS -->
<script type="text/javascript" src="{{ asset('js/morris/raphael-2.1.0.min.js' ) }}"></script>
<script type="text/javascript" src="{{ asset('js/morris/morris.js' ) }}"></script>

<!-- jQuery 3 -->
<script type="text/javascript" src="{{ asset('js/adminlte/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script type="text/javascript" src="{{ asset('js/adminlte/bootstrap.min.js') }}"></script>
<!-- AdminLTE App -->
<script type="text/javascript" src="{{ asset('js/adminlte/adminlte.min.js') }}"></script>
<!-- DataTables -->
<script type="text/javascript" src="{{ asset('js/adminlte/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/adminlte/jquery.dataTables.min.js') }}"></script>
<!-- SlimScroll -->
<script type="text/javascript" src="{{ asset('js/adminlte/jquery.slimscroll.min.js') }}"></script>



<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->

<!-- CUSTOM SCRIPTS -->
<script type="text/javascript" src="{{ asset('js/atf_input_check.js') }}"></script>
<script>
  jQuery(function($){ 
    $("#dataTable").DataTable(); 
}); 
</script>
@show

</body>
</html>
