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

                <!-- STATUS TOGGLE -->
                <div class="btn-group mb-3" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="btnradio" id="cb-on-progress" autocomplete="off">
                    <button class="btn btn-outline-primary" id="btn-on-progress" for="cb-on-progress">Belum Selesai</button>


                    <input type="radio" class="btn-check" name="btnradio" id="cb-done" autocomplete="off">
                    <button class="btn btn-outline-primary" id="btn-done" for="cb-done">Sudah Selesai</button>
                </div>

                <!-- TABLE CARD -->
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-tools"></i>
                        <b>
                            Installation
                        </b>
                    </div>
                    <div class="card-body">
                        <!-- FILTER -->
                        <div class="row mb-4" id="filter-container" style="display: none;">
                            <div class="col-xl-4 col-md-4">
                                <select class="form-select" aria-label="Default select example" name="month" id="month-filter">
                                    <option selected disabled>Pilih Bulan Untuk Filter</option>
                                    <?php foreach (getMonthList() as $key => $value) {
                                    ?>
                                        <option value="<?= $key + 1 ?>"><?= $value ?></option>
                                    <?php
                                    } ?>
                                </select>
                            </div>
                            <div class="col-xl-4 col-md-4">
                                <select class="form-select" aria-label="Default select example" name="year" id="year-filter">
                                    <option selected disabled>Pilih Tahun Untuk Filter</option>
                                    <?php $counter_year = 2021;
                                    while ($counter_year < 2030) {
                                    ?>
                                        <option value="<?= $counter_year; ?>"><?= $counter_year; ?></option>
                                    <?php
                                        $counter_year++;
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-xl-4 col-md-4">
                                <button class="btn btn-primary" id="btn-filter" type="button">Filter</button>
                                <button class="btn btn-primary" id="btn-all-done" type="button">Tampilkan Semua Data</button>
                            </div>
                        </div>


                        <!-- TABLE -->
                        <div class="table-responsive" id="table-container">
                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kode Order</th>
                                        <th scope="col">Pemasangan Selesai</th>
                                        <th scope="col">Ukuran Akrilik</th>
                                        <th scope="col">Panjang Kabel</th>
                                        <th scope="col">Adaptor</th>
                                        <th scope="col">Item Tambahan</th>
                                        <th scope="col">Catatan Desain</th>
                                        <th scope="col">Catatan Tambahan</th>
                                        <th scope="col">Nama Installer</th>
                                        <th scope="col">Biaya Pemasangan</th>
                                        <th scope="col">Status</th>
                                        <th scope='col'>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($installer as $row) : ?>
                                        <tr>
                                            <th scope="row"><?= $i; ?></th>
                                            <td><?= $row["order_code"]; ?></td>
                                            <td><?= $row["date_installation_done"]; ?></td>
                                            <td><?= $row["size_acrilic"]; ?></td>
                                            <td><?= $row["cable_length"]; ?></td>
                                            <td><?= $row["adaptor"]; ?></td>
                                            <td> <?php if ($row["waterproof"] != null) {
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
                                            <td><?= $row["design_notes"]; ?></td>
                                            <td><?= $row["notes"]; ?></td>
                                            <td><?= $user_technician->get_technician($row["id_installer"])[0]["fullname"] ?></td>
                                            <td><?= intToRupiah($row["installation_price"]); ?></td>
                                            <td><?= getStatusName($row["id_status"]); ?>
                                            <td>
                                                <button type="button" class="btn btn-success btn-edit" data-id-installer="<?= $row["id_installer"] ?>" data-id-order="<?= $row["id_order"] ?>" data-bs-toggle="modal">
                                                    <i class="fas fa-users-cog"></i>
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

    </div>
</main>


<!-- Modal edit -->
<div class="modal fade" id="modal-edit" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form action="/installer-update-installer" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Ganti Teknisi Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <!-- id order -->
                    <input type="hidden" name="id_order" id="id_order">


                    <!-- id_technician didapat pada id_user -->
                    <label for="installer" class="form-label">Pilih Teknisi</label>
                    <select class="form-select" aria-label="Default select example" id="installer" name="installer">
                        <?php foreach ($listInstaller as $row) :
                        ?>
                            <option value="<?= $row["id_user"]; ?>"><?= $row["fullname"]; ?></option>
                        <?php
                        endforeach; ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#cb-on-progress").prop("checked", true);
        $("#myTable").DataTable();


        function onClickBtnEdit(context) {
            let btn = $(context);
            let idOrder = btn.data("id-order");
            let idInstaller = btn.data("id-installer");
            let modal = $("#modal-edit");
            modal.modal("toggle");
            modal.find("#installer option[value='" + idInstaller + "']").attr("selected", "selected");
            modal.find("#id_order").val(idOrder);
        }

        function filterDone(link) {

            let rowThead = ` <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Order</th>
                                    <th scope="col">Pemasangan Selesai</th>
                                    <th scope="col">Ukuran Akrilik</th>
                                    <th scope="col">Panjang Kabel</th>
                                    <th scope="col">Adaptor</th>
                                    <th scope="col">Item Tambahan</th>
                                    <th scope="col">Catatan Desain</th>
                                    <th scope="col">Catatan Tambahan</th>
                                    <th scope="col">Nama Installer</th>
                                    <th scope="col">Biaya Pemasangan</th>
                                    <th scope="col">Status</th>
                                </tr>`;

            $.ajax({
                url: link,
                type: "GET",
            }).done(function(responseAjax) {
                let tableContainer = $("#table-container");
                tableContainer.children().remove();

                let table = $("<table>", {
                    class: "table",
                    id: "myTable"
                }).appendTo(tableContainer);


                let thead = $("<thead>").append(rowThead).appendTo(table);
                let tbody = $("<tbody>").appendTo(table);

                let dataTable = $("#myTable").DataTable();

                responseAjax.forEach((data, index) => {
                    $.ajax({
                        url: `/api/installer-name/${data.id_installer}`,
                        type: "GET",
                    }).done(function(installerName) {
                        let dateInstallation = "";
                        if (data.date_installation_done != null) {
                            dateInstallation = data.date_installation_done
                        }
                        let additionalItems = "";
                        if (data.waterproof != null) {
                            additionalItems += "Waterproof, <br>";
                        }
                        if (data.adhesive != null) {
                            additionalItems += `Perekat = ${data.adhesive},<br>`;
                        }
                        if (data.switch != null) {
                            additionalItems += `Saklar = ${data.switch},<br>`;
                        }
                        if (data.laser_cut != null) {
                            additionalItems += `Laser Cut,<br>`;
                        }
                        if (data.peniklan != null) {
                            additionalItems += `Peniklan = ${data.peniklan},`;
                        }



                        let objectRow = [
                            index + 1,
                            data.order_code,
                            dateInstallation,
                            data.size_acrilic,
                            data.cable_length,
                            data.adaptor,
                            additionalItems,
                            data.design_notes,
                            data.notes,
                            installerName,
                            intToRupiah(data.installation_price),
                            getStatusName(data.id_status),
                        ];
                        dataTable.row.add(objectRow).draw();
                    });
                })


                if (responseAjax.length == 0) {
                    return Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Data tidak ditemukan !',
                    })
                } else {
                    return Swal.fire(
                        'Good job!',
                        'Filter data berhasil !',
                        'success'
                    )
                }
            });
        }

        $(".btn-edit").on("click", function() {
            onClickBtnEdit(this)
        })


        $("#btn-on-progress").on("click", function() {
            $("#filter-container").hide();

            let btn = $(this);
            let cb = $("#cb-on-progress");
            let cbRemove = $("#cb-done").removeAttr("checked");
            cb.prop("checked", true)

            let rowThead = ` <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Order</th>
                                    <th scope="col">Pemasangan Selesai</th>
                                    <th scope="col">Ukuran Akrilik</th>
                                    <th scope="col">Panjang Kabel</th>
                                    <th scope="col">Adaptor</th>
                                    <th scope="col">Item Tambahan</th>
                                    <th scope="col">Catatan Desain</th>
                                    <th scope="col">Catatan Tambahan</th>
                                    <th scope="col">Nama Installer</th>
                                    <th scope="col">Biaya Pemasangan</th>
                                    <th scope="col">Status</th>
                                    <th scope='col'>Action</th>
                                </tr>`;

            $.ajax({
                url: `/api/installation-progress`,
                type: "GET",
            }).done(function(responseAjax) {
                let tableContainer = $("#table-container");
                tableContainer.children().remove();

                let table = $("<table>", {
                    class: "table",
                    id: "myTable"
                }).appendTo(tableContainer);


                let thead = $("<thead>").append(rowThead).appendTo(table);
                let tbody = $("<tbody>").appendTo(table);

                let dataTable = $("#myTable").DataTable();

                responseAjax.forEach((data, index) => {
                    $.ajax({
                        url: `/api/installer-name/${data.id_installer}`,
                        type: "GET",
                    }).done(function(installerName) {
                        let dateInstallation = "";
                        if (data.date_installation_done != null) {
                            dateInstallation = data.date_installation_done
                        }
                        let additionalItems = "";
                        if (data.waterproof != null) {
                            additionalItems += "Waterproof, <br>";
                        }
                        if (data.adhesive != null) {
                            additionalItems += `Perekat = ${data.adhesive},<br>`;
                        }
                        if (data.switch != null) {
                            additionalItems += `Saklar = ${data.switch},<br>`;
                        }
                        if (data.laser_cut != null) {
                            additionalItems += `Laser Cut,<br>`;
                        }
                        if (data.peniklan != null) {
                            additionalItems += `Peniklan = ${data.peniklan},`;
                        }


                        let button = `<button type="button" class="btn btn-success btn-edit" data-id-technician="${data.id_installation}" data-id-order="${data.id_order}" data-bs-toggle="modal">
                                                        <i class="fas fa-users-cog"></i>
                                                    </button>`;
                        let objectRow = [
                            index + 1,
                            data.order_code,
                            dateInstallation,
                            data.size_acrilic,
                            data.cable_length,
                            data.adaptor,
                            additionalItems,
                            data.design_notes,
                            data.notes,
                            installerName,
                            intToRupiah(data.installation_price),
                            getStatusName(data.id_status),
                            button,
                        ];
                        dataTable.row.add(objectRow).draw();
                        $(".btn-edit").on("click", function() {
                            onClickBtnEdit(this)
                        })
                    });
                })

                if (responseAjax.length == 0) {
                    return Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Data tidak ditemukan !',
                    })
                } else {
                    return Swal.fire(
                        'Good job!',
                        'Filter data berhasil !',
                        'success'
                    )
                }
            });
        });


        $("#btn-done").on("click", function() {
            $("#filter-container").show();

            let btn = $(this);
            let cb = $("#cb-done");
            let cbRemove = $("#cb-on-progress").removeAttr("checked");
            cb.prop("checked", true)


            let rowThead = `<tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Order</th>
                                    <th scope="col">Pemasangan Selesai</th>
                                    <th scope="col">Ukuran Akrilik</th>
                                    <th scope="col">Panjang Kabel</th>
                                    <th scope="col">Adaptor</th>
                                    <th scope="col">Item Tambahan</th>
                                    <th scope="col">Catatan Desain</th>
                                    <th scope="col">Catatan Tambahan</th>
                                    <th scope="col">Nama Installer</th>
                                    <th scope="col">Biaya Pemasangan</th>
                                    <th scope="col">Status</th>
                                </tr>`;



            $.ajax({
                url: `/api/installation-done/monthly`,
                type: "GET",
            }).done(function(responseAjax) {
                let tableContainer = $("#table-container");
                tableContainer.children().remove();

                let table = $("<table>", {
                    class: "table",
                    id: "myTable"
                }).appendTo(tableContainer);

                let thead = $("<thead>").append(rowThead).appendTo(table);
                let tbody = $("<tbody>").appendTo(table);

                let dataTable = $("#myTable").DataTable();

                responseAjax.forEach((data, index) => {
                    $.ajax({
                        url: `/api/installer-name/${data.id_installer}`,
                        type: "GET",
                    }).done(function(installerName) {
                        let dateInstallation = "";
                        if (data.date_installation_done != null) {
                            dateInstallation = data.date_installation_done
                        }
                        let additionalItems = "";
                        if (data.waterproof != null) {
                            additionalItems += "Waterproof, <br>";
                        }
                        if (data.adhesive != null) {
                            additionalItems += `Perekat = ${data.adhesive},<br>`;
                        }
                        if (data.switch != null) {
                            additionalItems += `Saklar = ${data.switch},<br>`;
                        }
                        if (data.laser_cut != null) {
                            additionalItems += `Laser Cut,<br>`;
                        }
                        if (data.peniklan != null) {
                            additionalItems += `Peniklan = ${data.peniklan},`;
                        }



                        let objectRow = [
                            index + 1,
                            data.order_code,
                            dateInstallation,
                            data.size_acrilic,
                            data.cable_length,
                            data.adaptor,
                            additionalItems,
                            data.design_notes,
                            data.notes,
                            installerName,
                            intToRupiah(data.installation_price),
                            getStatusName(data.id_status),
                        ];
                        dataTable.row.add(objectRow).draw();
                    });
                })


                if (responseAjax.length == 0) {
                    return Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Data tidak ditemukan !',
                    })
                } else {
                    return Swal.fire(
                        'Good job!',
                        'Filter data berhasil !',
                        'success'
                    )
                }
            });
        });

        $("#btn-all-done").on("click", function() {
            filterDone(`/api/installation-done/all`);
        });

        $("#btn-filter").on("click", function() {
            let month = $("#month-filter").val();
            let year = $("#year-filter").val();

            if (month == null) {
                return Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Bulan belum dipilih !',
                })
            }
            if (year == null) {
                return Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Tahun belum dipilih !',
                })
            }

            filterDone(`/api/installation-done/monthly/${month}/${year}`);
        });




    })
</script>
<?= $this->endsection(); ?>