<?php
$connectionString = 'mysql:dbname=tomeaste_device_manager;host=localhost';
$user = 'tomeaste_device_manager_admin';
$password = 'BournemouthUni18';

try {
    $pdo = new PDO($connectionString, $user, $password);
    $sql = "SELECT * FROM pmt_device_keys where activation_id = :activation_id";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(":activation_id",$_GET['activation_id'], PDO::PARAM_INT);
    $statement->execute();
    if ($statement->rowCount()>0){
        echo json_encode($statement->fetch(PDO::FETCH_ASSOC));
    }

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
