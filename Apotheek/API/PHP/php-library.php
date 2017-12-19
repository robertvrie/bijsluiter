<?php
    function get_record($table, $fields, $where = null){
        global $conn;
        
        $lastField = end($fields);
        
        $query = "SELECT ";
        foreach($fields as $field){
            $query .= "".$field."";
            if($field !== $lastField){
                $query .= ", ";
            }
        }
        
        $query .= " FROM `{$table}`";
        
        if($where !== null){
            $lastWhere = end($where);
            $query .= " where ";
            foreach($where as $key){
                $query .= "".$key."";
                if($key !== $lastWhere){
                    $query .= " and ";
                }
            }
        }
        $query .= ";";
        $result = mysqli_query($conn, $query);
        
        while($record = mysqli_fetch_assoc($result)){
            foreach($fields as $field){
                echo $record[$field];
            }
        }
    }

    function get_huisartsenpost(){
        global $conn;
        
        $query = "select * from `huisartsenpost`";
        $result = mysqli_query($conn, $query);
        //var_dump($result);
        while($record = mysqli_fetch_assoc($result)){
              echo "<option value='".$record['id']."'>".$record['naam']."</option>";
        }
    }

    function get_apotheek(){
        global $conn;
        
        $query = "select * from `apotheek`";
        $result = mysqli_query($conn, $query);
        //var_dump($result);
        while($record = mysqli_fetch_assoc($result)){
              echo "<option value='".$record['id']."'>".$record['naam']."</option>";
        }
    }

    function get_patient(){
        global $conn;
        
        $query = "select * from `patient` where `huisarts`='".$_SESSION['id']."'";
        $result = mysqli_query($conn, $query);
        //var_dump($result);
        while($record = mysqli_fetch_assoc($result)){
              echo "<tr>
                        <td class=\"col-lg-2\">".$record['achternaam'];
            
            if($record["tussenvoegsel"] != ""){
                echo       ", ".$record['tussenvoegsel'];
            }
             
             echo       "</td>
                        <td class=\"col-lg-2\">".$record['vzknr']."</td>
                        <td class=\"col-lg-2\">".$record['geboortedatum']."</td>
                        <td class=\"col-lg-2\">".$record['tel']."</td>
                        <td class=\"col-lg-2\">".$record['wnplts'].", ".$record['straat'].", ".$record['hsnr'].", ".$record['postcode']."</td>
                        </tr>";
        }
    }

    function get_randomword($len = 10) {
        $word = array_merge(range('a', 'z'), range('A', 'Z'));
        shuffle($word);
        return substr(implode($word), 0, $len);
    }

    function get_home_by_role($rol){
        switch($rol){
            case "patient":
                echo "<div class=\"row upperHomeRow\">
                        <div class=\"col-lg-12\">
                            <div class=\"col-lg-2 homeButton\" onclick=\"location.href='active_orders_overview.php';\">Actieve bestellingen</div>
                            <div class=\"col-lg-1\"></div>
                            <div class=\"col-lg-2 homeButton\" onclick=\"location.href='mijn_account.php';\">Mijn account</div>
                            </div>
                            </div>
                            <div class=\"row lowerHomeRow\">
                            <div class=\"col-lg-12\">
                            <div class=\"col-lg-2 homeButton\" onclick=\"location.href='order_overview_patient.php';\">Bestel overzicht</div>
                        </div>
                     </div>";
                break;
                
            case "huisarts":
                echo "<div class=\"row upperHomeRow\">
                        <div class=\"col-lg-12\">
                            <div class=\"col-lg-2 homeButton\" onclick=\"location.href='order_step_1.php';\">Bestelling aanmaken</div>
                            <div class=\"col-lg-1\"></div>
                            <div class=\"col-lg-2 homeButton\" onclick=\"location.href='order_overview_huisarts.php';\">Bestel overzicht</div>
                            <div class=\"col-lg-1\"></div>
                            <div class=\"col-lg-2 homeButton\" onclick=\"location.href='mijn_account.php';\">Mijn account</div>
                            </div>
                            </div>
                            <div class=\"row lowerHomeRow\">
                            <div class=\"col-lg-12\">
                            <div class=\"col-lg-2 homeButton\" onclick=\"location.href='create_patient.php';\">Patiënt aanmaken</div>
                            <div class=\"col-lg-1\"></div>
                            <div class=\"col-lg-2 homeButton\" onclick=\"location.href='patient_overview_huisarts.php';\">Patiënt overzicht</div>
                        </div>
                     </div>";
                break;
                
            case "apotheek":
                    echo "<div class=\"row upperHomeRow\">
                        <div class=\"col-lg-12\">
                            <div class=\"col-lg-2 homeButton\" onclick=\"location.href='voorraad_overview.php';\">Voorraad bijhouden</div>
                            <div class=\"col-lg-1\"></div>
                            <div class=\"col-lg-2 homeButton\" onclick=\"location.href='huisarts_overview.php';\">Huisarts overzicht</div>
                            <div class=\"col-lg-1\"></div>
                            <div class=\"col-lg-2 homeButton\" onclick=\"location.href='most_used_medicine_overview.php';\">Meest gebruikte medicijnen overzicht</div>
                            </div>
                            </div>
                            <div class=\"row lowerHomeRow\">
                            <div class=\"col-lg-12\">
                            <div class=\"col-lg-2 homeButton\" onclick=\"location.href='create_huisarts.php';\">Huisarts toevoegen</div>
                            <div class=\"col-lg-1\"></div>
                            <div class=\"col-lg-2 homeButton\" onclick=\"location.href='patient_overview_apotheek.php';\">Patiënt overzicht</div>
                            <div class=\"col-lg-1\"></div>
                            <div class=\"col-lg-2 homeButton\" onclick=\"location.href='mijn_account.php';\">Mijn account</div>
                        </div>
                     </div>";
                break;
                
            case "bezorger":
                echo "
                    <div class=\"row upperHomeRow\">
                        <div class=\"col-lg-12\">
                            <div class=\"col-lg-2 homeButton\" onclick=\"location.href='delivery_overview.php';\">Leveringen</div>
                        </div>
                    </div>
                    <div class=\"row lowerHomeRow\">
                        <div class=\"col-lg-12\">
                            <div class=\"col-lg-2 homeButton\" onclick=\"location.href='mijn_account.php';\">Mijn account</div>
                        </div>
                    </div>";
                break;
                
            case "admin":
                echo "
                <div class=\"row upperHomeRow\">
                    <div class=\"col-lg-12\">
                        <div class=\"col-lg-2 homeButton\" onclick=\"location.href='patient_overview_admin.php';\">Patiënt overzicht</div>
                            <div class=\"col-lg-1\"></div>
                        <div class=\"col-lg-2 homeButton\" onclick=\"location.href='huisarts_overview.php';\">Huisarts overzicht</div>
                    </div>
                </div>
                <div class=\"row lowerHomeRow\">
                    <div class=\"col-lg-12\">
                        <div class=\"col-lg-2 homeButton\" onclick=\"location.href='bezorger_overview.php';\">Bezorger overzicht</div>
                            <div class=\"col-lg-1\"></div>
                        <div class=\"col-lg-2 homeButton\" onclick=\"location.href='apotheek_overview.php';\">Apotheek overzicht</div>
                    </div>
                </div>";
                break;
        }
    }

