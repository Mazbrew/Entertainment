 <?php
    include_once "includes/connection.php";

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Film</title>
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
                <input type ="text" name= "search" placeholder="SEARCH BY ID">
                <input type = "submit" name= "reset" value= "RESET" class="button"> 
            </form>
            <button id="insert" class= "button">INSERT</button>
            <button id="update" class= "button">UPDATE</button>
            <button id="delete" class= "button">DELETE</button>
        </div>

        <?php
            echo "<table><thead><tr><th>Film_id</th><th>Release_Year</th><th>Language_id</th><th>Rental_Duration</th><th>Rental_Rate</th><th>Length</th><th>Replacement_Cost</th><th>Rating</th><th>Special_Features</th><th>Last_Update</th></thead><tbody>"; 
            if (isset($_POST['search'])){
                
                $search = $_POST['search'];
            
                $query = "SELECT * FROM film WHERE film_id LIKE '%$search%' ;";    
                $result = mysqli_query($conn,$query);

                if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){   
                        echo "<tr><td>" . $row['film_id'] . "</td><td>" . $row['release_year'] . "</td><td>" . $row['language_id'] . "</td><td>" . $row['rental_duration'] . "</td><td>" . $row['rental_rate'] . "</td><td>" . $row['length'] . "</td><td>" . $row['replacement_cost'] . "</td><td>" . $row['rating'] . "</td><td>" . $row['special_features'] . "</td><td>" . $row['last_update'] . "</td></tr>";  
                    }
                }else{
                    echo "<tr><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td></tr>";
                }

            }elseif(isset($_POST['reset'])){
                $query = "SELECT * FROM film;";
                $result = mysqli_query($conn,$query);

                while($row = mysqli_fetch_assoc($result)){   
                        echo "<tr><td>" . $row['film_id'] . "</td><td>" . $row['release_year'] . "</td><td>" . $row['language_id'] . "</td><td>" . $row['rental_duration'] . "</td><td>" . $row['rental_rate'] . "</td><td>" . $row['length'] . "</td><td>" . $row['replacement_cost'] . "</td><td>" . $row['rating'] . "</td><td>" . $row['special_features'] . "</td><td>" . $row['last_update'] . "</td></tr>"; 
                }

            }else {
                $query = "SELECT * FROM film;";
                $result = mysqli_query($conn,$query);

                while($row = mysqli_fetch_assoc($result)){   
                        echo "<tr><td>" . $row['film_id'] . "</td><td>" . $row['release_year'] . "</td><td>" . $row['language_id'] . "</td><td>" . $row['rental_duration'] . "</td><td>" . $row['rental_rate'] . "</td><td>" . $row['length'] . "</td><td>" . $row['replacement_cost'] . "</td><td>" . $row['rating'] . "</td><td>" . $row['special_features'] . "</td><td>" . $row['last_update'] . "</td></tr>"; 
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
                    <p>Release Year:</p>
                        <input type="text" name="releaseyear" onkeydown="return event.key != 'Enter'">
                    <p>Language ID:</p>
                        <input type="text" name="languageid" onkeydown="return event.key != 'Enter'">
                    <p>Rental Duration:</p>
                        <input type="text" name="rentalduration" onkeydown="return event.key != 'Enter'">
                    <p>Rental Rate:</p>
                        <input type="text" name="rentalrate" onkeydown="return event.key != 'Enter'">
                    <p>Length:</p>
                        <input type="text" name="length" onkeydown="return event.key != 'Enter'">
                    <p>Replacement Cost:</p>
                        <input type="text" name="replacementcost" onkeydown="return event.key != 'Enter'">
                    <p>Rating:</p>
                        <input type="text" name="rating" onkeydown="return event.key != 'Enter'">
                    <p>Special Features:</p>
                        <input type="text" name="specialfeatures" style="display:block;"  onkeydown="return event.key != 'Enter'">
                    <p>Last Update:</p>
                        <input type="text" name="lastupdate" style="display:block;"  onkeydown="return event.key != 'Enter'">                    
                    <input type= "submit" name= "insert" class= "greenbutton" value ="INSERT">

                    <?php
                    if(isset($_POST['insert'])){
                        if(!empty($_POST['filmid'])&& !empty($_POST['releaseyear'])&& !empty($_POST['languageid'])&& !empty($_POST['rentalduration'])&& !empty($_POST['rentalrate'])&& !empty($_POST['length'])&& !empty($_POST['replacementcost'])&& !empty($_POST['rating'])&& !empty($_POST['specialfeatures'])&& !empty($_POST['lastupdate'])){
                        $filmid= $_POST['filmid'];
                        $query= "SELECT film_id FROM film WHERE film_id = $filmid;";
                        $result= mysqli_query($conn,$query);

                            if(mysqli_num_rows($result)==0){
                                $filmid= $_POST['filmid'];
                                $releaseyear= $_POST['releaseyear'];
                                $languageid= $_POST['languageid'];
                                $rentalduration= $_POST['rentalduration'];
                                $rentalrate= $_POST['rentalrate'];
                                $length= $_POST['length'];
                                $replacementcost= $_POST['replacementcost'];
                                $rating= $_POST['rating'];
                                $specialfeatures= $_POST['specialfeatures'];
                                $lastupdate= date('Y-m-d H:i:s');
                                $insert = "INSERT INTO film VALUES('$filmid','$releaseyear','$languageid','$rentalduration','$rentalrate','$length','$replacementcost','$rating','$specialfeatures','$lastupdate');";
                                $result = mysqli_query($conn,$insert);
                                if (!empty($result)) {
                                    echo 'Data Inserted';
                                }    
                                echo("<meta http-equiv='refresh' content='1'>");
                            }
                            else{
                                echo '<script> alert("PREVIOUS INSERT FAILED! CHECK IF THERE WERE MISTAKES MADE WHEN INSERTING")</script>';
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
                    <p>Film ID:</p>
                        <input type="text" name="filmid" onkeydown="return event.key != 'Enter'">
                    <p>Release Year:</p>
                        <input type="text" name="releaseyear" onkeydown="return event.key != 'Enter'">
                    <p>Language ID:</p>
                        <input type="text" name="languageid" onkeydown="return event.key != 'Enter'">
                    <p>Rental Duration:</p>
                        <input type="text" name="rentalduration" onkeydown="return event.key != 'Enter'">
                    <p>Rental Rate:</p>
                        <input type="text" name="rentalrate" onkeydown="return event.key != 'Enter'">
                    <p>Length:</p>
                        <input type="text" name="length" onkeydown="return event.key != 'Enter'">
                    <p>Replacement Cost:</p>
                        <input type="text" name="replacementcost" onkeydown="return event.key != 'Enter'">
                    <p>Rating:</p>
                        <input type="text" name="rating" onkeydown="return event.key != 'Enter'">
                    <p>Special Features:</p>
                        <input type="text" name="specialfeatures" style="display:block;"  onkeydown="return event.key != 'Enter'">
                    <input type= "submit" name= "update" class= "greenbutton" value ="UPDATE">

                    <?php
                    if(isset($_POST['update'])){
                        if(!empty($_POST['filmid'])&& !empty($_POST['releaseyear'])&& !empty($_POST['languageid'])&& !empty($_POST['rentalduration'])&& !empty($_POST['rentalrate'])&& !empty($_POST['length'])){
                            $filmid= $_POST['filmid'];
                            $query= "SELECT film_id FROM film WHERE film_id = $filmid;";
                            $result= mysqli_query($conn,$query);

                            if(mysqli_num_rows($result)==1){
                                $filmid= $_POST['filmid'];
                                $releaseyear= $_POST['releaseyear'];
                                $languageid= $_POST['languageid'];
                                $rentalduration= $_POST['rentalduration'];
                                $rentalrate= $_POST['rentalrate'];
                                $length= $_POST['length'];
                                $replacementcost= $_POST['replacementcost'];
                                $rating= $_POST['rating'];
                                $specialfeatures= $_POST['specialfeatures'];
                                $lastupdate= date('Y-m-d H:i:s');
                                $update = "UPDATE film SET release_year= '$releaseyear', language_id= '$languageid',rental_duration='$rentalduration',rental_rate='$rentalrate',length='$length',replacement_cost='$replacementcost',rating='$rating',special_features='$specialfeatures',last_update='$lastupdate' WHERE film_id = $filmid;";
                                $result = mysqli_query($conn,$update); 
                                
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
                    <p>Film ID:</p>
                        <input type="text" name="filmid" onkeydown="return event.key != 'Enter'" style= "display:block">
                    <input type= "submit" name= "delete" class= "greenbutton" value ="DELETE">
                </form>
            </div>

            <?php
                if(isset($_POST['delete'])){
                    if(!empty($_POST['filmid'])){
                        $filmid= $_POST['filmid'];
                        $query= "SELECT film_id FROM film WHERE film_id = $filmid;";
                        $result= mysqli_query($conn,$query);

                        if(mysqli_num_rows($result)==1){
                            $filmid= $_POST['filmid'];
                            $delete = "DELETE FROM film WHERE film_id= '$filmid'; ";
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
                