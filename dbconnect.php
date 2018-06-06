<?php

    $url='localhost';
    $username='root';
    $password='manchidede12';
    $dbname='Back_end';
        
        try {
            $conn = new PDO("mysql:host=$url;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        catch(PDOException $e)
            {
            echo "Connection failed: " . $e->getMessage();
            }

?>