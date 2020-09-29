<div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Jurnal</h2>
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
                                <h5>Jurnal</h5>
                            </div>
                        </div>
                        <div class="panel-body p-20">
                            <div class="container-fluid">                        

                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-12" style="margin-left: -23px;">
                                                    <label for="">Pilih Transaksi</label>	
                                                    <select class="form-control" id="jurnalTs">
                                                        <option value="">Pilih</option>
                                                        <option value="transaksi">Transaksi</option>
                                                        <option value="kas keluar">Kas keluar</option>
                                                        <option value="kas masuk">Kas masuk</option>    
                                                    </select>
                                                </div>
                                                <div class="form-group col-lg-7 col-md-7 col-sm-12">
                                                    <label for="">Cari Transaksi</label>	
                                                    <select class="form-control js-states transaksiField" disabled id="js-states">
                                                        <option value="">Pilih Nama</option>
                                                    </select>                                               
                                                </div>
                                            </div>                                            
                                            <form action="<?= base_url('jurnal/add_process') ?>" method="post">                                           
                                                <div class="row">
                                                    <div class="form-group col-lg-4 col-md-4 col-sm-12" style="margin-left: -23px;">
                                                        <label for="">Nominal</label>
                                                        <input type="text" placeholder="Nominal" name="nominal" class="form-control">
                                                    </div>
                                                    <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                                        <label for="">Debet</label>
                                                        <input type="radio" name="jenis" value="debet">
                                                    </div>
                                                    <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                                        <label for="">Kredit</label>
                                                        <input type="radio" name="jenis" value="kredit">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12" style="margin-left: -23px;">
                                                        <button class="btn btn-primary">
                                                            Generate
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-20">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <table id="dataTableSiswa" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Kode COA</th>                                                   
                                                    <th>Keterangan</th>                                                   
                                                    <th>Debet</th>                                                   
                                                    <th>Kredit</th>                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($jurnal as $row): ?>
                                                    <tr>
                                                        <td>
                                                            <?= $row['kode_coa_debet']; ?>
                                                            <?= $row['kode_coa_kredit']; ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
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