/*//////////////////////////////////////////////////////////
////////////////Apotheker
////////////////
*///////////////////////////////////////////////////////////

    function get_most_used_medicine(){
        global $conn;
        
        $query = "select * from medicijnen order by akb desc";
        $result = mysqli_query($conn, $query);
        
        $i = 1;
        while($record = mysqli_fetch_assoc($result)){
            echo "
                <tr>
                    <td class=\"col-lg-2\">".$i."</td>
                    <td class=\"col-lg-2\">".$record["naam"]."</td>
                    <td class=\"col-lg-2\">".$record["akb"]."</td>
                </tr>";
            
            $i++;
        }
    }

    function get_voorraad_rows(){
        global $conn;
        $i = 1;
        
        $query1 = "select * from medicijnen order by akb desc;";
        $result1 = mysqli_query($conn, $query1);
        while($record1 = mysqli_fetch_assoc($result1)){
            if($i <= 10){
                $percentage = (($record1["voorraad"] / 100)) * 100;
                $bijbestellen = 100 - $record1["voorraad"];
                $verzekerd = ["Nee", "Ja"];
                if($percentage < 25){
                    echo "
                    <tr>
                        <input type=\"hidden\" name=\"medicijnen[]\" value=\"".$record1["id"]."\">
                        <input type=\"hidden\" name=\"bijbestellen[]\" value=\"".$bijbestellen."\">
                        <td class=\"col-lg-2\">".$record1["naam"]."</td>
                        <td class=\"col-lg-2\">".$record1["beschrijving"]."</td>
                        <td class=\"col-lg-2\">".$record1["voorraad"]."</td>
                        <td class=\"col-lg-2\">".$verzekerd[$record1["verzekerd"]]."</td>
                    </tr>";
                }
            }else if($i <= 20){
                $percentage = (($record1["voorraad"] / 90)) * 100;
                $bijbestellen = 90 - $record1["voorraad"];
                $verzekerd = ["Nee", "Ja"];
                if($percentage < 25){
                    echo "
                    <tr>
                        <input type=\"hidden\" name=\"medicijnen[]\" value=\"".$record1["id"]."\">
                        <input type=\"hidden\" name=\"bijbestellen[]\" value=\"".$bijbestellen."\">
                        <td class=\"col-lg-2\">".$record1["naam"]."</td>
                        <td class=\"col-lg-2\">".$record1["beschrijving"]."</td>
                        <td class=\"col-lg-2\">".$record1["voorraad"]."</td>
                        <td class=\"col-lg-2\">".$verzekerd[$record1["verzekerd"]]."</td>
                    </tr>";
                }
            }else if($i <= 30){
                $percentage = (($record1["voorraad"] / 80)) * 100;
                $bijbestellen = 80 - $record1["voorraad"];
                $verzekerd = ["Nee", "Ja"];
                if($percentage < 25){
                    echo "
                    <tr>
                        <input type=\"hidden\" name=\"medicijnen[]\" value=\"".$record1["id"]."\">
                        <input type=\"hidden\" name=\"bijbestellen[]\" value=\"".$bijbestellen."\">
                        <td class=\"col-lg-2\">".$record1["naam"]."</td>
                        <td class=\"col-lg-2\">".$record1["beschrijving"]."</td>
                        <td class=\"col-lg-2\">".$record1["voorraad"]."</td>
                        <td class=\"col-lg-2\">".$verzekerd[$record1["verzekerd"]]."</td>
                    </tr>";
                }
            }else if($i <= 40){
                $percentage = (($record1["voorraad"] / 70)) * 100;
                $bijbestellen = 70 - $record1["voorraad"];
                $verzekerd = ["Nee", "Ja"];
                if($percentage < 25){
                    echo "
                    <tr>
                        <input type=\"hidden\" name=\"medicijnen[]\" value=\"".$record1["id"]."\">
                        <input type=\"hidden\" name=\"bijbestellen[]\" value=\"".$bijbestellen."\">
                        <td class=\"col-lg-2\">".$record1["naam"]."</td>
                        <td class=\"col-lg-2\">".$record1["beschrijving"]."</td>
                        <td class=\"col-lg-2\">".$record1["voorraad"]."</td>
                        <td class=\"col-lg-2\">".$verzekerd[$record1["verzekerd"]]."</td>
                    </tr>";
                }
            }else if($i <= 50){
                $percentage = (($record1["voorraad"] / 60)) * 100;
                $bijbestellen = 60 - $record1["voorraad"];
                $verzekerd = ["Nee", "Ja"];
                if($percentage < 25){
                    echo "
                    <tr>
                        <input type=\"hidden\" name=\"medicijnen[]\" value=\"".$record1["id"]."\">
                        <input type=\"hidden\" name=\"bijbestellen[]\" value=\"".$bijbestellen."\">
                        <td class=\"col-lg-2\">".$record1["naam"]."</td>
                        <td class=\"col-lg-2\">".$record1["beschrijving"]."</td>
                        <td class=\"col-lg-2\">".$record1["voorraad"]."</td>
                        <td class=\"col-lg-2\">".$verzekerd[$record1["verzekerd"]]."</td>
                    </tr>";
                }
            }else if($i <= 60){
                $percentage = (($record1["voorraad"] / 50)) * 100;
                $bijbestellen = 50 - $record1["voorraad"];
                $verzekerd = ["Nee", "Ja"];
                if($percentage < 25){
                    echo "
                    <tr>
                        <input type=\"hidden\" name=\"medicijnen[]\" value=\"".$record1["id"]."\">
                        <input type=\"hidden\" name=\"bijbestellen[]\" value=\"".$bijbestellen."\">
                        <td class=\"col-lg-2\">".$record1["naam"]."</td>
                        <td class=\"col-lg-2\">".$record1["beschrijving"]."</td>
                        <td class=\"col-lg-2\">".$record1["voorraad"]."</td>
                        <td class=\"col-lg-2\">".$verzekerd[$record1["verzekerd"]]."</td>
                    </tr>";
                }
            }else if($i <= 70){
                $percentage = (($record1["voorraad"] / 40)) * 100;
                $bijbestellen = 40 - $record1["voorraad"];
                $verzekerd = ["Nee", "Ja"];
                if($percentage < 25){
                    echo "
                    <tr>
                        <input type=\"hidden\" name=\"medicijnen[]\" value=\"".$record1["id"]."\">
                        <input type=\"hidden\" name=\"bijbestellen[]\" value=\"".$bijbestellen."\">
                        <td class=\"col-lg-2\">".$record1["naam"]."</td>
                        <td class=\"col-lg-2\">".$record1["beschrijving"]."</td>
                        <td class=\"col-lg-2\">".$record1["voorraad"]."</td>
                        <td class=\"col-lg-2\">".$verzekerd[$record1["verzekerd"]]."</td>
                    </tr>";
                }
            }else if($i <= 80){
                $percentage = (($record1["voorraad"] / 30)) * 100;
                $bijbestellen = 30 - $record1["voorraad"];
                $verzekerd = ["Nee", "Ja"];
                if($percentage < 25){
                    echo "
                    <tr>
                        <input type=\"hidden\" name=\"medicijnen[]\" value=\"".$record1["id"]."\">
                        <input type=\"hidden\" name=\"bijbestellen[]\" value=\"".$bijbestellen."\">
                        <td class=\"col-lg-2\">".$record1["naam"]."</td>
                        <td class=\"col-lg-2\">".$record1["beschrijving"]."</td>
                        <td class=\"col-lg-2\">".$record1["voorraad"]."</td>
                        <td class=\"col-lg-2\">".$verzekerd[$record1["verzekerd"]]."</td>
                    </tr>";
                }
            }else if($i <= 90){
                $percentage = (($record1["voorraad"] / 20)) * 100;
                $bijbestellen = 20 - $record1["voorraad"];
                $verzekerd = ["Nee", "Ja"];
                if($percentage < 25){
                    echo "
                    <tr>
                        <input type=\"hidden\" name=\"medicijnen[]\" value=\"".$record1["id"]."\">
                        <input type=\"hidden\" name=\"bijbestellen[]\" value=\"".$bijbestellen."\">
                        <td class=\"col-lg-2\">".$record1["naam"]."</td>
                        <td class=\"col-lg-2\">".$record1["beschrijving"]."</td>
                        <td class=\"col-lg-2\">".$record1["voorraad"]."</td>
                        <td class=\"col-lg-2\">".$verzekerd[$record1["verzekerd"]]."</td>
                    </tr>";
                }
            }else if($i <= 100){
                $percentage = (($record1["voorraad"] / 10)) * 100;
                $bijbestellen = 10 - $record1["voorraad"];
                $verzekerd = ["Nee", "Ja"];
                if($percentage < 25){
                    echo "
                    <tr>
                        <input type=\"hidden\" name=\"medicijnen[]\" value=\"".$record1["id"]."\">
                        <input type=\"hidden\" name=\"bijbestellen[]\" value=\"".$bijbestellen."\">
                        <td class=\"col-lg-2\">".$record1["naam"]."</td>
                        <td class=\"col-lg-2\">".$record1["beschrijving"]."</td>
                        <td class=\"col-lg-2\">".$record1["voorraad"]."</td>
                        <td class=\"col-lg-2\">".$verzekerd[$record1["verzekerd"]]."</td>
                    </tr>";
                }
            }
            
            
            
            
            
            
            $i++;
        }
    }

    
    function get_huisartsen(){
        global $conn;
        
        $query = "select huisarts.id, huisarts.tussenvoegsel, huisarts.achternaam, huisarts.tel, huisarts.bignr, huisarts.email, huisartsenpost.naam from huisarts, huisartsenpost where huisarts.post = huisartsenpost.id;";
        $result = mysqli_query($conn, $query);
        while($record = mysqli_fetch_assoc($result)){
            echo "<tr>
                    <td class=\"col-lg-2\">".$record["achternaam"];
                    
            if($record["tussenvoegsel"] != ""){
                echo ", ".$record["tussenvoegsel"];
            }
                    
                    
           echo     "</td>
                    <td class=\"col-lg-2\">".$record["bignr"]."</td>
                    <td class=\"col-lg-2\">".$record["email"]."</td>
                    <td class=\"col-lg-2\">".$record["tel"]."</td>
                    <td class=\"col-lg-2\">".$record["naam"]."</td>
                </tr>";
        }
    }

    function get_patients_apotheek(){
        global $conn;
        $query = "select * from patient where apotheek =".$_SESSION["id"].";";
        $result = mysqli_query($conn, $query);
        
        $active = ["Nee", "Ja"];
        
        while($record = mysqli_fetch_assoc($result)){
            echo "
            <tr>
                <td class=\"col-lg-02\">".$record["achternaam"].", ".$record["voornaam"]." ".$record["tussenvoegsel"]."</td>
                <td class=\"col-lg-02\">".$record["vzknr"]."</td>
                <td class=\"col-lg-02\">".$record["geboortedatum"]."</td>
                <td class=\"col-lg-02\">".$record["tel"]."</td>
                <td class=\"col-lg-02\">".$record["straat"]." ".$record["hsnr"].", ".$record["postcode"]." ".$record["wnplts"]."</td>
                <td class=\"col-lg-02\">".$active[$record["actief"]]."</td>
            </tr>";
            
        }
        
    }
    

