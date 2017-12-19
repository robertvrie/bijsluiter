<?php
    include("header.php");
?>
<div class="row">
    <h4>Inloggen - Patiënt</h4>
</div>
<div class="row">
    <form class="col-lg-12 col-xs-12" action="login_query.php" method='POST'>
        <div class="row">
            <div class="form-group">
                <label class="col-lg-2 col-xs-11 formApotheekLabel">Verzekeringsnummer</label>
                <input class="col-lg-3 col-xs-11 formApotheek" type="text" name="vzknr" placeholder="Uw verzekeringsnummer">
            </div>
        </div>
        
        <div class="row">
            <div class="form-group">
                <label class="col-lg-2 col-xs-11 formApotheekLabel">E-mail</label>
                <input class="col-lg-3 col-xs-11 formApotheek" type="email" name="email" placeholder="Uw e-mail">
            </div>
        </div>
        
        <div class="row">
            <div class="form-group">
                <label class="col-lg-2 col-xs-11 formApotheekLabel">Geboortedatum</label>
                <input class="col-lg-3 col-xs-11 formApotheek" type="text" name="geboortedatum" placeholder="2000-01-01">
            </div>
        </div>
        <br>
        <input type="hidden" name="role" value="patient">
        <button type="submit" class="btn btn-default col-lg-1 col-md-1">Log in</button>
        <a href="login_employee.php" class='btn btn-link'>Als medewerker inloggen?</a>
    </form>
</div>

<?php
    include("footer.php");
?>