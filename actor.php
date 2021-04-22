<?php
    include_once "includes/connection.php";

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Actor</title>

        <style>
            header{
                text-align: center;
            }
            body{
                text-align: center;
            }

            table{
                margin-left: auto;
                margin-right: auto;
                border-collapse: collapse;
            }


            th{
                background-color: rgba(0, 0, 0, 0.1);
                text-align: left;
                position: sticky;
                top: 0;
            }

            td:nth-child(even){
                background-color: rgba(0, 0, 0, 0.1);
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

    <header>
        <h1>POWERPUFFGIRLS&BOYS</h1>
    </header>

    <body>
        <div>
            <form action= "" method= "POST" style= 'display: inline;'>
                <input type ="text" name= "search" placeholder="Search by ID">
                <input type = "submit" name= "reset" value= "RESET"> 
            </form>
            <button id="peekaboo">INSERT</button>
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
                echo "<table class = 'table'>"; 
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