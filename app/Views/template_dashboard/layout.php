<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />


    <!-- title website -->
    <title><?= $title; ?></title>

    <!-- Data tables Css -->
    <link href="/assets/css/data-tables.css" rel="stylesheet" />

    <!-- admin template css-->
    <link href="/admin-template/css/styles.css" rel="stylesheet" />

    <!-- Fontawesome -->
    <script src="/assets/js/fontawesome.js" crossorigin="anonymous"></script>

    <!-- jquery -->
    <script src="/assets/js/jquery-v.3.6.0.js"></script>
    <script src="/assets/js/jquery-ui.js"></script>
    <link rel="stylesheet" href="/assets/css/jquery-ui.css">

    <!-- data tables -->
    <script type="text/javascript" charset="utf8" src="/assets/js/jquery-data-tables.js"></script>
    <link rel="stylesheet" type="text/css" href="/assets/css/jquery-data-tables.css">
</head>

<body class="sb-nav-fixed">

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="<?= base_url("Dashboard"); ?>">Zaastore Production</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="<?= base_url("Auth/progress_logout"); ?>">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <?php

                        $role = $_SESSION["role"]; ?>
                        <div class="sb-sidenav-menu-heading">Core</div>

                        <?php if ($role != 3 && $role != 4 && $role != 6 && $role != 7) {
                        ?>
                            <a class="nav-link" href="/dashboard">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                        <?php } ?>


                        <?php if ($role != 4 && $role != 6 && $role != 3 && $role != 7 && $role != 2) {
                        ?>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsgudang" aria-expanded="false" aria-controls="collapseLayoutsgudang">
                                <div class="sb-nav-link-icon"><i class="fas fa-warehouse"></i></div>
                                Gudang
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayoutsgudang" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/warehouse">Stok Bahan</a>
                                    <a class="nav-link" href="/warehouse-transaction">Transaksi Bahan</a>
                                    <a class="nav-link" href="/warehouse-unit">Unit</a>
                                </nav>
                            </div>
                        <?php
                        }; ?>


                        <?php if ($role != 4 && $role != 5 && $role != 7 && $role != 8) {
                        ?>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsorder" aria-expanded="false" aria-controls="collapseLayoutsorder">
                                <div class="sb-nav-link-icon"><i class="fas fa-cart-plus"></i></div>
                                Order
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayoutsorder" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <?php if ($role != 6) {
                                    ?>
                                        <a class="nav-link" href="/add-order">Tambah Order</a>
                                    <?php } ?>
                                    <a class="nav-link" href="/list-order/all-data-by-month">List Order</a>
                                </nav>
                            </div>
                        <?php
                        }; ?>


                        <?php if ($role != 4 && $role != 6 && $role != 3 && $role != 7 && $role != 2 && $role != 8) {
                        ?>
                            <a class="nav-link" href="/assignment">
                                <div class="sb-nav-link-icon"><i class="fas fa-tasks"></i></div>
                                Penugasan
                            </a>
                        <?php
                        }; ?>


                        <?php if ($role != 4 && $role != 6 && $role != 3) {
                        ?>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#status" aria-expanded="false" aria-controls="status">
                                <div class="sb-nav-link-icon"><i class="fas fa-check-square"></i></div>
                                Status
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="status" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">

                                    <?php
                                    if ($role != 8) {
                                    ?>
                                        <a class="nav-link" href="/status-design">Status Print Desain</a>
                                        <?php if ($role != 7) {
                                        ?>
                                            <a class="nav-link" href="/status-production">Status Produksi</a>
                                            <a class="nav-link" href="/status-packing">Status Packing</a>
                                            <a class="nav-link" href="/status-checkout">Status Checkout</a>
                                            <a class="nav-link" href="/status-installation">Status Installation
                                            </a>
                                        <?php }
                                    } else {
                                        ?>
                                        <a class="nav-link" href="<?= base_url("Status/packing"); ?>">Status Packing</a>
                                    <?php
                                    } ?>
                                </nav>
                            </div>
                        <?php }; ?>


                        <?php if ($role != 4 && $role != 3 && $role != 5 && $role != 7 && $role != 8) {
                        ?>
                            <a class="nav-link" href="/payment">
                                <div class="sb-nav-link-icon"><i class="fas fa-money-bill"></i></div>
                                Pembayaran
                            </a>
                        <?php
                        }; ?>

                        <?php if ($role != 3 && $role != 7 && $role != 8) {
                        ?>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#technician" aria-expanded="false" aria-controls="technician">
                                <div class="sb-nav-link-icon"><i class="fas fa-wrench"></i></div>
                                Teknisi
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="technician" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <?php if ($role != 6 && $role != 5 && $role != 1 && $role != 2) {
                                    ?>
                                        <a class="nav-link" href="/technician">Tugas Teknisi</a>
                                    <?php }; ?>
                                    <?php if ($role != 4) {
                                    ?>
                                        <a class="nav-link" href="/technician-all">Tugas Semua Teknisi</a>
                                        <a class="nav-link" href="/technician-by">Tugas Teknisi Perorang</a>
                                    <?php
                                    }; ?>
                                </nav>
                            </div>
                        <?php }; ?>


                        <?php if ($role != 3 && $role != 7 && $role != 8) {
                        ?>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#installer" aria-expanded="false" aria-controls="installer">
                                <div class="sb-nav-link-icon"><i class="fas fa-briefcase"></i></div>
                                Installer
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="installer" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <?php if ($role != 6 && $role != 5 && $role != 1 && $role != 2) {
                                    ?>
                                        <a class="nav-link" href="/installer">Pemasangan Lampu</a>
                                    <?php
                                    }; ?>
                                    <?php if ($role != 4) {
                                    ?>
                                        <a class="nav-link" href="/installer-all">Tugas Semua Installer</a>
                                        <a class="nav-link" href="/installer-by">Tugas Installer Perorang</a>
                                    <?php }; ?>
                                </nav>
                            </div>
                        <?php } ?>


                        <?php if ($role != 4 && $role != 6 && $role != 3 && $role != 5 && $role != 7 && $role != 2 && $role != 8) {
                        ?>
                            <a class="nav-link" href="<?= base_url("list-account"); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-tie"></i></div>
                                Akun
                            </a>
                        <?php }; ?>


                        <a class="nav-link" href="<?= base_url("Auth/progress_logout"); ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                            Logout
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as: <?= $_SESSION["fullname"]; ?> (<?= ucwords($_SESSION["role_name"]) ?>)</div>

                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <?php $this->renderSection("content"); ?>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Zaastore 2021</div>
                    </div>
                </div>
            </footer>
        </div>

    </div>




    <script src="/admin-template/js/scripts.js"></script>
    <script src="/assets/js/bootstrap.v5.1.0.js"></script>
    <script src="/js/general-helper.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- admin template js -->


    <script>
        $(document).ready(function() {
            $('#table_list_order').DataTable();
        });
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
        $(document).ready(function() {
            $('#myTable2').DataTable();
        });
        $(document).ready(function() {
            $('#myTable33').DataTable();
        });
        $(document).ready(function() {
            $('#myTable34').DataTable();
        });
        $(document).ready(function() {
            $('#myTable35').DataTable();
        });
        $(document).ready(function() {
            $('#myTable36').DataTable();
        });
    </script>


    <script>
        $('#id_bahan_baku').on("change", function() {
            var dataid = $("#id_bahan_baku option:selected").attr("data-unit");
            document.getElementById("unit").value = dataid;
        });


        $(document).ready(function() {
            var max_fields = 10;
            var wrapper = $(".container1");
            var add_button = $(".add_form_field");

            var x = 1;
            $(add_button).click(function(e) {
                e.preventDefault();
                if (x < max_fields) {
                    x++;

                    var input_html_unit = ' <div class="col-md-4"><label for ="unit" class = "form-label">Satuan</label><input type = "text" class = "form-control" id = "unit" name = "unit" readonly></div>';
                    var input_html_quantity = ' <div class="col-md-4"><label for ="unit" class = "form-label">Jumlah</label><input type = "text" class = "form-control" id = "unit" name = "unit" readonly></div>';
                    $(wrapper).append(input_html_unit + input_html_quantity);
                } else {
                    alert('You Reached the limits')
                }
            });

            $(wrapper).on("click", ".delete", function(e) {
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })
        });
    </script>
</body>

</html>