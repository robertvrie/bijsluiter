<?php
	include("header.php");
	//var_dump($_POST);
    $i = 0;
    while($i < count($_POST['medicijn'])){
        $query = "update `orderregels` set  `datum`   = '".$_POST['datum']."',
                                            `tijd`    = '".$_POST['tijd']."'
                                             where `order` = '".$_POST['bestelnr']."' and `medicijn`='".$_POST['medicijn'][$i]."'";
        $result = mysqli_query($conn, $query);
        $i++;
    }

    if($result){
        echo "De gegevens zijn succesvol gewijzigd";
        header("refresh:2; url=index.php");
    }else{
        echo "De gegevens zijn niet succesvol gewijzigd";
        header("refresh:2; url=index.php");
    }
?>