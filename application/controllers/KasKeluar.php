<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');


class KasKeluar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->model('M_Setting');
        $this->load->model('M_Akses');
        $this->load->model('M_KasKeluar');

        cek_login_user();
    }
    public function index()
    {
        $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1($id);
        $data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'kas keluar'])->row()->id_menus;
        $data['kk'] = $this->M_KasKeluar->getAll();
        $data['akses'] = $this->M_Akses->getByLinkSubMenu(urlPath(), $id);

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_kaskeluar/v_kaskeluar', $data);
        $this->load->view('template/footer');
    }
    public function tambah()
    {
        $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1($id);
        $data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'kas keluar'])->row()->id_menus;
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_kaskeluar/v_kaskeluar_add', $data);
        $this->load->view('template/footer');
    }

    public function tambahdata()
    {
        $kodekaskeluar = $this->M_KasKeluar->kodekaskeluar();
        $id = $this->session->userdata('tipeuser');
        // $saldo = $this->db->query("SELECT * FROM tb_historikas ORDER BY id_histori_kas DESC LIMIT 1")->row_array();
        // $hasil = intval($saldo['saldo']) - intval(preg_replace("/[^0-9]/", "", $this->input->post('nominal')));
        $month = date('m');
        $dbet = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk' AND MONTH(tgltransaksi) = " . intval($month) . " ")->row_array();
        $kreddi = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar' AND MONTH(tgltransaksi) = " . intval($month) . "")->row_array();
        $sa = intval($dbet['nominal']) - intval($kreddi['nominal']);
        $data = [
            'tgltransaksi' => $this->input->post('tglTransaksi'),
            'keterangan' => $this->input->post('keterangan'),
            'nominal' => preg_replace("/[^0-9]/", "", $this->input->post('nominal')),
            'kode_kas_keluar' => $kodekaskeluar,
            'id_user' => $id,
        ];

        $dataHistori = [
            'kode_kas' => $kodekaskeluar,
            'jenis' => 'kas keluar',
            'nominal' => preg_replace("/[^0-9]/", "", $this->input->post('nominal')),
            'saldo' => 0,
            'tgltransaksi' => $this->input->post('tglTransaksi')
        ];

        if (preg_replace("/[^0-9]/", "", $this->input->post('nominal')) > $sa) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning left-icon-alert" role="alert"> <strong>Warning! </strong>Nominal Terlalu Besar Dari Saldo, Saldo Bulan ini tinggal Rp. ' . number_format($sa) . '</div>');
            redirect('kaskeluar/tambah');
        } else {
            $this->M_KasKeluar->tambah($data);
            $this->M_KasKeluar->tambahHisto($dataHistori);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success left-icon-alert" role="alert"> <strong>Sukses!</strong> Data Berhasil DiTambahkan</div>');
        redirect('kaskeluar');
    }
    public function hapus($kode)
    {

        // $b1 = $this->db->query("SELECT * FROM tb_historikas WHERE kode_kas = '" . $kode . "'")->row_array();
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
        //                 $hasil = $data1['saldo'] + $b1['nominal'];
        //                 $datah = [
        //                     'saldo' => $hasil
        //                 ];
        //                 $this->db->where('kode_kas', $data1['kode_kas']);
        //                 $this->db->update('tb_historikas', $datah);
        //                 $this->db->where('kode_kas', $kode);
        //                 $this->db->delete('tb_historikas');
        //                 $this->db->where('kode_kas_keluar', $kode);
        //                 $this->db->delete('tb_kaskeluar');
        //             }
        //         } else {
        //         }
        //     }
        // }

        $this->db->where('kode_kas', $kode);
        $this->db->delete('tb_historikas');
        $this->db->where('kode_kas_keluar', $kode);
        $this->db->delete('tb_kaskeluar');
        $this->session->set_flashdata('message', '<div class="alert alert-success left-icon-alert" role="alert"> <strong>Sukses!</strong> Data Berhasil DiHapus</div>');
        redirect('kaskeluar');
    }
    public function ubah($kode)
    {
        $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1($id);
        $data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'kas keluar'])->row()->id_menus;
        $data['kk'] = $this->M_KasKeluar->getById($kode);
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_kaskeluar/v_kaskeluar_ubah', $data);
        $this->load->view('template/footer');
    }
    public function ubahdata()
    {
        $kode = $this->input->post('kode');
        $id = $this->session->userdata('tipeuser');
        $nominal = preg_replace("/[^0-9]/", "", $this->input->post('nominal'));
        // $b1 = $this->db->query("SELECT * FROM tb_historikas WHERE kode_kas = '" . $kode . "'")->row_array();
        // $dbet = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis ='kas masuk'")->row_array();
        // $kreddi = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis='kas keluar'")->row_array();
        // $saldo = $dbet['nominal'] - $kreddi['nominal'];
        // $querya = "SELECT * FROM tb_historikas";
        // $a = $this->db->query($querya)->result_array();
        // $j = $this->db->query($querya)->num_rows();
        // $i = 0;
        // if ($nominal > $saldo) {
        //     $this->session->set_flashdata('message', '<div class="alert alert-warning left-icon-alert" role="alert"> <strong>Warning! </strong>Nominal Terlalu Besar</div>');
        //     redirect('kas-keluar-edt/' . $kode);
        // } else {
        //     foreach ($a as $data) {
        //         $i++;
        //         if ($data['kode_kas'] == $kode) {
        //             $awal = $i;
        //             $queryb = "SELECT * FROM tb_historikas LIMIT " . intval($awal) . "," . intval($j);
        //             $b = $this->db->query($queryb)->result_array();
        //             $c = $this->db->query($queryb)->num_rows();

        //             if ($c >= 1) {
        //                 foreach ($b as $data1) {
        //                     $saldodia = $b1['saldo'];
        //                     $hasildia = $saldodia + $b1['nominal'] - $nominal;
        //                     $hasil = $hasildia - $data1['nominal'];
        //                     $datadia = [
        //                         'nominal' => $nominal,
        //                         'saldo' => $hasildia,
        //                         'tgltransaksi' => $this->input->post('tglTransaksi') . date(' h:i:s')
        //                     ];

        //                     $datar = ['saldo' => $hasil];

        //                     $data = [
        //                         'tgltransaksi' => $this->input->post('tglTransaksi') . date(' h:i:s'),
        //                         'keterangan' => $this->input->post('keterangan'),
        //                         'nominal' => preg_replace("/[^0-9]/", "", $this->input->post('nominal')),
        //                         'kode_kas_keluar' => $kode,
        //                         'id_user' => $id,
        //                         'status_jurnal' => '0'
        //                     ];
        //                     $this->M_KasKeluar->ubah($data, $kode);
        //                     $this->db->where('kode_kas', $kode);
        //                     $this->db->update('tb_historikas', $datadia);
        //                     $this->db->where('kode_kas', $data1['kode_kas']);
        //                     $this->db->update('tb_historikas', $datar);
        //                 }
        //             } else {
        //                 $hasildia = $saldo + $b1['nominal'] - $nominal;
        //             }
        //         }
        //     }
        // }
        $datar = [
            'nominal' => $nominal,
            'saldo' => 0,
            'tgltransaksi' => $this->input->post('tglTransaksi')
        ];
        $data = [
            'tgltransaksi' => $this->input->post('tglTransaksi'),
            'keterangan' => $this->input->post('keterangan'),
            'nominal' => preg_replace("/[^0-9]/", "", $this->input->post('nominal')),
            'kode_kas_keluar' => $kode,
            'id_user' => $id,
            'status_jurnal' => '0'
        ];
        $this->M_KasKeluar->ubah($data, $kode);
        $this->db->where('kode_kas', $kode);
        $this->db->update('tb_historikas', $datar);

        // $kodekaskeluar = $this->input->post('kode');
        // $id = $this->session->userdata('tipeuser');
        // $saldo = $this->db->query("SELECT * FROM tb_historikas ORDER BY id_histori_kas DESC LIMIT 1")->row_array();
        // $hasil = intval($saldo['saldo']) - intval(preg_replace("/[^0-9]/", "", $this->input->post('nominal')));
        // $data = [
        //     'tgltransaksi' => $this->input->post('tglTransaksi') . date('h:i:s'),
        //     'keterangan' => $this->input->post('keterangan'),
        //     'nominal' => preg_replace("/[^0-9]/", "", $this->input->post('nominal')),
        //     'kode_kas_keluar' => $kodekaskeluar,
        //     'id_user' => $id,
        // ];
        // // var_dump($data);
        // if (preg_replace("/[^0-9]/", "", $this->input->post('nominal')) > intval($saldo['saldo'])) {
        //     $this->session->set_flashdata('message', '<div class="alert alert-warning left-icon-alert" role="alert"> <strong>Warning! </strong>Nominal Terlalu Besar</div>');
        //     redirect('kas-keluar-edt/' . $kodekaskeluar);
        // } else {
        //     $this->M_KasKeluar->ubah($data, $kodekaskeluar);
        //     $this->db->where('kode_kas', $kodekaskeluar);
        //     $this->db->delete('tb_historikas');
        //     $dataHistori = [
        //         'kode_kas' => $kodekaskeluar,
        //         'jenis' => 'kas keluar',
        //         'nominal' => preg_replace("/[^0-9]/", "", $this->input->post('nominal')),
        //         'saldo' => $hasil,
        //         'tgltransaksi' => $this->input->post('tglTransaksi') . date(' h:i:s'),
        //     ];

        //     $this->M_KasKeluar->tambahHisto($dataHistori);
        // }

        $this->session->set_flashdata('message', '<div class="alert alert-success left-icon-alert" role="alert"> <strong>Sukses!</strong> Data Berhasil DiUbah</div>');
        redirect('kaskeluar');
    }
}
