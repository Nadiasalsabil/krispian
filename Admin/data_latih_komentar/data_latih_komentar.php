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
	Data Latih Pilpres 2019
</div>
<div class="well well-sm">
<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>&nbsp;Input Data Latih</button>
<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal1"><i class="fa fa-upload"></i>&nbsp;Import Data Latih</button>
</div>


                       <div class="table-responsive">
                     <table class="table table-striped" id="example1">
                        <thead>
                            <tr>  
                                <th>no</th>
                                <th>Kalimat</th>
                                <th>Normalisasi</th>
                                <th>Sentimen</th>
                                <th>Edit</th>
                                <th>Hapus</th>

                            </tr>
                            </tr>
                        </thead>
                        <tbody>
                        <?php  
                           $query = mysqli_query($conn, "SELECT * FROM  `table_datakomen` order by `id_datakomen` desc")or die(mysqli_error($conn));
                           $no = 1;        
                           while($data = mysqli_fetch_array($query)){  
                               echo '<tr>';
                               echo '<td>'.$no.'</td>';
                              
                               echo '<td><p align="justify">'.$data['kalimat'].'</p></td>';
                               echo '<td><p align="justify">'.$data['normalisasi'].'</p></td>';
                               echo '<td><center>'.$data['kategoori'].'</center></td>';
                               echo '<td><a href="?mnu=edit_komen&&id='.$data['no'].'" class="btn btn-warning btn-xs" role="button"><i class="fa fa-edit"></i></a></td>';
                               echo '<td><a href="config/deletekomen.php?id='.$data['no'].'" class="btn btn-danger btn-xs" role="button"><i class="fa fa-trash"></i></a></td>';
                               
                               $no++;  
                           }
                          

                        ?>
                        
                      
                        </tbody>
                    </table>

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
                <label for="tweet">Masukkan data latih:</label>
                <textarea class="form-control" rows="5" id="judul" name="judul"></textarea>
            </div>
            <div class="form-group">
                <label for="tweet">Sentimen:</label>
                <input type="text" class="form-control" name="sentimen">
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

<?php
if (isset($_POST['simpan'])) 
{
   
    $judul = $_POST['judul'];
    $kategori = $_POST['kategori'];
    $sentimen = $_POST['sentimen'];
	
    require_once __DIR__ . '/../vendor/autoload.php';

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

	$add = "INSERT INTO table_datakomen (no, komentar,sentimen,stem)
	VALUES ('','$judul','$sentimen','$stemming')";
	$query = mysqli_query($conn, $add) or die(mysqli_error($conn));

	if($query){
	echo "<script>alert('Success! Data Added');</script>";
	echo "<script>location='index.php?mnu=data_latih_komentar';</script>";
    }
    else{
        echo "<script>alert('Success! Data Added');</script>";
        echo "<script>location='index.php?mnu=data_latih_komentar';</script>"; 
    }
}






?>




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
    $tanggal=date("Y-m-d");
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

			//NIDN Nama Dosen	JK	Status Pegawai	Pendidikan Terakhir	Jabatan Akademik	ID Prodi	Jenj. Pend. Prodi	Nama Prodi
      require_once __DIR__ . '/../vendor/autoload.php';

      //error_reporting(0);
            
      $initos = new \Sastrawi\Stemmer\StemmerFactory();
      $bikinos = $initos->createStemmer();
        $ak=getStopNumber();
        $ar=getStopWords();
  
  
  
        $tweet=strtolower($tweet); 
        $stemming=$bikinos->stem($tweet);
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

	$n++;
	$sql="INSERT INTO `table_datakomen` (
        `no`,
        `komentar`, 
        `stem`,
        `sentimen`
        ) VALUES (
        '$id_dataset', 
        '$tweet',
        '$stemming',
        '$label'

        )";
	
$simpan=process($conn,$sql);
 
 }//for
 
 
 echo "<script>alert('Import Berhasil sebanyak $n data !');document.location.href='?mnu=data_latih';</script>";

 }
?>