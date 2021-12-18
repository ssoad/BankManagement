<?php
require __DIR__ . '\library\twilio-php\src\Twilio\autoload.php';
use Twilio\Rest\Client;
$servername = "localhost";
// Enter your MySQL username below(default=root)
$username = "root";
// Enter your MySQL password below
$password = "";
$dbname = "net_banking";
$account_sid = 'ACf365d18367e7db2daee18446714fc6e0';
$auth_token = '108846b736fb95458c7766498b5ff168';
$twilio_number = "+14156809126"; // Twilio number you own
$client = new Client($account_sid, $auth_token);
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    header("location:connection_error.php?error=$conn->connect_error");
    die($conn->connect_error);
}
?>
