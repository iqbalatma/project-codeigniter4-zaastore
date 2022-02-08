<?= $this->extend("template_dashboard/layout"); ?>
<?= $this->section("content"); ?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-4"><?= $title; ?></h1>





        <!-- ROW 1 Button -->
        <div class="row">
            <div class="col-xl-6 col-md-6 col-sm-6">
                <div class="btn-group mb-3" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off">
                    <a href="/list-order/all-data-by-month" class="btn btn-outline-primary" for="btnradio1">
                        <b>Semua Data</b></a>


                    <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                    <a class="btn btn-outline-primary" href="/list-order/waiting-list" for="btnradio2"><b>Daftar Tunggu</b></a>


                    <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                    <a class="btn btn-outline-primary" href="/list-order/design-done" for="btnradio3"><b>Sudah Di Desain</b></a>



                    <input type="radio" class="btn-check" name="btnradio" id="btnradio5" autocomplete="off">
                    <a class="btn btn-outline-primary" href="/list-order/production-done" for="btnradio5"><b>Sudah Di Produksi</b></a>


                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-md-6 col-sm-6">
                <div class="btn-group mb-3" role="group" aria-label="Basic radio toggle button group">


                    <input type="radio" class="btn-check" name="btnradio" id="btnradio6" autocomplete="off">
                    <a class="btn btn-outline-primary" href="/list-order/packing-done" for="btnradio6"><b>Sudah Di Packing</b></a>

                    <input type="radio" class="btn-check" name="btnradio" id="btnradio4" autocomplete="off">
                    <a class="btn btn-outline-primary" href="/list-order/technician-assignment-done-by-month" for="btnradio4"><b>Sudah Ditugaskan</b></a>


                    <input type="radio" class="btn-check" name="btnradio" id="btnradio7" autocomplete="off">
                    <a class="btn btn-outline-primary" href="/list-order/checkout-done-by-month" for="btnradio7"><b>Sudah Di Checkout</b></a>
                </div>
            </div>
        </div>
        <!-- TUTUP ROW 1 -->

        <!-- untuk menghapus filter ketika tidak dibutuhkan -->
        <?php if ($data_type == "checkout-done-all" || $data_type == "checkout-done-by-month" || $data_type == "all-data" || $data_type == "all-data-by-month" || $data_type == "technician-assignment-done-by-month" || $data_type == "technician-assignment-done-all") {
        ?>
            <!-- Untuk menyesuaikan action form pada filter -->
            <?php if ($data_type == "checkout-done-all" || $data_type == "checkout-done-by-month") {
            ?>
                <form action="/list-order/checkout-done-by-month" method="GET">
                <?php
            } elseif ($data_type == "all-data" || $data_type == "all-data-by-month") {
                ?>
                    <form action="/list-order/all-data-by-month" method="GET">
                    <?php
                } elseif ($data_type == "technician-assignment-done-by-month" || $data_type == "technician-assignment-done-all") {
                    ?>
                        <form action="/list-order/technician-assignment-done-by-month" method="GET">
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
                                    <option selected><b></b>Pilih Tahun Untuk Filter</option>
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
                                if ($data_type == "checkout-done-by-month") {
                                    echo "<a href='/list-order/checkout-done-all' class='btn btn-primary'><b>Tampilkan Semua Data</b></a>";
                                } elseif ($data_type == "checkout-done-all") {
                                    echo "<a href='/list-order/checkout-done-by-month' class='btn btn-primary'><b>Tampilkan Data Bulan Ini</b></a>";
                                } elseif ($data_type == "all-data-by-month") {
                                    echo "<a href='/list-order/all-data' class='btn btn-primary'><b>Tampilkan Semua Data</b></a>";
                                } elseif ($data_type == "all-data") {
                                    echo "<a href='/list-order/all-data-by-month' class='btn btn-primary'><b>Tampilkan Data Bulan Ini</b></a>";
                                } elseif ($data_type == "technician-assignment-done-by-month") {
                                    echo "<a href='/list-order/technician-assignment-done-all' class='btn btn-primary'><b>Tampilkan Semua Data</b></a>";
                                } elseif ($data_type == "technician-assignment-done-all") {
                                    echo "<a href='/list-order/technician-assignment-done-by-month' class='btn btn-primary'><b>Tampilkan Data Bulan Ini</b></a>";
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



                    <!-- ROW 2 -->
                    <div class="row">
                        <div class="col-xl-12 col-md-12">
                            <div class="table-responsive">
                                <table class="table table-dark" id="table_list_order">
                                    <thead>
                                        <tr>
                                            <th scope="col" rowspan="2">No</th>
                                            <th scope="col" rowspan="2">Kode Order </th>
                                            <th scope="col" rowspan="2">Tangaal Deadline</th>
                                            <th scope="col" rowspan="2">Project By</th>
                                            <th scope="col" rowspan="2">Faktur</th>
                                            <th scope="col" rowspan="2">Harga Total</th>
                                            <th scope="col" rowspan="2">Sisa Pembayaran</th>
                                            <th scope="col" rowspan="2">Gambar Desain</th>
                                            <th scope="col" rowspan="2">Gambar Checkout</th>
                                            <th scope="col" rowspan="2">Teknisi</th>
                                            <th scope="col" colspan="4" class="text-center">Status</th>
                                            <th scope="col" rowspan="2" class="text-center">Action</th>
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
                                        $counter_table = 1;
                                        foreach ($order as $row) :

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

                                            $file_array = $image_design->where('is_deleted', 0)->where('id_order', $row["id_order"])->findAll();



                                            $price = $row["price"];


                                            $paid_amount = $payment->where("id_order", $row["id_order"])->orderBy("date_payment", "desc")->findAll()[0]["paid_amount"];


                                            $payment_left =  $payment->where("id_order", $row["id_order"])->orderBy("date_payment", "desc")->findAll()[0]["payment_left"];

                                        ?>

                                            <tr>
                                                <td><?= $counter_table ?>
                                                    <?php if ($payment_left > 0 && $row["status_name"] == "Checkout") {
                                                    ?>
                                                        <i class="fas fa-exclamation-triangle" style="color: red;"></i>
                                                    <?php
                                                    } ?>


                                                </td>
                                                <td><?= $row["order_code"]; ?></td>
                                                <td><?= $deadline_date ?></td>
                                                <td><?= $row["fullname"]; ?></td>
                                                <td><?= $row["faktur_code"]; ?></td>
                                                <td><?= "Rp " . number_format($row["total_price"] + $row["installation_price"], 0, ',', '.');
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
                                                <td>
                                                    <a type="button" class="" data-bs-toggle="modal" data-bs-target="#modal_desain<?= $row['id_order'] ?>">
                                                        <?php
                                                        if (count($file_array) > 0) {
                                                        ?>
                                                            <img src="<?= base_url("/uploads/desain") . "/" . $file_array[0]["image_name"]; ?>" style="height: 100px;">
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <img src="/assets/img/default.png" style="height: 100px;">
                                                        <?php
                                                        }
                                                        ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($row["checkout_image"] !== null) {
                                                    ?>
                                                        <a type="button" class="" data-bs-toggle="modal" data-bs-target="#modal_checkout<?= $row['id_order'] ?>">
                                                            <img src="<?= base_url("/uploads/checkout") . "/" . $row["checkout_image"]; ?>" style="height: 100px;">
                                                        </a>
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
                                                ?>
                                                <td>
                                                    <!-- Detail trigger -->
                                                    <button class="btn btn-primary mb-3 me-3" data-bs-toggle="modal" data-bs-target="#modal_detail<?= $row["id_order"] ?>">
                                                        <i class="fas fa-info-circle"></i>
                                                    </button>
                                                    <!-- delete trigger -->
                                                    <button class="btn btn-danger mb-3 me-3" data-bs-toggle="modal" data-bs-target="#modal_delete<?= $row["id_order"] ?>">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </td>

                                                <!-- Modal Detail -->
                                                <div class="modal fade" id="modal_detail<?= $row["id_order"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_detail<?= $row["id_order"] ?>Label" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl">
                                                        <div class="modal-content">
                                                            <form class="row" action="/order-edit-list" method="POST">



                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="modal_detail<?= $row["id_order"] ?>Label">Detail Produk <?= $row["order_code"]; ?></h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>




                                                                <div class="modal-body">
                                                                    <div class="row g-3">

                                                                        <input type="hidden" class="form-control" name="id_order" id="id_order" value="<?= $row["id_order"]; ?>" readonly>

                                                                        <div class="col-md-6">
                                                                            <label for="order_code" class="form-label">Kode Order</label>
                                                                            <input type="text" class="form-control" name="order_code" id="order_code" value="<?= $row["order_code"]; ?>" readonly>
                                                                        </div>


                                                                        <div class="col-md-6">
                                                                            <label for="faktur_code" class="form-label">Kode Faktur</label>
                                                                            <input type="text" class="form-control" name="faktur_code" id="faktur_code" value="<?= $row["faktur_code"]; ?>">
                                                                        </div>


                                                                        <div class="col-md-6">
                                                                            <label for="order_date" class="form-label">Tanggal Pesan</label>
                                                                            <input type="text" class="form-control" name="order_date" id="order_date" value="<?= $row["order_date"]; ?>" readonly>
                                                                        </div>

                                                                        <script>
                                                                            $(function() {
                                                                                $("#deadline<?= $row['order_code'] ?>").datepicker();
                                                                            });
                                                                        </script>


                                                                        <div class="col-md-6">
                                                                            <label for="deadline" class="form-label">Tanggal Deadline</label>
                                                                            <input type="text" class="form-control" autocomplete="off" name="deadline" id="deadline<?= $row['order_code'] ?>" value="<?= $row["deadline"]; ?>">
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <label for="price" class="form-label">Harga Barang</label>
                                                                            <input type="text" class="form-control" name="price" id="price" value="<?= $row["price"]; ?>">
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <label for="extra_price" class="form-label">Harga Tambahan</label>
                                                                            <input type="text" class="form-control" name="extra_price" id="extra_price" value="<?= $row["extra_price"]; ?>">
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <label for="installation_price" class="form-label">Harga Pemasangan</label>
                                                                            <?php if ($row["installation_status"] == 1) {
                                                                            ?>
                                                                                <input type="text" class="form-control" name="installation_price" id="installation_price" value="<?= $row["installation_price"]; ?>" readonly>
                                                                            <?php
                                                                            } else {
                                                                            ?>
                                                                                <input type="text" class="form-control" name="installation_price" id="installation_price" value="<?= $row["installation_price"]; ?>">
                                                                            <?php
                                                                            } ?>
                                                                        </div>

                                                                        <div class="col-md-6">
                                                                            <label for="total_price" class="form-label">Harga Total</label>
                                                                            <input type="text" class="form-control" name="total_price" id="total_price" value="<?= $row["total_price"] + $row["installation_price"]; ?>" readonly>
                                                                        </div>

                                                                        <div class="col-md-6">
                                                                            <label for="payment_left" class="form-label">Sisa Bayar</label>
                                                                            <input type="text" class="form-control" name="payment_left" id="payment_left" value="<?= $payment_left ?>" readonly>
                                                                        </div>


                                                                        <div class="form-floating">
                                                                            <textarea class="form-control" id="address" name="address" maxlength="30" style="height: 100px"><?= $row["address"]; ?></textarea>
                                                                            <label for="address">Alamat</label>
                                                                        </div>

                                                                        <div class="form-floating">
                                                                            <textarea class="form-control" id="design_notes" name="design_notes" maxlength="30" style="height: 100px"><?= $row["design_notes"]; ?></textarea>
                                                                            <label for="design_notes">Catatan Desain</label>
                                                                        </div>


                                                                        <div class="form-floating">
                                                                            <textarea class="form-control" id="notes" name="notes" maxlength="30" style="height: 100px"><?= $row["notes"]; ?></textarea>
                                                                            <label for="notes">Catatan Tambahan</label>
                                                                        </div>


                                                                        <div class="col-md-4">
                                                                            <label for="project_by" class="form-label">Project By</label>
                                                                            <input type="text" class="form-control" name="project_by" id="project_by" value="<?= $row["fullname"] ?>" readonly>
                                                                        </div>


                                                                        <?php
                                                                        $technician_name = $technician->get_technician($id_technician);
                                                                        if (count($technician_name) > 0) {

                                                                            $technician_name = $technician_name[0]["fullname"];
                                                                        } else {
                                                                            $technician_name = "Belum Ditugaskan";
                                                                        }

                                                                        ?>
                                                                        <div class="col-md-4">
                                                                            <label for="" class="form-label">Nama Teknisi</label>
                                                                            <input type="text" class="form-control" name="" id="" value="<?= $technician_name ?>" readonly>
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <label for="source_order" class="form-label">Sumber Orderan</label>
                                                                            <select id="source_order" name="source_order" class="form-select">

                                                                                <?php
                                                                                $array_source_order = ["Shopee", "Tokopedia", "Whatsapp", "Lain-lain"];
                                                                                $i = 0;
                                                                                while ($i < count($array_source_order)) {
                                                                                    if ($row["source_order"] == $array_source_order[$i]) {
                                                                                        echo "<option selected value='$array_source_order[$i]'>$array_source_order[$i]</option>";
                                                                                    } else {
                                                                                        echo "<option value='$array_source_order[$i]'>$array_source_order[$i]</option>";
                                                                                    };
                                                                                    $i++;
                                                                                }
                                                                                ?>

                                                                            </select>
                                                                        </div>


                                                                        <div class="col-md-3">
                                                                            <label for="size_acrilic" class="form-label">Ukuran Acrillic</label>
                                                                            <input type="text" class="form-control" name="size_acrilic" id="size_acrilic" value="<?= $row["size_acrilic"] ?>">
                                                                        </div>

                                                                        <div class="col-md-3">
                                                                            <label for="cable_length" class="form-label">Panjang Kabel</label>
                                                                            <input type="text" class="form-control" name="cable_length" id="cable_length" value="<?= $row["cable_length"] ?>">
                                                                        </div>

                                                                        <div class="col-md-3">
                                                                            <label for="font" class="form-label">Font</label>
                                                                            <input type="text" class="form-control" name="font" id="font" value="<?= $row["font"] ?>">
                                                                        </div>

                                                                        <div class="col-md-3">
                                                                            <label for="adaptor" class="form-label">Tegangan Adaptor</label>
                                                                            <select id="adaptor" name="adaptor" class="form-select">
                                                                                <?php
                                                                                $array_adaptor = ["1A", "3A"];
                                                                                $i = 0;
                                                                                while ($i < count($array_adaptor)) {
                                                                                    if ($row["adaptor"] == $array_adaptor[$i]) {
                                                                                        echo "<option selected value='$array_adaptor[$i]'>$array_adaptor[$i]</option>";
                                                                                    } else {
                                                                                        echo "<option value='$array_adaptor[$i]'>$array_adaptor[$i]</option>";
                                                                                    };
                                                                                    $i++;
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>


                                                                        <div class="col-md-2" id="container_controller">
                                                                            <label for="controller" class="form-label">Jumlah Controller</label>
                                                                            <select id="controller" name="controller" class="form-select">

                                                                                <?php
                                                                                $i = 0;
                                                                                $controller_quantity = $row["controller"];
                                                                                while ($i < 11) {
                                                                                    if ($controller_quantity == $i) {
                                                                                        echo "<option selected value='$i'>$i</option>";
                                                                                    } else {
                                                                                        echo "<option value='$i'>$i</option>";
                                                                                    }
                                                                                    $i++;
                                                                                }; ?>
                                                                            </select>
                                                                        </div>


                                                                        <div class="col-md-2" id="container_adhesive">
                                                                            <label for="adhesive" class="form-label">Jumlah Perekat</label>
                                                                            <select id="adhesive" name="adhesive" class="form-select">

                                                                                <?php
                                                                                $i = 0;
                                                                                $adhesive_quantity = $row["adhesive"];
                                                                                while ($i < 11) {
                                                                                    if ($adhesive_quantity == $i) {
                                                                                        echo "<option selected value='$i'>$i</option>";
                                                                                    } else {
                                                                                        echo "<option value='$i'>$i</option>";
                                                                                    }
                                                                                    $i++;
                                                                                }; ?>
                                                                            </select>
                                                                        </div>

                                                                        <div class="col-md-2" id="container_switch">
                                                                            <label for="switch" class="form-label">Jumlah Saklar</label>
                                                                            <select id="switch" name="switch" class="form-select">

                                                                                <?php
                                                                                $i = 0;
                                                                                $switch_quantity = $row["switch"];
                                                                                while ($i < 11) {
                                                                                    if ($switch_quantity == $i) {
                                                                                        echo "<option selected value='$i'>$i</option>";
                                                                                    } else {
                                                                                        echo "<option value='$i'>$i</option>";
                                                                                    }
                                                                                    $i++;
                                                                                }; ?>
                                                                            </select>
                                                                        </div>


                                                                        <div class="col-md-2" id="container_peniklan">
                                                                            <label for="peniklan" class="form-label">Peniklan</label>
                                                                            <select id="peniklan" name="peniklan" class="form-select">
                                                                                <?php
                                                                                $i = 0;
                                                                                $peniklan_quantity = $row["peniklan"];
                                                                                while ($i < 11) {
                                                                                    if ($peniklan_quantity == $i) {
                                                                                        echo "<option selected value='$i'>$i</option>";
                                                                                    } else {
                                                                                        echo "<option value='$i'>$i</option>";
                                                                                    }
                                                                                    $i++;
                                                                                }; ?>
                                                                            </select>
                                                                        </div>

                                                                        <div class="col-md-2" id="container_laser_cut">
                                                                            <label for="laser_cut" class="form-label">Laser Cut</label>
                                                                            <div class="form-check">
                                                                                <?php if ($row["laser_cut"] == "on") {
                                                                                    echo '<input class="form-check-input" type="checkbox" id="laser_cut" name="laser_cut" checked>';
                                                                                } else {
                                                                                    echo '<input class="form-check-input" type="checkbox" id="laser_cut" name="laser_cut">';
                                                                                } ?>
                                                                                <label class="form-check-label" for="laser_cut">
                                                                                    Pakai
                                                                                </label>
                                                                            </div>
                                                                        </div>


                                                                        <div class="col-md-2" id="container_waterproof">
                                                                            <label for="waterproof" class="form-label">Waterproof</label>
                                                                            <div class="form-check">
                                                                                <?php if ($row["waterproof"] == "on") {
                                                                                    echo '<input class="form-check-input" type="checkbox" id="waterproof" name="waterproof" checked>';
                                                                                } else {
                                                                                    echo '<input class="form-check-input" type="checkbox" id="waterproof" name="waterproof">';
                                                                                } ?>
                                                                                <label class="form-check-label" for="waterproof">
                                                                                    Pakai
                                                                                </label>
                                                                            </div>
                                                                        </div>





                                                                    </div>

                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                                                                    <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Update</button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- Modal Delete-->
                                                <div class="modal fade" id="modal_delete<?= $row["id_order"] ?>" tabindex="-1" aria-labelledby="modal_delete<?= $row["id_order"] ?>Label" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">

                                                            <form action="/order-delete" method="POST">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="modal_delete<?= $row["id_order"] ?>Label">Produk <?= $row["order_code"]; ?></h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <input type="hidden" name="id_order" id="id_order" value="<?= $row["id_order"]; ?>">
                                                                    Apakah anda yakin ingin menghapus <?= $row["order_code"]; ?> ?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                    <button type="submit" class="btn btn-danger">Konfirmasi</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- modal view -->
                                                <!-- Modal Gambar Desain-->
                                                <div class="modal fade" id="modal_desain<?= $row['id_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-xl">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Gambar Desain Lampu</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="/order-edit-image-design" method="POST" enctype="multipart/form-data">
                                                                <div class="modal-body">


                                                                    <input type="hidden" name="id_order" id="id_order" value="<?= $row["id_order"]; ?>">

                                                                    <div class="col-md-12 mb-3">
                                                                        <label for="image" class="form-label">Upload Desain</label>
                                                                        <input class="form-control" type="file" id="image" name="image[]" placeholder="Upload gambar desain lampu" multiple>
                                                                    </div>

                                                                    <div class="row row-cols-1 row-cols-md-3 g-4">

                                                                        <?php
                                                                        $counter_array = 0;
                                                                        while ($counter_array < count($file_array)) {
                                                                        ?>
                                                                            <div class="col">
                                                                                <div class="card h-100">
                                                                                    <img src="<?= base_url("/uploads/desain") . "/" . $file_array[$counter_array]["image_name"]; ?>">
                                                                                    <div class="card-body">
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" type="checkbox" name="checkbox[]" value="<?= $file_array[$counter_array]["id_image_design"]; ?>" id="flexCheckDefault">
                                                                                            <label class="form-check-label" for="flexCheckDefault">
                                                                                                Hapus
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        <?php
                                                                            $counter_array++;
                                                                        }

                                                                        ?>
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                                                                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal Gambar Checkout -->
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
                                            $counter_table++;
                                        endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- TUTUP ROW 2 -->
    </div>
</main>

<?php echo $checked_button; ?>

<?= $this->endsection(); ?>