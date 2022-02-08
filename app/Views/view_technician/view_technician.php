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
                    <table class="table">
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
                                <th scope="col">Aksi</th>
                                <th scope="col">History</th>
                                <th scope="col">Upload Gambar Produk</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($technician as $row) : ?>
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
                                        <!-- Button request item -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#request_bahan_baku<?= $row["id_order"] ?>">
                                            Request Bahan Baku
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="request_bahan_baku<?= $row["id_order"] ?>" tabindex="-1" aria-labelledby="request_bahan_bakuLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Request Bahan Baku <?= $row["order_code"]; ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="row g-3 me-3" method="POST" action="/technician-request-warehouse">
                                                            <input type="hidden" class="form-control" id="id_order" name="id_order" value="<?= $row["id_order"]; ?>">
                                                            <input type="hidden" class="form-control" id="id_user" name="id_user" value="<?= $session["id_user"]; ?>">
                                                            <input type="hidden" class="form-control" id="id_user" name="jenis_transaksi" value="keluar">
                                                            <div class="col-md-4">
                                                                <label for="id_bahan_baku" class="form-label">Nama Bahan Baku</label>
                                                                <select id="id_bahan_baku" name="id_bahan_baku" class="form-select">
                                                                    <option selected disabled>- Pilih Bahan Baku -</option>
                                                                    <?php foreach ($warehouse as $row2) : ?>
                                                                        <option value="<?= $row2["id_bahan_baku"]; ?>" data-unit="<?= $row2["nama_unit"]; ?>"><?= $row2["fullname"]; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <label for="unit" class="form-label">Satuan</label>
                                                                <input type="text" class="form-control" id="unit" name="unit" readonly>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="quantity" class="form-label">Jumlah Bahan Baku</label>
                                                                <input type="text" class="form-control" id="quantity" name="quantity">
                                                            </div>

                                                            <!-- <div class="container1">
                                                            <button class="add_form_field">Add New Field &nbsp;
                                                                <span style="font-size:16px; font-weight:bold;">+ </span>
                                                            </button>
                                                            <div><input type="text" name="mytext[]"></div>
                                                        </div> -->

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_history<?= $row["id_order"] ?>">
                                            Lihat History Barang
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modal_history<?= $row["id_order"] ?>" tabindex="-1" aria-labelledby="modal_historyLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-fullscreen">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modal_historyLabel">History Barang</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h3>Tabel History Barang</h3>
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">No</th>
                                                                    <th scope="col">Nama Bahan</th>
                                                                    <th scope="col">unit</th>
                                                                    <th scope="col">Jumlah</th>
                                                                    <th scope="col">Jenis Transaksi</th>
                                                                    <th scope="col">Tanggal</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $i = 1;
                                                                $history_data = $history->getAllDataForTechnician($row["id_order"]);
                                                                $array_rangkuman = [];
                                                                $array_counter = [];
                                                                foreach ($history_data as $row) : ?>
                                                                    <tr>
                                                                        <th scope="row"><?= $i; ?></th>
                                                                        <td><?= ucwords($row["fullname"]); ?></td>
                                                                        <td><?= ucwords($row["nama_unit"]); ?></td>
                                                                        <td><?= $row["quantity"]; ?></td>
                                                                        <td><?= $row["jenis_transaksi"]; ?></td>
                                                                        <td><?= $row["date"]; ?></td>
                                                                    </tr>

                                                                <?php

                                                                    array_push($array_counter, $row["fullname"]);



                                                                    if (!isset($array_rangkuman[$row["fullname"]])) {
                                                                        $array_rangkuman[$row["fullname"]] = [];
                                                                        $newdata = [
                                                                            "fullname" => $row["fullname"],
                                                                            "quantity" => intval($row["quantity"]),
                                                                        ];
                                                                        array_push($array_rangkuman[$row["fullname"]], $newdata);
                                                                    } else {
                                                                        $array_rangkuman[$row["fullname"]][0]["quantity"] =  $array_rangkuman[$row["fullname"]][0]["quantity"] + $row["quantity"];
                                                                    }

                                                                    $i++;
                                                                endforeach; ?>
                                                            </tbody>
                                                        </table>


                                                        <h3>Rangkuman</h3>
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">No</th>
                                                                    <th scope="col">Nama Bahan</th>
                                                                    <th scope="col">Jumlah</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php


                                                                $array_counter = array_values(array_unique($array_counter));

                                                                $i = 1;
                                                                $k = 0;
                                                                while ($i <= count($array_rangkuman)) {


                                                                ?>

                                                                    <tr>
                                                                        <td><?= $i; ?></td>
                                                                        <td><?= $array_rangkuman[$array_counter[$k]][0]["fullname"]; ?></td>
                                                                        <td><?= $array_rangkuman[$array_counter[$k]][0]["quantity"]; ?></td>
                                                                    </tr>
                                                                <?php
                                                                    $i++;
                                                                    $k++;
                                                                }
                                                                ?>

                                                            </tbody>
                                                        </table>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#upload_gambar<?= $row["id_order"] ?>">
                                            Upload Gambar Produk
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
                                                        <form action="/technician-report-done" method="POST" enctype="multipart/form-data">
                                                            <div class="input-group mb-3">
                                                                <input type="file" class="form-control" id="image_product" name="image_product">
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($technician_waiting_confirm as $row) : ?>
                                <tr class="table-danger">
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $row["order_code"]; ?></td>
                                    <td><?= $row["deadline"]; ?></td>

                                </tr>
                            <?php
                                $i++;
                            endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <br><br>
                <br><br>
                <form action="/technician/done-this-month" method="GET">
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
                                <a href="/technician/done-all" class="btn btn-primary">Tampilkan Semua Data</a>
                                <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Cetak PDF Data Teknisi Perbulan
                                </button> -->

                            <?php
                            } else {
                            ?>
                                <a href="/technician/done-this-month" class="btn btn-primary">Tampilkan Data Bulan Ini</a>
                                <!-- <a href="<?php //echo base_url("PDF/print_pdf?title=Teknisi&view=pdf_technician&data_type=done_all&nama_teknisi=$nama_teknisi");  -->
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

                                        <input type="hidden" name="title" value="Data Teknisi">
                                        <input type="hidden" name="view" value="pdf_technician">
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
                                <th scope="col">Tanggal Produk Selesai</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;

                            foreach ($technician_done as $row) : ?>
                                <tr class="table-success">
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $row["order_code"]; ?></td>
                                    <td><?= $row["date_production_done"]; ?></td>
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

<?= $this->endsection(); ?>