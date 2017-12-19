<?php include("header.php"); ?>

<div class="row">
    <h4 class="col-lg-10">Actieve bestellingen</h4>
</div>
<div class="row">
    <table class="col-lg-12">
        <tr>
            <th class="col-lg-2">Bestelnummer</th>
            <th class="col-lg-2">Datum levering</th>
            <th class="col-lg-2">Tijd levering</th>
            <th class="col-lg-2"></th>
            <th class="col-lg-2"></th>
        </tr>
        <?php
            get_active_orders($_SESSION["id"]);
        ?>
    </table>
</div>
<?php include("footer.php"); ?>