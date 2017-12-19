<?php 
    include("header.php"); 

    $time = date('G:i:s');

    if($time < '13:30:00'){
        $day = date('Y-m-d');
    }else{
        $day= date("Y-m-d", strtotime("+1 day"));
    }
    
    //var_dump($_POST);
    
?>

<div class="row">
    <h4 class="col-lg-10">Actieve bestelling: #<?php echo $_GET['bestelnr'];?></h4>
</div>
<?php
    $opquery = "select distinct datum from `orderregels` where `order`= ".$_GET["bestelnr"].";";
    $opresult = mysqli_query($conn, $opquery);
    //printf($conn->error);
    $counter = 1;
    while($oprecord = mysqli_fetch_assoc($opresult)){
        //echo $oprecord['datum'];
        
?>
<div class="row">
    <form class="col-lg-12" action="order_edit_database.php" method="POST">
        <table class="col-lg-12">
            <tr>
                <th class="col-lg-3">Naam medicijn</th>
                <th class="col-lg-5">Beschrijving</th>
                <th class="col-lg-2">Datum</th>
                <th class="col-lg-2">Tijd</th>
            </tr>
            <?php
                $query = "select * from `orderregels`, `medicijnen` where `orderregels`.`order`='".$_GET['bestelnr']."' and `datum` ='".$oprecord['datum']."' and `orderregels`.`medicijn`=`medicijnen`.`id`";
                $result = mysqli_query($conn, $query);
                while($record = mysqli_fetch_assoc($result)){
                    echo "<tr>
                    <td class=\"col-lg-3\">".$record['naam']."</td>
                    <td class=\"col-lg-5\">".$record['beschrijving']."</td>
                    <td class=\"col-lg-2\">".$record['datum']."</td>
                    <td class=\"col-lg-2\">".$record['tijd']."</td>
                    <input type='hidden' name='medicijn[]' value='".$record['medicijn']."'></td>";
                }
            ?>
        </table>
        <br>
        <input type='hidden' name='bestelnr' value='<?php echo $_GET['bestelnr']; ?>'>
        <br>
        <br>
        <div class="text-nowrap row">
            <label class='col-lg-2 col-xs-5'>Nieuwe datum:</label>
            <input class='col-lg-2 col-xs-5' id='datum<?php echo $counter;?>' type="date" name="datum" min='<?php echo $day; ?>'>
        </div>
        
        <br>
        
        <div class="text-nowrap row">
            <label class='col-lg-2 col-xs-5'>Nieuwe tijd:</label>
            <select class='col-lg-2 col-xs-5' id='tijd<?php echo $counter;?>' name='tijd'>
            </select>
        </div>
        
        <br>
        <button type="submit" class="btn btn-default" id='btn<?php echo $counter;?>' style="display: none;">Wijziging opslaan</button>
    </form>
</div>
    
     <script>     
        $( function(){
            document.getElementById("datum<?php echo $counter;?>").onchange = function(){
                //console.log(this.value);
                $.ajax({
                    type: "POST",
                     url: "get_available_date_time.php",
                    data: {date: this.value}
                }).done( function(msg){
                    //alert(msg);
                    var data = JSON.parse(msg);
                    $("#tijd<?php echo $counter;?>").children().remove();
                    $("#tijd<?php echo $counter;?>").append(data.timeString);

                    if(data.timeBool === "true"){
                        document.getElementById('btn<?php echo $counter;?>').style.display = 'block';
                    }else{
                        document.getElementById('btn<?php echo $counter;?>').style.display = 'none';
                    }


                });
            };
        });
      </script>
<?php
    $counter++;
    //echo $counter;
    }
?>
<?php      
    include("footer.php");
?>