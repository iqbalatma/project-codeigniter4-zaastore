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
    <h3>Sudah Lunas</h3>
    <p>Berikut adalah data produk yang pembayarannya sudah lunas.</p>



    <div class="row">
        <div class="col-xl-12 col-md-12">
            <table class="table table-dark table-striped" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Bahan</th>
                        <th scope="col">Satuan</th>
                        <th scope="col">Kuantitas</th>
                        <th scope="col">Ambang Batas</th>
                        <th scope="col">Update Terakhir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($warehouse as $row) :  ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= ucwords($row["fullname"]); ?></td>
                            <td><?= ucwords($row["nama_unit"]); ?></td>
                            <td><?= $row["quantity"]; ?></td>
                            <td><?= $row["threshold"]; ?></td>
                            <td><?= $row["update_at"]; ?></td>
                        </tr>
                    <?php
                        $i++;
                    endforeach; ?>

                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= ucwords($row["fullname"]); ?></td>
                        <td><?= ucwords($row["nama_unit"]); ?></td>
                        <td><?= $row["quantity"]; ?></td>
                        <td><?= $row["threshold"]; ?></td>
                        <td><?= $row["update_at"]; ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= ucwords($row["fullname"]); ?></td>
                        <td><?= ucwords($row["nama_unit"]); ?></td>
                        <td><?= $row["quantity"]; ?></td>
                        <td><?= $row["threshold"]; ?></td>
                        <td><?= $row["update_at"]; ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= ucwords($row["fullname"]); ?></td>
                        <td><?= ucwords($row["nama_unit"]); ?></td>
                        <td><?= $row["quantity"]; ?></td>
                        <td><?= $row["threshold"]; ?></td>
                        <td><?= $row["update_at"]; ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= ucwords($row["fullname"]); ?></td>
                        <td><?= ucwords($row["nama_unit"]); ?></td>
                        <td><?= $row["quantity"]; ?></td>
                        <td><?= $row["threshold"]; ?></td>
                        <td><?= $row["update_at"]; ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= ucwords($row["fullname"]); ?></td>
                        <td><?= ucwords($row["nama_unit"]); ?></td>
                        <td><?= $row["quantity"]; ?></td>
                        <td><?= $row["threshold"]; ?></td>
                        <td><?= $row["update_at"]; ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= ucwords($row["fullname"]); ?></td>
                        <td><?= ucwords($row["nama_unit"]); ?></td>
                        <td><?= $row["quantity"]; ?></td>
                        <td><?= $row["threshold"]; ?></td>
                        <td><?= $row["update_at"]; ?></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>




    <?php
    $tanggal = date('d M Y', time()); ?>
    <p>Bandung, <?= $tanggal; ?></p>








</body>

</html>