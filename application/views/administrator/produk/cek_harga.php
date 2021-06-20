<div class="main-grid">
    <div class="agile-grids">
        <!-- input-forms -->
        <div class="grids">
            <div class="input-info">
                <h3 style="color:#00bcd4;">Cek Harga Barang</h3>
            </div>
            <div style="background-color: white;" class="card-body">
                <table style="width: 60%; margin:auto;">
                    <tr>
                        <td style="width: 70%;padding-top:30px;background-color: white;">
                            <form id="form_cek_harga" onsubmit="return cek_harga_produk()" method="post">
                                <input type="text" id="kode_barang" name="search" style="height: 40px; font-size: larger; background:#f4f7f9;" class="form-control" autofocus>
                            </form>
                        </td>
                        <td style="padding-top:30px;background-color: white;">
                            <button class="btn btn-primary btn-block" style="height: 40px;">Cek Harga Produk</button>
                        </td>
                    </tr>
                </table>
                <div class="agile-tables">
                    <div style="padding: 12px 12px;" class="w3l-table-info">
                        <table id="cek_harga" style="width: 60%; margin:10px auto">
                            <thead>
                                <tr>
                                    <th class="text-center">Nama Produk</th>
                                    <th class="text-center">Harga Produk</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="result"></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <hr>
        </div>

    </div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.dataTables.min.js') ?> "></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/mask-money/jquery.maskMoney.js') ?> "></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/validation/js/formValidation.js') ?> "></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/validation/js/framework/bootstrap.js') ?> "></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/notif/notify.js') ?> "></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?> "></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.printPage.js') ?> "></script>


<script type="text/javascript">
    function cek_harga_produk() {
        return false
    }

    $('#kode_barang').on('change', function() {
        if ($(this).val().length > 5) {
            $.ajax({
                url: "<?php echo site_url('administrator/transaksi_umum/get_data/') ?>" + $(this).val(),
                type: 'GET',
                dataType: 'JSON',
                success: function(obj) {
                    if (obj.status == true) {
                        $('#result').html(
                            '<td style="font-size: 30px" class="text-center">' + obj.result.nama_produk + '</td>' +
                            '<td style="font-size: 30px" class="text-center">' + obj.result.harga_umum + '</td>'
                        )
                        document.getElementById('form_cek_harga').reset()

                        if (obj.result.stok == 0) {
                            $.notify("PERHATIAN! \nStok tidak tersedia.", "error")
                            document.getElementById('form_cek_harga').reset()
                            document.getElementById('kode_barang').focus()
                        }
                    } else {
                        $('#result').html(
                            '<td style="font-size: 30px" class="text-center">' + '</td>' +
                            '<td style="font-size: 30px" class="text-center">' + '</td>'
                        )
                        $.notify("Gagal! \nData tidak tersedia.\nMohon lakukan pengentrian data produk \nyang belum tersedia.", "error")
                        document.getElementById('form_cek_harga').reset()
                        document.getElementById('kode_barang').focus()
                    }
                }
            })
        }
    })
</script>