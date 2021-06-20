<!DOCTYPE html>

<head>
    <title><?php echo $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Colored Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>

    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
    <link href="<?php echo base_url('assets/css/style.css') ?>" rel='stylesheet' type='text/css' />
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/font.css') ?>" type="text/css" />
    <link href="<?php echo base_url('assets/css/font-awesome.css') ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/jquery.dataTables.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/validation/css/formValidation.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/daterangepicker/daterangepicker-bs3.css') ?>">


    <script src="<?php echo base_url('assets/js/jQuery-2.1.4.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?> "></script>
    <script src="<?php echo base_url('assets/js/modernizr.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.cookie.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/screenfull.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/icons.js') ?>"></script>
    <script>
        $(function() {
            $('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

            if (!screenfull.enabled) {
                return false;
            }



            $('#toggle').click(function() {
                screenfull.toggle($('#container')[0]);
            });
        });
    </script>

    <!-- tables -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/table-style.css') ?> " />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/basictable.css') ?>" />
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.basictable.min.js') ?> "></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table').basictable()
        })
    </script>
    <!-- //tables -->

</head>