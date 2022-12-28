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
<h1>Topics</h1>
<?php
$conn = mysqli_connect("localhost","cjcuser","computing","CSHelp");
$query=sprintf("SELECT * FROM Topics ORDER BY DifficultyID,ID");
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
  $problemID=$row['ID'];
  $problemname=$row['Name'];
  $displayname=$problemname;
  $problemname=str_replace(" ","_",$problemname);

  print("<form action='topic.php'>");
  print("<input type='hidden' name='topicID' value='$problemID'>");
  print("<p><button onclick='submit'>$displayname</button></p>");
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
