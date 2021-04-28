<?php
    include_once "includes/connection.php";

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Film_Category</title>
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
                <input type ="text" name= "search" placeholder="SEARCH BY FILM ID" size="30" style= "border-radius: 5px;">
            </form>
            <form action= "" method= "POST" style= 'display: inline;'>
                <input type = "submit" name= "reset" value= "RESET" class="button"> 
            </form>
            <button id="insert" class= "button">INSERT</button>
            <button id="update" class= "button">UPDATE</button>
            <button id="delete" class= "button">DELETE</button>
        </div>

        <?php
            echo "<table><thead><tr><th>Film_id</th><th>Category_id</th><th>Last_update</th></thead><tbody>"; 
            if (isset($_POST['search'])){
                
                $search = $_POST['search'];
            
                $query = "SELECT * FROM film_category WHERE film_id LIKE '%$search%' ;";    
                $result = mysqli_query($conn,$query);

                if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){   
                        echo "<tr><td>" . $row['film_id'] . "</td><td>" . $row['category_id'] . "</td><td>" . $row['last_update'] . "</td></tr>";   
                    }
                }else{
                    echo "<tr><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td></tr>";
                }

            }elseif(isset($_POST['reset'])){
                $query = "SELECT * FROM film_category;";
                $result = mysqli_query($conn,$query);

                while($row = mysqli_fetch_assoc($result)){   
                        echo "<tr><td>" . $row['film_id'] . "</td><td>" . $row['category_id'] . "</td><td>" . $row['last_update'] . "</td></tr>"; 
                }

            }else {
                $query = "SELECT * FROM film_category;";
                $result = mysqli_query($conn,$query);

                while($row = mysqli_fetch_assoc($result)){   
                        echo "<tr><td>" . $row['film_id'] . "</td><td>" . $row['category_id'] . "</td><td>" . $row['last_update'] . "</td></tr>";  
                }
    
            } 
            echo "</tbody></table>";
        ?>

        <div class = "insert">
            <div class = "popupcontent">
                <div class = "insertdown" id="close">+</div>
                <form action= "" method = "post">
                    <p>Film ID:</p>
                        <input type="text" name="filmid" onkeydown="return event.key != 'Enter'">
                    <p>Category ID:</p>
                        <input type="text" name="categoryid" style="display:block;" onkeydown="return event.key != 'Enter'">
                    <input type= "submit" name= "insert" class= "greenbutton" value ="INSERT">

                    <?php
                    if(isset($_POST['insert'])){
                        if(!empty($_POST['filmid'])&& !empty($_POST['categoryid'])){
                            if((is_numeric($_POST['filmid'])) && ($_POST['filmid'] > 0)){
                                $filmid= $_POST['filmid'];
                                $query= "SELECT film_id FROM film_category WHERE film_id = $filmid;";
                                $result= mysqli_query($conn,$query);

                                if(mysqli_num_rows($result)==0){
                                    $filmid= $_POST['filmid'];
                                    $categoryid= $_POST['categoryid'];
                                    $lastupdate= date('Y-m-d H:i:s');
                                    $insert = "INSERT INTO film_category VALUES('$filmid','$categoryid','$lastupdate');";
                                    $result = mysqli_query($conn,$insert);
                                if ($result) {
                                    echo '<script> alert("DATA INSERTED SUCCESSFULLY!")</script>';
                                }
                                else
                                    echo '<script> alert("PREVIOUS INSERT FAILED! FILM ID OR CATEGORY ID ENTERED DOES NOT EXIST, PLEASE CHECK THE FILM AND CATEGORY TABLES FOR AN EXISTING FILM ID AND CATEGORY ID RESPECTIVELY")</script>';    
                                echo("<meta http-equiv='refresh' content='1'>");
                            }
                            else{
                                echo '<script> alert("PREVIOUS INSERT FAILED! FILM ID ENTERED ALREADY EXISTS")</script>';
                            }
                                
                        } 
                         else{
                                echo '<script> alert("PREVIOUS INSERT FAILED! INVALID FILM ID ENTERED")</script>';
                            }
                        } 
                        else{
                            echo '<script> alert("PREVIOUS INSERT FAILED! PLEASE FILL ALL FIELDS")</script>';
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
                    <p>Film ID:</p>
                        <input type="text" name="filmid" onkeydown="return event.key != 'Enter'">
                    <p>Category ID:</p>
                        <input type="text" name="categoryid" style="display:block;" onkeydown="return event.key != 'Enter'">
                    <input type= "submit" name= "update" class= "greenbutton" value ="UPDATE">

                    <?php
                    if(isset($_POST['update'])){
                        if(!empty($_POST['filmid'])&& !empty($_POST['categoryid'])){
                            if((is_numeric($_POST['filmid'])) && ($_POST['filmid'] > 0)){
                                $filmid= $_POST['filmid'];
                                $query= "SELECT film_id FROM film_category WHERE film_id = $filmid;";
                                $result= mysqli_query($conn,$query);

                                if(mysqli_num_rows($result)==1){
                                    $filmid= $_POST['filmid'];
                                    $categoryid= $_POST['categoryid'];
                                    $lastupdate= date('Y-m-d H:i:s');
                                    $update = "UPDATE film_category SET  category_id= '$categoryid', last_update= '$lastupdate' WHERE film_id = $filmid;";
                                    $result = mysqli_query($conn,$update); 
                                    if($result)
                                        echo '<script> alert("DATA UPDATED SUCCESSFULLY!")</script>';
                                    else
                                        echo '<script> alert("PREVIOUS UPDATE FAILED! FILM ID OR CATEGORY ID ENTERED DOES NOT EXIST, PLEASE CHECK THE FILM AND CATEGORY TABLES FOR AN EXISTING FILM ID AND CATEGORY ID RESPECTIVELY")</script>';
                                
                                    echo("<meta http-equiv='refresh' content='1'>");
                                }else{
                                    echo '<script> alert("PREVIOUS UPDATE FAILED! FILM ID ENTERED DOES NOT EXIST")</script>';
                                }
                            }else{
                                echo '<script> alert("PREVIOUS UPDATE FAILED! INVALID FILM ID ENTERED")</script>';
                            }
                        }else{
                            echo '<script> alert("PREVIOUS UPDATE FAILED! PLEASE FILL ALL FIELDS")</script>';
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
                    <p>Film ID:</p>
                        <input type="text" name="filmid" onkeydown="return event.key != 'Enter'" style= "display:block">
                    <input type= "submit" name= "delete" class= "greenbutton" value ="DELETE" onclick="return confirm('ARE YOU SURE TO DELETE THIS ROW?')">
                </form>
            </div>

            <?php
                if(isset($_POST['delete'])){
                    if(!empty($_POST['filmid'])){
                        if((is_numeric($_POST['filmid'])) && ($_POST['filmid'] > 0)){
                            $filmid= $_POST['filmid'];
                            $query= "SELECT film_id FROM film_category WHERE film_id = $filmid;";
                            $result= mysqli_query($conn,$query);

                            if(mysqli_num_rows($result)==1){
                                $filmid= $_POST['filmid'];
                                $delete = "DELETE FROM film_category WHERE film_id= '$filmid'; ";
                                $result = mysqli_query($conn,$delete); 
                            
                                if($result){
                                    echo '<script> alert("ROW DELETED SUCCESSFULLY!")</script>';

                                }else{
                                    echo '<script> alert("PREVIOUS DELETE FAILED! YOU ARE NOT ALLOWED TO DELETE THIS ROW")</script>';
                                }
                                
                                echo("<meta http-equiv='refresh' content='1'>");
                            }elseif (mysqli_num_rows($result)==0){
                                echo '<script> alert("PREVIOUS DELETE FAILED! FILM ID ENTERED DOES NOT EXIST")</script>';
                            }
                        }else{
                            echo '<script> alert("PREVIOUS DELETE FAILED! INVALID FILM ID ENTERED")</script>';
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