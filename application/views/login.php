<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content="" name="description" />
        <meta content="themes-lab" name="author" />
        <link rel="shortcut icon" href="<?php echo base_url()?>assets/images/favicon.ico">
        <link href="<?php echo base_url()?>assets/css/style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/theme.css" rel="stylesheet">
        <link href="<?php echo base_url()?>assets/css/ui.css" rel="stylesheet">
        <link href="<?php echo base_url()?>assets/plugins/bootstrap-loading/lada.min.css" rel="stylesheet">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
        <script type="text/javascript">
            var root = '<?php echo base_url() ?>';
        </script>
    </head>
    <body class="account" data-page="login">
        <!-- BEGIN LOGIN BOX -->
        <div class="container" id="login-block">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <!-- <img src="<?php echo base_url()?>assets/images/logo/logo.png"/ class="login-logo col-md-12"> -->
                    <div class="login-logo col-md-12">
                        <center><h1>NAMA APLIKASI<BR></h1></center>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-md-offset-4">
                    <div class="account-wall" style="background-color: rgb(255, 255, 255);">
                        <h2><center>LOGIN</center></h2>
                        <div class="row p-r-10 p-l-10">
                          <div class="col-md-12 m-b-10 p-10 f-14" id="login_result"></div>
                        </div>
                        <form class="form-signin" role="form" method="post" id="form_login"> 
                            <div class="append-icon">
                                <input type="text" name="user" id="" class="form-control form-white username" placeholder="Username" required>
                                <i class="icon-user"></i>
                            </div>
                            <br/>
                            <div class="append-icon m-b-20">
                                <input type="password" name="password" class="form-control form-white password" placeholder="Password" required>
                                <i class="icon-lock"></i>
                            </div>
                            <button type="submit" id="" class="btn btn-lg btn-primary btn-block ladda-button" data-style="expand-left">LOGIN</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?php echo base_url()?>assets/plugins/jquery/jquery-1.11.1.min.js"></script>
        <script src="<?php echo base_url()?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url()?>assets/plugins/backstretch/backstretch.min.js"></script>
        <script src="<?php echo base_url()?>assets/plugins/bootstrap-loading/lada.min.js"></script>
        <script src="<?php echo base_url()?>assets/js/login.js"></script>
    </body>
</html>