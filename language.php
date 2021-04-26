<?php
    include_once "includes/connection.php";

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Language</title>
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
            echo "<table><thead><tr><th>Language_id</th><th>Name</th><th>Last_update</th></thead><tbody>"; 
            if (isset($_POST['search'])){
                
                $search = $_POST['search'];
            
                $query = "SELECT * FROM language WHERE language_id LIKE '%$search%' ;";    
                $result = mysqli_query($conn,$query);

                if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){   
                        echo "<tr><td>" . $row['language_id'] . "</td><td>" . $row['name'] . "</td><td>" . $row['last_update'] . "</td></tr>";  
                    }
                }else{
                    echo "<tr><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA--  </td></tr>";
                }

            }elseif(isset($_POST['reset'])){
                $query = "SELECT * FROM language;";
                $result = mysqli_query($conn,$query);

                while($row = mysqli_fetch_assoc($result)){   
                    echo "<tr><td>" . $row['language_id'] . "</td><td>" . $row['name'] . "</td><td>" . $row['last_update'] . "</td></tr>";  
                }

            }else {
                $query = "SELECT * FROM language;";
                $result = mysqli_query($conn,$query);

                while($row = mysqli_fetch_assoc($result)){   
                    echo "<tr><td>" . $row['language_id'] . "</td><td>" . $row['name'] . "</td><td>" . $row['last_update'] . "</td></tr>";   
                }
    
            } 
            echo "</tbody></table>";
        ?>

        <div class = "insert">
            <div class = "popupcontent">
                <div class = "insertdown" id="close">+</div>
                <form action= "" method = "post">
                    <p>Language ID:</p>
                        <input type="text" name="languageid" onkeydown="return event.key != 'Enter'">
                    <p>Name:</p>
                        <input type="text" name="name" style="display:block;" onkeydown="return event.key != 'Enter'">
                    <input type= "submit" name= "insert" class= "greenbutton" value ="INSERT">

                    <?php
                    if(isset($_POST['insert'])){
                        if(!empty($_POST['languageid'])&& !empty($_POST['name'])){
                        $languageid= $_POST['languageid'];
                        $query= "SELECT language_id FROM language WHERE language_id = $languageid;";
                        $result= mysqli_query($conn,$query);

                            if(mysqli_num_rows($result)==0){
                                $languageid= $_POST['languageid'];
                                $name= $_POST['name'];
                                $lastupdate= date('Y-m-d H:i:s');
                                $insert = "INSERT INTO language VALUES('$languageid','$name','$lastupdate');";
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
                    <p>Language ID:</p>
                        <input type="text" name="languageid" onkeydown="return event.key != 'Enter'">
                    <p>Name:</p>
                        <input type="text" name="name" style="display:block;" onkeydown="return event.key != 'Enter'">
                    <input type= "submit" name= "update" class= "greenbutton" value ="UPDATE">

                    <?php
                    if(isset($_POST['update'])){
                        if(!empty($_POST['languageid'])&& !empty($_POST['name'])){
                            $languageid= $_POST['languageid'];
                            $query= "SELECT language_id FROM language WHERE language_id = $languageid;";
                            $result= mysqli_query($conn,$query);

                            if(mysqli_num_rows($result)==1){
                                $languageid= $_POST['languageid'];
                                $name= $_POST['name'];
                                $lastupdate= date('Y-m-d H:i:s');
                                $update = "UPDATE language SET name= '$name',last_update= '$lastupdate' WHERE language_id = $languageid;";
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
                    <p>Language ID:</p>
                        <input type="text" name="languageid" onkeydown="return event.key != 'Enter'" style= "display:block">
                    <input type= "submit" name= "delete" class= "greenbutton" value ="DELETE">
                </form>
            </div>

            <?php
                if(isset($_POST['delete'])){
                    if(!empty($_POST['languageid'])){
                        $languageid= $_POST['languageid'];
                        $query= "SELECT language_id FROM language WHERE language_id = $languageid;";
                        $result= mysqli_query($conn,$query);

                        if(mysqli_num_rows($result)==1){
                            $languageid= $_POST['languageid'];
                            $delete = "DELETE FROM language WHERE language_id= '$languageid'; ";
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