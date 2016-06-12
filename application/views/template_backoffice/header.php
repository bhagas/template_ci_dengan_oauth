<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="IHT">
        <meta name="author" content="Disperindag">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.ico">
        <title>Main Title</title>
        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/theme.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/ui.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/leaflet.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/Control.FullScreen.css" rel="stylesheet">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
        <!-- BEGIN PAGE STYLE -->
        <!-- <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css" rel="stylesheet"> -->
        <link href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/L.Control.Locate.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/leaflet-routing-machine.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/leaflet.extra-markers.css" />
        <!-- END PAGE STYLE -->
        <script type="text/javascript">
            var root = '<?php echo base_url() ?>';
        </script>
        <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery-1.11.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery-migrate-1.2.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/jquery-ui/jquery-ui-1.11.2.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/leaflet.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/modernizr/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <script src="http://maps.google.com/maps/api/js?v=3.2&sensor=false"></script>
        <script src="<?php echo base_url(); ?>assets/js/google-leaf.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/Control.FullScreen.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/L.Control.Locate.js" ></script>
        <script src="<?php echo base_url(); ?>assets/js/leaflet-routing-machine.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/leaflet.extra-markers.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/leaflet-image.js"></script>
        <!--
        <script src="<?php echo base_url(); ?>assets/js/topojson.v1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/chroma.min.js"></script>
        -->
        <script src="<?php echo base_url(); ?>assets/plugins/noty/jquery.noty.packaged.min.js"></script>  <!-- Notifications -->
        <script src="<?php echo base_url(); ?>assets/js/amcharts/amcharts.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/amcharts/serial.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/amcharts/pie.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/1.4.5/numeral.min.js"></script>
    </head>
    <body class="fixed-topbar fixed-sidebar theme-sdtl color-green">
        <!--[if lt IE 7]>
        <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <section>
            <!-- BEGIN SIDEBAR -->
            <div class="sidebar">
                <div class="logopanel">
                    <h1>
                        Nama Aplikasi
                        <a href="<?php echo base_url('index.php/home') ?>"></a>
                    </h1>
                </div>
                <div class="sidebar-inner">
                    <div class="sidebar-top">
                    
                    </div>

                    <ul class="nav nav-sidebar">
                        <li><a href="<?php echo base_url('index.php/home') ?>"><i class="icon-home"></i><span data-translate="dashboard">Dashboard</span></a></li>
                        <li class="nav-parent">
                            <a href=""><i class="icon-note"></i><span data-translate="forms">Data Master </span><span class="fa arrow"></span></a>
                            <ul class="children collapse">
                                <!-- <li><a href="<?php echo base_url('index.php/master/kabupaten') ?>"> Master Kabupaten</a></li> -->
                                <li><a href="<?php echo base_url('index.php/kecamatan/show') ?>"> Master Kecamatan</a></li>
                                <li><a href="<?php echo base_url('index.php/kelurahan/show') ?>"> Master Kelurahan</a></li>
                            </ul>
                        </li>
                        <li class="nav-parent">
                            <a href=""><i class="icon-wrench"></i><span data-translate="forms">Pengaturan </span><span class="fa arrow"></span></a>
                            <ul class="children collapse">
                                <li><a href="<?php echo base_url('index.php/user') ?>"> Management User</a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo base_url('index.php/logout') ?>" onclick="return confirm('Apakah Anda Yakin Untuk Keluar Dari Sistem?')"><i class="icon-logout c-red"></i><span class="c-red">Logout </span></a></li>
                    </ul>
                </div>
            </div>
            <!-- END SIDEBAR -->
            <div class="main-content">
                <!-- BEGIN TOPBAR -->
                <div class="topbar">
                    <div class="header-left">
                        <div class="topnav">
                            <a class="menutoggle" href="#" data-toggle="sidebar-collapsed"><span class="menu__handle"><span>Menu</span></span></a>
                        </div>
                    </div>
                    <div class="header-right">
                        <ul class="header-menu nav navbar-nav">
                            <!-- BEGIN USER DROPDOWN -->
                                <li class="dropdown" id="user-header">
                                    <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                        <span class="username">Selamat Datang, <?php echo $this->session->userdata('username'); ?>!</span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="<?php echo base_url('index.php/user/'.$this->session->userdata('id_user')) ?>"><i class="icon-settings"></i><span>Ganti Password</span></a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('index.php/logout') ?>"><i class="icon-logout c-red"></i><span class="c-red">Logout</span></a>
                                        </li>
                                    </ul>
                                </li>
                            <!-- END USER DROPDOWN -->
                        </ul>
                    </div>
                    <!-- header-right -->
                </div>
        <!-- END TOPBAR -->