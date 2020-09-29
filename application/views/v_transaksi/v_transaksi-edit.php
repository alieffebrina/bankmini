                    <div class="main-page">
                    <input type="hidden" value="edit" id="editTransaksi">
                        <div class="container-fluid bg-white">
                            <div class="row page-title-div">
                                <div class="col-sm-6">
                                    <h2 class="title">Ubah Transaksi</h2>
                                    <p class="sub-title">SIMBMS (Sistem Informasi Bank Mini Sekolah)</p>                                    
                                </div>
                                <!-- /.col-sm-6 -->
                                <!-- <div class="col-sm-6 right-side">
                                    <a class="btn bg-black toggle-code-handle tour-four" role="button">Toggle Code!</a>
                                </div> -->
                                <!-- /.col-sm-6 text-right -->
                            </div>
                                <div class="row panel">                            
                                    <div class="panel-body">
                                        <div class="col-md-12">
                                            <div class="form-group has-feedback">
		                                        <div class="row">
                                                    <div class="col-lg-6">
                                                        <label for="exampleInputPassword5">Pilih Tipe User</label>                                     
                                                        <select class="form-control" name="tipeuser" id="tipeuser">
                                                            <?php foreach ($tipeuser as $tipeuser) { ?>
                                                                <option value="<?=$tipeuser['id_tipeuser'];?>" <?php if($data->tipeuser == $tipeuser['tipeuser']){echo 'selected';} ?>><?= $tipeuser['tipeuser']; ?></option>
                                                            <?php } ?>                                                          
                                                        </select>	                                        
                                                    </div>
                                                    <div class="col-lg-1 mt-25">
                                                        <button class="btn btn-info" id="checkCus">
                                                            Tampilkan Data
                                                        </button>
                                                    </div>	
                                            	</div>
                                            </div>                                               
                                            <!-- <div class="form-group has-feedback">
                                                <label for="name5">Kode Transaksi</label>
                                                <div class="input-group input-group-sm">
                                                <input type="text" class="form-control" name="kodetransaksi" id="kodetransaksi" placeholder="Kode Transaksi" readonly required>
                                                <span class="input-group-btn">
                                                  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalkorwil">
                                                    Tambah
                                                  </button>
                                                </span>
                                            </div> -->
                                                <!-- <input type="text" class="form-control" id="name5" name="deskripsi" required>
                                                <span class="fa fa-pencil form-control-feedback"> Tambah Kode </span> -->
                                                <!-- <span class="help-block">Masukkan Data</span> -->
                                            <!-- </div> -->                   
                                            <div class="form-group has-feedback">
                                                <label for="exampleInputEmail5">Transaksi</label>
                                                <select class="form-control inpt js-states kategori" id="js-states" >
                                                    <option>Pilih Kategori</option>
                                                    <?php foreach ($transaksi as $transaksi) { ?>
                                                        <option value="<?= $transaksi['id_mastertransaksi'];?>" <?php if($data->id_jenistransaksi == $transaksi['id_mastertransaksi']){echo 'selected';} ?>><?= $transaksi['kategori']; ?></option>
                                                    <?php } ?>                                                          
                                                </select>	  
                                            </div>                           
                                            <div class="form-group has-feedback">                     
                                            <form method="post" action="<?= base_url('transaksi/edit_process')  ?>" id="frm">                                                       
                                                <input type="hidden" name="id_transaksi" value="<?= $data->id_transaksi; ?>">                                                             		   
                                                <input type="hidden" name="id_jenistransaksi" id="id_jenistransaksi" value="<?= $data->id_jenistransaksi; ?>">                                                             		   
                                                <input type="hidden" name="usertipe" id="usertipe" value="<?= $data->tipeuser; ?>">     
                                                <?php 
                                                    if($data->tipeuser == 'siswa'){
                                                        echo'<input type="hidden" id="id_customer" value="<?= $data->id_siswa; ?>">';
                                                    }else{
                                                        echo'<input type="hidden" id="id_customer" value="<?= $data->id_anggota; ?>">';
                                                    }
                                                ?>
                                                <label for="exampleInputPassword5">Nama</label>
                                                    <select class="form-control inpt js-states cusName" id="js-states" name="id_customer" disabled required>
                                                        
                                                    </select>
                                                </div>                                                                                                                    
                                                <div class="form-group has-feedback">
                                                    <label for="name5">Kode Transaksi</label>
                                                    <input type="hidden" name="kode_transaksi" id="kode_transaksi" value="<?= $data->kodetransaksi; ?>">                                                              		   
                                                    <input type="text" class="form-control" disabled id="kode" value="<?= $data->kodetransaksi; ?>">
                                                <span class="fa fa-pencil form-control-feedback"></span>
                                                <span class="help-block">Kode Transaksi</span>
                                            </div>
                                            <div class="form-group has-feedback">
                                                <label for="name5">Keterangan</label>
                                                <input type="text" class="form-control inpt" id="keterangan" name="keterangan" value="<?= $data->keterangan; ?>">
                                                <span class="fa fa-pencil form-control-feedback"></span>
                                                <span class="help-block">Masukkan Keterangan</span>
                                            </div>
                                            <div class="form-group has-feedback">
                                                <label for="name5">Nominal</label>
                                                <input type="text" class="form-control nominalInp inpt" id="inputNominal" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required name="no">
                                                <input type="hidden" name="nominal" id="nominal" value="<?= $data->nominal; ?>">                                                
                                                <span class="fa fa-pencil form-control-feedback"></span>
                                                <span class="help-block">Masukkan Nominal</span>
                                            </div>  
                                            <div class="form-group has-feedback">
                                                <a href="<?= base_url('transaksi/') ?>" class="btn btn-primary btn-labeled"><i class="fa fa-arrow-left"></i>Kembali</a>
                                                <button type="Submit" class="btn btn-warning btn-labeled inpt">
                                                     <i class="fa fa-plus"></i> Ubah Transaksi
                                                </button>
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
<div class="modal fade" id="modalkorwil">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tipe User</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Format 1</label>
          <div class="col-sm-9">
            <div class="input-group">
              <div class="input-group-btn">
                <select class="form-control select2" id="kodeformat1" name="format1" class="btn btn-warning dropdown-toggle" onchange="embuh()">
                  <option value=''>Pilih</option>
                  <option value='huruf'>Huruf</option>
                  <option value='tanggal'>Tanggal</option>
                  <option value='no'>No Urut</option>
                </select>

                <input type="text" class="form-control" id="texthuruf1" name="texthuruf" style="visibility:hidden">
              </div>
              <!-- /btn-group -->
            </div>
          </div>
        </div>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Format 2</label>
          <div class="col-sm-9">
            <div class="input-group">
              <div class="input-group-btn">
                <select class="form-control select2" id="format2" name="format2" class="btn btn-warning dropdown-toggle" onchange="embuhb()">
                <option value=''>Pilih</option>
                  <option value='huruf'>Huruf</option>
                  <option value='tanggal'>Tanggal</option>
                  <option value='no'>No Urut</option>
                </select>

                <input type="text" class="form-control" id="texthuruf2" name="texthuruf" style="visibility:hidden">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Format 3</label>
          <div class="col-sm-9">
            <div class="input-group">
              <div class="input-group-btn">
                <select class="form-control select2" id="format3" name="kota" class="btn btn-warning dropdown-toggle"  onchange="embuhc()">
                <option value=''>Pilih</option>
                  <option value='huruf'>Huruf</option>
                  <option value='tanggal'>Tanggal</option>
                  <option value='no'>No Urut</option>
                </select>

                <input type="text" class="form-control" id="texthuruf3" name="texthuruf" style="visibility:hidden">
              </div>
              <!-- /btn-group -->
            </div>
          </div>
        </div>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Penghubung</label>
          <div class="col-sm-9">
            <select class="form-control select2" id="penghubung" name="penghubung" style="width: 100%;" onchange="embuhhub()">
              <option value=''>Pilih</option>
              <option value='-'>-</option>
              <option value='.'>.</option>
              <option value=''>Tanpa Penghubung</option>
            </select>
          </div>
        </div>         
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Kode</label>
          <div class="col-sm-9">
            <div id ="kodefinal"></div>
            <input type="text" class="form-control" id="final" name="final" readonly >
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnsimpankodekorwil">Save changes</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
