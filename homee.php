<?php
if (version_compare(phpversion(), "5.3.0", ">=")  == 1)
  error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
else
  error_reporting(E_ALL & ~E_NOTICE);  
  ?>
<?php
session_start();
//error_reporting(0);
require_once"admin/konmysqli.php";
$mnu=$_GET["mnu"];
date_default_timezone_set("Asia/Jakarta");
?>

<?php
$pro="simpan";

$K=13;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sistem Sentimen Analis || Indonesia</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="aset/css/bootstrap.min.css">

    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="aset/css/font-awesome.min.css">

    <!-- ElegantFonts CSS -->
    <link rel="stylesheet" href="aset/css/elegant-fonts.css">

    <!-- themify-icons CSS -->
    <link rel="stylesheet" href="aset/css/themify-icons.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="aset/css/swiper.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="aset/style.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <style>
	*{margin:0px auto;}
	#wrapper{padding:1em 0;}
	#hasil{padding:.5em 0; text-align:center;}
	input#analyze{width:100%; font-size:30px; padding:.5em; border-radius:4px; border:1px solid #ccc;}
	
	img, button{transition:.25s ease; -moz-transition:.25s ease; -webkit-transition:.25s ease; -o-transition:.25s ease;}
	.hide{opacity:0;}
</style>
</head>
<body>
    <header class="site-header">
        <div class="top-header-bar">
            <div class="container">
                <div class="row flex-wrap justify-content-center justify-content-lg-between align-items-lg-center">
                    <div class="col-12 col-lg-8 d-none d-md-flex flex-wrap justify-content-center justify-content-lg-start mb-3 mb-lg-0">
                        <div class="header-bar-email">
                          <b> Sentimen Analisis PILPRES Indonesia 2019 </b>
                        </div><!-- .header-bar-email -->

                      
                    </div><!-- .col -->

                    <div class="col-12 col-lg-4 d-flex flex-wrap justify-content-center justify-content-lg-end align-items-center">
                        <div class="donate-btn">
                            <a href="index.php">KELUAR</a>
                        </div><!-- .donate-btn -->
                    </div><!-- .col -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .top-header-bar -->


   







        <div class="nav-bar">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex flex-wrap justify-content-between align-items-center">
                        <div class="site-branding d-flex align-items-center">
                           <a class="d-block" href="index.html" rel="home"><img class="d-block" src="aset/images/logo.png" alt="logo"></a>
                        </div><!-- .site-branding -->

                        <nav class="site-navigation d-flex justify-content-end align-items-center">
                           
                        </nav><!-- .site-navigation -->

                        <div class="hamburger-menu d-lg-none">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div><!-- .hamburger-menu -->
                    </div><!-- .col -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .nav-bar -->
    </header><!-- .site-header -->


   

    

    <div class="home-page-welcome">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 order-2 order-lg-1">
                    <div class="welcome-content">
                        <header class="entry-header">
                            <h2 class="entry-title">Sistem Sentimen Analisis</h2>
                        </header><!-- .entry-header -->

                        <div class="entry-content mt-5">
                            <p align="justify">
                            Masukkan Isi Komentar atau Pendapat Anda untuk melihat Kategori Sentimen Anda apakah Sentimen Positif,
                            Negatif atau Netral.
                            </p>
                        </div><!-- .entry-content -->

                        <div class="entry-footer mt-5">
                          
                        </div><!-- .entry-footer -->
                    </div><!-- .welcome-content -->
                </div><!-- .col -->

                <div class="col-12 col-lg-6 mt-4 order-1 order-lg-2">
                <br><br><br>
                <form action="" method="post" enctype="multipart/form-data">
                
                    <div class="form-group">
                        <label for="email"><font color="white">Masukkan Komentar</font></label>
                        <textarea class="form-control" rows="5" id="analisis" name="analisis"></textarea>
                    </div>
                    <button type="submit" class="btn btn-info" id="simpan" name="simpan"><font color="white"><b>Analisa Sentimen
                    </b></font></button>
                </form>

                    <?php
                        if (isset($_POST['simpan'])) 
                        {
                        
                            $judul = $_POST['analisis'];

                            
                            require_once __DIR__ . '/Admin/vendor/autoload.php';

                            //error_reporting(0);
                                
                            $initos = new \Sastrawi\Stemmer\StemmerFactory();
                            $bikinos = $initos->createStemmer();
                            $ak=getStopNumber();
                            $ar=getStopWords();

                            $judul=strtolower($judul); 
                            $stemming=$bikinos->stem($judul);
                            $stemmingnew=strtolower($stemming);
                            
                            $ak=getStopNumber();
                            $ar=getStopWords();
                            $wordStop=$stemmingnew;
                            for($i=0;$i<count($ar);$i++){
                            $wordStop =str_replace($ar[$i]." ","", $wordStop); 
                            }

                            for($i=0;$i<count($ak);$i++){
                            $wordStop =str_replace($ak[$i],"", $wordStop); 
                            }
                            $stopword=str_replace("  "," ", $wordStop); 
                            $stemming=trim($stopword);

                            // echo '<font color="red">Kalimat :&nbsp;'. $judul.'</font><br>';
                            // echo '<font color="white">Text Processing:&nbsp;'. $stemming.'</font>';
                            }

                            $sql="select * from `table_datakomen`  order by `no` asc ";		//		limit 0,10			
                            $arr=getData($conn,$sql);
                            $i=0;
                            $arStem[0]=$stemming;
                            $gabungan="";//$stemming." ";
                                foreach($arr as $d) {	
                                        $i++;		
                                        $id_dataset=$d["no"];
                                        $tweet=$d["komentar"];
                                        $normalisasi=$d["stem"];
                                        $sentimen=$d["sentimen"];
                                        
                                        
                                        $gabungan.=$normalisasi." ";
                                        
                                        $arKode[$i]=$id_dataset;
                                        $arTweet[$i]=$tweet;
                                        $arStem[$i]=$normalisasi;
                                        $arSentimen[$i]=$sentimen;
                                       
                                }
                                $jumdoc=$i+1;
                        //======================================
                        
                        error_reporting(0);
                        $arAsli=explode(" ",$gabungan);
                        $arUnix0=array_unique($arAsli);
                        
                        $ii=0;
                        for($i=0;$i<count($arUnix0);$i++){
                            if($arUnix0[$i]==""){}
                            else{
                                $arUnix[$ii]=$arUnix0[$i];
                                $ii++;
                                }
                            }
                            
                        $jumb=count($arUnix);

                        $gab1="<div class='table-responsive'><table class='table table-striped' id='example1'>";
                        $gab1.="<tr><td>Kata";
                        for($i=0;$i<$jumdoc;$i++){
                        $gab1.="<td>D".$i; 
                        }
                        $gab1.="<td>df";
                        $gab1.="<td>d/df";
                        $gab1.="<td>IDF";
                        $gab1.="<td>IDF+1";
                        for($i=0;$i<$jumdoc;$i++){
                            $gab1.="<td>WD".$i; 
                        }


                        for($i=0;$i<$jumdoc;$i++){
                        $gab1.="<td>N".$i;  
                        }
                        for($i=0;$i<$jumdoc;$i++){
                        $gab1.="<td>M".$i; 
                        }
                        $gab1.="</tr>";
                        
                        $bar=count($arUnix);
                        for($i=0;$i<$bar;$i++){
                        $kata=$arUnix[$i];
                        $hitung=0;
                        $gab1.="<tr><td>".$kata."</td>";
                        $jumada=0;
                        
                        for($j=0;$j<$jumdoc;$j++){
                            $ada=getHit2($kata,$arStem[$j]);
                            $M[$i][$j]=$ada;
                                if($ada>0){
                                    $jumada++;
                                }
                            $gab1.="<td>".$ada;
                        }
                        //$dfi=round($jumada/$jumdoc,2); 
                        $dfi=round(($jumdoc)/$jumada,2); 

                        $logs="log($jumada/$jumdoc)"; 
                        $log=round(log($dfi,10),2); 
                        $log=abs($log);
                        $log1=$log+1;
                        $gab1.="<td>".$jumada."</td>";
                        $gab1.="<td>".$dfi."</td>";
                        $gab1.="<td>$log";
                        $gab1.="<td>$log1";
                        
                        for($j=0;$j<$jumdoc;$j++){
                                $N[$i][$j]=$M[$i][$j] * $log1;
                                $N2[$i][$j]=pow($N[$i][$j],2);
                                
                                $TOT[$j]=$TOT[$j]+$N[$i][$j];
                                $gab1.= "<td>".$N[$i][$j];
                        }
                        
                        for($j=0;$j<$jumdoc;$j++){
                        // $NN[$i][$j-1]=$N[$i][0] * $N[$i][$j];
                        //$gab1.= "<td>".$NN[$i][$j-1];
                        $NN[$i][$j]=$N[$i][0] * $N[$i][$j];
                        $gab1.= "<td>".$NN[$i][$j];
                        }


                        for($j=0;$j<$jumdoc;$j++){
                            $gab1.= "<td>".$N2[$i][$j];
                        }
                        
                        $gab1.="</tr>"; 
                        }//for i


                        for($j=0;$j<$jumdoc;$j++){//kolom
                            $TOT1[$j]=0;
                                for($k=0;$k<$bar;$k++){//baris
                                    $TOT1[$j]+=$NN[$k][$j];
                                }
                        }

                            for($j=0;$j<$jumdoc+1;$j++){
                                    $TOT2[$j]=0;
                                    for($k=0;$k<$bar;$k++){//baris
                                            $TOT2[$j]+=$N2[$k][$j];
                                    }
                            }
                        
                        //------------------------------------

                        $gab1.="<tr><td>Q";
                        for($i=0;$i<$jumdoc;$i++){
                        $gab1.="<td>D".$i; 
                        }
                        $gab1.="<td>df";
                        $gab1.="<td>d/df";
                        $gab1.="<td>IDF";
                        $gab1.="<td>IDF+1";
                        for($i=0;$i<$jumdoc;$i++){
                            $gab1.="<td>".$TOT[$i]; 
                        }


                        for($i=0;$i<$jumdoc;$i++){
                        $gab1.="<td>".$TOT1[$i];
                        }
                        for($i=0;$i<$jumdoc;$i++){
                        $gab1.="<td>".$TOT2[$i];
                        }
                        

                        $gab1.="</tr>";

                        //==========================================
                        $gab1.="</table></div>"; 

                        //"CETAK";



                        $statustx="1";
                        $catatan="";
                        $reakpitulasi="";
                        $Q=pow($TOT2[0],0.5);

                        $gab2="Qvalue=$TOT2[0]<sup>0.5</sup> =".$Q."<br><br>";
                        $gab2.="Cosine Similarity Terhadap tiap-tiap dokumen:<br>";


                        for($i=1;$i<$jumdoc;$i++){
                            $E=pow($TOT2[$i],0.5);
                            $ES=$TOT2[$i]."<sup>0.5</sup>";
                            $QS=$TOT2[0]."<sup>0.5</sup>";
                            
                            $D=pow(($TOT1[$i]*$TOT2[0]),0.5);
                            $DS="(".$TOT2[0]." x ".$TOT1[$i].")<sup>0.5</sup>";
                            $H[$i]=$D/($Q * $E)+0;
                            $PRO[$i]=round($H[$i]*100,2);
                            $CS="CSvalue<sub>$i</sub> =$DS/($QS x ".$ES.")";

                            
                                $catatan.=$arTweet[$i]." (".$PRO[$i]." %),";
                                $rekapitulasi.="Sentimen:".$arSentimen[$i]."->CS:".$CS.", ";

                            $PROK[$i]=$arSentimen[$i];
                            //$HS[$i]=$i.".".$arTweet[$i]."<br>&nbsp;&nbsp;&nbsp;<b>Stemming:</b><i>".$arSentimen[$i]."</i>
                            $HS[$i]=$i.".".$arTweet[$i]."</i>
                            <br>$CS";
                            
                            $gab2.=$HS[$i]."<br>";
                            $gab2.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Doc".$i."=>".$H[$i]." =>".$PRO[$i]." %  =<b>".$PROK[$i]."</b><hr>";

                            $HPROK[$i-1]=$PROK[$i];
                            $HPRO[$i-1]=$PRO[$i];
                            $HarKode[$i-1]=$arKode[$i];
                            $HarTweet[$i-1]=$arTweet[$i];
                            $HarStem[$i-1]=$arStem[$i];
                            $HarSentimen[$i-1]=$arSentimen[$i];
                            
                        }
                        
                        //"CETAK";

                        
                        $array_count = count($HPROK);
                                for($x = 0; $x < $array_count; $x++){
                                    for($a = 0 ;  $a < $array_count - 1 ; $a++){
                                        if($a < $array_count ){
                                            if($HPRO[$a] < $HPRO[$a + 1] ){
                                                    swap($HPROK, $a, $a+1);
                                                    swap($HPRO, $a, $a+1);
                                                        swap($HarKode, $a, $a+1);
                                                        swap($HarTweet, $a, $a+1);
                                                            swap($HarStem, $a, $a+1);
                                                            swap($HarSentimen, $a, $a+1);
                                                               
                                                        }
                                        }
                                    }
                                }
                                
                        $k1=0;
                        $k2=0;
                        $k3=0;
                                        
                        $gab3="<table class='table'><tr><td>No<td>Tweet<td>Prosentase<td>Sentimen</tr>";
                                for($i = 0; $i < $array_count; $i++){
                                    $no=$i+1;
                                    $gab3.="<tr><td>$no<td>$HarTweet[$i]<td>$HPRO[$i]<td>$HPROK[$i]</tr>"; 
                                    
                                        //  if($HPROK[$i]==-1){$k1++;}
                                        //  else if($HPROK[$i]==0){$k2++;}
                                        //  else if($HPROK[$i]==1){$k3++;}
                                        for($knn= 0; $knn < $K; $knn++){
                                            if($HPROK[$knn]==-1){$k1++;}
                                            else if($HPROK[$knn]==0){$k2++;}
                                            else if($HPROK[$knn]==1){$k3++;}
                                        }
                                }
                        $gab3.="</table><hr>";
                  


                        // $max=0;
                        $smax="?";
                        if ($k1>=$k2 && $k1>=$k3){$max=-1;$smax="Negatif";}
                        else if ($k2>=$k1 && $k2>=$k3){$max=0;$smax="Netral";}
                        else if ($k3>=$k2 && $k3>=$k1){$max=1;$smax="Positif";}

                        $gab4="<h5>$smax</h5>";
                        // $gab4="<h4>$smax</h4>";
                        //"CETAK";

                        // echo $gab1;  
                        // echo $gab2;  
                        // echo $gab3;  
                        // echo '<font color="white">'.$gab4.'</font>';  

                        if($smax=='Positif' && !empty($judul) ){
                            echo '<br><font color="white"><b>Kalimat Anda :</b>&nbsp;&nbsp;'.$judul.'</font><br>';
                            echo '<br><div class="alert alert-info">
                                   Komentar Anda Positif
                          </div>';
                        }
                        elseif($smax=='Netral' && !empty($judul)){
                            echo '<br><font color="white"><b>Kalimat Anda :</b>&nbsp;&nbsp;'.$judul.'</font><br>';
                            echo '<br><div class="alert alert-success">
                            Komentar Anda Netral 
                          </div>';
                        }
                        elseif($smax=='Negatif'  && !empty($judul)){
                            echo '<br><font color="white"><b>Kalimat Anda :</b>&nbsp;&nbsp;'.$judul.'</font><br>';
                            echo '<br><div class="alert alert-danger">
                            Komentar Anda Negatif 
                          </div>';
                        }
                        


                        $sentimen=$max;
                        
                        $add = "INSERT INTO skripsi_rekap (no, komentar,stem,sentimen)
                        VALUES ('','$judul','$stemming','$sentimen')";
                        $query = mysqli_query($conn, $add) or die(mysqli_error($conn));

                        // echo '<font color="white">'.$add.'</font>';  
                    

                    ?>






                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .home-page-icon-boxes -->
   


        <div class="footer-bar">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <p class="m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Nadia Salsabil 2015230057
                        </p>
                    </div><!-- .col-12 -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .footer-bar -->
    </footer><!-- .site-footer -->




























