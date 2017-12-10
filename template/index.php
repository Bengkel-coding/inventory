
  <!--Head Include-->
  <?php include "inc_head.php";?>
  <?php include "inc_styles.php";?>

  <!-- Custom styling -->
  <style>
    .page-signin-header {
      box-shadow: 0 2px 2px rgba(0,0,0,.05), 0 1px 0 rgba(0,0,0,.05);
    }

    .page-signin-header .btn {
      position: absolute;
      top: 12px;
      right: 15px;
    }

    html[dir="rtl"] .page-signin-header .btn {
      right: auto;
      left: 15px;
    }

    .page-signin-container {
      width: auto;
      margin: 30px 10px;
    }

    .page-signin-container form {
      border: 0;
      box-shadow: 0 2px 2px rgba(0,0,0,.05), 0 1px 0 rgba(0,0,0,.05);
    }

    @media (min-width: 544px) {
      .page-signin-container {
        width: 350px;
        margin: 60px auto;
      }
    }

    .page-signin-social-btn {
      width: 40px;
      padding: 0;
      line-height: 40px;
      text-align: center;
      border: none !important;
    }

    #page-signin-forgot-form { display: none; }
  </style>
  <!-- Custom styling -->
  <style>
     body
     {
        background:url('assets/images/bg.png') no-repeat center center fixed;
        -webkit-background-size: 100%; 
        -moz-background-size: 100%; 
        -o-background-size: 100%; 
        background-size: 100%; 
      -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
    }
    .page-signin-header {
      box-shadow: 0 2px 2px rgba(0,0,0,.05), 0 1px 0 rgba(0,0,0,.05);
    }

    .page-signin-header .btn {
      position: absolute;
      top: 12px;
      right: 15px;
    }

    html[dir="rtl"] .page-signin-header .btn {
      right: auto;
      left: 15px;
    }

    .page-signin-container {
      width: auto;
      margin: 30px 10px;
    }

    .page-signin-container form {
      border: 0;
      box-shadow: 0 2px 2px rgba(0,0,0,.05), 0 1px 0 rgba(0,0,0,.05);
    }

    @media (min-width: 544px) {
      .page-signin-container {
        width: 350px;
        margin: 60px auto;
      }
    }

    .page-signin-social-btn {
      width: 40px;
      padding: 0;
      line-height: 40px;
      text-align: center;
      border: none !important;
    }

    #page-signin-forgot-form { display: none; }
  </style>
</head>
<body class="pace-done px-navbar-fixed">
  <div class="page-signin-header p-a-2 text-sm-center bg-white"><img src="assets/images/logo.png" height="50px"/>
  </div>

  <!-- Sign In form -->

  <div class="page-signin-container" id="page-signin-form">
    <h2 class="m-t-0 m-b-4 text-xs-center font-weight-semibold font-size-20 text-white">Sign In to your Account</h2>

    <form action="dashboard.php" method="post" class="panel p-a-4">
      <fieldset class=" form-group form-group-lg">
        <input type="text" class="form-control" placeholder="Username or Email">
      </fieldset>

      <fieldset class=" form-group form-group-lg">
        <input type="password" class="form-control" placeholder="Password">
      </fieldset>

      <div class="clearfix">
        <label class="custom-control custom-checkbox pull-xs-left">
          <input type="checkbox" class="custom-control-input">
          <span class="custom-control-indicator"></span>
          Remember me
        </label>
        <a href="#" class="font-size-12 text-muted pull-xs-right" id="page-signin-forgot-link">Forgot your password?</a>
      </div>

      <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3">Sign In</button>
    </form>

   
  </div>

  <!-- / Sign In form -->

  <!-- Reset form -->

  <div class="page-signin-container" id="page-signin-forgot-form">
    <h2 class="m-t-0 m-b-4 text-xs-center font-weight-semibold font-size-20">Password reset</h2>

    <form action="index.html" class="panel p-a-4">
      <fieldset class="form-group form-group-lg">
        <input type="email" class="form-control" placeholder="Your Email">
      </fieldset>

      <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3">Send password reset link</button>
      <div class="m-t-2 text-muted">
        <a href="#" id="page-signin-forgot-back">&larr; Back</a>
      </div>
    </form>
  </div>

  <?php //include "inc_footer.php";?>
  <?php include "inc_script.php";?>
</body>
</html>
