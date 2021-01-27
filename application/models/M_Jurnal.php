<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class M_Jurnal extends CI_Model
{
    public function getJurnal(){
        return $this->db->query('SELECT * FROM `tb_jurnal` ORDER BY `tgl_update` DESC')->result_array();
    }

    public function getdetailjurnal($id){
        return $this->db->query('SELECT * FROM tb_detailjurnal where id_dtljurnal = '.$id)->result_array();
    }

    public function getTransaksi(){
	    $querySiswa = $this->db->query('SELECT tb_transaksi.*, tb_mastertransaksi.debet AS debet, tb_mastertransaksi.kredit AS kredit, tb_mastertransaksi.nama AS namatransaksi FROM tb_transaksi JOIN tb_mastertransaksi ON tb_transaksi.id_jenistransaksi = tb_mastertransaksi.id_mastertransaksi JOIN tb_siswa ON tb_transaksi.id_siswa = tb_siswa.nis WHERE tb_transaksi.status = "aktif"')->result_array(); 
	    $queryStaf = $this->db->query('SELECT tb_transaksi.*, tb_mastertransaksi.debet AS debet, tb_mastertransaksi.kredit AS kredit, tb_mastertransaksi.nama AS namatransaksi FROM tb_transaksi JOIN tb_mastertransaksi ON tb_transaksi.id_jenistransaksi = tb_mastertransaksi.id_mastertransaksi JOIN tb_staf ON tb_transaksi.id_anggota = tb_staf.id_staf WHERE tb_transaksi.status = "aktif"')->result_array(); 
        $data = [];
        foreach($querySiswa as $row){
            $row['nama'] = '';
            array_push($data, $row);
        }
        foreach($queryStaf as $row){
            $row['namasiswa'] = '';
            array_push($data, $row);        
        }

        return $data;
    }

    public function getTransaksinol(){
        $querySiswa = $this->db->query('SELECT tb_transaksi.*, tb_mastertransaksi.debet AS debet, tb_mastertransaksi.kredit AS kredit, tb_mastertransaksi.nama AS namatransaksi FROM tb_transaksi JOIN tb_mastertransaksi ON tb_transaksi.id_jenistransaksi = tb_mastertransaksi.id_mastertransaksi JOIN tb_siswa ON tb_transaksi.id_siswa = tb_siswa.nis WHERE tb_transaksi.status = "aktif" AND tb_transaksi.status_jurnal = "0"')->result_array(); 
        $queryStaf = $this->db->query('SELECT tb_transaksi.*, tb_mastertransaksi.debet AS debet, tb_mastertransaksi.kredit AS kredit, tb_mastertransaksi.nama AS namatransaksi FROM tb_transaksi JOIN tb_mastertransaksi ON tb_transaksi.id_jenistransaksi = tb_mastertransaksi.id_mastertransaksi JOIN tb_staf ON tb_transaksi.id_anggota = tb_staf.id_staf WHERE tb_transaksi.status = "aktif" AND tb_transaksi.status_jurnal = "0"')->result_array(); 
        $data = [];
        foreach($querySiswa as $row){
            $row['nama'] = '';
            array_push($data, $row);
        }
        foreach($queryStaf as $row){
            $row['namasiswa'] = '';
            array_push($data, $row);        
        }

        return $data;
    }

    public function insertJurnal($data){
        $this->db->insert('tb_jurnal', $data);        
    }

    public function getAll($data){
        $this->db->select('*');
        $this->db->join('tb_mastercoa', 'tb_mastercoa.id_coa = tb_detailjurnal.id_coa');
        // $this->db->join('tb_transaksi', 'tb_transaksi.id_transaksi = tb_detailjurnal.transaksi');
        $where = array(
            'id_jurnal' => $data
        );
        return $this->db->get_where('tb_detailjurnal',$where)->result_array(); 

    }


    public function gettr(){
        $this->db->select('tb_transaksi.*, tb_mastertransaksi.debet debet, tb_mastertransaksi.kredit kredit, tb_mastertransaksi.nama namatransaksi');
        $this->db->join('tb_mastertransaksi', 'tb_mastertransaksi.id_mastertransaksi = tb_transaksi.id_jenistransaksi');
        $where = array(
            'tb_transaksi.status' => 'aktif'
        );
        return $this->db->get_where('tb_transaksi',$where)->result_array(); 

    }


     public function jurnalcek($data){
        $where = array(
            'id_jurnal' => $data
        );
        return $this->db->get_where('tb_jurnal',$where)->result_array(); 

    }

    public function hitungJumlahInventori($data){
        
        $where = array(
            'id_jurnal' => $data
        );
        return $this->db->get_where('tb_detailjurnal',$where)->num_rows(); 

    }

    public function cekdatasamadebet($transaksi, $id_coa, $nominal_debet){
        
        $where = array(
            'id_coa' => $id_coa,
            'transaksi' => $transaksi,
            'nominal_debet' => $nominal_debet,
        );
        return $this->db->get_where('tb_detailjurnal',$where)->num_rows(); 

    }

    public function cekdatasamakredit($transaksi, $id_coa, $nominal_kredit){
        
        $where = array(
            'id_coa' => $id_coa,
            'transaksi' => $transaksi,
            'nominal_kredit' => $nominal_kredit,
        );
        return $this->db->get_where('tb_detailjurnal',$where)->num_rows(); 

    }

    public function updateTransaksi($id){
            $this->db->where('id_transaksi', $id);
            $this->db->update('tb_transaksi', ['status_jurnal' => '1']);
    }

    function updateJurnal(){
        $this->db->where('id_jurnal', $this->input->post('idjurnal'));
        $this->db->update('tb_jurnal', ['tgl_update' => date("Y-m-d h:i:sa")]);

    }

    function select_max(){
        $this->db->select_max('id_jurnal');
        $idbarang = $this->db->get('tb_jurnal');
        return $idbarang->row();
    }

    function select_sumdebet($data){
        $this->db->select_sum('nominal_debet');
        return $this->db->get_where('tb_detailjurnal', array('id_jurnal' => $data))->result_array(); // Produces: SELECT SUM(age) as age FROM members
    }

    function select_sumkredit($data){
        $this->db->select_sum('nominal_kredit');
        return $this->db->get_where('tb_detailjurnal', array('id_jurnal' => $data))->result_array(); // Produces: SELECT SUM(age) as age FROM members
    }

    function updatedetail(){
        $no = $this->input->post('no');
        if($this->input->post('jenis') == NULL){
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

        if($this->input->post('transaksi') != NULL){

            $data = array('id_coa' => $this->input->post('kodeCOA'), 
                'ket' => $this->input->post('ketdetail'),
                'tipe_transaksi' => $this->input->post('jurnalTs'),
                'transaksi' => $this->input->post('transaksi'),
                'nominal_kredit' => $nominal_kredit,
                'nominal_debet' => $nominal_debet
            );

        } else {
                $data = array('id_coa' => $this->input->post('kodeCOA'), 
                'ket' => $this->input->post('ketdetail'),
                'tipe_transaksi' => $this->input->post('jurnalTs'),
                'nominal_kredit' => $nominal_kredit,
                'nominal_debet' => $nominal_debet
            );
        }
        $this->db->where('id_dtljurnal', $this->input->post('iddtljurnal'));
        $this->db->update('tb_detailjurnal', $data);

        if($this->input->post('tipeawal') == 'transaksi'){
            $this->db->where('id_transaksi', $this->input->post('tsawal'));
            $this->db->update('tb_transaksi', ['status_jurnal' => '0']);
        }else if($this->input->post('tipeawal') == 'kaskeluar'){
            $this->db->where('id_kk', $this->input->post('tsawal'));
            $this->db->update('tb_kaskeluar', ['status_jurnal' => '0']);
        }else if($this->input->post('tipeawal') == 'kasmasuk'){
            $this->db->where('id_km', $this->input->post('tsawal'));
            $this->db->update('tb_kasmasuk', ['statusjurnal' => '0']);
        }
    }
}
