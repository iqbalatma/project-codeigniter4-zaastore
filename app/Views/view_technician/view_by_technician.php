<?= $this->extend("template_dashboard/layout"); ?>
<?= $this->section("content"); ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-4"><?= $title; ?></h1>
        <div class="row mb-4">
            <div class="col-xl-12 col-md-12">

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-filter"></i>
                        <b>
                            Filter Data
                        </b>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4" id="filter-container">
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
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xl-12 col-md-12" id="container-card">
                <?php foreach ($user_technician as $row) :
                    $data_order_technician = $order_technician->getAllDataOrderByUserId("monthly", $row["id_user"]);
                    if (count($data_order_technician) != 0) {
                ?>
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5><i class="fas fa-user"></i> <?= $row["fullname"]; ?></h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Kode Order</th>
                                                <th scope="col">Produksi Selesai</th>
                                                <th scope="col">Ukuran Akrilik</th>
                                                <th scope="col">Panjang Kabel</th>
                                                <th scope="col">Adaptor</th>
                                                <th scope="col">Item Tambahan</th>
                                                <th scope="col">Catatan Desain</th>
                                                <th scope="col">Catatan Tambahan</th>
                                                <th scope="col">Nama Teknisi</th>
                                                <th scope="col">Harga Barang</th>
                                                <th scope="col">Status</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($data_order_technician as $key => $row2) : ?>
                                                <tr>
                                                    <th scope="row"><?= $key + 1; ?></th>
                                                    <td><?= $row2["order_code"]; ?></td>
                                                    <td><?= $row2["date_production_done"]; ?></td>
                                                    <td><?= $row2["size_acrilic"]; ?></td>
                                                    <td><?= $row2["cable_length"]; ?></td>
                                                    <td><?= $row2["adaptor"]; ?></td>
                                                    <td><?php if ($row2["waterproof"] != null) {
                                                            echo "Waterproof, ";
                                                            echo "<br>";
                                                        }
                                                        if ($row2["adhesive"] != null) {
                                                            echo "Perekat =  " . $row2['adhesive'] . ",";
                                                            echo "<br>";
                                                        }
                                                        if ($row2["switch"] != null) {
                                                            echo "Saklar = " . $row2['switch'] . ",";
                                                            echo "<br>";
                                                        }
                                                        if ($row2["laser_cut"] != null) {
                                                            echo "Laser Cut,";
                                                            echo "<br>";
                                                        }
                                                        if ($row2["peniklan"] != null) {
                                                            echo "Peniklan = " . $row2['peniklan'];
                                                            echo "<br>";
                                                        }
                                                        ?></td>
                                                    <td><?= $row2["design_notes"]; ?></td>
                                                    <td><?= $row2["notes"]; ?></td>
                                                    <td><?= $row["fullname"]; ?></td>
                                                    <td><?= intToRupiah($row2["price"]); ?></td>
                                                    <td><?= getStatusName($row2["id_status"]); ?>
                                                </tr>
                                            <?php
                                            endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                endforeach; ?>


            </div>
        </div>

    </div>
</main>
<script>
    $(document).ready(function() {
        $(".table").DataTable();


        function filterDone(link, fullname, containerCard) {
            $.ajax({
                url: link,
                type: "GET",
            }).done(function(responseAjaxOrder) {
                if (responseAjaxOrder.length > 0) {
                    let card = $("<div>").addClass("card mb-4");
                    let cardHeader = $("<div>").addClass("card-header");
                    let cardLabel = $("<h5>").append($("<i>").addClass("fas fa-user")).append(" " + fullname);
                    let cardBody = $("<div>").addClass("card-body");


                    let tableResponsive = $("<div>").addClass("table-responsive");
                    let table = $("<table>").addClass("table");
                    let thead = $("<thead>").append($("<tr>").append($("<th>", {
                        text: "No"
                    })).append($("<th>", {
                        text: "Kode Order"
                    })).append($("<th>", {
                        text: "Produksi Selesai"
                    })).append($("<th>", {
                        text: "Ukuran Akrilik"
                    })).append($("<th>", {
                        text: "Panjang Kabel"
                    })).append($("<th>", {
                        text: "Adaptor"
                    })).append($("<th>", {
                        text: "Item Tambahan"
                    })).append($("<th>", {
                        text: "Catatan Desain"
                    })).append($("<th>", {
                        text: "Catatan Tambahan"
                    })).append($("<th>", {
                        text: "Nama Teknisi"
                    })).append($("<th>", {
                        text: "Harga Barang"
                    })).append($("<th>", {
                        text: "Status"
                    })));
                    tableResponsive.append(table.append(thead));

                    card.append(cardHeader.append(cardLabel)).append(cardBody.append(tableResponsive)).appendTo(containerCard);

                    let dataTable = $(table).DataTable();

                    responseAjaxOrder.forEach((data, index) => {
                        let dateProduction = "";
                        if (data.date_production_done != null) {
                            dateProduction = data.date_production_done
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
                            dateProduction,
                            data.size_acrilic,
                            data.cable_length,
                            data.adaptor,
                            additionalItems,
                            data.design_notes,
                            data.notes,
                            data.fullname,
                            intToRupiah(data.price),
                            getStatusName(data.id_status),
                        ];
                        dataTable.row.add(objectRow).draw();
                    });



                }
            });
        }

        $("#btn-all-done").on("click", function() {
            let containerCard = $("#container-card");
            containerCard.children().remove();

            $.ajax({
                url: `/api/technician-users`,
                type: "GET",
            }).done(function(responseAjax) {
                responseAjax.forEach(technician => {
                    filterDone(`/api/technician-by/all/${technician.id_user}`, technician.fullname, containerCard);
                })


            });
        })

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


            let containerCard = $("#container-card");
            containerCard.children().remove();

            $.ajax({
                url: `/api/technician-users`,
                type: "GET",
            }).done(function(responseAjax) {
                responseAjax.forEach(technician => {
                    filterDone(`/api/technician-by/monthly/${technician.id_user}/${month}/${year}`, technician.fullname, containerCard);
                })

            });


        })



    })
</script>
<?= $this->endsection(); ?>