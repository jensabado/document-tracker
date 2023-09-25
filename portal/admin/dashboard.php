<?php
require_once('../../backend/config/database.php');
require_once('../../backend/config/connection.php');
$page_title = 'Dashboard';
ob_start();
?>
<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
    <div class="section-body">
        <div class="row d-flex flex-row align-items-stretch">
            <div class="col-xl-4 col-md-6 col-sm-6 col-12" style="margin-bottom: 30px">
                <div class="card shadow px-3 h-100 d-flex justify-content-center">
                    <div class="d-flex flex-row align-items-center">
                        <img style="height: 80px;" src="../../assets/img/illustration/ongoing-doc.svg" alt="">
                        <div class="d-flex flex-column align-items-end w-100 h-100">
                            <?php
                            $stmt = $pdo->prepare("SELECT * FROM documents WHERE is_deleted = 0 AND hidden = 0 AND status = 'Ongoing'");
                            $stmt->execute();
                            $count = $stmt->rowCount();
                            ?>
                            <p style="font-weight: 900; color: #5D87FF;" class="h1"><?= $count ?></p>
                            <p class="h6 text-right">Total Ongoing Documents</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 col-sm-6 col-12" style="margin-bottom: 30px">
                <div class="card shadow px-3 h-100 d-flex justify-content-center">
                    <div class="d-flex flex-row align-items-center">
                        <img style="height: 80px;" src="../../assets/img/illustration/delivered-doc.svg" alt="">
                        <div class="d-flex flex-column align-items-end w-100 h-100">
                            <?php
                            $stmt = $pdo->prepare("SELECT * FROM documents WHERE is_deleted = 0 AND hidden = 0 AND status = 'Done'");
                            $stmt->execute();
                            $count = $stmt->rowCount();
                            ?>
                            <p style="font-weight: 900; color: #5D87FF;" class="h1"><?= $count ?></p>
                            <p class="h6 text-right">Total Delivered Documents</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Department</th>
                                <th scope="col">Reference No.</th>
                                <th scope="col">Document Name</th>
                                <th scope="col">Type</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
ob_start();
?>
<script>
$(document).ready(function() {
    // initializing datatables
    var dataTable = $('#table').DataTable({
        "serverSide": true,
        "paging": true,
        "searching": true,
        "pagingType": "simple",
        "scrollX": true,
        "sScrollXInner": "100%",
        "ajax": {
            url: "../../backend/datatables/admin/dashboard",
            type: "POST",
            error: function(xhr, error, code) {
                console.log(xhr, code);
            }
        },
        "order": [
            [0, 'desc']
        ],
        "lengthMenu": [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"]
        ]
    });

    $($.fn.dataTable.tables(true)).DataTable().columns.adjust();

    setInterval(function() {
        dataTable.ajax.reload(null, false);
    }, 10000); // END DATATABLES
})
</script>
<?php
$script = ob_get_clean();
include('./layout/base.php');
?>