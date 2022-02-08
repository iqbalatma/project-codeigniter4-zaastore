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
    <h3>Pekerjaan Teknisi <?= $nama_teknisi; ?></h3>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Kode Order</th>
                <th scope="col">Tanggal Produk Selesai</th>
                <th scope="col">Komisi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $technician_payment = 0;
            foreach ($technician_done as $row) : ?>
                <tr class="table-success">
                    <th scope="row"><?= $i; ?></th>
                    <td><?= $row["order_code"]; ?></td>
                    <td><?= $row["date_production_done"]; ?></td>
                    <td>Rp. <?= number_format($row["technician_payment"], 0, ',', '.'); ?></td>

                </tr>
            <?php
                $technician_payment += $row["technician_payment"];
                $i++;
            endforeach; ?>
            <tr>
                <td colspan="3">Total Komisi</td>
                <td class="table-primary">Rp. <?= number_format($technician_payment, 0, ',', '.'); ?></td>

            </tr>
        </tbody>
    </table>




    <?php
    $tanggal = date('d M Y', time()); ?>
    <p>Bandung, <?= $tanggal; ?></p>








</body>

</html>