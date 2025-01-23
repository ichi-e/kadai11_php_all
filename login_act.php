<?php
session_start();
require_once('funcs.php');

//POST値を受け取る
$lid = $_POST['lid'];
$lpw = $_POST['lpw'];

// 未入力のチェック
$errors = [];
if (empty($lid)) {
    $errors['lid'] = 'Emailを入力してください';
}
if (empty($lpw)) {
    $errors['lpw'] = 'Passwordを入力してください';
}
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['login_data'] = $_POST;
    $_SESSION['from_act'] = true;
    redirect('login.php');
    exit(); // エラーがあれば以降の処理を止める
}

//1.  DB接続
$pdo = db_conn();

//2. データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM user_table WHERE lid = :lid AND user_flg=0;');
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status === false){
    sql_error($stmt);
}

//4. 抽出データ数を取得
$val = $stmt->fetch();

//if(password_verify($lpw, $val['lpw'])){ //* PasswordがHash化の場合はこっちのIFを使う
if( $val['id'] != '' && password_verify($lpw, $val['lpw']) ){
    //Login成功時 該当レコードがあればSESSIONに値を代入
    $_SESSION['chk_ssid'] = session_id();
    $_SESSION['uid'] = $val['id'];
    $_SESSION['name'] = $val['name'];
    $_SESSION['success'];
    redirect('index.php');
}else{
    //Login失敗時(Logout経由)
    $_SESSION['differ'] = 'Passwordが違います';
    $_SESSION['login_data'] = $_POST;
    redirect('login.php');
}

exit();
