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
                            <?php if ($akses['add'] == 1) { ?>
                                <a href="<?= base_url('jurnal-add/')  ?>" class="btn btn-primary ml-15">
                                    <i class="fa fa-plus text-white"></i>
                                    Tambah Jurnal
                                </a>
                            <?php } ?>
                        </div>
                        <div class="panel-body p-20">
                            <div class="container-fluid">                        
                                <div class="row mt-20">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <table id="dataTableSiswa" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal Jurnal</th>                                                   
                                                    <th>Keterangan</th>                                                       
                                                    <th>Saldo</th>                                                  
                                                    <th>Action</th>                                                      
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php $no = 1; foreach($jurnal as $row): 
                                                $cek = $this->db->query('SELECT SUM(nominal_debet) as nominal_debet FROM tb_detailjurnal where id_jurnal = '.$row["id_jurnal"] )->result_array();

                                                foreach ($cek as $cek) {
                                                    $cektr = $cek['nominal_debet'];
                                                }

                                                $cekkr = $this->db->query('SELECT SUM(nominal_kredit) as nominal_kredit FROM tb_detailjurnal where id_jurnal = '.$row["id_jurnal"] )->result_array();

                                                foreach ($cekkr as $cekkr) {
                                                    $cekkredit = $cekkr['nominal_kredit'];
                                                }

                                                $saldo = $cektr - $cekkredit;
                                                if($saldo != 0){ ?>
                                                    <tr style="color: red">
                                                <?php } else { ?>
                                                    <tr>
                                                <?php } ?>
                                                        <td><?= $no++; ?></td>
                                                        <td><?php echo date('d-m-Y', strtotime($row['tgl_update'])); ?></td>  

                                                        <td><?= $row['ketjurnal'] ?></td>       
                                                        <td><?= 'Rp. '.number_format($saldo) ?></td>
                                                        <td>
                                                        <div class="btn-group">
                                                            <a href="<?= base_url('jurnal-det/') . $row['id_jurnal'] ?>" class="btn btn-warning"><i class="fa fa-search"></i></a>
                                                            <a href="<?= base_url('Jurnal/pdf/') . $row['id_jurnal'] ?>" class="btn btn-primary"><i class="fa fa-print"></i></a>
                                                        </div>
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
