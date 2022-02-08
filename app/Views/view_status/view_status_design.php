<?= $this->extend("template_dashboard/layout"); ?>
<?= $this->section("content"); ?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-4"><?= $title; ?></h1>
        <?php
        if ($flashdata != null) {
            echo $flashdata;
        }; ?>

        <!-- ROW TABEL -->
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-palette">
                        </i>
                        <b>
                            Desain
                        </b>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-dark table-striped" id="myTable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kode Order</th>
                                        <th scope="col">Tanggal Deadline</th>
                                        <th scope="col">Ukuran Akrilik</th>
                                        <th scope="col">Catatan Desain</th>
                                        <th scope="col">Catatan Tambahan</th>
                                        <th scope="col">Gambar Desain</th>
                                        <th scope="col">Proses</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($status as $row) :
                                        $file_image_design = $image_design->where("is_deleted", 0)->where("id_order", $row["id_order"])->findAll();
                                    ?>
                                        <tr>
                                            <th scope="row"><?= $i; ?></th>
                                            <td><?= $row["order_code"]; ?></td>
                                            <td><?= $row["deadline"]; ?></td>
                                            <td><?= $row["size_acrilic"]; ?></td>
                                            <td><?= $row["design_notes"]; ?></td>
                                            <td><?= $row["notes"]; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-success btn-img" data-bs-toggle="modal" data-base-url="<?= base_url() ?>" data-file="<?= htmlspecialchars(json_encode($file_image_design), ENT_QUOTES, 'UTF-8'); ?>" data-id-order="<?= $row["id_order"] ?>">
                                                    <i class="fas fa-images"></i>
                                                </button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-success mb-3 me-3 btn-edit" data-bs-toggle="modal" data-id-order="<?= $row["id_order"] ?>">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php $i++;
                                    endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- TUTUP ROW TABEL -->
    </div>
</main>


<!-- Modal Update Status-->
<div class="modal fade" id="modal-edit" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Gambar Desain Lampu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin ingin mengupdate status ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <a href="" class="btn btn-primary" data>Konfirmasi</a>
            </div>
        </div>
    </div>
</div>



<!-- Modal Gambar Desain-->
<div class="modal fade" id="modal-img" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Gambar Desain Lampu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/order-edit-image-design" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="id_order" id="id_order">

                    <div class="col-md-12 mb-3">
                        <label for="image" class="form-label">Upload Desain</label>
                        <input class="form-control" type="file" id="image" name="image[]" placeholder="Upload gambar desain lampu" multiple>
                    </div>

                    <div class="row row-cols-1 row-cols-md-3 g-4" id="row-img">



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

<script>
    $(document).ready(function() {
        $(".btn-edit").on("click", function() {
            const modal = $('#modal-edit');
            const btn = $(this);
            const idOrder = btn.data("id-order");
            modal.modal('toggle');

            modal.find("a").attr("href", "/update-status-design/" + idOrder);
        });


        $(".btn-img").on("click", function() {
            const modal = $('#modal-img');
            const btn = $(this);
            modal.modal('toggle');

            let baseUrl = btn.data("base-url");
            let files = btn.data("file");
            let idOrder = btn.data("id-order");


            modal.find("#id_order").val(idOrder);

            let row = modal.find("#row-img");
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

                let formCheck = $("<div>", {
                    class: "form-check"
                }).appendTo(cardBody);

                let checkbox = $("<input>", {
                    class: "form-check-input",
                    id: "flexCheckDefault",
                    attr: {
                        name: "checkbox[]",
                        type: "checkbox",
                        value: file.id_image_design,
                    },
                }).appendTo(formCheck);

                let checkboxLabel = $("<label>", {
                    class: "form-check-label",
                    text: "Hapus",
                    attr: {
                        for: "flexCheckDefault"
                    }
                }).appendTo(formCheck);

                let br = $("<br>").appendTo(formCheck);

                let download = $("<a>", {
                    class: " btn btn-success",
                    text: "Download Gambar",
                    attr: {
                        href: baseUrl + "/uploads/desain/" + file.image_name,
                        download: true,
                        type: "button"
                    }
                }).appendTo(cardBody);

            });



        });
    })
</script>
<?= $this->endsection(); ?>