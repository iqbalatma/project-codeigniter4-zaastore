<?php echo $this->extend("template_dashboard/layout");
echo $this->section("content");
?>

<main>
    <div class="container-fluid px-4">
        <!-- Judul Konten -->
        <h1 class="mt-4 mb-4"><?= $title; ?></h1>
        <!-- Tutup judul konten -->


        <!-- Flash data -->
        <?php
        if ($flashdata != null) {
            echo $flashdata;
        }; ?>
        <!-- tutup flash data -->





        <!-- ROW 1 -->
        <div class="row mb-3">
            <div class="col-xl-4 col-md-4">

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah Akun
                </button>
                <!-- Tutup button trigger modal -->


                <!-- Modal Tambah Akun-->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambahkan Akun</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form class="row g-3" method="POST" action="/registration-account">
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <label for="fullname" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="fullname-add" name="fullname">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username-add" name="username">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password-add" name="password">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="phonenumber" class="form-label">Nomor Hp</label>
                                        <input type="text" class="form-control" id="phonenumber-add" name="phonenumber">
                                    </div>
                                    <div class="col-md-4">

                                        <label for="id_role" class="form-label">State</label>
                                        <select id="id_role-add" name="id_role" class="form-select">
                                            <option selected disabled>Pilih Role</option>
                                            <?php foreach ($role as $row) : ?>
                                                <option value="<?= $row["id_role"]; ?>"><?= ucwords($row["role_name"]); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>

                                    </div>



                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Daftarkan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Tutup modal tambah akun -->


            </div>
        </div>
        <!-- TUTUP ROW 1 -->



        <!-- ROW 2 -->
        <div class="row">

            <!-- COL1 -->
            <div class="col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b>
                            <i class="fas fa-users-cog"></i> Table Daftar Akun
                        </b>
                    </div>
                    <div class="card-body">
                        <!-- BUKA TABLE RESPONSIVE -->
                        <div class="table-responsive">
                            <table class="table table-dark table-striped" id="myTable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Pengguna</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Password</th>
                                        <th scope="col">Nomor HP</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Status Aktif</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($users as $row) :
                                        $is_deleted = $row["is_deleted"];
                                    ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= ucwords($row["fullname"]); ?></td>
                                            <td><?= ($row["username"]); ?></td>
                                            <td><?= ($row["password"]); ?></td>
                                            <td><?= ($row["phonenumber"]); ?></td>
                                            <td><?= ucwords($row["role_name"]); ?></td>
                                            <td>
                                                <?php
                                                if ($is_deleted == 1) {
                                                    echo "Tidak Aktif";
                                                } else {
                                                    echo "Aktif";
                                                }
                                                ?></td>
                                            <td>
                                                <!-- Button Modal Edit List Akun -->
                                                <button type="button" class="btn btn-success btn-edit" data-id-user="<?= $row["id_user"] ?>" data-username="<?= $row["username"] ?>" data-password="<?= $row["password"] ?>" data-phonenumber="<?= $row["phonenumber"] ?>" data-role-name="<?= $row["role_name"] ?>" data-fullname="<?= $row["fullname"] ?>" data-id-role="<?= $row["id_role"] ?>" data-is-deleted="<?= $is_deleted ?>" data-bs-toggle="modal">
                                                    <i class="fas fa-edit">
                                                    </i>
                                                </button>
                                                <!-- Tutup Button Modal Edit List Akun -->
                                            </td>
                                        </tr>

                                    <?php
                                        $i++;
                                    endforeach; ?>
                                </tbody>


                            </table>
                        </div>
                        <!-- TUTUP TABLE RESPONSIVE -->
                    </div>
                </div>




            </div>
            <!-- TUTUP COL1 -->


        </div>
        <!-- TUTUP ROW 2 -->


    </div>
</main>


<!-- Modal edit akun -->
<div class="modal fade text-black" id="modal-edit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form class="row g-3" method="POST" action="/edit-account">
                <div class="modal-body">


                    <input type="hidden" class="form-control" id="id_user" name="id_user">


                    <div class="col-md-12">
                        <label for="fullname" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="fullname" name="fullname">
                    </div>


                    <div class="col-md-12">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username">
                    </div>


                    <div class=" col-md-12">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>


                    <div class="col-md-12">
                        <label for="phonenumber" class="form-label">Nomor Hp</label>
                        <input type="text" class="form-control" id="phonenumber" name="phonenumber">
                    </div>


                    <div class="col-md-4">
                        <label for="id_role" class="form-label">Role </label>
                        <select id="id_role" name="id_role" class="form-select">
                            <option selected disabled>Pilih Role</option>
                            <?php foreach ($role as $row2) :
                            ?>
                                <option value="<?= $row2["id_role"]; ?>"><?= ucwords($row2["role_name"]); ?>
                                </option>
                            <?php
                            endforeach; ?>
                        </select>
                    </div>


                    <div class="col-md-4">
                        <label for="is_deleted" class="form-label">Status Aktif</label>
                        <select id="is_deleted" name="is_deleted" class="form-select">
                            <option value="1">Tidak Aktif</option>
                            <option value="0">Aktif</option>
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
<!-- Tutup Modal edit akun -->


<script>
    $(document).ready(function() {
        $(".btn-edit").on("click", function() {
            let modal = $('#modal-edit');
            let btn = $(this);
            modal.modal('toggle');

            modal.find("#id_user").val(btn.data("id-user"));
            modal.find("#fullname").val(btn.data("fullname"));
            modal.find("#username").val(btn.data("username"));
            modal.find("#password").val(btn.data("password"));
            modal.find("#phonenumber").val(btn.data("phonenumber"));

            modal.find("#id_role option[value='" + btn.data("id-role") + "']").attr("selected", "selected");
            modal.find("#is_deleted option[value='" + btn.data("is-deleted") + "']").attr("selected", "selected");
        })
    })
</script>
<?= $this->endsection(); ?>