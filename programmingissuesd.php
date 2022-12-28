<html>
<head>
  <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body>
<?php
include('header.php');
require('sessionstart.php');
?>
<div id='main'>
<div id='leftbar'>
<?php
require('addleftbar.php');
?>
</div>
<div id='content'>
<h1>Programming Issues</h1>
  <h2>Novice</h2>
  <a href=''>Classes</a><br>
  <a href=''>Loops</a><br>
  <a href=''>Objects</a><br>
  <a href=''>Functions</a><br>
  <a href=''>Basic Imports</a><br>

  <h2>Learning</h2>
  <a href=''>APIs</a><br>
  <a href=''>Recursion</a><br>
  <a href=''>Java Swing (Draw)</a><br>
  <a href=''>Binary to Decimal</a><br>

  <h2>Competent</h2>
  <a href=''>Big O</a><br>
  <a href=''>Data Structures</a><br>
  <a href=''>Search Algorithms</a><br>
  <a href=''>Sort Algorithms</a><br>
  <a href=''>Floating Points</a><br>

  <h2>Proficient</h2>
  <a href=''>Functional Languages</a><br>
  <a href=''>Shortest Path Algorithm</a><br>
</div>
<div id='rightbar'>
<?php
require('addrightbar.php');
?>
</div>
</div>
</body>
</html>
