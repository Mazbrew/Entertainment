<?php
    include_once "includes/connection.php";

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Address</title>
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
            echo "<table><thead><tr><th>Address_id</th><th>Address</th><th>District</th><th>City_id</th><th>Postal_code</th><th>Phone</th><th>Last_update</th></thead><tbody>"; 
            if (isset($_POST['search'])){
                
                $search = $_POST['search'];
            
                $query = "SELECT * FROM address WHERE address_id LIKE '%$search%' ;";    
                $result = mysqli_query($conn,$query);

                if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){   
                        echo "<tr><td>" . $row['address_id'] . "</td><td>" . $row['address'] . "</td><td>" . $row['district'] . "</td><td>" . $row['city_id'] . "</td><td>" . $row['postal_code'] . "</td><td>" . $row['phone'] . "</td><td>" . $row['last_update'] . "</td></tr>";
                    }
                }else{
                    echo "<tr><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td></tr>";
                }

            }elseif(isset($_POST['reset'])){
                $query = "SELECT * FROM address;";
                $result = mysqli_query($conn,$query);

                while($row = mysqli_fetch_assoc($result)){   
                    echo "<tr><td>" . $row['address_id'] . "</td><td>" . $row['address'] . "</td><td>" . $row['district'] . "</td><td>" . $row['city_id'] . "</td><td>" . $row['postal_code'] . "</td><td>" . $row['phone'] . "</td><td>" . $row['last_update'] . "</td></tr>";
                }

            }else {
                $query = "SELECT * FROM address;";
                $result = mysqli_query($conn,$query);

                while($row = mysqli_fetch_assoc($result)){   
                    echo "<tr><td>" . $row['address_id'] . "</td><td>" . $row['address'] . "</td><td>" . $row['district'] . "</td><td>" . $row['city_id'] . "</td><td>" . $row['postal_code'] . "</td><td>" . $row['phone'] . "</td><td>" . $row['last_update'] . "</td></tr>";  
                }
    
            } 
            echo "</tbody></table>";
        ?>

        <div class = "insert">
            <div class = "popupcontent">
                <div class = "insertdown" id="close">+</div>
                <form action= "" method = "post">
                    <p>Address ID:</p>
                        <input type="text" name="addressid" onkeydown="return event.key != 'Enter'">
                    <p>Address:</p>
                        <input type="text" name="address" onkeydown="return event.key != 'Enter'">
                    <p>District:</p>
                        <input type="text" name="district" onkeydown="return event.key != 'Enter'">
                    <p>City ID:</p>
                        <input type="text" name="cityid" onkeydown="return event.key != 'Enter'">
                    <p>Postal Code:</p>
                        <input type="text" name="postalcode" onkeydown="return event.key != 'Enter'">
                    <p>Phone:</p>
                        <input type="text" name="phone" style = "display:block;" onkeydown="return event.key != 'Enter'">
                    <input type= "submit" name= "insert" class= "greenbutton" value ="INSERT">

                    <?php
                    if(isset($_POST['insert'])){
                        if(!empty($_POST['addressid'])&& !empty($_POST['address'])&& !empty($_POST['district'])&& !empty($_POST['cityid'])&& !empty($_POST['postalcode'])&& !empty($_POST['phone'])){
                            $addressid= $_POST['addressid'];
                            $query= "SELECT address_id FROM address WHERE address_id = $addressid;";
                            $result= mysqli_query($conn,$query);

                            if(mysqli_num_rows($result)==0){
                                $addressid= $_POST['addressid'];
                                $address= $_POST['address'];
                                $district= $_POST['district'];
                                $cityid= $_POST['cityid'];
                                $postalcode= $_POST['postalcode'];
                                $phone = $_POST['phone'];
                                $lastupdate= date('Y-m-d H:i:s');
                                $insert = "INSERT INTO address VALUES('$addressid','$address','$district','$cityid','$postalcode','$phone','$lastupdate');";
                                $result = mysqli_query($conn,$insert);
                                if ($result) {
                                    echo '<script> alert("DATA INSERTED SUCCESSFULLY!")</script>';
                                }
                                else
                                    echo '<script> alert("PREVIOUS INSERT FAILED! CHECK IF THERE WERE MISTAKES MADE WHEN INSERTING")</script>'; 
                                
                                echo("<meta http-equiv='refresh' content='1'>");
                            }else{
                                echo '<script> alert("PREVIOUS INSERT FAILED! CHECK IF THERE WERE MISTAKES MADE WHEN INSERTING")</script>';
                            }
                                
                        }else{
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
                    <p>Address ID:</p>
                        <input type="text" name="addressid" onkeydown="return event.key != 'Enter'">
                    <p>Address:</p>
                        <input type="text" name="address" onkeydown="return event.key != 'Enter'">
                    <p>District:</p>
                        <input type="text" name="district" onkeydown="return event.key != 'Enter'">
                    <p>City ID:</p>
                        <input type="text" name="cityid" onkeydown="return event.key != 'Enter'">
                    <p>Postal Code:</p>
                        <input type="text" name="postalcode" onkeydown="return event.key != 'Enter'">
                    <p>Phone:</p>
                        <input type="text" name="phone" style = "display:block;" onkeydown="return event.key != 'Enter'">
                    <input type= "submit" name= "update" class= "greenbutton" value ="UPDATE">

                    <?php
                    if(isset($_POST['update'])){
                        if(!empty($_POST['addressid'])&& !empty($_POST['address'])&& !empty($_POST['district'])&& !empty($_POST['cityid'])&& !empty($_POST['postalcode'])&& !empty($_POST['phone'])){
                            $addressid= $_POST['addressid'];
                            $query= "SELECT address_id FROM address WHERE address_id = $addressid;";
                            $result= mysqli_query($conn,$query);

                            if(mysqli_num_rows($result)==1){
                                $addressid= $_POST['addressid'];
                                $address= $_POST['address'];
                                $district= $_POST['district'];
                                $cityid= $_POST['cityid'];
                                $postalcode= $_POST['postalcode'];
                                $phone = $_POST['phone'];
                                $lastupdate= date('Y-m-d H:i:s');
                                $update = "UPDATE address SET address='$address',district='$district',city_id='$cityid',postal_code='$postalcode',phone='$phone',last_update='$lastupdate' WHERE address_id='$addressid';";
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
                    <p>Address ID:</p>
                        <input type="text" name="addressid" onkeydown="return event.key != 'Enter'" style= "display:block">
                    <input type= "submit" name= "delete" class= "greenbutton" value ="DELETE">
                </form>
            </div>

            <?php
                    if(isset($_POST['delete'])){
                        if(!empty($_POST['addressid'])){
                            $addressid= $_POST['addressid'];
                            $query= "SELECT address_id FROM address WHERE address_id = $addressid;";
                            $result= mysqli_query($conn,$query);

                            if(mysqli_num_rows($result)==1){
                                $delete = "DELETE FROM address WHERE address_id='$addressid';";
                                $result = mysqli_query($conn,$delete);  
                                
                                echo("<meta http-equiv='refresh' content='1'>");
                            }else{
                                echo '<script> alert("PREVIOUS DELETE FAILED! YOU ARE NOT ALLOWED TO DELETE THIS ROW")</script>';
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