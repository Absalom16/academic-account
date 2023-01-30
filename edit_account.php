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
 try
 {
 
// This code is executed #1
 // The code looks for a valid user ID, either through GET or POST:
 if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) {
 // From view_users.php
 $id = htmlspecialchars($_GET['id'], ENT_QUOTES);
 } elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) {
 // Form submission.
 $id = htmlspecialchars($_POST['id'], ENT_QUOTES);
 } else { // No valid ID, kill the script.
 echo '<p class="text-center">This page has been accessed in error.</p>';
 
 exit();
 }
 require ('./mysqli_connect.php');
 // Has the form been submitted?
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 $errors = array();
 // Look for the first name: #2
 $username =
 filter_var( $_POST['username'], FILTER_SANITIZE_STRING);
 if (empty($username)) {
 $errors[] = 'You forgot to enter your username.';
 }
  // Look for the email address:
 $email = filter_var( $_POST['email'], FILTER_SANITIZE_EMAIL);
 if ((empty($email)) || (!filter_var($email, FILTER_VALIDATE_EMAIL))) {
 $errors[] = 'You forgot to enter your email address';
$errors[] = ' or the e-mail format is incorrect.';
 }
 // Look for phone number:
  $phone_number = filter_var( $_POST['phone_number'], FILTER_SANITIZE_STRING);
  if (empty($phone_number)) {
  $errors[] = 'You forgot to enter your phone number.';
  }
  // Look for the account level:
 $account_level = filter_var( $_POST['account_level'], FILTER_SANITIZE_STRING);
 if (empty($account_level)) {
 $errors[] = 'You forgot to enter the account level.';
 }
 if (empty($errors)) { // If everything's OK. #3
 $q = mysqli_stmt_init($dbcon);
 $query = 'SELECT account_id FROM accounts WHERE email=? AND account_id !=?';
 mysqli_stmt_prepare($q, $query);
 // bind $id to SQL Statement
 mysqli_stmt_bind_param($q, 'si', $email, $id);
 // execute query
 mysqli_stmt_execute($q);
 $result = mysqli_stmt_get_result($q);
 if (mysqli_num_rows($result) == 0) {
 // e-mail does not exist in another record #4
 $query = 'UPDATE accounts SET username=?, email=?, phone_number=?, account_level=?';
 $query .= ' WHERE account_id=? LIMIT 1';
$q = mysqli_stmt_init($dbcon);
mysqli_stmt_prepare($q, $query);
// bind values to SQL Statement
mysqli_stmt_bind_param($q, 'ssssi', $username, $email, $phone_number, $account_level, $id);
 // execute query
mysqli_stmt_execute($q);
if (mysqli_stmt_affected_rows($q) == 1) { // Update OK
 // Echo a message if the edit was satisfactory:
 echo '<h3 class="text-center" style="color:white;">The account has been activated.</h3>';
 } else { // Echo a message if the query failed.
 echo '<p class="text-center">The user could not be edited due ';
 echo 'to a system error.';
 echo ' We apologize for any inconvenience.</p>'; // Public message.
 //echo '<p>' . mysqli_error($dbcon) . '<br />Query: ' . $q . '</p>';
 // Debugging message.
 // Message above is only for debug and should not display SQL in live //mode
 }
 } else { // Already registered.
 echo '<p class="text-center">The email address has ';
 echo 'already been registered.</p>';
 }
 } else { // Display the errors.
 echo '<p class="text-center">The following error(s) occurred:<br />';
 foreach ($errors as $msg) { // Echo each error.
 echo " - $msg<br />\n";
 }
 echo '</p><p>Please try again.</p>';
 } // End of if (empty($errors))section.
 } // End of the conditionals
 // Select the user's information to display in textboxes: #5
 $q = mysqli_stmt_init($dbcon);
 $query = "SELECT username, email, phone_number, account_level FROM accounts WHERE account_id=?";
 mysqli_stmt_prepare($q, $query);
 // bind $id to SQL Statement
 mysqli_stmt_bind_param($q, 'i', $id);
 // execute query
 mysqli_stmt_execute($q);
 $result = mysqli_stmt_get_result($q);
 $row = mysqli_fetch_array($result, MYSQLI_NUM);
 if (mysqli_num_rows($result) == 1) { // Valid user ID, display the form.
 // Get the user's information:
 // Create the form:
?>
<h2 class="h2 text-center" style="color:white ;">Edit account</h2>
<form action="edit_account.php" method="post"
 name="editform" id="editform">
<div class="form-group row">
 <label for="username" class="col-sm-4 col-form-label">
 Userame:</label>
<div class="col-sm-8">
 <input type="text" class="form-control" id="username" name="username"
 placeholder="Username" maxlength="30" required
 value="<?php echo htmlspecialchars($row[0], ENT_QUOTES); ?>" >
</div>
</div><br>
<div class="form-group row">
 <label for="email" class="col-sm-4 col-form-label">E-mail:</label>
<div class="col-sm-8">
 <input type="email" class="form-control" id="email" name="email"
 placeholder="E-mail" maxlength="60" required
 value="<?php echo htmlspecialchars($row[1], ENT_QUOTES); ?>">
</div>
</div><br>
<div class="form-group row">
 <label for="phone_number" class="col-sm-4 col-form-label">
 Phone number:</label>
<div class="col-sm-8">
 <input type="text" class="form-control" id="phone_number" name="phone_number"
 placeholder="Phone number" maxlength="40" required
 value="<?php echo htmlspecialchars($row[2], ENT_QUOTES); ?>">
</div>
</div><br>
<div class="form-group row">
 <label for="account_level" class="col-sm-4 col-form-label">
 Account level:</label>
<div class="col-sm-8">
 <input type="text" class="form-control" id="account_level" name="account_level"
 placeholder="Account level" maxlength="40" required
 value="<?php echo htmlspecialchars($row[3], ENT_QUOTES); ?>">
</div>
</div><br>
 <input type="hidden" name="id" value=" <?php echo $id ?>" /> <!-- #6 -->
<div class="form-group row">
 <label for="" class="col-sm-4 col-form-label"></label>
<div class="col-sm-8">
 <input id="submit" class="btn btn-primary" type="submit" name="submit" 
value="Edit">
</div>
</div>
</form>
<?php
 } else { // The user could not be validated
echo '<p class="text-center">This page has been accessed in error.</p>';
 }
 mysqli_stmt_free_result($q);
 mysqli_close($dbcon);
 }
 catch(Exception $e)
 {
 print "The system is busy. Please try later";
 //print "An Exception occurred. Message: " . $e->getMessage();
 }
 catch(Error $e)
 {
 print "The system is currently buys. Please try later";
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