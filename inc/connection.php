<?php 

    try {
        $db = new PDO("mysql:host=localhost;dbname=portfolio;port=3306","root","");
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }

?>