<?php
function process($conn,$sql){
$s=false;
$conn->autocommit(FALSE);
try {
  $rs = $conn->query($sql);
  if($rs){
      $conn->commit();
      $last_inserted_id = $conn->insert_id;
    $affected_rows = $conn->affected_rows;
      $s=true;
  }
} 
catch (Exception $e) {
  echo 'fail: ' . $e->getMessage();
    $conn->rollback();
}
$conn->autocommit(TRUE);
return $s;
}

function getJum($conn,$sql){
  $rs=$conn->query($sql);
  $jum= $rs->num_rows;
  $rs->free();
  return $jum;
}

function getField($conn,$sql){
  $rs=$conn->query($sql);
  $rs->data_seek(0);
  $d= $rs->fetch_assoc();
  $rs->free();
  return $d;
}

function getData($conn,$sql){
	//echo "##".$sql."##";
  $rs=$conn->query($sql);
  $rs->data_seek(0);
  $arr = $rs->fetch_all(MYSQLI_ASSOC);
  //foreach($arr as $row) {
  //  echo $row['nama_kelas'] . '*<br>';
  //}
  
  $rs->free();
  return $arr;
}


function getHit($kal,$kalimat){
$ada=0;
if(preg_match("/$kal/i", $kalimat)) {
	$ada=1;
	}
	return $ada;
}


 function getHit2($kal,$kalimat){
	//echo $kal."=".$kalimat."#<br>";
  $ar=explode(" ",$kalimat);
  $ada=0;
  for($i=0;$i<count($ar);$i++){
  	 if($kal==$ar[$i]){$ada++;}
   }//for
  return $ada;
  } 
 ?>
  
    <?php
