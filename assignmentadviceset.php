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
<h1>Assignment Advice Set</h1>
<?php
$conn = mysqli_connect("localhost","cjcuser","computing","CSHelp");
$query=sprintf("SELECT * FROM AssignmentAdvice ORDER BY DifficultyID,Name");
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
$lastdifficulty=-1;
while($row=mysqli_fetch_assoc($result))
{
  $difficulty=$row['Difficulty'];
  if($lastdifficulty!=$difficulty)
  {
    $lastdifficulty=$difficulty;
    print("<h2>".$row['Difficulty']."</h2>");
  }
  $adviceID=$row['ID'];
  $advicename=$row['Name'];
  $displayname=$advicename;
  $problemname=str_replace(" ","_",$advicename);

  print("<form action='assignmentadvice.php'>");
  print("<input type='hidden' name='adviceID' value='$adviceID'>");
  print("<p><button onclick='submit'>$advicename</button></p>");
  print("</form>");
}
?>
</div>
<div id='rightbar'>
<?php
require('addrightbar.php');
?>
</div>
</div>
</body>
</html>
