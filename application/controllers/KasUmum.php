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
        $this->load->model('M_Akses');
        $this->load->model('M_KasUmum');
        $this->load->model('M_Transaksi');
        $this->load->library('Pdf'); 

        cek_login_user();
    }

    public function index()
    {
        $this->M_KasUmum->saldo();
        $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1($id);
        $data['akses'] = $this->M_Akses->getByLinkSubMenu(urlPath(), $id);
        $data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'transaksi kas'])->row()->id_menus;

        $data['transaksi'] = $this->M_KasUmum->getkas();       
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_kasumum/v_transaksikas', $data);
        $this->load->view('template/footer');
    }

    public function acc()
    {
        $this->M_KasUmum->saldo();
        $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1($id);
        $data['akses'] = $this->M_Akses->getByLinkSubMenu(urlPath(), $id);
        $data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'Kas Umum'])->row()->id_menus;

        $data['transaksi'] = $this->M_KasUmum->getkas();       
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_kasumum/v_acc', $data);
        $this->load->view('template/footer');
    }

     public function anamlama()
    {
        $this->M_KasUmum->saldo();
        $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1($id);
        $data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'transaksi kas'])->row()->id_menus;


        $data['recap'] = $this->M_KasUmum->dataBlnIni();

        
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_kasumum/v_kasumum', $data);
        $this->load->view('template/footer');
    }

     public function add()
    {
        $this->M_KasUmum->saldo();
        $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1($id);
        $data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'transaksi kas'])->row()->id_menus;


        $data['recap'] = $this->M_KasUmum->dataBlnIni();

        $data['transaksi'] = $this->M_KasUmum->gettransaksi(); 
        $data['nominal'] = $this->M_KasUmum->getsaldo(); 
        
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_kasumum/v_kasumum-add', $data);
        $this->load->view('template/footer');
    }

    public function add_process()
    {
        $jenis = $this->input->post('id_jenistransaksi');
        $pecahkategori = explode('-', $jenis);
        $jt = $pecahkategori[0];

        $pecahtgl = explode('-', $this->input->post('tgl'));


        $nominal = preg_replace("/[^0-9]/", "", $this->input->post('no'));
        $saldo = $this->input->post('saldo');
        if($pecahkategori[1] == 'KAS KELUAR' && $nominal>$saldo){
            $this->session->set_flashdata('alert', '<div class="alert alert-danger left-icon-alert" role="alert">
                <strong>Gagal!</strong> Nominal melebihi batas.
            </div>');
             redirect('transaksi-kas-add');
        } else {
            if($pecahkategori[1] == 'KAS KELUAR'){
                $sisasaldo = $saldo - intval($nominal);
            }else if($pecahkategori[1] == 'KAS MASUK'){
                $sisasaldo = $saldo + intval($nominal);
            }   

            $selectmax = $this->M_KasUmum->gettotal($jt);
            $getkode = $this->M_KasUmum->getkode($jt);
            foreach ($getkode as $getkode) {
                $a = $getkode->kodetransaksi;            
                $pecah = explode('-', $a);
                date_default_timezone_set('Asia/Jakarta');
                $tgl = $pecahtgl[2].$pecahtgl[1].$pecahtgl[0];
                $a = str_replace("tanggal", $tgl, $a);
                $ida = $selectmax+1;
                $a = str_replace("no", $ida, $a);
            }
            $kode = $a;
            // date_default_timezone_set('Asia/Jakarta');
            // var_dump($this->input->post());      
            $id_customer = $this->input->post('id_customer', true);
            $id_tipeuser = $this->db->get_where('tb_tipeuser',['id_tipeuser' => intval($this->input->post('usertipe')) ] )->row();      
            $data = array(
                'id_jenistransaksi ' => $this->input->post('id_jenistransaksi', true),
                'kodetransaksi' => $kode,
                'keterangan' => $this->input->post('keterangan', true),
                'nominal' => preg_replace("/[^0-9]/", "", $this->input->post('no')),
                'id_user' => $this->session->userdata('id_user'),
                'tgl_update' => $this->input->post('tgl'),
                'status' => 'aktif',

            );

            // var_dump($sisasaldo);    
            $baseurl = base_url();
                
            $id_transaksi = $this->M_Transaksi->addTransaksi($data);
            // $id_transaksi = 0;
            $this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
                                                            <strong>Sukses!</strong> Transaksi Berhasil.
                                                        </div>');
            if($this->input->post('action') == 'cetak'){
                    echo '<script>                              
                                window.onload = () => {  
                                    let move =  window.open("'.$baseurl.'transaksi/printOutTransaksi?id_transaksi='.$id_transaksi.'&tipe='.$id_tipeuser->tipeuser.'&ss='.$sisasaldo.'");
                                    setTimeout( () => {
                                        move.close();
                                        window.location.href = "'.$baseurl.'KasUmum/"                                 
                                    }, 3000)
                                };                                  
                        </script>';     
                // header(base_url('transaksi/printOutTransaksi?id_transaksi='.$id_transaksi.'&tipe='.$id_tipeuser->tipeuser.'&ss='.$sisasaldo));
            }else if($this->input->post('action') == 'simpan'){
                redirect(base_url('KasUmum/'));
            }           
            // redirect(base_url('transaksi/printOutTransaksi?id_transaksi='.$id_transaksi.'&tipe='.$id_tipeuser->tipeuser.'&ss='.$sisasaldo));
        }
        
    }

    public function recapKas($tgl)
    {

        // $tglakhir = $this->M_KasUmum->tglakhirbulan(date('Y'), intval($tgl));
        $dataHisto = $this->db->query("SELECT * FROM tb_historikas WHERE MONTH(tgltransaksi) = " . $tgl . " AND YEAR(tgltransaksi) = " . date('Y') . " ORDER BY tgltransaksi")->result_array();
        $data =  array();
        $j = $this->db->query("SELECT * FROM tb_historikas WHERE MONTH(tgltransaksi) = " . $tgl . " AND YEAR(tgltransaksi) = " . date('Y') . " ORDER BY tgltransaksi")->num_rows();

        $kasmasuk = 0;
        $kaskeluar = 0;
        $saldo = 0;
        $i = 0;
        $hasil = 0;
        foreach ($dataHisto as $datahistoo) {
            $this->db->where('kode_kas', $datahistoo['kode_kas']);
            $this->db->update('tb_historikas', ['saldo' => 0]);
            $i++;
            $awal = $i;
            if ($awal == 1) {
                $saldo = 0;
                $kasmasuk = $datahistoo['nominal'];
                $hasil = intval($saldo) + intval($kasmasuk);
                $this->db->where('kode_kas', $datahistoo['kode_kas']);
                $this->db->update('tb_historikas', ['saldo' => $hasil]);
            } else if ($awal > 1) {

                if ($awal == 2) {
                    $zz = $this->db->query("SELECT * FROM tb_historikas  ORDER BY tgltransaksi  LIMIT 0 ,1")->row_array();
                    $saldo = $zz['saldo'];
                    if ($datahistoo['jenis'] == 'kas masuk') {
                        $kasmasuk = $datahistoo['nominal'];
                        $hasil = intval($saldo) + intval($kasmasuk);
                        $this->db->where('kode_kas', $datahistoo['kode_kas']);
                        $this->db->update('tb_historikas', ['saldo' => $hasil]);
                    } else if ($datahistoo['jenis'] == 'kas keluar') {
                        $kaskeluar = $datahistoo['nominal'];
                        $hasil = intval($saldo) - intval($kaskeluar);
                        $this->db->where('kode_kas', $datahistoo['kode_kas']);
                        $this->db->update('tb_historikas', ['saldo' => $hasil]);
                    }
                } else if ($awal != 2) {
                    $tujuan = $awal + 1;
                    $zz = $this->db->query("SELECT * FROM tb_historikas  ORDER BY tgltransaksi LIMIT " . intval($awal - 2) . "," . intval($tujuan))->result_array();
                    $ii = 0;
                    foreach ($zz as $datazz) {
                        $ii++;
                        $awall = $ii;
                        if ($awall == 1) {
                            $saldo = $datazz['saldo'];
                        }
                    }

                    // var_dump($saldo);
                    if ($datahistoo['jenis'] == 'kas masuk') {
                        $kasmasuk = $datahistoo['nominal'];
                        $hasil = intval($saldo) + intval($kasmasuk);
                        $this->db->where('kode_kas', $datahistoo['kode_kas']);
                        $this->db->update('tb_historikas', ['saldo' => $hasil]);
                    } else if ($datahistoo['jenis'] == 'kas keluar') {
                        $kaskeluar = $datahistoo['nominal'];
                        $hasil = intval($saldo) - intval($kaskeluar);
                        $this->db->where('kode_kas', $datahistoo['kode_kas']);
                        $this->db->update('tb_historikas', ['saldo' => $hasil]);
                    }
                }
                // var_dump($saldo);
            }

            // var_dump($hasil);
            if ($datahistoo['jenis'] == 'kas masuk') {
                $b = $this->db->query("SELECT * FROM tb_kasmasuk WHERE kode_kas_masuk ='" . $datahistoo['kode_kas'] . "'")->row_array();
                array_push($data, array($b['tgltransaksi'], $b['keterangan'], $b['nominal'], $b['kode_kas_masuk'], $hasil));
            } else if ($datahistoo['jenis'] == 'kas keluar') {
                $d = $this->db->query("SELECT * FROM tb_kaskeluar WHERE kode_kas_keluar = '" . $datahistoo['kode_kas'] . "'")->row_array();
                array_push($data, array($d['tgltransaksi'], $d['keterangan'], $d['nominal'], $d['kode_kas_keluar'], $hasil));
            }
        }

        echo json_encode($data);
    }
    public function saldoo($month)
    {
        $aaa = $this->db->query("SELECT * FROM tb_historikas WHERE MONTH(tgltransaksi) = " . intval($month) . " ORDER BY id_histori_kas DESC LIMIT 1")->row_array();
        echo json_encode($aaa);
    }
    public function dkkkk($month)
    {
        $dbet = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk' AND MONTH(tgltransaksi) = " . intval($month) . " ")->row_array();
        $kreddi = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar' AND MONTH(tgltransaksi) = " . intval($month) . "")->row_array();

        $dbett = 0;
        $kr = 0;
        $sa = $dbet['nominal'] - $kreddi['nominal'];

        if ($dbet['nominal'] != 0) {
            $dbett = $dbet['nominal'];
        }
        if ($kreddi['nominal'] != 0) {
            $kr = $kreddi['nominal'];
        }


        $data = [
            'dbet' => $dbett,
            'krdi' => $kr,
            'sldo' => $sa
        ];

        echo json_encode($data);
    }

    public function hariini()
    {
        //sldo awal
        $hariini = date('Y-m-d');
        // $dbett = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk' AND tgltransaksi != '$hariini' ")->row_array();
        // $kreddii = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar' AND tgltransaksi != '$hariini'")->row_array();

        // $sldoawal = $dbett['nominal'] - $kreddii['nominal'];

        $dbet = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk' AND tgltransaksi = '$hariini' ")->row_array();
        $kreddi = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar' AND tgltransaksi = '$hariini'")->row_array();

        $dbt = 0 + $dbet['nominal'];
        $krd = 0 + $kreddi['nominal'];
        $sldoo = $dbt - $krd;
        $a = [$dbt, $krd, $sldoo];
        //isi
        $hari = date("Y-m-d");
        $datahariini = $this->db->query("SELECT * FROM tb_historikas WHERE tgltransaksi = '" . $hari . "'")->result_array();
        $data = array();
        foreach ($datahariini as $datahistoo) {
            if ($datahistoo['jenis'] == 'kas masuk') {
                $b = $this->db->query("SELECT * FROM tb_kasmasuk WHERE kode_kas_masuk ='" . $datahistoo['kode_kas'] . "'")->row_array();
                array_push($data, array($b['tgltransaksi'], $b['keterangan'], $b['nominal'], $b['kode_kas_masuk'], $datahistoo['saldo']));
            } else if ($datahistoo['jenis'] == 'kas keluar') {
                $d = $this->db->query("SELECT * FROM tb_kaskeluar WHERE kode_kas_keluar = '" . $datahistoo['kode_kas'] . "'")->row_array();
                array_push($data, array($d['tgltransaksi'], $d['keterangan'], $d['nominal'], $d['kode_kas_keluar'], $datahistoo['saldo']));
            }
        }
        $dataaa = [
            'data1' => $data,
            'data2' => $a
        ];
        echo json_encode($dataaa);
    }
    public function bulaniniBy($id, $akhir, $awal)
    {
        $thnini = intval(date('Y'));
        $blnini = intval(date('m'));

        //sldo bkn thn ini
        $dbettt = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk' AND YEAR(tgltransaksi) != " . date('Y'))->row_array();
        $krediii = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar' AND YEAR(tgltransaksi) != " . date('Y'))->row_array();
        $sldobknthnini = $dbettt['nominal'] - $krediii['nominal'];

        //sldo thn ini bkuan bln ini
        $dbett = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk' AND YEAR(tgltransaksi) = " . date('Y') . " AND MONTH(tgltransaksi) != " . date('m'))->row_array();
        $kredii = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar' AND YEAR(tgltransaksi) = " . date('Y') . " AND MONTH(tgltransaksi) != " . date('m'))->row_array();
        $sldothninibknblnini = $dbett['nominal'] - $kredii['nominal'];

        //sldo bln ini thn ini
        $dbet = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk' AND YEAR(tgltransaksi) = " . date('Y') . " AND MONTH(tgltransaksi) = " . date('m') . " AND DAY(tgltransaksi) >= $awal AND  DAY(tgltransaksi) <= $akhir")->row_array();
        $kredi = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar' AND YEAR(tgltransaksi) = " . date('Y') . " AND MONTH(tgltransaksi) = " . date('m') . " AND DAY(tgltransaksi) >= $awal AND  DAY(tgltransaksi) <= $akhir")->row_array();
        $sldblnini = $dbet['nominal'] - $kredi['nominal'];

        $sldoawal = $sldobknthnini + $sldothninibknblnini;
        $dbt = $sldoawal + $dbet['nominal'];
        $krd = $kredi['nominal'];
        $sdo = $sldoawal + $sldblnini;

        $a = [$sldoawal, $dbt, $krd, $sdo];

        //dta bln ini
        $datablnini = $this->db->query("SELECT * FROM tb_historikas WHERE MONTH(tgltransaksi) = " . $blnini . " AND DAY(tgltransaksi) = " . $id . " AND YEAR(tgltransaksi) = " . $thnini . " ORDER BY tgltransaksi ASC")->result_array();
        $data = array();
        foreach ($datablnini as $datahistoo) {
            if ($datahistoo['jenis'] == 'kas masuk') {
                $b = $this->db->query("SELECT * FROM tb_kasmasuk WHERE kode_kas_masuk ='" . $datahistoo['kode_kas'] . "'")->row_array();
                array_push($data, array($b['tgltransaksi'], $b['keterangan'], $b['nominal'], $b['kode_kas_masuk'], $datahistoo['saldo']));
            } else if ($datahistoo['jenis'] == 'kas keluar') {
                $d = $this->db->query("SELECT * FROM tb_kaskeluar WHERE kode_kas_keluar = '" . $datahistoo['kode_kas'] . "'")->row_array();
                array_push($data, array($d['tgltransaksi'], $d['keterangan'], $d['nominal'], $d['kode_kas_keluar'], $datahistoo['saldo']));
            }
        }

        $dataa = [
            'data1' => $data,
            'data2' => $a
        ];
        echo json_encode($dataa);
    }

    public function blnini()
    {
        $thnini = intval(date('Y'));
        $blnini = intval(date('m'));


        //sldo bkn thn ini
        $dbettt = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk' AND YEAR(tgltransaksi) != " . date('Y'))->row_array();
        $krediii = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar' AND YEAR(tgltransaksi) != " . date('Y'))->row_array();
        $sldobknthnini = $dbettt['nominal'] - $krediii['nominal'];

        //sldo thn ini bkuan bln ini
        $dbett = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk' AND YEAR(tgltransaksi) = " . date('Y') . " AND MONTH(tgltransaksi) != " . date('m'))->row_array();
        $kredii = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar' AND YEAR(tgltransaksi) = " . date('Y') . " AND MONTH(tgltransaksi) != " . date('m'))->row_array();
        $sldothninibknblnini = $dbett['nominal'] - $kredii['nominal'];

        //sldo bln ini thn ini
        $dbet = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk' AND YEAR(tgltransaksi) = " . date('Y') . " AND MONTH(tgltransaksi) = " . date('m'))->row_array();
        $kredi = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar' AND YEAR(tgltransaksi) = " . date('Y') . " AND MONTH(tgltransaksi) = " . date('m'))->row_array();
        $sldblnini = $dbet['nominal'] - $kredi['nominal'];


        $sldoawal = $sldobknthnini + $sldothninibknblnini;
        $dbt = $sldoawal + $dbet['nominal'];
        // $dbt = $dbet['nominal'];
        $krd = 0+$kredi['nominal'];
        $sdo = $sldoawal + $sldblnini;

        $a = [$sldoawal,$dbt, $krd, $sdo];


        $datablnini = $this->db->query("SELECT * FROM tb_historikas WHERE MONTH(tgltransaksi) = " . $blnini . " AND YEAR(tgltransaksi) = " . $thnini)->result_array();
        
        $data = array();
        foreach ($datablnini as $datahistoo) {
            if ($datahistoo['jenis'] == 'kas masuk') {
                $b = $this->db->query("SELECT * FROM tb_kasmasuk WHERE kode_kas_masuk ='" . $datahistoo['kode_kas'] . "'")->row_array();
                array_push($data, array($b['tgltransaksi'], $b['keterangan'], $b['nominal'], $b['kode_kas_masuk'], $datahistoo['saldo']));
            } else if ($datahistoo['jenis'] == 'kas keluar') {
                $d = $this->db->query("SELECT * FROM tb_kaskeluar WHERE kode_kas_keluar = '" . $datahistoo['kode_kas'] . "'")->row_array();
                array_push($data, array($d['tgltransaksi'], $d['keterangan'], $d['nominal'], $d['kode_kas_keluar'], $datahistoo['saldo']));
            }
        }

        $dataa = [
            'data1' => $data,
            'data2' => $a
        ];
        echo json_encode($dataa);
    }
    public function thnini()
    {
        $thnini = intval(date('Y'));

        // sldobkn thn ini 
        $dbet = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk' AND YEAR(tgltransaksi) != " . date('Y'))->row_array();
        $kredi = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar' AND YEAR(tgltransaksi) != " . date('Y'))->row_array();


        //sldo thn ini
        $dbett = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk' AND YEAR(tgltransaksi) = " . date('Y'))->row_array();
        $kredii = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar' AND YEAR(tgltransaksi) = " . date('Y'))->row_array();
        $sldoskrng = $dbett['nominal'] - $kredii['nominal'];

        $sldoawal = $dbet['nominal'] - $kredi['nominal'];
        $dbt = $sldoawal + $dbett['nominal'];
        // $dbt = $dbett['nominal'];
        $krdi = $kredii['nominal'];
        $sdo = $sldoawal + $sldoskrng;

        $a = [$sldoawal,$dbt, $krdi, $sdo];

        $datathnini = $this->db->query("SELECT * FROM tb_historikas WHERE YEAR(tgltransaksi) = " . $thnini . " ORDER BY tgltransaksi")->result_array();
        $data = array();
        foreach ($datathnini as $datahistoo) {
            if ($datahistoo['jenis'] == 'kas masuk') {
                $b = $this->db->query("SELECT * FROM tb_kasmasuk WHERE kode_kas_masuk ='" . $datahistoo['kode_kas'] . "'")->row_array();
                array_push($data, array($b['tgltransaksi'], $b['keterangan'], $b['nominal'], $b['kode_kas_masuk'], $datahistoo['saldo']));
            } else if ($datahistoo['jenis'] == 'kas keluar') {
                $d = $this->db->query("SELECT * FROM tb_kaskeluar WHERE kode_kas_keluar = '" . $datahistoo['kode_kas'] . "'")->row_array();
                array_push($data, array($d['tgltransaksi'], $d['keterangan'], $d['nominal'], $d['kode_kas_keluar'], $datahistoo['saldo']));
            }
        }
        $dataa = [
            'data1' => $data,
            'data2' => $a
        ];
        echo json_encode($dataa);
    }

    public function sldothniini()
    {

        $dbett = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk' AND YEAR(tgltransaksi) != " . date('Y'))->row_array();
        $kreddii = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar' AND YEAR(tgltransaksi) != " . date('Y'))->row_array();

        $dbet = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk' AND YEAR(tgltransaksi) = " . date('Y'))->row_array();
        $kreddi = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar' AND YEAR(tgltransaksi) = " . date('Y'))->row_array();
        $saa = $dbett['nominal'] - $kreddii['nominal'];
        $sa = $dbet['nominal'] - $kreddi['nominal'];

        $data = [
            'dbt' => intval($dbet['nominal']),
            'krdi' => intval($kreddi['nominal']),
            'sldothnkmrin' => intval(($saa)),
            'sldothn' => intval($sa),
            'jumlah' => intval($saa + $sa)
        ];

        echo json_encode($data);
    }

    public function sldohriiini()
    {
        $hariini = date('Y-m-d');
        $dbett = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk' AND tgltransaksi != '$hariini' ")->row_array();
        $kreddii = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar' AND tgltransaksi != '$hariini'")->row_array();


        $dbett = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk' AND tgltransaksi = '$hariini' ")->row_array();
        $kreddii = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar' AND tgltransaksi = '$hariini'")->row_array();

        $saa =  $dbett['nominal'] - $kreddii['nominal'];
        $data = [
            'dbetkmarin' => $saa,
        ];

        echo json_encode($data);
    }

    // public function sldohriiini()
    // {

    //     $harini = date('Y-m-d');
    //     $dbett = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk' AND tgltransaksi != '$harini'")->row_array();
    //     $kreddii = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar' AND tgltransaksi != '$harini'")->row_array();

    //     $dbet = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk'  AND tgltransaksi = '$harini'")->row_array();
    //     $kreddi = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar' AND tgltransaksi = '$harini'")->row_array();

    //     $saa = $dbett['nominal'] - $kreddii['nominal'];
    //     $sa = $dbet['nominal'] - $kreddi['nominal'];

    //     $data = [
    //         'dbt' => intval($dbet['nominal']),
    //         'krdi' => intval($kreddi['nominal']),
    //         'sldothnkmrin' => intval(($saa)),
    //         'sldothn' => intval($sa),
    //         'jumlah' => intval($saa + $sa)
    //     ];

    //     echo json_encode($data);
    // }

    public function bnn($bln, $hri)
    {
        $thnini =  date('Y');
        $dHistori = $this->db->query("SELECT * FROM tb_historikas WHERE MONTH(tgltransaksi) = " . $bln . " AND DAY(tgltransaksi) = " . $hri . " AND YEAR(tgltransaksi) = " . $thnini . " ORDER BY tgltransaksi")->result_array();
        $dataa = array();
        foreach ($dHistori as $data) {
            if ($data['jenis'] == 'kas masuk') {
                $b = $this->db->query("SELECT * FROM tb_kasmasuk WHERE kode_kas_masuk ='" . $data['kode_kas'] . "'")->row_array();
                array_push($dataa, array($b['tgltransaksi'], $b['keterangan'], $b['nominal'], $b['kode_kas_masuk'], $data['saldo']));
            } else if ($data['jenis'] == 'kas keluar') {
                $d = $this->db->query("SELECT * FROM tb_kaskeluar WHERE kode_kas_keluar = '" . $data['kode_kas'] . "'")->row_array();
                array_push($dataa, array($d['tgltransaksi'], $d['keterangan'], $d['nominal'], $d['kode_kas_keluar'], $data['saldo']));
            }
        }
        
        echo json_encode($dataa);
    }

    public function bnnn($awal,$akhir)
    {

        //sldo != saat ini
        $dbett = $this->db->query("SELECT SUM(nominal) as nominal FROM tb_historikas WHERE tgltransaksi < CAST('$awal' AS DATE)  AND jenis = 'kas masuk'")->row_array();
        $kreddii = $this->db->query("SELECT SUM(nominal) as nominal FROM tb_historikas WHERE tgltransaksi < CAST('$awal' AS DATE)  AND jenis = 'kas keluar'")->row_array();
        

        //sldo saat ini
        $dbet = $this->db->query("SELECT SUM(nominal) as nominal FROM tb_historikas WHERE tgltransaksi >= CAST('$awal' AS DATE) AND tgltransaksi <= CAST('$akhir' AS DATE)  AND jenis = 'kas masuk'")->row_array();
        $kreddi = $this->db->query("SELECT SUM(nominal) as nominal FROM tb_historikas WHERE tgltransaksi >= CAST('$awal' AS DATE) AND tgltransaksi <= CAST('$akhir' AS DATE)  AND jenis = 'kas keluar'")->row_array();
        $sldosaatini = $dbet['nominal'] - $kreddi['nominal'];



        $sldoawal = $dbett['nominal'] - $kreddii['nominal'];
        $dbt = $sldoawal + $dbet['nominal'];
        // $dbt = $dbett['nominal'];
        $krdi = $kreddi['nominal'];
        $sdo = $sldoawal + $sldosaatini;

        $a = [$sldoawal, $dbt, $krdi, $sdo ];
        echo json_encode($a);

    }
    public function thnn($awal,$akhir)
    {

        //sldo != 
        $dbett = $this->db->query("SELECT SUM(nominal) as nominal FROM tb_historikas WHERE tgltransaksi < CAST('$awal' AS DATE)  AND jenis = 'kas masuk'")->row_array();
        $kreddii = $this->db->query("SELECT SUM(nominal) as nominal FROM tb_historikas WHERE tgltransaksi < CAST('$awal' AS DATE)  AND jenis = 'kas keluar'")->row_array();


        //sldo ==
        $dbet = $this->db->query("SELECT SUM(nominal) as nominal FROM tb_historikas WHERE tgltransaksi >= CAST('$awal' AS DATE) AND tgltransaksi <= CAST('$akhir' AS DATE)  AND jenis = 'kas masuk'")->row_array();
        $kreddi = $this->db->query("SELECT SUM(nominal) as nominal FROM tb_historikas WHERE tgltransaksi >= CAST('$awal' AS DATE) AND tgltransaksi <= CAST('$akhir' AS DATE)  AND jenis = 'kas keluar'")->row_array();
        $sldosaatini = $dbet['nominal'] - $kreddi['nominal'];



        $sldoawal = $dbett['nominal'] - $kreddii['nominal'];
        $dbt = $sldoawal + $dbet['nominal'];
        // $dbt = $dbett['nominal'];
        $krdi = 0+$kreddi['nominal'];
        $sdo = $sldoawal + $sldosaatini;

        $a = [$sldoawal, $dbt, $krdi, $sdo];

        $dHistori = $this->db->query("SELECT * FROM tb_historikas WHERE tgltransaksi >= CAST('$awal' AS DATE) AND tgltransaksi <= CAST('$akhir' AS DATE) ORDER BY tgltransaksi")->result_array();
        $dataa = array();
        foreach ($dHistori as $data) {
            if ($data['jenis'] == 'kas masuk') {
                $b = $this->db->query("SELECT * FROM tb_kasmasuk WHERE kode_kas_masuk ='" . $data['kode_kas'] . "'")->row_array();
                array_push($dataa, array($b['tgltransaksi'], $b['keterangan'], $b['nominal'], $b['kode_kas_masuk'], $data['saldo']));
            } else if ($data['jenis'] == 'kas keluar') {
                $d = $this->db->query("SELECT * FROM tb_kaskeluar WHERE kode_kas_keluar = '" . $data['kode_kas'] . "'")->row_array();
                array_push($dataa, array($d['tgltransaksi'], $d['keterangan'], $d['nominal'], $d['kode_kas_keluar'], $data['saldo']));
            }
        }

        $data = [
            'data1' => $dataa,
            'data2' => $a
        ];
        echo json_encode($data);
    }

    public function transaksi_delete($id)
    {
        $this->M_Transaksi->deleteTransaksi($id);
        $this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
                                                        <strong>Sukses!</strong> Berhasil Di hapus.
                                                    </div>');
        redirect(base_url('KasUmum/'));
    }

    public function excel(){
        
        
        $data['COAD'] = $this->M_KasUmum->getkas();
        $data['title'] = 'Laporan Kas Umum';
        $this->load->view('v_kasumum/excelkasumum', $data);
    }

    public function pdf(){
        $COAD = $this->M_KasUmum->getkas();
        $pdf = new FPDF('L','mm',array('148', '210'));
        // membuat halaman baru
        $pdf->AddPage();  
        $pdf->SetFont('Arial','',8,'C');
        $pdf->Cell(110,5,'LAPORAN KAS UMUM',0,1,'L');

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
            $cek = $this->db->get_where('tb_mastertransaksi', ['id_mastertransaksi' => $COAD['id_jenistransaksi']])->result_array();
            foreach ($cek as $cek ) {
                if($cek['debet'] == 'koperasi'){
                    $lr = $lr + $COAD['nominal'];
                } else {
                     $lr = $lr - $COAD['nominal'];
                }
            }
            
        }

        $pdf->SetFont('Arial','B',7,'C');
        $pdf->Cell(150,5, 'Total Saldo', 1,0);
        $pdf->Cell(40,5,'Rp. '.number_format($lr),1,1);

        
        // $pdf->AutoPrint(true);
        $pdf->Output();
    }
    
}
