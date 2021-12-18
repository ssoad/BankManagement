<?php
    /* Avoid multiple sessions warning
    Check if session is set before starting a new one. */
    if(!isset($_SESSION)) {
        session_start();
    }

    include "connect.php";

    if (isset($_GET['deli_id'])) {
    $sql0 = "UPDATE `delivery` SET job_status = 2 WHERE id=".$_GET['deli_id'];
    $conn->query($sql0);
    header("location:assigned_delivery.php");
    }

?>