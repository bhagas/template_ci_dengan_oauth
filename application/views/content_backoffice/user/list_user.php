<!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
          <div class="header">
            <h2>Manajemen <strong>User</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="<?php echo base_url()?>">Home</a>
                </li>
                <li class="active">Manajemen User</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="panel">
                <div class="panel-header">
                  
                </div>
                <div class="panel-content">
                  <div class="row">
                    <div class="col-md-5">
                      <a href="<?php echo base_url('index.php/user/add')?>" class="btn btn-sm btn-info btn-square"><i class="fa fa-plus"></i> Tambah User</a>
                    </div>
                  </div>
                  <table class="table table-hover table-dynamic" id="">
                    <thead>
                      <tr>
                        <th>Username</th>
                        <th>Nama Lengkap</th>
                        <th>NIP</th>
                        <th>Email</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($users as $user): ?>
                        <tr>
                          <td><?php echo $user['username'] ?></td>
                          <td><?php echo $user['fullname'] ?></td>
                          <td><?php echo $user['NIP'] ?></td>
                          <td><?php echo $user['email'] ?></td>
                          <td>
                            <a href="<?php echo base_url('index.php/user/'.$user['id_user']) ?>" class="btn btn-sm btn-square btn-success"><i class="fa fa-pencil-square-o"></i></a>
                            <a href="<?php echo base_url('index.php/user/delete/'.$user['id_user']) ?>" class="btn btn-square btn-sm btn-danger" onclick="return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini?')"><i class="fa fa-ban"></i></a>
                          </td>
                        </tr>
                      <?php endforeach ?>
                    </tbody>
                  </table>
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