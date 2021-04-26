 <?php
    include_once "includes/connection.php";

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Film_text</title>
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
            echo "<table><thead><tr><th>Film_id</th><th>Title</th><th>Description</th></thead><tbody>"; 
            if (isset($_POST['search'])){
                
                $search = $_POST['search'];
            
                $query = "SELECT * FROM film_text WHERE film_id LIKE '%$search%' ;";    
                $result = mysqli_query($conn,$query);

                if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){   
                        echo "<tr><td>" . $row['film_id'] . "</td><td>" . $row['title'] . "</td><td>" . $row['description'] . "</td></tr>";  
                    }
                }else{
                    echo "<tr><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td></tr>";
                }

            }elseif(isset($_POST['reset'])){
                $query = "SELECT * FROM film_text;";
                $result = mysqli_query($conn,$query);

                while($row = mysqli_fetch_assoc($result)){   
                   echo "<tr><td>" . $row['film_id'] . "</td><td>" . $row['title'] . "</td><td>" . $row['description'] . "</td></tr>";  
                }

            }else {
                $query = "SELECT * FROM film_text;";
                $result = mysqli_query($conn,$query);

                while($row = mysqli_fetch_assoc($result)){   
                    echo "<tr><td>" . $row['film_id'] . "</td><td>" . $row['title'] . "</td><td>" . $row['description'] . "</td></tr>";   
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
                    <p>Title:</p>
                        <input type="text" name="title" onkeydown="return event.key != 'Enter'">
                    <p>Description:</p>
                        <input type="text" name="description" style="display:block;" onkeydown="return event.key != 'Enter'">
                    <input type= "submit" name= "insert" class= "greenbutton" value ="INSERT">

                    <?php
                    if(isset($_POST['insert'])){
                        if(!empty($_POST['filmid'])&& !empty($_POST['title'])&& !empty($_POST['description'])){
                            if($_POST['filmid'] > 0){
                                $filmid= $_POST['filmid'];
                                $query= "SELECT film_id FROM film_text WHERE film_id = $filmid;";
                                $result= mysqli_query($conn,$query);

                            if(mysqli_num_rows($result)==0){
                                $filmid= $_POST['filmid'];
                                $title= strtoupper($_POST['title']);
                                $description= $_POST['description'];
                                $insert = "INSERT INTO film_text VALUES('$filmid','$title','$description');";
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
                    <p>Film ID:</p>
                        <input type="text" name="filmid" onkeydown="return event.key != 'Enter'">
                    <p>Title:</p>
                        <input type="text" name="title" onkeydown="return event.key != 'Enter'">
                    <p>Description:</p>
                        <input type="text" name="description" style="display:block;" onkeydown="return event.key != 'Enter'">
                    <input type= "submit" name= "update" class= "greenbutton" value ="UPDATE">

                    <?php
                    if(isset($_POST['update'])){
                        if(!empty($_POST['filmid'])&& !empty($_POST['title'])&& !empty($_POST['description'])){
                            $filmid= $_POST['filmid'];
                            $query= "SELECT film_id FROM film_text  WHERE film_id = $filmid;";
                            $result= mysqli_query($conn,$query);

                            if(mysqli_num_rows($result)==1){
                                $filmid= $_POST['filmid'];
                                $title= $_POST['title'];
                                $description= $_POST['description'];
                                $update = "UPDATE film_text SET title= '$title', description= '$description' WHERE film_id = $filmid;";
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
                    <p>Film ID:</p>
                        <input type="text" name="filmid" onkeydown="return event.key != 'Enter'" style= "display:block">
                    <input type= "submit" name= "delete" class= "greenbutton" value ="DELETE" onclick="return confirm('ARE YOU SURE TO DELETE THIS ROW?')">
                </form>
            </div>

            <?php
                if(isset($_POST['delete'])){
                    if(!empty($_POST['filmid'])){
                        $filmid= $_POST['filmid'];
                        $query= "SELECT film_id FROM film_text WHERE film_id = $filmid;";
                        $result= mysqli_query($conn,$query);

                        if(mysqli_num_rows($result)==1){
                            $filmid= $_POST['filmid'];
                            $delete = "DELETE FROM film_text WHERE film_id= '$filmid'; ";
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