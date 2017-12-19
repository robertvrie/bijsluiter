<?php
	include("header.php");
	//var_dump($_POST);

        $wachtwoord = get_randomword();
        //var_dump($wachtwoord);

		$query = "insert into `huisarts` (`id`, 
                                          `tussenvoegsel`,
                                          `achternaam`,
                                          `tel`,
                                          `bignr`,
                                          `email`,
                                          `wachtwoord`,
                                          `post`)
                                          VALUES
                                          (NULL,
                                          '".$_POST['tussenvoegsel']."',
                                          '".$_POST['achternaam']."',
                                          ".$_POST['tel'].",
                                          ".$_POST['bignr'].",
                                          '".$_POST['email']."',
                                          '".md5($wachtwoord)."',
                                          ".$_POST['post'].")";
        $result = mysqli_query($conn, $query);

        printf($conn->error);

        if($result){
            echo "Huisarts succesvol opgeslagen";
            $emailaddress = $_POST["email"];
            $title = "Huisarts registratie";
            $message = "
            <html>
                <head>
                </head>
                <body>
                    <h3>Bedankt voor het registreren. Door <a href='http://localhost/2017-2018/Examenopdracht/login_employee.php'>hier</a> te klikken kunt u inloggen. Uw wachtwoord is ".$wachtwoord.". Als u ingelogd bent kunt u uw wachtwoord wijzigen bij `Mijn account`.</h3>
                </body>		
            </html>";
            $header = "From: Team De Bijsluiter <noreply@bijsluiter.nl>\r\n";
            $header .= "Content-type:text/html;charset=UTF-8\r\n";
            mail($emailaddress, $title, $message, $header);
            
            
            
            header("refresh:2; url=index.php");
        }
        else{
            echo "Huisarts niet succesvol opgeslagen";
            header("refresh:2; url=index.php");
        }