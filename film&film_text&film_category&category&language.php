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
                <input type ="text" name= "search" placeholder="SEARCH BY FILM TITLE" style= "border-radius: 5px;">
            </form>
            <form action= "" method= "POST" style= 'display: inline;'>
                <input type = "submit" name= "reset" value= "RESET" class="button"> 
            </form>
        </div>

        <?php
            echo "<table><thead><tr><th>Title</th><th>Category</th><th>Language</th></thead><tbody>"; 
            if (isset($_POST['search'])){
                
                $search = $_POST['search'];
        
                $query = "SELECT film_text.title AS title, category.name AS category, language.name AS language FROM film INNER JOIN film_text ON film.film_id = film_text.film_id INNER JOIN film_category ON film_text.film_id = film_category.film_id INNER JOIN category ON film_category.category_id = category.category_id INNER JOIN language ON film.language_id = language.language_id WHERE title LIKE '%$search%' GROUP BY title ;";    
                $result = mysqli_query($conn,$query);

                if (mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){   
                        echo "<tr><td>" . $row['title'] . "</td><td>" . $row['category'] . "</td><td>" . $row['language'] . "</td></tr>"; 
                    }
                }else{
                    echo "<tr><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td></tr>";
                }

            }elseif(isset($_POST['reset'])){
                $query = "SELECT film_text.title AS title, category.name AS category, language.name AS language FROM film INNER JOIN film_text ON film.film_id = film_text.film_id INNER JOIN film_category ON film_text.film_id = film_category.film_id INNER JOIN category ON film_category.category_id = category.category_id INNER JOIN language ON film.language_id = language.language_id GROUP BY title;";
                $result = mysqli_query($conn,$query);

                while($row = mysqli_fetch_assoc($result)){   
                    echo "<tr><td>" . $row['title'] . "</td><td>" . $row['category'] . "</td><td>" . $row['language'] . "</td></tr>";
                }

            }else {
                $query = "SELECT film_text.title AS title, category.name AS category, language.name AS language FROM film INNER JOIN film_text ON film.film_id = film_text.film_id INNER JOIN film_category ON film_text.film_id = film_category.film_id INNER JOIN category ON film_category.category_id = category.category_id INNER JOIN language ON film.language_id = language.language_id GROUP BY title;";
                $result = mysqli_query($conn,$query);

                while($row = mysqli_fetch_assoc($result)){   
                    echo "<tr><td>" . $row['title'] . "</td><td>" . $row['category'] . "</td><td>" . $row['language'] . "</td></tr>";   
                }
            } 
            echo "</tbody></table>";
        ?>

    </body>
</html>