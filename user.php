<?php

include('header.php');

// エラーと入力データの取得
$errors = $_SESSION['errors'];
$inputData = $_SESSION['input_data'];
$success = $_SESSION['success'];
$insert = $_SESSION['from_insert'];

// セッションをリセット
if ($success !== null || $_SESSION['from_insert'] !== true) {
    unset($_SESSION['errors'], $_SESSION['input_data'], $_SESSION['success']);
    $errors = null;
    $inputData = null;
} else {
    // フラグを消す
    unset($_SESSION['from_insert']);
}

?>

<main>
    <div class="login">
        <form method="POST" action="user_insert.php">
            <div>
                <h2>名前</h2>
                <div <?php
                        if (isset($errors['name'])) {
                            echo ' class="error"';
                        }
                        ?>>
                    <input type="text" name="name" value="<?php echo h($inputData['name'] ?? '') ?>">
                    <?php
                    if (isset($errors['name'])) {
                        echo '<div class="error_text">' . $errors['name'] . '</div>';
                    }
                    ?>
                </div>
            </div>
            <div>
                <h2>Email</h2>
                <div <?php
                        if (isset($errors['lid'])) {
                            echo ' class="error"';
                        }
                        ?>>
                    <input type="text" name="lid" value="<?php echo h($inputData['lid'] ?? '') ?>">
                    <?php
                    if (isset($errors['lid'])) {
                        echo '<div class="error_text">' . $errors['lid'] . '</div>';
                    }
                    ?>
                </div>
            </div>
            <div>
                <h2>Password</h2>
                <div <?php
                        if (isset($errors['lpw'])) {
                            echo ' class="error"';
                        }
                        ?>>
                    <input type="password" name="lpw" value="<?php echo h($inputData['lpw'] ?? '') ?>">
                    <?php
                    if (isset($errors['lpw'])) {
                        echo '<div class="error_text">' . $errors['lpw'] . '</div>';
                    }
                    ?>
                </div>
            </div>
            <div class="submit">
                <button type="submit">登 録</button>
            </div>
        </form>
    </div>
</main>

<?php include('footer.php'); ?>