<?php include("header.php"); ?>
<div class="row">
    <h4 class="col-lg-10">Bezorger overzicht</h4>
</div>
<div class="row">
    <table class="col-lg-12">
        <tr>
            <th class="col-lg-2">Naam</th>
            <th class="col-lg-2">E-mail</th>
            <th class="col-lg-2">Telefoonnummer</th>
        </tr>
        <?php
            get_bezorger_admin();
        ?>
    </table>
</div>
<?php include("footer.php"); ?>