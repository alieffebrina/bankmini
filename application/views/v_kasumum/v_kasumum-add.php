	

  <div class="main-page">
      <div class="container-fluid bg-white">
          <div class="row page-title-div">
              <div class="col-sm-6">
                  <h2 class="title">Buku Kas Umum</h2>
                  <p class="sub-title">SIMBMS (Sistem Informasi Bank Mini Sekolah)</p>                                    
              </div>
          </div>
              <div class="panel">                            
                  <div class="panel-body"> 
                    <div class="row">
                        <div class="col-lg-9">
                            <?= $this->session->flashdata('alert'); ?>
                            <div class="alert alert-danger left-icon-alert" id="warning" role="alert" style="display: none;">
                                <strong>Perhatian!</strong> Saldo Tidak Cukup.
                            </div>
                            <div class="alert alert-danger left-icon-alert" id="inputKosong" role="alert" style="display: none;">
                                <strong>Perhatian!</strong> Inputan anda kosong.
                            </div>
                        </div>
                    </div>
                    <div class="row">                                      
                      <div class="col-md-6 col-md-6 col-sm-12">
                          <form method="post" action="<?= base_url('KasUmum/add_process')  ?>">   
                            <div class="form-group">
                                <label for="exampleInputEmail5" style="font-size: 15px;">Transaksi*</label>
                                <select class="form-control" required name="id_jenistransaksi" id="id_jenistransaksi">
                                      <option value="salah">- Pilih - </option>
                                    <?php foreach ($transaksi as $transaksi) { ?>
                                      <option value="<?php echo $transaksi->id_mastertransaksi.'-'.$transaksi->nama ?>"><?php echo $transaksi->nama ?></option>
                                    <?php } ?>
                                </select>	  
                            </div>                                   
                            <!-- <div class="form-group has-feedback">
                                  <label for="name5" style="font-size: 15px;">Kode Transaksi*</label>
                                  <input type="hidden" name="kode_transaksi" id="kode_transaksi">                                                              		   
                                  <input type="text" class="form-control inpCus" disabled id="kode" style="font-size: 18px; font-weight: 500;">
                              <span class="fa fa-pencil form-control-feedback"></span>
                              <span class="help-block">Kode Transaksi</span>
                          </div> -->

                          <div class="form-group has-feedback">
                              <label for="name5" style="font-size: 15px;">Keterangan*</label>
                              <textarea class="form-control inpt inpCus" id="keterangan" name="keterangan" required style="font-size: 18px; font-weight: 500;" cols="30" rows="3"></textarea>
                              <span class="fa fa-pencil form-control-feedback"></span>
                              <span class="help-block">Masukkan Keterangan</span>
                          </div> 

                          <div class="form-group has-feedback">
                              <a href="<?= base_url('KasUmum/') ?>" class="btn btn-primary btn-labeled"><i class="fa fa-arrow-left"></i>Kembali</a>
                              <button name="action" type="submit" class="btn btn-success btn-labeled btnAdd" value="cetak" disabled>
                                <i class="fa fa-plus"></i> Cetak Dan Simpan
                              </button>
	                            <button name="action" type="submit" class="btn btn-danger btn-labeled" value="simpan">
                                <i class="fa fa-plus"></i> Simpan
                              </button>
                          </div>                                             
                      </div>

                      <div class="col-lg-6 col-md-6 col-sm-12">
                          <div class="cotainer-fluid" style="margin: 0px; padding: 0px;">                          
                              <div class="row">
                                  <div class="col-lg-12 col-md-12 col-sm-12 mt-25">
                                    <div class="form-group has-feedback">
                                        <label for="name5" style="font-size: 15px;">Nominal*</label>
                                        <input type="text" class="form-control nominalsaldoa inpt inpCus" id="nominalsaldoa" style="font-size: 60px; text-align: right; font-weight: 600; height: 80px; background: #f7f774; color: #000;" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required name="no" >
                                        <input type="hidden" name="nominal" id="nominal">                                                
                                        <span class="fa fa-pencil form-control-feedback"></span>                                        
                                    </div>  
                                  </div>
                              </div>                       
                              <div class="row">
                                <div class="col-lg-12 col-md-12 co-sm-12">
                                    <div class="row">
                                      <div class="col-lg-12 col-md-12 sm-12">
                                        <div class="pull-right w-100">
                                          <table class="bg-danger">
                                              <tr style="font-size: 25px;">
                                                <td style="width: 200px;">Sisa Saldo</td>
                                                <td style="width: 2px;">:</td>

                                                <?php 
                                                $saldo = 0;
                                                foreach ($nominal as $nominal) {
                                                  if($nominal['debet'] == 'koperasi'){
                                                    $saldo = $saldo+$nominal['nominal'];
                                                  } else {
                                                    $saldo = $saldo-$nominal['nominal'];                      
                                                  }
                                                } 
                                                ?>
                                                <input type="hidden" value="<?php echo $saldo ?>" name="saldo">
                                                <td id="saldoBox" style="text-align: right;">Rp. <?= number_format($saldo); ?></td>
                                              </tr>
                                          </table>
                                        </div>                        
                                      </div>
                                    </div>
                                </div>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>
              </div>                                
          </form>
          <!-- /.row -->                            
      </div>                    
    </div>
      <!-- /.main-page -->
      <!-- /.right-sidebar -->
  </div>
    <!-- /.content-container -->
</div>
<script>
transaksi = true;
</script>
