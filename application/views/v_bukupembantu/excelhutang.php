<?php 

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=$title.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<table border="1" width="100%">
<thead>
<tr>
	<th colspan="5"><?= $title; ?></th>
</tr>
<tr>
    <th>Tanggal Transaksi</th>
    <th>Keterangan</th>
    <th>Debet</th>
    <th>Kredit</th>
    <th>Saldo</th>
 </tr>
</thead>
<tbody>
<?php 
 $lr = 0;
    foreach ($COAD as $COAD ) { ?>
        <tr>
        <td><?= date('d-m-Y', strtotime($COAD['tgl_update'])) ?></td>
        <td><?=  $COAD['kodetransaksi'].' - '.$COAD['keterangan'] ?></td>
        <?php if($COAD['debet'] != 'koperasi') { 
            $lr = $lr - $COAD['nominal']; ?>
        <td>Rp. <?= number_format($COAD['nominal'], 0, '', '.') ?></td>
        <td>Rp. 0</td>
        <td>Rp. <?= number_format($lr, 0, '', '.') ?></td>
        <?php } else {             
            $lr = $lr + $COAD['nominal']; ?>
        <td>Rp. 0</td>
        <td>Rp. <?= number_format($COAD['nominal'], 0, '', '.') ?></td>
        <td>Rp. <?= number_format($lr, 0, '', '.') ?></td>
         <?php } ?>
        </tr> <?php
    } ?>
<tr>
    <th colspan="4"> Total Saldo </th>
    <th> <?php echo "Rp. ".number_format($lr) ?> </th>
</tr>
</tbody>
</table>