<?php

	include '../konmysqli.php';

	$id = $_GET ['id'];

	$hapus 	= "DELETE FROM tbl_datatesting WHERE id_datatesting = '$id'";
	$query	= mysqli_query($conn, $hapus);

	if ($query)
	    {
	    	echo "<strong><center>Data Berhasil Dihapus";
	    	echo "<META HTTP-EQUIV='REFRESH' CONTENT ='1; URL=../index.php?mnu=datatesting'>";
	    }
	else {
	    	//echo "<strong><center>Data Gagal Diubah";
	    	//echo '<META HTTP-EQUIV="REFRESH" CONTENT = "1; URL=../index.php?halaman=edit_info">';
	    	print"
	    		<script>
	    			alert(\"Data Gagal Diubah!\");
	    			history.back(-1);
	    		</script>";
	    }
	

        // echo "<script>alert('Success! Data Update');</script>";
        // echo "<script>location='index.php?mnu=data_latih';</script>";
?>