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
                        <i class="fas fa-box-open"></i>
                        <b>Packing</b>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-dark table-striped" id="myTable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kode Order</th>
                                        <th scope="col">Faktur</th>
                                        <th scope="col">Tanggal Deadline</th>
                                        <th scope="col">Tambahan</th>
                                        <th scope="col">Project By</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Proses</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($status as $row) : ?>
                                        <tr class="">
                                            <th scope="row"><?= $i; ?></th>
                                            <td><?= $row["order_code"]; ?></td>
                                            <td><?= $row["faktur_code"]; ?></td>
                                            <td><?= $row["deadline"]; ?></td>
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
                                            <td><?= $row["address"]; ?></td>
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


<!-- Modal Update -->
<div class="modal fade" id="modal-update" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-update-label">Status Packing</h5>
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

<script>
    $(document).ready(function() {
        $(".btn-update").on("click", function() {
            const modal = $('#modal-update');
            const btn = $(this);
            const idOrder = btn.data("id-order");
            modal.modal('toggle');
            modal.find("a").attr("href", "/update-status-packing/" + idOrder);
        });
    });
</script>
<?= $this->endsection(); ?>