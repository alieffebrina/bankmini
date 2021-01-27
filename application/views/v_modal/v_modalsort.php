
<div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Laporan Perubahan Modal</h2>
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
                    <li class="active">Perubahan Modal</li>
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
                        <div class="panel-heading mt-10 ml-20">
                            <div class="row">
                                <div class="col-md-10">
                                    <table>
                                        <form action="<?= base_url('Modal/sort') ?>" method="POST">
                                        <tr>
                                            <td>Tanggal Awal </td>
                                            <td ><input type="date" class="form-control" id="tglawall" name="tglawall" value="<?= $tglawal ?>"></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Akhir </td>
                                            <td><input type="date" class="form-control" id="tglakhiree" name="tglakhiree" value="<?= $tglakhir ?>"></td>
                                            <td colspan="2" align="left"><button class="btn btn-success" name="btnCaridata"><i class="fa fa-search"></i>Cari</button></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <button class="btn btn-success" name="lporanhri">Laporan Hari Ini</button>
                                                <button class="btn btn-success" name="lporanbln">laporan Bulanan Ini</button>
                                                <button class="btn btn-success" name="lporanthn">Laporan Tahunan Ini</button> 
                                                <button class="btn btn-success" name="excel">Excel</button> 
                                                <button class="btn btn-success" name="cetak">PDF</button> 
                                            </td>
                                        </tr>
                                        </form>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body p-20">
                            <table id="dataTableKasUmum" class="table table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No. Akun</th>
                                        <th>Perubahan / Akun </th>
                                        <th>Saldo</th>
                                    </tr>
                                </thead>
                                <tbody id="dataKas">
                                    <tr>
                                        <th colspan="3">Modal</th>
                                    </tr>
                                    <?php 
                                        $modal = 0;
                                        foreach ($COAD as $COAD) { ?>
                                        <tr>
                                            <td><?= $COAD['kode_coa'] ?></td>
                                            <td><?= $COAD['akun'] ?></td>
                                            <?php 
                                            $this->db->select_sum('nominal_debet');
                                            $this->db->select_sum('nominal_kredit');
                                            $this->db->join('tb_jurnal', 'tb_jurnal.id_jurnal = tb_detailjurnal.id_jurnal');
                                            $this->db->where('id_coa', $COAD['id_coa']);
                                            $this->db->where('DATE(tgl_update) >=', date('Y-m-d',strtotime($tglawal)));
                                            $this->db->where('DATE(tgl_update) <=', date('Y-m-d',strtotime($tglakhir)));
                                            $query = $this->db->get('tb_detailjurnal')->result_array();
                                            foreach ($query as $query) {
                                                $nominald = $query['nominal_debet'];
                                                $nominalk = $query['nominal_kredit'];
                                                $nominal = $nominald - $nominalk; 
                                                $modal = $modal + $nominal;
                                            } 
                                            ?>
                                            <td><?php echo "Rp. ".number_format($nominal); ?></td>
                                        </tr>                                        
                                    <?php } ?>
                                    <?php 
                                        $lr = 0;
                                        foreach ($COALR as $COALR) { 
                                            $this->db->select_sum('nominal_debet');
                                            $this->db->select_sum('nominal_kredit');
                                            $this->db->join('tb_jurnal', 'tb_jurnal.id_jurnal = tb_detailjurnal.id_jurnal');
                                            $this->db->where('id_coa', $COALR['id_coa']);
                                            $this->db->where('DATE(tgl_update) >=', date('Y-m-d',strtotime($tglawal)));
                                            $this->db->where('DATE(tgl_update) <=', date('Y-m-d',strtotime($tglakhir)));
                                            $query = $this->db->get('tb_detailjurnal')->result_array();
                                            foreach ($query as $query) {
                                                $nominald = $query['nominal_debet'];
                                                $nominalk = $query['nominal_kredit'];
                                                $nominal = $nominald - $nominalk; 
                                                $lr = $lr + $nominal;
                                            } 
                                            ?>
                                    <?php } ?>
                                        <tr>
                                            <td colspan="2">Laba / Rugi</td>
                                            <td><?php echo "Rp. ".number_format($lr); ?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Modal Saat Ini</th>
                                            <th><?php $saatini = $modal + $lr; 
                                                echo "Rp. ".number_format($saatini);
                                                ?></th>
                                        </tr>
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
<!-- /.main-page -->
<!-- /.right-sidebar -->
</div>
<!-- /.content-container -->
</div>