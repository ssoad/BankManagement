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
    <link rel="stylesheet" href="customer_add_style.css">
</head>

<body>
            
    <div class="flex-container">
        <div class="flex-item">
        
        <form class="add_customer_form" action="place_delivery.php?trans_id=<?php echo "$trans_id";?>" method="post">
        <div class="flex-container-form_header">
            <h1 id="form_header">Please fill in the following details</h1>
        </div>

        <div class="flex-container">
            <div class=container>
                <label>Address :</label><br>
                <textarea name="address" required /></textarea>
            </div>
        </div>

        <div class="flex-container">
            
            <div  class=container>
                <label>Phone No. :</b></label><br>
                <input name="phno" size="30" type="text" required />
            </div>
        </div>

        
        <div class="flex-container">
            <div class="container">
                <button type="submit">Submit</button>
            </div>

        </div>

    </form>

        </div>
    </div>

</body>
</html>
