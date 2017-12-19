<?php
    include('header.php');
    
	//var_dump($result);	

?>
<div class="row">
    <h4 class="col-lg-10">Mijn account</h4>
</div>
<?php 

//---------------------------------PATIENT--------------------------------------------------------------------------//
if($_SESSION['rol'] == 'patient'){
    echo"
            <div class='row'>
                    <div class='text-nowrap row'>
                        <label class='col-lg-2 col-xs-5'>Verzekeringsnummer: </label>
                        <p type='text' class='col-lg-2 col-xs-5'>".$_SESSION['vzknr']."</p>
                    </div>

                    <div class='text-nowrap row'>
                        <label class='col-lg-2 col-xs-5'>Voornaam: </label>
                        <p type='text' class='col-lg-2 col-xs-5'>".$_SESSION['voornaam']."</p>
                    </div>
                    <div class='text-nowrap row'>
                        <label class='col-lg-2 col-xs-5'>Tussenvoegsel: </label>
                        <p type='text' class='col-lg-2 col-xs-5'>".$_SESSION['tussenvoegsel']."</p>
                    </div>";
    
                if($_SESSION['tussenvoegsel']){
                    echo "<div class='text-nowrap row'>
                            <label class='col-lg-2 col-xs-5'>Tussenvoegsel: </label>
                            <p type='text' class='col-lg-2 col-xs-5'>".$_SESSION['tussenvoegsel']."</p>
                        </div>";
                    } echo"            
                    
                    <div class='text-nowrap row'>
                        <label class='col-lg-2 col-xs-5'>Achternaam: </label>
                        <p type='text' class='col-lg-2 col-xs-5'>".$_SESSION['achternaam']."</p>
                    </div>
                    
                    <div class='text-nowrap row'>
                        <label class='col-lg-2 col-xs-5'>Geboortedatum: </label>
                        <p type='text' class='col-lg-2 col-xs-5'>".$_SESSION['geboortedatum']."</p>
                    </div>
                    
                    <div class='text-nowrap row'>
                        <label class='col-lg-2 col-xs-5'>Woonplaats: </label>
                        <p type='text' class='col-lg-2 col-xs-5'>".$_SESSION['wnplts']."</p>
                    </div>
                    
                    <div class='text-nowrap row'>
                        <label class='col-lg-2 col-xs-5'>Straat: </label>
                        <p type='text' class='col-lg-2 col-xs-5'>".$_SESSION['straat']."</p>
                    </div>
                    
                    <div class='text-nowrap row'>
                        <label class='col-lg-2 col-xs-5'>Huisnummer: </label>
                        <p type='text' class='col-lg-2 col-xs-5'>".$_SESSION['hsnr']."</p>
                    </div>

                    <div class='text-nowrap row'>
                        <label class='col-lg-2 col-xs-5'>Postcode: </label>
                        <p type='text' class='col-lg-2 col-xs-5'>".$_SESSION['postcode']."</p>
                    </div>

                    <div class='text-nowrap row'>
                        <label class='col-lg-2 col-xs-5'>Telefoonnummer: </label>
                        <p type='text' class='col-lg-2 col-xs-5'>".$_SESSION['tel']."</p>
                    </div>

                    <div class='text-nowrap row'>
                        <label class='col-lg-2 col-xs-5'>E-mail: </label>
                        <p type='text' class='col-lg-2 col-xs-5'>".$_SESSION['email']."</p>
                    </div>

                    <br>
                    
                    <form action='mijn_account_edit.php' method='post'>
                        <button type='submit' class='btn login_btn' name='btn' value='patient'>Wijzig gegevens</button>
                    </form>
            </div>
                </div>";
}


//---------------------------------HUISARTS--------------------------------------------------------------------------//

elseif($_SESSION['rol'] == 'huisarts'){
    echo"
            <div class='row'>
                    <div class='text-nowrap row'>
                        <label class='col-lg-2 col-xs-5'>Tussenvoegsel: </label>
                        <p type='text' class='col-lg-2 col-xs-5'>".$_SESSION['tussenvoegsel']."</p>
                    </div>

                    <div class='text-nowrap row'>
                        <label class='col-lg-2 col-xs-5'>Achternaam: </label>
                        <p type='text' class='col-lg-2 col-xs-5'>".$_SESSION['achternaam']."</p>
                    </div>

                    <div class='text-nowrap row'>
                        <label class='col-lg-2 col-xs-5'>Telefoonnummer: </label>
                        <p type='text' class='col-lg-2 col-xs-5'>".$_SESSION['tel']."</p>
                    </div>

                    <div class='text-nowrap row'>
                        <label class='col-lg-2 col-xs-5'>Bignummer: </label>
                        <p type='text' class='col-lg-2 col-xs-5'>".$_SESSION['bignr']."</p>
                    </div>

                    <div class='text-nowrap row'>
                        <label class='col-lg-2 col-xs-5'>E-mail: </label>
                        <p type='text' class='col-lg-2 col-xs-5'>".$_SESSION['email']."</p>
                    </div>

                    <br>

                    <form action='mijn_account_edit.php' method='post'>
                        <button type='submit' class='btn login_btn' name='btn' value='huisarts'>Wijzig gegevens</button>
                    </form>
            </div>
                </div>";
}


