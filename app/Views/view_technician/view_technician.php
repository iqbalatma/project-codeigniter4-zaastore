<?= $this->extend("template_dashboard/layout"); ?>
<?= $this->section("content"); ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-4"><?= $title; ?></h1>
        <?php

        if ($flashdata != null) {
            echo $flashdata;
        }; ?>


        <!-- TABLE ASSIGNMENT -->
        <div class="row mb-4">
            <div class="col-xl-12 col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>
                            <i class="fas fa-cogs"></i>
                            <b>
                                Table Penugasan
                            </b>
                        </h4>
                    </div>
                    <div class="card-body">
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
                                            <td><?= getAdditionalItem($row["waterproof"], $row["adhesive"], $row["switch"], $row["laser_cut"], $row["peniklan"]); ?></td>
                                            <td><?= $row["design_notes"]; ?></td>
                                            <td><?= $row["notes"]; ?></td>
                                            <td>
                                                <!-- Button request item -->
                                                <button type="button" class="btn btn-success btn-request" data-bs-toggle="modal" data-id-user="<?= $session["id_user"]; ?>" data-id-order="<?= $row["id_order"] ?>">
                                                    <i class=" fas fa-toolbox"></i>
                                                </button>
                                            </td>
                                            <td>
                                                <!-- Button trigger modal history-->
                                                <button type="button" class="btn btn-success btn-history" data-bs-toggle="modal" data-id-order="<?= $row["id_order"] ?>">
                                                    <i class="fas fa-history"></i>
                                                </button>
                                            </td>
                                            <td>
                                                <!-- Button trigger modal gambar -->
                                                <button type="button" class="btn btn-success btn-upload" data-bs-toggle="modal" data-id-order="<?= $row["id_order"] ?>">
                                                    <i class="fas fa-image"></i>
                                                </button>
                                            </td>
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


        <!-- TABLE WAITING CONFIRMATION -->
        <div class="row mb-4">
            <div class="col-xl-12 col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>
                            <i class="far fa-clock"></i>
                            <b>Menunggu Konfirmasi</b>
                        </h4>
                    </div>
                    <div class="card-body">
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
                    </div>
                </div>
            </div>
        </div>

        <!-- TABLE DONE -->
        <div class="row mb-4">
            <div class="col-xl-12 col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>
                            <i class="far fa-check-circle"></i>
                            <b>
                                Selesai
                            </b>
                        </h4>
                    </div>
                    <div class="card-body">
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
                                    foreach ($technician_done as $key => $row) : ?>
                                        <tr class="table-success">
                                            <th scope="row"><?= $key + 1; ?></th>
                                            <td><?= $row["order_code"]; ?></td>
                                            <td><?= $row["date_production_done"]; ?></td>
                                        </tr>
                                    <?php
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


<!-- MODAL HISTORY-->
<div class="modal fade" id="modal-history" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">History Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    Tabel History Barang
                                </div>
                                <div class="card-body">
                                    <table class="table" id="table-history-modal">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nama Bahan</th>
                                                <th scope="col">Unit</th>
                                                <th scope="col">Jumlah</th>
                                                <th scope="col">Jenis Transaksi</th>
                                                <th scope="col">Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    Tabel Rangkuman
                                </div>
                                <div class="card-body">
                                    <table class="table" id="table-history-summary-modal">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nama Bahan</th>
                                                <th scope="col">Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- MODAL REQUEST -->
<div class="modal fade" id="modal-request" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Request Bahan Baku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="/technician-request-warehouse">
                <div class="modal-body">
                    <div class="row g-3 me-3">

                        <input type="hidden" class="form-control" id="id_order_request" name="id_order_request">
                        <input type="hidden" class="form-control" id="id_user_request" name="id_user_request">
                        <input type="hidden" class="form-control" id="jenis_transaksi" name="jenis_transaksi" value="keluar">

                        <div class="col-md-4">
                            <label for="id_bahan_baku_request" class="form-label">Nama Bahan Baku</label>
                            <select id="id_bahan_baku_request" name="id_bahan_baku_request" class="form-select">
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
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- MODAL UPLOAD IMAGE -->
<div class="modal fade" id="modal-upload" tabindex="-1">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Gambar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/technician-report-done" method="POST" enctype="multipart/form-data">
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="image_product" name="image_product">
                        <input type="hidden" class="form-control" id="id_order_upload" name="id_order">
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


<script>
    $(document).ready(function() {
        $(".table").DataTable();

        $("#id_bahan_baku_request").on("change", function() {
            let dataid = $("#id_bahan_baku_request option:selected").attr("data-unit");
            $("#unit").val(dataid);
        });


        function onClickHistory(context) {
            let btn = $(context);
            let idOrder = btn.data("id-order");
            let modal = $("#modal-history");
            modal.modal("toggle");

            $.ajax({
                url: `/api/warehouse-transaction/${idOrder}`,
                type: "GET",
            }).done(function(datas) {
                let tableHistory = $("#table-history-modal").DataTable();
                let tableSummary = $("#table-history-summary-modal").DataTable();


                tableHistory.clear().draw();
                tableSummary.clear().draw();

                let listFullName = [];
                let summaryData = [];
                datas.forEach(function(data, index) {
                    if (!listFullName.includes(data.fullname)) {
                        listFullName.push(data.fullname);
                    }

                    if (typeof summaryData[data.fullname] == "undefined") {
                        summaryData[data.fullname] = {
                            fullname: data.fullname,
                            quantity: parseInt(data.quantity)
                        }
                    } else {
                        summaryData[data.fullname].quantity += parseInt(data.quantity);
                    }
                    tableHistory.row.add([
                        index + 1,
                        data.fullname,
                        data.nama_unit,
                        data.quantity,
                        data.jenis_transaksi,
                        data.date,
                    ]).draw();
                });

                let i = 0;
                while (i < listFullName.length) {
                    tableSummary.row.add([
                        i + 1,
                        summaryData[listFullName[i]].fullname,
                        summaryData[listFullName[i]].quantity,
                    ]).draw();
                    i++;
                }
            })
        }

        function onClickRequest(context) {
            let btn = $(context);
            let idOrder = btn.data("id-order");
            let idUser = btn.data("id-user");
            let modal = $("#modal-request");
            modal.modal("toggle");

            $("#id_order_request").val(idOrder);
            $("#id_user_request").val(idUser);

        }

        function onClickUpload(context) {
            let btn = $(context);
            let idOrder = btn.data("id-order");
            let modal = $("#modal-upload");
            modal.modal("toggle");

            $("#id_order_upload").val(idOrder);
        }

        $(".btn-history").on("click", function() {
            onClickHistory(this);
        })

        $(".btn-request").on("click", function() {
            onClickRequest(this);
        })

        $(".btn-upload").on("click", function() {
            onClickUpload(this);
        });

    })
</script>

<?= $this->endsection(); ?>