<!-- BEGIN PAGE CONTENT -->
        <div class="page-content page-wizard">
          <div class="header">
            <h2>Tambah <strong> User</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="<?php echo base_url()?>">Home</a>
                </li>
                <li class="active">Tambah Data User</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="panel">
                <div class="panel-content">
                  <div class="row">
                    <div class="col-md-6">
                      <?php echo validation_errors(); ?>
                      <form role="form" role="form" method="post" action="<?php echo base_url('index.php/user/edit/submit') ?>">
                        <input type="hidden" name="id_user" value="<?php echo $users[0]['id_user'] ?>">
                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-12">
                              <label>Username</label>
                              <input type="text" class="form-control" name="username" value="<?php echo $users[0]['username'] ?>">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-12">
                              <label>Password</label>
                              <input type="password" class="form-control" name="password">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-12">
                              <label>Ulangi Password</label>
                              <input type="password" class="form-control" name="password2">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-12">
                              <label>Fullname</label>
                              <input type="text" class="form-control" name="fullname" value="<?php echo $users[0]['fullname'] ?>">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-12">
                              <label>NIP</label>
                              <input type="text" class="form-control" name="nip" value="<?php echo $users[0]['NIP'] ?>">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-12">
                              <label>Email</label>
                              <input type="text" class="form-control" name="email" value="<?php echo $users[0]['email'] ?>">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-12">
                              <label>Telepon</label>
                              <input type="text" class="form-control" name="telp" value="<?php echo $users[0]['telp'] ?>">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-12">
                              <button type="submit" class="btn btn-square btn-primary"><i class="fa fa-plus"></i> Edit</button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="footer">
            <div class="copyright">
              <p class="pull-left sm-pull-reset">
                <span>Copyright <span class="copyright">©</span> 2015 </span>
                <span>Dinas Perindustrian & Perdagangan</span>.
              </p>
            </div>
          </div>
        </div>
        <!-- END PAGE CONTENT -->