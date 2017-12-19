<?php include("header.php"); ?>
<div class="row">
    <h4 class="col-lg-10">Leveringen</h4>
</div>
<div class="row">
    <table class="col-lg-12">
        <tr>
            <th class="col-lg-2">Naam</th>
            <th class="col-lg-4">Adres</th>
            <th class="col-lg-2">Telefoonnummer</th>
            <th class="col-lg-2">Datum & tijd</th>
            <th class="col-lg-1"></th>
        </tr>
        <?php
            get_active_deliveries();
        ?>
    </table>
</div>
<?php include("footer.php"); ?>