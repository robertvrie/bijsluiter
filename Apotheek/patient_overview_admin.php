<?php include("header.php"); ?>
<div class="row">
    <h4 class="col-lg-10">Patiënt overzicht</h4>
</div>
<div class="row">
    <table class="col-lg-12">
        <tr>
            <th class="col-lg-2">Naam</th>
            <th class="col-lg-2">Verzekeringsnummer</th>
            <th class="col-lg-2">Geboortedatum</th>
            <th class="col-lg-2">Telefoonnummer</th>
            <th class="col-lg-3">Adres</th>
            <th class="col-lg-1">Actief</th>
        </tr>
        <?php
            get_patients_admin();
        ?>
    </table>
</div>
<?php include("footer.php"); ?>