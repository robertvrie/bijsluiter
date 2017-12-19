    <?php
    include("header.php");
    
	//var_dump($result);	

?>

<div class="row">
    <h4 class="col-lg-10">Mijn account wachtwoord wijzigen</h4>
</div>
<div class="row">
    <form class="col-lg-12" action="mijn_account_edit_wachtwoord_database.php" method='post'>
        <div class="text-nowrap row">
            <label class='col-lg-2 col-xs-5'>Oude wachtwoord: </label>
            <input type='password' class='col-lg-2 col-xs-5' name='oude_ww'>
        </div>

        <br>
        
        <div class="text-nowrap row">
            <label class='col-lg-2 col-xs-5'>Nieuwe wachtwoord: </label>
            <input type='password' class='col-lg-2 col-xs-5' name='nieuwe_ww'>
        </div>
        
        <br>
        
        <div class="text-nowrap row">
            <label class='col-lg-2 col-xs-5'>Wachtwoord herhalen:</label>
            <input type='password' class='col-lg-2 col-xs-5' name='nogmaals_ww'>
        </div>

        <br>
        <button type="submit" class="btn login_btn">Wijziging opslaan</button>
    </form>
</div>
<?php include("footer.php"); ?>