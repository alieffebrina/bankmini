<?php date_default_timezone_set("Asia/Jakarta");  ?>
<div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Tahun Akademik</h2>
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
                    <li><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> Home</a></li>
                    <li class="active">Accounting</li>
                    <li class="active">Kas Masuk</li>
                </ul>
            </div>
            <!-- /.col-sm-6 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <section class="section">
        <div class="container-fluid">
            <div class="row ">

                <div class="col-md-6">

                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h5>Tambah Kas Masuk</h5>
                            </div>
                        </div>
                        <div class="panel-body p-20">
                            <form action="<?= base_url('kasmasuk/tambahdata') ?>" method="POST">
                                <table class="table">
                                    <tr>
                                        <td>
                                            Kode COA
                                        </td>
                                        <td>
                                            :
                                        </td>
                                        <td colspan="4">
                                            <!-- <input type="text" name="kodecoa" id="kodecoa" class="form-control"> -->
                                            <?php $kodecoa = $this->db->query("SELECT * FROM tb_mastercoa")->result_array(); ?>
                                            <select name="kodecoa" id="kodecoa" class="form-control">
                                                <?php foreach ($kodecoa as $data) : ?>
                                                    <option value="<?= $data['kode_coa'] ?>"><?= $data['kode_coa'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Tanggal Transaksi
                                        </td>
                                        <td>
                                            :
                                        </td>
                                        <td colspan="4"><input type="date" name="tglTransaksi" id="tglTransaksi" class="form-control" required></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Keterangan
                                        </td>
                                        <td>
                                            :
                                        </td>
                                        <td colspan="4"><textarea name="keterangan" id="keterangan" cols="30" rows="10" class="form-control" required></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Nominal
                                        </td>
                                        <td>
                                            :
                                        </td>
                                        <td colspan="4">
                                            <!-- <input type="text" name="nominal" id="nominal" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57'> -->
                                            <input type="text" class="form-control" id="inputNominal" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required name="no">
                                            <input type="hidden" name="nominal" id="nominal">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="4"></td>
                                    </tr>
                                </table>
                                <a href="<?= base_url('kasmasuk') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                <button class="btn btn-success"><i class="fa fa-plus"></i>Tambah</button>
                            </form>
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