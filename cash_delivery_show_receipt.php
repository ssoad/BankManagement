<?php
  include "header.php";
  include "navbar.php";
  include "connect.php";
  session_start();

  $id = $_SESSION['cust_id'];
  $sql = "SELECT * FROM passbook$id ORDER BY trans_id DESC LIMIT 1";
  $result = $conn->query($sql);
$row = $result->fetch_assoc();
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
                <p id="info"><?php
                echo "\n<br> Card No :- ";
                echo $_SESSION["atm_card"];
                echo "\n<br> Trans Type :- ";
                if($row['debit']>0){ 
                    echo "Withdraw";
                }else{
                    echo "Deposit";
                }
                echo "\n<br> Trans Date & time :- "; 
                echo $row['trans_date'];
                echo "\n<br> Available Balance :- ";
                echo $row['balance']; 
                ?></p>

        </div>

        <div class="flex-item">
            <a href="cash_delivery_home.php" class="button">Go Back</a>
        </div>
    </div>

</body>
</html>
