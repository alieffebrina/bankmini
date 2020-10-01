<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');


class KasUmum extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->model('M_Setting');

        $this->load->model('M_KasUmum');

        cek_login_user();
    }
    public function index()
    {

        $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1($id);
        $data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'kas masuk'])->row()->id_menus;


        $tglakhir = $this->M_KasUmum->tglakhirbulan(date('Y'), intval(date('m')));
        $data['recap'] =  array();
        for ($i = 1; $i <= intVal($tglakhir); $i++) {
            $a = $this->db->query("SELECT * FROM tb_kasmasuk WHERE MONTH(tgltransaksi) = " . intval(date('m')) . " AND DAY(tgltransaksi) = $i ORDER BY tgltransaksi ASC")->num_rows();
            if ($a != 0) {
                $b = $this->db->query("SELECT * FROM tb_kasmasuk WHERE MONTH(tgltransaksi) = " . intval(date('m')) . " AND DAY(tgltransaksi) = $i ORDER BY tgltransaksi ASC")->row_array();

                array_push($data['recap'], array($b['tgltransaksi'], $b['keterangan'], $b['nominal'], $b['kode_kas_masuk']));
            }
        }
        for ($i = 1; $i < intVal($tglakhir); $i++) {
            $c = $this->db->query("SELECT * FROM tb_kaskeluar WHERE MONTH(tgltransaksi) = " . intval(date('m')) . " AND DAY(tgltransaksi) = $i ORDER BY tgltransaksi ASC")->num_rows();
            if ($c != 0) {
                $d = $this->db->query("SELECT * FROM tb_kaskeluar WHERE MONTH(tgltransaksi) = " . intval(date('m')) . " AND DAY(tgltransaksi) = $i ORDER BY tgltransaksi ASC")->row_array();

                array_push($data['recap'], array($d['tgltransaksi'], $d['keterangan'], $d['nominal'], $d['kode_kas_keluar']));
            }
        }


        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_kasumum/v_kasumum', $data);
        $this->load->view('template/footer');
    }
    public function recapKas($tgl)
    {

        $tglakhir = $this->M_KasUmum->tglakhirbulan(date('Y'), intval($tgl));
        $data =  array();
        for ($i = 1; $i <= intVal($tglakhir); $i++) {
            $a = $this->db->query("SELECT * FROM tb_kasmasuk WHERE MONTH(tgltransaksi) = " . intval($tgl) . " AND DAY(tgltransaksi) = $i ORDER BY tgltransaksi ASC")->num_rows();
            if ($a != 0) {
                $b = $this->db->query("SELECT * FROM tb_kasmasuk WHERE MONTH(tgltransaksi) = " . intval($tgl) . " AND DAY(tgltransaksi) = $i ORDER BY tgltransaksi ASC")->row_array();

                array_push($data, array($b['tgltransaksi'], $b['keterangan'], $b['nominal'], $b['kode_kas_masuk']));
            }
        }
        for ($i = 1; $i < intVal($tglakhir); $i++) {
            $c = $this->db->query("SELECT * FROM tb_kaskeluar WHERE MONTH(tgltransaksi) = " . intval($tgl) . " AND DAY(tgltransaksi) = $i ORDER BY tgltransaksi ASC")->num_rows();
            if ($c != 0) {
                $d = $this->db->query("SELECT * FROM tb_kaskeluar WHERE MONTH(tgltransaksi) = " . intval($tgl) . " AND DAY(tgltransaksi) = $i ORDER BY tgltransaksi ASC")->row_array();

                array_push($data, array($d['tgltransaksi'], $d['keterangan'], $d['nominal'], $d['kode_kas_keluar']));
            }
        }
        echo json_encode($data);
    }
}
