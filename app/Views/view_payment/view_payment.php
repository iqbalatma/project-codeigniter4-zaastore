<?= $this->extend("template_dashboard/layout"); ?>
<?= $this->section("content"); ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-4"><?= $title; ?></h1>
        <?php
        if ($flashdata != null) {
            echo $flashdata;
        }; ?>
        <div class="row mb-4">
            <div class="col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-coins"></i>
                        <b>
                            Belum Lunas
                        </b>
                    </div>
                    <div class="card-body">
                        <h3>Belum Lunas</h3>
                        <div class="table-responsive">
                            <table class="table table-dark table-striped" id="myTable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kode Order</th>
                                        <th scope="col">Faktur</th>
                                        <th scope="col">Note Tambahan</th>
                                        <th scope="col">Project By</th>
                                        <th scope="col">Total Tagihan</th>
                                        <th scope="col">Sisa Bayar</th>
                                        <th scope="col">Proses</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    $total_price_sum = 0;
                                    foreach ($order_data_on_progress as $row) :
                                        $price = $row["price"];
                                        $total_price = $row["total_price"] + intval($row["installation_price"]);
                                        $payment_left =  $payment->where("id_order", $row["id_order"])->orderBy("date_payment", "desc")->findAll()[0]["payment_left"];
                                        if ($payment_left > 0) {
                                            $total_price_sum += $payment_left;
                                    ?>
                                            <tr class="table-danger">
                                                <th scope="row"><?= $i; ?></th>
                                                <td><?= $row["order_code"]; ?></td>
                                                <td><?= $row["faktur_code"]; ?></td>
                                                <td><?= $row["notes"]; ?></td>
                                                <td><?= $row["fullname"]; ?></td>
                                                <td><?= intToRupiah($total_price) ?></td>
                                                <td><?= intToRupiah($payment_left)  ?></td>
                                                <!-- Button trigger modal -->
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-history" data-bs-toggle="modal" data-id-order="<?= $row["id_order"] ?>">
                                                        <i class="fas fa-clipboard-list"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-primary btn-add-payment" data-bs-toggle="modal" data-payment-left="<?= $payment_left ?>" data-id-order="<?= $row["id_order"] ?>" data-order-code="<?= $row["order_code"] ?>">
                                                        <i class="fas fa-money-bill-wave"></i>
                                                    </button>

                                                </td>
                                            </tr>
                                    <?php
                                            $i++;
                                        }
                                    endforeach; ?>



                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-hand-holding-usd"></i>
                        <b>
                            Paid
                        </b>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
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
                                <button class="btn btn-primary" id="btn-all-paid-off" type="button">Tampilkan Semua Data</button>
                            </div>
                        </div>

                        <h3>Sudah Lunas</h3>
                        <div class="table-responsive">
                            <table class="table table-dark table-striped" id="table-paid-off">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kode Order</th>
                                        <th scope="col">Faktur</th>
                                        <th scope="col">Note Tambahan</th>
                                        <th scope="col">Tanggal Lunas</th>
                                        <th scope="col">Project By</th>
                                        <th scope="col">Total Tagihan</th>
                                        <th scope="col">Sisa Bayar</th>
                                        <th scope="col">Proses</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    $total_price_sum = 0;
                                    foreach ($order_data as $row) :
                                        $price = $row["price"];
                                        $total_price = $row["total_price"] + intval($row["installation_price"]);;
                                        $payment_left  = $payment->where("id_order", $row["id_order"])->orderBy("date_payment", "desc")->findAll()[0]["payment_left"];
                                        if ($payment_left <= 0) {
                                            $payment_left = 0;
                                            $total_price_sum += $total_price;
                                    ?>
                                            <tr class="table-success">
                                                <th scope="row"><?= $i; ?></th>
                                                <td><?= $row["order_code"]; ?></td>
                                                <td><?= $row["faktur_code"]; ?></td>
                                                <td><?= $row["notes"]; ?></td>
                                                <td><?= $row["date_paid_off"]; ?></td>
                                                <td><?= $row["fullname"]; ?></td>
                                                <td><?= intToRupiah($total_price) ?></td>
                                                <td><?= intToRupiah($payment_left) ?></td>
                                                <!-- Button trigger modal -->
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-history" data-bs-toggle="modal" data-id-order="<?= $row["id_order"] ?>">
                                                        <i class="fas fa-clipboard-list"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                    <?php
                                            $i++;
                                        }
                                    endforeach; ?>
                                    <tr>
                                        <td colspan="5">Jumlah Harga Barang</td>
                                        <td></td>
                                        <td>
                                            <?= intToRupiah($total_price_sum) ?>
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</main>



<!-- Modal History Payment-->
<div class="modal fade" id="modal-history" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">History Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Pembayaran</th>
                                <th scope="col">Sisa Bayar</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Bukti Bayar</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal detail img -->
