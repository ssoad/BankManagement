<?php
    /* Avoid multiple sessions warning
    Check if session is set before starting a new one. */
require __DIR__ . '\library\twilio-php\src\Twilio\autoload.php';
use Twilio\Rest\Client;
// In production, these should be environment variables.
$account_sid = 'ACf365d18367e7db2daee18446714fc6e0';
$auth_token = '108846b736fb95458c7766498b5ff168';
$twilio_number = "+14156809126"; // Twilio number you own
$client = new Client($account_sid, $auth_token);
// Below, substitute your cell phone
$client->messages->create(
    '+8801725683936',  
    [
        'from' => $twilio_number,
        "messagingServiceSid" => "MG0d50ed188ce17b75c054169370e5cedc",
        'body' => 'Delivery Confirmed'
    ] 
);

    
    
    if(!isset($_SESSION)) {
        session_start();
    }

    include "connect.php";

    if (isset($_GET['deli_id'])) {
    $sql0 = "UPDATE `delivery` SET job_status = 1 WHERE id=".$_GET['deli_id'];
    $conn->query($sql0);
    header("location:assigned_delivery.php");
    }



?>