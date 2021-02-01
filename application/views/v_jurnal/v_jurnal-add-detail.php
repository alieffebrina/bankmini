<div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Detail Jurnal</h2>
                <p class="sub-title">SIMBMS (Sistem Informasi Bank Mini Sekolah)</p>
                <label>
            </div>
        </div>
        <!-- /.row -->
        <div class="row breadcrumb-div">
            <div class="col-sm-6">
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url('/') ?>"><i class="fa fa-home"></i>Home</a></li>
                    <li>Accounting</li>
                    <li class="active">Jurnal</li>
                </ul>
            </div>
            <!-- /.col-sm-6 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    <section class="section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-7">
                    <?= $this->session->flashdata('alert'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h5>Detail Jurnal</h5>
                            </div>
                        </div>
                        <div class="panel-body p-20">
                        <i>( * ) Wajib di Isi</i>
                            <div class="container-fluid">                        
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">  
                                        <div class="container-fluid">                                      
                                    <form method="post" class="form-user" action="<?php echo site_url('Jurnal/add_process')?>">
                                            <div class="row">
                                                 <input type="hidden" value="<?= $id ?>" name="idjurnal" id="idjurnal" class="form-control">
                                                <div class="col-lg-5 col-md-5 col-sm-12 mb-30" style="margin-left: -23px; margin-right: 23px;">
                                                    <label for="">Pilih COA*</label> 
                                                    <select class='form-control mb-10' id="kodeCOA" name="kodeCOA" required>
                                                            <option value="salah">Pilih Kode COA</option>
                                                            <?php for($no = 1; $no < 8; $no++){
                                                             $query = $this->db->query('select * from tb_mastercoa where kode_coa LIKE "'.$no.'%"')->result_array();
                                                             foreach ($query as $row) { ?>
                                                                <option data-id="<?= $row['kode_coa']; ?>" value="<?= $row['id_coa']; ?>"><?= $row['kode_coa']; ?> - <?= $row['akun']; ?></option>
                                                            <?php } }?>
                                                        </select> 
                                                </div>
                                                <div class="form-group col-lg-7 col-md-7 col-sm-12 mb-30" style="margin-left: -23px; margin-right: 23px;">
                                                        <label for="">Keterangan</label>
                                                        <input type="text" placeholder="Keterangan" name="ketdetail" id="ketdetail" class="form-control">                    
                                                </div>
                                            </div>  
                                            <div class="row">
                                                <div class="form-group col-lg-12 col-md-12 col-sm-12" style="margin-left: -23px; margin-right: 23px;">
                                                    <label for="">Cari Transaksi*</label>   
                                                    <select class="form-control js-states transaksiField" name="transaksi" id="js-states">
                                                        <option value="" selected="selected">Pilih Transaksi</option>
                                                        <?php foreach ($transaksi as $transaksi) { 
                                                            if($transaksi['tipeuser'] == 'siswa'){
                                                                    $user = $this->db->query('SELECT * FROM tb_siswa JOIN tb_kelas on tb_kelas.id_kelas = tb_siswa.id_kelas where nis = '.$transaksi['id_siswa'])->result_array();
                                                                    foreach ($user as $user) {
                                                                       $namauser = $user['namasiswa'].'-'.$user['kelas'];
                                                                    }
                                                                } else if($transaksi['tipeuser'] == 'staf') {
                                                                    $user = $this->db->query('SELECT * FROM tb_staf where id_staf = '.$transaksi['id_anggota'])->result_array();
                                                                    foreach ($user as $user) {
                                                                       $namauser = $user['nama'];
                                                                    }
                                                                } else {
                                                                    $namauser = '';
                                                                }
                                                            ?>
                                                            <option tipe="transaksi" keterangan="<?php echo $transaksi['keterangan'] ?>" kredit="<?php echo $transaksi['kredit'] ?>" debet="<?php echo $transaksi['debet'] ?>" nominal="<?php echo $transaksi['nominal'] ?>" value="<?php echo $transaksi['id_transaksi'] ?>"><?php echo date('d-m-Y', strtotime($transaksi['tgl_update'])) ?>, <?php echo $transaksi['namatransaksi'] ?> <b><?php echo $transaksi['keterangan'].','.$namauser ?> </b></option>
                                                        <!-- <option value="<?php echo $transaksi['id_transaksi'] ?>"><?php echo $transaksi['kodetransaksi'].'-'.$transaksi['keterangan'] ?></option> -->
                                                        <?php } ?>
                                                    </select>                                               
                                                </div>
                                            </div>                                            
                                                <div class="row">
                                                    <div class="form-group col-lg-5 col-md-5 col-sm-12" style="margin-left: -23px; margin-right: 23px;">
                                                        <label for="">Nominal</label>
                                                        <input type="text" class="form-control nominalJurnal" id="inputNominal" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required name="no">
                                                    <input type="hidden" name="nominal" id="nominal">
                                                    <input type="hidden" name="tipejurnal" id="tipejurnal" class="tipejurnal" value="">
                                                        <!-- <input type="text" placeholder="Nominal" id="nominal" name="nominal" class="form-control nominalJurnal"> -->
                                                    </div>
                                                    <div class="form-group col-lg-2 col-md-2 col-sm-2 radioOne" style="margin-left: -23px; margin-right: 23px;">
                                                        <label for="one">Debet</label>
                                                        <input type="radio" id="one" class="blue-style" name="jenis" value="debet">
                                                    </div>
                                                    <div class="form-group col-lg-2 col-md-2 col-sm-2 radioTwo" style="margin-left: -23px;">
                                                        <label for="two">Kredit</label>
                                                        <input type="radio" id="two" class="blue-style" name="jenis" value="kredit">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12" style="margin-left: -23px;">
                                                        <a href="<?= base_url('Jurnal') ?>" class="btn btn-warning"> Kembali</a>
                                                        <button class="btn btn-primary btnsubmit" id="btnsubmit">
                                                            Generate
                                                        </button>
                                                    </div>
                                                </div>
                                            <!-- </form> -->
                                        </div>
                                    </div>
                                </div>
                            </form>
                                <div class="row mt-20">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <table class="display table table-striped table-bordered" cellspacing="0" width="100%" id="tabelku">
                                            <thead>
                                                <tr>
                                                    <th>Kode COA</th>                                                  
                                                    <th>Keterangan</th>                             
                                                    <th>Transaksi</th>                          
                                                    <th>Debet</th>                                                   
                                                    <th>Kredit</th>                                                   
                                                    <th>Action</th>                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if($total_detail > 0){
                                                    foreach ($detail as $detail) {
                                                        if($detail['transaksi']!='0'){
                                                            $cek = $this->db->query('SELECT * FROM tb_transaksi where id_transaksi = '.$detail['transaksi'])->result_array();

                                                            foreach ($cek as $cek) {
                                                                if($cek['id_siswa'] != NULL){
                                                                    $user = $this->db->query('SELECT * FROM tb_siswa JOIN tb_kelas on tb_kelas.id_kelas = tb_siswa.id_kelas where nis = '.$cek['id_siswa'])->result_array();
                                                                    foreach ($user as $user) {
                                                                       $namauser = $user['namasiswa'].'-'.$user['kelas'];
                                                                    }
                                                                } else if($cek['id_siswa'] != NULL){
                                                                    $user = $this->db->query('SELECT * FROM tb_staf where id_staf = '.$cek['id_anggota'])->result_array();
                                                                    foreach ($user as $user) {
                                                                       $namauser = $user['nama'];
                                                                    }
                                                                } else {
                                                                    $namauser = '';
                                                                }
                                                                
                                                                $cektr = $cek['keterangan'];
                                                                $kodetransaksi = $cek['kodetransaksi'];
                                                            }
                                                        } else {
                                                            $cektr = '';
                                                                $kodetransaksi = '';
                                                        }
                                                    echo "<tr>";
                                                    echo "<td>".$detail['kode_coa']."-".$detail['akun']."</td>";
                                                    echo "<td>".$detail['ket']."</td>";
                                                    if($kodetransaksi == NULL ){
                                                        echo "<td>-</td>";
                                                    } else {
                                                        echo "<td>".$kodetransaksi.' - '.$cektr.'-'.$namauser."</td>";
                                                    }
                                                    if($detail['nominal_debet'] == '0'){ echo "<td>-</td><td>Rp. ".number_format($detail['nominal_kredit'])."</td>"; } else { echo "<td>Rp. ".number_format($detail['nominal_debet'])."</td><td>-</td>"; }; ?>
                                                    <td>
                                                        <div class="btn-group">
                                                        <?php if($akses['delete'] == 1) { ?>
                                                            <a href="<?= base_url('jurnaldet_hps/') . $detail['id_dtljurnal'].'/'.$detail['id_jurnal'].'/'.$detail['transaksi'] ?>" onclick="return confirm('Yakin Hapus Detail Jurnal?')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                        <?php } ?>
                                                        </div>
                                                    </td>
                                                    <?php echo "</tr>";
                                                    } 
                                                    echo "<tr><th colspan=3><center>Total</center> </th>";
                                                    foreach ($totaldet as $totaldet) {
                                                        echo "<th>Rp. ".number_format($totaldet['nominal_debet'])."</th>";
                                                    }
                                                    foreach ($totalkre as $totalkre) {
                                                    echo "<th>Rp. ".number_format($totalkre['nominal_kredit'])."</th>";
                                                    }

                                                    echo "<td></td></tr>";

                                                } else {
                                                    echo "<td colspan='7'><center>kosong</center></td>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.section -->
</div>
<!-- /.main-page -->
<!-- /.right-sidebar -->
</div>
<!-- /.content-container -->
</div>