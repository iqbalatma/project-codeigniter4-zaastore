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

        <!-- TABLE ASSIGNMENT -->
        <div class="row mb-4">
            <div class="col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            <i class="fas fa-cogs"></i>
                            <b>
                                Table Pemasangan
                            </b>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="table-assignment">
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
                                    foreach ($installation as $key => $row) : ?>
                                        <tr>
                                            <th scope="row"><?= $key + 1; ?></th>
                                            <td><?= $row["order_code"]; ?></td>
                                            <td><?= $row["deadline"]; ?></td>
                                            <td><?= $row["size_acrilic"]; ?></td>
                                            <td><?= $row["cable_length"]; ?></td>
                                            <td><?= $row["adaptor"]; ?></td>
                                            <td><?= getAdditionalItem($row["waterproof"], $row["adhesive"], $row["switch"], $row["laser_cut"], $row["peniklan"]); ?></td>
                                            <td><?= $row["design_notes"]; ?></td>
                                            <td><?= $row["notes"]; ?></td>
                                            <td>
                                                <!-- Button trigger modal gambar -->
                                                <button type="button" class="btn btn-success btn-upload" data-bs-toggle="modal" data-id-order="<?= $row["id_order"] ?>">
                                                    <i class="fas fa-image"></i>
                                                </button>
                                            </td>
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


        <!-- TABLE WAITING CONFIRM -->
        <div class="row mb-4">
            <div class="col-xl-12 col-md-12">
                <div class="card">
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
                                        <th scope="col">Komisi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $installation_price_total = 0;
                                    foreach ($installation_waiting_confirm as $key => $row) :
                                        $installation_price = 0.3 * intval($row["installation_price"]);
                                    ?>
                                        <tr class="table-danger">
                                            <th scope="row"><?= $key + 1; ?></th>
                                            <td><?= $row["order_code"]; ?></td>
                                            <td><?= $row["deadline"]; ?></td>
                                            <td><?= intToRupiah($installation_price); ?></td>
                                        </tr>
                                    <?php
                                        $installation_price_total += $installation_price;
                                    endforeach; ?>
                                    <tr>
                                        <td colspan="3">Total Komisi</td>
                                        <td class="table-primary"><?= intToRupiah($installation_price_total); ?></td>
                                    </tr>
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
                <div class="card">
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
                                        <th scope="col">Tanggal Pemasangan Selesai</th>
                                        <th scope="col">Komisi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $installation_price_total = 0;
                                    foreach ($installation_done as $key => $row) :
                                        $installation_price =  0.3 * intval($row["installation_price"]); ?>
                                        <tr class="table-success">
                                            <th scope="row"><?= $key + 1; ?></th>
                                            <td><?= $row["order_code"]; ?></td>
                                            <td><?= $row["date_installation_done"]; ?></td>
                                            <td><?= "Rp " . intToRupiah($installation_price); ?></td>

                                        </tr>
                                    <?php
                                        $installation_price_total += $installation_price;
                                    endforeach; ?>
                                    <tr>
                                        <td colspan="3">Total Komisi</td>
                                        <td class="table-primary"><?= intToRupiah($installation_price_total); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>
    </div>

    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="modal-upload" tabindex="-1">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Gambar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/installer-report-installation" method="POST" enctype="multipart/form-data">
                    <div class="input-group mb-3">
                        <input type="hidden" class="form-control" id="id_order" name="id_order">
                        <input type="file" class="form-control" id="installation_image" name="installation_image">
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
        $("#table-assignment").DataTable();

        function onClickUpload(context) {
            let btn = $(context);
            let idOrder = btn.data("id-order");
            let modal = $("#modal-upload");
            modal.modal("toggle");

            $("#id_order").val(idOrder);
        }

        $(".btn-upload").on("click", function() {
            onClickUpload(this);
        });
    })
</script>

<?= $this->endsection(); ?>