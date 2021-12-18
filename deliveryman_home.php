<?php
    include "header.php";
    include "session_timeout.php";
    include "deliveryman_navbar.php";
    include "deliveryman_sidebar.php";

    session_start();
    $id = $_SESSION['loggedIn_deli_id'];

    $sql0 = "SELECT * FROM `deliveryman` WHERE id=".$id;
    $result0 = $conn->query($sql0);
    $row0 = $result0->fetch_assoc();

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_home_style.css">
</head>

<body>
    <div class="flex-container">
        <div class="flex-item">
            <h1 id="customer">
                Welcome, <?php echo $row0["name"] ?>&nbsp<?php echo $row0["phone"] ?>&nbsp!
               
            </h1>
            <p id="customer">
            
            </p>
        </div>
    </div>

</body>
</html>

<?php include "easter_egg.php"; ?>
