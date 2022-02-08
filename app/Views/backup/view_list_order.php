<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-4"><?= $title; ?></h1>





        <div class="row">
            <div class="col-xl-6 col-md-6 col-sm-6">
                <div class="btn-group mb-3" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off">
                    <a href="<?= base_url("Order/list_order/all_data_by_month"); ?>" class="btn btn-outline-primary" for="btnradio1">Semua Data</a>


                    <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                    <a class="btn btn-outline-primary" href="<?= base_url("Order/list_order/waiting_list"); ?>" for="btnradio2">Daftar Tunggu</a>


                    <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                    <a class="btn btn-outline-primary" href="<?= base_url("Order/list_order/design_done"); ?>" for="btnradio3">Sudah Di Desain</a>



                    <input type="radio" class="btn-check" name="btnradio" id="btnradio5" autocomplete="off">
                    <a class="btn btn-outline-primary" href="<?= base_url("Order/list_order/production_done"); ?>" for="btnradio5">Sudah Di Produksi</a>


                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-md-6 col-sm-6">
                <div class="btn-group mb-3" role="group" aria-label="Basic radio toggle button group">


                    <input type="radio" class="btn-check" name="btnradio" id="btnradio6" autocomplete="off">
                    <a class="btn btn-outline-primary" href="<?= base_url("Order/list_order/packing_done"); ?>" for="btnradio6">Sudah Di Packing</a>

                    <input type="radio" class="btn-check" name="btnradio" id="btnradio4" autocomplete="off">
                    <a class="btn btn-outline-primary" href="<?= base_url("Order/list_order/technician_assignment_done_by_month"); ?>" for="btnradio4">Sudah Ditugaskan</a>


                    <input type="radio" class="btn-check" name="btnradio" id="btnradio7" autocomplete="off">
                    <a class="btn btn-outline-primary" href="<?= base_url("Order/list_order/checkout_done_by_month"); ?>" for="btnradio7">Sudah Di Checkout</a>
                </div>
            </div>
        </div>

        <!-- untuk menghapus filter ketika tidak dibutuhkan -->
        <?php if ($data_type == "checkout_done_all" || $data_type == "checkout_done_by_month" || $data_type == "all_data" || $data_type == "all_data_by_month" || $data_type == "technician_assignment_done_by_month" || $data_type == "technician_assignment_done_all") {
        ?>
            <!-- Untuk menyesuaikan action form pada filter -->
            <?php if ($data_type == "checkout_done_all" || $data_type == "checkout_done_by_month") {
            ?>
                <form action="<?= base_url("Order/list_order/checkout_done_by_month"); ?>" method="GET">
                <?php
            } elseif ($data_type == "all_data" || $data_type == "all_data_by_month") {
                ?>
                    <form action="<?= base_url("Order/list_order/all_data_by_month"); ?>" method="GET">
                    <?php
                } elseif ($data_type == "technician_assignment_done_by_month" || $data_type == "technician_assignment_done_all") {
                    ?>
                        <form action="<?= base_url("Order/list_order/technician_assignment_done_by_month"); ?>" method="GET">
                        <?php
                    }; ?>
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

                                <!-- untuk menyesuaikan link pada satu tombol yang sama -->
                                <?php
                                if ($data_type == "checkout_done_by_month") {
                                    echo "<a href='" . base_url("Order/list_order/checkout_done_all") . "' class='btn btn-primary'>Tampilkan Semua Data</a>";
                                } elseif ($data_type == "checkout_done_all") {
                                    echo "<a href='" . base_url("Order/list_order/checkout_done") . "' class='btn btn-primary'>Tampilkan Data Bulan Ini</a>";
                                } elseif ($data_type == "all_data_by_month") {
                                    echo "<a href='" . base_url("Order/list_order/all_data") . "' class='btn btn-primary'>Tampilkan Semua Data</a>";
                                } elseif ($data_type == "all_data") {
                                    echo "<a href='" . base_url("Order/list_order/all_data_by_month") . "' class='btn btn-primary'>Tampilkan Data Bulan Ini</a>";
                                } elseif ($data_type == "technician_assignment_done_by_month") {
                                    echo "<a href='" . base_url("Order/list_order/technician_assignment_done_all") . "' class='btn btn-primary'>Tampilkan Semua Data</a>";
                                } elseif ($data_type == "technician_assignment_done_all") {
                                    echo "<a href='" . base_url("Order/list_order/technician_assignment_done_by_month") . "' class='btn btn-primary'>Tampilkan Data Bulan Ini</a>";
                                };; ?>
                            </div>
                        </div>
                        </form>
                    <?php


                }; ?>
                    <?php
                    if ($flashdata != null) {
                        echo $flashdata;
                    }; ?>



                    <div class="row">
                        <div class="col-xl-12 col-md-12">
                            <div class="table-responsive">
                                <table class="table table-dark" id="table_list_order">
                                    <thead>
                                        <tr>
                                            <th scope="col" rowspan="2">No</th>
                                            <th scope="col" rowspan="2">Kode Order </th>
                                            <th scope="col" rowspan="2">Tangaal Pesan</th>
                                            <th scope="col" rowspan="2">Tangaal Deadline</th>
                                            <th scope="col" rowspan="2">Font</th>
                                            <th scope="col" rowspan="2">Ukuran Akrilik</th>
                                            <th scope="col" rowspan="2">Panjang Kabel</th>
                                            <th scope="col" rowspan="2">Adaptor</th>
                                            <th scope="col" rowspan="2">Komponen Tambahan</th>
                                            <th scope="col" rowspan="2">Project By</th>
                                            <th scope="col" rowspan="2">Faktur</th>
                                            <th scope="col" rowspan="2">Sumber Orderan</th>
                                            <th scope="col" rowspan="2">Harga Barang</th>
                                            <th scope="col" rowspan="2">Harga Tambahan</th>
                                            <th scope="col" rowspan="2">Harga Total</th>
                                            <th scope="col" rowspan="2">Sisa Pembayaran</th>
                                            <th scope="col" rowspan="2">Catatan Desain</th>
                                            <th scope="col" rowspan="2">Catatan Tambahan</th>
                                            <th scope="col" rowspan="2">Alamat</th>
                                            <th scope="col" rowspan="2">Gambar Desain</th>
                                            <th scope="col" rowspan="2">Gambar Checkout</th>
                                            <th scope="col" rowspan="2">Teknisi</th>
                                            <th scope="col" colspan="4" class="text-center">Status</th>
                                            <?php if ($_SESSION["role"] != 3) {
                                            ?>
                                                <th scope="col" rowspan="2">Edit Nominal</th>
                                                <th scope="col" rowspan="2">Edit Gambar Desain</th>
                                            <?php
                                            }; ?>
                                        </tr>
                                        <tr>
                                            <th scope="col">Print Design</th>
                                            <th scope="col">Production</th>
                                            <th scope="col">Packing</th>
                                            <th scope="col">Checkout</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($order as $row) :
                                            // if ($_SESSION["fullname"] == $row["fullname"]) {
                                            if ($_SESSION["role"] == 3) {
                                                if ($_SESSION["fullname"] != $row["fullname"]) {
                                                    continue;
                                                }
                                            }
                                            $order_date = $row["order_date"];
                                            $order_date = explode(" ", $order_date);
                                            $order_date = $order_date[0];

                                            $deadline_date = $row["deadline"];
                                            $deadline_date = explode(" ", $deadline_date);
                                            $deadline_date = $deadline_date[0];

                                            $file_array = $row["image"];
                                            $file_array = explode("|", $file_array);

                                            $price = $row["price"];


                                            $paid_amount = $payment->where("id_order", $row["id_order"])->orderBy("date_payment", "desc")->findAll()[0]["paid_amount"];


                                            $payment_left =  $paid_amount = $payment->where("id_order", $row["id_order"])->orderBy("date_payment", "desc")->findAll()[0]["payment_left"];

                                        ?>
                                            <tr>
                                                <td><?= $i ?>
                                                    <?php if ($payment_left > 0 && $row["status_name"] == "Checkout") {
                                                    ?>
                                                        <i class="fas fa-exclamation-triangle" style="color: red;"></i>
                                                    <?php
                                                    } ?>


                                                </td>
                                                <td><?= $row["order_code"]; ?></td>
                                                <td><?= $order_date ?></td>
                                                <td><?= $deadline_date ?>
                                                    <!-- Button trigger modal edit tanggal -->
                                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modaledittanggal<?= $row['order_code'] ?>">
                                                        Edit Tanggal
                                                    </button>
                                                </td>
                                                <td><?= $row["font"]; ?></td>
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
                                                <td><?= $row["fullname"]; ?></td>
                                                <td><?= $row["faktur_code"]; ?>
                                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modaleditfaktur<?= $row['order_code'] ?>">
                                                        Edit Faktur
                                                    </button>
                                                </td>
                                                <td><?= $row["source_order"]; ?></td>
                                                <td><?= "Rp " . number_format($price, 0, ',', '.');
                                                    ?></td>
                                                <td><?= "Rp " . number_format($row["extra_price"], 0, ',', '.');
                                                    ?></td>
                                                <td><?= "Rp " . number_format($row["total_price"], 0, ',', '.');
                                                    ?></td>
                                                <?php
                                                if ($payment_left > 0) {
                                                    $payment_left_rupiah = "Rp " . number_format($payment_left, 0, ',', '.');
                                                    echo "<td class='table-danger'>$payment_left_rupiah</td>";
                                                } else {
                                                    echo "<td class=''>";
                                                    $payment_left_rupiah = "Rp " . number_format($payment_left, 0, ',', '.');
                                                    echo $payment_left_rupiah;
                                                    echo "</td>";
                                                }

                                                ?>
                                                <td><?= $row["design_notes"]; ?></td>
                                                <td><?= $row["notes"]; ?></td>
                                                <td><?= $row["address"]; ?></td>
                                                <td>

                                                    <a type="button" class="" data-bs-toggle="modal" data-bs-target="#modal_desain<?= $row['id_order'] ?>"><img src="<?= base_url("/uploads/desain") . "/" . $file_array[0]; ?>" style="height: 100px;"></a>
                                                </td>
                                                <td>
                                                    <?php if ($row["checkout_image"] !== null) {
                                                    ?>

                                                        <a type="button" class="" data-bs-toggle="modal" data-bs-target="#modal_checkout<?= $row['id_order'] ?>"><img src="<?= base_url("/uploads/checkout") . "/" . $row["checkout_image"]; ?>" style="height: 100px;"></a>
                                                    <?php
                                                    }; ?>
                                                </td>
                                                <?php
                                                $id_technician = $row["id_technician"];
                                                $technician_name = $technician->get_technician($id_technician);
                                                if (count($technician_name) > 0) {
                                                    echo "<td>";
                                                    echo ($technician_name[0]["fullname"]);
                                                    echo "</td>";
                                                    // echo "<td>($technician_name[0]['fullname'])</td>";
                                                } else {
                                                    echo "<td class='table-danger'>-</td>";
                                                }
                                                ?>
                                                <?php
                                                $status = $row["status_name"];
                                                if ($status == "Waiting List") {
                                                    echo "<td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>";
                                                } elseif ($status == "Design") {
                                                    echo "<td class='table-success'>Done</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>";
                                                } elseif ($status == "Production") {
                                                    echo "<td class='table-success'>Done</td>
                                        <td class='table-success'>Done</td>
                                    <td>-</td>
                                    <td>-</td>";
                                                } elseif ($status == "Packed") {
                                                    echo "<td class='table-success'>Done</td>
                                    <td class='table-success'>Done</td>
                                    <td class='table-success'>Done</td>
                                <td>-</td>";
                                                } elseif ($status == "Checkout") {
                                                    echo "<td class='table-success'>Done</td>
                                    <td class='table-success'>Done</td>
                                    <td class='table-success'>Done</td>
                                    <td class='table-success'>Done</td>";
                                                }

                                                if ($_SESSION["role"] != 3) {


                                                ?>

                                                    <td><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modal_edit_nominal<?= $row['order_code'] ?>">
                                                            Edit Nominal
                                                        </button></td>
                                                    <td><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modal_edit_gambar<?= $row['order_code'] ?>">
                                                            Edit Gambar Desain
                                                        </button></td>

                                                <?php } ?>

                                                <!-- Modal edit gambar -->
                                                <div class="modal fade" id="modal_edit_gambar<?= $row['order_code'] ?>" tabindex="-1" aria-labelledby="modal_edit_gambar<?= $row['order_code'] ?>Label" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modal_edit_nominal<?= $row['order_code'] ?>Label">Edit Gambar Desain Produk <?= $row["order_code"]; ?></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="<?= base_url(""); ?>" method="POST" enctype="multipart/form-data">
                                                                <input type="hidden" name="id_order" id="id_order" value="<?= $row["id_order"]; ?>">
                                                                <div class="modal-body">
                                                                    <?php
                                                                    $file_name_array = $row["image"];
                                                                    $file_name_array = explode("|", $file_name_array);
                                                                    // echo $row["image"];
                                                                    $counter_array = 0;
                                                                    while ($counter_array < count($file_name_array) - 1) {
                                                                        echo "<br>";
                                                                    ?>
                                                                        <img class="m-auto mt-3" src="<?= base_url("/uploads/desain") . "/" . $file_name_array[$counter_array]; ?>" style="width: 400px;">
                                                                    <?php
                                                                        $counter_array++;
                                                                    }

                                                                    ?>


                                                                    <hr>
                                                                    <div class="col-md-12 mb-3">
                                                                        <label for="image_payment" class="form-label">Upload Tambahan Desain(Optional)</label>
                                                                        <input class="form-control" type="file" id="image_payment" name="image_payment" placeholder="Upload tambahan desain" multiple>
                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary">Simpan</button>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                                                                </div>


                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- Modal edit nominal -->
                                                <div class="modal fade" id="modal_edit_nominal<?= $row['order_code'] ?>" tabindex="-1" aria-labelledby="modal_edit_nominal<?= $row['order_code'] ?>Label" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modal_edit_nominal<?= $row['order_code'] ?>Label">Edit Nominal Produk <?= $row["order_code"]; ?></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="<?= base_url("Order/edit_nominal"); ?>" method="POST">
                                                                <input type="hidden" name="id_order" id="id_order" value="<?= $row["id_order"]; ?>">
                                                                <div class="modal-body">
                                                                    <label for="price" class="form-label">Harga Barang</label>
                                                                    <input type="text" name="price" id="price" class="form-control" value="<?= $row["price"]; ?>">

                                                                    <label for="extra_price" class="form-label">Harga Tambahan</label>
                                                                    <input type="text" name="extra_price" id="extra_price" class="form-control" value="<?= $row["extra_price"]; ?>">

                                                                    <?php
                                                                    if ($row["installation_price"] != null) {
                                                                    ?>
                                                                        <label for="installation_price" class="form-label">Biaya Pemasangan</label>
                                                                        <input type="text" name="installation_price" id="installation_price" class="form-control" value="<?= $row["installation_price"]; ?>">
                                                                    <?php
                                                                    }; ?>


                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                                </div>


                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- Modal edit tanggal -->
                                                <div class="modal fade" id="modaledittanggal<?= $row['order_code'] ?>" tabindex="-1" aria-labelledby="modaledittanggal<?= $row['order_code'] ?>Label" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modaledittanggal<?= $row['order_code'] ?>Label">Edit Tanggal Produk <?= $row["order_code"]; ?></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="<?= base_url("Order/edit_deadline"); ?>" method="POST">
                                                                <input type="hidden" name="id_order" id="id_order" value="<?= $row["id_order"]; ?>">
                                                                <div class="modal-body">
                                                                    <script>
                                                                        $(function() {
                                                                            $("#deadline<?= $row['order_code'] ?>").datepicker();
                                                                        });
                                                                    </script>
                                                                    <div class="col-md-12">
                                                                        <label for="deadline" class="form-label">Deadline</label>
                                                                        <input type="text" class="form-control" id="deadline<?= $row['order_code'] ?>" name="deadline" placeholder="Masukkan tanggal deadline" autocomplete="off" required>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal edit faktur -->
                                                <div class="modal fade" id="modaleditfaktur<?= $row['order_code'] ?>" tabindex="-1" aria-labelledby="modaleditfaktur<?= $row['order_code'] ?>Label" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modaleditfaktur<?= $row['order_code'] ?>Label">Edit Faktur Produk <?= $row["order_code"]; ?></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="<?= base_url("Order/edit_faktur"); ?>" method="POST">
                                                                <input type="hidden" name="id_order" id="id_order" value="<?= $row["id_order"]; ?>">
                                                                <div class="modal-body">

                                                                    <label for="faktur_code" class="form-label">Faktur</label>
                                                                    <input type="text" name="faktur_code" id="faktur_code" class="form-control" value="<?= $row["faktur_code"]; ?>">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>



                                                <!-- Modal -->
                                                <div class="modal fade" id="modal_desain<?= $row['id_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Gambar Desain Lampu</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <?php
                                                                $file_name_array = $row["image"];
                                                                $file_name_array = explode("|", $file_name_array);
                                                                // echo $row["image"];
                                                                $counter_array = 0;
                                                                while ($counter_array < count($file_name_array) - 1) {
                                                                    echo "<br>";
                                                                ?>
                                                                    <img class="m-auto mt-3" src="<?= base_url("/uploads/desain") . "/" . $file_name_array[$counter_array]; ?>" style="width: 400px;">
                                                                <?php
                                                                    $counter_array++;
                                                                }

                                                                ?>


                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal -->
                                                <div class="modal fade" id="modal_checkout<?= $row['id_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Gambar Checkout</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <img class="m-auto" src="<?= base_url("/uploads/checkout") . "/" . $row["checkout_image"]; ?>" style="width: 400px;">

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                        <?php
                                            // }
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