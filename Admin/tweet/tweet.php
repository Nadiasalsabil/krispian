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
	<i class="fa fa-twitter" size="24"></i>&nbsp;Data Twitter Pilpres 2019
</div>

<div class="well well-sm">
<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>&nbsp;Input Data Tweet</button>
<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal1"><i class="fa fa-upload"></i>&nbsp;Import Data Tweet.csv</button>
<button type="button" class="btn btn-warning btn-sm"><i class="fa fa-laptop"></i>&nbsp;Proses Analisa Data</button>
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
                <textarea class="form-control" rows="10" id="judul" name="judul"></textarea>
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
    $tanggal=date("Y-m-d");
	$judul = $_POST['judul'];
	


	$add = "INSERT INTO table_datauji (id_datauji, tweet, tanggal)
	VALUES ('','$judul','$tanggal')";
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




                       <div class="table-responsive">
                     <table class="table table-striped" id="example1">
                        <thead>
                            <tr>  
                                <th>no</th>
                                <th>tweet</th>
                                <th>tanggal</th>
                                <th>Analisa Data</th>
                            </tr>
                            </tr>
                        </thead>
                        <tbody>
                        <?php  
                           $query = mysqli_query($conn, "SELECT * FROM  `$tbdatauji` order by `id_datauji` desc")or die(mysqli_error());
                           $no = 1;        
                           while($data = mysqli_fetch_array($query)){  
                               echo '<tr>';
                               echo '<td>'.$data['id_datauji'].'</td>';
                               echo '<td>'.$data['tweet'].'</td>';
                               echo '<td>'.$data['tanggal'].'</td>';
                               echo '<button type="button" class="btn btn-warning btn-sm"><i class="fa fa-laptop"></i></button>';
                               
                               $no++;  
                           }
                          

                        ?>
                        
                      
                        </tbody>
                    </table>

