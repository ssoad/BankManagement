<?php
    include "header.php";
 
    if(!isset($_SESSION)) {
        session_start();
    }

    include "deliveryman_navbar.php";
    $deli_id = $_GET['deli_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="customer_add_style.css">
</head>

<body>
    <form class="add_customer_form" action="complete_delivery.php?deli_id=<?php echo "$deli_id";?>" method="post">
        <div class="flex-container-form_header">
            <h1 id="form_header">Complete Delivery</h1>
        </div>


        <div class="flex-container">
            <div class=container>

            <input type="hidden" id="type" name="deli_id" value="<?php echo "$deli_id";?>">
                <label>Enter OTP :</label><br>
                <input name="otp" size="24" type="text" required />
            </div>
        </div>

        <!-- <div class="flex-container">
            <div class=container>
                <label>Type :</label>
            </div>
            <div class="flex-container-radio">
                <div class="container">
                    <input type="radio" name="type" value="debit" id="debit-radio" checked>
                    <label id="radio-label" for="debit-radio"><span class="radio">Withdraw Money</span></label>
                </div>
                <div class="container">
                    <input type="radio" name="type" value="credit" id="credit-radio">
                    <label id="radio-label" for="credit-radio"><span class="radio">Add Money</span></label>
                </div>
            </div>
        </div> -->

        

        <div class="flex-container">
            <div class="container">
                <button type="submit">Submit</button>
            </div>

            <div class="container">
                <button type="reset" class="reset" onclick="return confirmReset();">Reset</button>
            </div>
        </div>

    </form>

    <script>
    function confirmReset() {
        return confirm('Do you really want to reset?')
    }
    </script>

</body>
</html>
