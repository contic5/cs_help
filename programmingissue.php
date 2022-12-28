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
if(isset($_GET['issueID']))
{
  $issueID=$_GET['issueID'];
  $conn = mysqli_connect("localhost","cjcuser","computing","CSHelp");

  $query=sprintf("SELECT ID FROM ProgrammingIssues ORDER BY ID DESC LIMIT 1");
  $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
  while($row=mysqli_fetch_assoc($result))
  {
    $finalID=$row['ID'];
  }

  $query=sprintf("SELECT ID FROM ProgrammingIssues ORDER BY ID ASC LIMIT 1");
  $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
  while($row=mysqli_fetch_assoc($result))
  {
    $firstID=$row['ID'];
  }

  $nextname='';
  $previousname='';

  if($issueID!=$firstID)
  {
    $prevID=$issueID-1;
    $previousname='';
    $query=sprintf("SELECT * FROM ProgrammingIssues WHERE ID='%s'",$prevID);
    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

    while($row=mysqli_fetch_assoc($result))
    {
      $previousname=$row['Name'];
    }

    print("<form method='get'>");
    print("<input type='hidden' name='issueID' value='$prevID'>");
    print("<button type='submit'>Previous Issue: $previousname</button>");
    print("</form>");
  }

  if($issueID!=$finalID)
  {
    $nextID=$issueID+1;

    $nextname='';
    $query=sprintf("SELECT * FROM ProgrammingIssues WHERE ID='%s'",$nextID);
    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

    while($row=mysqli_fetch_assoc($result))
    {
      $nextname=$row['Name'];
    }

    print("<form method='get'>");
    print("<input type='hidden' name='issueID' value='$nextID'>");
    print("<button type='submit'>Next Issue: $nextname</button>");
    print("</form>");
  }

  $query=sprintf("SELECT * FROM ProgrammingIssues WHERE ID='%s'",$issueID);
  $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

  while($row=mysqli_fetch_assoc($result))
  {
    print("<h1>".$row["Name"]."</h1>");
    print("<h3>Difficulty:".$row["Difficulty"]."</h3>");
    print("<p>".$row["Description"]."</p>");
  }

  if($issueID!=$firstID)
  {
    $prevID=$issueID-1;
    print("<form method='get'>");
    print("<input type='hidden' name='issueID' value='$prevID'>");
    print("<button type='submit'>Previous Issue: $previousname</button>");
    print("</form>");
  }
  if($issueID!=$finalID)
  {
    $nextID=$issueID+1;
    print("<form method='get'>");
    print("<input type='hidden' name='issueID' value='$nextID'>");
    print("<button type='submit'>Next Issue: $nextname</button>");
    print("</form>");
  }

}

?>
<p><a href='programmingissues.php'>Return to all Programming Issues</a></p>
</div>
<div id='rightbar'>
<?php
require('addrightbar.php');
?>
</div>
</div>
</body>
</html>
