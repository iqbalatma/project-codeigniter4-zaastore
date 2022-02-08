<?= $this->extend("template_dashboard/layout"); ?>
<?= $this->section("content"); ?>

<main>
    <div class="container-fluid px-4">
        <!-- title -->
        <h1 class="mt-4 mb-4"><?= $title; ?></h1>
        <!-- tutup title -->

        <!-- flashdata -->
        <?php
        if ($flashdata != null) {
            echo $flashdata;
        }; ?>
        <!-- tutup flash data -->


        <!-- ROW 1 -->
        <div class="row mb-4">
            <div class="col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-lightbulb"></i>
                        <b>
                            Pembuatan Lampu
                        </b>
                    </div>
                    <div class="card-body">
                        <h3>Penugasan Pembuatan Lampu</h3>

                        <!-- Buka table -->
                        <div class="table-responsive">
                            <table class="table table-dark table-striped" id="myTable">


                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kode Order</th>
                                        <th scope="col">Tanggal Pesan</th>
                                        <th scope="col">Tanggal Deadline</th>
                                        <th scope="col">Font</th>
                                        <th scope="col">Ukuran Akrilik</th>
                                        <th scope="col">Panjang Kabel</th>
                                        <th scope="col">Adaptor</th>
                                        <th scope="col">Komponen Tambahan</th>
                                        <th scope="col">Catatan Desain</th>
                                        <th scope="col">Gambar Desain</th>
                                        <th scope="col">Proses</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php $i = 1;
                                    foreach ($assignment as $row) :
                                        //memisahkan tanggal dengan jam
                                        $order_date = explode(" ", $row["order_date"])[0];

                                        //memisahkan tanggal dengan jam
                                        $deadline_date = explode(" ", $row["deadline"])[0];

                                        $file_array = $image_design->where("is_deleted", 0)->where("id_order", $row["id_order"])->findAll();
                                    ?>
                                        <tr>
                                            <th scope="row"><?= $i; ?></th>
                                            <td><?= $row["order_code"]; ?></td>
                                            <td><?= $order_date; ?></td>
                                            <td><?= $deadline_date ?></td>
                                            <td><?= $row["font"] ?></td>
                                            <td><?= $row["size_acrilic"] ?></td>
                                            <td><?= $row["cable_length"] ?></td>
                                            <td><?= $row["adaptor"] ?></td>
                                            <td>
                                                <?php if ($row["waterproof"] != null) {
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
                                                ?>
                                            </td>
                                            <td><?= $row["design_notes"] ?></td>
                                            <td>
                                                <button type="button" class="btn btn-success btn-prod-ass-img" data-bs-toggle="modal" data-base-url="<?= base_url() ?>" data-file="<?= htmlspecialchars(json_encode($file_array), ENT_QUOTES, 'UTF-8'); ?>">
                                                    <i class="fas fa-images"></i>
                                                </button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-prod-ass" data-id-order="<?= $row["id_order"] ?>" data-bs-toggle="modal">
                                                    <i class="fas fa-user-check"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php $i++;
                                    endforeach; ?>
                                </tbody>


                            </table>
                        </div>
                        <!-- tutup table -->
                    </div>
                </div>



            </div>
        </div>
        <!-- TUTUP ROW 1 -->




        <!-- ROW 2 -->
        <div class="row">
            <div class="col-xl-12 col-md-12">

                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-briefcase"></i>
                        <b>
                            Pemasangan
                        </b>
                    </div>
                    <div class="card-body">
                        <h3>Penugasan Pemasangan</h3>

                        <!-- Buka table -->
                        <div class="table-responsive">
                            <table class="table table-dark table-striped" id="myTable2">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kode Order</th>
                                        <th scope="col">Tanggal Pesan</th>
                                        <th scope="col">Tanggal Deadline</th>
                                        <th scope="col">Font</th>
                                        <th scope="col">Ukuran Akrilik</th>
                                        <th scope="col">Panjang Kabel</th>
                                        <th scope="col">Adaptor</th>
                                        <th scope="col">Komponen Tambahan</th>
                                        <th scope="col">Catatan Desain</th>
                                        <th scope="col">Harga Pemasangan</th>
                                        <th scope="col">Fee Pemasangan</th>
                                        <th scope="col">Gambar Desain</th>
                                        <th scope="col">Proses</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($assignment_installation as $row2) :
                                        //memisahkan tanggal dengan jam
                                        $order_date = explode(" ", $row2["order_date"])[0];

                                        //memisahkan tanggal dengan jam
                                        $deadline_date = explode(" ", $row2["deadline"])[0];

                                        //memisahkan gambar jadi array
                                        $file_array = $image_design->where("is_deleted", 0)->where("id_order", $row2["id_order"])->findAll();

                                        $fee_installation = 0.3 * $row2["installation_price"];
                                    ?>
                                        <tr>
                                            <th scope="row2"><?= $i; ?></th>
                                            <td><?= $row2["order_code"]; ?></td>
                                            <td><?= $order_date; ?></td>
                                            <td><?= $deadline_date ?></td>
                                            <td><?= $row2["font"] ?></td>
                                            <td><?= $row2["size_acrilic"] ?></td>
                                            <td><?= $row2["cable_length"] ?></td>
                                            <td><?= $row2["adaptor"] ?></td>
                                            <td>
                                                <?php if ($row2["waterproof"] != null) {
                                                    echo "Waterproof, ";
                                                    echo "<br>";
                                                }
                                                if ($row2["adhesive"] != null) {
                                                    echo "Perekat =  " . $row2['adhesive'] . ",";
                                                    echo "<br>";
                                                }
                                                if ($row2["switch"] != null) {
                                                    echo "Saklar = " . $row2['switch'] . ",";
                                                    echo "<br>";
                                                }
                                                if ($row2["laser_cut"] != null) {
                                                    echo "Laser Cut,";
                                                    echo "<br>";
                                                }
                                                if ($row2["peniklan"] != null) {
                                                    echo "Peniklan = " . $row2['peniklan'];
                                                    echo "<br>";
                                                }
                                                ?>
                                            </td>
                                            <td><?= $row2["design_notes"] ?></td>
                                            <td><?= intToRupiah($row2["installation_price"]) ?></td>
                                            <td><?= intToRupiah($fee_installation) ?></td>
                                            <td>
                                                <button type="button" class="btn btn-success btn-inst-ass-img" data-bs-toggle="modal" data-base-url="<?= base_url() ?>" data-file="<?= htmlspecialchars(json_encode($file_array), ENT_QUOTES, 'UTF-8'); ?>">
                                                    <i class="fas fa-images"></i>
                                                </button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-inst-ass" data-bs-toggle="modal" data-id-order="<?= $row2["id_order"] ?>">
                                                    <i class="fas fa-user-check"></i>
                                                </button>
                                            </td>
                                        </tr>

                                    <?php $i++;
                                    endforeach; ?>
                                </tbody>


                            </table>
                        </div>
                        <!-- tutup table -->
                    </div>
                </div>



            </div>
        </div>
        <!-- TUTUP ROW 2 -->



    </div>
</main>


<!-- Modal Detail Image technician installation assignment-->
<div class="modal fade" id="modal-ass-img" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-ass-img-label">Gambar Desain Lampu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row row-cols-1 row-cols-md-3 g-4" id="row-inst-ass-image">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Close, Modal Detail Image-->


<!-- Modal Technician Installation Assignment -->
<div class="modal fade" id="modal-ass" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-ass-label">Penugasan Pemasangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">

                    <!-- id order -->
                    <input type="hidden" name="id_order" id="id-order-ass">


                    <!-- id_technician didapat pada id_user -->
                    <label for="technician" class="form-label">Pilih Teknisi</label>
                    <select class="form-select" aria-label="Default select example" id="technician" name="technician">
                        <?php foreach ($technician as $row2_technician) : ?>
                            <option value="<?= $row2_technician["id_user"]; ?>"><?= $row2_technician["fullname"]; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Close, Modal technician Assignment -->




<script>
    $(document).ready(function() {
        $(".btn-prod-ass").on("click", function() {
            let modal = $('#modal-ass');
            let btn = $(this);
            modal.modal('toggle');
            modal.find("#modal-ass-label").text("Penugasan Pembuatan");
            modal.find("form").attr("action", "/assignment-to-technician");


            modal.find("#id-order-ass").val(btn.data("id-order"));
        })

        $(".btn-prod-ass-img").on("click", function() {
            let modal = $('#modal-ass-img');
            let btn = $(this);
            modal.modal('toggle');



            let files = btn.data("file");
            let baseUrl = btn.data("base-url");


            let row = $("#row-inst-ass-image");

            row.children().remove();

            files.forEach(file => {
                let col = $("<div>", {
                    class: "col"
                }).appendTo(row);

                let card = $("<div>", {
                    class: "card h-100"
                }).appendTo(col);

                let img = $("<img>", {
                    attr: {
                        src: baseUrl + "/uploads/desain/" + file.image_name,
                    }
                }).appendTo(card);

                let cardBody = $("<div>", {
                    class: "card-body"
                }).appendTo(card);

                let download = $("<a>", {
                    class: "mt-3 btn btn-success",
                    text: "Download Gambar",
                    attr: {
                        href: baseUrl + "/uploads/desain/" + file.image_name,
                        download: true,
                        type: "button"
                    }
                }).appendTo(cardBody);

            });


        })


        $(".btn-inst-ass").on("click", function() {
            let modal = $('#modal-ass');
            let btn = $(this);
            modal.modal('toggle');
            modal.find("#modal-ass-label").text("Penugasan Pemasangan");
            modal.find("form").attr("action", "/assignment-to-installation");


            modal.find("#id-order-ass").val(btn.data("id-order"));
        })
        $(".btn-inst-ass-img").on("click", function() {
            let modal = $('#modal-ass-img');
            let btn = $(this);
            modal.modal('toggle');

            let files = btn.data("file");
            let baseUrl = btn.data("base-url");


            let row = $("#row-inst-ass-image");
            row.children().remove();
            files.forEach(file => {
                let col = $("<div>", {
                    class: "col"
                }).appendTo(row);

                let card = $("<div>", {
                    class: "card h-100"
                }).appendTo(col);

                let img = $("<img>", {
                    attr: {
                        src: baseUrl + "/uploads/desain/" + file.image_name,
                    }
                }).appendTo(card);

                let cardBody = $("<div>", {
                    class: "card-body"
                }).appendTo(card);

                let download = $("<a>", {
                    class: "mt-3 btn btn-success",
                    text: "Download Gambar",
                    attr: {
                        href: baseUrl + "/uploads/desain/" + file.image_name,
                        download: true,
                        type: "button"
                    }
                }).appendTo(cardBody);

            });


        })


    })
</script>

<?= $this->endsection(); ?>