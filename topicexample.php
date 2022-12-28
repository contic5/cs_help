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
<h1>Python Global Variables</h1>
<p>
  Global variables are declared outside of any method.
</p>
<p>
Local variables are declared inside of a method.
</p>
<p>
Local and global variables can share the same name. This
may not be wise due to confusion over whether you are
referring to the local or global variable
</p>
<p>
When a local variable shares the name with a global variable
in a method, the local variable is referred to when that variable
is accessed in that method.
</p>
<p>
The global keyword is used to access global methods.
Variables are written with the keyname global (variablename)
before they are used by the method.
</p>
<h1>Tags: Programming, Novice</h1>
</div>
<div id='rightbar'>
<?php
require('addrightbar.php');
?>
</div>
</div>
</body>
</html>
