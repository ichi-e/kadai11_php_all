<?php

session_start();
require_once('funcs.php');

?>


<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Zen+Kaku+Gothic+Antique&family=Zen+Kaku+Gothic+New:wght@900&family=Zen+Maru+Gothic&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <h1><img src="img/logo.png" alt=""></h1>
        <p>子供とタビする</p>

        <?php if ($_SESSION['chk_ssid']): ?>
            <p class="uid">こんにちは！<?php echo htmlspecialchars($_SESSION['name'], ENT_QUOTES, 'UTF-8'); ?>さん</p>
        <?php endif; ?>

        <nav>
            <input type="checkbox" class="menu-btn" id="menu-btn">
            <label for="menu-btn" class="menu-icon"><span class="navicon"></span></label>
            <ul class="menu">
                <li><a href="index.php"> TOP</a></li>
                <?php if (!$_SESSION['chk_ssid']): ?>
                    <li><a href="user.php">ユーザー登録</a></li>
                    <li><a href="login.php">ログイン</a></li>
                <?php endif; ?>
                <?php if ($_SESSION['chk_ssid']): ?>
                    <li><a href="input.php">オススメホテルを登録する</a></li>
                    <li><a href="calendar.php">カレンダー</a></li>
                    <li><a href="logout.php" onclick="return confirm('ログアウトしてよろしいですか?')">ログアウト</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>