<div class="main-grid">
    <div class="agile-grids">
        <!-- input-forms -->
        <div class="grids">
            <div class="input-info">
                <h3 style="color:#00bcd4;">Laporan Transaksi Penjualan</h3>
            </div>
            <div style="background-color: #fffdf8;" class="card-body">
                <table style="height: 60px;">
                    <tr>
                        <td style="width: 25%;"></td>
                        <td style="width: 25%;"></td>
                        <td style="width: 25%;"></td>
                        <td class="text-center" style="width: 25%; padding-right:0px">
                            Tanggal : <strong><?php echo date('d, M Y') ?></strong>
                        </td>
                    </tr>
                </table>
                <table style="height: 60px; margin-top:5px;">
                    <form action="">
                        <tr>
                            <td style="width: 15%;">
                                <label>Per Halaman :</label>
                                <div class="input-group">
                                    <select type="text" style="width:200%" class="form-control" name="per_page" required="required">
                                        <?php $value = 0;
                                        while ($value < 100) : ?>
                                            <option value="<?php echo $value += 20; ?>" <?php if ($this->per_page == $value) echo 'selected'; ?>><?php echo $value; ?></option>
                                        <?php endwhile; ?>

                                    </select>
                                </div>
                            </td>
                            <td style="width: 25%;">
                                <label>Dari Tanggal :</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="date" class="form-control pull-right" name="from" id="tgl-dari" value="<?php echo (!$this->input->get('from')) ? date('Y-m-d') : $this->input->get('from') ?>">
                                </div>
                            </td>
                            <td style="width: 25%;">
                                <label>Sampai Tanggal :</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="date" class="form-control pull-right" name="to" id="tgl-sampai" value="<?php echo (!$this->input->get('to')) ? date('Y-m-d') : $this->input->get('to') ?>">
                                </div>
                            </td>
                            <td style="width: 15%;">
                                <label>Kasir :</label>
                                <select class="form-control" name="kasir" required>
                                    <option value="">~ PILIH ~</option>
                                    <?php foreach ($this->db->get('user')->result() as $row) : ?>
                                        <option value="<?php echo $row->id; ?>" <?php echo ($row->id == $this->input->get('kasir')) ? 'selected' : ''; ?>><?php echo $row->nama; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>

                            <td style="width: 25%;">
                                <button type="submit" title="Filter" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                <?php if ($this->input->get('from') != '') : ?>
                                    <a title="Cetak" href="<?php echo base_url("kasir/data_transaksi/cetaklaporan?from={$this->input->get('from')}&to={$this->input->get('to')}&kasir={$this->input->get('kasir')}") ?>" class="btn btn-success top" target="_blank"><i class="fa fa-print"></i></a>
                                <?php endif; ?>
                                <a title="Reset" href="<?php echo site_url('kasir/data_transaksi/report') ?>" class="btn btn-danger left"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    </form>
                </table>

                <div class="agile-tables">
                    <div style="padding: 12px 12px;" class="w3l-table-info">
                        <table style="margin-top:10px;" id="table">
                            <thead>
                                <tr>
                                    <th style="width:30px" class="text-center">No</th>
                                    <th class="text-center">No. Transaksi</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Tipe Penjualan</th>
                                    <th class="text-center">Nama Kasir</th>
                                    <th class="text-nowrap">Total Transaksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $subtotal = 0;
                                foreach ($transaksi as $row) :

                                    $date = new DateTime($row->date);

                                    $subtotal += $row->total;
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo ++$this->page ?>.</td>
                                        <td class="text-center"><?php echo $row->id_transaksi ?></td>
                                        <td class="text-center"><?php echo $date->format('d F Y - H:i A'); ?></td>
                                        <td class="text-center"><?php echo ($row->selling_type == 'default') ? 'Umum' : 'Grosir'; ?></td>
                                        <td class="text-center"><?php echo $row->nama ?></td>
                                        <td class="text-nowrap">Rp. <?php echo number_format($row->total) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot class="mini-font">
                                <tr>
                                    <td colspan="5"><span class="pull-right">
                                            <h4>Total :</h4>
                                        </span></td>
                                    <td colspan="2" class="text-success">
                                        <h4>Rp. <?php echo number_format($subtotal) ?></h4>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                    <div class="text-center">
                        <?php echo $this->pagination->create_links(); ?>
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
<script type="text/javascript" src="<?php echo base_url('assets/plugins/daterangepicker/moment.min.js') ?> "></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/daterangepicker/daterangepicker.js') ?> "></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.printPage.js') ?> "></script>


<script>
    $(document).ready(function(argument) {
        $(".btn-print").printPage();

        $('button.delete-transaksi').on('click', function() {
            var ID = $(this).data('id');
            window.location.href = "<?php echo site_url('kasir/data_transaksi/delete_transaksi/') ?>" + ID;
        });

        $('#tgl-dari').daterangepicker({
            singleDatePicker: true,
            format: 'YYYY-MM-DD',
        });
        $('#tgl-sampai').daterangepicker({
            singleDatePicker: true,
            format: 'YYYY-MM-DD',
        });
    })
</script>