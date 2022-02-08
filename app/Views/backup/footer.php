<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; Zaastore 2021</div>
        </div>
    </div>
</footer>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="<?= base_url("admin-template"); ?>/js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="<?= base_url("admin-template"); ?>/assets/demo/chart-area-demo.js"></script>
<script src="<?= base_url("admin-template"); ?>/assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="<?= base_url("admin-template"); ?>/js/datatables-simple-demo.js"></script>


<script>
    $(document).ready(function() {
        $('#table_list_order').DataTable();
    });



    $(document).ready(function() {
        $('#myTable').DataTable();
    });
    $(document).ready(function() {
        $('#myTable2').DataTable();
    });
    $(document).ready(function() {
        $('#myTable33').DataTable();
    });
    $(document).ready(function() {
        $('#myTable34').DataTable();
    });
    $(document).ready(function() {
        $('#myTable35').DataTable();
    });
    $(document).ready(function() {
        $('#myTable36').DataTable();
    });
</script>


<script>
    $('#id_bahan_baku').on("change", function() {
        var dataid = $("#id_bahan_baku option:selected").attr("data-unit");
        document.getElementById("unit").value = dataid;
    });


    $(document).ready(function() {
        var max_fields = 10;
        var wrapper = $(".container1");
        var add_button = $(".add_form_field");

        var x = 1;
        $(add_button).click(function(e) {
            e.preventDefault();
            if (x < max_fields) {
                x++;

                var input_html_unit = ' <div class="col-md-4"><label for ="unit" class = "form-label">Satuan</label><input type = "text" class = "form-control" id = "unit" name = "unit" readonly></div>';
                var input_html_quantity = ' <div class="col-md-4"><label for ="unit" class = "form-label">Jumlah</label><input type = "text" class = "form-control" id = "unit" name = "unit" readonly></div>';
                $(wrapper).append(input_html_unit + input_html_quantity);
            } else {
                alert('You Reached the limits')
            }
        });

        $(wrapper).on("click", ".delete", function(e) {
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
</script>
</body>

</html>