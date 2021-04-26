<?php
    include_once "includes/connection.php";

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Film Join Film_text Join Film_category Join Category Join Language</title>
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
                <input type ="text" name= "search" placeholder="SEARCH BY COUNTRY NAME" style= "border-radius: 5px;">
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
                $query = "SELECT country, city, postal_code FROM country LEFT JOIN city ON country.country_id = city.country_id LEFT JOIN address ON city.city_id = address.city_id GROUP BY postal_code ORDER BY country ASC;";
                $result = mysqli_query($conn,$query);

                while($row = mysqli_fetch_assoc($result)){   
                    echo "<tr><td>" . $row['country'] . "</td><td>" . $row['city'] . "</td><td>" . $row['postal_code'] . "</td></tr>"; 
                }

            }else {
                $query = "SELECT country, city, postal_code FROM country LEFT JOIN city ON country.country_id = city.country_id LEFT JOIN address ON city.city_id = address.city_id GROUP BY postal_code ORDER BY country ASC;";
                $result = mysqli_query($conn,$query);

                while($row = mysqli_fetch_assoc($result)){   
                    echo "<tr><td>" . $row['country'] . "</td><td>" . $row['city'] . "</td><td>" . $row['postal_code'] . "</td></tr>";    
                }
            } 
            echo "</tbody></table>";
        ?>

    </body>
</html>