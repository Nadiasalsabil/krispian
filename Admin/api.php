<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Twitter API SEARCH</title>

  <style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>
</head>
<body>
<form action ="" method="post">
  <label>Search : <input type="text" name="keyword" id="keyword"/></label>
</form>


<?php

   error_reporting(0);
   require_once"konmysqli.php";
 require_once __DIR__.'/vendor/twitteroauth/autoload.php';
 use Abraham\TwitterOAuth\TwitterOAuth;
 
 if (isset($_POST['keyword'])){

    $keyword = $_POST['keyword'];
    
    $key = '54aWcbBLmejWagbqS2WKC3rPr';
 $secret_key = 'lR4OByA9WjNWWsJt4GbZjRcOSBwksEeugU4RQcE4VPwR3nW61w';
 $token = '961744036569669632-jiEcFSM6SqO1nabLq5dCXpYO38FZ33y';
 $secret_token = 's7JzRaJoaNkx3UYgBGenFhh0LqJv8tDCp49Drk03nK8eI';

 // membuka koneksi
 $conn = new TwitterOAuth($key, $secret_key, $token, $secret_token);

 // menagmbil tweet berdasarkan keyword yang di tentukan
 // anda bisa merubah jumlah tweet yang akan di tampilkanb dengan merubah angka pada count
 $tweets = $conn->get('search/tweets', array('q'=>$keyword, 'count'=>50));

 $array = json_decode(file_get_contents('https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=username&count=1'),true);

 // menampilkan hasil keyword yang di tentukan
 echo '<h4>Keyword @'.$keyword.'</h4><hr />';

 foreach ($tweets->statuses as $tweet) {
  $str_id = $tweet->id_str;
  $user = $tweet->user->screen_name;
  $text = $tweet->text;
  $date = date('Y-m-d h:i:s', strtotime($tweet->created_at));

  echo '<table style="width:100%">';
  echo '<tr>';
 
  echo '<td>'.$date.'</td>';
  echo '<td>'.$user.'</td>';
  echo '<td>'.$text.'</td>';
  echo '</tr>';
  echo '</table>';
  // // echo '<strong>'.$user.'</strong> : '.$text.'< br /><hr />< br />';
  }


 
}

?>




</body>
</html>