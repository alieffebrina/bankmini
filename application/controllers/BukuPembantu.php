<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BukuPembantu extends CI_Controller
{      
    public function __construct()
    {
        parent::__construct();
		$this->load->helper(array('form', 'url', 'h_rand_string'));
		$this->load->library('session');
		$this->load->model('M_Setting');
		$this->load->model('M_Akses');
		$this->load->model('M_TipeUser');
		$this->load->model('M_Transaksi');
        $this->load->library('Pdf'); 
		cek_login_user();
    }

    public function index(){
        $id = $this->session->userdata('tipeuser');
		$data['menu'] = $this->M_Setting->getmenu1($id);	
		$data['akses'] = $this->M_Akses->getByLinkSubMenu(urlPath(), $id);
		$data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'Buku Pembantu Tab'])->row()->id_menus;
		$data['tipeuser'] = $this->db->get('tb_tipeuser')->result_array();

		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_bukupembantu/index', $data);
		$this->load->view('template/footer');
    }

     public function piutang(){
        $id = $this->session->userdata('tipeuser');
		$data['menu'] = $this->M_Setting->getmenu1($id);	
		$data['akses'] = $this->M_Akses->getByLinkSubMenu(urlPath(), $id);
		$data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'Buku Pembantu Piutang'])->row()->id_menus;
		$data['tipeuser'] = $this->db->get('tb_tipeuser')->result_array();

		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_bukupembantu/v_piutang', $data);
		$this->load->view('template/footer');
    }

    public function excelhutang($getNama, $getTipe, $getkat){
		if($getTipe == 'siswa'){
			// echo "ini staf";
		$data['COAD']  = $this->M_Transaksi->gettransaksibutabstaf($getNama, $getkat);
		} else {
			// echo "ini siswa";
		$data['COAD']  = $this->M_Transaksi->gettransaksibutabsiswa($getNama, $getkat);	
		}
        $data['title'] = 'Laporan Buku Pembantu Tabungan';
        $this->load->view('v_bukupembantu/excelhutang', $data);
    	// echo $getTipe;
    }

    public function cetak(){
    	$button = $this->input->post('button');
		$getNama = $this->input->post('nama');
		$tipe = $this->input->post('tipeuser');
		$getkat = $this->input->post('kategori');
		if ($button == 'cetak') {
			if($tipe == 'siswa'){
				if($getkat == 'HUTANG'){ $judul = "Buku Tabungan Siswa"; } else { $judul = "Buku Bantu Pinjaman Siswa"; } 
				$COAD = $this->M_Transaksi->cetakbutabsiswa($getNama, $getkat);	
			} else {
				if($getkat == 'HUTANG'){ $judul = "Buku Tabungan Staf"; } else { $judul = "Buku Bantu Pinjaman Staf"; } 
				$COAD = $this->M_Transaksi->cetakbutabstaf($getNama, $getkat);
			}
	        $pdf = new FPDF('L','mm',array('148', '210'));
	        // membuat halaman baru
	        $pdf->AddPage();  
	        $pdf->SetFont('Arial','',8,'C');
	        $pdf->Cell(200,5,$judul,0,1,'C');

	        $pdf->SetFont('Arial','',7,'C');
	        $pdf->Cell(10,2,'',0,1);
	    	$pdf->Cell(23,5, 'Tanggal Transaksi', 1,0,'C');
	    	$pdf->Cell(70,5, 'Keterangan', 1,0,'C');
	        $pdf->Cell(30,5,'Debet',1,0,'C');
	        $pdf->Cell(30,5,'Kredit',1,0,'C');
	        $pdf->Cell(40,5,'Saldo',1,1,'C');
	        $lr = 0;
	        foreach ($COAD as $COAD ) {
		    	$pdf->Cell(23,5, date('d-m-Y', strtotime($COAD['tgl_update'])), 1,0);
		    	$pdf->Cell(70,5, $COAD['keterangan'], 1,0);
		    	if($COAD['debet'] != 'koperasi') { 
            		$lr = $lr - $COAD['nominal'];
			        $pdf->Cell(30,5,'Rp. '.number_format($COAD['nominal']),1,0);
			        $pdf->Cell(30,5,'Rp. 0',1,0);
	        		$pdf->Cell(40,5,'Rp. '.number_format($lr),1,1);
		         } else { 
		         	$lr = $lr + $COAD['nominal']; 
		        	
			        $pdf->Cell(30,5,'Rp. 0',1,0);
			        $pdf->Cell(30,5,'Rp. '.number_format($COAD['nominal']),1,0);
	        		$pdf->Cell(40,5,'Rp. '.number_format($lr),1,1);
	        	}
	        }

		    	$pdf->Cell(153,5, 'Saldo', 1,0);
		        $pdf->Cell(40,5,'Rp. '.number_format($lr),1,1);
	      
	        $pdf->Output();
		} else if ($button == 'excel') {
			if($tipe == 'siswa'){
				$coad = $this->M_Transaksi->cetakbutabsiswa($getNama, $getkat);	
			} else {
				$coad = $this->M_Transaksi->cetakbutabstaf($getNama, $getkat);
			}
			$data['COAD'] = $coad;
	        $data['title'] = 'Laporan Buku Pembantu Tabungan';
	        $this->load->view('v_bukupembantu/excelhutang', $data);
		}
    }
}
