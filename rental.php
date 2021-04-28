<?php
    include_once "includes/connection.php";

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Rental</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
 
        <link rel="stylesheet" type="text/css" media="screen" href="stylesheet.css">
    </head>

    <body>
        <div class="header">
            <a href="index.php" class= "nostyle">POWERPUFFGIRLS&BOYS</a>
        </div>

        <div class="bar">
            <div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <a href= "actor.php">actor</a>
                <a href= "address.php">address</a>
                <a href= "category.php">category</a>
                <a href= "city.php">city</a>
                <a href= "country.php">country</a>
                <a href= "customer.php">customer</a>
                <a href= "film_actor.php">film_actor</a>
                <a href= "film_category.php">film_category</a>
                <a href= "film_text.php">film_text</a>
                <a href= "film.php">film</a>
                <a href= "inventory.php">inventory</a>
                <a href= "language.php">language</a>
                <a href= "payment.php">payment</a>
                <a href= "rental.php">rental</a>
                <a href= "staff.php">staff</a>
                <a href= "store.php">store</a>
                <a href= "payment&customer.php">payment&customer</a>
                <a href= "film&film_text&film_category&category&language.php">film&film_text&film_category&category&language</a>
                <a href= "country&city&address.php">country&city&address</a>
            </div>

            <div class="menu">
                <span style="font-size:25px;cursor:pointer;color:white; text-align:left; display:inline;" onclick="openNav()">&#9776; MENU</span>
            </div>
            <form action= "" method= "POST" style= 'display: inline;'>
                <input type ="text" name= "search" placeholder="SEARCH BY RENTAL ID" size="30" style= "border-radius: 5px;">
            </form>
            <form action= "" method= "POST" style= 'display: inline;'>
                <input type = "submit" name= "reset" value= "RESET" class="button"> 
            </form>
                <button id="insert" class= "button">INSERT</button>
                <button id="update" class= "button">UPDATE</button>
                <button id="delete" class= "button">DELETE</button>
            </div>


        <?php
            if (isset($_POST['search'])){
                echo "<table><thead><tr><th>Rental_id</th><th>Rental_date</th><th>Inventory_id</th><th>Customer_id</th>
                <th>Return_date</th><th>Staff_id</th><th>Last_update</th></thead><tbody>"; 

                $search = $_POST['search'];
            
                $query = "SELECT * FROM rental WHERE rental_id LIKE '%$search%' LIMIT 1000;";    
                $result = mysqli_query($conn,$query);

                if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){   
                        echo "<tr><td>" . $row['rental_id'] . "</td><td>" . $row['rental_date'] . "</td><td>" . $row['inventory_id'] . "</td>
                        <td>" . $row['customer_id'] . "</td><td>" . $row['return_date'] . "</td><td>" . $row['staff_id'] . "</td><td>" . $row['last_update'] . "</td></tr>";  
                    }
                }else{
                    echo "<tr><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td>
                    <td> --NO DATA-- </td><td> --NO DATA-- </td></tr>";
                }

            }elseif(isset($_POST['reset'])){
                $query = "SELECT * FROM rental";
                $result = mysqli_query($conn,$query);
                $totalrecords= mysqli_num_rows($result);
                $pagelim = ceil($totalrecords/1000);

                echo "<form action= '' method= 'POST'> <input type ='text' name= 'page' placeholder='Input the page number (1 / $pagelim)' size='30' style= 'border-radius: 5px;'></form>";

                echo "<table><thead><tr><th>Rental_id</th><th>Rental_date</th><th>Inventory_id</th><th>Customer_id</th>
                <th>Return_date</th><th>Staff_id</th><th>Last_update</th></thead><tbody>";

                $query = "SELECT * FROM rental WHERE rental_id BETWEEN (0 * 1000) AND (((0 + 1)* 1000)-1)";
                $result = mysqli_query($conn,$query);

                while($row = mysqli_fetch_assoc($result)){   
                    echo "<tr><td>" . $row['rental_id'] . "</td><td>" . $row['rental_date'] . "</td><td>" . $row['inventory_id'] . "</td>
                    <td>" . $row['customer_id'] . "</td><td>" . $row['return_date'] . "</td><td>" . $row['staff_id'] . "</td><td>" . $row['last_update'] . "</td></tr>";  
                }

            }elseif(isset($_POST['page'])){
                $page= $_POST['page'];
                $query = "SELECT * FROM rental";
                $result = mysqli_query($conn,$query);
                $totalrecords= mysqli_num_rows($result);
                $pagelim = ceil($totalrecords/1000);

                if($page <1 || $page > $pagelim){
                    echo("<meta http-equiv='refresh' content='1'>");
                    echo '<script> alert("Page number invalid")</script>';
                    
                }

                echo "<form action= '' method= 'POST'> <input type ='text' name= 'page' placeholder='Input the page number ($page / $pagelim)' size='30' style= 'border-radius: 5px;'></form>";

                echo "<table><thead><tr><th>Rental_id</th><th>Rental_date</th><th>Inventory_id</th><th>Customer_id</th>
                <th>Return_date</th><th>Staff_id</th><th>Last_update</th></thead><tbody>";

                
                $query = "SELECT * FROM rental WHERE rental_id BETWEEN (($page-1) * 1000) AND ((($page)* 1000)-1)";
                $result = mysqli_query($conn,$query);

                while($row = mysqli_fetch_assoc($result)){   
                    echo "<tr><td>" . $row['rental_id'] . "</td><td>" . $row['rental_date'] . "</td><td>" . $row['inventory_id'] . "</td>
                        <td>" . $row['customer_id'] . "</td><td>" . $row['return_date'] . "</td><td>" . $row['staff_id'] . "</td><td>" . $row['last_update'] . "</td></tr>";  
                }

            }else { 
                $query = "SELECT * FROM rental";
                $result = mysqli_query($conn,$query);
                $totalrecords= mysqli_num_rows($result);
                $pagelim = ceil($totalrecords/1000);

                echo "<form action= '' method= 'POST'> <input type ='text' name= 'page' placeholder='Input the page number (1 / $pagelim)' size='30' style= 'border-radius: 5px;'></form>";

                echo "<table><thead><tr><th>Rental_id</th><th>Rental_date</th><th>Inventory_id</th><th>Customer_id</th>
                <th>Return_date</th><th>Staff_id</th><th>Last_update</th></thead><tbody>";

                $query = "SELECT * FROM rental WHERE rental_id BETWEEN (0 * 1000) AND (((0 + 1)* 1000)-1)";
                $result = mysqli_query($conn,$query);

                while($row = mysqli_fetch_assoc($result)){   
                    echo "<tr><td>" . $row['rental_id'] . "</td><td>" . $row['rental_date'] . "</td><td>" . $row['inventory_id'] . "</td>
                        <td>" . $row['customer_id'] . "</td><td>" . $row['return_date'] . "</td><td>" . $row['staff_id'] . "</td><td>" . $row['last_update'] . "</td></tr>";  
                }
            } 
            echo "</tbody></table>";
        ?>

        <div class = "insert">
            <div class = "popupcontent">
                <div class = "insertdown" id="close">+</div>
                <form action= "" method = "post">
                    <p>Rental ID:</p>
                        <input type="text" name="rentalid" onkeydown="return event.key != 'Enter'">
                    <p>Rental Date:</p>
                        <input type="datetime-local" name="rentaldate" onkeydown="return event.key != 'Enter'">
                    <p>Inventory ID:</p>
                        <input type="text" name="inventoryid" onkeydown="return event.key != 'Enter'">
                    <p>Customer ID:</p>
                        <input type="text" name="customerid" onkeydown="return event.key != 'Enter'">
                    <p>Return Date:</p>
                        <input type="datetime-local" name="returndate" onkeydown="return event.key != 'Enter'">
                    <p>Staff ID:</p>
                        <input type="text" name="staffid" style="display:block;" onkeydown="return event.key != 'Enter'">
                    <input type= "submit" name= "insert" class= "greenbutton" value ="INSERT">

                    <?php
                    if(isset($_POST['insert'])){
                        if(!empty($_POST['rentalid'])&& !empty($_POST['rentaldate'])&& !empty($_POST['inventoryid'])&& !empty($_POST['customerid'])
                        && !empty($_POST['staffid'])){
                            if((is_numeric($_POST['rentalid'])) &&$_POST['rentalid'] > 0){
                                $rentalid= $_POST['rentalid'];
                                $query= "SELECT rental_id FROM rental WHERE rental_id = $rentalid;";
                                $result= mysqli_query($conn,$query);

                                if(mysqli_num_rows($result)==0){
                                    $rentalid= $_POST['rentalid'];
                                    $rentaldate= $_POST['rentaldate'];
                                    $inventoryid= $_POST['inventoryid'];
                                    $customerid= $_POST['customerid'];
                                    if(!empty($_POST['returndate']))
                                        $returndate= $_POST['returndate'];
                                    else
                                        $returndate = "0000-00-00 00:00:00";
                                    $staffid= $_POST['staffid'];
                                    $lastupdate= date('Y-m-d H:i:s');
                                    $insert = "INSERT INTO rental VALUES('$rentalid','$rentaldate','$inventoryid','$customerid','$returndate','$staffid','$lastupdate');";
                                    $result = mysqli_query($conn,$insert);
                                    if ($result) {
                                        echo '<script> alert("DATA INSERTED SUCCESSFULLY!")</script>';
                                    }
                                    else
                                    echo '<script> alert("PREVIOUS INSERT FAILED! INVENTORY ID, CUSTOMER ID OR STAFF ID ENTERED DOES NOT EXIST, PLEASE CHECK THE INVENTORY, CUSTOMER AND STAFF TABLES FOR AN EXISTING INVENTORY ID, CUSTOMER ID AND STAFF ID RESPECTIVELY")</script>'; 

                                    echo("<meta http-equiv='refresh' content='1'>");
                                }
                                else{
                                    echo '<script> alert("PREVIOUS INSERT FAILED! RENTAL ID ENTERED ALREADY EXISTS")</script>';
                                }  
                            }
                            else{
                                echo '<script> alert("PREVIOUS INSERT FAILED! INVALID RENTAL ID ENTERED")</script>';
                            }
                        } 
                        else{
                            echo '<script> alert("PREVIOUS INSERT FAILED! ALL FIELDS ARE MANDATORY TO BE FILLED EXCEPT FOR RETURN DATE")</script>';
                        }
                    }
                    
                    ?>
                </form>
            </div>
        </div>

        <div class = "update">
            <div class = "popupcontent">
                <div class = "updatedown" id="close">+</div>
                <form action= "" method = "post">
                    <p>Rental ID:</p>
                        <input type="text" name="rentalid" onkeydown="return event.key != 'Enter'">
                    <p>Rental Date:</p>
                        <input type="datetime-local" name="rentaldate" onkeydown="return event.key != 'Enter'">
                    <p>Inventory ID:</p>
                        <input type="text" name="inventoryid" onkeydown="return event.key != 'Enter'">
                    <p>Customer ID:</p>
                        <input type="text" name="customerid" onkeydown="return event.key != 'Enter'">
                    <p>Return Date:</p>
                        <input type="datetime-local" name="returndate" onkeydown="return event.key != 'Enter'">
                    <p>Staff ID:</p>
                        <input type="text" name="staffid" style="display:block;" onkeydown="return event.key != 'Enter'">
                    <input type= "submit" name= "update" class= "greenbutton" value ="UPDATE">

                    <?php
                    if(isset($_POST['update'])){
                        if(!empty($_POST['rentalid'])&& !empty($_POST['inventoryid'])&& !empty($_POST['customerid'])
                        && !empty($_POST['rentaldate']) && !empty($_POST['staffid'])){
                                if((is_numeric($_POST['rentalid'])) &&$_POST['rentalid'] > 0){
                                $rentalid= $_POST['rentalid'];
                                $query= "SELECT rental_id FROM rental WHERE rental_id = $rentalid;";
                                $result= mysqli_query($conn,$query);

                                if(mysqli_num_rows($result)==1){
                                    $rentalid= $_POST['rentalid'];
                                    $rentaldate= $_POST['rentaldate'];
                                    $inventoryid= $_POST['inventoryid'];
                                    $customerid= $_POST['customerid'];
                                    if(!empty($_POST['returndate']))
                                        $returndate= $_POST['returndate'];
                                    else
                                        $returndate = "0000-00-00 00:00:00";
                                    $staffid= $_POST['staffid'];
                                    $lastupdate= date('Y-m-d H:i:s');
                                    $update = "UPDATE rental SET  rental_date = '$rentaldate', inventory_id= '$inventoryid', customer_id = '$customerid', 
                                    return_date= '$returndate', staff_id= '$staffid', last_update= '$lastupdate' WHERE rental_id = $rentalid;";
                                    $result = mysqli_query($conn,$update); 
                                    
                                    if($result)
                                        echo '<script> alert("DATA UPDATED SUCCESSFULLY!")</script>';
                                    else
                                        echo '<script> alert("PREVIOUS UPDATE FAILED! INVENTORY ID, CUSTOMER ID OR STAFF ID ENTERED DOES NOT EXIST, PLEASE CHECK THE INVENTORY, CUSTOMER AND STAFF TABLES FOR AN EXISTING INVENTORY ID, CUSTOMER ID AND STAFF ID RESPECTIVELY")</script>';
                                    
                                    echo("<meta http-equiv='refresh' content='1'>");
                                }else{
                                    echo '<script> alert("PREVIOUS UPDATE FAILED! RENTAL ID ENTERED DOES NOT EXIST")</script>';
                            
                                }
                                }else{
                                    echo '<script> alert("PREVIOUS UPDATE FAILED! INVALID RENTAL ID ENTERED")</script>';
                                    }   
                                
                        }else{
                            echo '<script> alert("PREVIOUS UPDATE FAILED! ALL FIELDS ARE MANDATORY TO BE FILLED EXCEPT FOR RETURN DATE")</script>';
                        }
                    }
                    ?>

                </form>
            </div>
        </div>

        <div class = "delete">
            <div class = "popupcontent">
                <div class = "deletedown" id="close">+</div>
                <form action= "" method = "post">
                    <p>Rental ID:</p>
                        <input type="text" name="rentalid" onkeydown="return event.key != 'Enter'" style= "display:block">
                        <input type= "submit" name= "delete" class= "greenbutton" value ="DELETE" onclick="return confirm('ARE YOU SURE TO DELETE THIS ROW?')">
                </form>
            </div>

            <?php
                if(isset($_POST['delete'])){
                    if(!empty($_POST['rentalid'])){
                        if((is_numeric($_POST['rentalid'])) &&$_POST['rentalid'] > 0){
                        $rentalid= $_POST['rentalid'];
                        $query= "SELECT rental_id FROM rental WHERE rental_id = $rentalid;";
                        $result= mysqli_query($conn,$query);
                            
                        if(mysqli_num_rows($result)==1){
                            $rentalid= $_POST['rentalid'];
                            $delete = "DELETE FROM rental WHERE rental_id= '$rentalid'; ";
                            $result = mysqli_query($conn,$delete);
                                
                            if($result){
                                echo '<script> alert("ROW DELETED SUCCESSFULLY!")</script>';
                            }else{
                                echo '<script> alert("DELETE FAILED! YOU ARE NOT ALLOWED TO DELETE THIS ROW")</script>';
                            }
                                
                            echo("<meta http-equiv='refresh' content='1'>");
                        }else{
                            echo '<script> alert("PREVIOUS DELETE FAILED! RENTAL ID ENTERED DOES NOT EXIST")</script>';
                        }
                    }else{
                        echo '<script> alert("PREVIOUS DELETE FAILED! INVALID RENTAL ID ENTERED")</script>';
                    }
                                
                    }else{
                        echo '<script> alert("PREVIOUS DELETE FAILED! PLEASE FILL ALL FIELDS")</script>';
                    }
                }
            ?>
        </div>

        <script>
            document.getElementById('insert').addEventListener('click',
            function(){
                document.querySelector('.insert').style.display= 'flex';
            }
            );
            document.querySelector('.insertdown').addEventListener('click',
            function(){
                document.querySelector('.insert').style.display= 'none';
            });

            document.getElementById('update').addEventListener('click',
            function(){
                document.querySelector('.update').style.display= 'flex';
            }
            );
            document.querySelector('.updatedown').addEventListener('click',
            function(){
                document.querySelector('.update').style.display= 'none';
            });

            
            document.getElementById('delete').addEventListener('click',
            function(){
                document.querySelector('.delete').style.display= 'flex';
            }
            );
            document.querySelector('.deletedown').addEventListener('click',
            function(){
                document.querySelector('.delete').style.display= 'none';
            });
            function openNav() {
                document.getElementById("mySidenav").style.width = "620px";
            }

            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
            }
        </script>
    </body>
</html>