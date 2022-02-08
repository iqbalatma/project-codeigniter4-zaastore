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
    <h3>Pemasangan Lampu Oleh Teknisi <?= $nama_teknisi; ?></h3>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Kode Order</th>
                <th scope="col">Tanggal Pemasangan Selesai</th>
                <th scope="col">Komisi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $installation_price_total = 0;
            foreach ($installation_done as $row) :
                // EROR
                $installation_price =  0.3 * intval($row["installation_price"]); ?>
                <tr class="table-success">
                    <th scope="row"><?= $i; ?></th>
                    <td><?= $row["order_code"]; ?></td>
                    <td><?= $row["date_installation_done"]; ?></td>
                    <td><?= "Rp " . number_format($installation_price, 0, ',', '.'); ?></td>

                </tr>
            <?php
                $installation_price_total += $installation_price;
                $i++;
            endforeach; ?>
            <tr>
                <td colspan="3">Total Komisi</td>
                <td class="table-primary"><?= "Rp " . number_format($installation_price_total, 0, ',', '.'); ?></td>
            </tr>
        </tbody>
    </table>




    <?php
    $tanggal = date('d M Y', time()); ?>
    <p>Bandung, <?= $tanggal; ?></p>








</body>

</html>