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

<?php
 
if($_GET["pro"]=="ubah"){
	$id_dataset=$_GET["kode"];
	$sql="select * from `$tbdatalatih` where `id_dataset`='$id_dataset'";
	$d=getField($conn,$sql);
				$id_dataset=$d["id_dataset"];
				$kategori=$d["kategori"];
				$tweet=$d["tweet"];
				$normalisasi=$d["normalisasi"];
				$sentimen=$d["sentimen"];
				$pro="ubah";		
}
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
  <h4>Input Data</h4>
  <div>


<form action="" method="post" enctype="multipart/form-data">
<table id="table">

<tr>
<td width="35%"><label for="kategori">kategori</label>
<td width="3%">:
<td width="62%" colspan="2"><input name="kategori" class="form-control" type="text" id="kategori" value="<?php echo $kategori;?>" size="30" /></td>
</tr>


<tr>
<td height="24"><label for="tweet">tweet</label>
<td>:
<td><textarea name="tweet" class="form-control" cols="30" id="tweet"><?php echo $tweet;?></textarea>
 </td>
</tr>

<tr>
<td height="24"><label for="normalisasi">normalisasi</label>
<td>:
<td><textarea name="normalisasi" class="form-control" cols="100" id="normalisasi"><?php echo $normalisasi;?></textarea>
 </td>
</tr>

<tr>
<td height="24"><label for="sentimen">sentimen Penelitian</label>
<td>:
<td><textarea name="sentimen" class="form-control" cols="100" id="sentimen"><?php echo $sentimen;?></textarea>
 </td>
</tr>
<tr>
<td>
<td>
<td colspan="2">	<input name="Simpan" type="submit" id="Simpan" value="Simpan" class="btn btn-primary btn-sm"/>
        <input name="pro" type="hidden" id="pro" value="<?php echo $pro;?>" />
         <input name="id_dataset0" type="hidden" id="id_dataset0" value="<?php echo $id_dataset0;?>" />
        <a href="?mnu=datalatih"><input name="Batal" type="button" id="Batal" value="Batal" class="btn btn-danger btn-sm"/></a>
</td></tr>
</table>
</form>
</div>
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
    <th width="25%"><center>Kategori</th>
    <th width="50%"><center>Tweet</th>
    	<th width="10%"><center>Menu</th>
  </tr>
<?php  
  $sql="select * from `$tbdatalatih` order by `id_dataset` desc";
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
				$id_dataset=$d["id_dataset"];
				$nama_mhs=$d["nama_mhs"];
				$kategori=$d["kategori"];
				$tweet=$d["tweet"];
					$normalisasi=$d["normalisasi"];
				$sentimen=$d["sentimen"];
					$color="#dddddd";	
					if($no %2==0){$color="#eeeeee";}
echo"<tr bgcolor='$color'>
				<td valign='top'>$no</td>
				<td valign='top'>$kategori</td>
				<td valign='top'><b>$tweet</b><br>$normalisasi #$sentimen</td>
				<td align='center'>
<a href='?mnu=datalatih&pro=ubah&kode=$id_dataset'><img src='ypathicon/u.png' alt='ubah'></a>
<a href='?mnu=datalatih&pro=hapus&kode=$id_dataset'><img src='ypathicon/h.png' alt='hapus' 
onClick='return confirm(\"Apakah Anda benar-benar akan menghapus $kategori pada data datalatih ?..\")'></a></td>
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
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$prev&mnu=datalatih'>« Prev</a></span> ";
	}
	else{echo "<span class=disabled>« Prev</span> ";}

	// Tampilkan link page 1,2,3 ...
	for($i=1;$i<=$jmlhal;$i++)
	if ($i != $page){echo "<a href='$_SERVER[PHP_SELF]?page=$i&mnu=datalatih'>$i</a> ";}
	else{echo " <span class=current>$i</span> ";}

	// Link kepage berikutnya (Next)
	if($page < $jmlhal){
		$next=$page+1;
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$next&mnu=datalatih'>Next »</a></span>";
	}
	else{ echo "<span class=disabled>Next »</span>";}
	echo "</div>";
	}//if jmldata

$jmldata = $jum;
	echo "<p align=center>Total Data <b>$jmldata</b> Item</p>";
?>
</div>
</div>
<?php
if(isset($_POST["Simpan"])){
	$pro=strip_tags($_POST["pro"]);
	$id_dataset=strip_tags($_POST["id_dataset"]);
	$id_dataset0=strip_tags($_POST["id_dataset0"]);
	$kategori=strip_tags($_POST["kategori"]);
	$tweet=strip_tags($_POST["tweet"]);
	
		$normalisasi=strip_tags($_POST["normalisasi"]);
	$sentimen=strip_tags($_POST["sentimen"]);
	
if($pro=="simpan"){
$sql=" INSERT INTO `$tbdatalatih` (
`id_dataset` ,
`normalisasi` ,`sentimen` ,
`kategori` ,
`tweet`
) VALUES (
'', 
'$normalisasi','$sentimen',
'$kategori', 
'$tweet'
)";
	
$simpan=process($conn,$sql);
		if($simpan) {echo "<script>alert('Data $id_dataset berhasil disimpan !');document.location.href='?mnu=datalatih';</script>";}
		else{echo"<script>alert('Data $id_dataset gagal disimpan...');document.location.href='?mnu=datalatih';</script>";}
	}
	else{
$sql="update `$tbdatalatih` set 
`kategori`='$kategori',
`sentimen`='$sentimen' ,`normalisasi`='$normalisasi' ,
`tweet`='$tweet' 
where `id_dataset`='$id_dataset0'";
$ubah=process($conn,$sql);
	if($ubah) {echo "<script>alert('Data $id_dataset berhasil diubah !');document.location.href='?mnu=datalatih';</script>";}
	else{echo"<script>alert('Data $id_dataset gagal diubah...');document.location.href='?mnu=datalatih';</script>";}
	}//else simpan
}
?>

<?php
if($_GET["pro"]=="hapus"){
$id_dataset=$_GET["kode"];
$sql="delete from `$tbdatalatih` where `id_dataset`='$id_dataset'";
$hapus=process($conn,$sql);
if($hapus) {echo "<script>alert('Data datalatih $id_dataset berhasil dihapus !');document.location.href='?mnu=datalatih';</script>";}
else{echo"<script>alert('Data datalatih $id_dataset gagal dihapus...');document.location.href='?mnu=datalatih';</script>";}
}
?>

