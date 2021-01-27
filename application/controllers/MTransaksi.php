<?php

date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') or exit('No direct script access allowed');

class MTransaksi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'h_rand_string'));
		$this->load->library('session');
		$this->load->model('M_Setting');
		$this->load->model('M_MTransaksi');
		$this->load->model('M_Akses');

		cek_login_user();
	}

	public function index()
	{
		$id = $this->session->userdata('tipeuser');
		$data['menu'] = $this->M_Setting->getmenu1($id);
		$data['transaksi'] = $this->M_MTransaksi->getTransaksi();
		$data['akses'] = $this->M_Akses->getByLinkSubMenu(urlPath(), $id);
		$data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'Master Transaksi'])->row()->id_menus;

		// $id = $this->session->userdata('tipeuser');
		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_Mtransaksi/v_transaksi', $data);
		$this->load->view('template/footer');
	}

	public function transaksi_add()
	{
		$id = $this->session->userdata('tipeuser');
		$data['menu'] = $this->M_Setting->getmenu1($id);
		$data['tipeuser'] = $this->db->get('tb_tipeuser')->result();
		$data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'Master Transaksi'])->row()->id_menus;

		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_Mtransaksi/v_transaksi-add', $data);
		$this->load->view('template/footer');
	}

	public function add_process()
	{
		$string = $this->input->post('nominal');
		$result = preg_replace("/[^0-9]/", "", $string);
		$debet = $this->input->post('debet', true);
		$kredit = $this->input->post('kredit', true);
		$kategori = $this->input->post('kategori', true);
		$nama = $this->input->post('nama', true);
		$deskripsi = $this->input->post('deskripsi', true);
		// $kode = 'TR'.date("Ymd").''.getRandomString(5);
		$kode = $this->input->post('kodetransaksi');
		// if($this->M_MTransaksi->cekKodeTransaksi($kode)){
		$data = array(
			'id_mastertransaksi' => '',
			'kodetransaksi' => $kode,
			'debet ' => $debet,
			'kredit' => $kredit,
			'kategori' => $kategori,
			'deskripsi' => $deskripsi,
			'nominal' => $result,
			'nama' => $nama,
			'id_user' => $this->session->userdata('id_user'),
			'status' => 'aktif',
			'tgl_update' => date("Y-m-d h:i:sa"),
		);
		$this->M_MTransaksi->addTransaksi($data);
		$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
	                                            		<strong>Sukses!</strong> Transaksi Berhasil.
	                                        		</div>');
		redirect(base_url('mtransaksi/'));
	}

	public function transaksi_delete($id)
	{
		$this->M_MTransaksi->deleteTransaksi($id);
		$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
	                                            		<strong>Sukses!</strong> Berhasil Di hapus.
	                                        		</div>');
		redirect(base_url('mtransaksi/'));
	}

	public function transaksi_edit($id)
	{
		$ida = $this->session->userdata('tipeuser');
		$data['menu'] = $this->M_Setting->getmenu1($ida);
		$data['transaksi'] = $this->M_MTransaksi->detailTransaksi($id);
		$data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'Master Transaksi'])->row()->id_menus;
		
		// $id = $this->session->userdata('tipeuser');
		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_Mtransaksi/v_transaksi-edt', $data);
		$this->load->view('template/footer');
	}

	public function edit_process()
	{
		$string = $this->input->post('nominal');
		$result = preg_replace("/[^0-9]/", "", $string);
		$id = $this->input->post('id_transaksi', true);
		$debet = $this->input->post('debet', true);
		$kredit = $this->input->post('kredit', true);
		$kategori = $this->input->post('kategori', true);
		$deskripsi = $this->input->post('deskripsi', true);
		$kodetransaksi = $this->input->post('kodetransaksi', true);
		$data = array(
			'debet' => $debet,
			'kodetransaksi' => $kodetransaksi,
			'kredit' => $kredit,
			'kategori' => $kategori,
			'deskripsi' => $deskripsi,
			'nominal' => $result,
			'tgl_update' => date("Y-m-d h:i:sa"),
		);

		$this->M_MTransaksi->editTransaksi($data, $id);
		$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
                                            		<strong>Sukses!</strong> Berhasil Ubah Data Transaksi.
                                        		</div>');
		redirect(base_url('mtransaksi/'));
	}

	public function detailTransaksi($id){
		echo json_encode($this->db->get_where('tb_mastertransaksi',['id_mastertransaksi' => $id])->row() );
	}

	public function getMTransaksiSiswa($data, $ka){
	   $this->db->where('debet', $data)->where("status" , "aktif")->where("kategori" , $ka)->or_where('kredit', $data)->where("status" , "aktif")->where("kategori" , $ka);
	   echo json_encode($this->db->get('tb_mastertransaksi')->result()); 
	}
	
	public function getMTransaksiStaf($data, $ka){		
		echo json_encode($this->db->query('SELECT * FROM tb_mastertransaksi WHERE kategori =  $ka AND status = "aktif" AND kredit = "staf" OR kategori = $ka AND status = "aktif" AND debet = "staf"   ')->result()); 
	}
}
