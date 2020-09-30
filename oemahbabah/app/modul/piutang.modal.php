<div class="modal fade" id="modalPenjualan"    tabindex="-1" role="dialog" aria-labelledby="EditPostLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header" style="display:none">
<h5 class="modal-title" id="EditPostLabel">Transaksi Penjualan</h5>
</div>
<div class="modal-body" >
<hr>
<div id="showTablePenjualan"></div>
</div>
<div class="modal-footer">
<button class="btn btn-success" id="bayarPiutang"><i class="fa fa-check-square" aria-hidden="true"></i> Bayar Piutang</button>
<a class="btn btn-primary"  href="#" id="hapusTransaksi"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</a>
<a class="btn btn-primary" onclick="jQuery('#printArea').print()" href="#" id="printPenjualan"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
<button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-window-close" aria-hidden="true"></i> Tutup</button>
</div>
</div>
</div>
</div>

<div class="modal fade" id="modalBayarPiutang" tabindex="-1" role="dialog" aria-labelledby="EditPostLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header modal-header-primary">
<h5 class="modal-title" id="EditPostLabel">Pembayaran Piutang</h5>
</div>
<div class="modal-body" >
<div id="showFormPiutang"></div>
</div>
<div class="modal-footer">
<a class="btn btn-success" id="inputPiutang"><i class="fa fa-save" aria-hidden="true"></i> Simpan</a>
<button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-window-close" aria-hidden="true"></i> Batal</button>
</div>
</div>
</div>
</div>
