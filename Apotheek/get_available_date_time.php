<?php
    session_start();
    include("db_connect.php");
        
    $time = ['15:00','16:00','17:00','18:00','19:00','20:00','21:00','22:00','23:00'];
    
    
    
    $query = "select * from orderregels where datum = '".$_POST["date"]."'";
    $result = mysqli_query($conn, $query);
    $record = mysqli_fetch_assoc($result);
    $timeString = "";
    $timeBool = 'false';
    $i = 0;

    while($i < count($time)){
        $query = "SELECT distinct * FROM `orderregels` WHERE `datum` = '".$_POST['date']."' and `tijd` = '".$time[$i]."'";
        $result = mysqli_query($conn, $query);
        
        //printf($conn->error);
        
        if(mysqli_num_rows($result) < 4 && $i == 0){
            $timeString .= "<option selected>".$time[$i]."</option>";
            $timeBool = 'true';
        }elseif(mysqli_num_rows($result) < 4){
            $timeString .= "<option>".$time[$i]."</option>";
            $timeBool = 'true';
        }
        $i++;
    }
    
    if($timeBool == 'false'){
        $timeString .= "<option>Niet beschikbaar</option>";
    }
    
    echo json_encode(array("timeString" => $timeString, "timeBool" => $timeBool), JSON_UNESCAPED_SLASHES);
?>