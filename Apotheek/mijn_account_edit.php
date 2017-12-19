<?php
    include("header.php");
    
	//var_dump($result);	

?>
<div class="row">
    <h4 class="col-lg-10">Mijn account wijzigen</h4>
</div>
<?php
/*--------------------------------------------------------------------PATIENT----------------------------------------------------------------*/
    if($_POST['btn'] == 'patient'){
        echo "<div class='row'>
                    <form action='mijn_account_edit_database.php' method='post'>
                        <div class='text-nowrap row'>
                            <label class='col-lg-2 col-xs-5'>Voornaam: </label>
                            <input type='text' class='col-lg-2 col-xs-5' name='voornaam' value='".$_SESSION['voornaam']."'>
                        </div>

                        <br>
                        
                        <div class='text-nowrap row'>
                            <label class='col-lg-2 col-xs-5'>Tussenvoegsel: </label>
                            <input type='text' class='col-lg-2 col-xs-5' name='tussenvoegsel' value='".$_SESSION['tussenvoegsel']."'>
                        </div>

                        <br>

                        <div class='text-nowrap row'>
                            <label class='col-lg-2 col-xs-5'>Achternaam: </label>
                            <input type='text' class='col-lg-2 col-xs-5' name='achternaam' value='".$_SESSION['achternaam']."'>
                        </div>

                        <br>
                        
                        <div class='text-nowrap row'>
                            <label class='col-lg-2 col-xs-5'>Woonplaats: </label>
                            <input type='text' class='col-lg-2 col-xs-5' name='wnplts' value='".$_SESSION['wnplts']."'>
                        </div>

                        <br>
                        
                        <div class='text-nowrap row'>
                            <label class='col-lg-2 col-xs-5'>Straat: </label>
                            <input type='text' class='col-lg-2 col-xs-5' name='straat' value='".$_SESSION['straat']."'>
                        </div>

                        <br>
                        
                        <div class='text-nowrap row'>
                            <label class='col-lg-2 col-xs-5'>Huisnummer: </label>
                            <input type='text' class='col-lg-2 col-xs-5' name='hsnr' value='".$_SESSION['hsnr']."'>
                        </div>

                        <br>
                        
                        <div class='text-nowrap row'>
                            <label class='col-lg-2 col-xs-5'>Postcode: </label>
                            <input type='text' class='col-lg-2 col-xs-5' name='postcode' value='".$_SESSION['postcode']."'>
                        </div>

                        <br>

                        <div class='text-nowrap row'>
                            <label class='col-lg-2 col-xs-5'>Telefoonnummer: </label>
                            <input type='text' class='col-lg-2 col-xs-5' name='tel' value='".$_SESSION['tel']."'>
                        </div>

                        <br>
                        <button type='submit' class='btn login_btn' name='Btn' value='patient'>Wijziging opslaan</button>
                    </form>
                        <br>
                        <a href='mijn_account_edit_wachtwoord.php' class='btn login_btn'>Wijzig wachtwoord</a>
                </div>";
    }

/*--------------------------------------------------------------------HUISARTS----------------------------------------------------------------*/
    elseif($_POST['btn'] == 'huisarts'){
        echo "<div class='row'>
                    <form action='mijn_account_edit_database.php' method='post'>
                        <div class='text-nowrap row'>
                            <label class='col-lg-2 col-xs-5'>Tussenvoegsel: </label>
                            <input type='text' class='col-lg-2 col-xs-5' name='tussenvoegsel' value='".$_SESSION['tussenvoegsel']."'>
                        </div>

                        <br>

                        <div class='text-nowrap row'>
                            <label class='col-lg-2 col-xs-5'>Achternaam: </label>
                            <input type='text' class='col-lg-2 col-xs-5' name='achternaam' value='".$_SESSION['achternaam']."'>
                        </div>

                        <br>

                        <div class='text-nowrap row'>
                            <label class='col-lg-2 col-xs-5'>Telefoonnummer: </label>
                            <input type='text' class='col-lg-2 col-xs-5' name='tel' value='".$_SESSION['tel']."'>
                        </div>

                        <br>
                        <button type='submit' class='btn login_btn' name='Btn' value='huisarts'>Wijziging opslaan</button>
                    </form>
                        <br>
                        <a href='mijn_account_edit_wachtwoord.php' class='btn login_btn'>Wijzig wachtwoord</a>
                </div>";
    }

