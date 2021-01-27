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
    <th>Tgl. Transaksi</th>
    <th>Kode Kas</th>
    <th>Keterangan</th>
    <th>Nominal</th>
 </tr>
</thead>
<tbody>
<?php 
 $lr = 0;
    foreach ($COAD as $COAD ) { ?>
        <tr>
        <td><?= date('d-m-Y', strtotime($COAD['tgl_update'])) ?></td>
        <td><?= $COAD['kodetransaksi'] ?></td>
        <td><?= $COAD['keterangan'] ?></td>
        <td>Rp. <?= number_format($COAD['nominal'], 0, '', '.') ?></td>

        </tr> <?php
        
                $lr = $lr + $COAD['nominal'];
    } ?>
<tr>
    <th colspan="3"> Total Kas Keluar </th>
    <th> <?php echo "Rp. ".number_format($lr) ?> </th>
</tr>
</tbody>
</table>