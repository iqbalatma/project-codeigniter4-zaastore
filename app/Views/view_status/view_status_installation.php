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
                        <i class="fas fa-cogs"></i>
                        <b>Installation</b>
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
                                        <th scope="col">Project By</th>
                                        <th scope="col">Nama Pemasang</th>
                                        <th scope="col">Installation Image</th>
                                        <th scope="col">Proses</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($status as $row) :
                                        $id_installer = $row["id_installer"];
                                        $installer_name = $installer->get_technician($id_installer)[0]["fullname"];
                                    ?>
                                        <tr class="">
                                            <th scope="row"><?= $i; ?></th>
                                            <td><?= $row["order_code"]; ?></td>
                                            <td><?= $row["order_date"]; ?></td>
                                            <td><?= $row["deadline"]; ?></td>
                                            <td><?= $row["fullname"]; ?></td>
                                            <td><?= $installer_name; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-img-installation" data-bs-toggle="modal" data-img="<?= $row["installation_image"]; ?>">
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


<!-- Modal -->
<div class="modal fade" id="modal-update" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Status Installation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/update-status-installation" method="POST" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="col-md-12 mb-3">
                        <input type="hidden" name="id_order" id="id_order">
                    </div>
                    <p>Apakah anda yakin ingin mengupdate status ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" data>Konfirmasi</button=>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal img installation -->
<div class="modal fade" id="modal-img-installation" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Installation Image</h5>
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
            modal.find("#id_order").val(idOrder);
        });

        $(".btn-img-installation").on("click", function() {
            const modal = $('#modal-img-installation');
            const btn = $(this);
            modal.modal('toggle');
            let imgSrc = btn.data("img");
            modal.find("img").attr("src", "/uploads/installation/" + imgSrc);
            modal.find("a").attr("href", "/uploads/installation/" + imgSrc);
        });
    });
</script>

<?= $this->endsection(); ?>