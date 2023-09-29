<?php
require_once('../../backend/config/database.php');
require_once('../../backend/config/connection.php');
require_once('../../backend/function/functions.php');
if(isset($_GET['reference'])) {
    $reference = $_GET['reference'];

    $stmt = $pdo->prepare("SELECT * FROM documents WHERE reference = :reference AND is_deleted = 0");
    $stmt->bindParam(":reference", $reference, PDO::PARAM_STR);
    $stmt->execute();

    if($stmt->rowCount() == 1) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $sender = $row['sender'];
        $type = $row['type'];
        $date = date('d F Y h:i a', strtotime($row['created']));
        $details = $row['details'];
        $name = $row['document'];

    } else {
        echo "<script>window.close();</script>";
    }
} else {
    echo "<script>window.close();</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../assets/img/logos/favicon.png" rel="icon">
    <link href="../../assets/img/logos/favicon.png" rel="apple-touch-icon">
    <title>Print</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/qrious/dist/qrious.min.js"></script>
    <style>
    body {
        font-family: Arial, sans-serif;
    }

    .receipt {
        width: 500px;
        border: 1px;
        padding: 0;
        margin: 0 auto;
    }

    .header {
        text-align: center;
        margin-bottom: 10px;
    }

    .item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 5px;
    }

    table,
    tr,
    td {
        border: none;
    }

    .qr-code {
        text-align: center;
        margin-top: 20px;
    }
    </style>
</head>

<body>
    <?php

    if(strtolower($type) == 'letter') {
    ?>
    <div class="container-fluid mt-4">
        <div class="receipt">
            <div class="qr-code fixed-top" style="margin-left: 580px">
                <?= generate_qrcode(qrcode_link($reference), 140) ?>
            </div>
        </div>
    </div>
    <?php
    } else {
    ?>
    <div class="container-fluid mt-4">
        <div class="receipt">
            <div class="header">
                <h4 class="fw-bold"><?= strtoupper($type) ?></h4>
            </div>
            <div style="text-align: center;">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Reference</th>
                            <th>From</th>
                            <th>Date / Time</th>
                        </tr>
                        <tr>
                            <td><?= strtoupper($reference) ?></td>
                            <td><?= strtoupper($sender) ?></td>
                            <td><?= strtoupper($date) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="qr-code">
                <?= generate_qrcode(qrcode_link($reference), 250) ?>
            </div>
        </div>
    </div>
    <?php
    }
    ?>

    <script>
    window.onload = function() {
        window.print();
    }

    window.onafterprint = function() {
        // Redirect back to the index page
        window.close();
    }
    </script>
</body>

</html>