<?php
include "header.php";
include "connect.php";
if(!isset($_SESSION)) {
    session_start();
}
$err_no=0;
$trans_id = $_GET['trans_id'];

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
        <form style="padding: 20px 20px 20px 20px" action="place_delivery.php?trans_id=<?php echo "$trans_id";?>" method="post">
                    <div class="flex-item-login">
                        <h4>Enter Adress and Contact Info</h2>
                    </div>

                    <div class="flex-item">
                        <input type="text" name="address" placeholder="Enter your Address" required>
                    </div>

                    <div class="flex-item">
                        <input type="text" name="mobile" placeholder="Enter your Mobile" required>
                    </div>

                    <div class="flex-item">
                        <button type="submit">Submit</button>
                    </div>
            </form>
        </div>
    </div>

</body>
</html>
