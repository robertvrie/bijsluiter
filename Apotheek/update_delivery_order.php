<?php
    include("header.php");

    //var_dump($_POST);

    if(isset($_POST)){
        
        for($i = 0; $i < $_POST["amountOfRows"]; $i++){
            if($_POST["radio_".$i] == 1){
                $query = "update `orderregels` set `orderActief` = 0 where `orderregels`.`id` = ".$_POST["row_".$i].";";
                
                $result = mysqli_query($conn, $query);
            }
            
        }
        
        $queryRemainingRows = "select * from `orderregels` where orderActief = 1;";
        $resultRemainingRows = mysqli_query($conn, $queryRemainingRows);
        $amountOfRemainingRows = mysqli_num_rows($resultRemainingRows);
        
        if($amountOfRemainingRows == 0){
            $queryFinishOrder = "update `order` set orderstatus = 2 where id = ".$_POST["order"].";";
            $resultFinishOrder = mysqli_query($conn, $queryFinishOrder);
        }
        
        
        $queryRows = "select `orderregels`.`id` as id from `orderregels` left join `medicijnen` on `orderregels`.`medicijn` = `medicijnen`.`id` where `orderregels`.`order` = ".$_POST["order"]." and `orderregels`.`orderActief` = 1 and datum = (select o.datum from `orderregels` as o where o.datum = '".date("Y-m-d")."' and o.orderActief = 1 order by o.datum limit 1) order by naam;";
        $resultRows = mysqli_query($conn, $queryRows);
        
        $time = ['15:00','16:00','17:00','18:00','19:00','20:00','21:00','22:00','23:00'];
        
        while($record = mysqli_fetch_assoc($resultRows)){
            $queryDone = false;
            $day = 1;
            $i = 0;
            
            while($queryDone == false){
                $querySelectExisting = "select * from orderregels where datum = '".date("Y-m-d", strtotime("+".$day." day"))."' and `order` = ".$_POST["order"]." order by tijd limit 1;";
                
                $resultSelectExisting = mysqli_query($conn, $querySelectExisting);
                $amountOfExisting = mysqli_num_rows($resultSelectExisting);
                $recordSelectExisting = mysqli_fetch_assoc($resultSelectExisting);
                
                if($amountOfExisting == 1){
                    $queryUpdateRows = "update `orderregels` set `datum` = '".date("Y-m-d", strtotime("+".$day." day"))."', `tijd` = '".$recordSelectExisting["tijd"]."' where `order` = ".$_POST["order"]." and `id` = ".$record["id"].";";
                    
                    $resultUpdateRows = mysqli_query($conn, $queryUpdateRows);
                    $queryDone = true;
                }else{
                    while($i < count($time)){
                        $queryTimeCount = "select * from orderregels where datum = '".date("Y-m-d", strtotime("+".$day." day"))."' and tijd = '".$time[$i]."' group by `order`;";
                        $resultTimeCount = mysqli_query($conn, $queryTimeCount);
                        $amountOfOrders = mysqli_num_rows($resultTimeCount);
                        
                        if($amountOfOrders < 4){
                            $queryUpdateRows = "update `orderregels` set `datum` = '".date("Y-m-d", strtotime("+".$day." day"))."', `tijd` = '".$time[$i]."' where `order` = ".$_POST["order"]." and `id` = ".$record["id"].";";
                            
                            $resultUpdateRows = mysqli_query($conn, $queryUpdateRows);
                            $queryDone = true;
                            break;
                        }
                        $i++;
                    }
                }
                $day++;
            }
        }
        
        header("location:delivery_overview.php");
    }
    
    

    include("footer.php");
?>