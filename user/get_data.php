<?php
$connectionString = 'mysql:dbname=tomeaste_device_manager;host=localhost';
$user = 'tomeaste_device_manager_admin';
$password = 'BournemouthUni18';

try {
    $pdo = new PDO($connectionString, $user, $password);
    $sql = "SELECT * FROM user where id = :id";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(":id",$_GET['id'], PDO::PARAM_INT);
    $statement->execute();
    if ($statement->rowCount()>0){
        echo json_encode($statement->fetch(PDO::FETCH_ASSOC));
    }

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
