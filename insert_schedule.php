<?php

session_start();
include('funcs.php');

$title = $_POST['title'];
$event_date = $_POST['event_date'];
$description = $_POST['description'];
$uid = $_SESSION['uid'];

$errors = [];
// 必須項目のチェック
if (empty($title)) {
    $errors['title'] = 'タイトルは必須です。';
}
if (empty($event_date)) {
    $errors['event_date'] = '日付を選んでください。';
}
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['input_data'] = $_POST;
    $_SESSION['from_insert'] = true;
    header('Location: detail.php?id=' . $_POST['id']);
    exit(); // エラーがあれば以降の処理を止める
}

//DB接続
$pdo = db_conn();

//３．データ登録SQL作成

// 1. SQL文を用意
$stmt = $pdo->prepare("INSERT INTO event_table(id, title, event_date, description, uid) 
VALUES(NULL, :title, :event_date, :description, :uid)");

//  2. バインド変数を用意
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':event_date', $event_date);
$stmt->bindValue(':description', $description, PDO::PARAM_STR);
$stmt->bindValue(':uid', $uid, PDO::PARAM_STR);
$status = $stmt->execute();

//４．データ登録処理後
if ($status === false) {
    sql_error($stmt);
}

// 登録完了後、リダイレクト
$_SESSION['success'] = "カレンダー登録が完了しました。";
header('Location: detail.php?id=' . $_POST['id']);
exit();