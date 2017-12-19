<?php
    include("header.php"); 


    
?>
<div class="row">
    <h4 class="col-lg-10">Voorraad Bijhouden</h4>
    <button class="col-lg-2 btn btn-default" onclick='document.getElementById("voorraadForm").submit();'>Bijbestellen in bulk</button>
</div>


<form id="voorraadForm" class="row" action="update_voorraad_database.php" method="POST">
    <table class="col-lg-12">
        <tr>
            <th class="col-lg-2">Naam medicijn</th>
            <th class="col-lg-2">Beschrijving</th>
            <th class="col-lg-2">Voorraad</th>
            <th class="col-lg-2">Verzekerd</th>
        </tr>
        <?php
            
            get_voorraad_rows();
            
        
        ?>
    </table>
</form>


<?php include("footer.php"); ?>