<!DOCTYPE html>
<html>
<head>
<title>MENGAMBIL TWEET BERDASARKAN KEYWORD DENGAN PHP</title>
</head>
<body>
<?php
 // load library TwitterOAuth
 require_once __DIR__.'/vendor/twitteroauth/autoload.php';
 use Abraham\TwitterOAuth\TwitterOAuth;

 define('CONSUMER_KEY', 'z2zI77JGuk5meAdwPfXAKq1Nv');
 define('CONSUMER_SECRET', 'aSdCIpif9EEIDI1rwCawor822q02mYJftsioUlNOUO7izbYfyR');
 define('ACCESS_TOKEN', '158229766-9r60XA85l4sebL2poQy9qAtZyATlHp1adBILpnl8');
 define('ACCESS_TOKEN_SECRET', 'MTbxz3ohP9Cngdt032UNda16WMEsTtkaDCG50HDDmMM3O');
 function search($query)
 {
   $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
   return $connection->get('search/tweets', $query);
 }
 
 
?>
</body>
</html>
