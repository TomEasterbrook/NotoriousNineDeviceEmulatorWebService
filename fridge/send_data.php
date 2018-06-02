<?php
$connectionString = 'mysql:dbname=tomeaste_device_manager;host=localhost';
$user = 'tomeaste_device_manager_admin';
$password = 'BournemouthUni18';

try {

    $newfridge =json_decode($_GET['pmt_fridge_data'],true);
    $pdo = new PDO($connectionString, $user, $password);
    $createSql = "INSERT INTO pmt_fridge_data (device_id, temp, doorstatus) VALUES (:device_id, :temp, :doorstatus)";
    $createStatement = $pdo->prepare($createSql);
    $createStatement->bindParam(":device_id",$newfridge ['device_id'], PDO::PARAM_INT);
    $createStatement->bindParam(":temp",$newfridge ['temp'], PDO::PARAM_STR);
    $createStatement->bindParam(":doorstatus",$newfridge ['doorstatus'], PDO::PARAM_STR);

    if ($createStatement->execute()){
        $sql = "SELECT * FROM pmt_fridge_data where device_id = :device_id";
        $selectStatement = $pdo->prepare($sql);
        $selectStatement->bindParam(":device_id",$pdo->lastInsertId(), PDO::PARAM_INT);
        $selectStatement->execute();
        if ($selectStatement->rowCount()>0){
            echo json_encode($selectStatement->fetch(PDO::FETCH_ASSOC));
        }
    }ELSE {
		var_dump ($pdo->errorInfo());
	}

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}