<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">


  <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin" rel="stylesheet" type="text/css">
  <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css">
  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

  <link href="{{ asset(null) }}frontend/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" class="px-demo-stylesheet-bs">
  <link href="{{ asset(null) }}frontend/assets/css/admin.min.css" rel="stylesheet" type="text/css" class="px-demo-stylesheet-core">
  <link href="{{ asset(null) }}frontend/assets/css/widgets.min.css" rel="stylesheet" type="text/css" class="px-demo-stylesheet-widgets">

  <link href="{{ asset(null) }}frontend/assets/css/themes/white.min.css" rel="stylesheet" type="text/css" class="px-demo-stylesheet-theme">

  <link href="{{ asset(null) }}frontend/assets/demo/demo.css" rel="stylesheet" type="text/css">
  <link href="{{ asset(null) }}frontend/assets/demo/demo.css" rel="stylesheet" type="text/css">
  <link href="{{ asset(null) }}frontend/assets/css/sweetalert.css" rel="stylesheet" type="text/css">
  <link href="{{ asset(null) }}frontend/assets/css/style.css" rel="stylesheet" type="text/css">
  <link href="{{ asset(null) }}frontend/assets/css/animate.css" rel="stylesheet" type="text/css">

  <script type="text/javascript" src="{{ asset(null) }}frontend/assets/js/holder.js"></script>

<link rel="stylesheet" type="text/css" href="{{ asset(null) }}frontend/assets/css/jquery-ui.css">

  <!-- Pace.js -->
  <script src="{{ asset(null) }}frontend/assets/pace/pace.min.js"></script>

  <script src="{{ asset(null) }}frontend/assets/demo/demo.js"></script>
  <script src="{{ asset(null) }}frontend/assets/js/sweetalert.min.js"></script>
  <!-- ==============================================================================
  |
  |  SCRIPTS
  |
  =============================================================================== -->

  <!-- jQuery -->
  <script src="{{ asset(null) }}frontend/assets/js/jquery.min.js"></script>

<script type="text/javascript" src="{{ asset(null) }}frontend/assets/js/jquery-ui.min.js"></script>
  <script src="{{ asset(null) }}frontend/assets/js/bootstrap.min.js"></script>
  <script src="{{ asset(null) }}frontend/assets/js/admin.min.js"></script>
<script src="{{ asset(null) }}frontend/ckeditor/plugins/emojione/libs/emojione/emojione.min.js"></script>
<script src="{{ asset(null) }}frontend/ckeditor/ckeditor.js"></script>


  <script type="text/javascript">
    // -------------------------------------------------------------------------
    // Initialize DEMO
  

    var basedomain = "{{ URL::to('/') }}";;

    $(function() {
      var file = String(document.location).split('/').pop();

      // Remove unnecessary file parts
      file = file.replace(/(\.html).*/i, '$1');

      if (!/.html$/i.test(file)) {
        file = 'index.html';
      }

      // Activate current nav item
      $('body > .px-nav')
        .find('.px-nav-item > a[href="' + file + '"]')
        .parent()
        .addClass('active');

      $('body > .px-nav').pxNav();
      $('body > .px-footer').pxFooter();

      $('#navbar-notifications').perfectScrollbar();
      $('#navbar-messages').perfectScrollbar();

     
          // CKEDITOR.replace('desc');
    });
  </script>

  <script>


    $(function() {
      $('[data-toggle="tooltip"]').tooltip();
    });
    $(function() {
      $('#support-tickets').perfectScrollbar();
      $('#comments').perfectScrollbar();
      $('#threads').perfectScrollbar();
    });

    $(function () {
      // CKEDITOR.plugins.addExternal('emojione', '{{ asset(null) }}frontend/ckeditor/plugins/emojione/', 'plugin.js');
      // CKEDITOR.config.extraPlugins = 'emojione';
      
    });
  </script>


  <!-- Custom styling -->
  <style>
    .page-header-form .input-group-addon,
    .page-header-form .form-control {
      background: rgba(0,0,0,.05);
    }
  </style>
  <!-- / Custom styling -->