/*//////////////////////////////////////////////////////////
////////////////Patient
////////////////
*///////////////////////////////////////////////////////////

    function get_active_orders($patientid){
        global $conn;
        
        $query1 = "select * from `order` as o where o.patient = ".$patientid." and o.orderstatus = 1;";
        $result1 = mysqli_query($conn, $query1);
        //printf($conn->error);
        while($record1 = mysqli_fetch_assoc($result1)){
            $query2 = "SELECT distinct `orderregels`.`order`, `orderregels`.`datum` AS `datum`, `orderregels`.`tijd` AS `tijd` FROM `orderregels` WHERE `orderregels`.`order` = ".$record1["id"]." and `orderregels`.datum = (select o.datum from `orderregels` as o where o.`order` = ".$record1["id"]." and o.orderActief = 1 order by o.datum limit 1) order by `datum` limit 1;";
        
            $result2 = mysqli_query($conn, $query2);
            //printf($conn->error);
            
            while($record2 = mysqli_fetch_assoc($result2)){
                echo "
                <tr>
                    <td class=\"col-lg-2\">".$record2["order"]."</td>
                    <td class=\"col-lg-2\">".$record2["datum"]."</td>
                    <td class=\"col-lg-2\">".$record2["tijd"]."</td>
                    <td class=\"col-lg-1 tableButtons\" onclick=\"location.href='active_order_info.php?bestelnr=".$record2["order"]."';\">Info</td>
                    <td class=\"col-lg-2 tableButtons\" onclick=\"location.href='active_order_edit.php?bestelnr=".$record2["order"]."';\">Levering wijzigen</td>
                </tr>";
            }
        }
    }

    function get_active_order_info($ordernr){
        global $conn;
        
        $query = "select m.naam, o.datum, o.tijd, o.aantal from `medicijnen` as m, `orderregels` as o where m.id = o.medicijn and o.`order` = ".$ordernr." order by o.datum, o.tijd;";
        
        $result = mysqli_query($conn, $query);
        
        while($record = mysqli_fetch_assoc($result)){
            echo "
            <tr>
                <td class=\"col-lg-4\">".$record["naam"]."</td>
                <td class=\"col-lg-4\">".$record["datum"].", ".$record["tijd"]."</td>
                <td class=\"col-lg-1\">".$record["aantal"]."</td>
            </tr>";
        }
    }

    function get_active_order_edit_info($ordernr){
        global $conn;
        
        $query = "select m.naam, m.beschrijving, o.datum, o.tijd, o.aantal from `medicijnen` as m, `orderregels` as o where m.id = o.medicijn and o.`order` = ".$ordernr." and o.orderActief = 1 and o.datum = (select o.datum from `orderregels` as o order by o.datum limit 1) order by o.datum, o.tijd;";
        
        $result = mysqli_query($conn, $query);
        
        while($record = mysqli_fetch_assoc($result)){
            echo "
            <tr>
                <td class=\"col-lg-3\">".$record["naam"]."</td>
                <td class=\"col-lg-4\">".$record["beschrijving"]."</td>
                <td class=\"col-lg-2\">".$record["datum"]."</td>
                <td class=\"col-lg-2\">".$record["tijd"]."</td>
            </tr>";
        }
    }

