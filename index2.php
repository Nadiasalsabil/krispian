<?php
if (version_compare(phpversion(), "5.3.0", ">=")  == 1)
  error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
else
  error_reporting(E_ALL & ~E_NOTICE);  
  ?>
<?php
session_start();
//error_reporting(0);
require_once"admin/konmysqli.php";

$mnu=$_GET["mnu"];
date_default_timezone_set("Asia/Jakarta");

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Sentimen Analisis Pilpres</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500|Gaegu:700" rel="stylesheet">
    <link rel="stylesheet" href="utama/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="utama/css/animate.css">
    <link rel="stylesheet" href="utama/css/owl.carousel.min.css">
    <link rel="stylesheet" href="utama/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="utama/css/magnific-popup.css">
    <link rel="stylesheet" href="utama/css/aos.css">
    <link rel="stylesheet" href="utama/css/ionicons.min.css">
    <link rel="stylesheet" href="utama/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="utama/css/jquery.timepicker.css">
    <link rel="stylesheet" href="utama/css/flaticon.css">
    <link rel="stylesheet" href="utama/css/icomoon.css">
    <link rel="stylesheet" href="utama/css/style.css">



  </head>
  <body>
    
  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="index.html">SISTEM SENTIMEN ANALISIS</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"><a href="index.php" class="nav-link">Sentimen Analisis</a></li>
          <li class="nav-item"><a href="" class="nav-link" data-toggle="modal" data-target="#myModal">Daftar</a></li>
          <li class="nav-item"><a href="" class="nav-link" data-toggle="modal" data-target="#myModals">Masuk</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- END nav -->

  <!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h6 class="modal-title">Sign Up</h6>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

        <form action=" "action="" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="email">Nama Lengkap:</label>
            <input type="text" class="form-control" id="nama" name="nama">
          </div>

          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email">
          </div>

          <div class="form-group">
            <label for="email">Username:</label>
            <input type="text" class="form-control" id="username" name="username">
          </div>

          <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>

          <button type="submit" class="btn btn-info btn-xs" id="simpan" name="simpan"><font color="white">Sign Up</font></button>
        </form>
        
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


  <!-- The Modals -->
  <div class="modal" id="myModals">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h6 class="modal-title">Sign In</h6>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
            <form>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">username</span>
                </div>
                <input type="text" class="form-control" placeholder="Username" name="username" id="username">
              </div>

              <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                <div class="input-group-append">
                  <span class="input-group-text">Password</span>
                </div>
              </div>

               <button type="submit" class="btn btn-info btn-xs" id="simpan" name="simpan"><font color="white">Sign In</font></button>

            </form>
          
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-md" data-dismiss="modal">Close</button>
        </div>
  
      </div>
    </div>
  </div>


  
  <div class="block-31" style="position: relative;">
    <div class="owl-carousel loop-block-31 ">
      <div class="block-30 item" style="background-image: url('utama/images/bg.jpg');" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-7">
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
  

  <div class="site-section">
    <div class="container">
      <div class="row">

        

       
        

      </div>
    </div>
  </div> <!-- .site-section -->



  




  
  <footer class="footer">
    
  </footer>

  <!-- loader -->

<?php
if (isset($_POST['simpan'])) 
{

  $nama     = $_POST['nama'];
  $email    = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];
 

	$add = "INSERT INTO tbl_pengunjung (id,nama,email,username,`password`)
	VALUES ('', '$nama', '$email', '$username', '$password')";
	$query = mysqli_query($conn, $add) or die(mysqli_error($conn));

	if($query){
	echo "<script>alert('Success! Anda sudah terdaftar silahkan Masuk');</script>";
	echo "<script>location='index.php';</script>";
    }
    else{
        echo "<script>alert('Anda gagal mendaftar');</script>";
        echo "<script>location='index.php';</script>"; 
    }
}

?>









  <script src="utama/js/jquery.min.js"></script>
  <script src="utama/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="utama/js/popper.min.js"></script>
  <script src="utama/js/bootstrap.min.js"></script>
  <script src="utama/js/jquery.easing.1.3.js"></script>
  <script src="utama/js/jquery.waypoints.min.js"></script>
  <script src="utama/js/jquery.stellar.min.js"></script>
  <script src="utama/js/owl.carousel.min.js"></script>
  <script src="utama/js/jquery.magnific-popup.min.js"></script>
  <script src="utama/js/bootstrap-datepicker.js"></script>
  
  <script src="utama/js/aos.js"></script>
  <script src="utama/js/jquery.animateNumber.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="utama/js/google-map.js"></script>
  <script src="utama/js/main.js"></script>
    
  </body>
</html>