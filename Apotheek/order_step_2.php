<?php
    include("header.php");	

    
    echo "<h3>Bestelling maken stap 2</h3>";
    
   
    echo "<form action='order_step_3.php' method='post'>";
    get_medicijnen();
    echo "<input type='hidden' name='naam' value='".$_POST['naam']."'>";
    echo "<input type='hidden' name='datum' value='".$_POST['datum']."'>";
    echo "<input type='hidden' name='tijd' value='".$_POST['tijd']."'>";

function get_medicijnen(){
    global $conn;
    
    $query = "select id, naam, beschrijving, types from medicijnen order by naam;";
    $result = mysqli_query($conn, $query);
    
    while($record = mysqli_fetch_assoc($result)){
        echo "<div class=\"row\"><label class='nopadding nomargin col-lg-3' style=\"border: 1px solid black;\" data-toggle='tooltip' title='".$record['types']."--".$record['beschrijving']."'>".$record['naam']."<input name='medicijn[]' value='".$record['id']."' class='checkbox' type='checkbox'></label></div>";
    }
}
    
    echo "<button type='submit' class='btn login_btn' name='Btn' value='huisarts'>Verder naar stap 3</button>";
    echo "</form>";

include("footer.php");

?>

<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>