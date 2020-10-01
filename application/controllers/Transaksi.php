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

	public function getHistoriTransaksi(){		
		$getNama = $this->input->get('id');
		$getTipe = $this->input->get('tipe');
		
		if(!empty($getNama) && !empty($getTipe)){
			$data = $this->M_Transaksi->getTransaksiDetail($getTipe, $getNama);
			// echo json_encode($this->M_Transaksi->getTransaksiDetail($getTipe, $getNama));
		}else{
			// echo 'gak';
			$data = [['kosong' => true]];
		}	

		// echo $getNama;
		// echo $getTipe;
		// echo print_r($this->input->get());
		echo json_encode($data);
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

			$this->db->where('id_anggota', $id_customer);
			$this->db->where('id_jenistransaksi', $this->input->post('id_jenistransaksi', true));
			if($this->db->get('tb_transaksi')->num_rows() !== 0){
				$this->session->set_flashdata('alert', '<div class="alert alert-warning left-icon-alert" role="alert">
	                                            		<strong>Perhatian!</strong> Data Sudah Ada.
													</div>');				
				return redirect(base_url('transaksi-add/'));
			}
		}else if( $id_tipeuser->tipeuser == 'siswa' ){
			$data['id_siswa'] = $id_customer;
			$data['id_anggota'] = null;

			$this->db->where('id_siswa', $id_customer);
			$this->db->where('id_jenistransaksi', $this->input->post('id_jenistransaksi', true));			
			if($this->db->get('tb_transaksi')->num_rows() != 0){
				$this->session->set_flashdata('alert', '<div class="alert alert-warning left-icon-alert" role="alert">
	                                            		<strong>Perhatian!</strong> Data Sudah Ada.
													</div>');				
				return redirect(base_url('transaksi-add/'));
			}
		}
				
		$id_transaksi = $this->M_Transaksi->addTransaksi($data);
		$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
	                                            		<strong>Sukses!</strong> Transaksi Berhasil.
													</div>');
		// $id_transaksi = $this->db->get_where('tb_transaksi', ['tipeuser'])													
		redirect(base_url('transaksi/printOutTransaksi?id_transaksi='.$id_transaksi.'&tipe='.$id_tipeuser->tipeuser));
	}

	public function printOutTransaksi(){
		$id = $this->input->get('id_transaksi');
		$tipe = $this->input->get('tipe');
		if($tipe == 'siswa'){
			$query = $this->db->query("SELECT * FROM tb_transaksi JOIN tb_mastertransaksi ON tb_transaksi.id_jenistransaksi = tb_mastertransaksi.id_mastertransaksi JOIN tb_siswa ON tb_transaksi.id_siswa = tb_siswa.nis WHERE tb_transaksi.id_transaksi = $id")->row(); 			
			$query->nama = '';
			$query->namaTransaksi = $query->namasiswa;
			$query->kosong = false;
			
		}else if($tipe == 'staf'){
			$query = $this->db->query("SELECT * FROM tb_transaksi JOIN tb_mastertransaksi ON tb_transaksi.id_jenistransaksi = tb_mastertransaksi.id_mastertransaksi JOIN tb_staf ON tb_transaksi.id_anggota = tb_staf.id_staf WHERE tb_transaksi.id_transaksi = $id")->row(); 			
			$query->namasiswa = '';
			$query->namaTransaksi = $query->nama;
			$query->kosong = false;			
		}
		$data['query'] = $query;
		$data['staf'] = $this->db->get_where('tb_staf', ['id_staf', $query->id_user])->row()->nama;
		$this->load->view('v_transaksi/v_transaksi-print', $data);
		// $this->db->get_where('tb_transaksi', ['id_transaksi' => $id])->row();
		// $data['data'] = $this->db->query("SELECT * FROM tb_transaksi JOIN tb_mastertransaksi ON tb_transaksi.id_jenistransaksi = tb_mastertransaksi.id_mastertransaksi JOIN tb_staf ON tb_transaksi.id_anggota = tb_staf.id_staf WHERE tb_transaksi.id_transaksi = $id")->row(); 
		// $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [80, 80], 'default_font_size' => 0, 'default_font' => '', 'margin_left' => '0', 'margin_right' => '0', 'margin_top' => '0', 'margin_bottom' => '0', 'margin_header' => 0, 'orientation' => 'L']);
		// $data = $this->load->view('v_transaksi/v_transaksi-print', $data, true);
		// $mpdf->WriteHTML($data);
		// $mpdf->Output("coba-".date("Y/m/d H:i:s").".pdf" ,'I');
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

	public function getTransaksi(){
		echo json_encode($this->M_Transaksi->getTransaksiJurnal());

	}
}
