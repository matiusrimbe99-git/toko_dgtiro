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
                        <div class="form-title">
                            <button onclick="tambah_kategori()" style="width: 250px; " class="btn btn-lg btn-primary btn-block">+ Tambah Data Kategori</button>
                        </div>

                        <div class="form-body">
                            <div class="agile-tables">
                                <div class="w3l-table-info">
                                    <table style="padding-top: 20px;" id="table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th class="text-center">Nama Kategori</th>
                                                <th class="text-center">Jumlah Produk</th>
                                                <th>Aksi</th>
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
                        <input type="hidden" value="" name="id_kategori" />
                        <div class="forms">
                            <div class="form-three widget-shadow">
                                <div data-example-id="form-validation-states-with-icons">
                                    <div class="form-group has-success has-feedback">
                                        <label class="control-label" for="inputSuccess2">Nama Kategori</label>
                                        <input type="text" class="form-control" name="kategori" id="kategori" aria-describedby="inputSuccess2Status">
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
                "order": [],

                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('kasir/kategori/data_kategori') ?>",
                    "type": "POST"
                },

                //Set column definition initialisation properties.
                "columnDefs": [{
                    "targets": [-1],
                    "orderable": false,
                }, ],
            })
        })

        function tambah_kategori() {
            save_method = 'add';
            $('#form_data')[0].reset() // reset form on modals
            $('.form-group').removeClass('has-error') // clear error class
            $('.help-block').empty() // clear error string
            $('#myModal').modal('show') // show bootstrap modal
            $('.modal-title').text('FORM TAMBAH KATEGORI') // Set Title to Bootstrap modal title
        }

        function reload_table() {
            table.ajax.reload(null, false) //reload datatable ajax 
        }

        function save() {
            $('#btnSave').text('saving...') //change button text
            $('#btnSave').attr('disabled', true) //set button disable 
            var url;

            if (save_method == 'add') {
                url = "<?php echo site_url('kasir/kategori/tambah') ?>"
            } else {
                url = "<?php echo site_url('kasir/kategori/update') ?>"
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
                    alert('Error adding / update data')
                    $('#btnSave').text('save'); //change button text
                    $('#btnSave').attr('disabled', false) //set button enable 

                }
            })
        }

        function edit_kategori(id) {
            save_method = 'update';
            $('#form_data')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string

            //Ajax Load data from ajax
            $.ajax({
                url: "<?php echo site_url('kasir/kategori/edit/') ?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {

                    $('[name="id_kategori"]').val(data.id_kategori);
                    $('[name="kategori"]').val(data.kategori);
                    $('#myModal').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('FORM EDIT KATEGORI'); // Set title to Bootstrap modal title

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        }

        function hapus_kategori(id) {
            if (confirm('Apakah Anda yakin menghapus data?')) {
                // ajax delete data to database
                $.ajax({
                    url: "<?php echo site_url('kasir/kategori/hapus') ?>/" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data) {
                        //if success reload ajax table
                        $('#myModal').modal('hide');
                        reload_table();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error deleting data');
                    }
                });

            }
        }
    </script>