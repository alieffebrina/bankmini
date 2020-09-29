<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class M_Kaskeluar extends CI_Model
{
    function getAll()
    {
        $query = $this->db->get('tb_kaskeluar');
        return $query->result_array();
    }
    function getById($kode)
    {
        return $this->db->get_where('tb_kaskeluar', ['kode_kas_keluar' => $kode])->row_array();
    }
    function kodekaskeluar()
    {

        $awal = 'KK';
        $hariini = date('Ymd');
        $tglawal = date('Y-m-d', strtotime('first day of this month'));
        $terakhire = $this->db->query("SELECT kode_kas_keluar FROM tb_kaskeluar ORDER BY tgltransaksi DESC LIMIT 1")->row_array();
        if (date('d') == $tglawal || $terakhire == null) {
            $angka = 1;
        } else {
            $angkaakhir = substr($terakhire['kode_kas_keluar'], -1);
            $angka = $angkaakhir + 1;
        }
        return $awal . $hariini . $angka;
    }
    function tambah($data)
    {
        $this->db->insert('tb_kaskeluar', $data);
    }
    function hapus($kode)
    {
        $this->db->where('kode_kas_keluar', $kode);
        $this->db->delete('tb_kaskeluar');
    }
    function ubah($data, $kode)
    {
        $this->db->where('kode_kas_keluar', $kode);
        $this->db->update('tb_kaskeluar', $data);
    }
}
