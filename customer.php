<?php
    include_once "includes/connection.php";

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Customer</title>
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
                <input type ="text" name= "search" placeholder="SEARCH BY CUSTOMER ID" size="30" style= "border-radius: 5px;">
            </form>
            <form action= "" method= "POST" style= 'display: inline;'>
                <input type = "submit" name= "reset" value= "RESET" class="button"> 
            </form>
            <button id="insert" class= "button">INSERT</button>
            <button id="update" class= "button">UPDATE</button>
            <button id="delete" class= "button">DELETE</button>
        </div>

        <?php
            echo "<table><thead><tr><th>Customer_id</th><th>Store_id</th><th>First_name</th><th>Last_name</th><th>Email</th><th>Address_id</th><th>Active</th><th>Create_date</th><th>Last_update</th></thead><tbody>"; 
            if (isset($_POST['search'])){
                
                $search = $_POST['search'];
            
                $query = "SELECT * FROM customer WHERE customer_id LIKE '%$search%' ;";    
                $result = mysqli_query($conn,$query);

                if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){   
                        echo "<tr><td>" . $row['customer_id'] . "</td><td>" . $row['store_id'] . "</td><td>" . $row['first_name'] . "</td><td>" . $row['last_name'] . "</td><td>" . $row['email'] . "</td><td>" . $row['address_id'] . "</td><td>" . $row['active'] . "</td><td>" . $row['create_date'] . "</td><td>" . $row['last_update'] . "</td></tr>";
                    }
                }else{
                    echo "<tr><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td></tr>";
                }

            }elseif(isset($_POST['reset'])){
                $query = "SELECT * FROM customer;";
                $result = mysqli_query($conn,$query);

                while($row = mysqli_fetch_assoc($result)){   
                    echo "<tr><td>" . $row['customer_id'] . "</td><td>" . $row['store_id'] . "</td><td>" . $row['first_name'] . "</td><td>" . $row['last_name'] . "</td><td>" . $row['email'] . "</td><td>" . $row['address_id'] . "</td><td>" . $row['active'] . "</td><td>" . $row['create_date'] . "</td><td>" . $row['last_update'] . "</td></tr>";
                }

            }else {
                $query = "SELECT * FROM customer;";
                $result = mysqli_query($conn,$query);

                while($row = mysqli_fetch_assoc($result)){   
                    echo "<tr><td>" . $row['customer_id'] . "</td><td>" . $row['store_id'] . "</td><td>" . $row['first_name'] . "</td><td>" . $row['last_name'] . "</td><td>" . $row['email'] . "</td><td>" . $row['address_id'] . "</td><td>" . $row['active'] . "</td><td>" . $row['create_date'] . "</td><td>" . $row['last_update'] . "</td></tr>";
                }
    
            } 
            echo "</tbody></table>";
        ?>

        <div class = "insert">
            <div class = "popupcontent">
                <div class = "insertdown" id="close">+</div>
                <form action= "" method = "post">
                    <p>Customer ID:</p>
                        <input type="text" name="customerid" onkeydown="return event.key != 'Enter'">
                    <p>Store ID:</p>
                        <input type="text" name="storeid" onkeydown="return event.key != 'Enter'">
                    <p>First name:</p>
                        <input type="text" name="firstname" onkeydown="return event.key != 'Enter'">
                    <p>Last name:</p>
                        <input type="text" name="lastname" onkeydown="return event.key != 'Enter'">
                    <p>Email:</p>
                        <input type="text" name="email" onkeydown="return event.key != 'Enter'">
                    <p>Address id:</p>
                        <input type="text" name="addressid" onkeydown="return event.key != 'Enter'">
                    <p>Active:</p>
                        <input type="text" name="active" style = "display:block;" onkeydown="return event.key != 'Enter'">
                    <input type= "submit" name= "insert" class= "greenbutton" value ="INSERT">

                    <?php
                    if(isset($_POST['insert'])){
                        if(!empty($_POST['customerid'])&& !empty($_POST['storeid'])&& !empty($_POST['firstname'])&& !empty($_POST['lastname'])&& !empty($_POST['email'])&& !empty($_POST['addressid'])&& ($_POST['active']==1 || $_POST['active']==0)){
                            if((is_numeric($_POST['customerid'])) && ($_POST['customerid'] > 0)){
                                $customerid= $_POST['customerid'];
                                $query= "SELECT customer_id FROM customer WHERE customer_id = $customerid;";
                                $result= mysqli_query($conn,$query);
                            
                                if(mysqli_num_rows($result)==0){
                                    $customerid= $_POST['customerid'];
                                    $storeid= $_POST['storeid'];
                                    $firstname= $_POST['firstname'];
                                    $lastname= $_POST['lastname'];
                                    $email= $_POST['email'];
                                    $addressid= $_POST['addressid'];
                                    $active= $_POST['active'];
                                    $createdate= date('Y-m-d H:i:s');
                                    $firstname= strtoupper($firstname);
                                    $lastname= strtoupper($lastname);
                                    $insert = "INSERT INTO customer VALUES('$customerid','$storeid','$firstname','$lastname','$email','$addressid','$active','$createdate','$createdate');";
                                    $result = mysqli_query($conn,$insert);
                                    if ($result) {
                                        echo '<script> alert("DATA INSERTED SUCCESSFULLY!")</script>';
                                    }
                                    else
                                        echo '<script> alert("PREVIOUS INSERT FAILED! STORE ID OR ADDRESS ID ENTERED DOES NOT EXIST, PLEASE CHECK THE STORE AND ADDRESS TABLES FOR AN EXISTING STORE ID AND ADDRESS ID RESPECTIVELY")</script>';
                                
                                    echo("<meta http-equiv='refresh' content='1'>");
                                }else{
                                    echo '<script> alert("PREVIOUS INSERT FAILED! CUSTOMER ID ENTERED ALREADY EXISTS")</script>';
                                }
                            }else{
                                echo '<script> alert("PREVIOUS INSERT FAILED! INVALID CUSTOMER ID ENTERED")</script>';
                            }
                        }else{
                            echo '<script> alert("PREVIOUS INSERT FAILED! PLEASE FILL ALL FIELDS AND MAKE SURE ACTIVE HOLDS EITHER 0 OR 1")</script>';
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
                    <p>Customer ID:</p>
                        <input type="text" name="customerid" onkeydown="return event.key != 'Enter'">
                    <p>Store ID:</p>
                        <input type="text" name="storeid" onkeydown="return event.key != 'Enter'">
                    <p>First name:</p>
                        <input type="text" name="firstname" onkeydown="return event.key != 'Enter'">
                    <p>Last name:</p>
                        <input type="text" name="lastname" onkeydown="return event.key != 'Enter'">
                    <p>Email:</p>
                        <input type="text" name="email" onkeydown="return event.key != 'Enter'">
                    <p>Address id:</p>
                        <input type="text" name="addressid" onkeydown="return event.key != 'Enter'">
                    <p>Active:</p>
                        <input type="text" name="active" style = "display:block;" onkeydown="return event.key != 'Enter'">
                    <input type= "submit" name= "update" class= "greenbutton" value ="UPDATE">

                    <?php
                    if(isset($_POST['update'])){
                        if(!empty($_POST['customerid'])&& !empty($_POST['storeid'])&& !empty($_POST['firstname'])&& !empty($_POST['lastname'])&& !empty($_POST['email'])&& !empty($_POST['addressid'])&& ($_POST['active']==1 || $_POST['active']==0)){
                            if((is_numeric($_POST['customerid'])) && ($_POST['customerid'] > 0)){
                                $customerid= $_POST['customerid'];
                                $query= "SELECT customer_id FROM customer WHERE customer_id = $customerid;";
                                $result= mysqli_query($conn,$query);

                                if(mysqli_num_rows($result)==1){
                                    $customerid= $_POST['customerid'];
                                    $storeid= $_POST['storeid'];
                                    $firstname= $_POST['firstname'];
                                    $lastname= $_POST['lastname'];
                                    $email= $_POST['email'];
                                    $addressid= $_POST['addressid'];
                                    $active= $_POST['active'];
                                    $lastupdate= date('Y-m-d H:i:s');
                                    $firstname= strtoupper($firstname);
                                    $lastname= strtoupper($lastname);
                                    $update = "UPDATE customer SET store_id='$storeid',first_name='$firstname',last_name='$lastname',email='$email',address_id='$addressid',active='$active',last_update='$lastupdate' WHERE customer_id='$customerid';";
                                    $result = mysqli_query($conn,$update);
                                    if($result)
                                        echo '<script> alert("DATA UPDATED SUCCESSFULLY!")</script>';
                                    else
                                        echo '<script> alert("PREVIOUS UPDATE FAILED! STORE ID OR ADDRESS ID ENTERED DOES NOT EXIST, PLEASE CHECK THE STORE AND ADDRESS TABLES FOR AN EXISTING STORE ID AND ADDRESS ID RESPECTIVELY")</script>'; 
                                
                                    echo("<meta http-equiv='refresh' content='1'>");
                                }else{
                                    echo '<script> alert("PREVIOUS UPDATE FAILED! CUSTOMER ID ENTERED DOES NOT EXIST")</script>';
                                }   
                            }else{
                                echo '<script> alert("PREVIOUS UPDATE FAILED! INVALID CUSTOMER ID ENTERED")</script>';
                            }
                        }else{
                            echo '<script> alert("PREVIOUS UPDATE FAILED! PLEASE FILL ALL FIELDS AND MAKE SURE ACTIVE HOLDS EITHER 0 OR 1")</script>';
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
                    <p>Customer ID:</p>
                        <input type="text" name="customerid" onkeydown="return event.key != 'Enter'" style= "display:block">
                    <input type= "submit" name= "delete" class= "greenbutton" value ="DELETE" onclick="return confirm('ARE YOU SURE TO DELETE THIS ROW?')">
                </form>
            </div>

            <?php
                    if(isset($_POST['delete'])){
                        if(!empty($_POST['customerid'])){
                            if((is_numeric($_POST['customerid'])) && ($_POST['customerid'] > 0)){
                                $customerid= $_POST['customerid'];
                                $query= "SELECT customer_id FROM customer WHERE customer_id = $customerid;";
                                $result= mysqli_query($conn,$query);

                                if(mysqli_num_rows($result)==1){
                                    $customerid= $_POST['customerid'];
                                    $delete = "DELETE FROM customer WHERE customer_id='$customerid';";
                                    $result = mysqli_query($conn,$delete); 
                                    if($result){
                                        echo '<script> alert("ROW DELETED SUCCESSFULLY!")</script>';
                                    }else{
                                        echo '<script> alert("DELETE FAILED! YOU ARE NOT ALLOWED TO DELETE THIS ROW")</script>';
                                    } 
                                
                                    echo("<meta http-equiv='refresh' content='1'>");
                                }else{
                                    echo '<script> alert("PREVIOUS DELETE FAILED! CUSTOMER ID ENTERED DOES NOT EXIST")</script>';
                                }
                            }else{
                                echo '<script> alert("PREVIOUS DELETE FAILED! INVALID CUSTOMER ID ENTERED")</script>';
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