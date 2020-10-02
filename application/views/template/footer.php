
  <!-- /.content-wrapper -->
  <!-- /.content-wrapper -->
            <footer>
                <strong>Development By &copy; 2020 <a href="https://hosterweb.co.id">HOSTERWEB INDONESIA</a>
            </footer>
        </div>
        <!-- /.main-wrapper -->    
    </div>
        <!-- ========== COMMON JS FILES ========== -->
        <script src="<?php echo base_url() ?>assets/Theme/js/jquery/jquery-2.2.4.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/jquery-ui/jquery-ui.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/bootstrap/bootstrap.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/pace/pace.min.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/lobipanel/lobipanel.min.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/iscroll/iscroll.js">j</script>
        <script src="<?php echo base_url() ?>assets/Theme/js/DataTables/DataTables-1.10.13/js/jquery.dataTables.js"></script> 
        <script src="<?php echo base_url() ?>assets/Theme/js/DataTables/DataTables-1.10.13/js/dataTables.bootstrap.js"></script> 

        <!-- ========== PAGE JS FILES ========== -->
        <script src="<?php echo base_url() ?>assets/Theme/js/prism/prism.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/waypoint/waypoints.min.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/counterUp/jquery.counterup.min.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/amcharts/amcharts.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/amcharts/serial.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/amcharts/plugins/export/export.min.js"></script>
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/Theme/js/amcharts/plugins/export/export.css" type="text/css" media="all" />
        <script src="<?php echo base_url() ?>assets/Theme/js/amcharts/themes/light.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/toastr/toastr.min.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/icheck/icheck.min.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/bootstrap-tour/bootstrap-tour.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/select2/select2.min.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="<?php echo base_url() ?>assets/Theme/js/main.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/production-chart.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/traffic-chart.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/task-list.js"></script>        
        <script src="<?php echo base_url() ?>assets/Theme/js/script.js"></script>
        <script>
            $(".js-states").select2();

            $(".js-states-limit").select2({
                maximumSelectionLength: 2
            });

            $(".js-states-hide").select2({
                    minimumResultsForSearch: Infinity
            });

            $('#tableLulus').DataTable();

            $('#dataTableSiswa').DataTable({
                'scrollX' : true
            });

            $('input.blue-style').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue'
            });

            $('input.green-style').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });

            $('input.red-style').iCheck({
                checkboxClass: 'icheckbox_square-red',
                radioClass: 'iradio_square-red'
            });

            $('input.flat-black-style').iCheck({
                checkboxClass: 'icheckbox_flat',
                radioClass: 'iradio_flat'
            });

            $('input.line-style').each(function(){
                var self = $(this),
                    label = self.next(),
                    label_text = label.text();

                label.remove();
                self.iCheck({
                    checkboxClass: 'icheckbox_line-blue',
                    radioClass: 'iradio_line-blue',
                    insert: '<div class="icheck_line-icon"></div>' + label_text
                });
            });
           
            // $(function(){

                // Counter for dashboard stats
                // $('.counter').counterUp({
                //     delay: 10,
                //     time: 1000
                // });

                // Welcome notification
                // toastr.options = {
                //     "closeButton": true,
                //     "debug": false,
                //     "newestOnTop": false,
                //     "progressBar": false,
                //     "positionClass": "toast-top-right",
                //     "preventDuplicates": false,
                //     "onclick": null,
                //     "showDuration": "300",
                //     "hideDuration": "1000",
                //     "timeOut": "3500",
                //     "extendedTimeOut": "1000",
                //     "showEasing": "swing",
                //     "hideEasing": "linear",
                //     "showMethod": "fadeIn",
                //     "hideMethod": "fadeOut"
                // }
                // toastr["success"]("One stop solution to your website admin panel!", "Welcome to Options!");


            // });

        $("#tb_tipeuser").DataTable()

        $('#tb_staff').DataTable({
            "scrollX": true
        });

        $("#tb_tahunakademik").DataTable()
        // $("#tb_staff").DataTable();

        $(".s_provinsi").change(function() {
            $.get("http://localhost/bmssekolah/staff/getkota/" + this.value, function(result) {
                let data = JSON.parse(result);
                $(".s_kota").html('<option>Pilih kota</option>')
                $(".s_kota").removeAttr('disabled')
                $(".s_kecamatan").html('<option>Pilih Kecamatan</option>')
                data.forEach(function(dataKota) {
                    $(".s_kota").append('<option value="' + dataKota.id_kota + '">' + dataKota.name_kota + '</option>')
                })
            })
        });

        $(".s_kota").change(function() {
            $.get("http://localhost/bmssekolah/staff/getkecamatan/" + this.value, function(result) {
                console.log(result)
                let data = JSON.parse(result);
                $(".s_kecamatan").removeAttr('disabled')
                $(".s_kecamatan").html('<option>Pilih Kecamatan</option>')

                data.forEach(function(dataKecamatan) {
                    $(".s_kecamatan").append('<option value="' + dataKecamatan.id_kecamatan + '">' + dataKecamatan.kecamatan + '</option>')
                })
            })
        })

        $('#debet').change(function(){            
            if($(this).val() === 'siswa'){
                if($('#kredit').val() === 'Pilih' || $('#kredit').val() === null || $('#kredit').val() === ' '){
                    $('#kredit').html('<option>Pilih</option><option value="koperasi">Koperasi</option>')
                }
                else if($('#kredit').val() === 'siswa'){
                    $('#kredit').html('<option>Pilih</option><option value="koperasi">Koperasi</option>')
                }
            }else if($(this).val() === 'koperasi'){
                if($('#kredit').val() === 'Pilih' || $('#kredit').val() === null || $('#kredit').val() === ' '){
                     $('#kredit').html('<option>Pilih</option><option value="siswa">siswa</option>')
                }else if($('#kredit').val() === 'koperasi'){
                    $('#kredit').html('<option>Pilih</option><option value="siswa">siswa</option>')
                }
            }else{
                 $('#kredit').html('<option>Pilih</option><option value="siswa">siswa</option><option value="koperasi">Koperasi</option>')
            }
        })

        $('#kredit').change(function(){            
            if($(this).val() === 'siswa'){
                if($('#debet').val() === 'Pilih' || $('#debet').val() === null || $('#debet').val() === ' '){
                    $('#debet').html('<option>Pilih</option><option value="koperasi">tpo</option>')
                }
                else if($('#debet').val() === 'siswa'){
                    $('#debet').html('<option>Pilih</option><option value="koperasi">Koperasi</option>')
                }
            }else if($(this).val() === 'koperasi'){
                if($('#debet').val() === 'Pilih' || $('#debet').val() === null || $('#debet').val() === ' '){
                     $('#debet').html('<option>Pilih</option><option value="siswa">siswa</option>')
                }else if($('#debet').val() === 'koperasi'){
                    $('#debet').html('<option>Pilih</option><option value="siswa">siswa</option>')
                }
            }else{
                 $('#debet').html('<option>Pilih</option><option value="siswa">siswa</option><option value="koperasi">Koperasi</option>')
            }
        })
             $('#blnkas').change(function() {
        $.get("http://localhost/bms/kasumum/recapKas/" + this.value, function(result) {
            // console.log(result)
            $("#dataKas").html('')
            let data = JSON.parse(result);
            data.forEach(function(dataKasKeluar) {
                let dateee = new Date(dataKasKeluar[0])
                let tgltransaksii = dateee.getDate() + ' - ' + (dateee.getMonth() + 1) + ' - ' + dateee.getFullYear()
                let kode = dataKasKeluar[3]
                let ketkode = kode.substring(0, 2)
                let debet = 0
                let kredit = 0
                if (ketkode === 'KK') {
                    debet = formatRupiah(dataKasKeluar[2], 'Rp. ')
                } else if (ketkode == 'KM') {
                    kredit = formatRupiah(dataKasKeluar[2], 'Rp. ')
                }

                $("#dataKas").append(`<tr>
                        <td>` + tgltransaksii + `</td>
                        <td>` + dataKasKeluar[1] + `</td>
                        <td>` + debet + `</td>
                        <td>` + kredit + `</td>
                        <td>` + 0 + `</td>
                    </tr>`)
            })
        })
    })
    $('#neraca').change(function() {
        $('#pm').removeAttr('checked')
        $('#lr').removeAttr('checked')
        $('#pm').removeAttr('required')
        $('#lr').removeAttr('required')
    })
    $('#pm').change(function() {
        $('#neraca').removeAttr('checked')
        $('#lr').removeAttr('checked')
        $('#neraca').removeAttr('required')
        $('#lr').removeAttr('required')
    })
    $('#lr').change(function() {
        $('#neraca').removeAttr('checked')
        $('#pm').removeAttr('checked')
        $('#neraca').removeAttr('required')
        $('#pm').removeAttr('required')
    })

        function toggle(source) {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
            }
        }

        function embuh(){
            var embuha = document.getElementById('kodeformat1').value;
            if(embuha=='huruf'){
            document.getElementById('texthuruf1').style.visibility='visible';
            // document.getElementById('texthuruf1').value = embuha;
            } else {
            document.getElementById('texthuruf1').style.visibility='hidden';

            }
        }

        function embuhb(){
            var embuhtext = document.getElementById('format2').value;
            if(embuhtext=='huruf'){
            document.getElementById('texthuruf2').style.visibility='visible';
            } else {
            document.getElementById('texthuruf2').style.visibility='hidden';

            }
        }

        function embuhc(){
            var embuhtext3 = document.getElementById('format3').value;
            if(embuhtext3=='huruf'){
            document.getElementById('texthuruf3').style.visibility='visible';  
            } else {
            document.getElementById('texthuruf3').style.visibility='hidden';   
            }
            // document.getElementById('texthuruf3').value=embuhtext3;
        }

        function embuhhub(){
            var a = document.getElementById('kodeformat1').value;
            var b = document.getElementById('format2').value;
            var c = document.getElementById('format3').value;
            var d = document.getElementById('penghubung').value;
            var e = document.getElementById('texthuruf1').value;
            var f = document.getElementById('texthuruf2').value;
            var g = document.getElementById('texthuruf2').value;
            if (a == "huruf"){
                var a = e;
            } 
            if (b == "huruf"){
                var b = f;
            } 
            if(c == "huruf"){
                var c = g;
            }
            document.getElementById('final').value = a+d+b+d+c;

            document.getElementById('kodetransaksi').value = a+d+b+d+c;
            $('#btnsimpankodekorwil').click(function(){
                $('.close').click();
            })
            // var embuhhuba = document.getElementById('penghubung').value;
        // document.getElementById('final').value= a+b;
        }

        $('#tb_import').DataTable({
            scrollY: '300px',
            paging: false
        });

        $('#file').hide();

        $('#file').change(function(){
            $('#filename').html($(this)[0].files[0]['name'])
            // console.log()
        })

        $('.tipeuserAdd').change(function(){
            $('#box-transaksi').html('')
           if($(this).val() != 'Pilih Tipe User'){
                if(parseInt($(this).val()) == 1){
                    $.get('http://localhost/bmssekolah/staff/getStaff', function (result) {
                        let data = JSON.parse(result);
                        // console.log(data)
                        $('.cusName').html('');
                        $('.cusName').removeAttr('disabled');
                        $('.cusName').append('<option value="">Pilih Nama</option>')
                        data.forEach(function (res) {
                            $('.cusName').append('<option value="' + res.id_staf + '">' + res.nama + '</option>')
                        })
                    });
                    $.get('http://localhost/bmssekolah/mtransaksi/getMTransaksiStaf/koperasi', function (result) {
                        let data = JSON.parse(result);
                        // console.log(data)
                        $('.kategori').html('');
                        $('.kategori').removeAttr('disabled');
                        $('.kategori').append('<option value=" ">Pilih Transaksi</option>')
                        data.forEach(function (res) {
                            $('.kategori').append('<option value="' + res.id_mastertransaksi + '">' + res.kategori + '</option>')
                        })
                    });

                }else{
                    $.get('http://localhost/bmssekolah/siswa/getSiswa', function (result) {
                        let data = JSON.parse(result);
                        // console.log(data)
                        $('.cusName').html('');
                        $('.cusName').removeAttr('disabled');
                        $('.cusName').append('<option value="">Pilih Nama</option>')
                        data.forEach(function (res) {
                            $('.cusName').append('<option value="' + res.nis + '">' + res.namasiswa + '</option>')
                        })
                    });
                    $.get('http://localhost/bmssekolah/mtransaksi/getMTransaksiSiswa/siswa', function (result) {
                        let data = JSON.parse(result);
                        // console.log(data)
                        $('.kategori').html('');
                        $('.kategori').removeAttr('disabled');
                        $('.kategori').append('<option value="">Pilih Transaksi</option>')
                        data.forEach(function (res) {
                            $('.kategori').append('<option value="' + res.id_mastertransaksi + '">' + res.kategori + '</option>')
                        })
                    });               
                }
           }
            $('#usertipe').val($('.tipeuserAdd').val())            
        })
        // $('#checkCus').click(function(){
        //     if(!empty($('.cusName').val())){
        //         $('.kategori').removeAttr('disabled');
        //     }else{
        //         $('.kategori').attr('disabled', 'disabled');
        //         $('.inpt').attr('disabled', 'disabled')
        //         // $('.kategori').removeAttr('disabled')
        //         $('.cusName').removeAttr('disabled')
        //         $('#id_jenistransaksi').val('')
        //         $('#kode').val('')
        //         $('#kode_transaksi').val('')
        //         $('#keterangan').val('')
        //         $('.nominalInp').val('')
        //     }
        // })
        $('.kategori').change(function(){
           if(this.value != ' '){
                $('.inpt').removeAttr('disabled')
                $.get('http://localhost/bmssekolah/mtransaksi/detailTransaksi/'+this.value, function (result) {
                    let data = JSON.parse(result);
                    $('#id_jenistransaksi').val(data.id_mastertransaksi)
                    $('#kode').val(data.kodetransaksi)
                    $('#kode_transaksi').val(data.kodetransaksi)
                    $('#keterangan').val(data.deskripsi)
                    $('.nominalInp').val(formatRupiah(data.nominal, "Rp. "))
                });
           }else{
                $('.inpt').attr('disabled', 'disabled')
                $('.kategori').removeAttr('disabled')
                $('.cusName').removeAttr('disabled')
                $('#id_jenistransaksi').val('')
                $('#kode').val('')
                $('#kode_transaksi').val('')
                $('#keterangan').val('')
                $('.nominalInp').val('')
           }
        })  
            
        if($('#editTransaksi').val() == 'edit'){
            getCustomer()
        }  

        $('#confirmTable').hide()

        function getCustomer(){
            let customer = $('#id_customer').val()            
            if($('#usertipe').val() == 'siswa'){
                $.get('http://localhost/bmssekolah/siswa/getSiswa', function (result) {
                    let data = JSON.parse(result);
                    // console.log(data)
                    $('.cusName').html('');
                    $('.cusName').removeAttr('disabled');
                    data.forEach(function (res) {
                        if(res.nis === customer){
                            $('.cusName').append('<option value="' + res.nis + '" selected>' + res.namasiswa + '</option>')
                        }else{
                            $('.cusName').append('<option value="' + res.nis + '">' + res.namasiswa + '</option>')
                        }
                    })
                });
            }else{
                $.get('http://localhost/bmssekolah/staff/getStaff', function (result) {
                    let data = JSON.parse(result);
                    // console.log(data)
                    $('.cusName').html('');
                    $('.cusName').removeAttr('disabled');
                    data.forEach(function (res) {
                        if(res.id_staf === customer){
                            $('.cusName').append('<option value="' + res.id_staf + '" selected>' + res.nama + '</option>')
                        }else{
                            $('.cusName').append('<option value="' + res.id_staf + '">' + res.nama + '</option>')
                        }
                    })
                });
            }
            $('.nominalInp').val(formatRupiah($('#nominal').val(), "Rp. "))   
        }

        $('#bpTipeuser').change(function(){
            if($(this).val() == 'siswa'){
                $.get('http://localhost/bmssekolah/siswa/getSiswa', function (result) {
                    let data = JSON.parse(result);
                    // console.log(data)
                    $('.nameMember').html('');
                    $('.nameMember').removeAttr('disabled');
                    $('.btn-mem').removeAttr('disabled');
                    $('.nameMember').html('<option value="">Pilih Nama</option>')
                    data.forEach(function (res) {
                        $('.nameMember').append('<option value="' + res.nis + '">' + res.namasiswa + '</option>')                        
                    })
                });
            }else if($(this).val() == 'staf'){
                $.get('http://localhost/bmssekolah/staff/getStaff', function (result) {
                    let data = JSON.parse(result);
                    // console.log(data)
                    $('.nameMember').html('');
                    $('.nameMember').removeAttr('disabled');
                    $('.btn-mem').removeAttr('disabled');
                    $('.nameMember').html('<option value="">Pilih Nama</option>')
                    data.forEach(function (res) {                        
                        $('.nameMember').append('<option value="' + res.id_staf + '">' + res.nama + '</option>')
                    })
                });
            }else{
                $('.nameMember').html('<option value="">Pilih Nama</option>')
                $('.nameMember').attr('disabled', 'disabled');
                $('.btn-mem').attr('disabled', 'disabled');
            }

            $('#tableBP').html('')
        })

        $('.btn-mem').click(() => {
            let id = $('.nameMember').val()
            let tipe = $('#bpTipeuser').val()
            if(id != ''){
                $.get('http://localhost/bmssekolah/transaksi/detailTransaksi?id='+parseInt(id)+'&tipe='+tipe, function (result) {
                    let data = JSON.parse(result)
                    console.log(data)
                    if(data.length != 0){
                        let no = 1;
                        data.forEach(function(res){
                            $('#tableBP').append('<tr><td>'+ no++ +'</td><td>'+ res.tgl_update +'</td><td>'+ res.keterangan +'</td><td>'+ res.debet +'</td><td>'+ res.kredit +'</td><td>'+ 0 +'</td></tr>')
                        })
                    }else{
                        $('#tableBP').html('')
                    }
                });
            }else{
                alert('Pilih Nama')
            }
        })

        $('.cusName').change(function(){
            if($(this).val() != 'Pilih Nama'){
                $('#box-transaksi').html('')
                $('#id_customer').val($(this).val())
                $.get('http://localhost/bmssekolah/transaksi/getHistoriTransaksi?id='+parseInt($(this).val())+'&tipe='+$('.tipeuserAdd').val(), function (result) {
                    let data = JSON.parse(result) 
                    // console.log(result)
                    // console.log(data)
                    if(data.length != 0){
                        let no = 1;
                        data.forEach(function(res){
                            $('#box-transaksi').append('<div class="list-group-item"><b>'+ no++ +'. </b>'+res.tgl_update+' <b>'+res.keterangan+'</b></div>')
                        })
                    }else{
                        $('#box-transaksi').append('<div class="list-group-item">Tidak Ada Transaksi</div>')
                    }
                });               
            }else{
                $('#box-transaksi').append('<div class="list-group-item">Tidak Ada Transaksi</div>')
            }
        })

        $('.btnAdd').click(function(){
           setInterval(() => {
            $('#box-transaksi').html('')
            $('.nameMember').html('')
            $('.inpt').attr('disabled', 'disabled')
            $('.kategori').attr('disabled', 'disabled')
            $('.kategori').html('')
            $('.cusName').attr('disabled', 'disabled')
            $('.cusName').html('')            
            $('#id_jenistransaksi').val('')
            $('#kode').val('')
            $('#kode_transaksi').val('')
            $('#keterangan').val('')
            $('.nominalInp').val('')
           }, 500);
        })

        $('#jurnalTs').change(function(){
            if($(this).val() != 'pilih'){
                reRadio()
                // $('.transaksiField').append('<option value="">Pilih Transaksi</option>')
                if($(this).val() == 'transaksi'){
                    $('.transaksiField').html('')
                    $('.transaksiField').append('<option value="salah">Pilih Transaksi</option>')
                    // console.log($(this).val())
                    $.get('http://localhost/bmssekolah/transaksi/getTransaksi', function (result) {
                        let data = JSON.parse(result)
                        // console.log(data)                    
                        if(data.length != 0){
                            let no = 1;
                            $('.transaksiField').removeAttr('disabled');
                            data.forEach(function(res){
                                var d = res.tgl_update;
                                d = d.split(' ')[0]
                                $('.transaksiField').append('<option tipe="transaksi" keterangan="'+res.keterangan+'" type="'+res.type+'" kredit="'+res.kredit+'" debet="'+res.debet+'" nominal="'+res.nominal+'" value="'+res.id_transaksi+'">'+ d +' '+res.namaTransaksi+'('+ res.noIden +') <b>'+ res.keterangan +'</b></option>')
                            })
                        }else{
                            $('.transaksiField').html('')
                            $('.transaksiField').attr('disabled', 'disabled')
                            $('.transaksiField').append('<option>Transaksi Kosong</option>')
                        }
                    });
                }else if($(this).val() == 'kaskeluar'){
                    $('.transaksiField').html('')
                    $('.transaksiField').append('<option value="salah">Pilih Kas Keluar</option>')
                    $.get('http://localhost/bmssekolah/kaskeluar/getKasKeluar', function (result) {
                        let data = JSON.parse(result)
                        // console.log(data)                    
                        if(data.length != 0){
                            let no = 1;
                            $('.transaksiField').removeAttr('disabled');
                            data.forEach(function(res){
                                var d = res.tgltransaksi;
                                d = d.split(' ')[0]
                                $('.transaksiField').append('<option tipe="kk" keterangan="'+res.keterangan+'" nominal="'+res.nominal+'" value="'+res.id_kk+'">'+ d +' '+res.keterangan+'('+ res.kode_kas_keluar +') <b>'+ formatRupiah(res.nominal, "Rp. ") +'</b></option>')
                            })
                        }else{
                            $('.transaksiField').html('')
                            $('.transaksiField').attr('disabled', 'disabled')
                            $('.transaksiField').append('<option>Kas Keluar Kosong</option>')
                        }
                    });
                }else if($(this).val() == 'kasmasuk'){
                    $('.transaksiField').html('')
                    $('.transaksiField').append('<option value="salah">Pilih Kas Masuk</option>')
                    $.get('http://localhost/bmssekolah/kasmasuk/getKasMasuk', function (result) {
                        let data = JSON.parse(result)
                        // console.log(data)                    
                        if(data.length != 0){
                            let no = 1;
                            $('.transaksiField').removeAttr('disabled');
                            data.forEach(function(res){
                                var d = res.tgltransaksi;
                                d = d.split(' ')[0]
                                $('.transaksiField').append('<option tipe="km" keterangan="'+res.keterangan+'" nominal="'+res.nominal+'" value="'+res.id_km+'">'+ d +' '+res.keterangan+'('+ res.kode_kas_masuk +') <b>'+ formatRupiah(res.nominal, "Rp. ") +'</b></option>')
                            })
                        }else{
                            $('.transaksiField').html('')
                            $('.transaksiField').attr('disabled', 'disabled')
                            $('.transaksiField').append('<option>Kas Masuk Kosong</option>')
                        }
                    });
                }
            }else{
                $('.transaksiField').html('')
                $('.transaksiField').attr('disabled', 'disabled')
                $('.transaksiField').append(' <option value="">Pilih Transaksi</option>')
            }
        })  

        $('.transaksiField').change(function(){
            let kode = $(this).val()
            let nominal = $('.transaksiField option:selected').attr('nominal')
            let tipe = $('.transaksiField option:selected').attr('tipe') 
            reRadio()                    
            if(kode != 'salah'){
                $('.btnGenerate').removeAttr('disabled')
                $('.nominalJurnal').val(formatRupiah(nominal, "Rp. "))
                if(tipe == 'kk'){
                    $('.radioTwo .iradio_square-blue').attr('class', 'iradio_square-blue checked')
                    $('#two').attr('checked', true)
                }
                else if(tipe == 'km'){
                    $('.radioOne .iradio_square-blue').attr('class', 'iradio_square-blue checked')
                    $('#one').attr('checked', true)
                }
                else if(tipe == 'transaksi'){
                    let tipe = $('.transaksiField option:selected').attr('type');
                    let debet = $('.transaksiField option:selected').attr('debet')
                    let kredit = $('.transaksiField option:selected').attr('kredit') 
                    let koperDebet = ''
                    let koperKredit = ''
                    if(debet == 'koperasi'){
                        koperDebet = 'staf'
                    }
                    if(kredit == 'koperasi'){
                        koperKredit = 'staf'
                    }
                    if(tipe == debet || tipe == koperDebet){
                        // console.log(tipe)
                        // console.log(debet)
                        console.log('debet')
                        $('.radioOne .iradio_square-blue').attr('class', 'iradio_square-blue checked')
                        $('#one').attr('checked', true)
                    }
                    else if(tipe == kredit || tipe == koperKredit){
                        // console.log(tipe)
                        // console.log(kredit)
                        console.log('kredit')
                        $('.radioTwo .iradio_square-blue').attr('class', 'iradio_square-blue checked')
                        $('#two').attr('checked', true)
                    }

                }
            }
        })      

        function reRadio(){
            $('.radioOne .iradio_square-blue').attr('class', 'iradio_square-blue')
            $('.radioTwo .iradio_square-blue').attr('class', 'iradio_square-blue')
            $('.nominalJurnal').val('')
            $('#two').attr('checked', false)
            $('#one').attr('checked', false)
        }

        
        $('.btnGenerate').click(function(){
            $('#confirmTable').show()
            $('.jurnalKeterangan').html('')
            $('.jurnalDebet').html('')      
            $('.jurnalKredit').html('')    
            $('input[name="jurnal_id_transaksi"]').val('')
            $('input[name="jurnal_tipe_transaksi"]').val('')   
            $('input[name="transaksi_kredit"]').val('')
            $('input[name="transaksi_debet"]').val('')
            $('input[name="nominal_kredit"]').val('')
            $('input[name="nominal_debet"]').val('')
            $('input[name="kode_coa_debet"]').val('')
            $('input[name="kode_coa_kredit"]').val('')

            let nominal = $('.transaksiField option:selected').attr('nominal')            
            let keterangan = $('.transaksiField option:selected').attr('keterangan')            
            let tipe = $('.transaksiField option:selected').attr('tipe');
            let debet = $('.transaksiField option:selected').attr('debet')
            let kredit = $('.transaksiField option:selected').attr('kredit') 
            let koperDebet = ''
            let koperKredit = ''
            $('.jurnalKeterangan').html(keterangan)
            if(tipe == 'kk'){
                $('.jurnalKredit').html(formatRupiah(nominal,'Rp. '))      
                $('input[name="nominal_kredit"]').val(nominal)
                $('input[name="transaksi_kredit"]').val($('.transaksiField').val())
            }
            else if(tipe == 'km'){
                $('.jurnalDebet').html(formatRupiah(nominal,'Rp. '))      
                $('input[name="nominal_debet"]').val(nominal)
                $('input[name="transaksi_debet"]').val($('.transaksiField').val())
            }
            else if(tipe == 'transaksi'){   
                let type = $('.transaksiField option:selected').attr('type');
                if(debet == 'koperasi'){
                    koperDebet = 'staf'
                }
                if(kredit == 'koperasi'){
                    koperKredit = 'staf'
                }
                if(type == debet || type == koperDebet){
                    // console.log(type)
                    // console.log(debet)
                    // console.log('debet')
                    $('.jurnalDebet').html(formatRupiah(nominal,'Rp. '))      
                    $('input[name="nominal_debet"]').val(nominal)
                    $('input[name="transaksi_debet"]').val($('.transaksiField').val())
                }
                else if(type == kredit || type == koperKredit){
                    // console.log(tipe)
                    // console.log(kredit)
                    // console.log('kredit')
                    $('.jurnalKredit').html(formatRupiah(nominal,'Rp. '))      
                    $('input[name="nominal_kredit"]').val(nominal)
                    $('input[name="transaksi_kredit"]').val($('.transaksiField').val())
                }
            }            
            $('input[name="jurnal_id_transaksi"]').val($('.transaksiField').val())
            $('input[name="jurnal_tipe_transaksi"]').val(tipe)            
        })

        $('#kodeCOA1').change(function(){
            let kode = $(this).val()
            $('.btn-saveJurnal').attr('disabled', 'disabled');
            $('input[name="kode_coa_debet"]').val($(this).val())
            if(kode != 'salah'){                
                $('#kodeCOA2').removeAttr('disabled')
                $.get('http://localhost/bmssekolah/mastercoa/getMasterCOA', function (result) {
                    let data = JSON.parse(result)   
                    $('#kodeCOA2').html('');
                    $('#kodeCOA2').append('<option value="salah">Pilih Kode COA Kredit</option>');
                    data.forEach(function(res){
                        if(parseInt(res.kode_coa) != parseInt(kode)){
                            $('#kodeCOA2').append('<option value="'+ res.kode_coa +'">'+ res.kode_coa +' - '+ res.akun+'</option>');
                        }
                    })
                });                      
            }else{
                $('#kodeCOA2').html('');
                $('#kodeCOA2').attr('disabled', 'disabled');
            }
        })

        $('#kodeCOA2').change(function(){
            if($(this).val() != 'salah'){
                $('input[name="kode_coa_kredit"]').val($(this).val())
                $('.btn-saveJurnal').removeAttr('disabled')
            }else{
                $('.btn-saveJurnal').attr('disabled', 'disabled');
            }
        })
        </script>
        <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
    </body>
</html>
