<?php
    include_once "includes/connection.php";

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Country Join City Join Address</title>
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
                <input type ="text" name= "search" placeholder="SEARCH BY COUNTRY NAME" size="30" style= "border-radius: 5px;">
            </form>
            <form action= "" method= "POST" style= 'display: inline;'>
                <input type = "submit" name= "reset" value= "RESET" class="button"> 
            </form>
        </div>

        <?php
            echo "<table><thead><tr><th>Country</th><th>City</th><th>Postal Code</th></thead><tbody>"; 
            if (isset($_POST['search'])){
                
                $search = $_POST['search'];
        
                $query = "SELECT country, city, postal_code FROM country LEFT JOIN city ON country.country_id = city.country_id LEFT JOIN address ON city.city_id = address.city_id WHERE country LIKE '%$search%' ;";    
                $result = mysqli_query($conn,$query);

                if (mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){   
                        echo "<tr><td>" . $row['country'] . "</td><td>" . $row['city'] . "</td><td>" . $row['postal_code'] . "</td></tr>"; 
                    }
                }else{
                    echo "<tr><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td></tr>";
                }

            }elseif(isset($_POST['reset'])){
                $query = "SELECT country, city, postal_code FROM country LEFT JOIN city ON country.country_id = city.country_id LEFT JOIN address ON city.city_id = address.city_id ORDER BY country ASC;";
                $result = mysqli_query($conn,$query);

                while($row = mysqli_fetch_assoc($result)){   
                    echo "<tr><td>" . $row['country'] . "</td><td>" . $row['city'] . "</td><td>" . $row['postal_code'] . "</td></tr>"; 
                }

            }else {
                $query = "SELECT country, city, postal_code FROM country LEFT JOIN city ON country.country_id = city.country_id LEFT JOIN address ON city.city_id = address.city_id ORDER BY country ASC;";
                $result = mysqli_query($conn,$query);

                while($row = mysqli_fetch_assoc($result)){   
                    echo "<tr><td>" . $row['country'] . "</td><td>" . $row['city'] . "</td><td>" . $row['postal_code'] . "</td></tr>";    
                }
            } 
            echo "</tbody></table>";
        ?>
        
        <script>
            function openNav() {
                document.getElementById("mySidenav").style.width = "620px";
            }

            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
            }
        </script>
    </body>
</html>