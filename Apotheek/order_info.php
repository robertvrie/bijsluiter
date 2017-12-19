<?php include("header.php"); ?>

<div class="row">
    <h4 class="col-lg-10">Bestelling: #<?php if(isset($_GET["bestelnr"])){ echo $_GET["bestelnr"]; } ?></h4>
</div>
<div class="row">
    <table class="col-lg-12">
        <tr>
            <th class="col-lg-4">Naam medicijn</th>
            <th class="col-lg-4">Datum & Tijd</th>
            <th class="col-lg-1">Aantal</th>
        </tr>
        <?php
            if(isset($_GET["bestelnr"])){
                get_active_order_info($_GET["bestelnr"]);
            }
        ?>
    </table>
</div>
<?php include("footer.php"); ?>