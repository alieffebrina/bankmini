<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jurnal extends CI_Controller
{
    public function __construct(){
        parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->model('M_Setting');
		$this->load->model('M_Jurnal');
		$this->load->model('M_Akses');
		cek_login_user();
    }

    public function index(){
        $id = $this->session->userdata('tipeuser');
		$data['menu'] = $this->M_Setting->getmenu1($id);
		$data['akses'] = $this->M_Akses->getByLinkSubMenu(urlPath(), $id);
		$data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'jurnal'])->row()->id_menus;
		$data['jurnal'] = $this->M_Jurnal->getJurnal();
		$data['transaksi'] = $this->M_Jurnal->getTransaksi();


		// $id = $this->session->userdata('tipeuser');
		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_jurnal/v_jurnal', $data);
		$this->load->view('template/footer');
    }
}