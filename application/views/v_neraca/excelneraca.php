<?php 

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=$title.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<table border="1" width="100%">
<thead>
<tr>
	<th colspan="4"><?= $title; ?></th>
</tr>
<tr>
    <th>Tanggal awal</th>
    <th><?= $tglawal ?> </th>
    <th></th>
    <th></th>
 </tr>
 <tr>
    <th>Tanggal Akhir</th>
    <th><?= $tglakhir ?> </th>
    <th></th>
    <th></th>
</tr>
<tr>
    <th>No. Akun</th>
    <th>Perubahan / Akun </th>
    <th>Debet</th>
    <th>Kredit</th> 
 </tr>
</thead>
<tbody>
<?php foreach ($COAD as $COAD) { ?>
    <tr>
        <td><?= $COAD['kode_coa'] ?></td>
        <td><?= $COAD['akun'] ?></td>
        <?php 
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
        ?>
        <td><?php echo "Rp. ".number_format($nominal); ?></td>
        <td><?php echo "Rp. 0 "; ?></td>
    </tr>
<?php } ?>
<?php foreach ($COAK as $COAK) { ?>
    <tr>
        <td><?= $COAK['kode_coa'] ?></td>
        <td><?= $COAK['akun'] ?></td>
        <?php 
        $this->db->select_sum('nominal_debet');
        $this->db->select_sum('nominal_kredit');
        $this->db->join('tb_jurnal', 'tb_jurnal.id_jurnal = tb_detailjurnal.id_jurnal');
        $this->db->where('id_coa', $COAK['id_coa']);
        $this->db->where('DATE(tgl_update) >=', date('Y-m-d',strtotime($tglawal)));
        $this->db->where('DATE(tgl_update) <=', date('Y-m-d',strtotime($tglakhir)));
        $query = $this->db->get('tb_detailjurnal')->result_array();
        foreach ($query as $query) {
            $nominald = $query['nominal_debet'];
            $nominalk = $query['nominal_kredit'];
            $nominal = $nominald - $nominalk; 
        } 
        ?>
        <td><?php echo "Rp. 0 "; ?></td>
        <td><?php echo "Rp. 0"; ?></td>
    </tr>
<?php } ?>
</tbody>
</table>