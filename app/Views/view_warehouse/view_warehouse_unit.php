<?= $this->extend("template_dashboard/layout"); ?>
<?= $this->section("content"); ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-4"><?= $title; ?></h1>
        <?php
        if ($flashdata != null) {
            echo $flashdata;
        }; ?>


        <!-- ROW 1 Modal Tambah Data -->
        <div class="row mb-3">
            <div class="col-xl-4 col-md-4">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah Unit Item
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Menambahkan Data Gudang</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="/warehouse-add-unit">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="nama_unit" class="form-label">Nama Unit</label>
                                        <input type="text" class="form-control" id="nama_unit" name="nama_unit">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- TUTUP ROW 1 -->



        <!-- ROW 2 TABEL -->
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-balance-scale-right"></i>
                        <b>
                            Satuan
                        </b>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-dark table-striped" id="myTable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Bahan</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $i = 1;
                                    foreach ($unit as $row) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= ucwords($row["nama_unit"]); ?></td>
                                            <td class="text-black">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-success btn-edit" data-bs-toggle="modal" data-id-unit="<?= $row["id_unit"] ?>" data-unit-name="<?= $row["nama_unit"] ?>">
                                                    <i class="fas fa-edit"></i>
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
        <!-- TUTUP ROW 2 -->
    </div>
</main>


<!-- Modal -->
<div class="modal fade" id="modal-edit" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-edit-label">Edit Satuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="/warehouse-edit-unit">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_unit" class="form-label">Nama Unit</label>
                        <input type="hidden" class="form-control" id="id_unit" name="id_unit">
                        <input type="text" class="form-control" id="nama_unit" name="nama_unit">
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

<script>
    $(document).ready(function() {
        $(".btn-edit").on("click", function() {
            let modal = $('#modal-edit');
            let btn = $(this);
            modal.modal('toggle');

            modal.find("#id_unit").val(btn.data("id-unit"));
            modal.find("#nama_unit").val(btn.data("unit-name"));
        })
    })
</script>
<?= $this->endsection(); ?>