/*--------------------------------------------------------------------APOTHEKER----------------------------------------------------------------*/    
elseif($_POST['btn'] == 'apotheek'){
        echo "<div class='row'>
                    <form action='mijn_account_edit_database.php' method='post'>
                        <div class='text-nowrap row'>
                            <label class='col-lg-2 col-xs-5'>Naam: </label>
                            <input type='text' class='col-lg-2 col-xs-5' name='naam' value='".$_SESSION['naam']."'>
                        </div>

                        <br>
                        
                        <div class='text-nowrap row'>
                            <label class='col-lg-2 col-xs-5'>Woonplaats: </label>
                            <input type='text' class='col-lg-2 col-xs-5' name='wnplts' value='".$_SESSION['wnplts']."'>
                        </div>

                        <br>

                        <div class='text-nowrap row'>
                            <label class='col-lg-2 col-xs-5'>Straat: </label>
                            <input type='text' class='col-lg-2 col-xs-5' name='straat' value='".$_SESSION['straat']."'>
                        </div>

                        <br>

                        <div class='text-nowrap row'>
                            <label class='col-lg-2 col-xs-5'>Huisnummer: </label>
                            <input type='text' class='col-lg-2 col-xs-5' name='hsnr' value='".$_SESSION['hsnr']."'>
                        </div>

                        <br>
                        
                        <div class='text-nowrap row'>
                            <label class='col-lg-2 col-xs-5'>Postcode: </label>
                            <input type='text' class='col-lg-2 col-xs-5' name='postcode' value='".$_SESSION['postcode']."'>
                        </div>

                        <br>
                        
                        <div class='text-nowrap row'>
                            <label class='col-lg-2 col-xs-5'>Telefoonnummer: </label>
                            <input type='text' class='col-lg-2 col-xs-5' name='tel' value='".$_SESSION['tel']."'>
                        </div>

                        <br>
                        <button type='submit' class='btn login_btn' name='Btn' value='apotheek'>Wijziging opslaan</button>
                    </form>
                        <br>
                        <a href='mijn_account_edit_wachtwoord.php' class='btn login_btn'>Wijzig wachtwoord</a>
                </div>";
    }

/*--------------------------------------------------------------------BEZORGER----------------------------------------------------------------*/
elseif($_POST['btn'] == 'bezorger'){
        echo "<div class='row'>
                    <form action='mijn_account_edit_database.php' method='post'>
                        <div class='text-nowrap row'>
                            <label class='col-lg-2 col-xs-5'>Voornaam: </label>
                            <input type='text' class='col-lg-2 col-xs-5' name='voornaam' value='".$_SESSION['voornaam']."'>
                        </div>

                        <br>
                        <div class='text-nowrap row'>
                            <label class='col-lg-2 col-xs-5'>Tussenvoegsel: </label>
                            <input type='text' class='col-lg-2 col-xs-5' name='tussenvoegsel' value='".$_SESSION['tussenvoegsel']."'>
                        </div>

                        <br>

                        <div class='text-nowrap row'>
                            <label class='col-lg-2 col-xs-5'>Achternaam: </label>
                            <input type='text' class='col-lg-2 col-xs-5' name='achternaam' value='".$_SESSION['achternaam']."'>
                        </div>

                        <br>

                        <div class='text-nowrap row'>
                            <label class='col-lg-2 col-xs-5'>Telefoonnummer: </label>
                            <input type='text' class='col-lg-2 col-xs-5' name='tel' value='".$_SESSION['tel']."'>
                        </div>

                        <br>
                        <button type='submit' class='btn login_btn' name='Btn' value='bezorger'>Wijziging opslaan</button>
                    </form>
                        <br>
                        <a href='mijn_account_edit_wachtwoord.php' class='btn login_btn'>Wijzig wachtwoord</a>
                </div>";
    }


include("footer.php");

?>
