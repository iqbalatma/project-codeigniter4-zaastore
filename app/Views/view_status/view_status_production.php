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

                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-lightbulb"></i>
                        <b>
                            Produksi
                        </b>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-dark table-striped" id="myTable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kode Order</th>
                                        <th scope="col">Tanggal Pesan</th>
                                        <th scope="col">Tanggal Deadline</th>
                                        <th scope="col">Nama Teknisi</th>
                                        <th scope="col">Gambar Desain</th>
                                        <th scope="col">Gambar Produk</th>
                                        <th scope="col">Proses</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($status as $row) :
                                        //memisahkan gambar jadi array
                                        $file_array = $image_design->where("is_deleted", 0)->where("id_order", $row["id_order"])->findAll();
                                        $id_technician = $row["id_technician"];
                                        $technician_name = $technician->get_technician($id_technician)[0]["fullname"];
                                    ?>
                                        <tr>
                                            <th scope="row"><?= $i; ?></th>
                                            <td><?= $row["order_code"]; ?></td>
                                            <td><?= $row["order_date"]; ?></td>
                                            <td><?= $row["deadline"]; ?></td>
                                            <td><?= $technician_name ?></td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-img-design" data-bs-toggle="modal" data-file="<?= htmlspecialchars(json_encode($file_array), ENT_QUOTES, 'UTF-8'); ?>" data-id-order="<?= $row["id_order"] ?>">
                                                    <i class="far fa-images"></i>
                                                </button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-img-product" data-bs-toggle="modal" data-img="<?= $row["image_product"]; ?>">
                                                    <i class="far fa-image"></i>
                                                </button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-success btn-update" data-bs-toggle="modal" data-id-order="<?= $row["id_order"] ?>">
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
    </div>
</main>

<!-- Modal Update Status-->
<div class="modal fade" id="modal-update" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-update-label">Status Produksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin ingin mengupdate status ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <a href="" class="btn btn-success" data>Konfirmasi</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal image design -->
<div class="modal fade" id="modal-img-design" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-img-design-label">Gambar Desain Lampu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row row-cols-1 row-cols-md-3 g-4 row-img">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal img product -->
<div class="modal fade" id="modal-img-product" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Product Lampu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img class="m-auto" src="" style="width: 400px;">
                <a href="" download type="button" class="mt-3 btn btn-success">Download Gambar</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $(".btn-update").on("click", function() {
            const modal = $('#modal-update');
            const btn = $(this);
            const idOrder = btn.data("id-order");
            modal.modal('toggle');

            modal.find("a").attr("href", "/update-status-production/" + idOrder);
        });


        $(".btn-img-product").on("click", function() {
            const modal = $('#modal-img-product');
            const btn = $(this);
            modal.modal('toggle');
            let imgSrc = btn.data("img");

            modal.find("img").attr("src", "/uploads/product/" + imgSrc);
            modal.find("a").attr("href", "/uploads/product/" + imgSrc);
        });

        $(".btn-img-design").on("click", function() {
            const modal = $('#modal-img-design');
            const btn = $(this);
            modal.modal('toggle');

            let files = btn.data("file");
            let idOrder = btn.data("id-order");


            modal.find("#id_order").val(idOrder);

            let row = modal.find(".row-img");
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
                        src: "/uploads/desain/" + file.image_name,
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
                        href: "/uploads/desain/" + file.image_name,
                        download: true,
                        type: "button"
                    }
                }).appendTo(cardBody);

            });



        });
    })
</script>
<?= $this->endsection(); ?>