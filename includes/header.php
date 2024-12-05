<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.5.0/remixicon.css" integrity="sha512-6p+GTq7fjTHD/sdFPWHaFoALKeWOU9f9MPBoPnvJEWBkGS4PKVVbCpMps6IXnTiXghFbxlgDE8QRHc3MU91lJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
<link rel="shortcut icon" href="../assets/images/fav.png" type="image/x-icon">
 <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
<div class="wrapper">
    <header>
<nav class="navbar navbar-expand-lg border-bottom shadow-sm">
  <div class="container">

    <a class="navbar-brand" href="index.php"><img src="../assets/images/logo.png" alt="Logo" style="width: 50px;"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav mx-auto my-2 my-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php"><i class="ri-home-smile-line"></i> Home </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="report_lost.php"><i class="ri-emotion-unhappy-line"></i> Lapor Kehilangan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="report_found.php"><i class="ri-emotion-happy-line"></i> Lapor Menemukan</a>
        </li>
        <!--
        <li class="nav-item">
          <a class="nav-link" href="about.php"><i class="ri-spy-line"></i> About</a>
        </li>-->

        <!--
        <li class="nav-item me-3">
          <a class="nav-link" href="contact.php"><i class="ri-contacts-line"></i> Contact</a>
        </li> -->
      </ul>
      <form class="d-flex" role="search">

      <?php
      if (!isset($_SESSION['user_id'])) {
          echo '<a href="login.php" class="btn btn-outline-success"><i class="ri-login-circle-line me-1"></i> Login</a>';
      }else{
        echo '<a href="dashboard.php" class="btn btn-outline-success"><i class="ri-dashboard-3-line me-1"></i> Dashboard</a>';
      }
      ?>
       
      </form>
    </div>
  </div>
</nav>
</header>
<main>
