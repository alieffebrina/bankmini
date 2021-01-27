<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');


class KasMasuk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->model('M_Setting');
        $this->load->model('M_Akses');
        $this->load->model('M_KasMasuk');
        $this->load->library('Pdf'); 
        cek_login_user();
    }
    public function index()
    {

        $id = $this->session->userdata('tipeuser');
        $data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'kas masuk'])->row()->id_menus;
        $data['menu'] = $this->M_Setting->getmenu1($id);
        $data['km'] = $this->M_KasMasuk->getAll();
        $data['akses'] = $this->M_Akses->getByLinkSubMenu(urlPath(), $id);

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_kasmasuk/v_kasmasuk', $data);
        $this->load->view('template/footer');
    }
    public function tambah()
    {
        $id = $this->session->userdata('tipeuser');
        $data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'kas masuk'])->row()->id_menus;
        $data['menu'] = $this->M_Setting->getmenu1($id);

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_kasmasuk/v_kasmasuk_add', $data);
        $this->load->view('template/footer');
    }
    public function tambahdata()
    {
        $kodekasmasuk = $this->M_KasMasuk->kasMasuk();
        $id = $this->session->userdata('tipeuser');
        $saldo = $this->db->query("SELECT * FROM tb_historikas ORDER BY id_histori_kas DESC LIMIT 1")->row_array();
        $hasil = intval($saldo['saldo']) + intval(preg_replace("/[^0-9]/", "", $this->input->post('nominal')));
        // var_dump($hasil);
        $data = [
            'tgltransaksi' => $this->input->post('tglTransaksi') . date(' h:i:s'),
            'keterangan' => $this->input->post('keterangan'),
            'nominal' => preg_replace("/[^0-9]/", "", $this->input->post('nominal')),
            'kode_kas_masuk' => $kodekasmasuk,
            'id_user' => $id,
            'statusjurnal' => '0'
        ];

        $dataHistori = [
            'kode_kas' => $kodekasmasuk,
            'jenis' => 'kas masuk',
            'nominal' => preg_replace("/[^0-9]/", "", $this->input->post('nominal')),
            'saldo' => 0,
            'tgltransaksi' => $this->input->post('tglTransaksi') . date(' h:i:s'),
        ];

        $this->M_KasMasuk->tambah($data);
        $this->M_KasMasuk->tambahHisto($dataHistori);
        $this->session->set_flashdata('message', '<div class="alert alert-success left-icon-alert" role="alert"> <strong>Sukses!</strong> Data Berhasil DiTambahkan</div>');
        redirect('kasmasuk');
    }
    public function hapus($kode)
    {

        $this->db->where('kode_kas', $kode);
        $this->db->delete('tb_historikas');
        $this->M_KasMasuk->hapus($kode);
        $this->session->set_flashdata('message', '<div class="alert alert-success left-icon-alert" role="alert"> <strong>Sukses!</strong> Data Berhasil DiHapus</div>');
        redirect('kasmasuk');
    }

    public function ubah($kode)
    {
        $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1($id);
        $data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'kas masuk'])->row()->id_menus;
        $data['km'] = $this->M_KasMasuk->getById($kode);
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_kasmasuk/v_kasmasuk_edit', $data);
        $this->load->view('template/footer');
    }
    public function ubahdata()
    {
        $kodekasmasuk = $this->input->post('kode');
        $id = $this->session->userdata('tipeuser');
        $saldo = $this->db->query("SELECT * FROM tb_historikas ORDER BY id_histori_kas DESC LIMIT 1")->row_array();
        $hasil = intval($saldo['saldo']) + intval(preg_replace("/[^0-9]/", "", $this->input->post('nominal')));

        $data = [
            'tgltransaksi' => $this->input->post('tglTransaksi') . date(' h:i:s'),
            'keterangan' => $this->input->post('keterangan'),
            'nominal' => preg_replace("/[^0-9]/", "", $this->input->post('nominal')),
            'kode_kas_masuk' => $kodekasmasuk,
            'id_user' => $id,
            'statusjurnal' => '0'
        ];
        $this->M_KasMasuk->ubah($data, $kodekasmasuk);
        $dataHistori = [
            'kode_kas' => $kodekasmasuk,
            'jenis' => 'kas keluar',
            'nominal' => preg_replace("/[^0-9]/", "", $this->input->post('nominal')),
            'saldo' => 0,
            'tgltransaksi' => $this->input->post('tglTransaksi') . date(' h:i:s'),
        ];

        $this->M_KasKeluar->tambahHisto($dataHistori);
        $this->session->set_flashdata('message', '<div class="alert alert-success left-icon-alert" role="alert"> <strong>Sukses!</strong> Data Berhasil DiUbah</div>');
        redirect('kasmasuk');
    }
    public function getKasMasuk()
    {
        echo json_encode($this->db->get_where('tb_kasmasuk', ['statusjurnal' => '0'])->result());
    }

    public function excel(){
        
        
        $data['COAD'] = $this->M_KasMasuk->getAll();
        $data['title'] = 'Laporan Kas Masuk';
        $this->load->view('v_kasmasuk/excelkasmasuk', $data);
    }

    public function pdf(){
        $COAD = $this->M_KasMasuk->getAll();
        $pdf = new FPDF('L','mm',array('148', '210'));
        // membuat halaman baru
        $pdf->AddPage();  
        $pdf->SetFont('Arial','',8,'C');
        $pdf->Cell(110,5,'LAPORAN KAS MASUK',0,1,'L');

        $pdf->SetFont('Arial','',7,'C');
        $pdf->Cell(10,2,'',0,1);
        $pdf->Cell(40,5,'Tanggal Transaksi',1,0);
        $pdf->Cell(40,5, 'Kode', 1,0);
        $pdf->Cell(70,5,'keterangan',1,0);
        $pdf->Cell(40,5,'Nominal',1,1);
        $lr = 0;
        foreach ($COAD as $COAD ) {
            
            $pdf->Cell(40,5, date('d-m-Y', strtotime($COAD['tgl_update'])),1,0);
            $pdf->Cell(40,5, $COAD['kodetransaksi'], 1,0);
            $pdf->Cell(70,5, $COAD['keterangan'],1,0);
            $pdf->Cell(40,5,number_format($COAD['nominal'], 0, '', '.'),1,1);
                    $lr = $lr + $COAD['nominal'];
            
        }

        $pdf->SetFont('Arial','B',7,'C');
        $pdf->Cell(150,5, 'Total Kas Masuk', 1,0);
        $pdf->Cell(40,5,'Rp. '.number_format($lr),1,1);

        
        // $pdf->AutoPrint(true);
        $pdf->Output();
    }
}
