<?php
$pro="simpan";
$tanggal=WKT(date("Y-m-d"));
$K = 13;
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
	Data Testing Akurasi 
</div>
<div class="well well-sm">
<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal1"><i class="fa fa-upload"></i>&nbsp;Import Data Testing</button>
</div>


 <div class="table-responsive">
                     <table class="table table-striped" id="example1">
                        <thead>
                            <tr>  
                                <th>no</th>
                                
                                <th>Tweet</th>
                                <th>Sentimen</th>
                                <th>Hasil Pengujian Metode</th>
                                <th>Edit</th>
                                <th>Hapus</th>

                            </tr>
                            </tr>
                        </thead>
                        <tbody>
                        <?php  
                           $query = mysqli_query($conn, "SELECT * FROM  tbl_datatesting order by `id_datatesting` asc")or die(mysqli_error());
                           $no = 1;        
                           while($data = mysqli_fetch_array($query)){  
                               echo '<tr>';
                               echo '<td>'.$no.'</td>';
                              
                               echo '<td><p align="justify">'.$data['tweet'].'</p></td>';?>
                               <!-- echo '<td><center>'.$data['sentimen'].'</center></td>'; -->
                                  <td> <?php if($data['sentimen']==1){
                                    echo "<font color='blue'>Positif</font>";

                                  }elseif($data['sentimen']==0){
                                    echo "<font color='green'>Netral</font>";
                                  }else{
                                    echo "<font color='red'>Negatif</font>";
                                  }?></td>

                                    <td> <?php if($data['labelpengujian']==1){
                                    echo "<font color='blue'>Positif</font>";

                                  }elseif($data['labelpengujian']==0){
                                    echo "<font color='green'>Netral</font>";
                                  }else{
                                    echo "<font color='red'>Negatif</font>";
                                  }?></td>
                              
                               <?php
                                echo '<td><a href="?mnu=editdatatesting&&id='.$data['id_datatesting'].'" class="btn btn-warning btn-xs" role="button"><i class="fa fa-edit"></i></a></td>';
                                echo '<td><a href="config/deletedatatesting.php?id='.$data['id_datatesting'].'" class="btn btn-danger btn-xs" role="button"><i class="fa fa-trash"></i></a></td>';
                               $no++;  
                           }
                          

                        ?>
                        
                      
                        </tbody>
                    </table>

                    <form action="" method="post">
<input name="Uji" type="Submit" id="Uji" title="Uji Semua data Angket yang belum memiliki Label" value="Uji AKURASI" />
 </form>

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
            <input type="submit" class="btn btn-success" id="form_simpan" name="form_simpan" value="Upload Data">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<?php
 if(isset($_POST['form_simpan'])){
   
		require_once 'Excel/reader.php';
		$data = new Spreadsheet_Excel_Reader();
		$data->setOutputEncoding('CP1251');
		$filename = $_FILES['excelfile']['tmp_name'];
		$data->read($filename);//'Book1.xls');
    $n=0;
		for ($x = 2; $x <= count($data->sheets[0]["cells"]); $x++) {
			// $id_datauji = $data->sheets[0]["cells"][$x][1];
      $tweet= $data->sheets[0]["cells"][$x][1];
      $label= $data->sheets[0]["cells"][$x][2];


	$n++;
	$sql="INSERT INTO `tbl_datatesting` (
        `id_datatesting`,
        `tweet`, 
        `sentimen`
        
        ) VALUES (
        '$id_datatesting', 
        '$tweet',
        '$label'
        

        )";
	
$simpan=mysqli_query($conn,$sql);


 }//for
 
 
 echo "<script>alert('Import Berhasil sebanyak $n data !');document.location.href='?mnu=datatesting';</script>";

 }
?>



<?php
if(isset($_POST["Uji"])){
    require_once __DIR__ . '/../vendor/autoload.php';
	$initos = new \Sastrawi\Stemmer\StemmerFactory();
$bikinos = $initos->createStemmer();
	$ak=getStopNumber();
	$ar=getStopWords();

$nomor=0;
 $sql0="select * from `tbl_datatesting`  order by `id_datatesting` asc limit 0,45";		//		limit 0,10			
	$arr0=getData($conn,$sql0);
		foreach($arr0 as $d0) {	
				$nomor++;		
				$id_datauji=$d0["id_datatesting"];
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
 $sql="select * from `$tbdatalatih`  order by `id_dataset` asc limit 0,120";		//		limit 0,10			
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
		 		
$gab3="<table class='table'><tr><td>No<td>Tweet<td>Prosentase<td>Sentimen<td>Kategori</tr>";
		 for($i = 0; $i < $array_count; $i++){
			 $no=$i+1;
			 $gab3.="<tr><td>$no<td>$HarTweet[$i]<td>$HPRO[$i]<td>$HPROK[$i]<td>$HarKat[$i]</tr>"; 
			 
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
//"CETAK";

// for($knn= 0; $knn < $K; $knn++){
// 	if($HPROK[$knn]==-1){$k1++;}
// 	else if($HPROK[$knn]==0){$k2++;}
// 	else if($HPROK[$knn]==1){$k3++;}
// }

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
$sql="Update `tbl_datatesting` set normalisasi='$stemming', labelpengujian = '$sentimen' where `id_datatesting`='$id_datauji'";
$up=process($conn,$sql);


		}	


        
        $TP=0;
        $TN=0;
        $TNET=0;
        $FP=0;
        $FN=0;
        $FNET=0;
        $sqlr="select * from `tbl_datatesting` order by `id_datatesting` asc limit 0,45";
        $jumk=getJum($conn,$sqlr);
        if( $jumk>0){
        
            $arrw=getData($conn,$sqlr);
                foreach($arrw as $dw) {							
                        $id_datatesting=$dw["id_datatesting"];
                        $sentimen=$dw["sentimen"];
                        $labelpengujian=$dw["labelpengujian"];
                       
        
           
                        
                        
        if($sentimen==$labelpengujian && $sentimen=="1"){$TP++;}
        else if($sentimen!=$labelpengujian && $sentimen=="1"){$FP++;}
        
        if($sentimen==$labelpengujian && $sentimen=="-1"){$TN++;}
        else if($sentimen!=$labelpengujian && $sentimen=="-1"){$FN++;}

        if($sentimen==$labelpengujian && $sentimen=="0"){$TNET++;}
        else if($sentimen!=$labelpengujian && $sentimen=="0"){$FNET++;}
                
                }
                
                        
        
        
        if( $jumk>0){
                        
          echo"</table> <br>";
          
        
            echo"<h4><b>--AKURASI--</b></h4>";
        
            echo"<table class='table table-striped'>";
            
                echo"<tr bgcolor='#bbbbbb'><td><b>Kelas</b></td><td><b>Terklasifikasi Positif</b></td><td><b>Terklasifikasi Negatif</b></td><td><b>Terklasifikasi Netral</b></td>";
                echo"<tr><td><b>Positif</b></td><td>$TP</td><td>$TN</td><td>$TNET</td>";
                echo"<tr><td><b>Negatif</b></td><td>$FP</td><td>$FN</td><td>$FNET";
            
            echo"</table>";
            
        
            $hasil=(($TP+$TN+$TNET)/($TP+$TN+$TNET+$FP+$FN+$FNET)) *100;
            $shasil="(($TP+$TN+$TNET)/($TP+$TN+$TNET+$FP+$FN+$FNET)) *100";
            
        
            echo "<b>Akurasi : $hasil %</b>";
        
        }
    }









        

}
 




?>