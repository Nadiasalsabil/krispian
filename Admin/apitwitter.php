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

 // menentukan keyword yang akan di cari
 $keyword = 'bandung';

 // ganti dengan API twitter anda
 $key = '54aWcbBLmejWagbqS2WKC3rPr';
 $secret_key = 'lR4OByA9WjNWWsJt4GbZjRcOSBwksEeugU4RQcE4VPwR3nW61w';
 $token = '961744036569669632-jiEcFSM6SqO1nabLq5dCXpYO38FZ33y';
 $secret_token = 's7JzRaJoaNkx3UYgBGenFhh0LqJv8tDCp49Drk03nK8eI';

 // membuka koneksi
 $conn = new TwitterOAuth($key, $secret_key, $token, $secret_token);

 // menagmbil tweet berdasarkan keyword yang di tentukan
 // anda bisa merubah jumlah tweet yang akan di tampilkanb dengan merubah angka pada count
 $tweets = $conn->get('search/tweets', array('q'=>$keyword, 'count'=>50));


 // menampilkan hasil keyword yang di tentukan
 echo '<h4>Keyword @'.$keyword.'</h4><hr />';
 foreach ($tweets->statuses as $tweet) {
  $str_id = $tweet->id_str;
  $user = $tweet->user->screen_name;
  $text = $tweet->text;
  $date = date('Y-m-d h:i:s', strtotime($tweet->created_at));

  echo '</strong>'.$date.'</strong>< br />';
  echo '<strong>'.$user.'</strong> : '.$text.'< br /><hr />< br />';
 }
?>
</body>
</html>
