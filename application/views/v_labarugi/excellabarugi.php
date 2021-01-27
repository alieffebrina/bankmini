<?php 

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=$title.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<table border="1" width="100%">
<thead>
<tr>
	<th colspan="3"><?= $title; ?></th>
</tr>
<tr>
    <th>Tanggal awal</th>
    <th><?= $tglawal ?> </th>
    <th></th>
 </tr>
 <tr>
    <th>Tanggal Akhir</th>
    <th><?= $tglakhir ?> </th>
    <th></th>
</tr>
<tr>
     <th>No. Akun</th>
    <th>Perubahan / Akun </th>
    <th>Saldo</th>
 </tr>
</thead>
<tbody>
<?php 
    $lr = 0;
    foreach ($COAD as $COAD) { ?>
    <tr>
        <td><?= $COAD['kode_coa'] ?></td>
        <td><?= $COAD['akun'] ?></td>
        <?php 
        $this->db->select_sum('nominal_debet');
        $this->db->select_sum('nominal_kredit');
        $this->db->where('id_coa', $COAD['id_coa']);
        $query = $this->db->get('tb_detailjurnal')->result_array();
        foreach ($query as $query) {
            $nominald = $query['nominal_debet'];
            $nominalk = $query['nominal_kredit'];
            $nominal = $nominald - $nominalk; 
        } 
        ?>
        <td><?php echo "Rp. ".number_format($nominal); ?></td>
    </tr>
<?php 
    $lr = $lr+$nominal;
    } ?>
<tr>
    <th colspan="2"> Laba Rugi Bersih </th>
    <th> <?php echo "Rp. ".number_format($lr) ?> </th>
</tr>
</tbody>
</table>