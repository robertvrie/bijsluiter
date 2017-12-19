<?php include("header.php"); ?>

<div class="row">
    <h4 class="col-lg-9">Levering: #<?php if(isset($_GET["bestelnr"])){ echo $_GET["bestelnr"]; } ?></h4>
    <form class="col-lg-3" action="update_delivery_absent.php" method="POST">
        <button class="col-lg-12 btn btn-default" name="order" value="<?php if(isset($_GET["bestelnr"])){ echo $_GET["bestelnr"]; } ?>" type="submit">Patiënt afwezig melden</button>
    </form>
</div>
<form class="row" id="leverForm" action="update_delivery_order.php" method="POST">
    <input type="hidden" name="order" value="<?php if(isset($_GET["bestelnr"])){ echo $_GET["bestelnr"]; } ?>">
    <table class="col-lg-12">
        <tr>
            <th class="col-lg-3">Naam medicijn</th>
            <th class="col-lg-4">Datum & tijd</th>
            <th class="col-lg-2">Aantal</th>
            <th class="col-lg-2">Medicijn bezorgd?</th>
        </tr>
        <?php
            if(isset($_GET["bestelnr"])){
                get_active_delivery_rows($_GET["bestelnr"]);
            }
        ?>
    </table>
</form>
<br>
<div class="row">
    <div class="col-lg-10"></div>
    <button class="col-lg-2 btn btn-default" onclick="document.getElementById('leverForm').submit();">Bevestigen</button>
</div>
<?php include("footer.php"); ?>