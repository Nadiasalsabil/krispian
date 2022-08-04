<?php
$pro="simpan";
$tanggal=WKT(date("Y-m-d"));
$K=19;
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
	<i class="fa fa-twitter" size="24"></i>&nbsp;Data Twitter Pilpres 2019
</div>

<div class="well well-sm">
<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>&nbsp;Input Data Tweet</button>
<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal1"><i class="fa fa-upload"></i>&nbsp;Import Data Tweet.csv</button>
<a href="?mnu=tweet&gen=ok" class="btn btn-danger btn-sm">
	<i class="fa fa-gear"></i>&nbsp;Proses Analisa Data Tweet</button>
</a>
</div>



<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
 <!-- Modal content-->
 <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Tweet</h4>
      </div>
      <div class="modal-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="tweet">Masukkan Tweet:</label>
                <textarea class="form-control" rows="5" id="judul" name="judul"></textarea>
            </div>

             <div class="form-group">
                <label for="tweet">No Urut Paslon:</label>
                <input type="text" class="form-control" id="kate" name="kate" placeholder="Ex : 1">
            </div>

            <button type="submit" class="btn btn-info" id="simpan" name="simpan">Simpan</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>




<!-- Modal -->
<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog">
 <!-- Modal content-->
 <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Tweet</h4>
      </div>
      <div class="modal-body">
        <form action="" method="post" name="form1" enctype="multipart/form-data" >
            <div class="form-group">
                <label for="tweet">Import Tweet:</label>
                <input type="file" class="form-control" name="excelfile">
            </div>
            <div class="form-group">
                <label for="tweet">No Urut Paslon:</label>
                <input type="text" class="form-control" id="kate" name="kate" placeholder="Ex : 1">
            </div>

            <input type="submit" class="btn btn-success" id="form_submit" name="form_submit" value="Upload Data">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<?php
if (isset($_POST['simpan'])) 
{
    $tanggal=date("Y-m-d");
    $judul = $_POST['judul'];
    $kate = $_POST['kate'];
	


	$add = "INSERT INTO table_datauji (id_datauji, tweet, tanggal, kategori)
	VALUES ('','$judul','$tanggal', '$kate')";
	$query = mysqli_query($conn, $add) or die(mysqli_error($conn));

	if($query){
	echo "<script>alert('Success! Data Added');</script>";
	echo "<script>location='index.php?mnu=tweet';</script>";
    }
    else{
        echo "<script>alert('Success! Data Added');</script>";
        echo "<script>location='index.php?mnu=tweet';</script>"; 
    }
}

?>

<?php
 if(isset($_POST['form_submit'])){
    $tanggal=date("Y-m-d");
    $kate = $_POST['kate'];
		require_once 'Excel/reader.php';
		$data = new Spreadsheet_Excel_Reader();
		$data->setOutputEncoding('CP1251');
		$filename = $_FILES['excelfile']['tmp_name'];
		$data->read($filename);//'Book1.xls');
    $n=0;
		for ($x = 2; $x <= count($data->sheets[0]["cells"]); $x++) {
			// $id_datauji = $data->sheets[0]["cells"][$x][1];
			$tweet= $data->sheets[0]["cells"][$x][1];

			//NIDN Nama Dosen	JK	Status Pegawai	Pendidikan Terakhir	Jabatan Akademik	ID Prodi	Jenj. Pend. Prodi	Nama Prodi


	$n++;
	$sql="INSERT INTO `table_datauji` (
        `id_datauji`,
        `tweet`, 
        `tanggal`,
        'kategori'
        ) VALUES (
        '$id_datauji', 
        '$tweet',
        '$tanggal',
        '$kate'

        )";
	
$simpan=process($conn,$sql);
 
 }//for
 
 
 echo "<script>alert('Import Berhasil sebanyak $n data !');document.location.href='?mnu=tweet';</script>";

 }
