<?php
require_once('../../backend/config/database.php');
require_once('../../backend/config/connection.php');
$page_title = 'Track Document';
ob_start();

?>
<section class="section">
    <div class="section-header" style="position: fixed; top: 80px; width: 100%; z-index: 200;">
        <h1>Track Document</h1>
    </div>

    <div class="section-body" style="margin-top: 90px;">
        <div class="card">
            <div class="card-body">
                <form action="" class="mb-3">
                    <input type="text" class="form-control" name="" id="" inputmode="numeric"
                        placeholder="Enter reference number" value="<?= isset($_GET['reference']) ? $_GET['reference'] : " " ?>">
                </form>

                <?php
                if(isset($_GET['reference'])) {
                    $reference = $_GET['reference'];

                    $stmt = $pdo->prepare("SELECT * FROM documents WHERE reference = :reference AND is_deleted = 0");
                    $stmt->bindParam(":reference", $reference, PDO::PARAM_STR);
                    $stmt->execute();

                    if($stmt->rowCount() == 1) {
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);

                        $sender = $row['sender'];
                        $type = $row['type'];
                        $date = date('d F Y', strtotime($row['created']));
                        $time = date('h:i A', strtotime($row['created']));
                        $details = $row['details'];
                        $name = $row['document'];
                        $status = $row['status'];

                        $stmt = $pdo->prepare("SELECT * FROM department WHERE code = :code");
                        $stmt->bindParam(':code', $sender, PDO::PARAM_STR);
                        $stmt->execute();
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                        $department = $result['department'];

                    } else {
                        echo "<script>window.history.back();</script>";
                    }
                ?>
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header px-3 pb-0" id="headingOne">
                            <h2 class="mb-0">
                                <p data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                    aria-controls="collapseOne"
                                    style="font-size: 14px; cursor: pointer; user-select: none;"
                                    onclick="toggleIcon('#collapseOne', '#iconOne');">
                                    <i class="fa-solid fa-caret-right mr-1" id="iconOne"></i> <span
                                        class="font-weight-bold">Reference:</span> <?= $reference ?>
                                </p>
                            </h2>
                        </div>

                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                <p><span class="font-weight-bold">FROM:</span> <?= strtoupper($department) ?></p>
                                <p><span class="font-weight-bold">Status:</span> <?= strtoupper($status) ?></p>
                                <p><span class="font-weight-bold">Type:</span> <?= strtoupper($type) ?></p>
                                <p><span class="font-weight-bold">Date Created:</span> <?= $date ?> / <?= $time ?></p>
                                <button class="btn btn-primary">PRINT</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="tracking-pre"></div>
                <div id="tracking">
                    <div class="tracking-list">
                        <div class="tracking-item">
                            <div
                                class="tracking-icon status-intransit d-flex align-items-center justify-content-center bg-success">
                                <i class="fa-solid fa-check text-white" style="font-size: 16px;"></i>
                            </div>
                            <div class="tracking-date"><?= $date ?><span><?= $time ?></span></div>
                            <div class="tracking-content"><?= $department ?><span>FROM</span></div>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>

<?php

$content = ob_get_clean();
ob_start();
?>
<script>
// Function to toggle the FontAwesome icon
function toggleIcon(accordionId, iconId) {
    $(accordionId).on('show.bs.collapse', function() {
        $(iconId).removeClass('fas fa-caret-right').addClass('fas fa-caret-down');
    }).on('hide.bs.collapse', function() {
        $(iconId).removeClass('fas fa-caret-down').addClass('fas fa-caret-right');
    });
}

$(document).ready(function() {
    // Call the function for the specific accordion
    toggleIcon('#collapseOne', '#iconOne');
})
</script>
<?php
$script = ob_get_clean();
include('./layout/base.php');
?>