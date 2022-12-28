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
<h1>Output is Unexpected</h1>
<p>
When coding, you may work on a program and find that it
produces unexepected output. This is more likely to happend
as a program becomes more complicated. This is where
debugging is useful.
</p>
<p>
One way of debugging is by inserting print statements at key
points in a program, such as where input is accepted or a
critical variable changes. Oftentimes, if a program
continuously runs when it should stop, inserting a print
statement in a loop will show that there is a issue in the loop.
</p>
<p>
Unexpected output can also be avoided by being proactive.
Checking if a program is working correctly one step at a time
is much easier than checking if a program works after every
feature is completed.
</p>
<p>
In addition, testing if the output is expected across various
cases helps with finding and replicating errors.
</p>
<p>
Example code is shown below. See if you can find what is
wrong with the code:
</p>
<p><a href='http://tpcg.io/16EW5cDc'>Link to code here</a></p>
<p>
For this example, we can see that the code is not working correctly. Distance squared should never be negative,
which is why we are getting an unexpected output. This can be fixed by setting dissq to equal abs(dissq). Printing out
statements helps with tracing errors. While this example is trivial, debugging like this is especially useful as
projects become larger.
</p>
<h1>Tags: Programming Issues, General</h1>
</div>
<div id='rightbar'>
<?php
require('addrightbar.php');
?>
</div>
</div>
</body>
</html>