/*//////////////////////////////////////////////////////////
////////////////Bezorger
////////////////
*///////////////////////////////////////////////////////////

    function get_active_deliveries(){
        global $conn;
        
        $query = "SELECT distinct `order`.id, `orderregels`.`datum` AS `datum`, `orderregels`.`tijd` AS `tijd`, `patient`.voornaam, `patient`.tussenvoegsel, `patient`.achternaam, `patient`.straat, `patient`.hsnr, `patient`.postcode, `patient`.wnplts, `patient`.tel FROM `order` LEFT JOIN `orderregels` ON `order`.`id` = `orderregels`.`order` LEFT JOIN `patient` ON `order`.`patient` = `patient`.`id` WHERE `order`.`orderstatus` = 1 and `order`.`orderstatus` = 1 and `orderregels`.datum = (select o.datum from `orderregels` as o where o.datum = '".date("Y-m-d")."' and o.orderActief = 1 order by o.datum limit 1) order by `datum`;";
        
        $result = mysqli_query($conn, $query);
        //printf($conn->error);
        while($record = mysqli_fetch_assoc($result)){
            echo "
            <tr>
                <td class=\"col-lg-2\">".$record["achternaam"].", ".$record["voornaam"]." ".$record["tussenvoegsel"]."</td>
                <td class=\"col-lg-4\">".$record["straat"]." ".$record["hsnr"].", ".$record["postcode"]." ".$record["wnplts"]."</td>
                <td class=\"col-lg-2\">".$record["tel"]."</td>
                <td class=\"col-lg-2\">".$record["datum"].", ".$record["tijd"]."</td>
                <td class=\"col-lg-1 tableButtons\" onclick=\"location.href='active_delivery_edit.php?bestelnr=".$record["id"]."';\">Info</td>
            </tr>";
        }
    }


    function get_active_delivery_rows($ordernr){
        global $conn;
        
        $query = "select `orderregels`.`id` as id, `orderregels`.`datum` as datum, `orderregels`.`tijd` as tijd, `orderregels`.`aantal`, `medicijnen`.`naam` as naam from `orderregels` left join `medicijnen` on `orderregels`.`medicijn` = `medicijnen`.`id` where `orderregels`.`order` = ".$ordernr." and `orderregels`.`orderActief` = 1 and datum = (select o.datum from `orderregels` as o where o.datum = '".date("Y-m-d")."' and o.orderActief = 1 order by o.datum limit 1) order by naam;";
        
        $result = mysqli_query($conn, $query);
        
        $i = 0;
        while($record = mysqli_fetch_assoc($result)){
            echo "
                <tr>
                    <input type=\"hidden\" name=\"row_".$i."\" value=\"".$record["id"]."\"> 
                    <td class=\"col-lg-3\">".$record["naam"]."</td>
                    <td class=\"col-lg-4\">".$record["datum"].", ".$record["tijd"]."</td>
                    <td class=\"col-lg-2\">".$record["aantal"]."</td>
                    <td class=\"col-lg-2\">
                        <input class=\"col-lg-4\" type=\"radio\" name=\"radio_".$i."\" value=\"1\">Ja<br>
                        <input class=\"col-lg-4\" type=\"radio\" name=\"radio_".$i."\" value=\"0\" checked>Nee
                    </td>
                </tr>";
            $i++;
        }
        echo "<input type=\"hidden\" name=\"amountOfRows\" value=\"".$i."\">";
    }


