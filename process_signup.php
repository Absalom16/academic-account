<?php
//this script is a query that inserts a record in the accounts table.
//check that form has been submitted:
try{
    $errors=array();//initialize an error array
    //check for a username:
        $username=filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        if(empty($username)) {
            $errors[]='You forgot to enter your first name.';
        }
        //check for an email address:
        $email=filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        if((empty($email)) || (!filter_var($email, FILTER_VALIDATE_EMAIL))) {
            $errors[]='you forgot to enter your email address';
            $errors[]='or the email format is incorrect.';
        }
    //check for phone number
$phone_number=filter_var($_POST['phone_number'], FILTER_SANITIZE_STRING);
if(empty($phone_number)){
    $errors[]='you forgot to enter your phone number';
}
    //check for a password and match against the confirmed password:
        $password1=filter_var($_POST['password1'], FILTER_SANITIZE_STRING);
        $password2=filter_var($_POST['password2'], FILTER_SANITIZE_STRING);
        if(!empty($password1)) {
            if($password1 !==$password2) {
                $errors[]='your two passwords did not match.';
                }
        }else{
            $errors[]='you forgot to enter your password.';
        }
        if(empty($errors)) {//if everything's OK.
        //register the user in the database...
        //hash password current 60 characters but can increase
            $password=($password1 );
        require('mysqli_connect.php'); //connect to the db.
        //make the query:
        $query="INSERT INTO accounts (account_id, username, email, phone_number, password, creation_date)";
       
        $query .= "VALUES(' ',?,?,?,?, NOW() )";
    $q=mysqli_stmt_init($dbcon);
    mysqli_stmt_prepare($q, $query);
    //use prepared statement to ensure that only text is inserted
    //bind fields to SQL statement
    mysqli_stmt_bind_param($q, 'ssss',  $username, $email ,$phone_number ,$password );
    //execute query
    mysqli_stmt_execute($q);
    if(mysqli_stmt_affected_rows($q)==1) {//one reord inserted
        header ("location:account_activation.php");
        exit();
    }else{//if it did not run ok.
        //public message:
        $errorstring=
        "<p class='text-center col-sm-8' style='color:red'>";
        $errorstring.=
        "system error<br />you could not be registered due";
        $errorstring .=
        "to a system error. we apologize for any inconvenience.</p>";
        echo "<p class= 'text-center col-sm-2'
        style='color:red'>$errorstring</p>";
        //debugging message below do not use in production
        echo '<p>' .mysqli_error($dbcon) .'<br><br>Query: ' .$query .'</p>';
        mysqli_close($dbcon); //close the database connection.
        //include footer then close program to stop execution
        echo '<footer class="jumbotron text-center col-sm-12"
        style="padding-bottom:1px; padding-top:8px">
        include ("footer.php");
        </footer>';
        exit();
    }          
    }else{//report the errors.
    $errorstring=
      "error! <br /> the following error(s) occurred:<br>";
      foreach($errors as $msg) {//print each error.
           $errorstring.=" - $msg<br>\n";
    }
    $errorstring.="please try again.<br>";
    echo "<p class=' text-center col-sm-2'
    style='color:red'>$errorstring</p>";
}// end of if (empty($errors)) IF.
}
catch(Exception $e) // we finally handle any problems here
{
    // print "an exception occurred. message: " .$e->getMessage();
    print "the system is busy please try later";
}
catch(Error $e)
{
    //print "an error occurred. Message: " .$e->getMessage();
    print "the system is busy please try again later.";
}
?>