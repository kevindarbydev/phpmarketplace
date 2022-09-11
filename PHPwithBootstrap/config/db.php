 <?php
    session_start();

    $dbPass = 'abc';
    $dbName = 'bootstrap1';
    $dbUser = 'bootstrap1';
    $dbHost = 'localhost:3333';


    $link = @mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
    if (!$link) {
        die("Fatal error: Failed to connect to mySQL -" . mysqli_connect_error());
    }
