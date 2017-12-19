<?php
    include("header.php");
?>
<div class="row">
    <button class="btn btn-default col-lg-2 col-md-2" id="huisarts">Huisarts</button>
    <button class="btn btn-default col-lg-2 col-md-2" id="apotheek">Apotheek</button>
    <button class="btn btn-default col-lg-2 col-md-2" id="bezorger">Bezorger</button>
    <button class="btn btn-default col-lg-2 col-md-2" id="admin">Admin</button>
</div>

<div id="huisartsForm" class="row">
    <div class="row">
        <h4 class="col-lg-12 col-md-12">Inloggen - Huisarts</h4>
    </div>
    <div class="row">
        <form class="col-lg-12 col-md-12" action="login_query.php" method="POST">
            <div class="row">
                <div class="form-group">
                    <label class="col-lg-2 col-md-11 formApotheekLabel">E-mail</label>
                    <input class="col-lg-3 col-md-11 formApotheek" type="email" name="email" placeholder="Uw e-mail">
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label class="col-lg-2 col-md-11 formApotheekLabel">Wachtwoord</label>
                    <input class="col-lg-3 col-md-11 formApotheek" type="password" name="wachtwoord" placeholder="Uw wachtwoord">
                </div>
            </div>
            <br>
            <div class="row">
                <input type="hidden" name="role" value="huisarts">
                <button type="submit" class="btn btn-default col-lg-1 col-md-1">Log in</button>
                <a href="login_patient.php" class='btn btn-link'>Als patiënt inloggen?</a>
            </div>
        </form>
    </div>
</div>

<div id="apotheekForm" class="row" hidden>
    <div class="row">
        <h4 class="col-lg-12 col-md-12">Inloggen - Apotheek</h4>
    </div>
    <div class="row">
        <form class="col-lg-12 col-md-12" action="login_query.php" method="POST">
            <div class="row">
                <div class="form-group">
                    <label class="col-lg-2 col-md-11 formApotheekLabel">E-mail</label>
                    <input class="col-lg-3 col-md-11 formApotheek" type="email" name="email" placeholder="Uw e-mail">
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label class="col-lg-2 col-md-11 formApotheekLabel">Wachtwoord</label>
                    <input class="col-lg-3 col-md-11 formApotheek" type="password" name="wachtwoord" placeholder="Uw wachtwoord">
                </div>
            </div>
            <br>
            <div class="row">
                <input type="hidden" name="role" value="apotheek">
                <button type="submit" class="btn btn-default col-lg-1 col-md-1">Log in</button>
                <a href="login_patient.php" class='btn btn-link'>Als patiënt inloggen?</a>
            </div>
        </form>
    </div>
</div>

<div id="bezorgerForm" class="row" hidden>
    <div class="row">
        <h4 class="col-lg-12 col-md-12">Inloggen - Bezorger</h4>
    </div>
    <div class="row">
        <form class="col-lg-12 col-md-12" action="login_query.php" method="POST">
            <div class="row">
                <div class="form-group">
                    <label class="col-lg-2 col-md-11 formApotheekLabel">E-mail</label>
                    <input class="col-lg-3 col-md-11 formApotheek" type="email" name="email" placeholder="Uw e-mail">
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label class="col-lg-2 col-md-11 formApotheekLabel">Wachtwoord</label>
                    <input class="col-lg-3 col-md-11 formApotheek" type="password" name="wachtwoord" placeholder="Uw wachtwoord">
                </div>
            </div>
            <br>
            <div class="row">
                <input type="hidden" name="role" value="bezorger">
                <button type="submit" class="btn btn-default col-lg-1 col-md-1">Log in</button>
                <a href="login_patient.php" class='btn btn-link'>Als patiënt inloggen?</a>
            </div>
        </form>
    </div>
</div>

<div id="adminForm" class="row" hidden>
    <div class="row">
        <h4 class="col-lg-12 col-md-12">Inloggen - Admin</h4>
    </div>
    <div class="row">
        <form class="col-lg-12 col-md-12" action="login_query.php" method="POST">
            <div class="row">
                <div class="form-group">
                    <label class="col-lg-2 col-md-11 formApotheekLabel">E-mail</label>
                    <input class="col-lg-3 col-md-11 formApotheek" type="email" name="email" placeholder="Uw e-mail">
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label class="col-lg-2 col-md-11 formApotheekLabel">Wachtwoord</label>
                    <input class="col-lg-3 col-md-11 formApotheek" type="password" name="wachtwoord" placeholder="Uw wachtwoord">
                </div>
            </div>
            <br>
            <div class="row">
                <input type="hidden" name="role" value="admin">
                <button type="submit" class="btn btn-default col-lg-1 col-md-1">Log in</button>
                <a href="login_patient.php" class='btn btn-link'>Als patiënt inloggen?</a>
            </div>
        </form>
    </div>
</div>

<script>
    var huisarts = document.getElementById("huisartsForm");
    var apotheek = document.getElementById("apotheekForm");
    var bezorger = document.getElementById("bezorgerForm");
    var admin = document.getElementById("adminForm");
    
    $("#huisarts").click(function(){
        huisarts.style.display = "block";
        apotheek.style.display = "none";
        bezorger.style.display = "none";
        admin.style.display = "none";
    });
    
    $("#apotheek").click(function(){
        huisarts.style.display = "none";
        apotheek.style.display = "block";
        bezorger.style.display = "none";
        admin.style.display = "none";
    });
    
    $("#bezorger").click(function(){
        huisarts.style.display = "none";
        apotheek.style.display = "none";
        bezorger.style.display = "block";
        admin.style.display = "none";
    });
    
    $("#admin").click(function(){
        huisarts.style.display = "none";
        apotheek.style.display = "none";
        bezorger.style.display = "none";
        admin.style.display = "block";
    });
</script>

<?php
    include("footer.php");
?>