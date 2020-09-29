
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
                 $(function($) {
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

        $("#tb_tipeuser").DataTable();
         $('#tb_staff').DataTable( {
                     "scrollX": true
                } );

        $("#tb_tahunakademik").DataTable();
        // $("#tb_staff").DataTable();

        $(".s_provinsi").change(function() {
        $.get("http://localhost/bms/staff/getkota/" + this.value, function(result) {
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
        $.get("http://localhost/bms/staff/getkecamatan/" + this.value, function(result) {
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
        $('#checkCus').click(function(){
            if(parseInt($('#tipeuser').val()) === 1){
                $.get('http://localhost/bms/staff/getStaff', function (result) {
                    let data = JSON.parse(result);
                    // console.log(data)
                    $('.cusName').html('');
                    $('.cusName').removeAttr('disabled');
                    data.forEach(function (res) {
                        $('.cusName').append('<option value="' + res.id_staf + '">' + res.nama + '</option>')
                    })
                });
                $.get('http://localhost/bms/mtransaksi/getMTransaksiStaf/koperasi', function (result) {
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
                $.get('http://localhost/bms/siswa/getSiswa', function (result) {
                    let data = JSON.parse(result);
                    // console.log(data)
                    $('.cusName').html('');
                    $('.cusName').removeAttr('disabled');
                    data.forEach(function (res) {
                        $('.cusName').append('<option value="' + res.nis + '">' + res.namasiswa + '</option>')
                    })
                });
                $.get('http://localhost/bms/mtransaksi/getMTransaksiSiswa/siswa', function (result) {
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
            $('#usertipe').val($('#tipeuser').val())            
        })
        $('.kategori').change(function(){
           if(this.value != ' '){
                $('.inpt').removeAttr('disabled')
                $.get('http://localhost/bms/mtransaksi/detailTransaksi/'+this.value, function (result) {
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
        function getCustomer(){
            let customer = $('#id_customer').val()            
            if($('#usertipe').val() == 'siswa'){
                $.get('http://localhost/bms/siswa/getSiswa', function (result) {
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
                $.get('http://localhost/bms/staff/getStaff', function (result) {
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
                $.get('http://localhost/bms/siswa/getSiswa', function (result) {
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
                $.get('http://localhost/bms/staff/getStaff', function (result) {
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
                $.get('http://localhost/bms/transaksi/detailTransaksi?id='+parseInt(id)+'&tipe='+tipe, function (result) {
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
        </script>
        <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
    </body>
</html>
