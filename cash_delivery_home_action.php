<?php
    include "header.php";
    include "connect.php";

    if(!isset($_SESSION)) {
        session_start();
    }

    $card_no = $_SESSION['atm_card'];
    // $amt = mysqli_real_escape_string($conn, $_POST["amt"]);
    // $type = mysqli_real_escape_string($conn, $_POST["type"]);
    $pin = mysqli_real_escape_string($conn, $_POST["pin"]);
    $sql00 = "SELECT * from customer where card_no='".$card_no."'";
    $result00 = $conn->query($sql00);
    $row00 = $result00->fetch_assoc();
    $id = $row00["cust_id"];
    $sql0 = "SELECT balance FROM passbook".$id." ORDER BY trans_id DESC LIMIT 1";
    $result = $conn->query($sql0);
    $row = $result->fetch_assoc();
    $balance = $row["balance"];
    $f_name = $row00["first_name"];
    $l_name = $row00["last_name"];
    /*  Set appropriate error number if errors are encountered.
        Key (for err_no) :
        -1 = Connection Error.
         0 = Successful Transaction.
         1 = Insufficient Funds.
         2 = Wrong PIN entered. */
    $err_no = 0;

    $sql_pin = "SELECT * FROM customer WHERE cust_id=".$id." AND pin='".$pin."'";
    $result_pin = $conn->query($sql_pin);

    if (($result_pin->num_rows) > 0) {
        $_SESSION['cust_id'] = $id;
        $_SESSION['atm_name'] = "$f_name $l_name";
        $_SESSION['atm_card'] = $card_no;
        $_SESSION['atm_pin'] = $pin;
        $_SESSION['isCardValid'] = true;
        $_SESSION['LAST_ACTIVITY'] = time();
    //     // For Credit transactions
       
       # For Debit transactions
       
    }
    else {
        $_SESSION['wrong_count'] = $_SESSION['wrong_count']+ 1;
        $err_no = 2;
        if( $_SESSION['wrong_count']==3){
            $err_no = 3;
            $sql = "UPDATE customer SET card_lock = 1 WHERE cust_id=".$id."";
            $result = $conn->query($sql);
        }
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
            if ($err_no == -1) { ?>
                <p id="info"><?php echo "Connection Error ! Please try again later.\n"; ?></p>
            <?php } ?>

            <?php
            if ($err_no == 0) { ?>
                <p id="info"><?php 
                header("location:cash_delivery_home_menu.php")
                ?></p>
            <?php } ?>

            <?php
            if ($err_no == 3) { ?>
                <p id="info"><?php echo "Card Locked!\n"; ?></p>
            <?php } ?>

            <?php
            if ($err_no == 2) { ?>
                <p id="info"><?php echo "Wrong PIN Entered !\n"; ?></p>
            <?php } ?>
        </div>

        <div class="flex-item">
            <a href="atm_simulator_out.php" class="button">Go Back</a>
        </div>
    </div>

</body>
</html>
