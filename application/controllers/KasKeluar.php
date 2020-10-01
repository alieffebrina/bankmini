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
        $data = [
            'tgltransaksi' => $this->input->post('tglTransaksi') . date(' h:i:s'),
            'keterangan' => $this->input->post('keterangan'),
            'nominal' => preg_replace("/[^0-9]/", "", $this->input->post('nominal')),
            'kode_kas_keluar' => $kodekaskeluar,
            'id_user' => $id,
        ];
        // var_dump($kodekaskeluar);
        // die;
        $this->M_KasKeluar->tambah($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success left-icon-alert" role="alert"> <strong>Sukses!</strong> Data Berhasil DiTambahkan</div>');
        redirect('kaskeluar');
    }
    public function hapus($kode)
    {
        $this->M_KasKeluar->hapus($kode);
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
        $kodekaskeluar = $this->input->post('kode');
        $id = $this->session->userdata('tipeuser');
        $data = [
            'tgltransaksi' => $this->input->post('tglTransaksi') . date(' h:i:s'),
            'keterangan' => $this->input->post('keterangan'),
            'nominal' => preg_replace("/[^0-9]/", "", $this->input->post('nominal')),
            'kode_kas_keluar' => $kodekaskeluar,
            'id_user' => $id,
        ];
        // var_dump($data);
        $this->M_KasKeluar->ubah($data, $kodekaskeluar);
        $this->session->set_flashdata('message', '<div class="alert alert-success left-icon-alert" role="alert"> <strong>Sukses!</strong> Data Berhasil DiUbah</div>');
        redirect('kaskeluar');
    }

    public function getKasKeluar(){
        echo json_encode($this->db->get_where('tb_kaskeluar', ['status_jurnal' => '0'])->result());        
    }
}