<div class="modal fade" id="modal-detail-img" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bukti Bayar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="" style="width: 1000px;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Add Payment -->
<div class="modal fade" id="modal-add-payment" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-add-payment-label"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/payment-transaction" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="id_order" id="id_order" value="<?= $row["id_order"]; ?>">
                    <div class="row">
                        <label for="basic-url" class="form-label">Tambahkan Pembayaran</label>
                        <div class="col-md-8">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="paid_amount_label"></span>
                                <input type="number" class="form-control" id="paid_amount" name="paid_amount" aria-describedby="basic-addon3">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input checkbox-lunas" type="checkbox" id="cb-lunas" name="lunas">
                                <label class="form-check-label" for="lunas">
                                    Lunas
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="image_payment" class="form-label">Upload Bukti Pembayaran (Optional)</label>
                            <input class="form-control" type="file" id="image_payment" name="image_payment" placeholder="Upload bukti pembayaran">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        function onClickHistory(context) {
            const modal = $('#modal-history');
            const btn = $(context);
            const idOrder = btn.data("id-order");
            modal.modal('toggle');



            $.ajax({
                url: `/api/payment/${idOrder}`,
                type: "GET",
            }).done(function(responseAjax) {
                let tbody = $("#modal-history").find("tbody");
                tbody.children().remove();
                let no = 1;
                responseAjax.forEach(dataPayment => {
                    let image = $("<a>", {
                        class: "img-detail",
                        attr: {
                            type: "button",
                            "data-bs-toggle": "modal",
                            "data-img": dataPayment.image_payment
                        }
                    }).append($("<img>", {
                        attr: {
                            src: "/uploads/bukti_bayar/" + dataPayment.image_payment,
                            style: "height: 100px"
                        }
                    }));


                    let tr = $("<tr>").appendTo(tbody);
                    tr.append($("<td>", {
                        text: no
                    })).append($("<td>", {
                        text: intToRupiah(dataPayment.paid_amount),
                    })).append($("<td>", {
                        text: intToRupiah(dataPayment.payment_left),
                    })).append($("<td>", {
                        text: dataPayment.date_payment,
                    })).append($("<td>").append(image));

                    no++;
                });



                $(".img-detail").on("click", function() {
                    const modal = $('#modal-detail-img');
                    const link = $(this);
                    const imgPayment = link.data("img");
                    modal.modal('toggle');
                    modal.find("img").attr("src", "/uploads/bukti_bayar/" + imgPayment);
                });
            });

        }

        function filterPaidOff(link) {
            /**
             *
             */
            $.ajax({
                url: link, //dibacanya masih string, ubah biar hanya nerima boolean
                type: "GET",
            }).done(function(responseAjax) {
                // console.log(responseAjax);
                let tbody = $("#table-paid-off").find("tbody");
                tbody.children().remove();
                let no = 1;
                let rowTotalPrice = 0;



                responseAjax.forEach((dataPayment, index, array) => {

                    $.ajax({
                        url: `/api/payment-left/${dataPayment.id_order}`,
                        type: "GET",
                    }).done(function(paymentLeft) {
                        let installationPrice = 0;
                        if (dataPayment.installation_price !== null) {
                            installationPrice = dataPayment.installation_price;
                        }
                        let totalPrice = parseInt(dataPayment.total_price) + parseInt(installationPrice);
                        console.log(totalPrice);
                        rowTotalPrice += totalPrice;
                        let button = $("<button>", {
                            attr: {
                                type: "button",
                                "data-bs-toggle": "modal",
                                "data-id-order": dataPayment.id_order,
                            },
                            click: function() {
                                onClickHistory(this)
                            },
                            class: "btn btn-primary btn-history",
                        }).append($("<i>", {
                            class: "fas fa-clipboard-list"
                        }));

                        let tr = $("<tr>", {
                            class: "table-success"
                        }).appendTo(tbody);

                        tr.append($("<td>", {
                            text: no
                        })).append($("<td>", {
                            text: dataPayment.order_code,
                        })).append($("<td>", {
                            text: dataPayment.faktur_code,
                        })).append($("<td>", {
                            text: dataPayment.notes,
                        })).append($("<td>", {
                            text: dataPayment.date_paid_off,
                        })).append($("<td>", {
                            text: dataPayment.fullname,
                        })).append($("<td>", {
                            text: intToRupiah(totalPrice),
                        })).append($("<td>", {
                            text: intToRupiah(paymentLeft),
                        })).append($("<td>").append(button));

                        no++;

                        if (index === array.length - 1) {
                            let trLast = `<tr>
                            <td colspan="5">Jumlah Harga Barang</td>
                            <td></td>
                            <td>
                            ${intToRupiah(rowTotalPrice)}
                            </td>
                            <td></td>
                            <td></td>
                        </tr>`

                            tbody.append(trLast);
                        }
                    });
                });



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

            filterPaidOff(`/api/payment-by-month/${month}/${year}/false`);
        });

        $("#btn-all-paid-off").on("click", function() {
            filterPaidOff(`/api/payment-all-paid-off`);
        });












        $(".btn-history").on("click", function() {
            onClickHistory(this);
        });


        $(".btn-add-payment").on("click", function() {
            const modal = $("#modal-add-payment");
            modal.modal('toggle');
            const button = $(this);

            const paymentLeft = button.data("payment-left");
            const idOrder = button.data("id-order");
            const orderCode = button.data("order-code");

            $("#modal-add-payment-label").text("Transaksi Pembayaran | Sisa Bayar " + intToRupiah(paymentLeft));

            modal.find("#id_order").val(idOrder);
            modal.find("#paid_amount_label").text(orderCode);
            modal.find(".checkbox-lunas").on("click", function() {
                let checkBox = document.getElementById("cb-lunas");
                if (checkBox.checked == true) {
                    $("#paid_amount").text("");
                    $("#paid_amount").val("");
                    $("#paid_amount").text(paymentLeft);
                    $("#paid_amount").val(paymentLeft);
                    $("#paid_amount").attr("readonly", "true");
                } else {
                    $("#paid_amount").removeAttr("readonly");
                    $("#paid_amount").text("");
                    $("#paid_amount").val("");
                }
            })
        });



    });
</script>

<?= $this->endsection(); ?>