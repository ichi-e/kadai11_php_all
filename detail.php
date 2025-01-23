<?php

include('header.php');
$pdo = db_conn();

require_once 'config.php';
$id = $_GET['id'];

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM taville_table WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
if ($status === false) {
    sql_error($stmt);
}

// 全データ取得
$values  = $stmt->fetch(PDO::FETCH_ASSOC);

$hotelName = h($values['name']);

// array_table取得
$stmt = $pdo->prepare("SELECT * FROM array_table WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status === false) {
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("ErrorQuery:" . $error[2]);
}

$points = $stmt->fetchAll(PDO::FETCH_ASSOC);

$pointArray = [];
foreach ($points as $point) {
    $pointArray[] = $point['point'];
}

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
    <!-- 成功メッセージ表示 -->
    <?php if (isset($success)): ?>
        <div class="message">
            <p><?php echo h($success); ?></p>
        </div>
    <?php endif; ?>

    <section class="single">
        <div class="detail_ttle">
            <p class="pref"><?php echo h($values['pref']); ?></p>
            <h1><?php echo h($values['name']); ?></h1>
            <?php if ($_SESSION['chk_ssid']): ?>
                <p class="register"><label for="popup"><img src="img/calendar.png" alt=""></label></p>
            <?php endif; ?>
        </div>

        <figure>
            <img src="img/<?php echo h($values['images']); ?>" alt="<?php echo h($values['name']); ?>">
        </figure>

        <?php if (!empty($pointArray)): ?>
            <ul class="point">
                <?php foreach ($pointArray as $point): ?>
                    <li><?php echo h($point); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <div class="stars" data-rec="<?php echo h($values['stars']); ?>"></div>

        <p class="memo"><?php echo nl2br(h($values['comment'])); ?></p>
        <p class="url"><a href="<?php echo h($values['url']); ?>" target="_blank"><?php echo h($values['url']); ?></a></p>

        <div id="map"></div>

        <p class="back"><a href="index.php">戻る</a></p>
    </section>

    <input type="checkbox" id="popup" <?php echo isset($_SESSION['errors']) ? 'checked' : ''; ?>>

    <div id="overlay">
        <label for="popup" id="bg_gray"></label>

        <div id="window">
            <label for="popup" id="btn_close">
                <span></span>
            </label>
            <form action="insert_schedule.php" method="post" class="popup_form">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div <?php
                        if (isset($errors['title'])) {
                            echo ' class="error"';
                        }
                        ?>>
                    <label for="title">ホテル名:</label>
                    <input type="text" name="title" value="<?php echo h($hotelName); ?>" readonly>
                    <?php
                    if (isset($errors['title'])) {
                        echo '<div class="error_text">' . $errors['title'] . '</div>';
                    }
                    ?>
                </div>
                <div <?php
                        if (isset($errors['event_date'])) {
                            echo ' class="error"';
                        }
                        ?>>
                    <label for="date">日付:</label>
                    <input type="date" name="event_date">
                    <?php
                    if (isset($errors['event_date'])) {
                        echo '<div class="error_text">' . $errors['event_date'] . '</div>';
                    }
                    ?>
                </div>
                <label for="description">詳細:</label>
                <textarea name="description"></textarea>
                <br>
                <button type="submit">登録</button>
            </form>
        </div>
    </div>

</main>
<script>
    (g => {
        var h, a, k, p = "The Google Maps JavaScript API",
            c = "google",
            l = "importLibrary",
            q = "__ib__",
            m = document,
            b = window;
        b = b[c] || (b[c] = {});
        var d = b.maps || (b.maps = {}),
            r = new Set,
            e = new URLSearchParams,
            u = () => h || (h = new Promise(async (f, n) => {
                await (a = m.createElement("script"));
                e.set("libraries", [...r] + "");
                for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]);
                e.set("callback", c + ".maps." + q);
                a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
                d[q] = f;
                a.onerror = () => h = n(Error(p + " could not load."));
                a.nonce = m.querySelector("script[nonce]")?.nonce || "";
                m.head.append(a)
            }));
        d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() => d[l](f, ...n))
    })({
        key: "<?php echo $apiKey; ?>",
        v: "weekly",
        // Use the 'v' parameter to indicate the version to use (weekly, beta, alpha, etc.).
        // Add other bootstrap parameters as needed, using camel case.
    });
</script>
<script>
    let map;
    let center;

    async function initMap() {
        const {
            Map
        } = await google.maps.importLibrary("maps");

        center = {
            lat: 35.6762,
            lng: 139.6503
        };
        map = new Map(document.getElementById("map"), {
            center: center,
            zoom: 10,
            mapId: "test",
        });
        findPlaces();
    }

    async function findPlaces() {
        const {
            Place
        } = await google.maps.importLibrary("places");
        const {
            AdvancedMarkerElement
        } = await google.maps.importLibrary("marker");
        const request = {
            textQuery: "<?php echo $hotelName; ?>",
            fields: ["displayName", "location", "businessStatus"],
            includedType: "hotel",
            maxResultCount: 1,
            isOpenNow: false,
            language: "ja",
            region: "jp",
            useStrictTypeFiltering: true,
        };
        //@ts-ignore
        const {
            places
        } = await Place.searchByText(request);

        if (places.length) {
            console.log(places);

            const {
                LatLngBounds
            } = await google.maps.importLibrary("core");
            const bounds = new LatLngBounds();

            const place = places[0];
            const markerView = new AdvancedMarkerElement({
                map,
                position: place.location,
                title: place.displayName,
            });

            bounds.extend(place.location);
            console.log(place);

            map.fitBounds(bounds);
            map.setZoom(18);

        } else {
            console.log("No results");
        }
    }

    initMap();
</script>
<?php include('footer.php'); ?>