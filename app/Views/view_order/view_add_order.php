<?= $this->extend("template_dashboard/layout"); ?>
<?= $this->section("content"); ?>
<script>
    $(function() {
        $("#deadline").datepicker();
    });
</script>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-4"><?= $title; ?></h1>
        <?php
        $role_id = $_SESSION["role"];



        if ($flashdata != null) {
            echo $flashdata;
        }; ?>
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        Form Tambah Order
                    </div>
                    <div class="card-body">
                        <form class="row g-3" method="POST" action="<?= base_url("Order/add_order"); ?>" accept-charset="utf-8" enctype="multipart/form-data">
                            <input type="hidden" class="form-control" id="id_user" name="id_user" value="<?= $session["id_user"]; ?>">
                            <h3><?= $session["fullname"]; ?></h3>



                            <div class="col-md-12">
                                <label for="product_type" class="form-label">Jenis Produk</label>
                                <select id="product_type" name="product_type" class="form-select">
                                    <option value="PRE-Nanolight">Pre Order Nanolight</option>
                                    <option value="PRE-Neonflex">Pre Order Neonflex</option>
                                    <option value="PRE-Neonbox">Pre Order Neonbox</option>
                                    <option value="PRE-Huruf-Timbul">Pre Order Huruf Timbul</option>
                                    <option value="REA-N">Ready</option>
                                </select>
                            </div>




                            <div class="col-md-12 mb-3">
                                <label for="image" class="form-label">Upload Desain</label>
                                <input class="form-control" type="file" id="image" name="image[]" placeholder="Upload gambar desain lampu" multiple>
                            </div>


                            <div class="col-md-12">
                                <label for="source_order" class="form-label">Sumber Orderan</label>
                                <select id="source_order" name="source_order" class="form-select">
                                    <option value="Shopee">Shopee</option>
                                    <option value="Tokopedia">Tokopedia</option>
                                    <option value="Whatsapp">Whatsapp</option>
                                    <option value="Lain-lain">Lain-lain</option>
                                </select>
                            </div>



                            <div class="col-md-6">
                                <label for="faktur_code" class="form-label">Kode Faktur</label>
                                <input type="text" class="form-control" id="faktur_code" name="faktur_code" placeholder="Masukkan kode faktur">
                            </div>


                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here" id="design_notes" name="design_notes" style="height: 100px"></textarea>
                                <label for="design_notes">Penjelasan Desain</label>
                            </div>




                            <div class="col-md-6">
                                <label for="size_acrilic" class="form-label">Size Acrilic</label>
                                <input type="text" class="form-control" id="size_acrilic" name="size_acrilic" placeholder="Masukkan ukuran acrilic dalam centimeter">
                            </div>




                            <div class="col-md-6">
                                <label for="font" class="form-label">Font</label>
                                <input type="text" class="form-control" id="font" name="font" placeholder="Masukkan jenis font">
                            </div>




                            <div class="col-md-6">
                                <label for="cable_length" class="form-label">Kabel (Dalam Satuan Centimeter)</label>
                                <input type="text" class="form-control" id="cable_length" name="cable_length" placeholder="Masukkan panjang kabel dalam centimeter">
                            </div>







                            <div class="col-md-6">
                                <label for="adaptor" class="form-label">Adaptor</label>
                                <select id="adaptor" name="adaptor" class="form-select">
                                    <option value="1A">1A</option>
                                    <option value="3A">3A</option>
                                </select>
                            </div>



                            <div class="col-md-12">
                                <label for="adaptor" class="form-label">Tambahan</label>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="waterproof" name="waterproof">
                                        <label class="form-check-label" for="waterproof">
                                            Waterproof
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="controller" name="controller" onclick="myFunctionQuantityController()">
                                        <label class="form-check-label" for="controller">
                                            Controller
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="adhesive" name="adhesive" onclick="myFunctionQuantityAdhesive()">
                                        <label class="form-check-label" for="adhesive">
                                            Perekat
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="switch" name="switch" onclick="myFunctionQuantitySwitch()">
                                        <label class="form-check-label" for="switch">
                                            Saklar On/Off
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="laser_cut" name="laser_cut">
                                        <label class="form-check-label" for="laser_cut">
                                            Laser Cut
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="peniklan" name="peniklan" onclick="myFunctionQuantityPeniklan()">
                                        <label class="form-check-label" for="peniklan">
                                            Peniklan
                                        </label>
                                    </div>
                                </div>
                            </div>



                            <div class="col-md-6" style="display:none" id="container_quantity_controller">
                                <label for="quantity_controller" class="form-label">Jumlah Controller</label>
                                <select id="quantity_controller" name="quantity_controller" class="form-select">
                                    <option disabled selected>Pilih Jumlah</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                            <div class="col-md-6" style="display:none" id="container_quantity_adhesive">
                                <label for="quantity_adhesive" class="form-label">Jumlah Perekat</label>
                                <select id="quantity_adhesive" name="quantity_adhesive" class="form-select">
                                    <option disabled selected>Pilih Jumlah</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                            <div class="col-md-6" style="display:none" id="container_quantity_switch">
                                <label for="quantity_switch" class="form-label">Jumlah Saklar</label>
                                <select id="quantity_switch" name="quantity_switch" class="form-select">
                                    <option disabled selected>Pilih Jumlah</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                            <div class="col-md-6" style="display:none" id="container_quantity_peniklan">
                                <label for="quantity_peniklan" class="form-label">Jumlah Peniklan</label>
                                <select id="quantity_peniklan" name="quantity_peniklan" class="form-select">
                                    <option disabled selected>Pilih Jumlah</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>

                            <script>
                                function myFunctionQuantityAdhesive() {
                                    var checkBox = document.getElementById("adhesive");
                                    var text = document.getElementById("container_quantity_adhesive");
                                    if (checkBox.checked == true) {
                                        text.style.display = "block";
                                    } else {
                                        text.style.display = "none";
                                    }
                                }

                                function myFunctionQuantityController() {
                                    var checkBox = document.getElementById("controller");
                                    var text = document.getElementById("container_quantity_controller");
                                    if (checkBox.checked == true) {
                                        text.style.display = "block";
                                    } else {
                                        text.style.display = "none";
                                    }
                                }

                                function myFunctionQuantitySwitch() {
                                    var checkBox = document.getElementById("switch");
                                    var text = document.getElementById("container_quantity_switch");
                                    if (checkBox.checked == true) {
                                        text.style.display = "block";
                                    } else {
                                        text.style.display = "none";
                                    }
                                }

                                function myFunctionQuantityPeniklan() {
                                    var checkBox = document.getElementById("peniklan");
                                    var text = document.getElementById("container_quantity_peniklan");
                                    if (checkBox.checked == true) {
                                        text.style.display = "block";
                                    } else {
                                        text.style.display = "none";
                                    }
                                }
                            </script>







                            <input type="hidden" class="form-control" id="id_role" name="id_role" value="<?= $role_id; ?>">

                            <?php


                            if ($role_id != 3) {
                            ?>
                                <div class="col-md-12">
                                    <label class="visually-hidden" for="price">Harga</label>
                                    <div class="input-group">
                                        <div class="input-group-text">Harga Barang | Rp. </div>
                                        <input type="text" class="form-control" id="price" name="price" placeholder="Masukkan harga barang">
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <label class="visually-hidden" for="extra_price">Harga</label>
                                    <div class="input-group">
                                        <div class="input-group-text">Harga Tambahan | Rp. </div>
                                        <input type="text" class="form-control" id="extra_price" name="extra_price" placeholder="Masukkan harga tambahan">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="visually-hidden" for="total_price">Harga</label>
                                    <div class="input-group">
                                        <div class="input-group-text">Harga Total | Rp. </div>
                                        <input type="text" class="form-control" id="total_price" name="total_price" placeholder="Total harga" readonly>
                                    </div>
                                </div>

                                <script>
                                    $(document).ready(function() {
                                        var extra_price = $("#extra_price");
                                        var price = $("#price");
                                        extra_price.keyup(function() {
                                            var total = parseInt(extra_price.val()) + parseInt($("#price").val());
                                            if (isNaN(total)) {
                                                total = 0;
                                            }
                                            $("#total_price").val(total);
                                        });

                                        price.keyup(function() {
                                            var total = parseInt(price.val()) + parseInt($("#extra_price").val());
                                            if (isNaN(total)) {
                                                total = 0;
                                            }
                                            $("#total_price").val(total);
                                        });
                                    });
                                </script>



                                <hr class="mt-4">
                                <div class="col-md-12">
                                    <label class="visually-hidden" for="paid_amount">Jumlah Pembayaran</label>
                                    <div class="input-group">
                                        <div class="input-group-text">Jumlah Pembayaran | Rp. </div>
                                        <input type="text" class="form-control" id="paid_amount" name="paid_amount" placeholder="Masukkan jumlah pembayaran">
                                    </div>
                                </div>


                                <div class="col-md-12 mb-3">
                                    <label for="image_payment" class="form-label">Upload Bukti Pembayaran (Optional)</label>
                                    <input class="form-control" type="file" id="image_payment" name="image_payment" placeholder="Upload bukti pembayaran">
                                </div>


                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cb_instalation" name="cb_instalation" onclick="myFunctionCbInstallation()">
                                        <label class="form-check-label" for="cb_instalation">
                                            Pemasangan
                                        </label>
                                    </div>
                                </div>

                            <?php
                            } else {
                            ?>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cb_instalation" name="cb_instalation">
                                        <label class="form-check-label" for="cb_instalation">
                                            Pemasangan
                                        </label>
                                    </div>
                                </div>
                            <?php
                            }; ?>








                            <div class="col-md-12" style="display:none" id="containerinstallation">
                                <label class="visually-hidden" for="installation_price">Jumlah Pemasangan</label>
                                <div class="input-group">
                                    <div class="input-group-text">Biaya Pemasangan | Rp. </div>
                                    <input type="text" class="form-control" id="installation_price" name="installation_price" placeholder="Masukkan biaya pemasangan">
                                </div>
                            </div>


                            <script>
                                function myFunctionCbInstallation() {
                                    var checkBox = document.getElementById("cb_instalation");
                                    var text = document.getElementById("containerinstallation");
                                    if (checkBox.checked == true) {
                                        text.style.display = "block";
                                    } else {
                                        text.style.display = "none";
                                    }
                                }
                            </script>


                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here" id="notes" name="notes" style="height: 100px"></textarea>
                                <label for="notes">Note Tambahan</label>
                            </div>




                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here" id="address" name="address" style="height: 100px"></textarea>
                                <label for="address">Alamat</label>
                            </div>





                            <div class="col-12">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Simpan Orderan
                                </button>
                            </div>





                            <!-- Modal -->
                            <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog  modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah anda yakin data yang dimasukkan sudah benar ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="Submit" class="btn btn-primary">Confirm</button>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?= $this->endsection(); ?>