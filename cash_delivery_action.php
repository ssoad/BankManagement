<?php
    include "header.php";
    include "connect.php";

    if(!isset($_SESSION)) {
        session_start();
    }

    $acc_no = mysqli_real_escape_string($conn, $_POST["acc_no"]);
    // $amt = mysqli_real_escape_string($conn, $_POST["amt"]);
    // $type = mysqli_real_escape_string($conn, $_POST["type"]);
    $sql00 = "SELECT * from customer where account_no='".$acc_no."'";
    $result00 = $conn->query($sql00);
    $row00 = $result00->fetch_assoc();
    $id = $row00["cust_id"];
    $card_no = $row00["card_no"];
    $f_name = $row00["first_name"];
    $l_name = $row00["last_name"];
    /*  Set appropriate error number if errors are encountered.
        Key (for err_no) :
        -1 = Connection Error.
         0 = Successful Transaction.
         1 = Insufficient Funds.
         2 = Wrong PIN entered. */
    $err_no = 0;

    if (($result00->num_rows) > 0) {
        $_SESSION['atm_name'] = "$f_name $l_name";
        $_SESSION['atm_card'] = $card_no;
        $_SESSION['LAST_ACTIVITY'] = time();
    //     // For Credit transactions
    } 
       # For Debit transactions        
    else {
        $err_no = 2;
    }
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
            if ($err_no == 2) { ?>
                <p id="info"><?php echo "Invalid Account.\n"; ?></p>
            <?php } ?>

            <?php
            if ($err_no == 0) { ?>
                <p id="info"><?php 
                header("location:cash_delivery_home.php")
                ?></p>
            <?php } ?>
        </div>

        <div class="flex-item">
            <a href="atm_simulator_initial.php" class="button">Go Back</a>
        </div>
    </div>

</body>
</html>
