<?= $this->extend("template_dashboard/layout"); ?>
<?= $this->section("content"); ?>


<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-4"><?= $title; ?></h1>
        <?php
        if ($flashdata != null) {
            echo $flashdata;
        }; ?>


        <!-- ROW 1 Modal tambah data -->
        <div class="row mb-3">
            <div class="col-xl-4 col-md-4">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <b>Tambah Transaksi Gudang</b> <i class="fas fa-plus-circle"></i>
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Menambahkan Data Gudang</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="warehouse-add-transaction">
                                <div class="modal-body">
                                    <input type="hidden" class="form-control" id="id_user-add" name="id_user" value="<?= $session["id_user"]; ?>">

                                    <div class="mb-3">
                                        <select class="form-select" aria-label="Default select example" required id="id_bahan_baku-add" name="id_bahan_baku">
                                            <option selected disabled>Pilih Bahan</option>
                                            <?php
                                            foreach ($warehouse as $row) :
                                            ?>
                                                <option value="<?= $row["id_bahan_baku"]; ?>"><?= $row["fullname"]; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="quantity" class="form-label">Kuantitas</label>
                                        <input type="text" class="form-control" id="quantity-add" name="quantity">
                                    </div>
                                    <div class="mb-3">
                                        <select class="form-select" aria-label="Default select example" required id="jenis_transaksi-add" name="jenis_transaksi">
                                            <option selected disabled>Pilih Jenis Transaksi</option>
                                            <option value="masuk">Masuk</option>
                                            <option value="keluar">Keluar</option>
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
        <!-- TUTUP ROW 1 -->



        <!-- ROW 2 -->
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-retweet"></i>
                        <b>
                            Data Transaksi
                        </b>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-dark table-striped" id="myTable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Bahan</th>
                                        <th scope="col">Satuan</th>
                                        <th scope="col">Kuantitas</th>
                                        <th scope="col">Status Transaksi</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($warehouse_transaction as $row) :  ?>
                                        <tr>
                                            <th scope="row"><?= $i; ?></th>
                                            <td><?= ucwords($row["fullname"]); ?></td>
                                            <td><?= ucwords($row["nama_unit"]); ?></td>
                                            <td><?= $row["quantity"]; ?></td>
                                            <td><?= $row["jenis_transaksi"]; ?></td>
                                            <td><?= $row["date"]; ?></td>
                                            <td>
                                                <!-- Edit Transaksi -->
                                                <button type="button" class="btn btn-success btn-edit" data-bs-toggle="modal" data-id-transaction="<?= $row["id_transaction"] ?>" data-id-bahan-baku="<?= $row["id_bahan_baku"] ?>" data-quantity-before="<?= $row["quantity"] ?>" data-jenis-transaksi="<?= $row["jenis_transaksi"] ?>" data-nama-bahan="<?= $row["fullname"] ?>">
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
        <!-- tutup ROW 2 -->
    </div>
</main>


<!-- Modal Edit Transaksi -->
<div class="modal fade" id="modal-edit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-edit-label">Edit Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="/warehouse-edit-transaction">
                <div class="modal-body">

                    <input type="hidden" class="form-control" id="id_transaction" name="id_transaction">
                    <input type="hidden" class="form-control" id="id_bahan_baku" name="id_bahan_baku">
                    <input type="hidden" class="form-control" id="quantity_before" name="quantity_before">
                    <input type="hidden" class="form-control" id="jenis_transaksi2" name="jenis_transaksi2">

                    <div class="mb-3">
                        <label for="nama_bahan" class="form-label">Nama Bahan</label>
                        <input type="text" class="form-control" id="nama_bahan" name="nama_bahan" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Kuantitas</label>
                        <input type="text" class="form-control" id="quantity" name="quantity">
                    </div>
                    <div class="mb-3">
                        <select disabled class="form-select" aria-label="Default select example" required id="jenis_transaksi" name="jenis_transaksi">
                            <option value='keluar'>Keluar</option>
                            <option value='masuk'>Masuk</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
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

            modal.find("#id_transaction").val(btn.data("id-transaction"));
            modal.find("#id_bahan_baku").val(btn.data("id-bahan-baku"));
            modal.find("#quantity_before").val(btn.data("quantity-before"));
            modal.find("#jenis_transaksi2").val(btn.data("jenis-transaksi"));
            modal.find("#nama_bahan").val(btn.data("nama-bahan"));
            modal.find("#quantity").val(btn.data("quantity-before"));
            modal.find("#jenis_transaksi option[value='" + btn.data("jenis-transaksi") + "']").attr("selected", "selected");
        })
    })
</script>
<?= $this->endsection(); ?>