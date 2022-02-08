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
                        <a class="nav-link" href="<?= base_url(); ?>">
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
                                <a class="nav-link" href="<?= base_url("Warehouse"); ?>">Stok Bahan</a>
                                <a class="nav-link" href="<?= base_url("Warehouse/transaction"); ?>">Transaksi Bahan</a>
                                <a class="nav-link" href="<?= base_url("Warehouse/unit"); ?>">Unit</a>
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
                                    <a class="nav-link" href="<?= base_url("Order"); ?>">Tambah Order</a>
                                <?php } ?>
                                <a class="nav-link" href="<?= base_url("Order/list_order/all_data_by_month"); ?>">List Order</a>
                            </nav>
                        </div>
                    <?php
                    }; ?>


                    <?php if ($role != 4 && $role != 6 && $role != 3 && $role != 7 && $role != 2 && $role != 8) {
                    ?>
                        <a class="nav-link" href="<?= base_url("Assignment"); ?>">
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
                                    <a class="nav-link" href="<?= base_url("Status/design_print"); ?>">Status Print Desain</a>
                                    <?php if ($role != 7) {
                                    ?>
                                        <a class="nav-link" href="<?= base_url("Status/production"); ?>">Status Produksi</a>
                                        <a class="nav-link" href="<?= base_url("Status/packing"); ?>">Status Packing</a>
                                        <a class="nav-link" href="<?= base_url("Status/checkout"); ?>">Status Checkout</a>
                                        <a class="nav-link" href="<?= base_url("Status/installation"); ?>">Status Installation
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
                        <a class="nav-link" href="<?= base_url("Payment/index/payment_all"); ?>">
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
                                    <a class="nav-link" href="<?= base_url("Technician"); ?>">Tugas Teknisi</a>
                                <?php }; ?>
                                <?php if ($role != 4) {
                                ?>
                                    <a class="nav-link" href="<?= base_url("Technician/all_technician"); ?>">Tugas Semua Teknisi</a>
                                    <a class="nav-link" href="<?= base_url("Technician/by_technician"); ?>">Tugas Teknisi Perorang</a>
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
                                    <a class="nav-link" href="<?= base_url("Installer"); ?>">Pemasangan Lampu</a>
                                <?php
                                }; ?>
                                <?php if ($role != 4) {
                                ?>
                                    <a class="nav-link" href="<?= base_url("Installer/all_installer"); ?>">Tugas Semua Installer</a>
                                    <a class="nav-link" href="<?= base_url("Installer/by_installer"); ?>">Tugas Installer Perorang</a>
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