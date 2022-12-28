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

<p style='font-size:24px;'>
Search Results:
<span id='showsearchterm' style='background-color:white; display: inline-block; min-width: 500px;'>Objects</span>
</p>



<div style='text-align:center'>
<?php
if(isset($_GET['searchterm']))
{
  $pagenumber=0;
  if(isset($_GET['pagenumber']))
  {
    $pagenumber=$_GET['pagenumber'];
  }

  $searchterm=$_GET['searchterm'];
  $searchtermjson=json_encode($searchterm);
  $conn = mysqli_connect("localhost","cjcuser","computing","CSHelp");

  $escape_search=mysqli_real_escape_string($conn,$searchterm);
  $query=sprintf(
    "SELECT ID,Name,Type,Description FROM PracticeProblem WHERE Name LIKE '%%%s%%'
    UNION SELECT ID,Name,Type,Description FROM AssignmentAdvice WHERE Name LIKE '%%%s%%'
    UNION SELECT ID,Name,Type,Description FROM ProgrammingIssues WHERE Name LIKE '%%%s%%'
    UNION SELECT ID,Name,Type,Description FROM Topics WHERE Name LIKE '%%%s%%'",
    $escape_search,$escape_search,$escape_search,$escape_search);
  $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
  $totalresults=mysqli_num_rows($result);
  $totalpages=ceil($totalresults/5);


  $query=sprintf(
    "SELECT ID,Name,Type,Description FROM PracticeProblem WHERE Name LIKE '%%%s%%'
    UNION SELECT ID,Name,Type,Description FROM AssignmentAdvice WHERE Name LIKE '%%%s%%'
    UNION SELECT ID,Name,Type,Description FROM ProgrammingIssues WHERE Name LIKE '%%%s%%'
    UNION SELECT ID,Name,Type,Description FROM Topics WHERE Name LIKE '%%%s%%' LIMIT 5 OFFSET '%d'",
    $escape_search,$escape_search,$escape_search,$escape_search,$pagenumber*5);
  $result = mysqli_query($conn,$query) or die(mysqli_error($conn));


  print("<table style='width:100%; table-layout: fixed; text-align:center;'><tbody><tr>
  <td>");

  print("<form>");
  print("<input name='searchterm' value='$searchterm' type='hidden'>");
  print("<input name='pagenumber' value='".($pagenumber-1)."' type='hidden'>");
  if($pagenumber>0)
  {
    print("<button class='majorarea'>Previous</button>");
  }
  else
  {
    print("<button disabled class='majorarea'>Previous</button>");
  }
  print("</form>");

  print("</td>
  <td style='font-size:18px;'>Page ".($pagenumber+1)." of $totalpages</td>
  <td>");
  print("<form>");
  print("<input name='searchterm' value='$searchterm' type='hidden'>");
  print("<input name='pagenumber' value='".($pagenumber+1)."' type='hidden'>");
  if($pagenumber+1<$totalpages)
  {
    print("<button class='majorarea'>Next</button>");
  }
  else
  {
    print("<button disabled class='majorarea'>Next</button>");
  }
  print("</form>");
  print("</td></tr></tbody></table>");


  print("<div id='results' style='width:500px; margin:auto;'>");
  $lasttype='';
  while($row=mysqli_fetch_assoc($result))
  {
    $ID=$row['ID'];
    $name=$row["Name"];
    $type=$row['Type'];
    $typename='';
    $parameter='';
    $link='';
    if($type=='PracticeProblem')
    {
      $typename='Practice Problem';
      $link='practiceproblem.php';
      $parameter='problemID';
    }
    if($type=='ProgrammingIssue')
    {
      $typename='Programming Issue';
      $link='programmingissue.php';
      $parameter='issueID';
    }
    if($type=='Topics')
    {
      $typename='Topics';
      $link='topic.php';
      $parameter='topicID';
    }
    if($type=='AssignmentAdvice')
    {
      $typename='AssignmentAdvice';
      $link='assignmentadvice.php';
      $parameter='adviceID';
    }

    if($lasttype!=$type)
    {
      print("<h2>".$typename."</h2>");
      $lasttype=$type;
    }
    print("<form action='".$link."' method='get'>");
    $desc=$row["Description"];
    $words=explode(" ",$desc);
    $maxwords=min(sizeof($words),20);
    if(sizeof($words)>1)
    {
      print("<p>");
      for($i=0;$i<$maxwords;$i++)
      {
        print($words[$i]);
        if($i<$maxwords-1)
        {
          print(" ");
        }
      }
      print("...</p>");
    }
    else
    {
      print("<p>Further description is provided within the article.</p>");
    }
    print("<input type='hidden' name='$parameter' value='$ID'>");
    print("<p><button>".$name." ".$typename."</button></p>");
    print("</form>");
  }
  print("</div>");

  print("<table style='width:100%; table-layout: fixed; text-align:center;'><tbody><tr>
  <td>");

  print("<form>");
  print("<input name='searchterm' value='$searchterm' type='hidden'>");
  print("<input name='pagenumber' value='".($pagenumber-1)."' type='hidden'>");
  if($pagenumber>0)
  {
    print("<button class='majorarea'>Previous</button>");
  }
  else
  {
    print("<button disabled class='majorarea'>Previous</button>");
  }
  print("</form>");

  print("</td>
  <td style='font-size:18px;'>Page ".($pagenumber+1)." of $totalpages</td>
  <td>");
  print("<form>");
  print("<input name='searchterm' value='$searchterm' type='hidden'>");
  print("<input name='pagenumber' value='".($pagenumber+1)."' type='hidden'>");
  if($pagenumber+1<$totalpages)
  {
    print("<button class='majorarea'>Next</button>");
  }
  else
  {
    print("<button disabled class='majorarea'>Next</button>");
  }
  print("</form>");
  print("</td></tr></tbody></table>");
}
?>



<script>
<?php

print("document.getElementById('showsearchterm').innerHTML=$searchtermjson");
?>
</script>

</div>
</div>

<div id='rightbar'>
<?php
require('addrightbar.php');
?>
</div>
</div>
</body>
</html>
