
<?php

// MySQLi or PDO - which one to use? 
// MySQLi is the improved version of MySQL.
// PDO is the PHP Data Objects extension.
// Both support Prepared Statements.
// PDO supports 12 different database drivers, whereas MySQLi supports MySQL only.
// Both are object-oriented, but MySQLi also offers a procedural API.
// Both support Prepared Statements. Prepared Statements protect from SQL injection, and are very important for web application security.

// Connect to database
// Grab an .env file from the internet and add it to your project
// The .env file should contain the following:

$conn = mysqli_connect('localhost', 'Tijani', 'passsword', 'ninja_pizza');




// Check connection
if(!$conn){
    echo 'Connection error: ' . mysqli_connect_error();
}

?>