/*//////////////////////////////////////////////////////////
////////////////Bezorger
////////////////
*///////////////////////////////////////////////////////////

    function get_patients_admin(){
        global $conn;
        $query = "select * from patient;";
        $result = mysqli_query($conn, $query);
        
        $active = ["Nee", "Ja"];
        
        while($record = mysqli_fetch_assoc($result)){
            echo "
            <tr>
                <td class=\"col-lg-02\">".$record["achternaam"].", ".$record["voornaam"]." ".$record["tussenvoegsel"]."</td>
                <td class=\"col-lg-02\">".$record["vzknr"]."</td>
                <td class=\"col-lg-02\">".$record["geboortedatum"]."</td>
                <td class=\"col-lg-02\">".$record["tel"]."</td>
                <td class=\"col-lg-03\">".$record["straat"]." ".$record["hsnr"].", ".$record["postcode"]." ".$record["wnplts"]."</td>
                <td class=\"col-lg-01\">".$active[$record["actief"]]."</td>
            </tr>";   
        }
    }

    function get_apotheek_admin(){
        global $conn;
        $query = "select * from apotheek;";
        $result = mysqli_query($conn, $query);
        
        while($record = mysqli_fetch_assoc($result)){
            echo "
            <tr>
                <td class=\"col-lg-02\">".$record["naam"]."</td>
                <td class=\"col-lg-04\">".$record["straat"]." ".$record["hsnr"].", ".$record["postcode"]." ".$record["wnplts"]."</td>
                <td class=\"col-lg-02\">".$record["email"]."</td>
                <td class=\"col-lg-02\">".$record["tel"]."</td>
            </tr>";
        }
    }

    function get_bezorger_admin(){
        global $conn;
        $query = "select * from bezorger;";
        $result = mysqli_query($conn, $query);
        
        while($record = mysqli_fetch_assoc($result)){
            echo "
            <tr>
                <td class=\"col-lg-02\">".$record["achternaam"].", ".$record["voornaam"]." ".$record["tussenvoegsel"]."</td>
                <td class=\"col-lg-02\">".$record["email"]."</td>
                <td class=\"col-lg-02\">".$record["tel"]."</td>
            </tr>";
        }
    }

    function get_orders_patient($patientid){
        global $conn;
        
        $query = "SELECT distinct `order`.id, `orderregels`.`datum` AS `datum`, `orderregels`.`tijd` AS `tijd` FROM `order` LEFT JOIN `orderregels` ON `order`.`id` = `orderregels`.`order` WHERE `order`.patient = ".$patientid." and `orderregels`.datum = (select o.datum from `orderregels` as o order by o.datum limit 1) order by `datum`;";
        
        $result = mysqli_query($conn, $query);
        //printf($conn->error);
        
        while($record = mysqli_fetch_assoc($result)){
            echo "
            <tr>
                <td class=\"col-lg-3\">".$record["id"]."</td>
                <td class=\"col-lg-3\">".$record["datum"]."</td>
                <td class=\"col-lg-3\">".$record["tijd"]."</td>
                <td class=\"col-lg-2 tableButtons\" onclick=\"location.href='order_info.php?bestelnr=".$record["id"]."';\">Info</td>
            </tr>";
        }
    }

    function get_orders_huisarts($huisartsid){
        global $conn;
        
        $query = "SELECT distinct `order`.id, `orderregels`.`datum` AS `datum`, `orderregels`.`tijd` AS `tijd` FROM `order` LEFT JOIN `orderregels` ON `order`.`id` = `orderregels`.`order` LEFT JOIN `patient` ON `order`.patient = `patient`.id WHERE `order`.patient = `patient`.id and `patient`.huisarts = ".$huisartsid." and `orderregels`.datum = (select o.datum from `orderregels` as o order by o.datum limit 1) order by `datum`;";
        
        $result = mysqli_query($conn, $query);
        printf($conn->error);
        
        while($record = mysqli_fetch_assoc($result)){
            echo "
            <tr>
                <td class=\"col-lg-3\">".$record["id"]."</td>
                <td class=\"col-lg-3\">".$record["datum"]."</td>
                <td class=\"col-lg-3\">".$record["tijd"]."</td>
                <td class=\"col-lg-1 tableButtons\" onclick=\"location.href='order_info.php?bestelnr=".$record["id"]."';\">Info</td>
            </tr>";
        }
    }



















?>