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
<?php
if(isset($_GET['topicID']))
{
  $firstID=-1;
  $finalID=-1;

  $topicID=$_GET['topicID'];
  $conn = mysqli_connect("localhost","cjcuser","computing","CSHelp");

  $query=sprintf("SELECT ID FROM Topics ORDER BY ID DESC LIMIT 1");
  $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
  while($row=mysqli_fetch_assoc($result))
  {
    $finalID=$row['ID'];
  }

  $query=sprintf("SELECT ID FROM Topics ORDER BY ID ASC LIMIT 1");
  $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
  while($row=mysqli_fetch_assoc($result))
  {
    $firstID=$row['ID'];
  }

  $nextname='';
  $previousname='';

  if($topicID!=$firstID)
  {
    $prevID=$topicID-1;
    $previousname='';
    $query=sprintf("SELECT * FROM Topics WHERE ID='%s'",$prevID);
    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

    while($row=mysqli_fetch_assoc($result))
    {
      $previousname=$row['Name'];
    }

    print("<form method='get'>");
    print("<input type='hidden' name='topicID' value='$prevID'>");
    print("<button type='submit'>Previous Topic: $previousname</button>");
    print("</form>");
  }

  if($topicID!=$finalID)
  {
    $nextID=$topicID+1;

    $nextname='';
    $query=sprintf("SELECT * FROM Topics WHERE ID='%s'",$nextID);
    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

    while($row=mysqli_fetch_assoc($result))
    {
      $nextname=$row['Name'];
    }

    print("<form method='get'>");
    print("<input type='hidden' name='topicID' value='$nextID'>");
    print("<button type='submit'>Next Topic: $nextname</button>");
    print("</form>");
  }


  $query=sprintf("SELECT * FROM Topics WHERE ID='%s'",$topicID);
  $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

  while($row=mysqli_fetch_assoc($result))
  {
    print("<h1>".$row["Name"]."</h1>");
    print("<h3>Difficulty:".$row["Difficulty"]."</h3>");
    print("<p>".$row["Description"]."</p>");
    $programminglink=$row['ProgrammingLink'];
    if($programminglink!='')
    {
      print("<iframe style='overflow: scroll;border: 0px; padding:0px; margin: 0px; width:100%; height:500px'");
      print("src='$programminglink'>");
      print("</iframe>");
    }
  }


  if($topicID!=$firstID)
  {
    $prevID=$topicID-1;
    print("<form method='get'>");
    print("<input type='hidden' name='topicID' value='$prevID'>");
    print("<button type='submit'>Previous Topic: $previousname</button>");
    print("</form>");
  }
  if($topicID!=$finalID)
  {
    $nextID=$topicID+1;
    print("<form method='get'>");
    print("<input type='hidden' name='topicID' value='$nextID'>");
    print("<button type='submit'>Next Topic: $nextname</button>");
    print("</form>");
  }
}

?>
<p><a href='topics.php'>Return to all Topics</a></p>
</div>
<div id='rightbar'>
<?php
require('addrightbar.php');
?>
</div>
</div>
</body>
</html>
