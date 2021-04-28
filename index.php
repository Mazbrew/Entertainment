<!DOCTYPE html>
<html>
    <head>
        <title>Index</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

        <link rel="stylesheet" type="text/css" media="screen" href="stylesheet.css">
    </head>

    <body>
        <div class = "header">
            POWERPUFFGIRLS&BOYS
        </div>
        
        <div class = "bar">
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
                <span style="font-size:25px;cursor:pointer;color:white; text-align:left" onclick="openNav()">&#9776; MENU</span>
            </div>
            <br />
        </div>

        
        <div>
            <h1>WELCOME TO OUR WEBSITE</h1>
        </div>
        
        <div class="intro">
            <br />
            <br />
            <p>PLEASE CHOOSE THE TABLE YOU WISH TO</p>
            <p>ACCESS FROM THE SIDEBAR MENU</p>
            <br />
            <p>ACCESSING THE TABLES ALLOWS YOU</p>
            <p>TO PERFORM TASKS ON THE TABLES</p>
            <p>AND DISPLAYING RELEVANT DATA</p>
            <br />
            <p>TASKS INCLUDE SEARCH, RESET, INSERT, UPDATE AND DELETE</p>
            <p>THE DATA OF THE TABLES</p>
            <br />
            <br />
        </div>

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