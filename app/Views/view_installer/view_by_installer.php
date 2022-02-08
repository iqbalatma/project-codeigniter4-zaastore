<?= $this->extend("template_dashboard/layout"); ?>
<?= $this->section("content"); ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-4"><?= $title; ?></h1>
        <div class="row">
            <div class="col-xl-12 col-md-12">


                <br><br>
                <form action="/installer-by/done-this-month" method="GET">
                    <div class="row mb-4">
                        <div class="col-xl-4 col-md-4">
                            <select class="form-select" aria-label="Default select example" name="month">
                                <option selected disabled>Pilih Bulan Untuk Filter</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="col-xl-4 col-md-4">
                            <select class="form-select" aria-label="Default select example" name="year">
                                <option selected>Pilih Tahun Untuk Filter</option>
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
                            <input class="btn btn-primary" type="submit" value="Filter">

                            <?php
                            if ($data_type == "done-all") {
                            ?>
                                <a href="/installer-by/done-this-month" class="btn btn-primary">Tampilkan Data Bulan Ini</a>
                                <!-- <a href="<?php //echo base_url("PDF/print_pdf?title=Pemasangan Lampu&view=pdf_by_installer&data_type=done_all");  -->
                                                ?>" class="btn btn-primary">Cetak PDF Seluruh Data Teknisi</a>-->
                            <?php
                            } else {
                            ?>
                                <a href="/installer-by/done-all" class="btn btn-primary">Tampilkan Semua Data</a>
                                <!-- Button trigger modal -->
                                <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Cetak PDF Data Teknisi Perbulan
                                </button> -->
                            <?php
                            }; ?>
                        </div>
                    </div>
                </form>


                <!-- Modal -->
                <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Cetak PDF Data Teknisi Perbulan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url("PDF/print_pdf"); ?>" method="GET">
                                    <div class="row mb-4">

                                        <input type="hidden" name="title" value="Pemasangan Lampu">
                                        <input type="hidden" name="view" value="pdf_by_installer">
                                        <input type="hidden" name="data_type" value="done_this_month">


                                        <div class="col-xl-6 col-md-6">
                                            <select class="form-select" aria-label="Default select example" name="month">
                                                <option selected disabled>Pilih Bulan Untuk Filter</option>
                                                <option value="1">Januari</option>
                                                <option value="2">Februari</option>
                                                <option value="3">Maret</option>
                                                <option value="4">April</option>
                                                <option value="5">Mei</option>
                                                <option value="6">Juni</option>
                                                <option value="7">Juli</option>
                                                <option value="8">Agustus</option>
                                                <option value="9">September</option>
                                                <option value="10">Oktober</option>
                                                <option value="11">November</option>
                                                <option value="12">Desember</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-6 col-md-6">
                                            <select class="form-select" aria-label="Default select example" name="year">
                                                <option selected>Pilih Tahun Untuk Filter</option>
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
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Cetak PDF</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> -->


                <?php foreach ($user_technician as $row) :
                    if ($data_type == "done-this-month") {
                        $data_order_installer = $order_installer->getDataOrderForInstallerDoneThisMonth($row["id_user"], $month, $year);
                    } else {
                        $data_order_installer = $order_installer->getDataOrderForInstallerDone($row["id_user"]);
                    }
                    $id_user = $row["id_user"];
                    if (count($data_order_installer) != 0) {
                ?>
                        <h3><?= $row["fullname"]; ?></h3>
                        <div class="table-responsive">
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
                        </div>

                <?php
                        $data_table = "<script>$(document).ready(function() {
        $('#myTable$id_user').DataTable();
    });
    </script>
    ";
                        echo $data_table;
                    }
                endforeach; ?>

            </div>
        </div>

    </div>
</main>
<?php echo $checked_button; ?>
<?= $this->endsection(); ?>