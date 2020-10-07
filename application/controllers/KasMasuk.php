<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');


class KasMasuk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->model('M_Setting');
        $this->load->model('M_Akses');
        $this->load->model('M_KasMasuk');
        cek_login_user();
    }
    public function index()
    {

        $id = $this->session->userdata('tipeuser');
        $data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'kas masuk'])->row()->id_menus;
        $data['menu'] = $this->M_Setting->getmenu1($id);
        $data['km'] = $this->M_KasMasuk->getAll();
        $data['akses'] = $this->M_Akses->getByLinkSubMenu(urlPath(), $id);

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_kasmasuk/v_kasmasuk', $data);
        $this->load->view('template/footer');
    }
    public function tambah()
    {
        $id = $this->session->userdata('tipeuser');
        $data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'kas masuk'])->row()->id_menus;
        $data['menu'] = $this->M_Setting->getmenu1($id);

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_kasmasuk/v_kasmasuk_add', $data);
        $this->load->view('template/footer');
    }
    public function tambahdata()
    {
        $kodekasmasuk = $this->M_KasMasuk->kasMasuk();
        $id = $this->session->userdata('tipeuser');
        // $saldo = $this->db->query("SELECT * FROM tb_historikas ORDER BY id_histori_kas DESC LIMIT 1")->row_array();
        // $hasil = intval($saldo['saldo']) + intval(preg_replace("/[^0-9]/", "", $this->input->post('nominal')));
        // var_dump($hasil);
        $data = [
            'tgltransaksi' => $this->input->post('tglTransaksi') . date('h:i:s'),
            'keterangan' => $this->input->post('keterangan'),
            'nominal' => preg_replace("/[^0-9]/", "", $this->input->post('nominal')),
            'kode_kas_masuk' => $kodekasmasuk,
            'id_user' => $id,
            'statusjurnal' => '0'
        ];

        $dataHistori = [
            'kode_kas' => $kodekasmasuk,
            'jenis' => 'kas masuk',
            'nominal' => preg_replace("/[^0-9]/", "", $this->input->post('nominal')),
            'saldo' => 0,
            'tgltransaksi' => $this->input->post('tglTransaksi'),
        ];

        $this->M_KasMasuk->tambah($data);
        $this->M_KasMasuk->tambahHisto($dataHistori);
        $this->session->set_flashdata('message', '<div class="alert alert-success left-icon-alert" role="alert"> <strong>Sukses!</strong> Data Berhasil DiTambahkan</div>');
        redirect('kasmasuk');
        // $kodekasmasuk = $this->M_KasMasuk->kasMasuk();
        // $id = $this->session->userdata('tipeuser');
        // $nominall = preg_replace("/[^0-9]/", "", $this->input->post('nominal'));

        // $data = [
        //     'tgltransaksi' => $this->input->post('tglTransaksi') . date(' h:i:s'),
        //     'keterangan' => $this->input->post('keterangan'),
        //     'nominal' => $nominall,
        //     'kode_kas_masuk' => $kodekasmasuk,
        //     'id_user' => $id,
        //     'statusjurnal' => '0'
        // ];
        // $this->M_KasMasuk->tambah($data);

        // $harii = date('d', strtotime($this->input->post('tglTransaksi')));
        // $saldo = $this->db->query("SELECT sum(saldo) as saldo FROM tb_historikas")->row_array();
        // $kmrin = $this->db->query("SELECT * FROM tb_historikas WHERE DAY(tgltransaksi) > " . intval($harii))->num_rows();
        // if ($kmrin >= 1) {
        //     $hariini = intval($harii) + 1;
        //     $dbet = $this->db->query("SELECT sum(nominal) as nominal FROM tb_historikas WHERE jenis ='kas masuk' AND DAY(tgltransaksi) < " . $hariini)->row_array();
        //     $krdi = $this->db->query("SELECT sum(nominal) as nominal FROM tb_historikas WHERE jenis ='kas keluar' AND DAY(tgltransaksi) < " . $hariini)->row_array();
        //     $hariinii = $this->db->query("SELECT * FROM tb_historikas WHERE DAY(tgltransaksi) > " . $harii)->result_array();
        //     $hasil = $dbet['nominal'] - $krdi['nominal'] + $nominall;
        //     $dataHistori = [
        //         'kode_kas' => $kodekasmasuk,
        //         'jenis' => 'kas masuk',
        //         'nominal' => $nominall,
        //         'saldo' => $hasil,
        //         'tgltransaksi' => $this->input->post('tglTransaksi') . date(' h:i:s'),
        //     ];
        //     $this->M_KasMasuk->tambahHisto($dataHistori);


        //     foreach ($hariinii as $data) {
        //         $hasil =  $data['saldo'] + $nominall;
        //         $this->db->where("kode_kas", $data['kode_kas']);
        //         $this->db->update('tb_historikas', ['saldo' => $hasil]);
        //     }
        // } else {
        //     $dbet = $this->db->query("SELECT sum(nominal) as nominal FROM tb_historikas WHERE jenis ='kas masuk'")->row_array();
        //     $krdi = $this->db->query("SELECT sum(nominal) as nominal FROM tb_historikas WHERE jenis ='kas keluar'")->row_array();
        //     $hasil = intval($dbet['nominal']) - intval($krdi['nominal']) + intval($nominall);
        //     $dataHistori = [
        //         'kode_kas' => $kodekasmasuk,
        //         'jenis' => 'kas masuk',
        //         'nominal' => $nominall,
        //         'saldo' => $hasil,
        //         'tgltransaksi' => $this->input->post('tglTransaksi') . date(' h:i:s'),
        //     ];
        //     $this->M_KasMasuk->tambahHisto($dataHistori);
        // }

        // $this->session->set_flashdata('message', '<div class="alert alert-success left-icon-alert" role="alert"> <strong>Sukses!</strong> Data Berhasil DiTambahkan</div>');
        // redirect('kasmasuk');
    }

    // public function hapus($kode)
    // {
    //     $b1 = $this->db->query("SELECT * FROM tb_historikas WHERE kode_kas = '" . $kode . "'")->row_array();
    //     $querya = "SELECT * FROM tb_historikas";
    //     $a = $this->db->query($querya)->result_array();
    //     $j = $this->db->query($querya)->num_rows();
    //     $i = 0;
    //     foreach ($a as $data) {
    //         $i++;
    //         $pertama = $this->db->query("SELECT * FROM tb_historikas LIMIT 1")->row_array();
    //         $terakhir = $this->db->query("SELECT * FROM tb_historikas ORDER BY id_histori_kas DESC LIMIT 1")->row_array();
    //         if ($data['kode_kas'] == $pertama['kode_kas']) {
    //             $awal = $i;
    //             $queryb = "SELECT * FROM tb_historikas LIMIT " . intval($awal) . "," . intval($j);
    //             $b = $this->db->query($queryb)->result_array();
    //             foreach ($b as $datab) {
    //                 $hasil = $datab['saldo'] - $b1['saldo'];
    //                 $datah = [
    //                     'saldo' => $hasil
    //                 ];
    //                 $this->db->where('kode_kas', $datab['kode_kas']);
    //                 $this->db->update('tb_historikas', $datah);
    //             }
    //             $this->db->where('kode_kas', $kode);
    //             $this->db->delete('tb_historikas');
    //             $this->M_KasMasuk->hapus($kode);
    //         } else if ($data['kode_kas'] == $terakhir['kode_kas']) {
    //             $this->db->where('kode_kas', $kode);
    //             $this->db->delete('tb_historikas');
    //             $this->M_KasMasuk->hapus($kode);
    //         } else {
    //             $awal = $i;
    //             $queryb = "SELECT * FROM tb_historikas LIMIT " . intval($awal) . "," . intval($j);
    //             $b = $this->db->query($queryb)->result_array();
    //             foreach ($b as $datab) {
    //                 $hasil = $datab['saldo'] - $b1['saldo'];
    //                 $datah = [
    //                     'saldo' => $hasil
    //                 ];
    //                 $this->db->where('kode_kas', $datab['kode_kas']);
    //                 $this->db->update('tb_historikas', $datah);
    //             }
    //             $this->db->where('kode_kas', $kode);
    //             $this->db->delete('tb_historikas');
    //             $this->M_KasMasuk->hapus($kode);
    //         }
    //     }

    //     $this->M_KasMasuk->hapus($kode);
    //     $this->session->set_flashdata('message', '<div class="alert alert-success left-icon-alert" role="alert"> <strong>Sukses!</strong> Data Berhasil DiHapus</div>');
    //     redirect('kasmasuk');
    // }
    public function hapus($kode)
    {
        $this->db->where('kode_kas', $kode);
        $this->db->delete('tb_historikas');
        $this->M_KasMasuk->hapus($kode);
        $this->session->set_flashdata('message', '<div class="alert alert-success left-icon-alert" role="alert"> <strong>Sukses!</strong> Data Berhasil DiHapus</div>');
        redirect('kasmasuk');
    }

    public function ubah($kode)
    {
        $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1($id);
        $data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'kas masuk'])->row()->id_menus;
        $data['km'] = $this->M_KasMasuk->getById($kode);
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_kasmasuk/v_kasmasuk_edit', $data);
        $this->load->view('template/footer');
    }
    public function ubahdata()
    {
        $kode = $this->input->post('kode');
        $id = $this->session->userdata('tipeuser');
        $nominal = preg_replace("/[^0-9]/", "", $this->input->post('nominal'));

        $datar = [
            'nominal' => $nominal,
            'saldo' => 0,
            'tgltransaksi' => $this->input->post('tglTransaksi')
        ];
        $data = [
            'tgltransaksi' => $this->input->post('tglTransaksi') . date(' h:i:s'),
            'keterangan' => $this->input->post('keterangan'),
            'nominal' => preg_replace("/[^0-9]/", "", $this->input->post('nominal')),
            'kode_kas_masuk' => $kode,
            'id_user' => $id,
            'statusjurnal' => '0'
        ];
        $this->M_KasMasuk->ubah($data, $kode);
        $this->db->where('kode_kas', $kode);
        $this->db->update('tb_historikas', $datar);

        // $b1 = $this->db->query("SELECT * FROM tb_historikas WHERE kode_kas = '" . $kode . "'")->row_array();
        // $dbet = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis ='kas masuk'")->row_array();
        // $kreddi = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis='kas keluar'")->row_array();
        // $saldo = $dbet['nominal'] - $kreddi['nominal'];
        // $querya = "SELECT * FROM tb_historikas";
        // $a = $this->db->query($querya)->result_array();
        // $j = $this->db->query($querya)->num_rows();
        // $i = 0;
        // foreach ($a as $data) {
        //     $i++;
        //     if ($data['kode_kas'] == $kode) {
        //         $awal = $i;
        //         $queryb = "SELECT * FROM tb_historikas LIMIT " . intval($awal) . "," . intval($j);
        //         $b = $this->db->query($queryb)->result_array();
        //         $c = $this->db->query($queryb)->num_rows();

        //         if ($c >= 1) {
        //             foreach ($b as $data1) {
        //                 $saldodia = $b1['saldo'];
        //                 $hasildia = $saldodia - $b1['nominal'] + $nominal;
        //                 $hasil = $hasildia + $data1['nominal'];
        //                 $datadia = [
        //                     'nominal' => $nominal,
        //                     'saldo' => $hasildia,
        //                     'tgltransaksi' => $this->input->post('tglTransaksi') . date(' h:i:s')
        //                 ];

        //                 $datar = ['saldo' => $hasil];
        //                 $data = [
        //                     'tgltransaksi' => $this->input->post('tglTransaksi') . date(' h:i:s'),
        //                     'keterangan' => $this->input->post('keterangan'),
        //                     'nominal' => preg_replace("/[^0-9]/", "", $this->input->post('nominal')),
        //                     'kode_kas_masuk' => $kode,
        //                     'id_user' => $id,
        //                     'statusjurnal' => '0'
        //                 ];
        //                 $this->M_KasMasuk->ubah($data, $kode);
        //                 $this->db->where('kode_kas', $kode);
        //                 $this->db->update('tb_historikas', $datadia);
        //                 $this->db->where('kode_kas', $data1['kode_kas']);
        //                 $this->db->update('tb_historikas', $datar);
        //             }
        //         } else {
        //             $hasildia = $saldo - $b1['nominal'] + $nominal;


        //         }
        //     }
        // }

        // $data = [
        //     'tgltransaksi' => $this->input->post('tglTransaksi') . date(' h:i:s'),
        //     'keterangan' => $this->input->post('keterangan'),
        //     'nominal' => preg_replace("/[^0-9]/", "", $this->input->post('nominal')),
        //     'kode_kas_masuk' => $kodekasmasuk,
        //     'id_user' => $id,
        //     'statusjurnal' => '0'
        // ];
        // $this->M_KasMasuk->ubah($data, $kodekasmasuk);

        // $hasildia = intval(preg_replace("/[^0-9]/", "", $this->input->post('nominal')));
        // $saldo = $this->db->query("SELECT * FROM tb_historikas ORDER BY id_histori_kas DESC LIMIT 1")->row_array();
        // $ssss = $this->db->query("SELECT * FROM tb_historikas WHERE kode_kas = '" . $kodekasmasuk . "'")->row_array();
        // $nominalSebelum = $ssss['nominal'];
        // $hasil = intval($saldo['saldo']) - intval($nominalSebelum) + intval($hasildia);
        // $dataaa = [
        //     'saldo' => $hasil
        // ];
        // $dataHistori = [
        //     'nominal' => preg_replace("/[^0-9]/", "", $this->input->post('nominal')),
        //     'saldo' => $hasildia,
        //     'tgltransaksi' => $this->input->post('tglTransaksi') . date(' h:i:s'),
        // ];
        // $this->db->where('kode_kas', $kodekasmasuk);
        // $this->db->update('tb_historikas', $dataHistori);
        // $this->db->where('kode_kas', $saldo['kode_kas']);
        // $this->db->update('tb_historikas', $dataaa);

        // // $this->M_KasMasuk->tambahHisto($dataHistori);
        // // var_dump($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success left-icon-alert" role="alert"> <strong>Sukses!</strong> Data Berhasil DiUbah</div>');
        redirect('kasmasuk');
    }
}
