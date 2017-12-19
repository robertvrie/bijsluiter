<?php
	include("header.php");
	//var_dump($_POST);

    $query = "insert into `order` (`id`,
                                    `patient`,
                                    `bedrag`,
                                    `btlmet`,
                                    `akng`,
                                    `orderstatus`) 
                                    VALUES
                                    (NULL,
                                    ".$_POST['naam'].",
                                    1.1,
                                    NULL,
                                    0,
                                    1);";
    $result = mysqli_query($conn, $query);
    $orderid = $conn->insert_id;
    
    for($i = 0; $i< count($_POST['medicijn']); $i++){
        $queryVoorraad = "select `voorraad` from `medicijnen` where `id`=".$_POST['medicijn'][$i].";";
        $resultVoorraad = mysqli_query($conn, $queryVoorraad);
        $recordVoorraad = mysqli_fetch_assoc($resultVoorraad);
        
        if($recordVoorraad['voorraad'] < $_POST['aantal'][$i]){
            $overVoorraad = $_POST['aantal'][$i] - $recordVoorraad['voorraad'];
            $onderVoorraad = $_POST['aantal'][$i] - $overVoorraad;
            
            $query2 = "insert into `orderregels`    (`id`,
                                                    `order`,
                                                    `medicijn`,
                                                    `aantal`,
                                                    `datum`,
                                                    `tijd`,
                                                    `orderActief`)
                                                    values
                                                    (NULL,
                                                    ".$orderid.",
                                                    ".$_POST['medicijn'][$i].",
                                                    ".$onderVoorraad.",
                                                    '".$_POST['datum']."',
                                                    '".$_POST['tijd']."',
                                                    1);";
            $result2 = mysqli_query($conn, $query2);
            
            $query3 = "insert into `orderregels`    (`id`,
                                                    `order`,
                                                    `medicijn`,
                                                    `aantal`,
                                                    `datum`,
                                                    `tijd`,
                                                    `orderActief`)
                                                    values
                                                    (NULL,
                                                    ".$orderid.",
                                                    ".$_POST['medicijn'][$i].",
                                                    ".$overVoorraad.",
                                                    '".$_POST['nieuweDatum']."',
                                                    '".$_POST['nieuweTijd']."',
                                                    1);";
            $result3 = mysqli_query($conn, $query3);
            
            $voorraad = $recordVoorraad['voorraad'] - $_POST['aantal'][$i];
            $query4 = "update `medicijnen` set `voorraad`=".$voorraad." where `id`=".$_POST['medicijn'][$i].";";
            $result4 = mysqli_query($conn, $query4);
            
        }else{
            $query2 = "insert into `orderregels`    (`id`,
                                                    `order`,
                                                    `medicijn`,
                                                    `aantal`,
                                                    `datum`,
                                                    `tijd`,
                                                    `orderActief`)
                                                    values
                                                    (NULL,
                                                    ".$orderid.",
                                                    ".$_POST['medicijn'][$i].",
                                                    ".$_POST['aantal'][$i].",
                                                    '".$_POST['datum']."',
                                                    '".$_POST['tijd']."',
                                                    1);";
            //var_dump($_POST['medicijn'][$i]);
            //var_dump($_POST['aantal'][$i]);
            $result2 = mysqli_query($conn, $query2);
            
            $query3 = "select `voorraad` from `medicijnen` where `id`=".$_POST['medicijn'][$i].";";
            $result3 = mysqli_query($conn, $query3);
            $record3 = mysqli_fetch_assoc($result3);
            
            $voorraad = $record3['voorraad'] - $_POST['aantal'][$i];
            
            $query4 = "update `medicijnen` set `voorraad`=".$voorraad." where `id`=".$_POST['medicijn'][$i].";";
            $result4 = mysqli_query($conn, $query4);
            
            //printf($conn->error);
            
            //var_dump($result2);
            //exit();
        }
    }
    
    $query5 = "select * from `patient` where `id` = ".$_POST['naam'].";";
    $result5 = mysqli_query($conn, $query5);
    $record5 = mysqli_fetch_assoc($result5);
    
    if($result){
        echo "De gegevens zijn goed opgeslagen";
        $emailaddress = $record5["email"];
        $title = "Bestelling order nummer #".$orderid;
        $message = "
        <html>
            <head>
            </head>
            <body>
                <h3>Bedankt voor de bestelling. Door <a href='http://localhost/2017-2018/Examenopdracht/Apotheek/active_order_edit.php?bestelnr=".$orderid."'>hier</a> te klikken kunt u inloggen. Op de website kunt u de datum & tijd van uw levering wijzigen.</h3>
            </body>		
        </html>";
        $header = "From: Team De Bijsluiter <noreply@bijsluiter.nl>\r\n";
        $header .= "Content-type:text/html;charset=UTF-8\r\n";
        mail($emailaddress, $title, $message, $header);
        
        header("refresh:2; url=index.php");
    }
    else{
        echo "Er is iets mis gegaan tijdens het versturen van de data";
        header("refresh:2; url=index.php");
    }
?>