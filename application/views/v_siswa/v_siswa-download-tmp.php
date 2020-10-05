<?php
 
//  $kelas = $this->input->get('kelas');

 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=".$kelas."-".date('d-m-Y').".xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>
 <table border="1">
    <tr>
<<<<<<< HEAD
    <th colspan="7">
            <center>
                Data Siswa Kelas <?= $kelas; ?>
            </center>
        </th>
    </tr>
    <tr>
        <th colspan="7">
            <center>
                SMA NEGERI 1 WRINGIN ANOM
            </center>
        </th>
    </tr>
    <tr>
        <th colspan="7">
        
        </th>
    </tr>
    <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>    
    </tr>
    <tr>
        <th>No</th>
        <th>NIS</th>  
        <th>Nama Lengkap</th>  
        <th>Jenis Kelamin</th>  
        <th>Kelas</th>  
        <th>Tempat,Tanggal Lahir</th>          
        <th>Alamat Lengkap</th>  
=======
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
>>>>>>> 2b276a39f6b2545f1a3f9dd926dfa4ad9f163cbc
    </tr>    
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
<<<<<<< HEAD
        <td><?= $kelas; ?></td>
        <td></td>
        <td></td>
    </tr>
</table>
=======
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><?= $kelas; ?></td>
    </tr>
</table>
>>>>>>> 2b276a39f6b2545f1a3f9dd926dfa4ad9f163cbc
