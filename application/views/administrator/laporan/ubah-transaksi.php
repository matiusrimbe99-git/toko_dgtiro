<div class="main-grid">
    <div class="agile-grids">
        <!-- input-forms -->
        <div class="grids">
            <div class="input-info">
                <h3 style="color:#00bcd4;">Ubah Data Transaksi</h3>
            </div>
            <div style="background-color: white;" class="card-body">
                <table style="height: 60px;">
                    <tr>
                        <td style="width: 30%; ">
                            <form id="form_order" onsubmit="return order_produk()" method="post">
                                <input type="text" id="kode_barang" name="search" style="height: 40px; font-size: larger; background:#f4f7f9;" class="form-control" autofocus>
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
                        <table style="margin-top:10px;" id="table-update-transaction" data-id="<?php echo $transaksi->id_transaksi ?>" data-selling="<?php echo $transaksi->selling_type; ?>">
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
                                            <a href="<?php echo site_url('administrator/transaksi_umum/print_transaction/' . $transaksi->id_transaksi) ?>" target="_blank" class="btn btn-app btn-print btn-danger"><i class="fa fa-print"></i> Cetak Ulang Nota</a>
                                        </div>
                                    </td>
                                    <td style="width: 12%;">
                                        <h4>Tunai</h4>
                                    </td>
                                    <td class="text-center" width="20px">
                                        <h4>:</h4>
                                    </td>
                                    <td>
                                        <input type="text" id="dibayar" name="bayar" style="height: 40px; font-size: larger; background:#f4f7f9;" value="<?php echo $transaksi->paid ?>" placeholder="Dibayar..." required="true" class="form-control">
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
                                    <th>Harga Produk</th>
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

                                        <input type="hidden" class="form-control" name="transaction" value="<?php echo $transaksi->id_transaksi; ?>">

                                        <input type="hidden" class="form-control" id="qty_update" name="qty_update" value="0">

                                        <input type="hidden" class="form-control" id="selling_type" name="selling_type" value="<?php echo $transaksi->selling_type; ?>">

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

                                        <input type="hidden" class="form-control" id="selling_type" name="selling_type" value="<?php echo $transaksi->selling_type; ?>">
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
    var table, table2;

    $(document).ready(function() {

        $(".btn-print").printPage();


        $('#dibayar, input[name="amount"]').maskMoney({
            prefix: '',
            allowNegative: false,
            thousands: ',',
            affixesStay: false,
            precision: 0
        })

        //datatables
        table = $('#table-update-transaction').DataTable({

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
                "url": "<?php echo site_url('administrator/data_transaksi/getdataupdate/') ?>" + $('#table-update-transaction').data('id'),
                "type": "POST"
            },
        })

        table2 = $('#table_produk').DataTable({
            "info": false,
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": {
                "url": "<?php echo site_url('administrator/data_transaksi/data_produk/') ?>" + $('#table-update-transaction').data('selling'),
                "type": "POST"
            },
        })

    })

    window.batal_beli = function() {
        $('#order_quantity').modal('hide')
        $('#modal-hapus').modal('hide')
        $('#modal_edit').modal('hide')
        $('#modal-trans').modal('hide')
        $('#cari_produk').modal('hide')
        document.getElementById('form_order').reset()
        document.getElementById('kode_barang').focus()
    }

    window.add_cart_cari = function(id) {
        if ($('#table-update-transaction').data('selling') == "umum") {
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
        } else {
            $.ajax({
                url: "<?php echo site_url('administrator/transaksi_langganan/get_data/') ?>" + id,
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
                        '<td>' + obj.result.harga_langganan + '</td>'
                    )

                    $('#qty').focus()
                }
            })
        }
    }


    function order_produk() {
        return false
    }

    $('#kode_barang').on('change', function() {
        if ($(this).val().length > 5) {
            if ($('#table-update-transaction').data('selling') == "umum") {
                $.ajax({
                    url: "<?php echo site_url('administrator/transaksi_umum/get_data/') ?>" + $(this).val(),
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(obj) {
                        if (obj.status == true) {
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


                            if (obj.result.stok == 0) {
                                $('#order_quantity').modal('hide')
                                $.notify("PERHATIAN! \nStok tidak tersedia.", "error")
                                document.getElementById('form_order').reset()
                                document.getElementById('kode_barang').focus()
                                $('#qty').focus()
                            }

                            $('#qty').focus()
                        } else {
                            $.notify("Gagal! \nData tidak tersedia.\nMohon lakukan pengentrian data produk \nyang belum tersedia.", "error")
                            document.getElementById('form_order').reset()
                            document.getElementById('kode_barang').focus()
                            $('#qty').focus()
                        }
                    }
                })
            } else {
                $.ajax({
                    url: "<?php echo site_url('administrator/transaksi_langganan/get_data/') ?>" + $(this).val(),
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(obj) {
                        if (obj.status == true) {
                            $('#order_quantity').modal('show')
                            $('#modal-trans').modal('hide')
                            $('#cari_produk').modal('hide')
                            $('#result').html(
                                '<td class="text-center">' + obj.result.ID_produk + '</td>' +
                                '<td>' + obj.result.nama_produk + '</td>' +
                                '<td class="text-center">' + obj.result.stok + '</td>' +
                                '<td class="text-center">' + obj.result.satuan + '</td>' +
                                '<td>' + obj.result.harga_langganan + '</td>'
                            )


                            if (obj.result.stok == 0) {
                                $('#order_quantity').modal('hide')
                                $.notify("PERHATIAN! \nStok tidak tersedia.", "error")
                                document.getElementById('form_order').reset()
                                document.getElementById('kode_barang').focus()
                                $('#qty').focus()
                            }

                            $('#qty').focus()
                        } else {
                            $.notify("Gagal! \nData tidak tersedia.\nMohon lakukan pengentrian data produk \nyang belum tersedia.", "error")
                            document.getElementById('form_order').reset()
                            document.getElementById('kode_barang').focus()
                            $('#qty').focus()
                        }
                    }
                })
            }
        }
    })


    $("#qty").keyup(function(event) {
        if (event.keyCode === 13) {
            masukkan()
        }
    })


    function cari_produk() {
        $('#cari_produk').modal('show')
    }



    function masukkan() {
        var id = $('#kode_barang').val()
        var sell_type = $('#' + id).data("kodeproduk")
        var kode_produk = $('#' + id).data("kodeproduk")
        var nama_produk = $('#' + id).data("namaproduk")
        var harga_umum = $('#' + id).data("hargaumum")
        var harga_langganan = $('#' + id).data("hargalangganan")
        var satuan = $('#' + id).data("satuan")
        var quantity = $('#qty').val()
        var customer = $('#selling_type').val()

        $.ajax({
            url: "<?php echo site_url('administrator/data_transaksi/addedcart/') ?>" + id,
            type: 'POST',
            data: {
                transaction: $('#table-update-transaction').data('id'),
                sell_type: sell_type,
                ID_produk: kode_produk,
                nama_produk: nama_produk,
                harga_umum: harga_umum,
                harga_langganan: harga_langganan,
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


    window.reload_table = function() {
        table.ajax.reload()
        table2.ajax.reload()

        $.ajax({
            url: "<?php echo site_url('administrator/data_transaksi/hitung/') ?>" + ($('#dibayar').val().replace(/[^\d]/g, '')),
            method: "POST",
            data: {
                transaction: $('#table-update-transaction').data('id')
            },
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

    $.ajax({
        url: "<?php echo site_url('administrator/data_transaksi/get_total/') ?>",
        type: "POST",
        data: {
            transaction: $('#table-update-transaction').data('id')
        },
        dataType: "JSON",
        success: function(data) {
            $('#total-atas').html(data.total)
            $('#total-bawah').html(data.total)
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Gagal!')
        }
    })

    window.reload_total = function() {
        $.ajax({
            url: "<?php echo site_url('administrator/data_transaksi/get_total/') ?>",
            type: "POST",
            data: {
                transaction: $('#table-update-transaction').data('id')
            },
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

    $('#dibayar').on('change keyup', function() {

        if ($(this).val().length >= 4) {
            $.ajax({
                url: "<?php echo site_url('administrator/data_transaksi/hitung/') ?>" + ($(this).val().replace(/[^\d]/g, '')),
                method: "POST",
                data: {
                    transaction: $('#table-update-transaction').data('id')
                },
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


    function update_cart(id_transaksi, kode_produk) {
        $.ajax({
            url: "<?php echo site_url('administrator/data_transaksi/get_cart/') ?>" + kode_produk + '/code',
            type: "GET",
            dataType: "JSON",
            success: function(obj) {
                $('#modal_edit').modal('show');
                $('#get_cart').html(
                    '<td class="text-center">' + obj.result.ID_produk + '</td>' +
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
            var qty = $('#qty_edit').val()
            $.ajax({
                url: "<?php echo site_url('administrator/data_transaksi/updatecart/') ?>" + kode_produk + '/' + $('#table-update-transaction').data('selling'),
                method: "POST",
                data: {
                    qty: qty
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

    function hapus_cart(produk, produk_id) {
        $.ajax({
            url: "<?php echo site_url('administrator/data_transaksi/get_cart/') ?>" + produk,
            type: 'GET',
            dataType: 'JSON',
            cache: false,
            success: function(obj) {
                $('#modal-hapus').modal('show')
                $('#data-cart').html(
                    '<td class="text-center">' + obj.result.ID_produk + '</td>' +
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
                url: "<?php echo site_url('administrator/data_transaksi/delete_item/') ?>" + produk,
                method: "GET",
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
</script>