?>




                       <div class="table-responsive">
                     <table class="table table-striped" id="example1">
                        <thead>
                            <tr>  
                                <th><center>No</center></th>
                                <th><center>Tanggal</center></th>
                                <th><center>Tweet</center></th>
                                <th><center>Detail Analisa Data</center></th>
                            </tr>
                            </tr>
                        </thead>
                        <tbody>
                        <?php  
                           $query = mysqli_query($conn, "SELECT * FROM  `$tbdatauji` where kategori = 0 order by `id_datauji` asc")or die(mysqli_error($conn));
                           $no = 1;        
                           while($data = mysqli_fetch_array($query)){  
						                $id_datauji=$data["id_datauji"];
                               echo '<tr>';
                               echo '<td>'.$no.'</td>';
                               echo '<td>'.$data['tanggal'].'</td>';
                               echo '<td><p align="justify">'.$data['tweet'].'</p></td>';
                               echo "<td><center>
							   <a href='index.php?mnu=knn&id=$id_datauji'><button type='button' class='btn btn-warning btn-sm'>
							   <i class='fa fa-eye'></i></button></a></center></td>";
                               $no++;  
                           }
                          

                        ?>
                        
                      
                        </tbody>
                    </table>

<?php
if(isset($_GET["gen"])){

  // echo "<script>alert('Data Sedang di Proses Harap Menunggu....')</script>";
  echo "
      <div class='alert alert-warning alert-dismissible'>
      <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
      <strong> Data Sedang Diproses Harap Tunggu Jangan Keluar Dari halaman ini, tunggu hingga selesai...</strong> 
      </div>


   ";

require_once __DIR__ . '/vendor/autoload.php';

//error_reporting(0);
			
$initos = new \Sastrawi\Stemmer\StemmerFactory();
$bikinos = $initos->createStemmer();
	$ak=getStopNumber();
	$ar=getStopWords();

$nomor=0;
 $sql0="select * from `$tbdatauji` where flag='0' order by `id_datauji` asc ";		//		limit 0,10			
	$arr0=getData($conn,$sql0);
		foreach($arr0 as $d0) {	
				$nomor++;		
				$id_datauji=$d0["id_datauji"];
				$tweet=$d0["tweet"];
	
$tweetuji=Netral($bikinos,$tweet,$ak,$ar);
//=====================================================	
$stemming=$tweetuji;
 ?>
 
<!-- <table id="table"> -->
<!-- <tr>
<td><label for="status">Tweet <?php echo $nomor;?></label>
<td>:<td colspan="2"><?php echo $tweet;?>
</td></tr> -->
 
 <!-- <tr>
<td><label for="status">Stemming</label>
<td>:<td colspan="2"><?php echo $stemming;?>
</td></tr>
</table> -->


<?php
 //======================================		
 $sql="select * from `$tbdatalatih`  order by `id_dataset` asc 	limit 0,350	";		//		limit 0,10			
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
            if($HPRO[$a] < $HPRO[$a + 1] ){
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
		 		
$gab3="<table border='1'><tr><td>No<td>Tweet<td>Prosentase<td>Sentimen<td>Kategori</tr>";
		 for($i = 0; $i < $array_count; $i++){
			 $no=$i+1;
			 $gab3.="<tr><td>$no<td>$HarTweet[$i]<td>$HPRO[$i]<td>$HPROK[$i]<td>$HarKat[$i]</tr>"; 
				//  if($HPROK[$i]==-1){$k1++;}
				//  else if($HPROK[$i]==0){$k2++;}
				//  else if($HPROK[$i]==1){$k3++;}
		 }
$gab3.="</table><hr>";
//"CETAK";

for($knn= 0; $knn < $K; $knn++){
	if($HPROK[$knn]==-1){$k1++;}
	else if($HPROK[$knn]==0){$k2++;}
	else if($HPROK[$knn]==1){$k3++;}
}

$max=100;
$smax="?";
if ($k1>=$k2 && $k1>=$k3){$max=-1;$smax="Negatif";}
else if ($k2>=$k1 && $k2>=$k3){$max=0;$smax="Netral";}
else if ($k3>=$k2 && $k3>=$k1){$max=1;$smax="Positif";}

$gab4="<h1>Dengan K: $K, Kesimpulan :".$max." /$smax</h1>";
//"CETAK";

// echo $gab1;  
// echo $gab2;  
// echo $gab3;  
// echo $gab4;  



$tanggal=date("Y-m-d");
$kategori=$HarKat[0];//01 atau 02
$sentimen=$max;
$sql="Update `$tbdatauji` set normalisasi='$stemming',tanggal='$tanggal',flag='1', sentimen='$sentimen'  where `id_datauji`='$id_datauji'";
$up=process($conn,$sql);

		}//loop dataUji
}//isset


?>
