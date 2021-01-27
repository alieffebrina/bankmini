<div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Transaksi Kas</h2>
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
                    <li class="active">Transaksi Kas</li>
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
                                <h5>Kas Umum</h5>

                         <a href="<?= base_url('KasUmum/pdf')?> " class="btn btn-info">Cetak</a>
                         <a href="<?= base_url('KasUmum/excel')?> " class="btn btn-info">Excel</a>
                            </div>
                        </div>
                        <div class="panel-body p-20">
                            <table id="dataTableSiswa" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Kode Kas</th>
                                        <th>Keterangan</th>
                                        <th>Nominal</th>
                                        <th>Tgl. Transaksi</th>
                                        <th>Aksi</th>
                                        <!-- <th>Status Jurnal</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $lr = 0;
                                    foreach ($transaksi as $data) :
                                        
                                        ?>
                                        <tr>
                                            <td><?= $data['kodetransaksi'] ?></td>
                                            <td><?= $data['keterangan'] ?></td>
                                            <td>Rp. <?= number_format($data['nominal'], 0, '', '.') ?></td>
                                            <td><?= date('d-m-Y', strtotime($data['tgl_update'])) ?></td>
                                            <td>
                                                <center>
                                                    <?php if ($akses['delete'] == 1) { ?>
                                                        <a href="<?php echo site_url('KasUmum/transaksi_delete/'.$data['id_transaksi']); ?>"  class="btn btn-xs btn-danger" onclick="return confirm('Yakin untuk menghapus?')" >
                                                        <!-- <a href="<?= site_url('KasUmum/transaksi_delete') . $data['id_transaksi'];  ?>" class="btn btn-xs btn-danger" onclick="return confirm('Yakin untuk menghapus?')"> -->
                                                            <i class="fa fa-trash"></i></a>
                                                    <?php } ?>
                                                </center>
                                            </td>
                                        </tr>
                                    <?php 
                                     $cek = $this->db->get_where('tb_mastertransaksi', ['id_mastertransaksi' => $data['id_jenistransaksi']])->result_array();
                                     foreach ($cek as $cek ) {
                                        if($cek['debet'] == 'koperasi'){
                                            $lr = $lr + $data['nominal'];
                                        } else {
                                             $lr = $lr - $data['nominal'];
                                        }
                                    }
                                    
                                    endforeach; ?>

                                </tbody>

                                <tfoot class="tfoot">
                                    <tr>
                                        <th style="text-align: right;" align="right" colspan="2">Sisa Saldo : </th>
                                        <th colspan="3">Rp. <?= number_format($lr, 0, '', '.') ?></th>
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