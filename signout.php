<?php

session_start();

if(isset($_SESSION['account_id']))
{
	unset($_SESSION['account_id']);

}

header("Location: signin.php");
die;