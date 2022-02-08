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


    <table class="table" id="myTable">
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
                <th scope="col">Komisi</th>
                <th scope="col">Status</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($technician as $row) : ?>
                <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td><?= $row["order_code"]; ?></td>
                    <td><?= $row["date_production_done"]; ?></td>
                    <td><?= $row["size_acrilic"]; ?></td>
                    <td><?= $row["cable_length"]; ?></td>
                    <td><?= $row["adaptor"]; ?></td>
                    <td><?php if ($row["waterproof"] != null) {
                            echo "Waterproof, ";
                        }
                        if ($row["adhesive"] != null) {
                            echo "Perekat, ";
                        }
                        if ($row["switch"] != null) {
                            echo "Saklar, ";
                        }
                        if ($row["laser_cut"] != null) {
                            echo "Laser Cut";
                        }
                        ?></td>
                    <td><?= $row["design_notes"]; ?></td>
                    <td><?= $row["notes"]; ?></td>
                    <?php
                    $id_technician = $row["id_technician"];
                    $technician_name = $user_technician->get_technician($id_technician);
                    echo "<td>";
                    echo ($technician_name[0]["fullname"]);
                    echo "</td>";
                    ?>
                    <td>Rp. <?= $row["price"]; ?></td>
                    <td>Rp. <?= $row["technician_payment"]; ?></td>
                    <td>
                        <?php
                        $status = $row["id_status"];
                        if ($status == 1) {
                            $status = "Desain Selesai";
                        } elseif ($status == 2) {
                            $status = "Produksi Selesai";
                        } elseif ($status == 3) {
                            $status = "Packing Selesai";
                        } elseif ($status == 4) {
                            $status = "Checkout Selesai";
                        } elseif ($status == 5) {
                            $status = "Waiting List";
                        }
                        echo $status; ?></td>
                </tr>
            <?php
                $i++;
            endforeach; ?>
        </tbody>
    </table>




    <?php
    $tanggal = date('d M Y', time()); ?>
    <p>Bandung, <?= $tanggal; ?></p>








</body>

</html>