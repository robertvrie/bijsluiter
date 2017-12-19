<?php
    include("header.php");

    $query = "select * from patient where huisarts =".$_SESSION['id'];
    $result = mysqli_query($conn, $query);
    
	//var_dump($result);	
    $time = date('G:i:s');
    $end_time = date('14:30:00');
    $time1 = date('G')+2;
    if($time < '13:30:00'){
        $day = date('Y-m-d');
    }else{
        $day= date("Y-m-d", strtotime("+1 day"));
    }
?>

<h3>Bestelling maken stap 1</h3>
<br><br>
<div class="row">
    <form action="order_step_2.php" method='post'>
        <div class="text-nowrap row">
            <label class='col-lg-1 col-xs-5'>Patiënt:</label>
            <select class='col-lg-2 col-xs-5' name='naam'>
                     <?php foreach($result as $key){
                         echo "<option value='".$key['id']."'>".$key['voornaam']."-".$key['achternaam']."</option>";
                     } ?>
            </select>
        </div>
        <br>
        <div class="text-nowrap row">
            <label class='col-lg-1 col-xs-5'>Datum:</label>
            <input class='col-lg-2 col-xs-5' id='datum' type="date" name="datum" placeholder="Leverdatum" min='<?php echo $day; ?>'>
        </div>
        <br>
        <div class="text-nowrap row">
            <label class='col-lg-1 col-xs-5'>Tijd:</label>
            <select class='col-lg-2 col-xs-5' id='tijd' name='tijd'>
            </select>
        </div>
        <br>
            <button class="btn login_btn" id='extraopdracht' name='Btn' value='huisarts'>Spoed</button>

        <br>
        <button type="submit" class="btn login_btn" id='btn' name='Btn' value='huisarts' style="display: none;">Verder naar stap 2</button>
    </form>
</div>
<?php include("footer.php"); ?>
 <script>     
    $( function(){
        
        document.getElementById("extraopdracht").onclick = function(){
            <?php $day = date('Y-m-d'); ?>
            document.getElementById("datum").setAttribute("min", '<?php echo $day ?>');
            document.getElementById("datum").value = '<?php echo $day; ?>';
            $("#tijd").children().remove();
            $("#tijd").append("<option><?php echo $time1; ?>:00</option>");
            document.getElementById('extraopdracht').style.display = 'none';
        }

        
        
        
        document.getElementById("datum").onchange = function(){
            //console.log(this.value);
            $.ajax({
                type: "post",
                 url: "get_available_date_time.php",
                data: {date: this.value}
            }).done( function(msg){
                //alert(msg);
                var data = JSON.parse(msg);
                $("#tijd").children().remove();
                $("#tijd").append(data.timeString);
                
                if(data.timeBool === "true"){
                    document.getElementById('btn').style.display = 'block';
                }else{
                    document.getElementById('btn').style.display = 'none';
                }
                
                
            });
        };
    });
  </script>
