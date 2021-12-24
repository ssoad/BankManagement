<?php
include "header.php";
include "connect.php";
if(!isset($_SESSION)) {
    session_start();
}
$err_no=-1;
$deli_phone = "";
if (isset($_GET['trans_id'])) {
$address = mysqli_real_escape_string($conn, $_POST["address"]);
$mobile = mysqli_real_escape_string($conn, $_POST["mobile"]);
$id = $_SESSION['cust_id'];
$sql0 = "SELECT * FROM `deliveryman` WHERE job_status=0 ORDER BY RAND() LIMIT 1";
$result = $conn->query($sql0);
$row = $result->fetch_assoc();
$otp = rand(1000,9999);
if (($result->num_rows) > 0) {
    $deli_id = $row["id"];
    $deli_phone = $row["phone"];
    $sql1="INSERT INTO `delivery`(`cus_id`, `trans_id`, `mobile`,`address`, `deli_id`, `job_status`,`otp`) 
    VALUES(".$id.",".$_GET['trans_id'].",'$mobile','$address',".$deli_id.",0,".$otp.")";
    $result = $conn->query($sql1);
    if (($conn->query($sql1) === TRUE)) {
        $err_no = 0;
    }
} else {
    $deli_id = $row["id"];
    $sql1="INSERT INTO `delivery`(`cus_id`, `trans_id`, `mobile`,`address`, `deli_id`, `job_status`) 
    VALUES(".$id.",".$_GET['trans_id'].",'$mobile','$address',NULL,-1)";
   
    if (($conn->query($sql1) === TRUE)) {
        $err_no = 0;
    }
}
}
// In production, these should be environment variables.
// Below, substitute your cell phone
// $client->messages->create(
//     $mobile,  
//     [
//         'from' => $twilio_number,
//         "messagingServiceSid" => "MG0d50ed188ce17b75c054169370e5cedc",
//         'body' => 'Your Money Delivery Request is Placed Successfully'
//     ] 
// );


// $body = "New Request Placed! Phone:".$mobile." Address:".$address."";
// $client->messages->create(
//     $deli_phone,  
//     [
//         'from' => $twilio_number,
//         "messagingServiceSid" => "MG0d50ed188ce17b75c054169370e5cedc",
//         'body' => $body
//     ] 
// );
    
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
              
                echo "Delivery Request Placed Successfully"
                ?></p>
            <?php } ?>
        
        <div class="flex-item">
            <a href="atm_simulator_out_1.php" class="button">Go Back</a>
        </div>
    </div>

</body>
</html>
