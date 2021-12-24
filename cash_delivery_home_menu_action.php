<?php
    include "header.php";
    include "connect.php";

    if(!isset($_SESSION)) {
        session_start();
    }

    $card_no = $_SESSION['atm_card'];
    $amt = mysqli_real_escape_string($conn, $_POST["amt"]);
    $type = mysqli_real_escape_string($conn, $_POST["type"]);
    $pin = $_SESSION['atm_pin'];
    $sql00 = "SELECT * from customer where card_no='".$card_no."'";
    $result00 = $conn->query($sql00);
    $row00 = $result00->fetch_assoc();
    $id = $row00["cust_id"];
    $_SESSION['cust_id'] = $id;
    $sql0 = "SELECT balance FROM passbook".$id." ORDER BY trans_id DESC LIMIT 1";
    $result = $conn->query($sql0);
    $row = $result->fetch_assoc();
    $balance = $row["balance"];
    $trans_id = 0;
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
        // $_SESSION['atm_name'] = $row00["first_name"]+ " "+ $row00["last_name"];
        // $_SESSION['atm_card'] = $card_no;
        // $_SESSION['isCardValid'] = true;
        // $_SESSION['LAST_ACTIVITY'] = time();
        // For Credit transactions
        if ($type == "credit") {
            $final_balance = $balance + $amt;

            $sql1 = "INSERT INTO passbook".$id." VALUES(
                        NULL,
                        NOW(),
                        'Cash Deposit',
                        '0',
                        '$amt',
                        '$final_balance'
                    )";

            if (($conn->query($sql1) === TRUE)) {
                $err_no = 0;
            }
        }

     #   For Debit transactions
        if ($type == "debit") {
            $final_balance = $balance - $amt;

            if ($final_balance >= 0) {
                $sql1 = "INSERT INTO passbook".$id." VALUES(
                            NULL,
                            NOW(),
                            'Cash to Self',
                            '$amt',
                            '0',
                            '$final_balance'
                        )";

                if (($conn->query($sql1) === TRUE)) {
                    $sql = "SELECT trans_id FROM passbook".$id." ORDER BY trans_id DESC LIMIT 1";
                    $result = $conn->query($sql);
                    $row_temp = $result->fetch_assoc();
                    $trans_id = $row_temp['trans_id'];
                    
                    $err_no = 0;
                }
            }
            else {
                $err_no = 1;
            }
        }
    }
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
            if ($err_no == -1) { ?>
                <p id="info"><?php echo "Connection Error ! Please try again later.\n"; ?></p>
            <?php } ?>

            <?php
            if ($err_no == 0) { ?>
                <p id="info"><?php 
                echo "Transaction Successful"
                ?></p>
            <?php } ?>

            <?php
            if ($err_no == 1) { ?>
                <p id="info"><?php echo "Insufficient Funds !\n"; ?></p>
            <?php } ?>

            <?php
            if ($err_no == 2) { ?>
                <p id="info"><?php echo "Wrong PIN Entered !\n"; ?></p>
            <?php } ?>
        </div>
        <?php
            if ($type == "debit") { ?>
              <div class="flex-item">
            <h3>Do you want Home Cash Delivery ? </h3>
           
            <a href="request_delivery.php?trans_id=<?php echo "$trans_id";?>" class="button">Yes</a>
        </div>

            <?php } ?>
        
        <div class="flex-item">
            <a href="atm_simulator_out_1.php" class="button">Go Back</a>
        </div>
    </div>

</body>
</html>
