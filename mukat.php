<form action="" method="post" enctype="multipart/form-data">
<table width="98%" id="table">


<tr>
<th width="144"><label for="id_customer"></label>
<th width="245"><div align="center">ID Customer :
</div>
<th colspan="2"><b>
<?php 
echo $id_customer;?>
</b>
</tr>

<td width="214" rowspan="9">
<center>
<?php 
echo"<a href='#' onclick='buka(\"customer/zoom1.php?id=$id_customer\")'>
<img src='$YPATH/$gambar0' width='100' height='110' />
</a>
";
?>
</center>
</td>
</tr>


<tr>
<td><label for="nama_customer">Nama Customer</label>
<td width="145"><div align="center">:
</div>
<td colspan="2"><input name="nama_customer"  type="text" class="form-control" id="nama_customer" onblur="MM_validateForm('telepon','','RisNum','email','','RisEmail','username','','R','password','','R');return document.MM_returnValue" value="<?php echo $nama_customer;?>" size="30" /></td>
</tr>

<tr>
<td height="24"><label for="telepon">Telepon</label>
<td><div align="center">:</div>
<td colspan="2"><input name="telepon" class="form-control"  type="text" id="telepon" value="<?php echo $telepon;?>" size="15" />
</td>
</tr>

<tr>
<td height="43"><label for="email">Email</label>
<td><div align="center">:
</div>
<td width="502"><input name="email" class="form-control"  type="text" id="email" value="<?php echo $email;?>" size="30" />
  <label for="kode_barang"></label></td>
</tr>

<tr>
<td height="24"><label for="alamat">Alamat</label>
<td><div align="center">:</div>
<td colspan="2"><textarea name="alamat" cols="25" class="form-control" id="alamat"><?php echo $alamat;?></textarea>
</td>
</tr>

<tr>
<td height="24"><label for="usename">Username</label>
<td><div align="center">:</div>
<td colspan="2"><input name="username" class="form-control"  type="text" id="username" value="<?php echo $username;?>" size="25" />
</td>
</tr>

<tr>
<td height="24"><label for="apassword">Password</label>
<td><div align="center">:</div>
<td colspan="2"><input name="password" class="form-control"  type="text" id="password" value="<?php echo $password;?>" size="25" />
</td>
</tr>

<tr>
  <td height="24"><label for="Gambar">Gambar</label>
    <td><div align="center">:</div>
    <td colspan="2"><label for="gambar"></label>
        <input name="gambar" type="file" id="gambar" size="20" /> 
      => <a href='#' onclick='buka("mobil/zoom.php?id=<?php echo $id_customer;?>")'><?php echo $gambar0;?></a></td>
</tr>

<tr>
<td>Status<td><div align="center">:</div>
<td colspan="2">
<input type="radio" name="status" id="status" checked="checked" value="Aktif" <?php if($status=="Aktif") {echo"checked";}?>/>Aktif 
<input type="radio" name="status" id="status" value="Tidak Aktif"<?php if ($status=="Tidak Aktif"){echo"checked";}?>/> Tidak Aktif<td width="34">

<tr>
<td>
<td>
<td colspan="2">	<input name="Simpan" type="submit" id="Simpan" onclick="MM_validateForm('nama_customer','','R','telepon','','RisNum','email','','RisEmail','username','','R','password','','R');return document.MM_returnValue" value="Simpan" />
        <input name="pro" type="hidden" id="pro" value="<?php echo $pro;?>" />
        <input name="gambar0" type="hidden" id="gambar0" value="<?php echo $gambar0;?>" />
        <input name="id_customer" type="hidden" id="id_customer" value="<?php echo $id_customer;?>" />
        <input name="id_customer0" type="hidden" id="id_customer0" value="<?php echo $id_customer0;?>" />
        <a href="?mnu=customer"><input name="Batal" type="button" id="Batal" value="Batal" /></a>
</td></tr>
</table>
</form>
</div>