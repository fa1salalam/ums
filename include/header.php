<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>User Management System</title>
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/style.css">
  </head>
  <body>
    <div class="container">

    <nav class="navbar navbar-expand-md navbar-dark bg-dark card-header">
    <!-- <a class="navbar-brand" href="index.php"><i class="fas fa-home mr-2"></i>Dashboard</a> -->
    <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" 
    data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" 
    aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button> -->

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php"><i class="fas fa-users mr-2"></i>User lists </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="addUser.php"><i class="fas fa-user-plus mr-2"></i>Add user </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt mr-2"></i>Login</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="?action=logout"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
            </li>
        </ul>
    </div>
    </nav>