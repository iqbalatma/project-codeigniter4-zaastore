<?php echo $this->extend("template_dashboard/layout");
echo $this->section("content");
?>
<main>
    <div class="container-fluid px-4">

        <!-- Title -->
        <h1 class="mt-4 mb-4"><?= $title; ?></h1>
        <!-- tutup title -->

        <!-- flash data -->
        <?php
        if ($flashdata != null) {
            echo $flashdata;
        }; ?>
        <!-- tutup flash data -->


        <!-- ROW 1 -->
        <div class="row mb-3">
            <div class="col-xl-4 col-md-4">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_tambah_data_gudang">
                    <b>Tambah Data Gudang</b> <i class="fas fa-plus-circle"></i>
                </button>
            </div>
        </div>
        <!-- TUTUP ROW 1 -->


        <!-- ROW 2 -->
        <div class="row">
            <div class="col-xl-12 col-md-12">

                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-warehouse"></i>
                        <b>
                            Data Stok Gudang
                        </b>
                    </div>
                    <div class="card-body">
                        <!-- buka Tabel -->
                        <div class="table-responsive">
                            <table class="table table-dark table-striped" id="myTable">

                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Bahan</th>
                                        <th scope="col">Satuan</th>
                                        <th scope="col">Kuantitas</th>
                                        <th scope="col">Ambang Batas</th>
                                        <th scope="col">Update Terakhir</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($warehouse as $row) :  ?>
                                        <tr>
                                            <th scope="row"><?= $i; ?></th>
                                            <td><?= ucwords($row["fullname"]); ?></td>
                                            <td><?= ucwords($row["nama_unit"]); ?></td>
                                            <td><?= $row["quantity"]; ?></td>
                                            <td><?= $row["threshold"]; ?></td>
                                            <td><?= $row["update_at"]; ?></td>
                                            <td class="text-black">
                                                <!-- Button trigger modal edit-->
                                                <button type="button" class="btn btn-success btn-edit" data-bs-toggle="modal" data-id-bahan-baku="<?= $row["id_bahan_baku"] ?>" data-fullname="<?= $row["fullname"] ?>" data-threshold="<?= $row["threshold"] ?>" data-id-unit="<?= $row["id_unit"] ?>">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <!-- tutup button trigger modal edit -->
                                            </td>
                                        </tr>
                                    <?php
                                        $i++;
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

<!-- Modal edit -->
<div class="modal fade" id="modal-edit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">


            <div class="modal-header">
                <h5 class="modal-title" id="modal-edit-label">Modal Edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <form method="POST" action="/warehouse-edit-item">
                <div class="modal-body">

                    <input type="hidden" class="form-control" id="id_bahan_baku" name="id_bahan_baku">


                    <div class="mb-3">
                        <label for="fullname" class="form-label">Nama Bahan</label>
                        <input type="text" class="form-control" id="fullname" name="fullname">
                    </div>


                    <div class="mb-3">
                        <label for="threshold" class="form-label">Ambang Batas</label>
                        <input type="text" class="form-control" id="threshold" name="threshold">
                    </div>


                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" required id="id_unit" name="id_unit">
                            <?php foreach ($unit as $row_unit) : ?>
                                <option value="<?= $row_unit["id_unit"]; ?>"><?= ucwords($row_unit["nama_unit"]); ?></option>
                            <?php endforeach; ?>
                        </select>
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
<!-- Tutup modal edit -->

<!-- Modal Tambah data gudang -->
<div class="modal fade" id="modal_tambah_data_gudang" tabindex="-1" aria-labelledby="modal_tambah_data_gudangLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Menambahkan Data Gudang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="/warehouse-add-item">


                <!-- modal body -->
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="fullname" class="form-label">Nama Bahan</label>
                        <input type="text" class="form-control" id="fullname-add" name="fullname" placeholder="Masukkan nama bahan">
                    </div>


                    <div class="mb-3">
                        <label for="threshold" class="form-label">Ambang Batas Kuantitas</label>
                        <input type="text" class="form-control" id="threshold-add" name="threshold" placeholder="Ambang batas kuantitas bahan baku">
                    </div>


                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" required id="unit-add" name="id_unit">
                            <option selected disabled>-Pilih Satuan Barang-</option>
                            <?php foreach ($unit as $row) : ?>
                                <option value="<?= $row["id_unit"]; ?>"><?= ucwords($row["nama_unit"]); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                </div>
                <!-- tutup modal body -->


                <!-- modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                <!-- tutup modal footer -->


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

            modal.find("#id_bahan_baku").val(btn.data("id-bahan-baku"));
            modal.find("#fullname").val(btn.data("fullname"));
            modal.find("#threshold").val(btn.data("threshold"));
            modal.find("#id_unit option[value='" + btn.data("id-unit") + "']").attr("selected", "selected");
        })
    })
</script>


<?= $this->endsection(); ?>