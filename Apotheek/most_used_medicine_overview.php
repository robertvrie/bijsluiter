<?php include("header.php"); ?>
<div class="row">
    <h4 class="col-lg-10">Meest gebruikte medicijnen</h4>
</div>
<div class="row">
    <table class="col-lg-12">
        <tr>
            <th class="col-lg-2">Rank</th>
            <th class="col-lg-2">Naam</th>
            <th class="col-lg-2">Aantal keer besteld</th>
        </tr>
        <?php
            get_most_used_medicine();
        ?>
    </table>
</div>
<?php include("footer.php"); ?>