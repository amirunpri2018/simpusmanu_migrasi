<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function chek_session() {
    $ci = & get_instance();
    if ($ci->session->userdata('status_login') !== 'login_successful') {
        redirect('web');
    }
}
function cek_menu(){
    $ci = & get_instance();
    $gid=$ci->session->userdata('gid');
    $link=$ci->uri->segment(1);
    $cek_menu=$ci->db->get_where('tb_menu_access',array('gid'=>$gid,'allow'=>1,'link'=>$link));
    if($cek_menu->num_rows()==0){
        redirect('dashboard');       
    }
}

function chek_administrator() {
    $ci = & get_instance();
    if ($ci->session->userdata('role') !== 'Administrator') {
        redirect('dashboard');
    }
}

if (!function_exists('active_link')) {

    function active_menu($controller) {
        $CI = get_instance();
        $class = $CI->router->fetch_class();
        return ($class == $controller) ? 'active' : '';
    }

    function active_treeview($controller) {
        $CI = get_instance();
        $class = $CI->router->fetch_class();
        return ($class == $controller) ? 'active treeview' : '';
    }

}

function hp($nohp) {
    // kadang ada penulisan no hp 0811 239 345
    $nohp = str_replace(" ", "", $nohp);
    // kadang ada penulisan no hp (0274) 778787
    $nohp = str_replace("(", "", $nohp);
    // kadang ada penulisan no hp (0274) 778787
    $nohp = str_replace(")", "", $nohp);
    // kadang ada penulisan no hp 0811.239.345 
    $nohp = str_replace(".", "", $nohp);

    // cek apakah no hp mengandung karakter + dan 0-9
    if (!preg_match('/[^+0-9]/', trim($nohp))) {
        // cek apakah no hp karakter 1-3 adalah +62
        if (substr(trim($nohp), 0, 3) == '+62') {
            $hp = trim($nohp);
        }
        // cek apakah no hp karakter 1 adalah 0
        elseif (substr(trim($nohp), 0, 1) == '0') {
            $hp = '+62' . substr(trim($nohp), 1);
        }
    }
    return $hp;
}

function tgl_balik($tanggal) {
    return date('d-m-Y', strtotime($tanggal));
}

function tgl_db($tanggal) {
    return date('Y-m-d', strtotime($tanggal));
}

function tanggal() {
    return date('Y-m-d');
}

function tanggal_indo() {
    return date('d-m-Y H:i:s');
}

function kode_tanggal() {
    return date('dmY');
}

function tanggal_new() {
    /* script menentukan hari */
    $array_hr = array(1 => "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu");
    $hr = $array_hr[date('N')];

    /* script menentukan tanggal */
    $tgl = date('j');
    /* script menentukan bulan */
    $array_bln = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    $bln = $array_bln[date('n')];
    /* script menentukan tahun */
    $thn = date('Y');
    /* script perintah keluaran */
    return $hr . ", " . $tgl . " " . $bln . " " . $thn . " " . date('H:i:s');
}

function rupiah($angka) {
    $rupiah = number_format($angka, 0, ',', '.');
    return $rupiah;
}

function tgl_indo($tgl) {
    $tanggal = substr($tgl, 8, 2);
    $bulan = substr($tgl, 5, 2);
    $tahun = substr($tgl, 0, 4);
    $time = substr($tgl, 11, 5);
    return $tanggal . '-' . $bulan . '-' . $tahun;
}

function tgl_lengkap($tanggals) {

    $tanggal = substr($tanggals, 8, 2);
    $bulan = substr($tanggals, 5, 2);
    $tahun = substr($tanggals, 0, 4);
    $time = substr($tanggals, 11, 5);

    return $tanggal . ' ' . bulan($bulan) . ' ' . $tahun . ' ' . $time;
}

function bulan($bln) {
    switch ($bln) {
        case 1:
            return "Januari";
            break;
        case 2:
            return "Februai";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agtustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
            break;
    }
}

function nama_hari($tanggal) {
    $ubah = gmdate($tanggal, time() + 60 * 60 * 8);
    $pecah = explode("-", $ubah);
    $tgl = $pecah[2];
    $bln = $pecah[1];
    $thn = $pecah[0];

    $nama = date("l", mktime(0, 0, 0, $bln, $tgl, $thn));
    $nama_hari = "";
    if ($nama == "Sunday") {
        $nama_hari = "Minggu";
    } else if ($nama == "Monday") {
        $nama_hari = "Senin";
    } else if ($nama == "Tuesday") {
        $nama_hari = "Selasa";
    } else if ($nama == "Wednesday") {
        $nama_hari = "Rabu";
    } else if ($nama == "Thursday") {
        $nama_hari = "Kamis";
    } else if ($nama == "Friday") {
        $nama_hari = "Jumat";
    } else if ($nama == "Saturday") {
        $nama_hari = "Sabtu";
    }
    return $nama_hari;
}

function sms($nohp, $pesan) {
    $jmlSMS = ceil(strlen($pesan) / 153);
    if ($jmlSMS > 1) {
        longsms($nohp, $pesan);
    } else {

        shortsms($nohp, $pesan);
    }
}

function shortsms($nohp, $pesan) {
    $CI = & get_instance();
    //$nama=$ci->session->userdata('username'); 
    $params = array(
        'SendingDateTime' => date('Y-m-d H:i:s'),
        'DestinationNumber' => $nohp,
        'TextDecoded' => $pesan,
        'CreatorID' => "admin"
    );
    $CI->db->insert('outbox', $params);
}

function longsms($nohp, $pesan) {
    $CI = & get_instance();
    // hitung jumlah sms
    $jmlSMS = ceil(strlen($pesan) / 153);
    // pecah sms
    $pecah = str_split($pesan, 153);
    // baca id terakhir dari tabel outbox
    $sql = $CI->db->query("show table status like 'outbox'")->row_array();
    $newID = $sql['Auto_increment'];
    // random bilangan 1 sampai 225
    $random = rand(1, 255);
    // ubah random ke hedaximal 2 digit
    $headerUDH = sprintf("%02s", strtoupper(dechex($random)));
    // proses insert tiap part sms 
    for ($i = 1; $i <= $jmlSMS; $i++) {
        // kontruksi UDH untuk setiap part
        $udh = "050003" . $headerUDH . sprintf("%02s", $jmlSMS) . sprintf("%02s", $i);
        $msg = $pecah[$i - 1];
        // jika part 1 maka sisipkan ke tabel outbox
        if ($i == 1) {
            $sms = array(
                'DestinationNumber' => $nohp,
                'UDH' => $udh,
                'SendingDateTime' => date('Y-m-d H:i:s'),
                'TextDecoded' => $msg,
                'ID' => $newID,
                'Multipart' => 'true');
            $CI->db->insert('outbox', $sms);
        } else {
            // selain itu ke tabel outbx multipart
            $sms = array(
                'UDH' => $udh,
                'TextDecoded' => $msg,
                'ID' => $newID,
                'SequencePosition' => $i);
            $CI->db->insert('outbox_multipart', $sms);
        }
    }
}
