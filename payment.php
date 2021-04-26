<?php
    include_once "includes/connection.php";

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Payment</title>
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
            echo "<table><thead><tr><th>Payment_id</th><th>Customer_id</th><th>Staff_id</th><th>Rental_id</th>
            <th>Amount</th><th>Payment_date</th><th>Last_update</th></thead><tbody>"; 
            if (isset($_POST['search'])){
                
                $search = $_POST['search'];
            
                $query = "SELECT * FROM payment WHERE payment_id LIKE '%$search%' ;";    
                $result = mysqli_query($conn,$query);

                if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){   
                        echo "<tr><td>" . $row['payment_id'] . "</td><td>" . $row['customer_id'] . "</td><td>" . $row['staff_id'] . "</td>
                        <td>" . $row['rental_id'] . "</td><td>" . $row['amount'] . "</td><td>" . $row['payment_date'] . "</td><td>" . $row['last_update'] . "</td></tr>";  
                    }
                }else{
                    echo "<tr><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td><td> --NO DATA-- </td>
                    <td> --NO DATA-- </td><td> --NO DATA-- </td></tr>";
                }

            }elseif(isset($_POST['reset'])){
                $query = "SELECT * FROM payment;";
                $result = mysqli_query($conn,$query);

                while($row = mysqli_fetch_assoc($result)){   
                    echo "<tr><td>" . $row['payment_id'] . "</td><td>" . $row['customer_id'] . "</td><td>" . $row['staff_id'] . "</td>
                        <td>" . $row['rental_id'] . "</td><td>" . $row['amount'] . "</td><td>" . $row['payment_date'] . "</td><td>" . $row['last_update'] . "</td></tr>";  
                }

            }else {
                $query = "SELECT * FROM payment;";
                $result = mysqli_query($conn,$query);

                while($row = mysqli_fetch_assoc($result)){   
                    echo "<tr><td>" . $row['payment_id'] . "</td><td>" . $row['customer_id'] . "</td><td>" . $row['staff_id'] . "</td>
                        <td>" . $row['rental_id'] . "</td><td>" . $row['amount'] . "</td><td>" . $row['payment_date'] . "</td><td>" . $row['last_update'] . "</td></tr>";  
                }
    
            } 
            echo "</tbody></table>";
        ?>

        <div class = "insert">
            <div class = "popupcontent">
                <div class = "insertdown" id="close">+</div>
                <form action= "" method = "post">
                    <p>Payment ID:</p>
                        <input type="text" name="paymentid" onkeydown="return event.key != 'Enter'">
                    <p>Customer ID:</p>
                        <input type="text" name="customerid" onkeydown="return event.key != 'Enter'">
                    <p>Staff ID:</p>
                        <input type="text" name="staffid" onkeydown="return event.key != 'Enter'">
                    <p>Rental ID:</p>
                        <input type="text" name="rentalid" onkeydown="return event.key != 'Enter'">
                    <p>Amount:</p>
                        <input type="text" name="amount" onkeydown="return event.key != 'Enter'">
                    <p>Payment Date:</p>
                        <input type="text" name="paymentdate" style="display:block;" onkeydown="return event.key != 'Enter'">
                    <input type= "submit" name= "insert" class= "greenbutton" value ="INSERT">

                    <?php
                    if(isset($_POST['insert'])){
                        if(!empty($_POST['paymentid'])&& !empty($_POST['customerid'])&& !empty($_POST['staffid'])&& !empty($_POST['rentalid'])
                        && !empty($_POST['amount'])&& !empty($_POST['paymentdate'])){
                            if($_POST['paymentid'] > 0){
                                $paymentid= $_POST['paymentid'];
                                $query= "SELECT payment_id FROM payment WHERE payment_id = $paymentid;";
                                $result= mysqli_query($conn,$query);

                                if(mysqli_num_rows($result)==0){
                                    $paymentid= $_POST['paymentid'];
                                    $customerid= $_POST['customerid'];
                                    $staffid= $_POST['staffid'];
                                    $rentalid= $_POST['rentalid'];
                                    $amount= $_POST['amount'];
                                    $paymentdate= $_POST['paymentdate'];
                                    $lastupdate= date('Y-m-d H:i:s');
                                    $insert = "INSERT INTO payment VALUES('$paymentid','$customerid','$staffid','$rentalid','$amount','$paymentdate','$lastupdate');";
                                    $result = mysqli_query($conn,$insert);
                                    if ($result) {
                                        echo '<script> alert("DATA INSERTED SUCCESSFULLY!")</script>';
                                    }
                                    else
                                    echo '<script> alert("PREVIOUS INSERT FAILED! CHECK IF THERE WERE MISTAKES MADE WHEN INSERTING")</script>'; 

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
                <p>Payment ID:</p>
                        <input type="text" name="paymentid" onkeydown="return event.key != 'Enter'">
                    <p>Customer ID:</p>
                        <input type="text" name="customerid" onkeydown="return event.key != 'Enter'">
                    <p>Staff ID:</p>
                        <input type="text" name="staffid" onkeydown="return event.key != 'Enter'">
                    <p>Rental ID:</p>
                        <input type="text" name="rentalid" onkeydown="return event.key != 'Enter'">
                    <p>Amount:</p>
                        <input type="text" name="amount" onkeydown="return event.key != 'Enter'">
                    <p>Payment Date:</p>
                        <input type="text" name="paymentdate" style="display:block;" onkeydown="return event.key != 'Enter'">
                    <input type= "submit" name= "update" class= "greenbutton" value ="UPDATE">

                    <?php
                    if(isset($_POST['update'])){
                        if(!empty($_POST['paymentid'])&& !empty($_POST['customerid'])&& !empty($_POST['staffid'])&& !empty($_POST['rentalid'])
                        && !empty($_POST['amount'])&& !empty($_POST['paymentdate'])){
                            $paymentid= $_POST['paymentid'];
                            $query= "SELECT payment_id FROM payment WHERE payment_id = $paymentid;";
                            $result= mysqli_query($conn,$query);

                            if(mysqli_num_rows($result)==1){
                                $paymentid= $_POST['paymentid'];
                                $customerid= $_POST['customerid'];
                                $staffid= $_POST['staffid'];
                                $rentalid= $_POST['rentalid'];
                                $amount= $_POST['amount'];
                                $paymentdate= $_POST['paymentdate'];
                                $lastupdate= date('Y-m-d H:i:s');
                                $update = "UPDATE payment SET customer_id= '$customerid', staff_id= '$staffid', rental_id = '$rentalid', 
                                amount= '$amount', payment_date= '$paymentdate', last_update= '$lastupdate' WHERE payment_id = $paymentid;";
                                $result = mysqli_query($conn,$update); 
                                
                                if($result)
                                    echo '<script> alert("DATA UPDATED SUCCESSFULLY!")</script>';
                                else
                                    echo '<script> alert("PREVIOUS UPDATE FAILED! CHECK IF THERE WERE MISTAKES MADE WHEN UPDATING")</script>';
                                
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
                    <p>Payment ID:</p>
                        <input type="text" name="paymentid" onkeydown="return event.key != 'Enter'" style= "display:block">
                    <input type= "submit" name= "delete" class= "greenbutton" value ="DELETE">
                </form>
            </div>

            <?php
                if(isset($_POST['delete'])){
                    if(!empty($_POST['paymentid'])){
                        $paymentid= $_POST['paymentid'];
                        $query= "SELECT payment_id FROM payment WHERE payment_id = $paymentid;";
                        $result= mysqli_query($conn,$query);
                            
                        if(mysqli_num_rows($result)==1){
                            $paymentid= $_POST['paymentid'];
                            $delete = "DELETE FROM payment WHERE payment_id= '$paymentid'; ";
                            $result = mysqli_query($conn,$delete);
                                
                            if($result){
                                echo '<script> alert("ROW DELETED SUCCESSFULLY!")</script>';
                            }else{
                                echo '<script> alert("DELETE FAILED! YOU ARE NOT ALLOWED TO DELETE THIS ROW")</script>';
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