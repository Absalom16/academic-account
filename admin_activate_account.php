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
 // This script retrieves all the records from the accounts table.
 require('mysqli_connect.php'); // Connect to the database.
 //set the number of rows per display page
 $pagerows = 10; // #1
 // Has the total number of pages already been calculated?
 if ((isset($_GET['p']) && is_numeric($_GET['p']))) {
 //already been calculated
 $pages = htmlspecialchars($_GET['p'], ENT_QUOTES);
 // make sure it is not executable XSS
 }else{//use the next block of code to calculate the number of pages #2
 //First, check for the total number of records
 $q = "SELECT COUNT(account_id) FROM accounts";
 $result = mysqli_query ($dbcon, $q);
 $row = mysqli_fetch_array ($result, MYSQLI_NUM);
 $records = htmlspecialchars($row[0], ENT_QUOTES);
 // make sure it is not executable XSS
 //Now calculate the number of pages
 if ($records > $pagerows){ // #3
 //if the number of records will fill more than one page
 //Calculate the number of pages and round the result up to the
 // nearest integer
 $pages = ceil ($records/$pagerows); //
 }else{
 $pages = 1;
 }
 }//page check finished
 //Declare which record to start with #4
 if ((isset($_GET['s'])) &&( is_numeric($_GET['s'])))
 {
 $start = htmlspecialchars($_GET['s'], ENT_QUOTES);
 // make sure it is not executable XSS
 }else{
 $start = 0;
 }
 $query = "SELECT username, email, phone_number,account_level, "; // #5
 $query .= "DATE_FORMAT(creation_date, '%M %d, %Y')";
 $query .=
 " AS regdat, account_id FROM accounts ORDER BY creation_date ASC";
 $query .=" LIMIT ?, ?";
 $q = mysqli_stmt_init($dbcon);
 mysqli_stmt_prepare($q, $query);
 // bind start and pagerows to SQL Statement
 mysqli_stmt_bind_param($q, "ii", $start, $pagerows);
 // execute query
 mysqli_stmt_execute($q);
 $result = mysqli_stmt_get_result($q);
 if ($result) {
 // If it ran OK (records were returned), display the records.
 // Table header.
 echo '<table class="table " style="width:100%;height:100%; color:white">
 <tr>
 <th scope="col">Edit</th>
 <th scope="col">Delete</th>
 <th scope="col">Username</th>
  <th scope="col">Email</th>
 <th scope="col">Phone number</th>
 <th scope="col">Account level</th>
 <th scope="col">Date created</th>
 
 </tr>';
 // Fetch and print all the records:
 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
 // Remove special characters that might already be in table to
 // reduce the chance of XSS exploits
$account_id = htmlspecialchars($row['account_id'], ENT_QUOTES);
$username = htmlspecialchars($row['username'], ENT_QUOTES);
$email = htmlspecialchars($row['email'], ENT_QUOTES);
$phone_number = htmlspecialchars($row['phone_number'], ENT_QUOTES);
$account_level = htmlspecialchars($row['account_level'], ENT_QUOTES);
$creation_date = htmlspecialchars($row['regdat'], ENT_QUOTES);
 echo '<tr>
<td ><a href="edit_account.php?id=' . $account_id .
 '">Edit</a></td>
 <td><a href="delete_account.php?id=' . $account_id .
 '">Delete</a></td>
 <td >' . $username . '</td>
<td>' . $email . '</td>
<td>' . $phone_number . '</td>
<td>' . $account_level . '</td>
<td>' . $creation_date . '</td>
</tr>';
 }
 echo '</table>'; // Close the table.
 mysqli_free_result ($result); // Free up the resources.
 }
 else { // If it did not run OK.
 // Error message:
 echo '<p class="text-center">The current users could not be ';
 echo 'retrieved. We apologize for any inconvenience.</p>';
 // Debug message:
 // echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $q . '</p>';
 exit;
 } // End of else ($result)
 // Now display the total number of records/members. #6
 $q = "SELECT COUNT(account_id) FROM accounts";
 $result = mysqli_query ($dbcon, $q);
 $row = mysqli_fetch_array ($result, MYSQLI_NUM);
 $members = htmlspecialchars($row[0], ENT_QUOTES);
 mysqli_close($dbcon); // Close the database connection.
 $echostring = "<p class='text-center'>Total users: $members </p>";
 $echostring .= "<p class='text-center'>";
 if ($pages > 1) { // #7
 //What number is the current page?
 $current_page = ($start/$pagerows) + 1;
 //If the page is not the first page then create a Previous link
 if ($current_page != 1) {
 $echostring .=
 '<a href="admin_activate_account.php?s=' . ($start - $pagerows) .
 '&p=' . $pages . '">Previous</a> ';
 }
 //Create a Next link #8
 if ($current_page != $pages) {
 $echostring .=
 ' <a href="admin_activate_account.php?s=' . ($start + $pagerows) .
 '&p=' . $pages . '">Next</a> ';
 }
 $echostring .= '</p>';
 echo $echostring;
 }
} //end of try
catch(Exception $e) // We finally handle any problems here
{
 // print "An Exception occurred. Message: " . $e->getMessage();
 print "The system is busy please try later";
}
catch(Error $e)
{
 //print "An Error occurred. Message: " . $e->getMessage();
 print "The system is busy please try again later.";
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