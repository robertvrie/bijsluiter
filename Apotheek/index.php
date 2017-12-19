<?php 
    include("header.php");

    if(isset($_SESSION["rol"])){
        get_home_by_role($_SESSION["rol"]);
    };
    
    include("footer.php");
?>