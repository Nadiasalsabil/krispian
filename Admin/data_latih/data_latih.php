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


                       <div class="table-responsive">
                     <table class="table table-striped" id="example1">
                        <thead>
                            <tr>  
                                <th>no</th>
                                <th>Kategori</th>
                                <th>Tweet</th>
                                <th>Normalisasi</th>
                                <th>Sentimen</th>

                            </tr>
                            </tr>
                        </thead>
                        <tbody>
                        <?php  
                           $query = mysqli_query($conn, "SELECT * FROM  `$tbdatalatih` order by `id_dataset` desc")or die(mysqli_error());
                           $no = 1;        
                           while($data = mysqli_fetch_array($query)){  
                               echo '<tr>';
                               echo '<td>'.$data['id_dataset'].'</td>';
                               echo '<td>'.$data['kategori'].'</td>';
                               echo '<td><p align="justify">'.$data['tweet'].'</p></td>';
                               echo '<td><p align="justify">'.$data['normalisasi'].'</p></td>';
                               echo '<td><center>'.$data['sentimen'].'</center></td>';
                               
                               $no++;  
                           }
                          

                        ?>
                        
                      
                        </tbody>
                    </table>

