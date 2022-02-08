<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #000000;
            text-align: center;
            height: 20px;
            margin: 8px;
        }

        p {
            margin-left: 100px;
            padding-left: 100px;
        }
    </style>
</head>

<body>

    <h1>Zaastore</h1>
    <hr>
    <?php if ($data_type == "payment_all") {
    ?>
        <h3>Seluruh Data Pembayaran Lunas</h3>
        <p>Berikut adalah seluruh data produk yang pembayarannya sudah lunas.</p>
    <?php
    } else {
    ?>
        <h3>Sudah Lunas</h3>
        <p>Berikut adalah data produk yang pembayarannya sudah lunas.</p>
    <?php
    } ?>
    <table class="table table-dark table-striped" id="myTable2">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Kode Order</th>
                <th scope="col">Tanggal Pesan</th>
                <th scope="col">Tanggal Deadline</th>
                <th scope="col">Tanggal Lunas</th>
                <th scope="col">Project By</th>
                <th scope="col">Harga Barang</th>
                <th scope="col">Sisa Bayar</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            $total_price_sum = 0;
            foreach ($order_data as $row) :
                $price = $row["price"];
                $total_price = $row["total_price"];
                $payment_left  = $payment->where("id_order", $row["id_order"])->orderBy("date_payment", "desc")->findAll()[0]["payment_left"];
                if ($payment_left <= 0) {
                    $payment_left = 0;
                    $total_price_sum += $total_price;
            ?>
                    <tr class="table-success">
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $row["order_code"]; ?></td>
                        <td><?= $row["order_date"]; ?></td>
                        <td><?= $row["deadline"]; ?></td>
                        <td><?= $row["date_paid_off"]; ?></td>
                        <td><?= $row["fullname"]; ?></td>
                        <td>Rp <?= number_format($total_price, 0, ',', '.'); ?></td>
                        <td>Rp <?= number_format($payment_left, 0, ',', '.'); ?></td>
                    </tr>
            <?php
                    $i++;
                }
            endforeach; ?>
            <tr>
                <td colspan="6">Jumlah Harga Barang</td>
                <td>
                    Rp <?= number_format($total_price_sum, 0, ',', '.') ?>
                </td>
                <td>Rp 0</td>
            </tr>
        </tbody>
    </table>




    <?php
    $tanggal = date('d M Y', time()); ?>
    <p>Bandung, <?= $tanggal; ?></p>








</body>

</html>