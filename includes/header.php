<?php

  session_start();
  /* Code goes here*/

?>


<!-- HTML Code -->
<!DOCTYPE HTML>
<!--
ZeroFour by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html lang="en">
<head>
  <title><?php
      if($title != ""){
        echo $title;
      }else{
        echo "Generic";
      }
    ?></title>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <!--[if lte IE 8]>


  <script src="/js/ie/html5shiv.js"></script><![endif]-->

  <!--[if lte IE 8]>
  <link rel="stylesheet" href="/css/ie8.css"/><![endif]-->
  <!--[if lte IE 9]>
  <link rel="stylesheet" href="/css/ie9.css"/><![endif]-->
  <link rel="stylesheet" href="/css/font-awesome.min.css" />
  <link rel="stylesheet" href="/css/main.css" />
  <link rel="stylesheet" href="/css/craigoverride.css" />
  <link rel="stylesheet" href="/css/craigoverride2.css" />
  <link rel="stylesheet" href="/css/craigoverride3.css" />
  <link rel="stylesheet" href="/css/craigoverride4.css" />
</head>
<body class="homepage">
<div id="page-wrapper">

  <!-- Header -->
  <div id="header-wrapper">
    <div class="container">

      <!-- Header -->
      <header id="header">
        <div class="inner">

          <!-- Logo -->
          <h1><a href="index.php" id="logo">HI</a></h1>

          <?php
            include "includes/nav.php";
          ?>

        </div>
      </header>
    </div>
  </div>
  <h1 class="white"><?php echo "Welcome: {$_SESSION['email']}"; ?></h1>




