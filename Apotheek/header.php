<?php
    include("db_connect.php");
    session_start();
    include("API/PHP/php-library.php");
    
    if(basename($_SERVER['PHP_SELF']) !== "login_patient.php"){
        if(!isset($_SESSION["rol"]) && basename($_SERVER['PHP_SELF']) !== "login_employee.php"){
            header("refresh:0;url=login_patient.php");
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>De Bijsluiter</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.journal.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="js/jquery-ui-1.12.1.custom/jquery-ui.min.css">
    <script src="js/jquery-2.2.4.min.js"></script>
    <script src="js/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="API/JS/js-library.js"></script>
  </head>
  <body>
      <div class="header">
          <nav class="navbar navbar-default">
              <div class="container-fluid">
                  <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                      </button>
                      <?php
                        if(isset($_SESSION["id"])){
                            echo "<a class='navbar-brand' href='./'>Home</a>";
                        }
                      ?>
                  </div>
                  <?php
                    
                    if(isset($_SESSION["id"])){
                        echo "<div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
                      <ul class='nav navbar-nav navbar-right'>
                          <li><a href='logout.php'>Uitloggen</a></li>
                      </ul>
                  </div>";
                    }
                  ?>
              </div>
          </nav>
      </div>
      <div class="container">