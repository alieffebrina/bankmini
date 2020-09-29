<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class M_Jurnal extends CI_Model
{
    public function getJurnal(){
        return $this->db->get('tb_jurnal')->result();
    }

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
}
