
<section class='content-header'>
	<h1>
		SIAK_AKTIVITAS_MENGAJAR
		<small>Daftar Siak_aktivitas_mengajar</small>
	</h1>
	<ol class='breadcrumb'>
		<li><a href='#'><i class='fa fa-suitcase'></i>Seting</a></li>
		<li class='active'>Daftar Siak_aktivitas_mengajar</li>
	</ol>
</section>        
<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box box-primary'>  
                <div class='box-header with-border'>
                  <h3 class='box-title'><?php echo anchor('siak_aktivitas_mengajar/create/','<i class="glyphicon glyphicon-plus"></i>Tambah Data',array('class'=>'btn btn-primary btn-sm'));?></h3>
                </div><!-- /.box-header -->
                <div class='box-body table-responsive'>
					<table class="table table-bordered table-striped" id="mytable">
						<thead>
							<tr>
								<th width="80px">No</th>
		    <th>Nip</th>
		    <th>Periode</th>
		    <th>Progam Studi</th>
		    <th>Matakuliah</th>
		    <th>Kelas</th>
		    <th>Rencana</th>
		    <th>Realisasi</th>
		    <th>Action</th>
													</tr>
						</thead>
	    <tbody>
							<?php
								$start = 0;
									foreach ($siak_aktivitas_mengajar_data as $siak_aktivitas_mengajar)
										{
											?>
							<tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $siak_aktivitas_mengajar->nip ?></td>
		    <td><?php echo $siak_aktivitas_mengajar->periode ?></td>
		    <td><?php echo $siak_aktivitas_mengajar->progam_studi ?></td>
		    <td><?php echo $siak_aktivitas_mengajar->matakuliah ?></td>
		    <td><?php echo $siak_aktivitas_mengajar->kelas ?></td>
		    <td><?php echo $siak_aktivitas_mengajar->rencana ?></td>
		    <td><?php echo $siak_aktivitas_mengajar->realisasi ?></td>
		    <td style="text-align:center" width="140px">
			<?php 
			echo anchor(site_url('siak_aktivitas_mengajar/read/'.$siak_aktivitas_mengajar->id_mengajar),'<i class="fa fa-eye"></i>',array('data-toggle'=>'tooltip','title'=>'detail','class'=>'btn btn-info btn-sm')); 
			echo '  '; 
			echo anchor(site_url('siak_aktivitas_mengajar/update/'.$siak_aktivitas_mengajar->id_mengajar),'<i class="fa fa-pencil-square-o"></i>',array('data-toggle'=>'tooltip','title'=>'edit','class'=>'btn btn-info btn-sm')); 
			echo '  '; 
			echo anchor(site_url('siak_aktivitas_mengajar/delete/'.$siak_aktivitas_mengajar->id_mengajar),'<i class="fa fa-trash-o"></i>','data-toggle="tooltip" title="delete" class="btn btn-info btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
			?>
		    </td>
	        </tr>
											<?php
										}
										?>
						</tbody>
					</table>					
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			$("#mytable").dataTable();
		});
	</script>
