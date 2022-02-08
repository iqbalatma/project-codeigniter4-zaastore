<?= $this->extend("template_dashboard/layout"); ?>
<?= $this->section("content"); ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-4"><?= $title; ?></h1>
        <?php
        if ($flashdata != null) {
            echo $flashdata;
        }; ?>
        <div class="row">
            <div class="col-xl-12 col-md-12">

                <div class="btn-group mb-3" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off">
                    <a href="/installer-all/on-progress" class="btn btn-outline-primary" for="btnradio1">Belum Selesai</a>


                    <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                    <a class="btn btn-outline-primary" href="/installer-all/done-this-month" for="btnradio2">Sudah Selesai</a>
                </div>
                <?php if ($data_type !== "on-progress") {
                ?>
                    <br><br>
                    <form action="/installer-all/done-this-month" method="GET">
                        <div class="row mb-4">
                            <div class="col-xl-4 col-md-4">
                                <select class="form-select" aria-label="Default select example" name="month">
                                    <option selected disabled>Pilih Bulan Untuk Filter</option>
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                            <div class="col-xl-4 col-md-4">
                                <select class="form-select" aria-label="Default select example" name="year">
                                    <option selected>Pilih Tahun Untuk Filter</option>
                                    <?php $counter_year = 2021;
                                    while ($counter_year < 2030) {
                                    ?>
                                        <option value="<?= $counter_year; ?>"><?= $counter_year; ?></option>
                                    <?php
                                        $counter_year++;
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-xl-4 col-md-4">
                                <input class="btn btn-primary" type="submit" value="Filter">

                                <?php
                                if ($data_type == "done-all") {
                                ?>
                                    <a href="/installer-all/done-this-month" class="btn btn-primary">Tampilkan Data Bulan Ini</a>

                                    <!-- <a href="<?php //echo base_url("PDF/print_pdf?title=Pemasangan Lampu&view=pdf_all_installer&data_type=done_all");  -->
                                                    ?>" class="btn btn-primary">Cetak PDF Seluruh Data Teknisi</a>-->
                                <?php
                                } else {
                                ?>
                                    <a href="/installer-all/done-all" class="btn btn-primary">Tampilkan Semua Data</a>

                                    <!-- Button trigger modal -->
                                    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Cetak PDF Data Teknisi Perbulan
                                    </button> -->
                                <?php
                                }; ?>
                            </div>
                        </div>
                    </form>

                <?php }; ?>



                <!-- Modal -->
                <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Cetak PDF Data Teknisi Perbulan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url("PDF/print_pdf"); ?>" method="GET">
                                    <div class="row mb-4">

                                        <input type="hidden" name="title" value="Pemasangan Lampu">
                                        <input type="hidden" name="view" value="pdf_all_installer">
                                        <input type="hidden" name="data_type" value="done_this_month">


                                        <div class="col-xl-6 col-md-6">
                                            <select class="form-select" aria-label="Default select example" name="month">
                                                <option selected disabled>Pilih Bulan Untuk Filter</option>
                                                <option value="1">Januari</option>
                                                <option value="2">Februari</option>
                                                <option value="3">Maret</option>
                                                <option value="4">April</option>
                                                <option value="5">Mei</option>
                                                <option value="6">Juni</option>
                                                <option value="7">Juli</option>
                                                <option value="8">Agustus</option>
                                                <option value="9">September</option>
                                                <option value="10">Oktober</option>
                                                <option value="11">November</option>
                                                <option value="12">Desember</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-6 col-md-6">
                                            <select class="form-select" aria-label="Default select example" name="year">
                                                <option selected>Pilih Tahun Untuk Filter</option>
                                                <?php $counter_year = 2021;
                                                while ($counter_year < 2030) {
                                                ?>
                                                    <option value="<?= $counter_year; ?>"><?= $counter_year; ?></option>
                                                <?php
                                                    $counter_year++;
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Cetak PDF</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="table-responsive">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Order</th>
                                <th scope="col">Pemasangan Selesai</th>
                                <th scope="col">Ukuran Akrilik</th>
                                <th scope="col">Panjang Kabel</th>
                                <th scope="col">Adaptor</th>
                                <th scope="col">Item Tambahan</th>
                                <th scope="col">Catatan Desain</th>
                                <th scope="col">Catatan Tambahan</th>
                                <th scope="col">Nama Installer</th>
                                <th scope="col">Biaya Pemasangan</th>
                                <th scope="col">Status</th>
                                <?php
                                if ($data_type == "on-progress") {
                                    echo "<th scope='col'>Action</th>";
                                }; ?>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($installer as $row) : ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $row["order_code"]; ?></td>
                                    <td><?= $row["date_installation_done"]; ?></td>
                                    <td><?= $row["size_acrilic"]; ?></td>
                                    <td><?= $row["cable_length"]; ?></td>
                                    <td><?= $row["adaptor"]; ?></td>
                                    <td><?php if ($row["waterproof"] != null) {
                                            echo "Waterproof, ";
                                        }
                                        if ($row["adhesive"] != null) {
                                            echo "Perekat, ";
                                        }
                                        if ($row["switch"] != null) {
                                            echo "Saklar, ";
                                        }
                                        if ($row["laser_cut"] != null) {
                                            echo "Laser Cut";
                                        }
                                        ?></td>
                                    <td><?= $row["design_notes"]; ?></td>
                                    <td><?= $row["notes"]; ?></td>
                                    <?php
                                    $id_technician = $row["id_installer"];
                                    $technician_name = $user_technician->get_technician($id_technician);
                                    echo "<td>";
                                    echo ($technician_name[0]["fullname"]);
                                    echo "</td>";
                                    ?>
                                    <td>Rp. <?= number_format($row["installation_price"], 0, ',', '.'); ?></td>
                                    <td>
                                        <?php
                                        $status = $row["id_status"];
                                        if ($status == 1) {
                                            $status = "Desain Selesai";
                                        } elseif ($status == 2) {
                                            $status = "Produksi Selesai";
                                        } elseif ($status == 3) {
                                            $status = "Packing Selesai";
                                        } elseif ($status == 4) {
                                            $status = "Checkout Selesai";
                                        } elseif ($status == 5) {
                                            $status = "Waiting List";
                                        }
                                        echo $status; ?></td>

                                    <?php if ($data_type == "on-progress") {
                                    ?>


                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ganti_installer<?= $row['id_order']; ?>">
                                                Ganti Installer
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="ganti_installer<?= $row['id_order']; ?>" tabindex="-1" aria-labelledby="ganti_installer<?= $row['id_order']; ?>Label" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">

                                                        <form action="/installer-update-installer" method="POST">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Ganti Teknisi Produk <?= $row["order_code"]; ?></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <!-- id order -->
                                                                <input type="hidden" name="id_order" id="id_order" value="<?= $row["id_order"]; ?>">


                                                                <!-- id_technician didapat pada id_user -->
                                                                <label for="installer" class="form-label">Pilih Teknisi</label>
                                                                <select class="form-select" aria-label="Default select example" id="installer" name="installer">
                                                                    <?php foreach ($installer_user as $row2_installer) :

                                                                        if ($row["id_installer"] == $row2_installer["id_user"]) {
                                                                    ?>
                                                                            <option selected value="<?= $row2_installer["id_user"]; ?>"><?= $row2_installer["fullname"]; ?></option>
                                                                        <?php
                                                                        } else {
                                                                        ?>
                                                                            <option value="<?= $row2_installer["id_user"]; ?>"><?= $row2_installer["fullname"]; ?></option>
                                                                    <?php
                                                                        }
                                                                    endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </form>


                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    <?php
                                    }; ?>


                                </tr>
                            <?php
                                $i++;
                            endforeach; ?>
                        </tbody>
                    </table>
                </div>


            </div>
        </div>

    </div>
</main>
<?php echo $checked_button; ?>
<?= $this->endsection(); ?>