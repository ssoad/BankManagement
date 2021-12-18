<?php
    include "connect.php";
    
    /* Avoid multiple sessions warning
    Check if session is set before starting a new one. */
    if(!isset($_SESSION)) {
        session_start();
    }

    $uname = mysqli_real_escape_string($conn, $_POST["cust_uname"]);
    $pwd = mysqli_real_escape_string($conn, $_POST["cust_psw"]);

    $sql0 =  "SELECT * FROM customer WHERE uname='".$uname."' AND pwd='".$pwd."'";
    $sql1 =  "SELECT * FROM admin WHERE uname='".$uname."' AND pwd='".$pwd."'";
    $sql2 =  "SELECT * FROM `deliveryman` WHERE uname='".$uname."' AND pwd='".$pwd."'";
    $result = $conn->query($sql0);
    $result1 = $conn->query($sql1);
    $result2 = $conn->query($sql2);
    $row = $result->fetch_assoc();
    $row1 = $result2->fetch_assoc();

    if (($result->num_rows) > 0) {
        $approved = $row["approved"];
        if($approved==1){
            $_SESSION['loggedIn_cust_id'] = $row["cust_id"];
            $_SESSION['isCustValid'] = true;
            $_SESSION['LAST_ACTIVITY'] = time();
            header("location:customer_home.php");
        }else{
            session_destroy();
            die(header("location:home.php?notApproved=true"));
        }
        
    }
    else if (($result2->num_rows) > 0) {
       
            $_SESSION['loggedIn_deli_id'] = $row1["id"];
            $_SESSION['isDeliValid'] = true;
            $_SESSION['LAST_ACTIVITY'] = time();
            header("location:deliveryman_home.php");
        
    }
    else if (($result1->num_rows) > 0) {
        $_SESSION['isAdminValid'] = true;
        $_SESSION['LAST_ACTIVITY'] = time();
        header("location:admin_home.php");
    }

    else {
        session_destroy();
        die(header("location:home.php?loginFailed=true"));
    }
?>
