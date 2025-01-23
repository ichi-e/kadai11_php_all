<?php

session_start();

include('funcs.php');

$name = $_POST['name'] ?? '';
$lid = $_POST['lid'] ?? '';
$lpw = $_POST["lpw"] ?? '';
if(!empty($lpw)){
    $lpw = password_hash($lpw, PASSWORD_DEFAULT);
}

// 未入力のチェック
$errors = [];
if (empty($name)) {
    $errors['name'] = 'お名前は必須です。';
}
if (empty($lid)) {
    $errors['lid'] = 'Emailは必須です。';
}
if (empty($lpw)) {
    $errors['lpw'] = 'Passwordは必須です。';
}
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['input_data'] = $_POST;
    $_SESSION['from_insert'] = true;
    header('Location: user.php');
    exit(); // エラーがあれば以降の処理を止める
}

//DB接続
$pdo = db_conn();

// 1. SQL文を用意
$stmt = $pdo->prepare("INSERT INTO user_table(id, name, lid, lpw, kanri_flg, user_flg) 
VALUES(NULL, :name, :lid, :lpw, 0, 0)");

//  2. バインド変数を用意
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$status = $stmt->execute();

//４．データ登録処理後
if ($status === false) {
    sql_error($stmt);
}

// 登録完了後、リダイレクト
$_SESSION['success'] = "登録が完了しました。ログインしてください。";
header('Location: login.php');
exit();