function swap(&$arr, $a, $b) {
    $tmp = $arr[$a];
    $arr[$a] = $arr[$b];
    $arr[$b] = $tmp;
}
?>
    
    
    

<?php
function getStopWords()
    {
        return array(
            'yang', 'untuk', 'pada', 'ke', 'para', 'namun', 'menurut', 'antara', 'dia', 'dua',
            'ia', 'seperti', 'jika', 'jika', 'sehingga', 'kembali', 'dan', 'tidak', 'ini', 'karena',
            'kepada', 'oleh', 'saat', 'harus', 'sementara', 'setelah', 'belum', 'kami', 'sekitar',
            'bagi', 'serta', 'di', 'dari', 'telah', 'sebagai', 'masih', 'hal', 'ketika', 'adalah',
            'itu', 'dalam', 'bisa', 'bahwa', 'atau', 'hanya', 'kita', 'dengan', 'akan', 'juga',
            'ada', 'mereka', 'sudah', 'saya', 'terhadap', 'secara', 'agar', 'lain', 'anda',
            'begitu', 'mengapa', 'kenapa', 'yaitu', 'yakni', 'daripada', 'itulah', 'lagi', 'maka',
            'tentang', 'demi', 'dimana', 'kemana', 'pula', 'sambil', 'sebelum', 'sesudah', 'supaya',
            'guna', 'kah', 'pun', 'sampai', 'sedangkan', 'selagi', 'sementara', 'tetapi', 'apakah',
            'kecuali', 'sebab', 'selain', 'seolah', 'seraya', 'seterusnya', 'tanpa', 'agak', 'boleh',
            'dapat', 'dsb', 'dst', 'dll', 'dahulu', 'dulunya', 'anu', 'demikian', 'tapi', 'ingin',
            'juga', 'nggak', 'mari', 'nanti', 'melainkan', 'oh', 'ok', 'seharusnya', 'sebetulnya',
            'setiap', 'setidaknya', 'sesuatu', 'pasti', 'saja', 'toh', 'ya', 'walau', 'tolong',
            'tentu', 'amat', 'apalagi', 'bagaimanapun'
        );
    }


