<div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Kas Umum</h2>
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
                    <li class="active">Kas Umum</li>
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
                                <h5>Kas Umum</h5>
                                <div class="bg-primary pull-right mr-15">
                                    <?php $aaa = $this->db->query("SELECT * FROM tb_historikas WHERE MONTH(tgltransaksi) = " . intval(date('m')) . " ORDER BY id_histori_kas DESC LIMIT 1")->row_array() ?>
                                    <h3 class="ml-5 mt-5 mr-5 mb-5" id="saldo">Saldo = <?= 'Rp. ' . number_format($aaa['saldo']) ?></h3>
                                </div>
                            </div>
                            <!-- <a href="<?= base_url('kas-masuk-add/')  ?>" class="btn btn-primary ml-15">
                            <i class="fa fa-plus text-white"></i>
                            Tambah Kas Umum
                        </a> -->
                            <div class="row">
                                <div class="col-lg-3">
                                    <select id="blnkas" class="form-control ml-15 blnkas">
                                        <!-- <option value="">Pilih Bulan</option> -->
                                        <?php $bulan = array(
                                            array('Januari', '1'),
                                            array('Februari', '2'),
                                            array('Maret', '3'),
                                            array('April', '4'),
                                            array('Mei', '5'),
                                            array('Juni', '6'),
                                            array('Juli', '7'),
                                            array('Agustus', '8'),
                                            array('September', '9'),
                                            array('Oktober', '10'),
                                            array('November', '11'),
                                            array('Desember', '12')
                                        );
                                        var_dump($bulan);
                                        $no = 1;
                                        foreach ($bulan as $bulann) {
                                            if (date('m') == $bulann[1]) { ?>
                                                <option value="<?= $bulann[1] ?>" selected><?= $bulann[0]  ?></option>
                                            <?php } else { ?>
                                                <option value="<?= $bulann[1] ?>"><?= $bulann[0]  ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body p-20">
                            <table class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Tgl. Transaksi</th>
                                        <th>Keterangan</th>
                                        <th>Debet</th>
                                        <th>Kredit</th>
                                        <th>Saldo</th>
                                    </tr>
                                </thead>
                                <tbody id="dataKas">
                                    <?php
                                    foreach ($recap as $data) {
                                        $kode = $data[3];
                                        $ketkode = substr($kode, 0, 2);
                                        $debet = 0;
                                        $kredit = 0;
                                        $saldo = $data[4];
                                        if ($ketkode == 'KK') {
                                            $debet = $data[2];
                                        } else if ($ketkode == 'KM') {
                                            $kredit = $data[2];
                                        }
                                    ?>

                                        <tr>
                                            <td><?= date('d-m-Y', strtotime($data[0])) ?></td>
                                            <td><?= $data[1] ?> </td>
                                            <td><?= 'Rp. ' . number_format($debet) ?></td>
                                            <td><?= 'Rp. ' . number_format($kredit) ?></td>
                                            <td><?= 'Rp. ' . number_format($saldo) ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
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