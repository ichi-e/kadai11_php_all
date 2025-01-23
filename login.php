<?php

include('header.php');
$errors = $_SESSION['errors'];
$loginData = $_SESSION['login_data'];
$success = $_SESSION['success'];
$differ = $_SESSION['differ'];

// セッションをリセット
if ($success !== null || $_SESSION['from_act'] !== true) {
    unset($_SESSION['errors'], $_SESSION['differ'], $_SESSION['success'], $_SESSION['login_data']);
    $errors = null;
} else {
    unset($_SESSION['from_act']);
}
?>
<main>
    <div class="login">
        <!-- 成功メッセージ表示 -->
        <?php if (isset($success)): ?>
            <div class="message">
                <p style="color: green;"><?php echo h($success); ?></p>
            </div>
        <?php endif; ?>

        <form action="login_act.php" method="post">
            <div>
                <h2>Email</h2>
                <div <?php
                        if (isset($errors['lid'])) {
                            echo ' class="error"';
                        }
                        ?>>
                    <input type="text" name="lid" value="<?php echo h($loginData['lid'] ?? '') ?>">
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
                        if (isset($errors['lpw']) || $differ !== null) {
                            echo ' class="error"';
                        }
                        ?>>
                    <input type="password" name="lpw">
                    <?php
                    if (isset($errors['lpw'])) {
                        echo '<div class="error_text">' . $errors['lpw'] . '</div>';
                    } elseif ($differ !== null) {
                        echo '<div class="error_text">' . $differ . '</div>';
                    }
                    ?>
                </div>
            </div>

            <div class="submit">
                <button type="submit">LOGIN</button>
            </div>
        </form>
    </div>

</main>