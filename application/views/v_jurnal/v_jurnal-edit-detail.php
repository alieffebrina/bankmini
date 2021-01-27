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
                                    <form method="post" class="form-user" action="<?php echo site_url('Jurnal/edit_process')?>">
                                        <?php foreach ($editdet as $editdet) { ?>
                                            <div class="row">
                                                 <input type="hidden" value="<?= $id ?>" name="idjurnal" id="idjurnal" class="form-control">
                                                 <input type="hidden" name="iddtljurnal" value="<?php echo $editdet['id_dtljurnal'] ?>">
                                                <div class="col-lg-5 col-md-5 col-sm-12 mb-30" style="margin-left: -23px; margin-right: 23px;">
                                                    <label for="">Pilih COA*</label> 
                                                    <select class='form-control mb-10' id="kodeCOA" name="kodeCOA">
                                                        <?php foreach($coa as $row): ?>
                                                            <option data-id="<?= $row['kode_coa']; ?>" value="<?= $row['id_coa']; ?>" <?php if($editdet['id_coa'] == $row['id_coa']) {  echo "selected"; } ?> ><?= $row['kode_coa']; ?> - <?= $row['akun']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select> 
                                                </div>
                                                <div class="form-group col-lg-7 col-md-7 col-sm-12 mb-30" style="margin-left: -23px; margin-right: 23px;">
                                                        <label for="">Keterangan</label>
                                                        <input type="text" placeholder="Keterangan" name="ketdetail" id="ketdetail" value="<?php echo $editdet['ket'] ?>" class="form-control"> 
                                                        <input type="hidden" name="tipeawal" id="tipeawal" value="<?php echo $editdet['tipe_transaksi'] ?>" class="form-control">     
                                                        <input type="hidden" name="tsawal" id="tsawal" value="<?php echo $editdet['transaksi'] ?>" class="form-control">              
                                                </div>
                                            </div>  
                                            <div class="row">
                                                <div class="col-lg-5 col-md-5 col-sm-12 mb-30" style="margin-left: -23px; margin-right: 23px;">
                                                    <label for="">Pilih Tipe Transaksi*</label> 
                                                    <select class="form-control js-states" id="jurnalTs" name="jurnalTs">
                                                        <option value="transaksi" <?php if($editdet['tipe_transaksi'] == 'transaksi'){ echo "selected"; } ?> >Transaksi</option>
                                                        <option value="kaskeluar" <?php if($editdet['tipe_transaksi'] == 'kaskeluar'){ echo "selected"; } ?> >Kas keluar</option>
                                                        <option value="kasmasuk" <?php if($editdet['tipe_transaksi'] == 'kasmasuk'){ echo "selected"; } ?> >Kas masuk</option>
                                                        <option value="" <?php if($editdet['tipe_transaksi'] == NULL){ echo "selected"; } ?> >-</option>    
                                                    </select>
                                                </div>
                                                <div class="form-group col-lg-7 col-md-7 col-sm-12 mb-30" style="margin-left: -23px; margin-right: 23px;">
                                                    <label for="">Cari Transaksi*</label>   
                                                    <select class="form-control js-states transaksiField" disabled name="transaksi" id="js-states">
                                                        <?php if($editdet['tipe_transaksi'] == 'transaksi'){
                                                            $database = 'tb_transaksi';
                                                            $idtr = 'id_transaksi';
                                                            $kodetr = 'kodetransaksi';
                                                        } elseif($editdet['tipe_transaksi'] == 'kaskeluar') {
                                                            $database = 'tb_kaskeluar';
                                                            $idtr = 'id_kk';
                                                            $kodetr = 'kode_kas_keluar';
                                                        } elseif($editdet['tipe_transaksi'] == 'kasmasuk') {
                                                            $editdet = 'tb_kasmasuk';
                                                            $idtr = 'id_km';
                                                            $kodetr = 'kode_kas_masuk';
                                                        } else {

                                                            $cektr = NULL;
                                                            $kodetransaksi = NULL;
                                                        }

                                                    if($editdet['tipe_transaksi'] != NULL){
                                                         $cekdet = $this->db->query('SELECT * FROM '.$database.' where '.$idtr.' = '.$editdet['transaksi'])->result_array();

                                                    foreach ($cekdet as $cekdet) {
                                                        $cektr = $cekdet['keterangan'];
                                                        $kodetransaksi = $cekdet[$kodetr];

                                                        ?>
                                                         <option value="<?php echo $cekdet[$idtr]; ?>" selected="selected"><?php echo $cekdet[$idtr].'-'.$cekdet[$kodetr].' - '.$cekdet['keterangan']; ?></option>
                                                        <?php } 
                                                    } else { ?>
                                                        <option value="" selected="selected">Pilih Transaksi</option>
                                                    <?php } ?>
                                                    </select>                                               
                                                </div>
                                            </div>                                            
                                                <div class="row">
                                                    <div class="form-group col-lg-5 col-md-5 col-sm-12" style="margin-left: -23px; margin-right: 23px;">
                                                        <label for="">Nominal</label>
                                                        <input type="text" class="form-control nominalJurnal" id="inputNominal" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required name="no" value="Rp. <?php if($editdet['nominal_debet'] != NULL){ echo number_format($editdet['nominal_debet']); } else { echo number_format($editdet['nominal_kredit']); } ?>">
                                                    <input type="hidden" name="nominal" id="nominal">
                                                    <input type="hidden" name="tipejurnal" id="tipejurnal" class="tipejurnal" value="<?php if($editdet['nominal_debet'] != '0'){ echo "debet"; } else { echo "kredit"; } ?>">
                                                        <!-- <input type="text" placeholder="Nominal" id="nominal" name="nominal" class="form-control nominalJurnal"> -->
                                                    </div>
                                                    <div class="form-group col-lg-2 col-md-2 col-sm-2 radioOne" style="margin-left: -23px; margin-right: 23px;">
                                                        <label for="one">Debet</label>
                                                        <input type="radio" id="one" class="blue-style" name="jenis" value="debet" <?php if($editdet['nominal_debet'] != '0'){ echo "checked"; } ?> >
                                                    </div>
                                                    <div class="form-group col-lg-2 col-md-2 col-sm-2 radioTwo" style="margin-left: -23px;">
                                                        <label for="two">Kredit</label>
                                                        <input type="radio" id="two" class="blue-style" name="jenis" value="kredit"  <?php if($editdet['nominal_kredit'] != '0'){ echo "checked"; } ?>>
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
                            <?php } ?>
                            </form>
                                <div class="row mt-20">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <table class="display table table-striped table-bordered" cellspacing="0" width="100%" id="tabelku">
                                            <thead>
                                                <tr>
                                                    <th>Kode COA</th>                                                  
                                                    <th>Keterangan</th>                        
                                                    <th>Jenis Transaksi</th>                       
                                                    <th>Transaksi</th>                          
                                                    <th>Debet</th>                                                   
                                                    <th>Kredit</th>                                                   
                                                    <th>Action</th>                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if($total_detail > 0){
                                                    foreach ($detail as $detail) {
                                                        if($detail['tipe_transaksi'] == 'transaksi'){
                                                            $database = 'tb_transaksi';
                                                            $idtr = 'id_transaksi';
                                                            $kodetr = 'kodetransaksi';
                                                        } elseif($detail['tipe_transaksi'] == 'kaskeluar') {
                                                            $database = 'tb_kaskeluar';
                                                            $idtr = 'id_kk';
                                                            $kodetr = 'kode_kas_keluar';
                                                        } elseif($detail['tipe_transaksi'] == 'kasmasuk') {
                                                            $database = 'tb_kasmasuk';
                                                            $idtr = 'id_km';
                                                            $kodetr = 'kode_kas_masuk';
                                                        } else {
                                                            $kodetransaksi = '-';
                                                             $cektr = NULL;
                                                        }
                                                    if($detail['tipe_transaksi']!=NULL){
                                                        $cek = $this->db->query('SELECT * FROM '.$database.' where '.$idtr.' = '.$detail['transaksi'])->result_array();

                                                        foreach ($cek as $cek) {
                                                            $cektr = $cek['keterangan'];
                                                            $kodetransaksi = $cek[$kodetr];
                                                        }
                                                    }
                                                    

                                                    echo "<tr>";
                                                    echo "<td>".$detail['kode_coa']."-".$detail['akun']."</td>";
                                                    echo "<td>".$detail['ket']."</td>";
                                                    echo "<td>".$detail['tipe_transaksi']."</td>";
                                                    echo "<td>".$kodetransaksi.' - '.$cektr."</td>";
                                                    if($detail['nominal_debet'] == '0'){ echo "<td>-</td><td>Rp. ".number_format($detail['nominal_kredit'])."</td>"; } else { echo "<td>Rp. ".number_format($detail['nominal_debet'])."</td><td>-</td>"; }; ?>
                                                    <td>
                                                        <div class="btn-group">
                                                        <?php if($akses['edit'] == 1) { ?>
                                                            <a href="<?= base_url('jurnaldet-edit/') . $detail['id_jurnal'].'/'.$detail['id_dtljurnal'] ?>" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                                                        <?php } ?>
                                                        <?php if($akses['delete'] == 1) { 
                                                            if($detail['tipe_transaksi'] != NULL){ ?>
                                                            <a href="<?= base_url('jurnaldet_hps/') . $detail['id_dtljurnal'].'/'.$detail['id_jurnal'].'/'.$detail['tipe_transaksi'].'/'.$detail['transaksi'] ?>" onclick="return confirm('Yakin Hapus Detail Jurnal?')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                            <?php } else { ?>
                                                                <a href="<?= base_url('jurnaldet_hapus/') . $detail['id_dtljurnal'].'/'.$detail['id_jurnal'] ?>" onclick="return confirm('Yakin Hapus Detail Jurnal?')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                            
                                                        <?php }
                                                    } ?>
                                                        </div>
                                                    </td>
                                                    <?php echo "</tr>";
                                                    } 
                                                    echo "<tr><th colspan=4><center>Total</center> </th>";
                                                    foreach ($totaldet as $totaldet) {
                                                        echo "<th>Rp. ".number_format($totaldet['nominal_debet'])."</th>";
                                                    }
                                                    foreach ($totalkre as $totalkre) {
                                                    echo "<th>Rp. ".number_format($totalkre['nominal_kredit'])."</th>";
                                                    }
                                                    echo "</tr>";

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