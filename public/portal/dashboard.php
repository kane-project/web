<?php
    session_start();
    if(!isset($_SESSION['landlord_id']))
        die(header("Location: /portal/login"));

    $page = "Dashboard";
    include("header.php");
?>
<body>

    <?php include("navbar.php"); ?>

    Dashboard :D

    <?php include("footer.php"); ?>

</body>
</html>