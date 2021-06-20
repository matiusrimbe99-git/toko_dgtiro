<div class="main-grid">
    <div class="agile-grids">
        <!-- input-forms -->
        <div class="grids">
            <div class="input-info">
                <h3 style="color:#00bcd4;">Transaksi Umum</h3>
            </div>
            <div style="background-color: white;" class="card-body">
                <table style="height: 60px;">
                    <tr>
                        <td style="width: 30%; ">
                            <form action="#" id="form_order" method="post">
                                <input type="text" id="kode_barang" name="search" style="height: 40px; font-size: larger; background:#f4f7f9;" value="Barcode Scanner" required="true" class="form-control" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Barcode Scanner';}" required="">
                            </form>
                        </td>
                        <td style="width: 30%;">
                            <button class="btn btn-primary btn-block" style="width: 150px; height: 40px;" onclick="cari_produk()">Cari Manual <i class="fa fa-search" aria-hidden="true"></i></button>
                        </td>
                        <td>
                            <h2>Total : <span id="total-atas"></span></h2>
                        </td>
                    </tr>
                </table>
                <div class="agile-tables">
                    <div style="padding: 12px 12px;" class="w3l-table-info">
                        <table style="margin-top:10px;" id="table">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Kode Barang</th>
                                    <th>Nama</th>
                                    <th class="text-center">Jumlah</th>
                                    <th>Satuan</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <form action="" id="form_bayar" method="POST">
                            <table style="height: 60px;">
                                <tr>
                                    <td style="width: 60%; ">
                                    </td>
                                    <td style="width: 12%;">
                                        <h4>Grand Total</h4>
                                    </td>
                                    <td class="text-center" width="20px">
                                        <h4>:</h4>
                                    </td>
                                    <td>
                                        <h4><span id="total-bawah"></span></h4>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 60%; ">
                                        <div style="text-align: center;">
                                            <button onclick="button_selesai()" type="button" id="grand_total" data-total="<?php echo number_format('200000') ?>" class="btn btn-primary"><i class="fa fa-save"></i> Selesai</button>
                                            <a href="<?php echo site_url('administrator/transaksi_umum/cancel_transaction') ?>" class="btn btn-danger"><i class="fa fa-times"></i> Batalkan</a>
                                            <!-- <?php echo (!$this->cart->contents()) ? 'disabled' : '' ?> -->
                                        </div>
                                    </td>
                                    <td style="width: 12%;">
                                        <h4>Tunai</h4>
                                    </td>
                                    <td class="text-center" width="20px">
                                        <h4>:</h4>
                                    </td>
                                    <td>
                                        <input type="text" id="dibayar" name="bayar" style="height: 40px; font-size: larger; background:#f4f7f9;" placeholder="Dibayar..." required="true" class="form-control">
                                    </td>

                                </tr>

                                <tr>
                                    <td style="width: 60%; ">
                                    </td>
                                    <td style="width: 12%; padding-bottom:0px;">
                                        <h4>Kembali</h4>
                                    </td>
                                    <td class="text-center" width="20px">
                                        <h4>:</h4>
                                    </td>
                                    <td>
                                        <h4><span id="kembali">Rp.</span></h4>
                                    </td>
                                </tr>
                            </table>
                        </form>

                    </div>



                </div>




            </div>
            <hr>
        </div>

        <!-- Modal -->
        <div class="modal animated" id="cari_produk" role="dialog">
            <div class="modal-dialog" style="width: 70%;">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="background: #00bcd4;">
                        <h4 class="modal-title" style="color: white;">CARI MANUAL PRODUK</h4>
                    </div>
                    <div class="modal-body">
                        <table style="width: 100%;padding-top: 20px" id="table_produk">
                            <thead>
                                <tr>
                                    <th class="text-center">Kode Barang</th>
                                    <th>Nama Produk</th>
                                    <th class="text-center">Stok</th>
                                    <th class="text-center">Satuan</th>
                                    <th>Harga Umum</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" onclick="batal_beli()">Tutup</button>
                    </div>
                </div>

            </div>
        </div>

        <!-- Modal -->
        <div class="modal animated" id="order_quantity" role="dialog">
            <div class="modal-dialog" style="width: 70%;">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="background: #00bcd4;">
                        <h4 class="modal-title" style="color: white;">MASUKKAN JUMLAH BELI</h4>
                    </div>

                    <div class="modal-body">
                        <table style="width: 90%; margin-left:auto; margin-right:auto">
                            <thead>
                                <tr>
                                    <th class="text-center">Kode Barang</th>
                                    <th>Nama Produk</th>
                                    <th class="text-center">Stok Tersedia</th>
                                    <th class="text-center">Satuan</th>
                                    <th>Harga Umum</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="result"></tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4">
                                    </td>
                                    <td>
                                        <label style="margin-top: 10px;margin-bottom: 10px;">Jumlah Beli</label>
                                        <input type="number" id="qty" name="qty" style="height: 40px; width: 150px; font-size: larger; background:#f4f7f9;" value="1" required="true" class="form-control">

                                        <input type="hidden" class="form-control" id="qty_update" name="qty_update" value="0">

                                        <input type="hidden" class="form-control" id="selling_type" name="selling_type" value="umum">

                                    </td>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" id="out" class="btn btn-danger" onclick="batal_beli()">Batal</button>
                        <button type="button" onclick="masukkan()" class="btn btn-primary"><i class="fa fa-save"></i> Masukkan</button>
                    </div>

                </div>

            </div>
        </div>

        <div class="modal animated" id="modal_edit" role="dialog">
            <div class="modal-dialog" style="width: 70%;">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="background: #00bcd4;">
                        <h4 class="modal-title" style="color: white;">EDIT JUMLAH BELI?</h4>
                    </div>

                    <div class="modal-body">
                        <table style="width: 90%; margin-left:auto; margin-right:auto">
                            <thead>
                                <tr>
                                    <th class="text-center">Kode Barang</th>
                                    <th>Nama Produk</th>
                                    <th class="text-center">Jumlah Beli</th>
                                    <th class="text-center">Satuan</th>
                                    <th>Harga Umum</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="get_cart"></tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5">
                                    </td>
                                    <td>
                                        <label style="margin-top: 10px;margin-bottom: 10px;">Jumlah Beli</label>
                                        <input type="number" id="qty_edit" name="qty_edit" style="height: 40px; width: 150px; font-size: larger; background:#f4f7f9;" value="1" required="true" class="form-control">

                                        <input type="hidden" class="form-control" id="selling_type" name="selling_type" value="umum">
                                    </td>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" id="out" class="btn btn-danger" onclick="batal_beli()">Batal</button>
                        <button type="submit" id="iya_edit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    </div>

                </div>

            </div>
        </div>

        <div class="modal animated" id="modal-hapus" role="dialog">
            <div class="modal-dialog" style="width: 70%;">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="background: #00bcd4;">
                        <h4 class="modal-title" style="color: white;">HAPUS PRODUK DARI KERANJANG?</h4>
                    </div>

                    <div class="modal-body">
                        <table style="width: 90%; margin-left:auto; margin-right:auto">
                            <thead>
                                <tr>
                                    <th class="text-center">Kode Barang</th>
                                    <th>Nama Produk</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-center">Satuan</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="data-cart"></tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" id="out" class="btn btn-danger" onclick="batal_beli()">Tidak</button>
                        <span id="btn"></span>
                    </div>

                </div>

            </div>
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
    var table

    $(document).ready(function() {


        $('#dibayar, input[name="amount"]').maskMoney({
            prefix: '',
            allowNegative: false,
            thousands: ',',
            affixesStay: false,
            precision: 0
        })

        //datatables
        table = $('#table').DataTable({

            "processing": true,
            "scrollCollapse": true,
            "ordering": false,
            "serverSide": true,
            "info": false,
            "bInfo": false,
            "bLengthChange": false,
            "searching": false,
            "responsive": true,

            "ajax": {
                "url": "<?php echo site_url('administrator/transaksi_umum/data_transaksi') ?>",
                "type": "POST"
            },
        })

        $('#table_produk').DataTable({
            "info": false,
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": {
                "url": "<?php echo site_url('administrator/transaksi_umum/data_produk') ?>",
                "type": "POST"
            },
        })

    })


    function reload_table() {
        table.ajax.reload()
    }



    $.ajax({
        url: "<?php echo site_url('administrator/transaksi_umum/get_total/') ?>",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('#total-atas').html(data.total)
            $('#total-bawah').html(data.total)
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Gagal!')
        }
    })

    function reload_total() {
        $.ajax({
            url: "<?php echo site_url('administrator/transaksi_umum/get_total/') ?>",
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('#total-atas').html(data.total)
                $('#total-bawah').html(data.total)
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Gagal!')
            }
        })
    }


    function cari_produk() {
        $('#cari_produk').modal('show')
    }

    function add_cart_cari(id) {
        $.ajax({
            url: "<?php echo site_url('administrator/transaksi_umum/get_data/') ?>" + id,
            type: 'GET',
            dataType: 'JSON',
            cache: false,
            success: function(obj) {

                var kode_barang = $('#kode_barang').val(id)
                $('#order_quantity').modal('show')
                $('#modal-trans').modal('hide')
                $('#cari_produk').modal('hide')
                $('#result').html(
                    '<td class="text-center">' + obj.result.ID_produk + '</td>' +
                    '<td>' + obj.result.nama_produk + '</td>' +
                    '<td class="text-center">' + obj.result.stok + '</td>' +
                    '<td class="text-center">' + obj.result.satuan + '</td>' +
                    '<td>' + obj.result.harga_umum + '</td>'
                )

                $('#qty').focus()
            }
        })
    }

    function masukkan() {
        var id = $('#kode_barang').val()

        var sell_type = $('#' + id).data("kodeproduk")
        var kode_produk = $('#' + id).data("kodeproduk")
        var nama_produk = $('#' + id).data("namaproduk")
        var harga_umum = $('#' + id).data("hargaumum")
        var satuan = $('#' + id).data("satuan")
        var quantity = $('#qty').val()
        var customer = $('#selling_type').val()

        $.ajax({
            url: "<?php echo site_url('administrator/transaksi_umum/tambah/') ?>" + id,
            type: 'POST',
            data: {
                sell_type: sell_type,
                ID_produk: kode_produk,
                nama_produk: nama_produk,
                harga_umum: harga_umum,
                quantity: quantity,
                satuan: satuan,
                customer: customer,
            },

            dataType: 'JSON',
            success: function(ok) {
                if (ok.status == true) {
                    reload_table()
                    reload_total()
                    $('#order_quantity').modal('hide')
                    document.getElementById('form_order').reset()
                    document.getElementById('kode_barang').focus()
                } else {
                    $.notify("Gagal! \n" + ok.message, "error")
                    $('#qty').focus()
                }
            },

            error: function(jqXHR, textStatus, errorThrown) {
                alert("gagal")
            }
        })
    }

    function update_cart(id, produk_id) {
        $.ajax({
            url: "<?php echo site_url('administrator/transaksi_umum/get_cart/') ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(obj) {
                $('#modal_edit').modal('show');
                $('#get_cart').html(
                    '<td class="text-center">' + obj.result.produk_id + '</td>' +
                    '<td>' + obj.result.nama_produk + '</td>' +
                    '<td class="text-center">' + obj.result.qty + '</td>' +
                    '<td class="text-center">' + obj.result.satuan + '</td>' +
                    '<td>' + obj.result.price + '</td>' +
                    '<td>' + obj.result.total + '</td>'
                )
                $('#qty_edit').val(obj.result.qty)
                $('#qty_edit').focus()
            },

            error: function(jqXHR, textStatus, errorThrown) {
                alert("gagal")
            }
        })

        $('#iya_edit').click(function() {
            var quantity = $('#qty_edit').val()
            $.ajax({
                url: "<?php echo site_url('administrator/transaksi_umum/update_cart/') ?>" + produk_id,
                method: "POST",
                data: {
                    row_id: id,
                    quantity: quantity
                },
                dataType: "JSON",
                success: function(ok) {
                    if (ok.status) {
                        $('#modal_edit').modal('hide')
                        reload_table()
                        reload_total()
                        document.getElementById('form_order').reset()
                        document.getElementById('kode_barang').focus()
                    } else {
                        $.notify("Gagal! \n" + ok.message, "error")
                        $('#qty_edit').focus()
                    }
                }
            })
        })
    }

    function hapus_cart(id, produk_id) {
        $.ajax({
            url: "<?php echo site_url('administrator/transaksi_umum/get_cart/') ?>" + id,
            type: 'GET',
            dataType: 'JSON',
            cache: false,
            success: function(obj) {
                $('#modal-hapus').modal('show')
                $('#data-cart').html(
                    '<td class="text-center">' + obj.result.produk_id + '</td>' +
                    '<td>' + obj.result.nama_produk + '</td>' +
                    '<td class="text-center">' + obj.result.qty + '</td>' +
                    '<td class="text-center">' + obj.result.satuan + '</td>' +
                    '<td>' + obj.result.price + '</td>' +
                    '<td>' + obj.result.total + '</td>'
                )
            },

            error: function(jqXHR, textStatus, errorThrown) {
                alert("gagal")
            }
        })

        $('#btn').html('<button type="button" id="iya_hapus" class="btn btn-success">Iya</button>')

        $('#iya_hapus').click(function() {

            $.ajax({
                url: "<?php echo site_url('administrator/transaksi_umum/hapus_cart') ?>",
                method: "POST",
                data: {
                    row_id: id
                },
                dataType: "JSON",
                success: function() {
                    $('#modal-hapus').modal('hide')
                    reload_table()
                    reload_total()
                    document.getElementById('form_order').reset()
                    document.getElementById('kode_barang').focus()
                }
            })

        })

    }

    $('#dibayar').on('change keyup', function() {

        if ($(this).val().length >= 4) {
            $.ajax({
                url: "<?php echo site_url('administrator/transaksi_umum/hitung/') ?>" + ($(this).val().replace(/[^\d]/g, '')),
                dataType: "JSON",
                beforeSend: function() {
                    $('#kembali').html('<i class="fa fa-spinner fa-spin"></i> Sedang menghitung..')
                },
                success: function(obj) {
                    if (obj.status == true) {
                        $('#kembali').html('Rp. ' + obj.kembali)
                        return false
                    } else {
                        $('#kembali').html("Uang tidak mencukupi!")
                    }
                }
            })
        }
    })

    function button_selesai() {

        //

        
        var bayar = $('#dibayar').val()
        if (bayar == 0) {
            $.notify("Gagal! \nHarap isi terlebih dahulu kolom pada \npembayaran untuk menyimpan transaksi \ndan mencetak stock.", "error")
            document.getElementById('dibayar').focus()
        } else {
            $.ajax({
                url: "<?php echo site_url('administrator/transaksi_umum/tambah_transaksi') ?>",
                type: "POST",
                data: {
                    bayar: bayar
                },
                dataType: "JSON",
                success: function(obj) {
                    if (obj.status == true) {
                        $.notify("Sukses! \nPembayaran berhasil \ndan akan mencetak faktur.", "success")
                        popup(obj.id_transaksi)
                    } else {
                        $.notify("Gagal! \nHarap isi terlebih dahulu kolom pada \npembayaran untuk menyimpan transaksi \ndan mencetak stock.", "error")
                    }
                }
            })

        }

    }

    function popup(id) {
        newwindow = window.open("<?php echo site_url('administrator/transaksi_umum/print_transaction/') ?>" + id + '?print=yes', 'name', 'height=600,width=800')

        if (window.focus) {
            newwindow.focus()
        }
        window.location.assign("<?php echo site_url('administrator/transaksi_umum') ?>")

        return false
    }

    function batal_beli() {
        $('#order_quantity').modal('hide')
        $('#modal-hapus').modal('hide')
        $('#modal_edit').modal('hide')
        $('#modal-trans').modal('hide')
        $('#cari_produk').modal('hide')
        document.getElementById('form_order').reset()
        document.getElementById('kode_barang').focus()
    }
</script>