<?php
$connectionString = 'mysql:dbname=tomeaste_device_manager;host=localhost';
$user = 'tomeaste_device_manager_admin';
$password = 'BournemouthUni18';

try {

    $newTv =json_decode($_GET['pmt_tv_data'],true);
    $pdo = new PDO($connectionString, $user, $password);
    $createSql = "INSERT INTO pmt_tv_data (device_id, device_status, KwH) VALUES (:device_id, :device_status, :KwH)";
    $createStatement = $pdo->prepare($createSql);
    $createStatement->bindParam(":device_id",$newTv['device_id'], PDO::PARAM_INT);
    $createStatement->bindParam(":device_status",$newTv['device_status'], PDO::PARAM_STR);
    $createStatement->bindParam(":KwH",$newTv['KwH'], PDO::PARAM_STR);

    if ($createStatement->execute()){
        $sql = "SELECT * FROM pmt_tv_data where device_id = :device_id";
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
}catch (Exception $exception){
    echo $exception->getMessage();
}

