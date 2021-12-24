<?php
    include "header.php";
    include "connect.php";
    include "navbar.php";

    if(!isset($_SESSION)) {
        session_start();
    }

    $card_no = $_SESSION['atm_card'];
   
    $pin = $_SESSION['atm_pin'];
    $sql00 = "SELECT * from customer where card_no='".$card_no."'";
    $result00 = $conn->query($sql00);
    $row00 = $result00->fetch_assoc();
    $id = $row00["cust_id"];
    $sql0 = "SELECT balance FROM passbook".$id." ORDER BY trans_id DESC LIMIT 1";
    $result = $conn->query($sql0);
    $row = $result->fetch_assoc();
    $balance = $row["balance"];
    $err_no = 0

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="action_style.css">
</head>

<body>
            
    <div class="flex-container">
        <div class="flex-item">
            <?php
            if ($err_no == -1) { ?>
                <p id="info"><?php echo "Connection Error ! Please try again later.\n"; ?></p>
            <?php } ?>

            <?php
            if ($err_no == 0) { ?>
                <p id="info"><?php 
                echo "Current Available Balance  BDT $balance"
                ?></p>
            <?php } ?>

            
        </div>

        <div class="flex-item">
            <a href="cash_delivery_home_menu.php" class="button">Go Back</a>
        </div>
    </div>

</body>
</html>
