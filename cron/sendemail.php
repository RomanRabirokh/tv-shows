<?php
// config
$host='127.0.0.1';
$db='tv-shows';
$charset='utf8';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset;";
$user='root';
$pass='';
$opt = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);
$pdo = new PDO($dsn, $user, $pass, $opt);


$q = $pdo->query('SELECT shows.russian_name, seasons.number AS seas_number, series.number AS seris_number,
					dubbing_studios_series.realease_date,dubbing_studios.name AS db_name, sub_users.email,sub_users.id
					FROM tv_tv_shows AS shows 
					LEFT JOIN tv_seasons  AS seasons ON (shows.id=seasons.tv_show) 
					LEFT JOIN tv_series  AS  series ON  (seasons.id=series.season)
					LEFT JOIN tv_dubbing_studios_series  AS dubbing_studios_series ON(series.id=dubbing_studios_series.serie)
					LEFT JOIN tv_dubbing_studios  AS  dubbing_studios ON  (dubbing_studios_series.dubbing_studio=dubbing_studios.id)				
					LEFT JOIN tv_users_subscriptions  AS  sub_users ON  (sub_users.dubbing_studio=dubbing_studios_series.dubbing_studio AND sub_users.tv_show=shows.id)
					LEFT JOIN tv_users_subscriptions_logs  AS  sub_logs ON  (sub_logs.subscription=sub_users.id)
					WHERE dubbing_studios_series.realease_date IS NOT NULL
					AND dubbing_studios_series.realease_date=CURDATE()
					AND (series.number <> sub_logs.number_serie OR  sub_logs.number_serie IS  NULL)
					AND (seasons.number <> sub_logs.number_season OR  sub_logs.number_season IS  NULL)
					');
$rows = $q->fetchAll();
$count = count($rows);
foreach($rows as $row)
{
print_r($row);

// отрравить письмо!!

//запись в логи
$stmt = $pdo->prepare("INSERT INTO tv_users_subscriptions_logs (number_season,number_serie, subscription) VALUES (:number_season, :number_serie,:subscription)");
$stmt->bindParam(':number_serie', $row['seris_number']);
$stmt->bindParam(':number_season', $row['seas_number']);
$stmt->bindParam(':subscription', $row['id']);
$stmt->execute();

}

/*					AND sub_logs.number_serie != series.number
					AND sub_logs.number_season != seasons.number */				
?>
