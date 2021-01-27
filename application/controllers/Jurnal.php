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
		$this->load->model('M_MasterCOA');
		$this->load->model('M_Akses');
		cek_login_user();
        $this->load->library('Pdf'); 
    }

    public function index(){
        $id = $this->session->userdata('tipeuser');
		$data['menu'] = $this->M_Setting->getmenu1($id);
		$data['akses'] = $this->M_Akses->getByLinkSubMenu(urlPath(), $id);
		$data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'jurnal'])->row()->id_menus;
		$data['jurnal'] = $this->M_Jurnal->getJurnal();
		$data['transaksi'] = $this->M_Jurnal->getTransaksinol();


		// $id = $this->session->userdata('tipeuser');
		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_jurnal/v_jurnal', $data);
		$this->load->view('template/footerjurnal');
	}
	
	public function jurnal_add(){
		$id = $this->session->userdata('tipeuser');
		$data['id'] = $this->M_Jurnal->select_max();
		$data['menu'] = $this->M_Setting->getmenu1($id);
		// $data['akses'] = $this->M_Akses->getByLinkSubMenu(urlPath(), $id);
		$data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'jurnal'])->row()->id_menus;
		$data['jurnal'] = $this->M_Jurnal->getJurnal();
		$data['coa'] = $this->M_MasterCOA->getAll();
		$data['transaksi'] = $this->M_Jurnal->getTransaksinol();

		// $id = $this->session->userdata('tipeuser');
		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_jurnal/v_jurnal-add', $data);
		$this->load->view('template/footerjurnal');
	}

	public function tambahdata(){

		print_r($this->input->post());
        $dataa = [
			'id_jurnal' => $this->input->post('idjurnal'),
			'ketjurnal' => $this->input->post('ket'),
			'id_user' => $this->session->userdata('id_user'),
			'tgl_update' => date("Y-m-d h:i:sa")
		];
		$this->M_Jurnal->insertJurnal($dataa);

		$id = $this->input->post('idjurnal');
		redirect('jurnal-det/'.$id);
	}

	public function detail($ida){

		$tipeuser = $this->session->userdata('tipeuser');
		$data['coa'] = $this->M_MasterCOA->getAll();
		$data['menu'] = $this->M_Setting->getmenu1($tipeuser);
		$data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'jurnal'])->row()->id_menus;
		$data['id'] = $ida;
		$data['total_detail'] = $this->M_Jurnal->hitungJumlahInventori($ida);
		$data['detail'] = $this->M_Jurnal->getAll($ida);
        $data['akses'] = $this->M_Akses->getByLinkSubMenu('jurnal', $tipeuser);
        $data['totaldet'] = $this->M_Jurnal->select_sumdebet($ida);
        $data['totalkre'] = $this->M_Jurnal->select_sumkredit($ida);
		$data['transaksi'] = $this->M_Jurnal->gettr();
		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_jurnal/v_jurnal-add-detail', $data);
		$this->load->view('template/footerjurnal');
	}


	public function detailedit($ida, $iddet){

		$tipeuser = $this->session->userdata('tipeuser');
		$data['coa'] = $this->M_MasterCOA->getAll();
		$data['menu'] = $this->M_Setting->getmenu1($tipeuser);
		$data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'jurnal'])->row()->id_menus;
		$data['id'] = $ida;
		$data['total_detail'] = $this->M_Jurnal->hitungJumlahInventori($ida);
		$data['detail'] = $this->M_Jurnal->getAll($ida);
        $data['akses'] = $this->M_Akses->getByLinkSubMenu('jurnal', $tipeuser);
        $data['totaldet'] = $this->M_Jurnal->select_sumdebet($ida);
        $data['totalkre'] = $this->M_Jurnal->select_sumkredit($ida);
        $data['editdet'] = $this->M_Jurnal->getdetailjurnal($iddet);
		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_jurnal/v_jurnal-edit-detail', $data);
		$this->load->view('template/footerjurnal');
	}


	public function add_process(){
		if($this->input->post('kodeCOA') != 'salah') {
			$coaj = $this->input->post('kodeCOA');
			$transj = $this->input->post('transaksi');
			print_r($this->input->post());
			$no = $this->input->post('no');
			if($this->input->post('tipejurnal') != NULL){
				if($this->input->post('tipejurnal') == "kredit"){
					$nominal_kredit = preg_replace("/[^0-9]/", "", $no);
					$nominal_debet = '0';
				} else {
					$nominal_debet = preg_replace("/[^0-9]/", "", $no);
					$nominal_kredit = '0';
				}
			} elseif($this->input->post('jenis') == "kredit"){
				$nominal_kredit = preg_replace("/[^0-9]/", "", $no);
				$nominal_debet = '0';
			} else {
				$nominal_debet = preg_replace("/[^0-9]/", "", $no);
				$nominal_kredit = '0';
			}

			$rowdebet = $this->M_Jurnal->cekdatasamadebet($transj, $coaj, $nominal_debet);
			$rowkredit = $this->M_Jurnal->cekdatasamakredit($transj, $coaj, $nominal_kredit);
			if($rowdebet > 0){
				$this->session->set_flashdata('alert', '<div class="alert alert-danger left-icon-alert" role="alert">
														<strong>Gagal!</strong> Data Sudah Pernah Di Masukkan.
													</div>');
		        $id = $this->input->post('idjurnal');
				redirect('jurnal-det/'.$id);
			} else if($rowkredit > 0) {
				$this->session->set_flashdata('alert', '<div class="alert alert-danger left-icon-alert" role="alert">
														<strong>Gagal!</strong> Data Sudah Pernah Di Masukkan.
													</div>');
		        $id = $this->input->post('idjurnal');
				redirect('jurnal-det/'.$id);
			} else {
				// echo 'sd'.$this->input->post('tipejurnal');
				// echo 'nom'.$nominal_debet;
				// echo 'aa'.$nominal_kredit;
				$data = [
					'id_jurnal' => $this->input->post('idjurnal'),
					'id_coa' => $this->input->post('kodeCOA'),
					'ket' => $this->input->post('ketdetail'),
					'transaksi' => $this->input->post('transaksi'),
					'nominal_kredit' => $nominal_kredit,
					'nominal_debet' => $nominal_debet,
				];
				// $this->M_Jurnal->updateTransaksi($this->input->post('transaksi'));

				$this->M_Jurnal->updatejurnal();
		        $this->db->insert('tb_detailjurnal', $data); 
				// $this->M_Jurnal->insertJurnal($data);
				$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
															<strong>Sukses!</strong> Berhasil Menambah Jurnal
														</div>');
		        $id = $this->input->post('idjurnal');
				redirect('jurnal-det/'.$id);
				// echo $this->input->post('jenis');
			}
		} else {
			$this->session->set_flashdata('alert', '<div class="alert alert-danger left-icon-alert" role="alert">
														<strong>Gagal!</strong> Kode COA harus diisi
													</div>');
	        $id = $this->input->post('idjurnal');
			redirect('jurnal-det/'.$id);
		}
		
	}

	public function edit_process(){

		print_r($this->input->post());
		$this->M_Jurnal->updatedetail();
		$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
													<strong>Sukses!</strong> Berhasil Edit Detail Jurnal
												</div>');
        $id = $this->input->post('idjurnal');
		redirect('jurnal-det/'.$id);

	}

	function jurnaldet_hps($data, $id, $ts){
        $this->db->where('id_transaksi', $ts);
        $this->db->update('tb_transaksi', ['status_jurnal' => '0']);

        $this->db->where('id_dtljurnal', $data);
        $this->db->delete('tb_detailjurnal');

        $this->session->set_flashdata('message', '<div class="alert alert-success left-icon-alert" role="alert"> <strong>Sukses!</strong> Data Berhasil DiHapus</div>');
        
		redirect('jurnal-det/'.$id);
    }

    public function pdf($ida){
		$COAD = $this->M_Jurnal->jurnalcek($ida);
		$jurnal = $this->M_Jurnal->getAll($ida);
		$pdf = new FPDF('L','mm',array('148', '210'));
        // membuat halaman baru
        $pdf->AddPage();  
        $pdf->SetFont('Arial','',8,'C');
        $pdf->Cell(110,5,'LAPORAN Jurnal',0,1,'L');

        $pdf->SetFont('Arial','',7,'C');
        $pdf->Cell(10,2,'',0,1);
    	$pdf->Cell(20,5, 'Jurnal : ', 0,0);
        foreach ($COAD as $COAD ) {
    		$pdf->Cell(100,5, $COAD['ketjurnal'], 0,1);
    	}
        $pdf->Cell(60,5,'KODE COA' ,1,0);
        $pdf->Cell(20,5,'KETERANGAN' ,1,0);
        $pdf->Cell(50,5,'TRANSAKSI' ,1,0);
        $pdf->Cell(30,5,'DEBET' ,1,0);
        $pdf->Cell(30,5,'KREDIT',1,1);
        foreach($jurnal as $jurnal){

	        $pdf->Cell(60,5,$jurnal['kode_coa'].'-'.$jurnal['akun'] ,1,0);
	        $pdf->Cell(20,5,$jurnal['ket'] ,1,0);
	        if($jurnal['transaksi']!='0'){
                $cek = $this->db->query('SELECT * FROM tb_transaksi where id_transaksi = '.$jurnal['transaksi'])->result_array();

                foreach ($cek as $cek) {
                    if($cek['id_siswa'] != NULL){
                        $user = $this->db->query('SELECT * FROM tb_siswa JOIN tb_kelas on tb_kelas.id_kelas = tb_siswa.id_kelas where nis = '.$cek['id_siswa'])->result_array();
                        foreach ($user as $user) {
                           $namauser = $user['namasiswa'].'-'.$user['kelas'];
                        }
                    } else if($cek['id_siswa'] != NULL){
                        $user = $this->db->query('SELECT * FROM tb_staf where id_staf = '.$cek['id_anggota'])->result_array();
                        foreach ($user as $user) {
                           $namauser = $user['nama'];
                        }
                    } else {
                        $namauser = '';
                    }
                    
                    $cektr = $cek['keterangan'];
                    $kodetransaksi = $cek['kodetransaksi'];
                }
            } else {
                $cektr = '';
                    $kodetransaksi = '';
            }
	        $pdf->Cell(50,5,$cektr.'-'.$namauser ,1,0);
	        $pdf->Cell(30,5,'Rp.'.number_format($jurnal['nominal_debet']) ,1,0);
	        $pdf->Cell(30,5,'Rp.'.number_format($jurnal['nominal_kredit']) ,1,1);
        }
        

        
        // $pdf->AutoPrint(true);
        $pdf->Output();
    }
}