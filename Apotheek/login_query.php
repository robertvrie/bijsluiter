<?php
    include("header.php");
    
    //var_dump($_POST);

    if((isset($_POST["email"]) && isset($_POST["wachtwoord"])) || (isset($_POST["email"]) && isset($_POST["vzknr"]))){
        include("db_connect.php");
        
        
        $email = $_POST["email"];
        
        
        $query = "";
        
        switch($_POST["role"]){
            case "patient":
                $vzknr = $_POST["vzknr"];
                $geboortedatum = $_POST["geboortedatum"];
                $query .= "select * from patient where vzknr = '".$vzknr."' and email = '".$email."' and geboortedatum = '".$geboortedatum."' and actief = 1;";
                break;
                
            case "huisarts":
                $wachtwoord = ($_POST["wachtwoord"]);
                $query .= "select * from huisarts where email = '".$email."' and wachtwoord = '".$wachtwoord."';";
                break;
                
            case "apotheek":
                $wachtwoord = MD5($_POST["wachtwoord"]);
                $query .= "select * from apotheek where email = '".$email."' and wachtwoord = '".$wachtwoord."';";
                break;
                
            case "bezorger":
                $wachtwoord = MD5($_POST["wachtwoord"]);
                $query .= "select * from bezorger where email = '".$email."' and wachtwoord = '".$wachtwoord."';";
                break;
                
            case "admin":
                $wachtwoord = MD5($_POST["wachtwoord"]);
                $query .= "select * from admin where email = '".$email."' and wachtwoord = '".$wachtwoord."';";
                break;
        }
        
        
        
        $result = mysqli_query($conn, $query);
        $record = mysqli_fetch_assoc($result);
        //printf($conn->error);
        if (mysqli_num_rows($result) > 0){
            switch($_POST["role"]){
                case "patient":
                        $_SESSION["vzknr"] = $record["vzknr"];
                        $_SESSION["voornaam"] = $record["voornaam"];
                        $_SESSION["tussenvoegsel"] = $record["tussenvoegsel"];
                        $_SESSION["achternaam"] = $record["achternaam"];
                        $_SESSION["geboortedatum"] = $record["geboortedatum"];
                        $_SESSION["wnplts"] = $record["wnplts"];
                        $_SESSION["straat"] = $record["straat"];
                        $_SESSION["hsnr"] = $record["hsnr"];
                        $_SESSION["postcode"] = $record["postcode"];
                    break;
                    
                case "huisarts":
                        $_SESSION["bignr"] = $record["bignr"];
                        $_SESSION["tussenvoegsel"] = $record["tussenvoegsel"];
                        $_SESSION["achternaam"] = $record["achternaam"];
                        $_SESSION["post"] = $record["post"];
                    break;
                    
                case "apotheek":
                        $_SESSION["naam"] = $record["naam"];
                        $_SESSION["wnplts"] = $record["wnplts"];
                        $_SESSION["straat"] = $record["straat"];
                        $_SESSION["hsnr"] = $record["hsnr"];
                        $_SESSION["postcode"] = $record["postcode"];
                    break;
                    
                case "bezorger":
                        $_SESSION["voornaam"] = $record["voornaam"];
                        $_SESSION["tussenvoegsel"] = $record["tussenvoegsel"];
                        $_SESSION["achternaam"] = $record["achternaam"];
                    break;
                    
                case "admin":
                        $_SESSION["voornaam"] = $record["voornaam"];
                        $_SESSION["tussenvoegsel"] = $record["tussenvoegsel"];
                        $_SESSION["achternaam"] = $record["achternaam"];
                    break;
            }
            
            $_SESSION["id"] = $record["id"];
            $_SESSION["tel"] = $record["tel"];
            $_SESSION["email"] = $record["email"];
            $_SESSION["rol"] = $_POST["role"];
            
            header("refresh:0;url=index.php");
        }else{
            echo "De door u gegeven combinatie van email adres en wachtwoord is niet bij ons bekend.";
            header("refresh:5;url=login_patient.php");
        }
    }
    include("footer.php");
?>