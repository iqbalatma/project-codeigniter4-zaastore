<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-4"><?= $title; ?></h1>

        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card-body">
                    <?php
                    if ($flashdata != null) {
                        echo $flashdata;
                    }; ?>

                    <form class="row g-3" method="POST" action="<?= base_url("Auth/progress_registration"); ?>">
                        <div class="col-md-12">
                            <label for="fullname" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="fullname" name="fullname">
                        </div>
                        <div class="col-md-12">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <div class="col-md-12">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="col-md-12">
                            <label for="phonenumber" class="form-label">Nomor Hp</label>
                            <input type="text" class="form-control" id="phonenumber" name="phonenumber">
                        </div>
                        <div class="col-md-4">

                            <label for="id_role" class="form-label">State</label>
                            <select id="id_role" name="id_role" class="form-select">
                                <option selected disabled>Pilih Role</option>
                                <?php foreach ($role as $row) : ?>
                                    <option value="<?= $row["id_role"]; ?>"><?= ucwords($row["role_name"]); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Daftarkan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>