//---------------------------------APOTHEEK--------------------------------------------------------------------------//

elseif($_SESSION['rol'] == 'apotheek'){
    echo"
            <div class='row'>
                    <div class='text-nowrap row'>
                        <label class='col-lg-2 col-xs-5'>Naam: </label>
                        <p type='text' class='col-lg-2 col-xs-5'>".$_SESSION['naam']."</p>
                    </div>

                    <div class='text-nowrap row'>
                        <label class='col-lg-2 col-xs-5'>Woonplaats: </label>
                        <p type='text' class='col-lg-2 col-xs-5'>".$_SESSION['wnplts']."</p>
                    </div>

                    <div class='text-nowrap row'>
                        <label class='col-lg-2 col-xs-5'>Straat: </label>
                        <p type='text' class='col-lg-2 col-xs-5'>".$_SESSION['straat']."</p>
                    </div>

                    <div class='text-nowrap row'>
                        <label class='col-lg-2 col-xs-5'>Huisnummer: </label>
                        <p type='text' class='col-lg-2 col-xs-5'>".$_SESSION['hsnr']."</p>
                    </div>

                    <div class='text-nowrap row'>
                        <label class='col-lg-2 col-xs-5'>Postcode: </label>
                        <p type='text' class='col-lg-2 col-xs-5'>".$_SESSION['postcode']."</p>
                    </div>
                    
                    <div class='text-nowrap row'>
                        <label class='col-lg-2 col-xs-5'>Telefoonnummer: </label>
                        <p type='text' class='col-lg-2 col-xs-5'>".$_SESSION['tel']."</p>
                    </div>
                    
                    <div class='text-nowrap row'>
                        <label class='col-lg-2 col-xs-5'>E-mail: </label>
                        <p type='text' class='col-lg-2 col-xs-5'>".$_SESSION['email']."</p>
                    </div>

                    <br>

                    <form action='mijn_account_edit.php' method='post'>
                        <button type='submit' class='btn login_btn' name='btn' value='apotheek'>Wijzig gegevens</button>
                    </form>
            </div>
                </div>";
}


//---------------------------------BEZORGER--------------------------------------------------------------------------//

elseif($_SESSION['rol'] == 'bezorger'){
    echo"
            <div class='row'>
                    <div class='text-nowrap row'>
                        <label class='col-lg-2 col-xs-5'>Voornaam: </label>
                        <p type='text' class='col-lg-2 col-xs-5'>".$_SESSION['voornaam']."</p>
                    </div>

                    ";
                    if($_SESSION['tussenvoegsel']){
                        echo "<div class='text-nowrap row'>
                            <label class='col-lg-2 col-xs-5'>Tussenvoegsel: </label>
                            <p type='text' class='col-lg-2 col-xs-5'>".$_SESSION['tussenvoegsel']."</p>
                        </div>";
                    } echo"

                    <div class='text-nowrap row'>
                        <label class='col-lg-2 col-xs-5'>Achternaam: </label>
                        <p type='text' class='col-lg-2 col-xs-5'>".$_SESSION['achternaam']."</p>
                    </div>

                    <div class='text-nowrap row'>
                        <label class='col-lg-2 col-xs-5'>Telefoonnummer: </label>
                        <p type='text' class='col-lg-2 col-xs-5'>".$_SESSION['tel']."</p>
                    </div>

                    <div class='text-nowrap row'>
                        <label class='col-lg-2 col-xs-5'>E-mail: </label>
                        <p type='text' class='col-lg-2 col-xs-5'>".$_SESSION['email']."</p>
                    </div>

                    <br>

                    <form action='mijn_account_edit.php' method='post'>
                        <button type='submit' class='btn login_btn' name='btn' value='bezorger'>Wijzig gegevens</button>
                    </form>
            </div>
                </div>";
}


include('footer.php');

?>
