<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel=icon type="image/ico" href="favicon.ico" />  
  @if(trim($__env->yieldContent('sIte_tItle')))
    <title>Head2Toe | @yield('sIte_tItle')</title>
  @else
    <title>Head2Toe | Administrator</title>
  @endif

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 --> 
  {!!Html::style('theme/bootstrap/css/bootstrap.min.css')!!}  <!-- Font Awesome -->
  {!!Html::style('theme/dist/css/font-awesome.min.css')!!}  <!-- Ionicons -->
  {!!Html::style('theme/dist/css/ionicons.min.css')!!}  <!-- Theme style -->
  {!!Html::style('theme/dist/css/theme.min.css')!!}  <!-- Custom CSS -->
  {!!Html::style('theme/dist/css/skins/skin-green.min.css')!!}
  @yield('head')
  {!!Html::style('theme/dist/css/custom.css')!!}  <!-- Theme Skins. We have chosen the skin-green for this page -->  

</head>

<!--
BODY TAG OPTIONS:
=================
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->

<body class="hold-transition skin-green sidebar-mini fixed">

<!-- WRAPPER START -->
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>H</b>2T</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>HEAD</b>2TOE</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">          
         @yield('dynamIc_top_nAvbar')  </ul>
      </div>
    </nav>
  </header>

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    @yield('dynamIc_sIdebar')
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

  
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>     
      @yield('pAge_Header')<small>@yield('pAge_dEsc')</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">@yield('pAge_Header')</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">


  @if(Session::has("success"))
      <div class="alert alert-success" role ="alert">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <strong>Success : </strong> {{Session::get("success")}}
      </div>
  @endif

  @if(Session::has("error"))
      <div class="alert alert-danger" role ="alert">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <strong>Error : </strong> {{Session::get("error")}}
      </div>
  @endif

  @if(isset($errors) && count($errors) > 0)
      <div class="alert alert-danger" role ="alert">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-warning"></i> Failed !</h4>
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
   @endif

  <div class="alert alert-danger" id="errormsg" style="display:none;" role ="alert">
      <button type="button" class="close" onclick="$(this).parent().hide()" aria-hidden="true">&times;</button>
      <strong>Error : </strong> <span id="errormsgcontent">Error</span>
  </div>

  {{--       
  <div class="modal fade bs-example-modal-sm" id="msgdisp" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">

      <div class="modal-dialog modal-sm" style="transform: translate(0px, -50%);top: 30%" role="document">   
          <div class="alert alert-danger">           
                         
          </div> 
      </div>

  </div>
  --}}
  @yield('mAin_ContenT')
    
  </section>
  <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->

  
  <!-- FOOTER START -->
  <footer class="main-footer textcenter">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      &nbsp;
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <?= date('Y') ?> <a href="/">HEAD2TOE</a>.</strong> All rights reserved.
  
  </footer>  
  <!-- FOOTER END -->


</div>
<!-- WRAPPER END -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.4 -->
{!!Html::script('theme/plugins/jQuery/jQuery-2.1.4.min.js')!!}<!-- Bootstrap 3.3.5 -->
{!!Html::script('theme/bootstrap/js/bootstrap.min.js')!!}<!-- SlimScroll -->
{!!Html::script('theme/plugins/slimScroll/jquery.slimscroll.min.js')!!}<!-- Theme App -->
{!!Html::script('theme/dist/js/app.min.js')!!}
@yield('pAge_scriPts')
{{--
<script>
$(function(){
    $('#msgdisp').modal('show');    
});
</script>
--}}
</body>
</html>