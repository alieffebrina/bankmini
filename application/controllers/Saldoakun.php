<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Saldoakun extends CI_Controller
{
    public function __construct(){
        parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->model('M_Setting');
		// $this->load->model('M_Neraca');
		$this->load->model('M_MasterCOA');
		$this->load->model('M_Akses');
		cek_login_user();
        $this->load->library('Pdf'); 
    }

    public function index(){
        $id = $this->session->userdata('tipeuser');
		$data['menu'] = $this->M_Setting->getmenu1($id);
		$data['akses'] = $this->M_Akses->getByLinkSubMenu(urlPath(), $id);
		$data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'neraca'])->row()->id_menus;
		$data['COAD'] = $this->db->get('tb_mastercoa')->result_array();
		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_saldoakun/v_saldoakun', $data);
		$this->load->view('template/footer');
	}

	public function sort(){
        $id = $this->session->userdata('tipeuser');
		$data['menu'] = $this->M_Setting->getmenu1($id);
		$data['akses'] = $this->M_Akses->getByLinkSubMenu(urlPath(), $id);
		$data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'neraca'])->row()->id_menus;
		$btncari = $this->input->post('btnCaridata');
		if(isset($btncari)){
			$tglawal = $this->input->post('tglawall');
			$tglakhir = $this->input->post('tglakhiree');			
		} else if(isset($_POST['lporanhri'])){
			$tglawal = date('Y-m-d');
			$tglakhir = date('Y-m-d');
		} else if(isset($_POST['lporanbln'])){
			$hari_ini = date("Y-m-d");
			$tglawal = date('Y-m-01', strtotime($hari_ini));
			$tglakhir = date('Y-m-t', strtotime($hari_ini));
		} else if(isset($_POST['lporanthn'])){

			$hari_ini = date("Y-m-d");
			$tglawal = date('Y-01-01', strtotime($hari_ini));
			$tglakhir = date('Y-12-t', strtotime($hari_ini));
		}

		if(!isset($_POST['excel']) && !isset($_POST['cetak'])){
		$data['tglawal'] = $tglawal;
		$data['tglakhir'] = $tglakhir;
		$data['COAD'] = $this->db->get('tb_mastercoa')->result_array();
		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_saldoakun/v_saldoakunsort', $data);
		$this->load->view('template/footer');
		} else if(isset($_POST['excel'])){

			$tglawal = $this->input->post('tglawall');
			$tglakhir = $this->input->post('tglakhiree');
			$this->excel($tglawal, $tglakhir);
		} else {

			$tglawal = $this->input->post('tglawall');
			$tglakhir = $this->input->post('tglakhiree');
			$this->pdf($tglawal, $tglakhir);

		}

		
	}

	public function excel($tglawal, $tglakhir){
		
		
		$data['COAD'] = $this->db->get('tb_mastercoa')->result_array();
		$data['tglawal'] = $tglawal;
		$data['tglakhir'] = $tglakhir;
		$data['title'] = 'Laporan Saldo Akun';
        $this->load->view('v_saldoakun/excelsaldoakun', $data);
	}

	public function pdf($tglawal, $tglakhir){
		$COAD = $this->db->get('tb_mastercoa')->result_array();
        $pdf = new FPDF('L','mm',array('148', '210'));
        // membuat halaman baru
        $pdf->AddPage();  
        $pdf->SetFont('Arial','',8,'C');
        $pdf->Cell(110,5,'LAPORAN SALDO AKUN',0,1,'L');
        $pdf->Cell(50,5,'Periode awal ',0,0,'L');
        $pdf->Cell(100,5, date('d-m-Y', strtotime($tglawal)),0,1,'L');
        $pdf->Cell(50,5,'Periode Akhir ',0,0,'L');
        $pdf->Cell(100,5, date('d-m-Y', strtotime($tglakhir)),0,1,'L');

        $pdf->SetFont('Arial','',7,'C');
        $pdf->Cell(10,2,'',0,1);
    	$pdf->Cell(140,5, 'NO AKUN', 1,0);
        $pdf->Cell(40,5,'SALDO',1,1);
        foreach ($COAD as $COAD ) {
        	$this->db->select_sum('nominal_debet');
	        $this->db->select_sum('nominal_kredit');
	        $this->db->join('tb_jurnal', 'tb_jurnal.id_jurnal = tb_detailjurnal.id_jurnal');
	        $this->db->where('id_coa', $COAD['id_coa']);
	        $this->db->where('DATE(tgl_update) >=', date('Y-m-d',strtotime($tglawal)));
	        $this->db->where('DATE(tgl_update) <=', date('Y-m-d',strtotime($tglakhir)));
	        $query = $this->db->get('tb_detailjurnal')->result_array();
	        foreach ($query as $query) {
	            $nominald = $query['nominal_debet'];
	            $nominalk = $query['nominal_kredit'];
	            $nominal = $nominald - $nominalk; 
	        } 
	    	$pdf->Cell(140,5, $COAD['kode_coa'].' - '.$COAD['akun'], 1,0);
	        $pdf->Cell(40,5,'Rp. '.number_format($nominal),1,1);
        }

        
        // $pdf->AutoPrint(true);
        $pdf->Output();
    }
}
	