<?php
$connectionString = 'mysql:dbname=tomeaste_device_manager;host=localhost';
$user = 'tomeaste_device_manager_admin';
$password = 'BournemouthUni18';

try {

    $newlightbulb =json_decode($_GET['pmt_light_bulb_data'],true);
    $pdo = new PDO($connectionString, $user, $password);
    $createSql = "INSERT INTO pmt_light_bulb_data (device_id, KwH, on_off) VALUES (:device_id, :KwH, :on_off)";
    $createStatement = $pdo->prepare($createSql);
    $createStatement->bindParam(":device_id",$newlightbulb ['device_id'], PDO::PARAM_INT);
    $createStatement->bindParam(":KwH",$newlightbulb ['KwH'], PDO::PARAM_STR);
    $createStatement->bindParam(":gas_usage_KwH",$newlightbulb ['gas_usage_KwH'], PDO::PARAM_STR);

    if ($createStatement->execute()){
        $sql = "SELECT * FROM pmt_light_bulb_data where device_id = :device_id";
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

