<?php
    include_once "includes/connection.php";

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Actor</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

        <style>
            html{
                font-family: 'Roboto', sans-serif;
            }

            body{
                text-align: center;
                margin:0px 0px 0px 0px;
            }

            .header{
                text-align: center;
                background-color: rgba(1, 58, 103, 1);
                top: 0;
                width: 100%;
                color:white;
                font-size: 50px;
            }

            .bar{
                text-align: center;
                background-color: rgba(1, 58, 103, 1);
                margin: 0px 0px 0px 0px;
                border: none;
                top: 0;
                width: 100%;
                color:white;
                font-size: 50px;
            }

            .button{
                background-color: white;
                border: none;
                color: black;
                text-align: center;
                text-decoration: none;
                font-size: 16px;
            }

            .insertbutton{
                background-color: rgba(0, 176, 166, 1);
                border: none;
                color: white;
                text-align: center;
                text-decoration: none;
                font-size: 16px;
                margin: 10px;
            }

            table{
                margin-left: auto;
                margin-right: auto;
                border-collapse: collapse;
            }


            th{
                background-color: rgba(0, 176, 166, 1);
                text-align: center;
                position: sticky;
                top: 0;
                color: white;
            }

            td:nth-child(1){
                background-color: rgba(0, 176, 166, 0.1);
            }

            tbody tr td:hover{
                background-color: rgba(0, 176, 166, 1);
                color: white;
            }

            .popup{
                width: 100%;
                height: 100%;
                position: fixed;
                background-color: rgba(0, 0, 0, 0.7);
                justify-content: center;
                align-items: center;
                top: 0;
                left: 0;
                right: 0;
                display: none;

            }

            .popupcontent{
                width: 300px;
                height: 300px;
                position: absolute;
                background-color: rgba(255, 255, 255, 1);
                border-radius: 5px;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .popdown{
                position: absolute;
                margin: 0px 0px 0px 0px;
                top: 0;
                right: 10px;
                transform: rotate(45deg);
                font-size: 45px;
                cursor: pointer;
            }

        </style>        
    </head>

    <body>
        <div class="header">
            POWERPUFFGIRLS&BOYS
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

                while($row = mysqli_fetch_assoc($result)){   
                    echo "<tr><td>" . $row['actor_id'] . "</td><td>" . $row['first_name'] . "</td><td>" . $row['last_name'] . "</td><td>" . $row['last_update'] . "</td></tr>";  
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
                        <input type="text" name="actorid" >
                    <p>First Name:</p>
                        <input type="text" name="firstname">
                    <p>Last Name:</p>
                        <input type="text" name="lastname" style="display:block;">
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
            }
            );
        </script>
    </body>
</html>