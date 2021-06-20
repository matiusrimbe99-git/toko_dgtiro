<div class="main-grid">
    <div class="agile-grids">
        <!-- input-forms -->
        <div class="grids">
            <div class=""></div>
            <div class="input-info">
                <h3 style="color:#00bcd4;"><b>Data User</b></h3>
            </div>
            <div class="panel panel-widget forms-panel">
                <div class="forms">
                    <div class="form-grids widget-shadow" data-example-id="basic-forms">
                        <div class="form-title">
                            <button onclick="tambah_user()" style="width: 250px; " class="btn btn-lg btn-primary btn-block">+ Tambah Data user</button>
                        </div>

                        <div class="form-body">
                            <div class="agile-tables">
                                <div class="w3l-table-info">
                                    <table style="padding-top: 20px;" id="table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th class="text-center">Nama</th>
                                                <th class="text-center">Username</th>
                                                <th class="text-center">Telepon</th>
                                                <th class="text-center">Hak Akses</th>
                                                <th class="text-center">Aksi</th>
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
                        <h4 class="modal-title" style="color: white;">FORM TAMBAH USER</h4>
                    </div>
                    <form id="form_data">
                        <input type="hidden" value="" name="id" />
                        <div class="forms">
                            <div class="form-three widget-shadow">
                                <div>
                                    <div class="form-group has-success has-feedback">
                                        <label class="control-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" name="nama" id="nama" required>
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-group has-success has-feedback">
                                        <label class="control-label" for="inputSuccess2">Telepon</label>
                                        <input type="text" class="form-control" name="telepon" id="telepon" aria-describedby="inputSuccess2Status">
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-group has-success has-feedback">
                                        <label class="control-label" for="inputSuccess2">Kata Sandi</label>
                                        <input type="text" class="form-control" name="password" id="password" aria-describedby="inputSuccess2Status">
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-group has-success has-feedback">
                                        <label class="control-label" for="inputSuccess2">Hak Akses</label>
                                        <select name="level" id="selector1" class="form-control" placeholder="Satuan">
                                            <option disabled selected>--Pilih Hak Akses--</option>

                                            <option value="admin">Administrator</option>
                                            <option value="kasir">Kasir</option>

                                        </select>
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
                    "url": "<?php echo site_url('administrator/user/data_user') ?>",
                    "type": "POST"
                },

                //Set column definition initialisation properties.
                "columnDefs": [{
                    "targets": [-1],
                    "orderable": false,
                }, ],
            })
        })

        function tambah_user() {
            save_method = 'add';
            $('#form_data')[0].reset() // reset form on modals
            $('.form-group').removeClass('has-error') // clear error class
            $('.help-block').empty() // clear error string
            $('#myModal').modal('show') // show bootstrap modal
            $('.modal-title').text('FORM TAMBAH USER') // Set Title to Bootstrap modal title
            $('#nama_user').attr('required')
        }

        function reload_table() {
            table.ajax.reload(null, false) //reload datatable ajax 
        }

        function save() {
            $('#btnSave').text('saving...') //change button text
            $('#btnSave').attr('disabled', true) //set button disable 
            var url;

            if (save_method == 'add') {
                url = "<?php echo site_url('administrator/user/tambah') ?>"
            } else {
                url = "<?php echo site_url('administrator/user/update') ?>"
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

        function edit_user(id) {
            save_method = 'update'
            $('#form_data')[0].reset() // reset form on modals
            $('.form-group').removeClass('has-error') // clear error class
            $('.help-block').empty() // clear error string

            //Ajax Load data from ajax
            $.ajax({
                url: "<?php echo site_url('administrator/user/edit') ?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {

                    $('[name="id"]').val(data.id);
                    $('[name="nama"]').val(data.nama);
                    $('[name="telepon"]').val(data.telepon);
                    // $('[name="password"]').val(data.password);
                    $('[name="level"]').val(data.level);
                    $('#myModal').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('FORM EDIT USER'); // Set title to Bootstrap modal title

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        }

        function hapus_user(id) {
            if (confirm('Apakah Anda yakin menghapus data?')) {
                // ajax delete data to database
                $.ajax({
                    url: "<?php echo site_url('administrator/user/hapus') ?>/" + id,
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