<?php
    include("header.php");
?>

<div class="row">
    <h4 class="col-lg-10">Patiënt aanmaken</h4>
</div>
    <div class="row">
        <form class="col-lg-12" action="create_patient_database.php" method='post'>
            <div class="text-nowrap row">
                <label class='col-lg-2 col-xs-5'>Voornaam:</label>
                <input class='col-lg-2 col-xs-5' type='text' name='voornaam'>
            </div>

            <br>
            
            <div class="text-nowrap row">
                <label class='col-lg-2 col-xs-5'>Tussenvoegsel:</label>
                <input class='col-lg-2 col-xs-5' type='text' name='tussenvoegsel'>
            </div>

            <br>

            <div class="text-nowrap row">
                <label class='col-lg-2 col-xs-5'>Achternaam:</label>
                <input class='col-lg-2 col-xs-5' type="text" name="achternaam">
            </div>

            <br>

            <div class="text-nowrap row">
                <label class='col-lg-2 col-xs-5'>Telefoonnummer:</label>
                <input class='col-lg-2 col-xs-5' type="text" name="tel">
            </div>

            <br>
            
            <div class="text-nowrap row">
                <label class='col-lg-2 col-xs-5'>Verzekeringsnummer:</label>
                <input class='col-lg-2 col-xs-5' type="text" name="vzknr">
            </div>

            <br>
            
            <div class="text-nowrap row">
                <label class='col-lg-2 col-xs-5'>Geboortedatum:</label>
                <input class='col-lg-2 col-xs-5' type="date" name="geboortedatum">
            </div>

            <br>
            
            <div class="text-nowrap row">
                <label class='col-lg-2 col-xs-5'>Woonplaats:</label>
                <input class='col-lg-2 col-xs-5' type="text" name="wnplts">
            </div>

            <br>
            
            <div class="text-nowrap row">
                <label class='col-lg-2 col-xs-5'>Straat:</label>
                <input class='col-lg-2 col-xs-5' type="text" name="straat">
            </div>

            <br>
            
            <div class="text-nowrap row">
                <label class='col-lg-2 col-xs-5'>Huisnummer:</label>
                <input class='col-lg-2 col-xs-5' type="number" name="hsnr">
            </div>

            <br>
            
            <div class="text-nowrap row">
                <label class='col-lg-2 col-xs-5'>Postcode:</label>
                <input class='col-lg-2 col-xs-5' type="text" name="postcode">
            </div>

            <br>
            
            <div class="text-nowrap row">
                <label class='col-lg-2 col-xs-5'>Apotheek:</label>
                <select class='col-lg-2 col-xs-5' name="apotheek">
                    <?php get_apotheek(); ?>
                </select>
            </div>
            
            <br>
            
            <div class="text-nowrap row">
                <label class='col-lg-2 col-xs-5'>E-mail:</label>
                <input class='col-lg-2 col-xs-5' type="email" name="email">
            </div>
            
            <br>
            
            <button type="submit" class="btn btn-default">Patiënt opslaan</button>
        </form>
    </div>
<?php      
    include("footer.php");
?>
