<?php
    include("header.php");
    //var_dump($_POST);


    if(isset($_POST["medicijnen"])){
        foreach($_POST["medicijnen"] as $index=>$value){
            
            $query = "update medicijnen set voorraad = voorraad + ".$_POST["bijbestellen"][$index]." where id = ".$_POST["medicijnen"][$index].";";
            $result = mysqli_query($conn, $query);
        }
    }
    header("location:index.php");
    include("footer.php");
?>