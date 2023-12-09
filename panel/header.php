<?php include("../db_connect.php"); ?>

<?php 
    session_start();

    if(!isset($_SESSION["admin"])){
        header("Location: login.php");
        exit();
    }
?>

<html>
<head>
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-minicolors/2.3.6/jquery.minicolors.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>

<body>

    <div class="row h-100 mx-0">
        <div class="col-auto ps-0">

<?php include("sidebar.php"); ?>
</div>
<div class="col">