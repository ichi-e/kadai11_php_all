<?php
include('header.php');
loginCheck();

$pdo = db_conn();

// 現在の年と月を取得
$currentYear = isset($_GET['year']) ? intval($_GET['year']) : date('Y');
$currentMonth = isset($_GET['month']) ? intval($_GET['month']) : date('m');

// 月初と月末の日付を取得
$firstDay = "$currentYear-" . str_pad($currentMonth, 2, '0', STR_PAD_LEFT) . "-01";
$lastDay = date('Y-m-t', strtotime($firstDay));

// データベース
$stmt = $pdo->prepare("SELECT * FROM event_table WHERE event_date BETWEEN :firstDay AND :lastDay");
$stmt->bindValue(':firstDay', $firstDay, PDO::PARAM_STR);
$stmt->bindValue(':lastDay', $lastDay, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status === false) {
    sql_error($stmt);
}

$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

// カレンダー表示
function drawCalendar($year, $month, $events)
{
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $firstWeekday = date('w', strtotime("$year-$month-01"));
    echo "<section class='calendar'>";
    echo "<h2>" . $year . "年 " . $month . "月</h2>";
    echo "<table border='1'>";
    echo "<tr><th>日</th><th>月</th><th>火</th><th>水</th><th>木</th><th>金</th><th>土</th></tr><tr>";

    // 月初め空白
    for ($i = 0; $i < $firstWeekday; $i++) {
        echo "<td></td>";
    }

    // 日にち
    for ($day = 1; $day <= $daysInMonth; $day++) {
        $currentDate = "$year-" . str_pad($month, 2, "0", STR_PAD_LEFT) . "-" . str_pad($day, 2, "0", STR_PAD_LEFT);
        $eventList = [];
        foreach ($events as $e) {
            if ($e['event_date'] === $currentDate) {
                $eventList[] = $e;
            }
        }

        echo "<td>";
        echo $day;

        // イベントを表示
        foreach ($eventList as $event) {
            if ($event['uid'] == $_SESSION['uid']){
                echo "<div class='event'>
                <p class='event-title' data-id='{$event['id']}'>{$event['title']}</p>
                <p class='event-description'>{$event['description']}</p>
                </div>";
            }
        }

        echo "</td>";

        // 土曜日で改行
        if (($day + $firstWeekday) % 7 === 0) {
            echo "</tr><tr>";
        }
    }

    // 空白セル
    $remainingCells = 7 - (($daysInMonth + $firstWeekday) % 7);
    for ($i = 0; $i < $remainingCells; $i++) {
        echo "<td></td>";
    }

    echo "</tr></table>";
    echo "</section>";
}

// カレンダー表示
drawCalendar($currentYear, $currentMonth, $events);

// 前月・翌月へのリンク
$prevMonth = date('Y-m', strtotime("$currentYear-$currentMonth -1 month"));
$nextMonth = date('Y-m', strtotime("$currentYear-$currentMonth +1 month"));
echo "<div class='pager'>";
echo "<a href='?year=" . date('Y', strtotime($prevMonth)) . "&month=" . date('m', strtotime($prevMonth)) . "'>< " . $prevMonth . "</a>";
echo "<a href='?year=" . date('Y', strtotime($nextMonth)) . "&month=" . date('m', strtotime($nextMonth)) . "'>" . $nextMonth . " ></a>";
echo "</div>";


?>

<div id="popup" class="popup">
    <div class="popup-content">
        <span id="closePopup" class="close-btn">×</span>
        <h3 class="popupTitle"></h3>
        <p class="popupDescription"></p>
    </div>
</div>

<?php include('footer.php'); ?>