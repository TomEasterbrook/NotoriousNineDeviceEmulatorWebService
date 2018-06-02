<?php
$connectionString = 'mysql:dbname=tomeaste_device_manager;host=localhost';
$user = 'tomeaste_device_manager_admin';
$password = 'BournemouthUni18';

try {
    $pdo = new PDO($connectionString, $user, $password);
    $sql = "SELECT * FROM pmt_devices where device_id = :device_id";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(":device_id",$_GET['device_id'], PDO::PARAM_INT);
    $statement->execute();
    if ($statement->rowCount()>0){
        echo json_encode($statement->fetch(PDO::FETCH_ASSOC));
    }

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}catch (Exception $exception){
    echo 'Error';
}
