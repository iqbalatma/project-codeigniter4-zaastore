<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-4"><?= $title; ?></h1>
        <?php
        if ($flashdata != null) {
            echo $flashdata;
        }; ?>
        <div class="row mb-3">
            <div class="col-xl-4 col-md-4">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah Data Gudang
                </button>
                <a href="<?= base_url("PDF/print_pdf?title=Stok Gudang&view=pdf_warehouse"); ?>" class="btn btn-primary">Cetak PDF</a>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Menambahkan Data Gudang</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="<?= base_url("Warehouse/add_item"); ?>">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="fullname" class="form-label">Nama Bahan</label>
                                        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Masukkan nama bahan">
                                    </div>
                                    <div class="mb-3">
                                        <label for="threshold" class="form-label">Ambang Batas Kuantitas</label>
                                        <input type="text" class="form-control" id="threshold" name="threshold" placeholder="Ambang batas kuantitas bahan baku">
                                    </div>
                                    <div class="mb-3">
                                        <select class="form-select" aria-label="Default select example" required id="unit" name="id_unit">
                                            <option selected disabled>-Pilih Satuan Barang-</option>
                                            <?php foreach ($unit as $row) : ?>
                                                <option value="<?= $row["id_unit"]; ?>"><?= ucwords($row["nama_unit"]); ?></option>
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
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="table-responsive">
                    <table class="table table-dark table-striped" id="myTable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Bahan</th>
                                <th scope="col">Nama Teknisi</th>
                                <th scope="col">Gambar Produk</th>
                                <th scope="col">Catatan Tambahan</th>
                                <th scope="col">Catatan Desain</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($order as $row) :  ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= ucwords($row["order_code"]); ?></td>
                                    <td><?= ucwords($row["id_technician"]); ?></td>
                                    <td><img src="<?= ($row["image_product"]); ?>" alt=""></td>
                                    <td><?= ucwords($row["notes"]); ?></td>
                                    <td><?= ucwords($row["design_notes"]); ?></td>





                                    <td class="text-black">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal_edit<?= $row["id_order"] ?>">
                                            Edit
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modal_edit<?= $row["id_order"] ?>" tabindex="-1" aria-labelledby="modal_edit<?= $row["id_order"] ?>Label" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modal_edit<?= $row["id_order"] ?>Label">Modal Edit <?= $row["order_code"]; ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form method="POST" action="<?= base_url("Darurat/edit_item"); ?>">
                                                        <div class="modal-body">
                                                            <input type="hidden" class="form-control" id="id_order" name="id_order" value="<?= $row["id_order"]; ?>">

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
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
</main>