<?php include("header.php"); ?>
<div class="row">
    <h4 class="col-lg-10">Overzicht Huisartsen</h4>
    <a href="create_huisarts.php" class="col-lg-2 btn btn-default">Huisarts toevoegen</a>
</div>
<div class="row">
    <table class="col-lg-12">
        <tr>
            <th class="col-lg-2">Naam</th>
            <th class="col-lg-2">BIG</th>
            <th class="col-lg-2">E-mail</th>
            <th class="col-lg-2">Telefoonnummer</th>
            <th class="col-lg-2">Post</th>
        </tr>
        <?php
            get_huisartsen();
        ?>
    </table>
</div>

<?php include("footer.php"); ?>