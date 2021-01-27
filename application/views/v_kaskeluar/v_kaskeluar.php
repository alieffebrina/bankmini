<div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Kas keluar</h2>
                <p class="sub-title">SIMBMS (Sistem Informasi Bank Mini Sekolah)</p>
            </div>
            <!-- /.col-sm-6 -->
            <!-- <div class="col-sm-6 right-side">
                <a class="btn bg-black toggle-code-handle tour-four" role="button">Toggle Code!</a>
            </div> -->
            <!-- /.col-sm-6 text-right -->
        </div>
        <!-- /.row -->
        <div class="row breadcrumb-div">
            <div class="col-sm-6">
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url('/') ?>"><i class="fa fa-home"></i>Home</a></li>
                    <li>Accounting</li>
                    <li class="active">Kas keluar</li>
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
                    <div class="row">
                        <div class="col-lg-9">
                            <?= $this->session->flashdata('message'); ?>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h5>Kas Keluar</h5>
                         <a href="<?= base_url('KasKeluar/pdf')?> " class="btn btn-info">Cetak</a>
                         <a href="<?= base_url('KasKeluar/excel')?> " class="btn btn-info">Excel</a>
                            </div>
                            
                        </div>
                        <div class="panel-body p-20">
                            <table id="dataTableSiswa" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Kode Kas keluar</th>
                                        <th>Keterangan</th>
                                        <th>Nominal</th>
                                        <th>Tgl. Transaksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $kas = 0; 
                                    foreach ($kk as $data) : ?>
                                        <tr>
                                            <td><?= $data['kodetransaksi'] ?></td>
                                            <td><?= $data['keterangan'] ?></td>
                                            <td>Rp. <?= number_format($data['nominal']) ?></td>
                                            <td><?= date('d-m-Y', strtotime($data['tgl_update'])) ?></td>
                                        </tr>
                                    <?php 
                                    $kas = $kas + $data['nominal'];
                                    endforeach; ?>

                                </tbody>
                                <tfoot class="tfoot">
                                    <tr>
                                        <th style="text-align: right;" align="right" colspan="2">Total Kas Keluar : </th>
                                        <th colspan="2">Rp. <?= number_format($kas, 0, '', '.') ?></th>
                                    </tr>        
                                </tfoot>
                            </table>
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