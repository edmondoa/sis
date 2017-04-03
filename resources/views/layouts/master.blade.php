<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SiS | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  {{Html::style('/bootstrap/css/bootstrap.min.css')}}
  <!-- Font Awesome -->
  {{Html::style('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css')}}
  <!-- Ionicons -->
 <!--  {{Html::style('https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css')}}
 -->  <!-- Theme style -->
  {{Html::style('/dist/css/AdminLTE.min.css')}}
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  {{Html::style('/dist/css/skins/_all-skins.min.css')}}
  <!-- iCheck -->
  {{Html::style('/plugins/iCheck/flat/blue.css')}}
  <!-- Morris chart -->
  {{Html::style('/plugins/morris/morris.css')}}
  <!-- jvectormap -->
  {{Html::style('/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}
  <!-- Date Picker -->
  {{Html::style('/plugins/datepicker/datepicker3.css')}}
  <!-- Daterange picker -->
  {{Html::style('/plugins/daterangepicker/daterangepicker.css')}}
  <!-- bootstrap wysihtml5 - text editor -->
  {{Html::style('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}
{{Html::style('/plugins/bootstrap-table/src/bootstrap-table.css')}}
  {{Html::style('/css/app.css')}}
   {{Html::style('/css/loading.css')}}
</head>
<body class="hold-transition skin-blue sidebar-mini " ng-app="SisApp">
<div class="wrapper">
 @include('layouts.header')
 <aside class="main-sidebar">
  @include('layouts.side-bar')
 </aside>
  <div class="content-wrapper row">
    <!-- Content Header (Page header) -->
    <div class="loading hide">Loading&#8230;</div>
    @yield('content')
    <!-- /.content -->
   </div>
</div>

<!-- ./wrapper -->
@section('html_footer')
<!-- jQuery 2.2.3 -->
{{Html::script('/plugins/jQuery/jquery-2.2.3.min.js')}}
<!-- jQuery UI 1.11.4 -->
{{Html::script('https://code.jquery.com/ui/1.11.4/jquery-ui.min.js')}}
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
{{Html::script('/bootstrap/js/bootstrap.min.js')}}
<!-- Morris.js charts -->
<!-- {{Html::script('https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js')}}
 --><!-- {{Html::script('/plugins/morris/morris.min.js')}} -->
<!-- Sparkline -->
{{Html::script('/plugins/sparkline/jquery.sparkline.min.js')}}
<!-- jvectormap -->
{{Html::script('/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}
{{Html::script('/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}
<!-- jQuery Knob Chart -->
{{Html::script('/plugins/knob/jquery.knob.js')}}
<!-- daterangepicker -->
<!-- {{Html::script('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js')}}
 --><!-- {{Html::script('/plugins/daterangepicker/daterangepicker.js')}} -->
<!-- datepicker -->
{{Html::script('/plugins/datepicker/bootstrap-datepicker.js')}}
<!-- Bootstrap WYSIHTML5 -->
{{Html::script('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}
<!-- Slimscroll -->
{{Html::script('/plugins/slimScroll/jquery.slimscroll.min.js')}}
<!-- FastClick -->
{{Html::script('/plugins/fastclick/fastclick.js')}}
<!-- AdminLTE App -->
{{Html::script('/dist/js/app.min.js')}}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{Html::script('/plugins/bootstrap-notify.min.js')}}
{{Html::script('/plugins/bootstrap-notify.min.js')}}
{{Html::script('/plugins/bootstrap-table/src/bootstrap-table.js')}}

<!-- {{Html::script('/dist/js/pages/dashboard.js')}} -->
<!-- AdminLTE for demo purposes -->
{{Html::script('/angular/angular.min.js')}}
{{Html::script('/angular/ui-bootstrap-tpls.js')}}
{{Html::script('/angular/angular-resource.js')}}
<!-- {{Html::script('/plugins/angular-smart-table/dist/smart-table.min.js')}} -->
<!-- {{Html::script('/plugins/ng-tasty/ng-tasty-tpls.min.js')}} -->
{{Html::script('/angular/app.js')}}
{{Html::script('/angular/controllers/header.js')}}
{{Html::script('/js/bootbox.min.js')}}
{{Html::script('/js/common.js')}}
@show
</body>
</html>
