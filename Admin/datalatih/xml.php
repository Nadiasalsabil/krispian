<?php
header("Content-type: text/xml");

include "../konmysqli.php";
$sql = "select * from `$tbdatalatih`";
if(getJum($conn,$sql)>0){
	print "<datalatih>\n";
		$arr=getData($conn,$sql);
		foreach($arr as $d) {		
				$id_datalatih=$d["id_datalatih"];
				$nim=$d["nim"];
				$nama_mhs=$d["nama_mhs"];
				$judul=$d["judul"];
			    
												
				print "<record>\n";
				print "  <nim>$nim</nim>\n";
				print "  <nama_mhs>$nama_mhs</nama_mhs>\n";
				print "  <judul>$judul</judul>\n";
				print "  <id_datalatih>$id_datalatih</id_datalatih>\n";
				print "</record>\n";
			}
	print "</datalatih>\n";
}
else{
	$null="null";
	print "<datalatih>\n";
		print "<record>\n";
				print "  <nim>$null</nim>\n";
				print "  <nama_mhs>$null</nama_mhs>\n";
				print "  <judul>$null</judul>\n";
				print "  <id_datalatih>$null</id_datalatih>\n";
		print "</record>\n";
	print "</datalatih>\n";
	}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

function getJum($conn,$sql){
  $rs=$conn->query($sql);
  $jum= $rs->num_rows;
	$rs->free();
	return $jum;
}

function getData($conn,$sql){
	$rs=$conn->query($sql);
	$rs->data_seek(0);
	$arr = $rs->fetch_all(MYSQLI_ASSOC);
	
	$rs->free();
	return $arr;
}
?>
	