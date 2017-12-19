<?php include("header.php"); ?>

<div class="row">
    <h4 class="col-lg-10">Bestellingen</h4>
</div>
<div class="row">
    <table class="col-lg-12">
        <tr>
            <th class="col-lg-3">Bestelnummer</th>
            <th class="col-lg-3">Datum levering</th>
            <th class="col-lg-3">Tijd levering</th>
            <th class="col-lg-1"></th>
        </tr>
        <?php
            get_orders_patient($_SESSION["id"]);
        ?>
    </table>
</div>
<?php include("footer.php"); ?>