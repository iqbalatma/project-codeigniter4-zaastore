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
    <h3>Pemasangan Lampu </h3>


    <?php foreach ($user_technician_by_id as $row) :
        if ($data_type == "done_this_month") {
            $data_order_installer = $order_technician->getDataOrderForInstallerDoneThisMonth($row["id_user"], $month, $year);
        } else {
            $data_order_installer = $order_technician->getDataOrderForInstallerDone($row["id_user"]);
        }
        $id_user = $row["id_user"];
        if (count($data_order_installer) != 0) {
    ?>
            <h3><?= $row["fullname"]; ?></h3>
            <table class="table" id="myTable<?= $id_user ?>">
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
                        <th scope="col">Harga Barang</th>
                        <th scope="col">Komisi</th>
                        <th scope="col">Status</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;


                    foreach ($data_order_installer as $row2) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $row2["order_code"]; ?></td>
                            <td><?= $row2["date_installation_done"]; ?></td>
                            <td><?= $row2["size_acrilic"]; ?></td>
                            <td><?= $row2["cable_length"]; ?></td>
                            <td><?= $row2["adaptor"]; ?></td>
                            <td><?php if ($row2["waterproof"] != null) {
                                    echo "Waterproof, ";
                                }
                                if ($row2["adhesive"] != null) {
                                    echo "Perekat, ";
                                }
                                if ($row2["switch"] != null) {
                                    echo "Saklar, ";
                                }
                                if ($row2["laser_cut"] != null) {
                                    echo "Laser Cut";
                                }
                                ?></td>
                            <td><?= $row2["design_notes"]; ?></td>
                            <td><?= $row2["notes"]; ?></td>
                            <?php
                            $id_technician = $row2["id_installer"];
                            $technician_name = $name_technician->get_technician($id_technician);
                            echo "<td>";
                            echo ($technician_name[0]["fullname"]);
                            echo "</td>";
                            ?>
                            <td>Rp. <?= number_format($row2["installation_price"], 0, ',', '.'); ?></td>
                            <td>Rp. <?= number_format(intval($row2["installation_price"]) * 0.3, 0, ',', '.'); ?></td>
                            <td>
                                <?php
                                $status = $row2["id_status"];
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
        }
    endforeach; ?>




    <?php
    $tanggal = date('d M Y', time()); ?>
    <p>Bandung, <?= $tanggal; ?></p>








</body>

</html>