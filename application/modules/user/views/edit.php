<section class="content-header">
    <h1>
        Edit
        <small>User Pengguna</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Seting</a></li>
        <li class="active">Users</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                <div class="col-md-5">
                <?php
                    echo form_open('user/edit');
                ?>                    
                    <div class="box-body">
                        <input type="hidden"  name="id" value="<?php echo $record['id_user'] ?>" >
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" class="form-control" disabled name="username" value="<?php echo $record['username']; ?>">
                            <?php echo form_error('username', '<div class="text-red">', '</div>'); ?>
                        </div> 
                        <div class="form-group">
                            <label for="example">Nama Pengguna</label>                            
                            <input type="text" name="nama" class="form-control" required oninvalid="setCustomValidity('Username Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Nama Pengguna" value="<?php echo $record['nama_pengguna']; ?>" >
                                   <?php echo form_error('nama', '<div class="text-red">', '</div>'); ?>
                        </div>                                           
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" class="form-control" name="email" required oninvalid="setCustomValidity('Nama Lengkap Masih Kosong!')"
                                   oninput="setCustomValidity('')" placeholder="Nama Penggguna" value="<?php echo $record['email']; ?>">
                            <?php echo form_error('email', '<div class="text-red">', '</div>'); ?>
                        </div> 
                        <div class="form-group">
                            <label for="">Group User</label>
                            <select name='group' class="form-control ">                           
                                <?php
                                if (!empty($group)) {
                                    foreach ($group as $g) {
                                        echo "<option value='$g->gid'";
                                        echo $record['gid'] == $g->gid ? 'selected' : '';
                                        echo">$g->usergroup</option>";
                                    }
                                }
                                ?>
                            </select>
                            <?php echo form_error('group', '<div class="text-red">', '</div>'); ?>
                        </div>
                        
                         <div class="form-group">
                            <label for="">Password (jika merubah password)</label>
                            <input type="password" class="form-control" name="passwd"  placeholder="Password">
                            
                        </div>                                            
                    </div>
                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
                        <a href="<?php echo site_url('user'); ?>" class="btn btn-primary">Kembali</a>
                    </div>
                </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>