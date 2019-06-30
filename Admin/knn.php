<?php
$pro="simpan";
$tanggal=WKT(date("Y-m-d"));
$K=5;
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
<style>
#table {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
	background-color:#ddd;
	
}

#table td, #table th {
    border: 1px solid #696969;
    padding: 8px;
}



#table th {
	 padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #A9A9A9;
    color: white;
}
</style>
<script type="text/javascript"> 
function PRINT(){ 
win=window.open('pengajuan/print.php','win','width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0'); } 
</script>
<script language="JavaScript">
function buka(url) {window.open(url, 'window_baru', 'width=800,height=600,left=320,top=100,resizable=1,scrollbars=1');}
</script>

<?php
	$id_datauji=$_GET["id"];
	 $sql="select * from `$tbdatauji` where `id_datauji`='$id_datauji'";
	$d=getField($conn,$sql);
				$id_datauji=$d["id_datauji"];
				$id_datauji0=$d["id_datauji"];
				
				$tanggal=WKT($d["tanggal"]);
				$tweet=$d["tweet"];//tweet
				$normalisasi=$d["normalisasi"];
				$kategori=$d["kategori"];
				$sentimen=$d["sentimen"];

?>
    <link rel="stylesheet" href="jsacor/jquery-ui.css">
    <link rel="stylesheet" href="resources/demos/style.css">
    <script src="jsacor/jquery-1.12.4.js"></script>
    <script src="jsacor/jquery-ui.js"></script>
    <script>
    $( function() {
    $( "#accordion" ).accordion({
    collapsible: true
    });
    } );
    </script>
<div id="accordion">
  <h4>Analisa TF IDF Data</h4>
  <div>



<?php
require_once __DIR__ . '/vendor/autoload.php';

//error_reporting(0);
			
$initos = new \Sastrawi\Stemmer\StemmerFactory();
$bikinos = $initos->createStemmer();
	$ak=getStopNumber();
	$ar=getStopWords();

$tweetuji=Netral($bikinos,$tweet,$ak,$ar);
//=====================================================	
$stemming=$tweetuji;
 ?>
 
<table id="table">
<tr>
<td><label for="status">Tweet</label>
<td>:<td colspan="2"><?php echo $tweet;?>
</td></tr>
 
 <tr>
<td><label for="status">Stemming</label>
<td>:<td colspan="2"><?php echo $stemming;?>
</td></tr>
</table>


<?php
 //======================================		
 $sql="select * from `$tbdatalatih`  order by `id_dataset` asc limit 0,5";		//		limit 0,10			
	$arr=getData($conn,$sql);
	$i=0;
	$arStem[0]=$stemming;
	$gabungan="";//$stemming." ";
		foreach($arr as $d) {	
				$i++;		
				$id_dataset=$d["id_dataset"];
				$tweet=$d["tweet"];
				$normalisasi=$d["normalisasi"];
				$sentimen=$d["sentimen"];
				$kategori=$d["kategori"];
				
				$gabungan.=$normalisasi." ";
				
				$arKode[$i]=$id_dataset;
				$arTweet[$i]=$tweet;
				$arStem[$i]=$normalisasi;
				$arSentimen[$i]=$sentimen;
				$arKat[$i]=$kategori;
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

$gab1="<table width='100%' border='1'>";
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
 $dfi=round($jumada/$jumdoc,2); 
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
    $NN[$i][$j-1]=$N[$i][0] * $N[$i][$j];
    $gab1.= "<td>".$NN[$i][$j-1];
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
$gab1.="</table>"; 

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
	$HarKat[$i-1]=$arKat[$i];
 }
 
//"CETAK";


 $array_count = count($HPROK);
        for($x = 0; $x < $array_count; $x++){
            for($a = 0 ;  $a < $array_count - 1 ; $a++){
                if($a < $array_count ){
                    if($HPRO[$a] > $HPRO[$a + 1] ){
                            swap($HPROK, $a, $a+1);
							  swap($HPRO, $a, $a+1);
							    swap($HarKode, $a, $a+1);
								  swap($HarTweet, $a, $a+1);
								    swap($HarStem, $a, $a+1);
									  swap($HarSentimen, $a, $a+1);
									    swap($HarKat, $a, $a+1);
                    }
                }
            }
        }

		 
$k1=0;
$k2=0;
$k3=0;
		 		
$gab3="<table border='1'><tr><td>No<td>Tweet<td>Prosentase<td>Sentimrn<td>Kategori</tr>";
		 for($i = 0; $i < $array_count; $i++){
			 $no=$i+1;
			 $gab3.="<tr><td>$no<td>$HarTweet[$i]<td>$HPRO[$i]<td>$HPROK[$i]<td>$HarKat[$i]</tr>"; 
				 if($HPROK[$i]==-1){$k1++;}
				 else if($HPROK[$i]==0){$k2++;}
				 else if($HPROK[$i]==1){$k3++;}
		 }
$gab3.="</table><hr>";
//"CETAK";

$max=100;
$smax="?";
if ($k1>=$k2 && $k1>=$k3){$max=-1;$smax="Negatif";}
else if ($k2>=$k1 && $k2>=$k3){$max=0;$smax="Netral";}
else if ($k3>=$k2 && $k3>=$k1){$max=1;$smax="Positif";}

$gab4="<h1>Dengan K: $K, Kesimpulan :".$max." /$smax</h1>";
//"CETAK";

echo $gab1;  
echo $gab2;  
echo $gab3;  
echo $gab4;  

$tanggal=date("Y-m-d");
$kategori=$HarKat[0];//01 atau 02
$sentimen=$max;
$sql="Update `$tbdatauji` set normalisasi='$sentimen',kategori='$kategori',tanggal='$tanggal', sentimen='$sentimen',flag='1'  where `id_datauji`='$id_datauji'";
$up=process($conn,$sql);	
?>


</div>


</div>

