<!-- BEGIN PAGE CONTENT -->
<div class="page-content">
    <div class="header">
        <h2>Selamat <strong> Datang</strong></h2>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url() ?>">Home</a>
                </li>
                <li class="active">Home Page</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 portlets">
            <div class="panel">
                <div class="panel-header">
                </div>
                <div class="panel-content">
                    <button class="btn btn-sm btn-info" id="check_noty">Check notif</button>
                    <!-- <div id="noty"></div> -->
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="copyright">
        <p class="pull-left sm-pull-reset">
            <span>Copyright <span class="copyright">©</span> 2015 </span>
            <span>{{ Nama Dinas }}</span>.
        </p>
        </div>
    </div>
</div>
<!-- END PAGE CONTENT -->
<script type="text/javascript">
  

  $('#check_noty').click(function () {
    var content   = 'ini konten notifikasiku';
    var n = noty({
              layout :'topRight',
              text : content,
              type: 'success',
              timeout: 5000,
              theme: 'defaultTheme', // or 'relax'
              animation : {
                            open: 'animated fadeInRight', // Animate.css class names
                            close: 'animated fadeOutDown', // Animate.css class names
                            easing: 'swing', // unavailable - no need
                            speed: 500 // unavailable - no need
                          },
              callback : {
                afterClose : function () {
                  // window.location = url;
                }
              }
            });
  })
</script>