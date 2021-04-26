<?php
    include_once "includes/connection.php";

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Payment Join Customer Join Staff</title>
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
        </div>

        <?php
            echo "<table><thead><tr><th>Payment_id</th><th>Customer_first_name</th><th>Customer_last_name</th><th>Staff_first_name</th><th>Staff_last_name</th><th>Rental_id</th><th>Amount</th><th>Payment_date</th><th>Payment_last_update</th></thead><tbody>"; 
            if (isset($_POST['search'])){
                
                $search = $_POST['search'];
        
                $query = "SELECT payment_id, customer.first_name AS customer_first, customer.last_name AS customer_last, staff.first_name AS staff_first, staff.last_name AS staff_last, rental_id, amount, payment_date, payment.last_update AS payment_last_update FROM payment INNER JOIN customer ON customer.customer_id = payment.customer_id INNER JOIN staff ON staff.staff_id = payment.staff_id WHERE payment_id LIKE '%$search%' GROUP BY payment_id ;";    
                $result = mysqli_query($conn,$query);

                if (mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){   
                        echo "<tr><td>" . $row['payment_id'] . "</td><td>" . $row['customer_first'] . "</td><td>" . $row['customer_last'] . "</td><td>" . $row['staff_first'] . "</td><td>" . $row['staff_last'] . "</td><td>" . $row['rental_id'] . "</td><td>" . $row['amount'] . "</td><td>" . $row['payment_date'] . "</td><td>" . $row['payment_last_update'] . "</td></tr>"; 
                    }
                }else{
                    echo "<tr><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td></tr>";
                }

            }elseif(isset($_POST['reset'])){
                $query = "SELECT payment_id, customer.first_name AS customer_first, customer.last_name AS customer_last, staff.first_name AS staff_first, staff.last_name AS staff_last, rental_id, amount, payment_date, payment.last_update AS payment_last_update FROM payment INNER JOIN customer ON customer.customer_id = payment.customer_id INNER JOIN staff ON staff.staff_id = payment.staff_id ORDER BY payment_id ASC;";
                $result = mysqli_query($conn,$query);

                while($row = mysqli_fetch_assoc($result)){   
                    echo "<tr><td>" . $row['payment_id'] . "</td><td>" . $row['customer_first'] . "</td><td>" . $row['customer_last'] . "</td><td>" . $row['staff_first'] . "</td><td>" . $row['staff_last'] . "</td><td>" . $row['rental_id'] . "</td><td>" . $row['amount'] . "</td><td>" . $row['payment_date'] . "</td><td>" . $row['payment_last_update'] . "</td></tr>"; 
                }

            }else {
                $query = "SELECT payment_id, customer.first_name AS customer_first, customer.last_name AS customer_last, staff.first_name AS staff_first, staff.last_name AS staff_last, rental_id, amount, payment_date, payment.last_update AS payment_last_update FROM payment INNER JOIN customer ON customer.customer_id = payment.customer_id INNER JOIN staff ON staff.staff_id = payment.staff_id ORDER BY payment_id ASC;";
                $result = mysqli_query($conn,$query);

                while($row = mysqli_fetch_assoc($result)){   
                    echo "<tr><td>" . $row['payment_id'] . "</td><td>" . $row['customer_first'] . "</td><td>" . $row['customer_last'] . "</td><td>" . $row['staff_first'] . "</td><td>" . $row['staff_last'] . "</td><td>" . $row['rental_id'] . "</td><td>" . $row['amount'] . "</td><td>" . $row['payment_date'] . "</td><td>" . $row['payment_last_update'] . "</td></tr>";   
                }
            } 
            echo "</tbody></table>";
        ?>

    </body>
</html>