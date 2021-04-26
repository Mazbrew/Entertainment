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
            <form action= "" method= "POST" style= 'display: inline;'>
                <input type ="text" name= "search" placeholder="SEARCH BY ID" style= "border-radius: 5px;">
                <input type = "submit" name= "reset" value= "RESET" class="button"> 
            </form>
            <button id="insert" class= "button">INSERT</button>
            <button id="update" class= "button">UPDATE</button>
            <button id="delete" class= "button">DELETE</button>
        </div>

        <?php
            echo "<table><thead><tr><th>Rental_id</th><th>Rental_date</th><th>Inventory_id</th><th>Customer_id</th>
            <th>Return_date</th><th>Staff_id</th><th>Last_update</th></thead><tbody>"; 
            if (isset($_POST['search'])){
                
                $search = $_POST['search'];
            
                $query = "SELECT * FROM rental WHERE rental_id LIKE '%$search%' ;";    
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
                $query = "SELECT * FROM rental;";
                $result = mysqli_query($conn,$query);

                while($row = mysqli_fetch_assoc($result)){   
                    echo "<tr><td>" . $row['rental_id'] . "</td><td>" . $row['rental_date'] . "</td><td>" . $row['inventory_id'] . "</td>
                    <td>" . $row['customer_id'] . "</td><td>" . $row['return_date'] . "</td><td>" . $row['staff_id'] . "</td><td>" . $row['last_update'] . "</td></tr>";  
                }

            }else {
                $query = "SELECT * FROM rental;";
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
                        <input type="text" name="rentaldate" onkeydown="return event.key != 'Enter'">
                    <p>Inventory ID:</p>
                        <input type="text" name="inventoryid" onkeydown="return event.key != 'Enter'">
                    <p>Customer ID:</p>
                        <input type="text" name="customerid" onkeydown="return event.key != 'Enter'">
                    <p>Return Date:</p>
                        <input type="text" name="returndate" onkeydown="return event.key != 'Enter'">
                    <p>Staff ID:</p>
                        <input type="text" name="staffid" style="display:block;" onkeydown="return event.key != 'Enter'">
                    <input type= "submit" name= "insert" class= "greenbutton" value ="INSERT">

                    <?php
                    if(isset($_POST['insert'])){
                        if(!empty($_POST['rentalid'])&& !empty($_POST['rentaldate'])&& !empty($_POST['inventoryid'])&& !empty($_POST['customerid'])
                        && !empty($_POST['returndate'])&& !empty($_POST['staffid'])){
                            if($_POST['rentalid'] > 0){
                                $rentalid= $_POST['rentalid'];
                                $query= "SELECT rental_id FROM rental WHERE rental_id = $rentalid;";
                                $result= mysqli_query($conn,$query);

                                if(mysqli_num_rows($result)==0){
                                    $rentalid= $_POST['rentalid'];
                                    $rentaldate= $_POST['rentaldate'];
                                    $inventoryid= $_POST['inventoryid'];
                                    $customerid= $_POST['customerid'];
                                    $returndate= $_POST['returndate'];
                                    $staffid= $_POST['staffid'];
                                    $lastupdate= date('Y-m-d H:i:s');
                                    $insert = "INSERT INTO rental VALUES('$rentalid','$rentaldate','$inventoryid','$customerid','$returndate','$staffid','$lastupdate');";
                                    $result = mysqli_query($conn,$insert);
                                    if ($result) {
                                        echo '<script> alert("DATA INSERTED SUCCESSFULLY!")</script>';
                                    }
                                    else
                                    echo '<script> alert("PREVIOUS INSERT FAILED! CHECK IF THERE WERE MISTAKES MADE WHEN INSERTING")</script>'; 

                                    echo("<meta http-equiv='refresh' content='1'>");
                                }
                                else{
                                    echo '<script> alert("PREVIOUS INSERT FAILED! CHECK IF THERE WERE MISTAKES MADE WHEN INSERTING")</script>';
                                }  
                            }
                            else{
                                echo '<script> alert("PREVIOUS INSERT FAILED! INVALID ID ENTERED")</script>';
                            }
                        } 
                        else{
                            echo '<script> alert("PREVIOUS INSERT FAILED, PLEASE FILL ALL FIELDS!")</script>';
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
                        <input type="text" name="rentaldate" onkeydown="return event.key != 'Enter'">
                    <p>Inventory ID:</p>
                        <input type="text" name="inventoryid" onkeydown="return event.key != 'Enter'">
                    <p>Customer ID:</p>
                        <input type="text" name="customerid" onkeydown="return event.key != 'Enter'">
                    <p>Return Date:</p>
                        <input type="text" name="returndate" onkeydown="return event.key != 'Enter'">
                    <p>Staff ID:</p>
                        <input type="text" name="staffid" style="display:block;" onkeydown="return event.key != 'Enter'">
                    <input type= "submit" name= "update" class= "greenbutton" value ="UPDATE">

                    <?php
                    if(isset($_POST['update'])){
                        if(!empty($_POST['rentalid'])&& !empty($_POST['rentaldate'])&& !empty($_POST['inventoryid'])&& !empty($_POST['customerid'])
                        && !empty($_POST['returndate'])&& !empty($_POST['staffid'])){
                            $rentalid= $_POST['rentalid'];
                            $query= "SELECT rental_id FROM rental WHERE rental_id = $rentalid;";
                            $result= mysqli_query($conn,$query);

                            if(mysqli_num_rows($result)==1){
                                $rentalid= $_POST['rentalid'];
                                $rentaldate= $_POST['rentaldate'];
                                $inventoryid= $_POST['inventoryid'];
                                $customerid= $_POST['customerid'];
                                $returndate= $_POST['returndate'];
                                $staffid= $_POST['staffid'];
                                $lastupdate= date('Y-m-d H:i:s');
                                $update = "UPDATE rental SET rental_date= '$rentaldate', inventory_id= '$inventoryid', customer_id = '$customerid', 
                                return_date= '$returndate', staff_id= '$staffid', last_update= '$lastupdate' WHERE rental_id = $rentalid;";
                                $result = mysqli_query($conn,$update); 
                                
                                if($result)
                                    echo '<script> alert("DATA UPDATED SUCCESSFULLY!")</script>';
                                else
                                    echo '<script> alert("PREVIOUS UPDATE FAILED! CHECK IF THERE WERE MISTAKES MADE WHEN UPDATING")</script>';
                                
                                echo("<meta http-equiv='refresh' content='1'>");
                            }else{
                                echo '<script> alert("PREVIOUS UPDATE FAILED! CHECK IF THERE WERE MISTAKES MADE WHEN UPDATING")</script>';
                            }
                                
                        }else{
                            echo '<script> alert("PREVIOUS UPDATE FAILED, PLEASE FILL ALL FIELDS!")</script>';
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
                    <input type= "submit" name= "delete" class= "greenbutton" value ="DELETE">
                </form>
            </div>

            <?php
                if(isset($_POST['delete'])){
                    if(!empty($_POST['rentalid'])){
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
                        }elseif (mysqli_num_rows($result)==0){
                            echo '<script> alert("PREVIOUS DELETE FAILED! INVALID ID ENTERED")</script>';
                        }
                                
                    }else{
                        echo '<script> alert("PREVIOUS DELETE FAILED, PLEASE FILL ALL FIELDS!")</script>';
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
        </script>
    </body>
</html>