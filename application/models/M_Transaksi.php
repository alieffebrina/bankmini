<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Transaksi extends CI_Model {

    public function getTransaksi(){
	    $querySiswa = $this->db->query('SELECT * FROM tb_transaksi JOIN tb_mastertransaksi ON tb_transaksi.id_jenistransaksi = tb_mastertransaksi.id_mastertransaksi JOIN tb_siswa ON tb_transaksi.id_siswa = tb_siswa.nis WHERE tb_transaksi.status = "aktif"')->result_array(); 
	    $queryStaf = $this->db->query('SELECT * FROM tb_transaksi JOIN tb_mastertransaksi ON tb_transaksi.id_jenistransaksi = tb_mastertransaksi.id_mastertransaksi JOIN tb_staf ON tb_transaksi.id_anggota = tb_staf.id_staf WHERE tb_transaksi.status = "aktif"')->result_array(); 
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

    // public function cekKodeTransaksi($kode){
    //     $this->db->where('kodetransaksi', $kode);   
    //     $query = $this->db->get('tb_mastertransaksi'); 
    //     if($query->num_rows() === 1){
    //         return false;
    //     }else{
    //         return true;
    //     }
    // }    

    public function addTransaksi($data){
    	$this->db->insert('tb_transaksi', $data);
    }

    public function deleteTransaksi($id){
        $data = ['status' => 'tidak aktif'];
    	$this->db->where('id_transaksi', $id);
    	$this->db->update('tb_transaksi', $data);
    }

    // public function detailTransaksi($id){
    //     $this->db->where('id_mastertransaksi', $id);   
    //     return $this->db->get('tb_mastertransaksi')->row(); 
    // }   

    public function editTransaksi($data, $id){
    	$this->db->where('id_transaksi', $id);
    	$this->db->update('tb_transaksi', $data);
    }
}