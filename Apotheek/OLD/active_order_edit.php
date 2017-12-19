<?php 
    include("header.php"); 

    $time = date('G:i:s');

    if($time < '13:30:00'){
        $day = date('Y-m-d');
    }else{
        $day= date("Y-m-d", strtotime("+1 day"));
    }
?>

<div class="row">
    <h4 class="col-lg-10">Actieve bestelling: #<?php if(isset($_GET["bestelnr"])){ echo $_GET["bestelnr"]; } ?></h4>
</div>
<div class="row">
    <table class="col-lg-12">
        <tr>
            <th class="col-lg-3">Naam medicijn</th>
            <th class="col-lg-4">Beschrijving</th>
            <th class="col-lg-2">Datum</th>
            <th class="col-lg-2">Tijd</th>
        </tr>
        <?php
            if(isset($_GET["bestelnr"])){
                get_active_order_edit_info($_GET["bestelnr"]);
            }
        ?>
    </table>
</div>
<br>
<form class="col-lg-12" action="update_active_order.php" method="POST">
    <div class="row">
        <label class="col-lg-3">Algemene leverdatum wijzigen:</label>
        <input class="col-lg-2" id="datePicker" type="date" name="datum" placeholder="Nieuwe leverdatum" min="<?php echo $day; ?>">
    </div>
    <br>
    <div class="row">
        <label class="col-lg-3">Algemene levertijd wijzigen:</label>
        <select class="col-lg-2" id="timePicker" name="tijd"></select>
    </div>
    <br>
    <div class="row">
        <button id="editConfirmBtn" class="col-lg-2 btn btn-default" type="submit" disabled>Bevestigen</button>
    </div>
</form>

<?php include("footer.php"); ?>
<script>
    $( function(){
        document.getElementById("datePicker").onchange = function(){
            
            $.ajax({
                type: "POST",
                 url: "get_available_date_time.php",
                data: {date: this.value}
            }).done( function(msg){
                
                var data = JSON.parse(msg);
                $("#timePicker").children().remove();
                $("#timePicker").append(data.timeString);
                
                if(data.timeBool === "true"){
                    $("#editConfirmBtn").prop("disabled", false);
                }else{
                    $("#editConfirmBtn").prop("disabled", true);
                }
            });
        };
    });



</script>