<?php
//Db connection
    $servername = "localhost";
    $username = "root";
    $password = "password";
    $dbname = "test";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully";
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }


    $sql = "SELECT * FROM users";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // echo "<pre>";
    // print_r($result);
    // echo "</pre>";
    $newname = 'John';
    $sql2 = "UPDATE users SET email = ? WHERE name = 'John'";
    $stmt2 = $conn->prepare($sql2);

    // try{
    //     $stmt2->execute(['john@gmail.com']);
    //     echo "Update successfully";
    // }catch(PDOException $e){
    //     echo "Error: " . $e->getMessage();
    // }

    //Delete data
    // $sql3 = "DELETE FROM users WHERE id=1";
    // $stmt3 = $conn->prepare($sql3);

    // try{
    //     $stmt3->execute();
    //     echo "Delete successfully";
    // }catch(PDOException $e){
    //     echo "Error: " . $e->getMessage();
    // }

?>