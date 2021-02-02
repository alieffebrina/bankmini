<?php 

date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Staff extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->model('M_Setting');
        $this->load->model('M_Staff');
        $this->load->model('M_Akses');

        cek_login_user();
    }

    public function index()
    {
        $this->load->view('template/header');
        $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1($id);
        $data['staff'] = $this->M_Staff->getAll();
        $data['akses'] = $this->M_Akses->getByLinkSubMenu(urlPath(), $id);
        $data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'guru dan anggota'])->row()->id_menus;

        $this->load->view('template/sidebar', $data);
        $this->load->view('v_staff/v_staff.php', $data);
        $this->load->view('template/footer');
    }
    public function hapus($id_staf)
    {
        $this->M_Staff->hapus($id_staf);
        $this->session->set_flashdata('message', '<div class="alert alert-success left-icon-alert" role="alert"> <strong>Sukses!</strong> Data Berhasil Dihapus</div>');
        redirect('Staff');
    }

    public function tambahdata()
    {
        $this->load->view('template/header');
        $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1($id);
        $data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'guru dan anggota'])->row()->id_menus;
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_staff/v_staff_add.php', $data);
        $this->load->view('template/footer');
    }

    public function getkota($id_provinsi)
    {
        $query = $this->db->query("SELECT * FROM tb_kota WHERE id_provinsi ='" . $id_provinsi . "'")->result_array();
        echo json_encode($query);
    }
    public function getkecamatan($id_kota)
    {
        $query = $this->db->query("SELECT * FROM tb_kecamatan WHERE id_kota ='" . $id_kota . "'")->result_array();
        echo json_encode($query);
    }

    public function tambah()
    {
        $nopegawai = $this->input->post('nopegawai');
        $rfid = $this->input->post('rfid');
        $data = [
            'nopegawai' => $nopegawai,
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'provinsi' => $this->input->post('s_provinsi'),
            'kota' => $this->input->post('s_kota'),
            'kecamatan' => $this->input->post('s_kecamatan'),
            'tlp' => $this->input->post('telp'),
            'tempat_lahir' => $this->input->post('tempat_lahir'),
            'tgl_lahir' => $this->input->post('tgl_lahir'),
            'rfid' => $this->input->post('rfid'),
            'jk' => $this->input->post('jk'),
            'jabatan' => $this->input->post('jabatan'),
            'status' => 'aktif',
            'tgl_update' => date('Y-m-d h:i:s'),
            'id_user' => $this->session->userdata('id_user'),
        ];

        if ($this->M_Staff->getByNoPegawai($nopegawai) >= 1){
            $this->session->set_flashdata('message', '<div class="alert alert-danger left-icon-alert " role="alert">
		                                            		<strong>Gagal!</strong> No Pegawai : "' . $nopegawai . ' ", sudah ada
		                                        		</div>');
            redirect('staff/tambahData');
        } else if($this->M_Staff->getByrfid($rfid) >= 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger left-icon-alert " role="alert">
                                                            <strong>Gagal!</strong> RFID : "' . $rfid . ' ", sudah ada
                                                        </div>');
            redirect('staff/tambahData');
        } else {
            $this->M_Staff->tambah($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success left-icon-alert" role="alert">
		                                            		<strong>Sukses!</strong> Berhasil Menambahkan Data Staf.
		                                        		</div>');
            redirect('staff');
        }
    }

    public function detail($id_staf)
    {
        $this->load->view('template/header');
        $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1($id);
        $data['staf'] = $this->M_Staff->getById($id_staf);
        $data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'guru dan anggota'])->row()->id_menus;
        $data['akses'] = $this->M_Akses->getByLinkSubMenu(urlPathDet(), $id);

        $this->load->view('template/sidebar', $data);
        $this->load->view('v_staff/v_staff_detail.php', $data);
        $this->load->view('template/footer');
    }

    public function ubahdata($id_staf)
    {
        $this->load->view('template/header');
        $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1($id);
        $data['staf'] = $this->M_Staff->getById($id_staf);
        $data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'guru dan anggota'])->row()->id_menus;
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_staff/v_staff_ubah.php', $data);
        $this->load->view('template/footer');
    }

    public function ubah()
    {
        $id_staf = $this->input->post('id_staf');
        $nopegawai = $this->input->post('nopegawai');
        $rfid = $this->input->post('rfid');
        if ($this->M_Staff->getByNoPegawai($nopegawai) >= 1){
            $this->session->set_flashdata('message', '<div class="alert alert-danger left-icon-alert " role="alert">
                                                            <strong>Gagal!</strong> No Pegawai : "' . $nopegawai . ' ", sudah ada
                                                        </div>');
            redirect('staff/tambahData');
        } else if($this->M_Staff->getByrfid($rfid) >= 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger left-icon-alert " role="alert">
                                                            <strong>Gagal!</strong> RFID : "' . $rfid . ' ", sudah ada
                                                        </div>');
            redirect('staff/tambahData');
        } else {
            $data = [
                'nopegawai' => $this->input->post('nopegawai'),
                'nama' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'provinsi' => $this->input->post('s_provinsi'),
                'kota' => $this->input->post('s_kota'),
                'kecamatan' => $this->input->post('s_kecamatan'),
                'tlp' => $this->input->post('telp'),
                'tgl_update' => date('Y-m-d h:i:s'),
                'id_user' => $this->session->userdata('id_user'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'jabatan' => $this->input->post('jabatan'),
                'tgl_lahir' => $this->input->post('tgl_lahir'),
                'rfid' => $this->input->post('rfid'),
                'jk' => $this->input->post('jk'),
            ];
            $this->M_Staff->ubah($data, $id_staf);
        }
        

        if ($this->input->post('profile')) {
            $session = array(
                'authenticated' => true, // Buat session authenticated dengan value true
                'nopegawai' => $data['nopegawai'],  // Buat session nip
                'nama' => $data['nama'],
                'id_user' => $id_staf, // Buat session authenticated
                'tipeuser' => $data['id_tipeuser'],
                'login' => true
            );
            $this->session->set_userdata($session);
            $this->session->set_flashdata('message', '<div class="alert alert-success left-icon-alert" role="alert">
		                                            		<strong>Sukses!</strong> Data Berhasil Diubah.
		                                        		</div>');
            redirect('profile');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success left-icon-alert" role="alert"> <strong>Sukses!</strong> Data Berhasil Diubah</div>');
            redirect('staff');
        }
    }
    
    public function getStaff()
    {
        echo json_encode($this->db->get_where('tb_staf', ['id_tipeuser' => 1, 'status' => 'aktif'])->result_array());
    }

    public function staff_import()
    {
        $id = $this->session->userdata('tipeuser');
        
        // $data['akses'] = $this->M_Akses->getByLinkSubMenu(urlPath(), $id);
        $data['menu'] = $this->M_Setting->getmenu1($id);
        $data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'siswa'])->row()->id_menus;

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_staff/v_staff-import', $data);
        $this->load->view('template/footer');
    }

    public function import()
    {
        // echo $this->input->get('id_tahunakademik');   
        $data = $this->session->dataImport;
        $dataRow = 0;
        for ($i = 0; $i < count($data); $i++) {
            unset($data[$i]['tempat_tgl_lahir']);
            if($this->db->get_where('tb_staf',['nama' => $data[$i]['nama']])->num_rows() === 0){
                $this->db->insert('tb_staf', $data[$i]);
                $this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
                <strong>Sukses!</strong> Berhasil Import Data Staf.
                </div>');
            }else{
                $dataRow = $dataRow + 1;
                $this->session->set_flashdata('alert', '<div class="alert alert-warning left-icon-alert" role="alert">
                <strong>Perhatian!</strong> Ada '.$dataRow.' Data Staf Yang Sudah Ada Dalam Database.
                </div>');
            }
        }
        // $this->session->unset_tempdata('dataImport');        
        redirect('staff');
    }

    public function downTMPstaf(){
        // $data['kelas'] = $this->db->get_where('tb_kelas', ['id_kelas' => $kelas])->row()->kelas;
        // $this->load->view('v_siswa/v_siswa-download-tmp', $data);    
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'DATA GURU DAN STAF ');
        $sheet->mergeCells('A1:H1');

        $sheet->setCellValue('A2', 'SMA NEGERI 1 WRINGIN ANOM ');
        $sheet->mergeCells('A2:H2');
                
        $sheet->setCellValue('A3', ' ~Field dengan tanda ( * ) wajib di isi');
        $sheet->mergeCells('A3:H3');
        
        $sheet->setCellValue('A4', ' ~Untuk Format Tempat tanggal lahir jangan lupa dipisah dengan koma ( , )');
        $sheet->mergeCells('A4:H4');

        $sheet->setCellValue('A5', 'No');
        $sheet->setCellValue('B5', 'RFID*');
        $sheet->setCellValue('C5', 'Nomor Anggota*');
        $sheet->setCellValue('D5', 'Nama Lengkap*');
        $sheet->setCellValue('E5', 'Jabatan');
        $sheet->setCellValue('F5', 'L/P');
        $sheet->setCellValue('G5', 'Tempat, Tanggal Lahir');        
        $sheet->setCellValue('H5', 'Alamat');
        
        $sheet->setCellValue('A6', ' ');
        $sheet->setCellValue('B6', ' ');
        $sheet->setCellValue('C6', ' ');
        $sheet->setCellValue('D6', ' ');
        $sheet->setCellValue('E6', ' ');
        $sheet->setCellValue('F6', ' ');
        $sheet->setCellValue('G6', ' ');
        $sheet->setCellValue('H6', ' ');

        $styleArray = [         
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '00000000'],
                ],
            ],
        
        ];
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getStyle('A1:H6')->applyFromArray($styleArray);             

        $writer = new Xlsx($spreadsheet);
        
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="formatuploaddata.xlsx"'); 
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        // $siswa = $this->siswa_model->getAll();
        // $no = 1;
        // $x = 2;
        // foreach($siswa as $row)
        // {
        //  $sheet->setCellValue('A'.$x, $no++);
        //  $sheet->setCellValue('B'.$x, $row->nama);
        //  $sheet->setCellValue('C'.$x, $row->kelas);
        //  $sheet->setCellValue('D'.$x, $row->jenis_kelamin);
        //  $sheet->setCellValue('E'.$x, $row->alamat);
        //  $x++;
        // }    
    }
}