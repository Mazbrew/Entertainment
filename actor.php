<?php
    include_once "includes/connection.php";

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Actor</title>
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
            <button id="peekaboo" class= "button">INSERT</button>
        </div>

        <?php
            echo "<table><thead><tr><th>Actor_id</th><th>First_name</th><th>Last_name</th><th>Last_update</th></thead><tbody>"; 
            if (isset($_POST['search'])){
                
                $search = $_POST['search'];
            
                $query = "SELECT * FROM actor WHERE actor_id LIKE '%$search%' ;";    
                $result = mysqli_query($conn,$query);

                if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){   
                        echo "<tr><td>" . $row['actor_id'] . "</td><td>" . $row['first_name'] . "</td><td>" . $row['last_name'] . "</td><td>" . $row['last_update'] . "</td></tr>";  
                    }
                }else{
                    echo "<tr><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td></tr>";
                }

            }elseif(isset($_POST['reset'])){
                $query = "SELECT * FROM actor;";
                $result = mysqli_query($conn,$query);

                while($row = mysqli_fetch_assoc($result)){   
                    echo "<tr><td>" . $row['actor_id'] . "</td><td>" . $row['first_name'] . "</td><td>" . $row['last_name'] . "</td><td>" . $row['last_update'] . "</td></tr>";  
                }

            }else {
                $query = "SELECT * FROM actor;";
                $result = mysqli_query($conn,$query);

                while($row = mysqli_fetch_assoc($result)){   
                    echo "<tr><td>" . $row['actor_id'] . "</td><td>" . $row['first_name'] . "</td><td>" . $row['last_name'] . "</td><td>" . $row['last_update'] . "</td></tr>";  
                }
    
            } 
            echo "</tbody></table>";
        ?>

        <div class = "popup">
            <div class = "popupcontent">
                <div class = "popdown" id="close">+</div>
                <form action= "" method = "post">
                    <p>Actor ID:</p>
                        <input type="text" name="actorid" onkeydown="return event.key != 'Enter'">
                    <p>First Name:</p>
                        <input type="text" name="firstname" onkeydown="return event.key != 'Enter'">
                    <p>Last Name:</p>
                        <input type="text" name="lastname" style="display:block;" onkeydown="return event.key != 'Enter'">
                    <input type= "submit" name= "insert" class= "insertbutton" value ="INSERT">
                </form>

                <?php
                    if(isset($_POST['insert'])){
                        $actorid= $_POST['actorid'];
                        $firstname= $_POST['firstname'];
                        $lastname= $_POST['lastname'];
                        $lastupdate= date('Y-m-d H:i:s');
                        $insert = "INSERT INTO actor VALUES('$actorid','$firstname','$lastname','$lastupdate');";
                        $result = mysqli_query($conn,$insert); 
                        
                        echo("<meta http-equiv='refresh' content='1'>");
                    }
                ?>

            <div>
        </div>

        <script>
            document.getElementById('peekaboo').addEventListener('click',
            function(){
                document.querySelector('.popup').style.display= 'flex';
            }
            );
            document.querySelector('.popdown').addEventListener('click',
            function(){
                document.querySelector('.popup').style.display= 'none';
            });
        </script>
    </body>
</html>