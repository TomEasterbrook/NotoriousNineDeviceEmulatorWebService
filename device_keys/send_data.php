<?php
$connectionString = 'mysql:dbname=tomeaste_device_manager;host=localhost';
$user = 'tomeaste_device_manager_admin';
$password = 'BournemouthUni18';

try {

    $newdevicekey =json_decode($_GET['pmt_device_keys'],true);
    $pdo = new PDO($connectionString, $user, $password);
    $createSql = "INSERT INTO pmt_device_keys (activation_key, device_type) VALUES (:activation_key, :device_type)";
    $createStatement = $pdo->prepare($createSql);
    $createStatement->bindParam(":activation_key",$newdevicekey ['activation_key'], PDO::PARAM_STR);
    $createStatement->bindParam(":device_type",$newdevicekey ['device_type'], PDO::PARAM_STR);

    if ($createStatement->execute()){
        $sql = "SELECT * FROM pmt_device_keys where activation_id = :activation_id";
        $selectStatement = $pdo->prepare($sql);
        $selectStatement->bindParam(":activation_id",$pdo->lastInsertId("activation_id"), PDO::PARAM_INT);
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

