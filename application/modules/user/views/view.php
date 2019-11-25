<section class="content-header">
    <h1>
        Users Pengguna
        <small>Seting Users</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Seting</a></li>
        <li class="active">Users</li>
    </ol>
</section>
<section class="content">   

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class='box-header with-border'>
                    <h3 class='box-title'><a href="<?php echo base_url('user/add'); ?>" class="btn btn-primary btn-small">
                      <i class="glyphicon glyphicon-plus"></i> Tambah Data</a></h3>
                  <label calss='control-label' ></label>
                </div>
                <div class="box-body table-responsive">
                    <table id="mytable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Username</th>
                                <th>Nama Pengguna</th>
                                <th>Email</th>
                                <th>User Group</th>
                                <th>Status</th> 
                                <th>Edit</th>   
                                <th>Delete</th>                                 
                            </tr>
                        </thead>
                       <?php
                       $no=1;                       
                       foreach ($record as $r){
                       $gid=$this->db->get_where('tb_groups',array('gid'=>$r->gid))->row_array();  
                           echo"
                               <tr>
                               <td>$no</td>
                               <td>".$r->username."</td>
                               <td>".$r->nama_pengguna."</td>
                               <td>".$r->email."</td>
                               <td>".$gid['usergroup']."</td> 
                               ";?>                             
                               <td><?php echo ($r->aktif) ? anchor("user/deactivate/".$r->id_user,'Aktif') : anchor("user/activate/". $r->id_user, 'Tidak Aktif');?></td>
                               <?php echo"
                               <td>" . anchor('user/edit/' . $r->id_user, '<i class="btn btn-info btn-sm glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit"></i>') . "</td>
                               <td>" . anchor('user/delete/' . $r->id_user, '<i class="btn-sm btn-info glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete"></i>', array('onclick' => "return confirm('Data Akan di Hapus?')")) . "</td>
                               </tr>";
                           $no++;
                       }
                       ?>
                    </Table> 
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</section>
<script src="<?php echo base_url('assets/datatables/jquery-1.11.3.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.min.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#mytable").dataTable();
    });
</script>
