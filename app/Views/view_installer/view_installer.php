<?= $this->extend("template_dashboard/layout"); ?>
<?= $this->section("content"); ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-4"><?= $title; ?></h1>
        <?php
        $nama_teknisi = $_SESSION["fullname"];
        if ($flashdata != null) {
            echo $flashdata;
        }; ?>
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <h3>Tabel Penugasan</h3>
                <div class="table-responsive">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Order</th>
                                <th scope="col">Deadline</th>
                                <th scope="col">Ukuran Akrilik</th>
                                <th scope="col">Panjang Kabel</th>
                                <th scope="col">Adaptor</th>
                                <th scope="col">Item Tambahan</th>
                                <th scope="col">Catatan Desain</th>
                                <th scope="col">Catatan Tambahan</th>
                                <th scope="col">Upload Gambar Pemasangan</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($installation as $row) : ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $row["order_code"]; ?></td>
                                    <td><?= $row["deadline"]; ?></td>
                                    <td><?= $row["size_acrilic"]; ?></td>
                                    <td><?= $row["cable_length"]; ?></td>
                                    <td><?= $row["adaptor"]; ?></td>
                                    <td><?php if ($row["waterproof"] != null) {
                                            echo "Waterproof, ";
                                            echo "<br>";
                                        }
                                        if ($row["adhesive"] != null) {
                                            echo "Perekat =  " . $row['adhesive'] . ",";
                                            echo "<br>";
                                        }
                                        if ($row["switch"] != null) {
                                            echo "Saklar = " . $row['switch'] . ",";
                                            echo "<br>";
                                        }
                                        if ($row["laser_cut"] != null) {
                                            echo "Laser Cut,";
                                            echo "<br>";
                                        }
                                        if ($row["peniklan"] != null) {
                                            echo "Peniklan = " . $row['peniklan'];
                                            echo "<br>";
                                        }
                                        ?></td>
                                    <td><?= $row["design_notes"]; ?></td>
                                    <td><?= $row["notes"]; ?></td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#upload_gambar<?= $row["id_order"] ?>">
                                            Upload Gambar pemasangan
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="upload_gambar<?= $row["id_order"] ?>" tabindex="-1" aria-labelledby="upload_gambarLabel" aria-hidden="true">
                                            <div class="modal-dialog ">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="upload_gambarLabel">Upload Gambar</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="/installer-report-installation" method="POST" enctype="multipart/form-data">
                                                            <div class="input-group mb-3">
                                                                <input type="file" class="form-control" id="installation_image" name="installation_image">


                                                                <input type="hidden" class="form-control" id="id_order" name="id_order" value="<?= $row["id_order"]; ?>">
                                                            </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                                $i++;
                            endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <br><br>



                <h3>Menunggu Konfirmasi</h3>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Order</th>
                                <th scope="col">Deadline</th>
                                <th scope="col">Komisi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $installation_price_total = 0;
                            foreach ($installation_waiting_confirm as $row) :
                                // EROR
                                $installation_price = 0.3 * intval($row["installation_price"]);

                            ?>
                                <tr class="table-danger">
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $row["order_code"]; ?></td>
                                    <td><?= $row["deadline"]; ?></td>
                                    <td><?= "Rp " . number_format($installation_price, 0, ',', '.'); ?></td>

                                </tr>
                            <?php
                                $installation_price_total += $installation_price;
                                $i++;
                            endforeach; ?>
                            <tr>
                                <td colspan="3">Total Komisi</td>
                                <td class="table-primary"><?= "Rp " . number_format($installation_price_total, 0, ',', '.'); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <br><br>
                <br><br>
                <br><br>
                <form action="/installer/done-this-month" method="GET">
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
                            if ($data_type == "done-this-month") {
                            ?>
                                <a href="/installer/done-all" class="btn btn-primary">Tampilkan Semua Data</a>
                                <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Cetak PDF Data Teknisi Perbulan
                                </button> -->
                            <?php
                            } else {
                            ?>
                                <a href="/installer/done-this-month" class="btn btn-primary">Tampilkan Data Bulan Ini</a>
                                <!-- <a href="<?php //echo base_url("PDF/print_pdf?title=Teknisi&view=pdf_installer&data_type=done_all&nama_teknisi=$nama_teknisi");  -->
                                                ?>" class="btn btn-primary">Cetak PDF Seluruh Data Teknisi</a>-->

                            <?php
                            }; ?>
                        </div>
                    </div>
                </form>


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

                                        <input type="hidden" name="title" value="Data Pemasangan">
                                        <input type="hidden" name="view" value="pdf_installer">
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

                <h3>Selesai</h3>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Order</th>
                                <th scope="col">Tanggal Pemasangan Selesai</th>
                                <th scope="col">Komisi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $installation_price_total = 0;
                            foreach ($installation_done as $row) :
                                // EROR
                                $installation_price =  0.3 * intval($row["installation_price"]); ?>
                                <tr class="table-success">
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $row["order_code"]; ?></td>
                                    <td><?= $row["date_installation_done"]; ?></td>
                                    <td><?= "Rp " . number_format($installation_price, 0, ',', '.'); ?></td>

                                </tr>
                            <?php
                                $installation_price_total += $installation_price;
                                $i++;
                            endforeach; ?>
                            <tr>
                                <td colspan="3">Total Komisi</td>
                                <td class="table-primary"><?= "Rp " . number_format($installation_price_total, 0, ',', '.'); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>


            </div>
        </div>

    </div>
</main>

<?= $this->endsection(); ?>