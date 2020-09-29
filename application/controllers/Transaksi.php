<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{    
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'h_rand_string'));
		$this->load->library('session');
		$this->load->model('M_Setting');
		$this->load->model('M_Transaksi');
		$this->load->model('M_TipeUser');
		$this->load->model('M_Akses');

		cek_login_user();
	}

	public function index()
	{		
		$id = $this->session->userdata('tipeuser');
		$data['menu'] = $this->M_Setting->getmenu1($id);
		$data['transaksi'] = $this->M_Transaksi->getTransaksi();
		$data['akses'] = $this->M_Akses->getByLinkSubMenu(urlPath(), $id);
		$data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'transaksi'])->row()->id_menus;

		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_transaksi/v_transaksi', $data);
		$this->load->view('template/footer');
    }

    public function transaksi_add()
	{
		$id = $this->session->userdata('tipeuser');
		$data['menu'] = $this->M_Setting->getmenu1();
		$data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'transaksi'])->row()->id_menus;
		$data['tipeuser'] = $this->M_TipeUser->getAll();
		// $data['transaksi'] = $this->db->get('tb_mastertransaksi')->result_array();
		
		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_transaksi/v_transaksi-add', $data);
		$this->load->view('template/footer');
	}

	public function add_process()
	{
		// var_dump($this->input->post());		
		$id_customer = $this->input->post('id_customer', true);
		$id_tipeuser = $this->db->get_where('tb_tipeuser',['id_tipeuser' => intval($this->input->post('usertipe')) ] )->row();
		// var_dump($id_tipeuser);
		// $kode = 'TR'.date("Ymd").''.getRandomString(5);
		// if($this->M_Transaksi->cekKodeTransaksi($kode)){
		$data = array(
			'id_transaksi' => '',
			'tipeuser' => $id_tipeuser->tipeuser,
			'id_jenistransaksi ' => $this->input->post('id_jenistransaksi', true),
			'kodetransaksi' => $this->input->post('kode_transaksi', true),
			'keterangan' => $this->input->post('keterangan', true),
			'nominal' => preg_replace("/[^0-9]/", "", $this->input->post('nominal')),
			'id_user' => $this->session->userdata('id_user'),
			'tgl_update' => date("Y-m-d h:i:sa"),
			'status' => 'aktif',
		);

		if( $id_tipeuser->tipeuser == 'staf' ){
			$data['id_anggota'] = $id_customer;
			$data['id_siswa'] = null;
		}else if( $id_tipeuser->tipeuser == 'siswa' ){
			$data['id_siswa'] = $id_customer;
			$data['id_anggota'] = null;
		}
				
		$this->M_Transaksi->addTransaksi($data);
		$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
	                                            		<strong>Sukses!</strong> Transaksi Berhasil.
	                                        		</div>');
		redirect(base_url('transaksi/'));
	}

	public function transaksi_delete($id)
	{
		$this->M_Transaksi->deleteTransaksi($id);
		$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
	                                            		<strong>Sukses!</strong> Berhasil Di hapus.
	                                        		</div>');
		redirect(base_url('transaksi/'));
	}

	public function transaksi_edit($id)
	{
		$ida = $this->session->userdata('tipeuser');
		$data['menu'] = $this->M_Setting->getmenu1($ida);
		$data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'transaksi'])->row()->id_menus;
		$data['tipeuser'] = $this->M_TipeUser->getAll();
		$data['transaksi'] = $this->db->get('tb_mastertransaksi')->result_array();
		$data['data'] = $this->db->get_where('tb_transaksi',['id_transaksi' => $id])->row();

		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_transaksi/v_transaksi-edit', $data);
		$this->load->view('template/footer');
		// print_r($this->db->get_where('tb_transaksi',['id_transaksi' => $id])->row());
	}

	public function edit_process()
	{
		var_dump($this->input->post());		
		$id_customer = $this->input->post('id_customer', true);
		$id = $this->input->post('id_transaksi', true);
		if($this->input->post('usertipe') == 'siswa' || $this->input->post('usertipe') == 'administrator'){
			$id_tipeuser = $this->input->post('usertipe');
		}else{
			$id_tipeuser = $this->db->get_where('tb_tipeuser',['id_tipeuser' => intval($this->input->post('usertipe')) ] )->row()->tipeuser;
		}
		// $kode = 'TR'.date("Ymd").''.getRandomString(5);
		// if($this->M_Transaksi->cekKodeTransaksi($kode)){
		$data = array(
			'id_transaksi' => '',
			'tipeuser' => $id_tipeuser,
			'id_jenistransaksi ' => $this->input->post('id_jenistransaksi', true),
			'kodetransaksi' => $this->input->post('kode_transaksi', true),
			'keterangan' => $this->input->post('keterangan', true),
			'nominal' => preg_replace("/[^0-9]/", "", $this->input->post('nominal')),
			'id_user' => $this->session->userdata('id_user'),
			'tgl_update' => date("Y-m-d h:i:sa")
			// 'status' => 'aktif',
		);

		if( $id_tipeuser == 'administrator' ){
			$data['id_anggota'] = $id_customer;
			$data['id_siswa'] = null;
		}else if( $id_tipeuser == 'siswa' ){
			$data['id_siswa'] = $id_customer;
			$data['id_anggota'] = null;
		}
				
		$this->M_Transaksi->editTransaksi($data, $id);
		$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
	                                            		<strong>Sukses!</strong> Transaksi Berhasil.
	                                        		</div>');
		redirect(base_url('transaksi/'));
	}

	public function detailTransaksi(){
		$tipe = $this->input->get('tipe');
		$id = $this->input->get('id');

		if($tipe == 'siswa'){
			// $this->db->where('id_siswa', intval($id));
			$query = $this->db->query('SELECT * FROM tb_transaksi JOIN tb_mastertransaksi ON tb_transaksi.id_jenistransaksi = tb_mastertransaksi.id_mastertransaksi JOIN tb_siswa ON tb_transaksi.id_siswa = tb_siswa.nis WHERE tb_transaksi.id_siswa = '.intval($id).' AND tb_transaksi.status = "aktif"')->result();
			echo  json_encode($query);
			// echo 'siswa';
		}else if($tipe == 'staf'){
			$query = $this->db->query('SELECT * FROM tb_transaksi JOIN tb_mastertransaksi ON tb_transaksi.id_jenistransaksi = tb_mastertransaksi.id_mastertransaksi JOIN tb_staf ON tb_transaksi.id_anggota = tb_staf.id_staf WHERE tb_transaksi.id_anggota = '.intval($id).' AND tb_transaksi.status = "aktif"')->result();
			echo  json_encode($query);
			// echo 'staf';
		}else{
			echo 'salah';
		}	
		
	}
}
