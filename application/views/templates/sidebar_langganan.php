<body class="dashboard-page">

    <nav class="main-menu" style="background-color: orange;">
        <ul>
            <li>
                <a href="<?php echo base_url('administrator/dashboard') ?>">
                    <i class="fa fa-home nav_icon"></i>
                    <span class="nav-text">
                        Dashboard
                    </span>
                </a>
            </li>
            <li class="has-subnav">
                <a href="javascript:;">
                    <i class="fa fa-cubes nav_icon" aria-hidden="true"></i>
                    <span class="nav-text">
                        Transaksi
                    </span>
                    <i class="icon-angle-right"></i><i class="icon-angle-down"></i>
                </a>
                <ul>
                    <li>
                        <a class="subnav-text" href="<?php echo base_url('administrator/transaksi_umum') ?>">
                            Umum
                        </a>
                    </li>
                    <li>
                        <a class="subnav-text" href="<?php echo base_url('administrator/transaksi_langganan') ?>">
                            Langganan
                        </a>
                    </li>
                </ul>
            </li>
            <!-- <li>
                <a href="<?php echo base_url('administrator/cek_harga') ?>">
                    <i class="fas fa-search nav_icon"></i>
                    <span class="nav-text">
                        Cek Harga Barang
                    </span>
                </a>
            </li> -->
            <li class="has-subnav">
                <a href="javascript:;">
                    <i class="fa fa-cubes nav_icon" aria-hidden="true"></i>
                    <span class="nav-text">
                        House Of Product
                    </span>
                    <i class="icon-angle-right"></i><i class="icon-angle-down"></i>
                </a>
                <ul>
                    <li>
                        <a class="subnav-text" href="<?php echo base_url('administrator/produk') ?>">
                            Produk
                        </a>
                    </li>
                    <li>
                        <a class="subnav-text" href="<?php echo base_url('administrator/kategori') ?>">
                            Kategori
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="<?php echo base_url('administrator/data_transaksi') ?>">
                    <i class="fa fa-chart-line nav_icon"></i>
                    <span class="nav-text">
                        Data Transaksi
                    </span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('administrator/data_transaksi/report') ?>">
                    <i class="far fa-file-alt nav_icon"></i>
                    <span class="nav-text">
                        Buat Laporan
                    </span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('administrator/user') ?>">
                    <i class="fa fa-id-card nav_icon"></i>
                    <span class="nav-text">
                        Data Pengguna
                    </span>
                </a>
            </li>
        </ul>
    </nav>