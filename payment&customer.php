<?php
    include_once "includes/connection.php";

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Payment Join Customer</title>
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
                <input type ="text" name= "search" placeholder="SEARCH BY PAYMENT ID" size="30" style= "border-radius: 5px;">
            </form>
            <form action= "" method= "POST" style= 'display: inline;'>
                <input type = "submit" name= "reset" value= "RESET" class="button"> 
            </form>
        </div>

        <?php
            echo "<table><thead><tr><th>Payment_id</th><th>Customer_first_name</th><th>Customer_last_name</th><th>Rental_id</th><th>Payment_date</th><th>Payment_last_update</th></thead><tbody>"; 
            if (isset($_POST['search'])){
                
                $search = $_POST['search'];
        
                $query = "SELECT payment_id, customer.first_name AS customer_first, customer.last_name AS customer_last, rental_id, payment_date, payment.last_update AS payment_last_update FROM payment INNER JOIN customer ON customer.customer_id = payment.customer_id WHERE payment_id LIKE '%$search%' GROUP BY payment_id LIMIT 1000;";    
                $result = mysqli_query($conn,$query);

                if (mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){   
                        echo "<tr><td>" . $row['payment_id'] . "</td><td>" . $row['customer_first'] . "</td><td>" . $row['customer_last'] . "</td><td>" . $row['rental_id'] . "</td><td>" . $row['payment_date'] . "</td><td>" . $row['payment_last_update'] . "</td></tr>"; 
                    }
                }else{
                    echo "<tr><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td></tr>";
                }

            }elseif(isset($_POST['reset'])){
                $query = "SELECT payment_id, customer.first_name AS customer_first, customer.last_name AS customer_last, rental_id, payment_date, payment.last_update AS payment_last_update FROM payment INNER JOIN customer ON customer.customer_id = payment.customer_id ORDER BY payment_id ;";
                $result = mysqli_query($conn,$query);
                $totalrecords= mysqli_num_rows($result);
                $pagelim = ceil($totalrecords/1000);

                echo "<form action= '' method= 'POST'> <input type ='text' name= 'page' placeholder='Input the page number (1 / $pagelim)' size='30' style= 'border-radius: 5px;'></form>";


                $query = "SELECT payment_id, customer.first_name AS customer_first, customer.last_name AS customer_last, rental_id, payment_date, payment.last_update AS payment_last_update FROM payment INNER JOIN customer ON customer.customer_id = payment.customer_id AND payment_id BETWEEN (0 * 1000) AND (((0 + 1)* 1000)-1) ORDER BY payment_id ASC;";

                $result = mysqli_query($conn,$query);


                while($row = mysqli_fetch_assoc($result)){   
                    echo "<tr><td>" . $row['payment_id'] . "</td><td>" . $row['customer_first'] . "</td><td>" . $row['customer_last'] . "</td><td>" . $row['rental_id'] . "</td><td>" . $row['payment_date'] . "</td><td>" . $row['payment_last_update'] . "</td></tr>"; 
                }

                }elseif(isset($_POST['page'])){
                $page= $_POST['page'];
                $query = "SELECT payment_id, customer.first_name AS customer_first, customer.last_name AS customer_last, rental_id, payment_date, payment.last_update AS payment_last_update FROM payment INNER JOIN customer ON customer.customer_id = payment.customer_id ORDER BY payment_id ASC;";
                $result = mysqli_query($conn,$query);
                $totalrecords= mysqli_num_rows($result);
                $pagelim = ceil($totalrecords/1000);

                if($page <1 || $page > $pagelim){
                    echo("<meta http-equiv='refresh' content='1'>");
                    echo '<script> alert("Page number invalid")</script>';
                    
                }

                echo "<form action= '' method= 'POST'> <input type ='text' name= 'page' placeholder='Input the page number ($page / $pagelim)' size='30' style= 'border-radius: 5px;'></form>";

                

                
                $query = "SELECT payment_id, customer.first_name AS customer_first, customer.last_name AS customer_last, rental_id, payment_date, payment.last_update AS payment_last_update FROM payment INNER JOIN customer ON customer.customer_id = payment.customer_id AND payment_id BETWEEN (($page-1) * 1000) AND ((($page)* 1000)-1) ORDER BY payment_id ASC;";
                $result = mysqli_query($conn,$query);

                while($row = mysqli_fetch_assoc($result)){   
                    echo "<tr><td>" . $row['payment_id'] . "</td><td>" . $row['customer_first'] . "</td><td>" . $row['customer_last'] . "</td><td>" . $row['rental_id'] . "</td><td>" . $row['payment_date'] . "</td><td>" . $row['payment_last_update'] . "</td></tr>"; 
                }

                }else {
                $query = "SELECT payment_id, customer.first_name AS customer_first, customer.last_name AS customer_last, rental_id, payment_date, payment.last_update AS payment_last_update FROM payment INNER JOIN customer ON customer.customer_id = payment.customer_id ORDER BY payment_id ASC;";
                $result = mysqli_query($conn,$query);
                $totalrecords= mysqli_num_rows($result);
                $pagelim = ceil($totalrecords/1000);

                echo "<form action= '' method= 'POST'> <input type ='text' name= 'page' placeholder='Input the page number (1 / $pagelim)' size='30' style= 'border-radius: 5px;'></form>";

            

                 $query = "SELECT payment_id, customer.first_name AS customer_first, customer.last_name AS customer_last, rental_id, payment_date, payment.last_update AS payment_last_update FROM payment INNER JOIN customer ON customer.customer_id = payment.customer_id AND payment_id BETWEEN (0 * 1000) AND (((0 + 1)* 1000)-1) ORDER BY payment_id ASC;";

                 $result = mysqli_query($conn,$query);

                while($row = mysqli_fetch_assoc($result)){   
                    echo "<tr><td>" . $row['payment_id'] . "</td><td>" . $row['customer_first'] . "</td><td>" . $row['customer_last'] . "</td><td>" . $row['rental_id'] . "</td><td>" . $row['payment_date'] . "</td><td>" . $row['payment_last_update'] . "</td></tr>";   
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