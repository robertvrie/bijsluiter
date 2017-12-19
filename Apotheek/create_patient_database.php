<?php
	include("header.php");
	//var_dump($_POST);

        //var_dump($wachtwoord);

		$query = "insert into `patient` (`id`, 
                                          `vzknr`,
                                          `voornaam`,
                                          `tussenvoegsel`,
                                          `achternaam`,
                                          `geboortedatum`,
                                          `wnplts`,
                                          `straat`,
                                          `hsnr`,
                                          `postcode`,
                                          `tel`,
                                          `actief`,
                                          `huisarts`,
                                          `apotheek`,
                                          `email`)
                                          VALUES
                                          ('NULL',
                                          '".$_POST['vzknr']."',
                                          '".$_POST['voornaam']."',
                                          '".$_POST['tussenvoegsel']."',
                                          '".$_POST['achternaam']."',
                                          '".$_POST['geboortedatum']."',
                                          '".$_POST['wnplts']."',
                                          '".$_POST['straat']."',
                                          ".$_POST['hsnr'].",
                                          '".$_POST['postcode']."',
                                          ".$_POST['tel'].",
                                          0,
                                          ".$_SESSION['id'].",
                                          ".$_POST['apotheek'].",
                                          '".$_POST['email']."')";
        $result = mysqli_query($conn, $query);

        //printf($conn->error);

        if($result){
            echo "Patient succesvol opgeslagen";
            header("refresh:2; url=index.php");
        }
        else{
            echo "Patient niet succesvol opgeslagen";
            header("refresh:2; url=index.php");
        }