<?php
 
//  $kelas = $this->input->get('kelas');

 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=".$kelas."-".date('d-m-Y').".xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>
 <table border="1">
    <tr>
        <th>No</th>
        <th>NIS</th>  
        <th>Nama Lengkap</th>  
        <th>Alamat Lengkap</th>  
        <th>Tempat Lahir</th>  
        <th>Tanggal Lahir</th>  
        <th>Kecamatan</th>  
        <th>Provinsi</th>  
        <th>Kota</th>  
        <th>Jenis Kelamin</th>  
        <th>Kelas</th>  
    </tr>    
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><?= $kelas; ?></td>
    </tr>
</table>
