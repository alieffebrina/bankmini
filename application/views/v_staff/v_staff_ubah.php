<div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Guru & Anggota</h2>
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
                    <li class="active">Data Master</li>
                    <li class="active">Guru dan Anggota</li>
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

                <div class="col-md-12">

                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h5>Ubah Data Guru dan Anggota</h5>
                            </div>
                        </div>
                        <div class="panel-body p-20">
                            <form action="<?= base_url('staff/ubah') ?>" method="POST">
                                <input type="hidden" value="<?= $staf['id_staf'] ?>" id="id_staf" name="id_staf" />
                                <table class="table">
                                    <tr>
                                        <td>No Anggota</td>
                                        <td>:</td>
                                        <td><input type="text" maxlength="12" class="form-control" id="nopegawai" name="nopegawai" value="<?= $staf['nopegawai']  ?> "></td>
                                    </tr>
                                    <tr>
                                        <td>RFID</td>
                                        <td>:</td>
                                        <td><input type="text" class="form-control" id="name5" name="rfid"  value="<?= $staf['rfid']  ?>" ></td>
                                    </tr>
                                    <tr>
                                        <td>Nama</td>
                                        <td>:</td>
                                        <td><input type="text" class="form-control" id="nama" name="nama" value="<?= $staf['nama'] ?>" required></td>
                                    </tr>
                                    <tr>
                                        <td>Telp.</td>
                                        <td>:</td>
                                        <td><input type="text" maxlength="12" minlength="11" class="form-control" id="telp" min="0" value="<?= $staf['tlp'] ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="telp" required></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td><textarea class="form-control" id="alamat" name="alamat" required><?= $staf['alamat'] ?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Provinsi</td>
                                        <td>:</td>
                                        <td>
                                            <?php
                                            $query = $this->db->query('select * from tb_provinsi order by name_prov asc')->result_array();
                                            ?>
                                            <select class="js-states form-control s_provinsi" id="js-states s_provinsi" name="s_provinsi">

                                                <option value="">Pilih Provinsi</option>
                                                <?php foreach ($query as $data) :
                                                    if ($data['id_provinsi'] == $staf['provinsi']) {
                                                ?>
                                                        <option value="<?= $data['id_provinsi'] ?>" selected><?= $data['name_prov'] ?></option>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <option value="<?= $data['id_provinsi'] ?>"><?= $data['name_prov'] ?></option>
                                                <?php }
                                                endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kota</td>
                                        <td>:</td>
                                        <td>
                                            <?php $kotaa = $this->db->query("SELECT * FROM tb_kota WHERE id_provinsi = '" . $staf['provinsi'] . "'")->result_array() ?>
                                            <select class="js-states form-control s_kota" id="js-states s_kota" name="s_kota">
                                                <?php foreach ($kotaa as $data) :
                                                    if ($data['id_kota'] == $staf['kota']) {
                                                ?>
                                                        <option value="<?= $data['id_kota'] ?>" selected><?= $data['name_kota'] ?></option>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <option value="<?= $data['id_kota'] ?>"><?= $data['name_kota'] ?></option>
                                                <?php }
                                                endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kecamatan</td>
                                        <td>:</td>
                                        <td>
                                            <?php $kecamatann = $this->db->query("SELECT * FROM tb_kecamatan WHERE id_kota = '" . $staf['kota'] . "'")->result_array() ?>
                                            <select class="js-states form-control s_kecamatan" id="js-states s_kecamatan" name="s_kecamatan">
                                                <?php foreach ($kecamatann as $data) :
                                                    if ($data['id_kecamatan'] == $staf['kecamatan']) {
                                                ?>
                                                        <option value="<?= $data['id_kecamatan'] ?>" selected><?= $data['kecamatan'] ?></option>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <option value="<?= $data['id_kecamatan'] ?>"><?= $data['kecamatan'] ?></option>
                                                <?php }
                                                endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Jabatan*</td>
                                        <td>:</td>
                                        <td><input type="text" class="form-control" id="jabatan" name="jabatan" required value="<?= $staf['jabatan'] ?>" ></td>
                                    </tr>
                                    <tr>
                                        <td>Jk*</td>
                                        <td>:</td>
                                        <td> <select class="js-states form-control" id="jk" name="jk">
                                                <option value="L" <?php if($staf['jk'] = 'L'){ echo "selected"; } ?> >Laki-laki</option>
                                                <option value="P" <?php if($staf['jk'] = 'P'){ echo "selected"; } ?> >Perempuan</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td>Tempat Lahir*</td>
                                        <td>:</td>
                                        <td><input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= $staf['tempat_lahir'] ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Lahir*</td>
                                        <td>:</td>
                                        <td><input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required value="<?= $staf['tgl_lahir'] ?>"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                    </tr>
                                </table>
                                <a href="<?= base_url('staff') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                <button class="btn btn-warning"><i class="fa fa-pencil"></i>Ubah</button>
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