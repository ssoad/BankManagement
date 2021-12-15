<?php
    
    include "connect.php";

    session_start();
    session_destroy();
    header("location:atm_simulator_initial.php");    
?>