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
if(isset($_GET['problemID']))
{
  $firstID=-1;
  $finalID=-1;

  $problemID=$_GET['problemID'];
  $conn = mysqli_connect("localhost","cjcuser","computing","CSHelp");

  $query=sprintf("SELECT ID FROM PracticeProblem ORDER BY ID DESC LIMIT 1");
  $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
  while($row=mysqli_fetch_assoc($result))
  {
    $finalID=$row['ID'];
  }

  $query=sprintf("SELECT ID FROM PracticeProblem ORDER BY ID ASC LIMIT 1");
  $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
  while($row=mysqli_fetch_assoc($result))
  {
    $firstID=$row['ID'];
  }

  $nextname='';
  $previousname='';

  if($problemID!=$firstID)
  {
    $prevID=$problemID-1;
    $prevname='';
    $query=sprintf("SELECT * FROM PracticeProblem WHERE ID='%s'",$prevID);
    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

    while($row=mysqli_fetch_assoc($result))
    {
      $prevname=$row['Name'];
    }

    print("<form method='get'>");
    print("<input type='hidden' name='problemID' value='$prevID'>");
    print("<button type='submit'>Previous Problem: $prevname</button>");
    print("</form>");
  }

  if($problemID!=$finalID)
  {
    $nextID=$problemID+1;

    $nextname='';
    $query=sprintf("SELECT * FROM PracticeProblem WHERE ID='%s'",$nextID);
    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

    while($row=mysqli_fetch_assoc($result))
    {
      $nextname=$row['Name'];
    }

    print("<form method='get'>");
    print("<input type='hidden' name='problemID' value='$nextID'>");
    print("<button type='submit'>Next Problem: $nextname</button>");
    print("</form>");
  }

  $query=sprintf("SELECT * FROM PracticeProblem WHERE ID='%s'",$problemID);
  $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

  while($row=mysqli_fetch_assoc($result))
  {
    $programminglink=$row['ProgrammingLink'];
    print("<h1>".$row["Name"]."</h1>");
    print("<h3>Difficulty:".$row["Difficulty"]."</h3>");
    print("<h4>Description</h4>");
    print("<p>".$row["Description"]."</p>");
    print("<h4>Expected Results</h4>");
    print("<p>".$row["Results"]."</p>");
    print("<iframe style='overflow: scroll;border: 0px; padding:0px; margin: 0px; width:100%; height:500px'");
    print("src='$programminglink'>");
    print("</iframe>");
  }

  if($problemID!=$firstID)
  {
    $prevID=$problemID-1;
    print("<form method='get'>");
    print("<input type='hidden' name='problemID' value='$prevID'>");
    print("<button type='submit'>Previous Problem: $previousname</button>");
    print("</form>");
  }
  if($problemID!=$finalID)
  {
    $nextID=$problemID+1;
    print("<form method='get'>");
    print("<input type='hidden' name='problemID' value='$nextID'>");
    print("<button type='submit'>Next Problem: $nextname</button>");
    print("</form>");
  }
}

?>
<p><a href='practiceproblems.php'>Return to all Practice Problems</a></p>
<h3>CodingGround is used for the compiler. Link:
  <a href='https://www.tutorialspoint.com/codingground.htm'>'https://www.tutorialspoint.com/codingground.htm'</a>
</h3>
</div>
<div id='rightbar'>
<?php
require('addrightbar.php');
?>
</div>
</div>
</body>
</html>
