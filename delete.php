<?php

include('header.php');
loginCheck();

$id = $_GET['id'];

$pdo = db_conn();

$stmt = $pdo->prepare("SELECT uid FROM taville_table WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status === false) {
    sql_error($stmt);
}

$v  = $stmt->fetch(PDO::FETCH_ASSOC);

if ($v['uid'] !== $_SESSION['uid']) {
    exit('LOGIN ERROR');
}

$sql = "DELETE taville_table, array_table FROM taville_table INNER JOIN array_table ON taville_table.id=array_table.id WHERE taville_table.id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status === false) {
    sql_error($stmt);
}
else{
    header('Location: index.php');
    exit();
}
?>