

<!-- BEGIN PAGE CONTENT -->
<div class="page-content">
    <div class="header">
        <h2>Data <strong> Kecamatan</strong></h2>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url() ?>">Home</a>
                </li>
                <li class="active">Data Kecamatan</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 portlets">
            <div class="panel">
                <div class="panel-header">
                </div>
                <div class="panel-content">
                    <table class="table table-striped table-bordered table-hover" id="master_table">
                    <thead>
                    	<tr>
                    		<th>
                    			 No
                    		</th>
                    		<th>
                    			 Kecamatan
                    		</th>
                    		<th>
                    			 No. Kecamatan
                    		</th>
                    		
                    	</tr>
                    </thead>
                    <tbody>
                    		<?php $i=1; foreach ($kecamatan as $item): ?>
                    			<tr class="odd gradeX">
                    				<td width="10">
                    					<?php echo $i++ ?>
                    				</td>
                    				<td>
                    					<?php echo $item['nama_kecamatan'] ?>
                    				</td>
                    				<td>
                    					<?php echo $item['id_kecamatan'] ?>
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
            <span>{{ Nama Dinas }}</span>.
        </p>
        </div>
    </div>
</div>
<!-- END PAGE CONTENT -->