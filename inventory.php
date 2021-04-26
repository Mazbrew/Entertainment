<?php
    include_once "includes/connection.php";

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Inventory</title>
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
            </form>
            <form action= "" method= "POST" style= 'display: inline;'>
                <input type = "submit" name= "reset" value= "RESET" class="button"> 
            </form>
            <button id="insert" class= "button">INSERT</button>
            <button id="update" class= "button">UPDATE</button>
            <button id="delete" class= "button">DELETE</button>
        </div>

        <?php
            echo "<table><thead><tr><th>Inventory_id</th><th>Film_id</th><th>Store_id</th><th>Last_update</th></thead><tbody>"; 
            if (isset($_POST['search'])){
                
                $search = $_POST['search'];
            
                $query = "SELECT * FROM inventory WHERE inventory_id LIKE '%$search%' ;";    
                $result = mysqli_query($conn,$query);

                if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){   
                        echo "<tr><td>" . $row['inventory_id'] . "</td><td>" . $row['film_id'] . "</td><td>" . $row['store_id'] . "</td><td>" . $row['last_update'] . "</td></tr>";  
                    }
                }else{
                    echo "<tr><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td></tr>";
                }

            }elseif(isset($_POST['reset'])){
                $query = "SELECT * FROM inventory;";
                $result = mysqli_query($conn,$query);

                while($row = mysqli_fetch_assoc($result)){   
                    echo "<tr><td>" . $row['inventory_id'] . "</td><td>" . $row['film_id'] . "</td><td>" . $row['store_id'] . "</td><td>" . $row['last_update'] . "</td></tr>"; 
                }

            }else {
                $query = "SELECT * FROM inventory;";
                $result = mysqli_query($conn,$query);

                while($row = mysqli_fetch_assoc($result)){   
                    echo "<tr><td>" . $row['inventory_id'] . "</td><td>" . $row['film_id'] . "</td><td>" . $row['store_id'] . "</td><td>" . $row['last_update'] . "</td></tr>";
                }
    
            } 
            echo "</tbody></table>";
        ?>

        <div class = "insert">
            <div class = "popupcontent">
                <div class = "insertdown" id="close">+</div>
                <form action= "" method = "post">
                    <p>Inventory ID:</p>
                        <input type="text" name="inventoryid" onkeydown="return event.key != 'Enter'">
                    <p>Film ID:</p>
                        <input type="text" name="filmid" onkeydown="return event.key != 'Enter'">
                    <p>Store ID:</p>
                        <input type="text" name="storeid" style="display:block;" onkeydown="return event.key != 'Enter'">
                    <input type= "submit" name= "insert" class= "greenbutton" value ="INSERT">

                    <?php
                    if(isset($_POST['insert'])){
                        if(!empty($_POST['inventoryid'])&& !empty($_POST['filmid'])&& !empty($_POST['storeid'])){
                            if($_POST['inventoryid'] > 0){
                                $inventoryid= $_POST['inventoryid'];
                                $query= "SELECT inventory_id FROM inventory WHERE inventory_id = $inventoryid;";
                                $result= mysqli_query($conn,$query);

                                if(mysqli_num_rows($result)==0){
                                    $inventoryid= $_POST['inventoryid'];
                                    $filmid= $_POST['filmid'];
                                    $storeid= $_POST['storeid'];
                                    $lastupdate= date('Y-m-d H:i:s');
                                    $insert = "INSERT INTO inventory VALUES('$inventoryid','$filmid','$storeid','$lastupdate');";
                                    $result = mysqli_query($conn,$insert);
                                if (!empty($result)) {
                                    echo '<script> alert("DATA INSERTED SUCCESSFULLY!")</script>';
                                }    
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
                    <p>Inventory ID:</p>
                        <input type="text" name="inventoryid" onkeydown="return event.key != 'Enter'">
                    <p>Film ID:</p>
                        <input type="text" name="filmid" onkeydown="return event.key != 'Enter'">
                    <p>Store ID:</p>
                        <input type="text" name="storeid" style="display:block;" onkeydown="return event.key != 'Enter'">
                    <input type= "submit" name= "update" class= "greenbutton" value ="UPDATE">

                    <?php
                    if(isset($_POST['update'])){
                        if(!empty($_POST['inventoryid'])&& !empty($_POST['filmid'])&& !empty($_POST['storeid'])){
                            $inventoryid= $_POST['inventoryid'];
                            $query= "SELECT inventory_id FROM inventory WHERE inventory_id = $inventoryid;";
                            $result= mysqli_query($conn,$query);

                            if(mysqli_num_rows($result)==1){
                                $inventoryid= $_POST['inventoryid'];
                                $filmid= $_POST['filmid'];
                                $storeid= $_POST['storeid'];
                                $lastupdate= date('Y-m-d H:i:s');
                                $update = "UPDATE inventory SET film_id= '$filmid', store_id= '$storeid', last_update= '$lastupdate' WHERE inventory_id = $inventoryid;";
                                $result = mysqli_query($conn,$update); 
                                echo '<script> alert("DATA UPDATED SUCCESSFULLY!")</script>';
                                
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
                    <p>Inventory ID:</p>
                        <input type="text" name="inventoryid" onkeydown="return event.key != 'Enter'" style= "display:block">
                    <input type= "submit" name= "delete" class= "greenbutton" value ="DELETE" onclick="return confirm('ARE YOU SURE TO DELETE THIS ROW?')">
                </form>
            </div>

            <?php
                if(isset($_POST['delete'])){
                    if(!empty($_POST['inventoryid'])){
                        $inventoryid= $_POST['inventoryid'];
                        $query= "SELECT inventory_id FROM inventory WHERE inventory_id = $inventoryid;";
                        $result= mysqli_query($conn,$query);

                        if(mysqli_num_rows($result)==1){
                            $inventoryid= $_POST['inventoryid'];
                            $delete = "DELETE FROM inventory WHERE inventory_id= '$inventoryid'; ";
                            $result = mysqli_query($conn,$delete); 
                            
                            if($result){
                                echo '<script> alert("ROW DELETED SUCCESSFULLY!")</script>';

                        }else{
                            echo '<script> alert("PREVIOUS DELETE FAILED! YOU ARE NOT ALLOWED TO DELETE THIS ROW")</script>';
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