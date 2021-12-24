<?php
    /* Avoid multiple sessions warning
    Check if session is set before starting a new one. */
// Below, substitute your cell phone
if(!isset($_SESSION)) {
    session_start();
}

include "deliveryman_navbar.php";
if (isset($_GET['deli_id'])) {
    $sql = "SELECT * FROM `delivery` WHERE id=".$_GET['deli_id'];
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $mobile = $row['mobile'];

    $sql0 = "UPDATE `delivery` SET job_status = 1 WHERE id=".$_GET['deli_id'];
    $conn->query($sql0);
    

    // $client->messages->create(
    //     $mobile,  
    //     [
    //         'from' => $twilio_number,
    //         "messagingServiceSid" => "MG0d50ed188ce17b75c054169370e5cedc",
    //         'body' => 'Delivery Confirmed'
    //     ] 
    // );
    header("location:assigned_delivery.php");

    }


    

    



?>