function getStopNumber()
    {
        return array(
            '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '!', '@', '#', '$', '%','-'
        );
    }
 
 
function Netral($bikinos,$tweet,$ak,$ar){
	$tweetkal=strtolower($tweet);
	$stemming=$bikinos->stem($tweetkal);
	$stemmingnew=strtolower($stemming);

$wordStop=$stemmingnew;
for($i=0;$i<count($ar);$i++){
 $wordStop =str_replace(" ".$ar[$i]." "," ", $wordStop); 
}

for($i=0;$i<count($ak);$i++){
 $wordStop =str_replace($ak[$i],"", $wordStop); 
}
$tweetuji=str_replace("  "," ", $wordStop); 
return $tweetuji;
}


function getUnix($array){
error_reporting(0);
$unique = array_flip(array_flip($array));
//print_r($unique);
$jd=count($array);
//echo $jd."#<br>";
$m=0;
for($i=0;$i<$jd;$i++){
 if(strlen($unique[$i])>0){
  //echo "$m =".$unique[$i]."<br>";
  $M[$m]=$unique[$i];
  $m++;
 }
}
 return $M;
}
?>




<script>
function reloadpage()
{
location.reload()
}
</script>




























    <script>
	$(function(){
		$("#analyze").on("keypress",function(e){
			if(e.which == 13){
				$("img").removeClass("hide");
				$.ajax({
					url : "api.php",
					method : "GET",
					data : {q : $("#analyze").val()},
					dataType : "json"
				}).done(function(data){
					$("img").addClass("hide");
					if(data['error'] == 0){
						if(data['sentiment'] == 1){
							vclass = 'alert-success';
						}
						else{
							vclass = 'alert-warning';
						}
						$("#out").html("<div class='alert "+vclass+"'>"+data['message']+"</div>");
						$("input[name=unique_id]").val(data['unique_id']);
					}
					else{
						$("#out").html("<div class='alert alert-info'>"+data['message']+"</div>");
					}
				});
			}
		});
		$("#refresh").click(function(){
			location.reload();
		});
	});
</script>
    <script type='text/javascript' src='aset/js/jquery.js'></script>
    <script type='text/javascript' src='aset/js/jquery.collapsible.min.js'></script>
    <script type='text/javascript' src='aset/js/swiper.min.js'></script>
    <script type='text/javascript' src='aset/js/jquery.countdown.min.js'></script>
    <script type='text/javascript' src='aset/js/circle-progress.min.js'></script>
    <script type='text/javascript' src='aset/js/jquery.countTo.min.js'></script>
    <script type='text/javascript' src='aset/js/jquery.barfiller.js'></script>
    <script type='text/javascript' src='aset/js/custom.js'></script>
    <script src="assets/jquery-1.12.3.min.js"></script>
    <script src="assets/less-1.3.3.min.js"></script>

</body>
</html>