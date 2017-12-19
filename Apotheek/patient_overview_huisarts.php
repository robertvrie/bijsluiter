<?php include("header.php"); ?>

<div class="row">
    <h4 class="col-lg-10">Patiënt overzicht</h4>
</div>
<div class="row">
    <div class="text-nowrap row">
        <table class='col-lg-12 col-xs-12'>
            <tr>
                <th class="col-lg-2">Naam</th>
                <th class="col-lg-2">Verzekeringsnr</th>
                <th class="col-lg-2">Geboortedatum</th>
                <th class="col-lg-2">Telefoonnummer</th>
                <th class="col-lg-2">Adres</th>
            </tr>
            <?php get_patient(); ?>
        </table>
    </div>
</div>
<?php include("footer.php"); ?>