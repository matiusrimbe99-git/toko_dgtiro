<div class="main-grid">
    <div class="agile-grids">
        <!-- input-forms -->
        <div class="grids">
            <div class=""></div>
            <div class="input-info">
                <h3 style="color:#00bcd4;"><b>Data Produk</b></h3>
            </div>
            <div class="panel panel-widget forms-panel">
                <div class="forms">
                    <div class="form-grids widget-shadow" data-example-id="basic-forms">


                        <div class="form-body">
                            <div class="agile-tables">
                                <div class="w3l-table-info">
                                    <table style="padding-top: 20px;" id="table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th class="text-center">Kode Produk</th>
                                                <th>Nama</th>
                                                <th class="text-center">Stok</th>
                                                <th class="text-center">Satuan</th>
                                                <th class="text-center">Kategori</th>
                                                <th>Harga Beli</th>
                                                <th>Harga Umum</th>
                                                <th>Harga Langganan</th>
                                                <th class="text-center text-nowrap">Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog" style="width: 40%;">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="background: #00bcd4;">
                        <h4 class="modal-title" style="color: white;">FORM TAMBAH KATEGORI</h4>
                    </div>
                    <form id="form_data">
                        <input type="hidden" value="" name="id_produk" />
                        <div class="forms">
                            <div class="form-three widget-shadow">
                                <div>
                                    <div class="form-group has-success has-feedback">
                                        <label class="control-label">Nama Produk</label>
                                        <input type="text" class="form-control" name="nama_produk" id="nama_produk" readonly>
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-group has-success has-feedback">
                                        <label class="control-label" for="inputSuccess2">Kode Produk</label>
                                        <input type="text" class="form-control" name="kode_produk" id="kode_produk" aria-describedby="inputSuccess2Status" readonly>
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-group has-success has-feedback">
                                        <label class="control-label" for="inputSuccess2">Satuan</label>
                                        <input type="text" class="form-control" name="satuan" id="satuan" aria-describedby="inputSuccess2Status" readonly>
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-group has-success has-feedback">
                                        <label class="control-label" for="inputSuccess2">Kategori</label>
                                        <select name="id_kategori" id="selector1" class="form-control" placeholder="Satuan">
                                            <option disabled selected>--Pilih Kategori--</option>
                                            <?php foreach ($categories as $kategori) : ?>
                                                <option value="<?php echo $kategori['id_kategori']; ?>"><?php echo $kategori['kategori']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-group has-success has-feedback">
                                        <label class="control-label" for="inputSuccess2">Jumlah Stok</label>
                                        <input type="number" class="form-control" name="stok" id="stok" aria-describedby="inputSuccess2Status">
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-group has-success has-feedback">
                                        <label class="control-label" for="inputSuccess2">Harga Beli</label>
                                        <input type="number" class="form-control" name="harga_beli" id="harga_beli" aria-describedby="inputSuccess2Status" readonly>
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-group has-success has-feedback">
                                        <label class="control-label" for="inputSuccess2">Harga Jual Umum</label>
                                        <input type="number" class="form-control" name="harga_umum" id="harga_umum" aria-describedby="inputSuccess2Status" readonly>
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-group has-success has-feedback">
                                        <label class="control-label" for="inputSuccess2">Harga Jual Langganan</label>
                                        <input type="number" class="form-control" name="harga_langganan" id="harga_langganan" aria-describedby="inputSuccess2Status" readonly>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" id="btnSave" onclick="save()" class="btn btn-lg btn-primary" id="btn_simpan"><i class="fa fa-save"></i> Simpan</button>
                        <button type="button" class="btn btn-lg btn-danger" data-dismiss="modal">Batal</button>
                    </div>

                </div>
            </div>

        </div>
    </div>


    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.dataTables.min.js') ?> "></script>

    <script type="text/javascript">
        var save_method //for save method string
        var table

        $(document).ready(function() {

            //datatables
            table = $('#table').DataTable({

                "processing": true,
                "serverSide": true,
                "ordering": false,
                "order": [],

                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('kasir/produk/data_produk') ?>",
                    "type": "POST"
                },

                //Set column definition initialisation properties.
                "columnDefs": [{
                    "targets": [-1],
                    "orderable": false,
                }, ],
            })
        })

        function tambah_produk() {
            save_method = 'add';
            $('#form_data')[0].reset() // reset form on modals
            $('.form-group').removeClass('has-error') // clear error class
            $('.help-block').empty() // clear error string
            $('#myModal').modal('show') // show bootstrap modal
            $('.modal-title').text('FORM TAMBAH PRODUK') // Set Title to Bootstrap modal title
            $('#nama_produk').attr('required')
        }

        function reload_table() {
            table.ajax.reload(null, false) //reload datatable ajax 
        }

        function save() {
            $('#btnSave').text('saving...') //change button text
            $('#btnSave').attr('disabled', true) //set button disable 
            var url;

            if (save_method == 'add') {
                url = "<?php echo site_url('kasir/produk/tambah') ?>"
            } else {
                url = "<?php echo site_url('kasir/produk/update') ?>"
            }

            // ajax adding data to database
            $.ajax({
                url: url,
                type: "POST",
                data: $('#form_data').serialize(),
                dataType: "JSON",
                success: function(data) {

                    if (data.status) //if success close modal and reload ajax table
                    {
                        $('#myModal').modal('hide')
                        reload_table()
                    }

                    $('#btnSave').text('save') //change button text
                    $('#btnSave').attr('disabled', false) //set button enable 


                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Gagal menambahkan / mengubah data')
                    $('#btnSave').text('save'); //change button text
                    $('#btnSave').attr('disabled', false) //set button enable 

                }
            })
        }

        function edit_produk(id) {
            save_method = 'update'
            $('#form_data')[0].reset() // reset form on modals
            $('.form-group').removeClass('has-error') // clear error class
            $('.help-block').empty() // clear error string

            //Ajax Load data from ajax
            $.ajax({
                url: "<?php echo site_url('kasir/produk/edit') ?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {

                    $('[name="id_produk"]').val(data.id_produk);
                    $('[name="nama_produk"]').val(data.nama_produk);
                    $('[name="kode_produk"]').val(data.kode_produk);
                    $('[name="satuan"]').val(data.satuan);
                    $('[name="id_kategori"]').val(data.id_kategori);
                    $('[name="stok"]').val(data.stok);
                    $('[name="harga_beli"]').val(data.harga_beli);
                    $('[name="harga_umum"]').val(data.harga_umum);
                    $('[name="harga_langganan"]').val(data.harga_langganan);
                    $('#myModal').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('FORM EDIT PRODUK'); // Set title to Bootstrap modal title

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        }

    </script>