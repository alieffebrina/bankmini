<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class M_KasMasuk extends CI_Model
{
    function getAll()
    {
        $query = $this->db->get('tb_kasmasuk');
        return $query->result_array();
    }

    function getById($kode)
    {
        return $this->db->get_where('tb_kasmasuk', ['kode_kas_masuk' => $kode])->row_array();
    }

    function kasMasuk()
    {
        $awal = 'KM';
        $hariini = date('Ymd');
        $tglawal = date('Y-m-d', strtotime('first day of this month'));
        $terakhire = $this->db->query("SELECT kode_kas_masuk FROM tb_kasmasuk ORDER BY tgltransaksi DESC LIMIT 1")->row_array();
        if (date('d') == $tglawal || $terakhire == null) {
            $angka = 1;
        } else {
            $angkaakhir = substr($terakhire['kode_kas_masuk'], -1);
            $angka = $angkaakhir + 1;
        }
        return $awal . $hariini . $angka;
    }
    function tambah($data)
    {
        $this->db->insert('tb_kasmasuk', $data);
    }

    function hapus($kode)
    {
        $this->db->where('kode_kas_masuk', $kode);
        $this->db->delete('tb_kasmasuk');
    }
    function ubah($data, $kode)
    {
        $this->db->where('kode_kas_masuk', $kode);
        $this->db->update('tb_kasmasuk', $data);
    }
}
