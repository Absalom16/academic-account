<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>DevFolio Bootstrap Portfolio Template - Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="favicon.png" rel="icon">
  <link href="apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Vendor CSS Files -->
  <link href="bootstrap.min.css" rel="stylesheet">
  <link href="bootstrap-icons.css" rel="stylesheet">
  <link href="glightbox.min.css" rel="stylesheet">
  <link href="swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: DevFolio - v4.9.1
  * Template URL: https://bootstrapmade.com/devfolio-bootstrap-portfolio-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="index.php">academic</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="signout.php">Sign out</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <div id="hero" class="hero route bg-image" style="background-image: url(hero-bg.jpg)">
    <div class="overlay-itro"></div>
    <div class="hero-content display-table">
      <div class="table-cell">
        <div class="container">
          <!--<p class="display-6 color-d">Hello, world!</p>-->
          <h1 class="hero-title mb-4">academic.com</h1><?php
    $conn = mysqli_connect('localhost','root','Rawlings16$','academic');
    if(isset($_POST['submit'])){
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $path = "files/".$fileName;
        $filename = htmlspecialchars($row['filename'], ENT_QUOTES); 
    }?><table border="1px" align="center">
       <tr>
           <td><?php
$query2 = "SELECT * FROM filedownload ";
$run2 = mysqli_query($conn,$query2);
while($rows = mysqli_fetch_assoc($run2)){
?><a href="download.php?file=<?php echo $rows['filename'] ?>" style="color: white;"><?php echo $rows['filename'] ?> DOWNLOAD</a><br><?php
}
?></td>
           <td> </td>
       </tr>
   </table>
    
</body>
</html><?php
if(!empty($_GET['file'])){
    $fileName  = basename($_GET['file']);
    $filePath  = "files/".$fileName;
    
    if(!empty($fileName) && file_exists($filePath)){
        //define header
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$fileName");
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: binary");
        
        //read file 
        readfile($filePath);
        exit;
    }
    else{
        echo "file not exit";
    }
}
?></div>
      </div>
    </div>
  </div><!-- End Hero Section -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <!-- End About Section -->

    <!-- ======= Services Section ======= -->
   <!-- End Services Section -->

    <!-- ======= Counter Section ======= -->
    <!-- End Counter Section -->

    <!-- ======= Portfolio Section ======= -->
   <!-- End Portfolio Section -->

    <!-- ======= Testimonials Section ======= -->
    <!-- End testimonial item -->

               <!-- End testimonial item -->
             <!-- End Testimonials Section -->

    <!-- ======= Blog Section ======= -->
    <!-- End Blog Section -->

    <!-- ======= Contact Section ======= -->
    <!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="copyright-box">
            <p class="copyright">&copy; Copyright <strong>DevFolio</strong>. All Rights Reserved</p>
            <div class="credits">
              <!--
              All the links in the footer should remain intact.
              You can delete the links only if you purchased the pro version.
              Licensing information: https://bootstrapmade.com/license/
              Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=DevFolio
            -->
              Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer><!-- End  Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="purecounter_vanilla.js"></script>
  <script src="bootstrap.bundle.min.js"></script>
  <script src="glightbox.min.js"></script>
  <script src="swiper-bundle.min.js"></script>
  <script src="typed.min.js"></script>
  <script src="validate.js"></script>

  <!-- Template Main JS File -->
  <script src="main.js"></script>

</body>

</html>