<?php
$pro="simpan";
$tanggal=WKT(date("Y-m-d"));
?>
<link type="text/css" href="<?php echo "$PATH/base/";?>ui.all.css" rel="stylesheet" />   
<script type="text/javascript" src="<?php echo "$PATH/";?>jquery-1.3.2.js"></script>
<script type="text/javascript" src="<?php echo "$PATH/";?>ui/ui.core.js"></script>
<script type="text/javascript" src="<?php echo "$PATH/";?>ui/ui.datepicker.js"></script>
<script type="text/javascript" src="<?php echo "$PATH/";?>ui/i18n/ui.datepicker-id.js"></script>
    
  <script type="text/javascript"> 
      $(document).ready(function(){
        $("#tanggal").datepicker({
					dateFormat  : "dd MM yy",        
          changeMonth : true,
          changeYear  : true					
        });
      });
    </script>    

<script src="../dist/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../dist/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.js"></script>
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>

<script type="text/javascript"> 
function PRINT(){ 
win=window.open('user/print.php','win','width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, keterangan=0'); } 
</script>
<script language="JavaScript">
function buka(url) {window.open(url, 'window_baru', 'width=800,height=600,left=320,top=100,resizable=1,scrollbars=1');}
</script>

<link rel="stylesheet" href="js/jquery-ui.css">
  <link rel="stylesheet" href="resources/demos/style.css">
<script src="js/jquery-1.12.4.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#accordion" ).accordion({
      collapsible: true
    });
  } );
  </script>

<div class="well well-sm">
	<i class="fa fa-twitter"></i>&nbsp;<b>Get API Twitter</b>
</div>

<form action ="" method="post">
<div class="input-group">
    <input type="text" class="form-control" placeholder="Search" name="keyword" id="keyword">
    <div class="input-group-btn">
      <button class="btn btn-default" type="submit">
        <i class="glyphicon glyphicon-search"></i>
      </button> 
      </div>
  </div>
</form>


<?php

error_reporting(0);
require_once"konmysqli.php";
require_once __DIR__.'/../vendor/twitteroauth/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;

if (isset($_POST['keyword'])){

echo"<form action ='' method='post'>";
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

$i=0;
foreach ($tweets->statuses as $tweet) {
$str_id = $tweet->id_str;
$user = $tweet->user->screen_name;
$text = $tweet->text;
$date = date('Y-m-d h:i:s', strtotime($tweet->created_at));

echo '<table class="table">';
echo '<tr>';

echo '<td>'.$date.'</td>';
// echo '<td><p align="left">'.$user.'</p></td>';
echo '<td><p align="justify">'.$text.'</p></td>';
echo '</tr>';
echo '</table>';
// // echo '<strong>'.$user.'</strong> : '.$text.'< br /><hr />< br />';
echo"<input type='hidden' name='data$i' value='$text'>";
$i++;
}//for
echo"<input type='hidden' name='jum' value='$i'>";
echo" <input type='submit' name='JOKOWI' value='JOKOWI'>";
echo" <input type='submit' name='PRABOWO' value='PRABOWO'>";
// echo" <button class='btn btn-default' type='submit' name='PRABOWO'>PRABOWO</button> ";

echo"</form>";

}



if(isset($_POST["JOKOWI"])){
$jum=$_POST["jum"];
for($i=0;$i<$jum;$i++){
    $tweet=$_POST["data$i"];
    $tanggal=date("Y-m-d");

    $sql="INSERT INTO `table_datauji` (
      `id_datauji`,
      `tweet`,  `kategori`, 
      `tanggal`
      ) VALUES (
      '', 
      '$tweet', '1',
      '$tanggal'
      )";
      $simpan=process($conn,$sql);

}//for
echo"<script>alert('$jum data sukses terSimpan');</script>";
}//submit jkw


elseif(isset($_POST["PRABOWO"])){
  $jum=$_POST["jum"];
for($i=0;$i<$jum;$i++){
    $tweet=$_POST["data$i"];
    $tanggal=date("Y-m-d");

    $sql="INSERT INTO `table_datauji` (
      `id_datauji`,
      `tweet`,  `kategori`, 
      `tanggal`
      ) VALUES (
      '', 
      '$tweet', '2',
      '$tanggal'
      )";
      $simpan=process($conn,$sql);

}//for
echo"<script>alert('$jum data sukses terSimpan');</script>";

}



?>



