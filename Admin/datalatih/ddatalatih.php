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
win=window.open('datalatih/print.php','win','width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0'); } 
</script>
<script language="JavaScript">
function buka(url) {window.open(url, 'window_baru', 'width=800,height=600,left=320,top=100,resizable=1,scrollbars=1');}
</script>

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
 
  <h4>Form Data</h4>
  <div>
Data datalatih: 
| <a href="datalatih/pdf.php"><img src='ypathicon/pdf.png' alt='PDF'></a> 
| <a href="datalatih/xls.php"><img src='ypathicon/xls.png' alt='XLS'></a> 
| <a href="datalatih/xml.php"><img src='ypathicon/xml.png' alt='XML'></a> 
| <img src='ypathicon/print.png' alt='PRINT' OnClick="PRINT()"> |
<br>

<table id="table">
  <tr bgcolor="#036">
    <th width="7%"><center>no</th>
    <th width="85%"><center>Judul</th>
  </tr>
<?php  
  $sql="select * from `$tbdatalatih` order by `id_datalatih` desc";
  $jum=getJum($conn,$sql);
		if($jum > 0){
	//--------------------------------------------------------------------------------------------
	$batas   = 10;
	$page = $_GET['page'];
	if(empty($page)){$posawal  = 0;$page = 1;}
	else{$posawal = ($page-1) * $batas;}
	
	$sql2 = $sql." LIMIT $posawal,$batas";
	$no = $posawal+1;
	//--------------------------------------------------------------------------------------------									
	$arr=getData($conn,$sql2);
		foreach($arr as $d) {							
				$id_datalatih=$d["id_datalatih"];
				$nama_mhs=$d["nama_mhs"];
				$nim=$d["nim"];
				$judul=$d["judul"];
					$color="#dddddd";	
					if($no %2==0){$color="#eeeeee";}
echo"<tr bgcolor='$color'>
				<td valign='top'>$no</td>
				<td valign='top'>$judul<br>Mahasiswa: $nama_mhs /NIM: $nim</td>
							</tr>";
			
			$no++;
			}//while
		}//if
		else{echo"<tr><td colspan='7'><blink>Maaf, Data datalatih belum tersedia...</blink></td></tr>";}
?>
</table>

<?php
//Langkah 3: Hitung total data dan page 
$jmldata = $jum;
if($jmldata>0){
	if($batas<1){$batas=1;}
	$jmlhal  = ceil($jmldata/$batas);
	echo "<div class=paging>";
	if($page > 1){
		$prev=$page-1;
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$prev&mnu=ddatalatih'>« Prev</a></span> ";
	}
	else{echo "<span class=disabled>« Prev</span> ";}

	// Tampilkan link page 1,2,3 ...
	for($i=1;$i<=$jmlhal;$i++)
	if ($i != $page){echo "<a href='$_SERVER[PHP_SELF]?page=$i&mnu=ddatalatih'>$i</a> ";}
	else{echo " <span class=current>$i</span> ";}

	// Link kepage berikutnya (Next)
	if($page < $jmlhal){
		$next=$page+1;
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$next&mnu=ddatalatih'>Next »</a></span>";
	}
	else{ echo "<span class=disabled>Next »</span>";}
	echo "</div>";
	}//if jmldata

$jmldata = $jum;
	echo "<p align=center>Total Data <b>$jmldata</b> Item</p>";
?>
</div>
</div>