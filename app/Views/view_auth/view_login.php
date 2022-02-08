<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <!-- Title -->
    <title><?= $title; ?></title>

    <!-- style css dari template -->
    <link href="/admin-template/css/styles.css" rel="stylesheet" />
    <script src="/assets/js/fontawesome.js"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">

                            <!-- buka card -->
                            <div class="card shadow-lg border-0 rounded-lg mt-5">


                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>


                                <!-- Buka form -->
                                <form action="/login" method="POST">
                                    <div class="card-body">
                                        <?php
                                        if ($flashdata != null) {
                                            echo $flashdata;
                                        }; ?>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="username" name="username" type="username" placeholder="Masukkan username" />
                                            <label for="username">Username</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="password" name="password" type="password" placeholder="Password" />
                                            <label for="password">Password</label>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button type="submit" class="btn btn-primary">Login</button>
                                        </div>
                                    </div>
                                </form>
                                <!-- tutup form -->


                            </div>
                            <!-- tutup card -->


                        </div>
                    </div>
                </div>
            </main>
        </div>

        <!-- buka footer -->
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Zaastore 2021</div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- tutup footer -->
    </div>
    <script src="/assets/js/bootstrap.v5.1.0.js" crossorigin="anonymous"></script>
    <script src="/admin-template/js/scripts.js"></script>
</body>

</html>