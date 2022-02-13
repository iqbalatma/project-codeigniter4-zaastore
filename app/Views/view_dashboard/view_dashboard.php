<?= $this->extend("template_dashboard/layout"); ?>
<?= $this->section("content"); ?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>


        <br><br>
        <!-- PROSES PEMBUATAN DAN PEMASANGAN BARANG -->
        <div class="row mt-4">
            <!-- PEMBUATAN -->
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-wrench me-1"></i>
                        Proses Pembuatan Barang
                    </div>
                    <div class="card-body">
                        <div width="100%" height="50">
                            <h3>Proses Pembuatan</h3>
                            <div class="table-responsive">
                                <div class="col-xl-12 col-md-12">
                                    <table class="table table-success" id="myTable">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Kode Order</th>
                                                <th scope="col">Catatan Desain</th>
                                                <th scope="col">Catatan Tambahan</th>
                                                <th scope="col">Nama Teknisi</th>
                                                <th scope="col">Harga Barang</th>
                                                <th scope="col">Status</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($technician as $row) : ?>
                                                <tr>
                                                    <th scope="row"><?= $i; ?></th>
                                                    <td><?= $row["order_code"]; ?></td>
                                                    <td><?= $row["design_notes"]; ?></td>
                                                    <td><?= $row["notes"]; ?></td>
                                                    <?php
                                                    $id_technician = $row["id_technician"];
                                                    $technician_name = $user_technician->getNameById($id_technician);
                                                    echo "<td>";
                                                    echo ($technician_name[0]["fullname"]);
                                                    echo "</td>";
                                                    ?>
                                                    <td><?= intToRupiah($row["price"]) ?></td>
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
                </div>
            </div>
            <!-- PEMASANGAN -->
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fas fa-briefcase me-1"></i>
                        Proses Pemasangan
                    </div>
                    <div class="card-body">
                        <div width="100%" height="50">
                            <h3>Proses Pemasangan
                            </h3>
                            <div class="table-responsive">
                                <div class="col-xl-12 col-md-12">
                                    <table class="table table-primary" id="myTable2">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Kode Order</th>
                                                <th scope="col">Catatan Desain</th>
                                                <th scope="col">Catatan Tambahan</th>
                                                <th scope="col">Nama Installer</th>
                                                <th scope="col">Biaya Pemasangan</th>
                                                <th scope="col">Komisi</th>
                                                <th scope="col">Status</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($installer as $row) : ?>
                                                <tr>
                                                    <th scope="row"><?= $i; ?></th>
                                                    <td><?= $row["order_code"]; ?></td>
                                                    <td><?= $row["design_notes"]; ?></td>
                                                    <td><?= $row["notes"]; ?></td>
                                                    <?php
                                                    $id_technician = $row["id_installer"];
                                                    $technician_name = $user_technician->getNameById($id_technician);
                                                    echo "<td>";
                                                    echo ($technician_name[0]["fullname"]);
                                                    echo "</td>";
                                                    ?>
                                                    <td><?= intToRupiah($row["installation_price"]) ?></td>
                                                    <td><?= intToRupiah($row["installation_price"] * 0.3) ?></td>
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
                </div>
            </div>
        </div>


        <!-- PEMBAYARAN BELUM LUNAS -->
        <div class="row mb-4">
            <div class="col-xl-12 col-md-12 ">

                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-exclamation-circle me-1"></i>
                        Pembayaran Belum Lunas
                    </div>
                    <div class="card-body">
                        <h3>Pembayaran Belum Lunas</h3>
                        <div class="table-responsive">
                            <table class="table table-dark table-striped" id="myTable36">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kode Order</th>
                                        <th scope="col">Faktur</th>
                                        <th scope="col">Note Tambahan</th>

                                        <th scope="col">Project By</th>
                                        <th scope="col">Harga Barang</th>
                                        <th scope="col">Sisa Bayar</th>

                                        <th scope="col">Proses</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($order_data_on_progress as $row) :
                                        $price = $row["price"];
                                        $total_price = $row["total_price"] + intval($row["installation_price"]);;
                                        $paid_amount = $payment->where("id_order", $row["id_order"])->orderBy("date_payment", "desc")->findAll()[0]["paid_amount"];
                                        $payment_left =  $paid_amount = $payment->where("id_order", $row["id_order"])->orderBy("date_payment", "desc")->findAll()[0]["payment_left"];
                                        if ($payment_left > 0) {
                                    ?>
                                            <tr class="table-danger">
                                                <th scope="row"><?= $i; ?></th>
                                                <td><?= $row["order_code"]; ?></td>
                                                <td><?= $row["faktur_code"]; ?></td>
                                                <td><?= $row["notes"]; ?></td>
                                                <td><?= $row["fullname"]; ?></td>
                                                <td><?= intToRupiah($total_price) ?></td>
                                                <td><?= intToRupiah($payment_left) ?></td>

                                                <!-- Button trigger modal -->
                                                <td>

                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#history_pembayaran1<?= $row['id_order'] ?>">
                                                        History Pembayaran
                                                    </button>
                                                    <button type="button" class="btn btn-primary btn-history" data-bs-toggle="modal" data-id-order="<?= $row["id_order"] ?>">
                                                        <i class="fas fa-file-alt"></i>
                                                    </button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="history_pembayaran1<?= $row['id_order'] ?>" tabindex="-1" aria-labelledby="history_pembayaran1<?= $row['id_order'] ?>Label" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="history_pembayaran1<?= $row['id_order'] ?>Label">History Pembayaran</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <?php

                                                                    $history_payment = $payment->where("id_order", $row["id_order"])->where("is_deleted", 0)->findAll();

                                                                    ?>
                                                                    <table class="table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th scope="col">No</th>
                                                                                <th scope="col">Pembayaran</th>
                                                                                <th scope="col">Sisa Bayar</th>
                                                                                <th scope="col">Tanggal</th>

                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php
                                                                            $j = 1;
                                                                            foreach ($history_payment as $row2) : ?>
                                                                                <tr>
                                                                                    <th scope="row"><?= $j; ?></th>
                                                                                    <td>Rp <?= number_format($row2["paid_amount"], 0, ',', '.'); ?></td>
                                                                                    <td>Rp <?= number_format($row2["payment_left"], 0, ',', '.'); ?></td>
                                                                                    <td><?= $row2["date_payment"]; ?></td>
                                                                                </tr>
                                                                            <?php

                                                                                $j++;
                                                                            endforeach; ?>

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
                                            </tr>
                                    <?php
                                            $i++;
                                        }
                                    endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <!-- BAHAN BAKU KRITIS -->
        <div class="row mb-4">
            <div class="col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-exclamation-circle me-1"></i>
                        Bahan Baku Kritis
                    </div>
                    <div class="card-body">
                        <h3>Bahan Baku Kritis</h3>
                        <div class="table-responsive">
                            <table class="table table-warning" id="myTable34">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Bahan</th>
                                        <th scope="col">Satuan</th>
                                        <th scope="col">Kuantitas</th>
                                        <th scope="col">Ambang Batas</th>
                                        <th scope="col">Update Terakhir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;


                                    foreach ($warehouse_kritis as $row) :
                                    ?>
                                        <tr>
                                            <th scope="row"><?= $i; ?></th>
                                            <td><?= ucwords($row["fullname"]); ?></td>
                                            <td><?= ucwords($row["nama_unit"]); ?></td>
                                            <td><?= $row["quantity"]; ?></td>
                                            <td><?= $row["threshold"]; ?></td>
                                            <td><?= $row["update_at"]; ?></td>
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
        </div>


        <!-- PERSIAPAN BAHAN BAKU DAN STOK BAHAN BAKU -->
        <div class="row mb-4">
            <!-- PERSIAPAN BAHAN BAKU -->
            <div class="col-xl-6 col-md-6 ">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-boxes me-1"></i>
                        Persiapan Bahan Baku
                    </div>
                    <div class="card-body">
                        <h3>Persiapan Bahan Baku</h3>
                        <div class="table-responsive">
                            <table class="table" id="myTable35">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Ukuran Akrilik</th>
                                        <th scope="col">Waterproof</th>
                                        <th scope="col">Controller</th>
                                        <th scope="col">Perekat</th>
                                        <th scope="col">Saklar</th>
                                        <th scope="col">Peniklan</th>
                                        <th scope="col">Panjang Kabel</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $total_waterproof = 0;
                                    $total_controller = 0;
                                    $total_adhesive = 0;
                                    $total_switch = 0;
                                    $total_peniklan = 0;
                                    $total_cable_length = 0;

                                    foreach ($request_bahan as $row) :


                                        $waterproof = $row["waterproof"];
                                        $controller = $row["controller"];
                                        $adhesive = $row["adhesive"];
                                        $switch = $row["switch"];
                                        $peniklan = $row["peniklan"];
                                        $cable_length = $row["cable_length"];

                                        if ($waterproof == null) {
                                            $waterproof = "Tidak Pakai";
                                        } else {
                                            $total_waterproof += 1;
                                        }
                                        if ($controller == null) {
                                            $controller = 0;
                                        }
                                        if ($adhesive == null) {
                                            $adhesive = 0;
                                        }
                                        if ($switch == null) {
                                            $switch = 0;
                                        }
                                        if ($peniklan == null) {
                                            $peniklan = 0;
                                        }
                                        if ($cable_length == null) {
                                            $cable_length = 0;
                                        } else {
                                            $cable_length = preg_split('#(?<=\d)(?=[a-z])#i', $cable_length);
                                            $cable_length = $cable_length[0];
                                        }


                                        $total_controller += $controller;
                                        $total_adhesive += $adhesive;
                                        $total_switch += $switch;
                                        $total_peniklan += $peniklan;
                                        $total_cable_length += $cable_length;


                                    ?>
                                        <tr>
                                            <th scope="row"><?= $i; ?></th>
                                            <td><?= $row["size_acrilic"]; ?></td>
                                            <td><?= $waterproof; ?></td>
                                            <td><?= $controller; ?></td>
                                            <td><?= $adhesive; ?></td>
                                            <td><?= $switch; ?></td>
                                            <td><?= $peniklan; ?></td>
                                            <td><?= $cable_length; ?> cm</td>
                                        </tr>
                                    <?php
                                        $i++;
                                    endforeach; ?>


                                    <tr>
                                        <td scope="row">Jumlah</td>
                                        <td scope="row"></td>

                                        <td><?= $total_waterproof; ?></td>
                                        <td><?= $total_controller; ?></td>
                                        <td><?= $total_adhesive; ?></td>
                                        <td><?= $total_switch; ?></td>
                                        <td><?= $total_peniklan; ?></td>
                                        <td><?= $total_cable_length; ?> cm</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- STOK BAHAN BAKU -->
            <div class="col-xl-6 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-boxes me-1"></i>
                        Stok Bahan Baku
                    </div>
                    <div class="card-body">
                        <h3>Stok Bahan Baku</h3>
                        <div class="table-responsive">
                            <table class="table" id="myTable33">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Bahan</th>
                                        <th scope="col">Satuan</th>
                                        <th scope="col">Kuantitas</th>
                                        <th scope="col">Ambang Batas</th>
                                        <th scope="col">Update Terakhir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;


                                    foreach ($warehouse as $row) :
                                    ?>
                                        <tr>
                                            <th scope="row"><?= $i; ?></th>
                                            <td><?= ucwords($row["fullname"]); ?></td>
                                            <td><?= ucwords($row["nama_unit"]); ?></td>
                                            <td><?= $row["quantity"]; ?></td>
                                            <td><?= $row["threshold"]; ?></td>
                                            <td><?= $row["update_at"]; ?></td>
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
        </div>


    </div>
</main>


<div class="modal fade" id="modal-history" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-modal-history">History Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Pembayaran</th>
                            <th scope="col">Sisa Bayar</th>
                            <th scope="col">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>


                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(".btn-history").on("click", function() {
            let modalHistory = $("#modal-history");
            let btnHistory = $(this);

            let idOrder = btnHistory.data("id-order");
            modalHistory.modal("toggle");

            $.ajax({
                url: `/api/payment/${idOrder}`,
                type: "GET",
            }).done(function(responseAjax) {
                console.log(responseAjax);

                let dataPayments = [];

                let tbody = $("#modal-history ").find("tbody");

                tbody.children().remove();

                let no = 1;
                responseAjax.forEach(dataPayment => {
                    let tr = $("<tr>").appendTo(tbody);

                    tr.append($("<td>", {
                        text: no
                    })).append($("<td>", {
                        text: intToRupiah(dataPayment.paid_amount),
                    })).append($("<td>", {
                        text: intToRupiah(dataPayment.payment_left),
                    })).append($("<td>", {
                        text: dataPayment.date_payment,
                    }));
                    no++;
                });


                console.log(dataPayments);


            });
        });
    });
</script>
<?= $this->endsection(); ?>