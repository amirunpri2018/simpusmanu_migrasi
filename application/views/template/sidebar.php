<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->

        <div class="user-panel">
            <div class="pull-left image">
                <?php 
                $group_icon=$this->session->userdata('group_apps');
                if($group_icon=="SIMPEG"){
                    $icon='human.png';
                    $name='Informasi Pegawai';
                }else if($group_icon=="SIP"){
                    $icon='icon-surat.png';
                    $name='Informasi Persuratan';
                }else if($group_icon=="SIMA"){
                    $icon='icon-aset.png';
                    $name='Managemen Aset';
                }else{
                    $icon='icon-sarjana.png';
                    $name='Siakad Kampus';
                }
                ?>
                <img src="<?php echo base_url('assets/images/'.$icon); ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?php echo $group_icon;?></p>
                <p><?php echo $name; ?>  </p>
            </div>
        </div>
        <br>
        <ul class="sidebar-menu">
            <li class="header bg-blue-active">MAIN NAVIGATION</li> 
            <?php
            $gid = $this->session->userdata('gid');
            $main = $this->db->get_where('tb_menu_access', array('parent' => 0, 'gid' => $gid, 'allow' => '1'))->result();
            foreach ($main as $m) {
                $sub = $this->db->get_where('tb_menu_access', array('parent' => $m->child, 'gid' => $gid, 'allow' => '1'));
                if ($sub->num_rows() > 0) {
                    $uri = $this->uri->segment(1);
                    $idclass = $this->db->get_where('tb_menu_access', array('link' => $uri))->row_array();
                    if ($m->child == $idclass['parent']) {
                        $class = "active treeview";
                    } else {
                        $class = "";
                    }
                    echo '<li class=' . $class . '>' . anchor($m->link, '<i class="' . $m->icon . '"></i>
                            <span class="treeview">' . strtoupper($m->nama_menu) . '</span>
                            <b class="fa fa-angle-left pull-right"></b>', array('class' => 'dropdown-toggle'));
                    echo "<ul class='treeview-menu'>";
                    foreach ($sub->result() as $s) {
                        $uri = $this->uri->segment(1);
                        if ($s->link == $uri) {
                            $class1 = "active treeview";
                        } else {
                            $class1 = "";
                        }
                        echo '<li class=' . $class1 . '>' . anchor($s->link, '<i class="' . $s->icon . '"></i>' . strtoupper($s->nama_menu)) . '</li>';
                    }
                    echo '</ul>';
                    echo '</li>';
                } else {
                    // single menu
                    $uri = $this->uri->segment(1);
                    if ($m->link == $uri) {
                        $class2 = "active";
                    } else {
                        $class2 = "";
                    }
                    echo '<li class=' . $class2 . '>' . anchor($m->link, '<i class="' . $m->icon . ' fa-lg">
                            </i>  <span class="treeview">' . strtoupper($m->nama_menu) . '</span>') . '</li>';
                }
            }
            ?>
        </ul><!--/.nav-list-->             
    </section>
    <!-- /.sidebar -->
</aside>
