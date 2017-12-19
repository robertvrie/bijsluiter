<?php
	include("header.php");
	//var_dump($_POST);
	
		
		include("db_connect.php");

        if($_SESSION['rol'] == 'patient'){
            $query = "select `wachtwoord` from `patient` where `id`='".$_SESSION['id']."'";
            $result = mysqli_query($conn, $query);
            $record = mysqli_fetch_assoc($result);
        }
        elseif($_SESSION['rol'] == 'huisarts'){
            $query = "select `wachtwoord` from `huisarts` where `id`='".$_SESSION['id']."'";
            $result = mysqli_query($conn, $query);
            $record = mysqli_fetch_assoc($result);
        }
        elseif($_SESSION['rol'] == 'apotheek'){
            $query = "select `wachtwoord` from `apotheek` where `id`='".$_SESSION['id']."'";
            $result = mysqli_query($conn, $query);
            $record = mysqli_fetch_assoc($result);
        }
        elseif($_SESSION['rol'] == 'bezorger'){
            $query = "select `wachtwoord` from `bezorger` where `id`='".$_SESSION['id']."'";
            $result = mysqli_query($conn, $query);
            $record = mysqli_fetch_assoc($result);
        }

        if(md5($_POST['oude_ww']) == $record['wachtwoord']){
            if($_POST['nieuwe_ww'] == $_POST['nogmaals_ww'] && $_POST['nieuwe_ww'] != NULL){
                if($_SESSION['rol'] == 'Patient'){
                    $query = "update `patient` set `wachtwoord` = '".md5($_POST['nieuwe_ww'])."' where `id`='".$_SESSION['id']."'";
                    $result = mysqli_query($conn, $query);
                    echo "Gegevens succesvol gewijzigd";
                    header("refresh:2; url=index.php");
                }
                elseif($_SESSION['rol'] == 'huisarts'){
                    $query = "update `huisarts` set `wachtwoord` = '".md5($_POST['nieuwe_ww'])."' where `id`='".$_SESSION['id']."'";
                    $result = mysqli_query($conn, $query);
                    echo "Gegevens succesvol gewijzigd";
                    header("refresh:2; url=index.php");
                }
                elseif($_SESSION['rol'] == 'apotheek'){
                    $query = "update `apotheker` set `wachtwoord` = '".md5($_POST['nieuwe_ww'])."' where `id`='".$_SESSION['id']."'";
                    $result = mysqli_query($conn, $query);
                    echo "Gegevens succesvol gewijzigd";
                    header("refresh:2; url=index.php");
                }
                elseif($_SESSION['rol'] == 'bezorger'){
                    $query = "update `bezorger` set `wachtwoord` = '".md5($_POST['nieuwe_ww'])."' where `id`='".$_SESSION['id']."'";
                    $result = mysqli_query($conn, $query);
                    echo "Gegevens succesvol gewijzigd";
                    header("refresh:2; url=index.php");
                }
            }
            else{
                echo "De nieuwe wachtwoorden komen niet met elkaar overeen.";
                
                header("refresh:2; url=index.php");
            }
        }
        else{
            echo "Het door u opgegeven `oude wachtwoord` komt niet overeen met de database.";
            
            header("refresh:2; url=index.php");
        }

?>