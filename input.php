<?php

include('header.php');
loginCheck();

// エラーと入力データの取得
$errors = $_SESSION['errors'];
$inputData = $_SESSION['input_data'];
$success = $_SESSION['success'];
$points = $inputData['point'];
$img = $_SESSION['img_data'];
$insert = $_SESSION['from_insert'];

// セッションをリセット
if ($success !== null || $_SESSION['from_insert'] !== true) {
    unset($_SESSION['errors'], $_SESSION['input_data'], $_SESSION['success'], $inputData['point'], $_SESSION['img_data']);
    $errors = null;
    $inputData = null;
    $points = null;
    $img = null;
} else {
    // フラグを消す
    unset($_SESSION['from_insert']);
}

include('pref.php');
$selectedPref = $inputData["pref"] ?? "選択して下さい";

?>

<main>
    <!-- 成功メッセージ表示 -->
    <?php if (isset($success)): ?>
        <div class="message">
            <p><?php echo h($success); ?></p>
        </div>
    <?php endif; ?>



    <form enctype="multipart/form-data" action="insert.php" method="post">
        <p>＊は必須項目です</p>
        <div>
            <h2>ホテル名＊</h2>
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
            <h2>都道府県＊</h2>
            <div <?php
                    if (isset($errors['pref'])) {
                        echo ' class="error"';
                    }
                    ?>>
                <select name="pref">
                    <?php foreach ($pref as $pref): ?>
                        <option value="<?= h($pref) ?>"
                            <?= $pref === $selectedPref ? 'selected' : '' ?>>
                            <?= h($pref) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <?php
                if (isset($errors['pref'])) {
                    echo '<div class="error_text">' . $errors['pref'] . '</div>';
                }
                ?>
            </div>
        </div>
        <div>
            <h2>URL</h2>
            <input type="text" name="url" value="<?php echo h($inputData['url'] ?? '') ?>">
        </div>
        <div class="range-group">
            <h2>オススメ度＊</h2>
            <div <?php
                    if (isset($errors['stars'])) {
                        echo ' class="error"';
                    }
                    ?>>
                <input type="range" min="0" max="5" value="<?php echo h($inputData['stars'] ?? 0) ?>" class="input-range" name="stars" />
                <div class="stars"></div>
                <?php
                if (isset($errors['stars'])) {
                    echo '<div class="error_text">' . $errors['stars'] . '</div>';
                }
                ?>
            </div>
        </div>
        <div>
            <h2>うれしいポイント＊</h2>
            <div <?php
                    if (isset($errors['point'])) {
                        echo ' class="error"';
                    }
                    ?>>
                <label>
                    <input type="checkbox" name="point[]" value="バス・トイレ別"
                        <?php echo (isset($points) && in_array("バス・トイレ別", $points)) ? 'checked' : ''; ?>>
                    バス・トイレ別
                </label>

                <label>
                    <input type="checkbox" name="point[]" value="小学生まで添い寝OK"
                        <?php echo (isset($points) && in_array("小学生まで添い寝OK", $points)) ? 'checked' : ''; ?>>
                    小学生まで添い寝OK
                </label>
                <label>
                    <input type="checkbox" name="point[]" value="ベット幅110cm以上"
                        <?php echo (isset($points) && in_array("ベット幅110cm以上", $points)) ? 'checked' : ''; ?>>
                    ベット幅110cm以上
                </label>
                <label>
                    <input type="checkbox" name="point[]" value="靴を脱ぐお部屋"
                        <?php echo (isset($points) && in_array("靴を脱ぐお部屋", $points)) ? 'checked' : ''; ?>>
                    靴を脱ぐお部屋
                </label>
                <label>
                    <input type="checkbox" name="point[]" value="駅近"
                        <?php echo (isset($points) && in_array("駅近", $points)) ? 'checked' : ''; ?>>
                    駅近
                </label>
                <label>
                    <input type="checkbox" name="point[]" value="ショッピングセンター併設"
                        <?php echo (isset($points) && in_array("ショッピングセンター併設", $points)) ? 'checked' : ''; ?>>
                    ショッピングセンター併設
                </label>

                <?php
                if (isset($errors['point'])) {
                    echo '<div class="error_text">' . $errors['point'] . '</div>';
                }
                ?>
            </div>
        </div>
        <div>
            <h2>写真＊</h2>
            <div <?php
                    if (isset($errors['img'])) {
                        echo ' class="error"';
                    }
                    ?>>
                <input type="file" name="img" accept="image/*" class="file" multiple>
                <img class="img_prev" src="img/<?php echo h($img ?? '') ?>" alt="">
                <?php
                if (isset($errors['point'])) {
                    echo '<div class="error_text">' . $errors['img'] . '</div>';
                }
                ?>
            </div>
        </div>
        <div>
            <h2>コメント＊</h2>
            <div <?php
                    if (isset($errors['comment'])) {
                        echo ' class="error"';
                    }
                    ?>>
                <textarea name="comment" cols="30" rows="10"><?php echo h($inputData['comment'] ?? '') ?></textarea>
                <?php
                if (isset($errors['comment'])) {
                    echo '<div class="error_text">' . $errors['comment'] . '</div>';
                }
                ?>
            </div>
        </div>

        <div class="submit">
            <button type="submit">登 録</button>
        </div>

    </form>
</main>

<?php include('footer.php'); ?>