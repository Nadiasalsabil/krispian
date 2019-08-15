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
	Edit Data Latih
</div>

<?php
$edit="SELECT * FROM  `$tbdatalatih` WHERE id_dataset='$_GET[id]'";
$hasil=mysqli_query($conn,$edit)or die(mysqli_error($conn));
$data=mysqli_fetch_array($hasil);
?>

 <form action="" method="post" enctype="multipart/form-data">
	<div class="form-group row">
	    <input type="hidden" class="form-control" id="id" name="id" value=<?php echo $data['id_dataset']; ?>>
	</div>

    <div class="form-group row">
        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Tweet </label>
            <div class="col-sm-9">
                <textarea class="form-control" id="judul" name="judul" rows="5"><?php echo $data['tweet']; ?></textarea>
                    </div>
                        </div>

     <div class="form-group row">
        <label class="col-sm-3 col-form-label">Nilai Sentimen</label>
            <div class="col-sm-9">
                <select class="form-control"  id="sentimen" name="sentimen">
                    <option value="1">Positif</option>
                    <option value="0">Netral</option>
                    <option value="-1">Negatif</option>
                </select>
            </div>
        </div>

         <button type="submit" class="btn btn-warning mr-2" name="simpan" id="simpan">Simpan</button>
</form>

<?php
if (isset($_POST['simpan'])) 
{
   
    $judul = $_POST['judul'];
    $sentimen = $_POST['sentimen'];
    $id=$_POST['id'];
	
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

	 $update     = "UPDATE table_dataset SET tweet='$judul',sentimen='$sentimen',normalisasi='$stemming' WHERE id_dataset='$id'";
   $query = mysqli_query($conn, $update) or die(mysqli_error($conn));
  
     

	if($query){
	echo "<script>alert('Success! Data Update');</script>";
	echo "<script>location='index.php?mnu=data_latih';</script>";
    }
    else{
        echo "<script>alert('Failed! Data Added');</script>";
        echo "<script>location='index.php?mnu=data_latih';</script>"; 
    }
}

?>