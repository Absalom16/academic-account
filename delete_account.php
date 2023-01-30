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
          <h1 class="hero-title mb-4">academic.com</h1>

          <?php
try {
// Check for a valid user ID, through GET or POST: #1
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) {
// From view_users.php
 $id = htmlspecialchars($_GET['id'], ENT_QUOTES);
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) {
 // Form submission.
 $id = htmlspecialchars($_POST['id'], ENT_QUOTES);
 } else { // No valid ID, kill the script.
 // return to login page
 header("Location: signin.php");
 exit();
 }
 require ('./mysqli_connect.php');
 // Check if the form has been submitted: #2
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 $sure = htmlspecialchars($_POST['sure'], ENT_QUOTES);
 if ($sure == 'Yes') { // Delete the record.
 // Make the query:
 // Use prepare statement to remove security problems
 $q = mysqli_stmt_init($dbcon);
 mysqli_stmt_prepare($q, 'DELETE FROM accounts WHERE account_id=? LIMIT 1');
 // bind $id to SQL Statement
 mysqli_stmt_bind_param($q, "s", $id);
 // execute query
 mysqli_stmt_execute($q);
 if (mysqli_stmt_affected_rows($q) == 1) { // It ran OK
 // Print a message:
 echo '<h3 class="text-center" style="color:white;">The account has been deleted.</h3>';
 } else { // If the query did not run OK display public message
 echo '<p class="text-center">The account could not be deleted.';
 echo '<br>Either it does not exist or due to a system error.</p>';
 // echo '<p>' . mysqli_error($dbcon ) . '<br />Query: ' . $q . '</p>';
 // Debugging message. When live comment out because this displays SQL
 }
 } else { // User did not confirm deletion.
 echo '<h3 class="text-center" style="color:white;">The account has NOT been deleted as ';
 echo 'you requested</h3>';
 }
 } else { // Show the form. #3
 $q = mysqli_stmt_init($dbcon);
 $query = "SELECT CONCAT(username, ' ') FROM ";
 $query .= "accounts WHERE account_id=?";
 mysqli_stmt_prepare($q, $query);
 // bind $id to SQL Statement
 mysqli_stmt_bind_param($q, "s", $id);
 // execute query
 mysqli_stmt_execute($q);
 $result = mysqli_stmt_get_result($q);
 $row = mysqli_fetch_array($result, MYSQLI_NUM); // get user info
 if (mysqli_num_rows($result) == 1) {
 // Valid user ID, display the form.
 // Display the record being deleted: #4
 $user = htmlspecialchars($row[0], ENT_QUOTES);
?>
<h2 class="h2 text-center" style="color: white;">
Are you sure you want to permanently delete <?php echo $user; ?>?</h2>
<form action="delete_account.php" method="post"
 name="deleteform" id="deleteform">
<div class="form-group row">
 <label for="" class="col-sm-4 col-form-label"></label>
<div class="col-sm-8" style="padding-left: 70px;">
 <input type="hidden" name="id" value="<?php echo $id; ?>">
 <input id="submit-yes" class="btn btn-primary" type="submit" name="sure" 
value="Yes"> -
 <input id="submit-no" class="btn btn-primary" type="submit" name="sure" value="No">
</div>
</div>
</form>
<?php
 } else { // Not a valid user ID.
 echo '<p class="text-center">This page has been accessed in error.</p>';
 }
 } // End of the main submission conditional.
 
 }
 catch(Exception $e)
 {
 print "The system is busy. Please try again.";
 //print "An Exception occurred. Message: " . $e->getMessage();
 }
 catch(Error $e)
 {
 print "The system is currently busy. Please try again soon.";
 //print "An Error occurred. Message: " . $e->getMessage();
 }
?>
        </div>
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