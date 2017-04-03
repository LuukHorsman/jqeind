<?php
include("testhelp.php");

?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Post to PHP Tutorial</title>
<script type="text/javascript" src="jquery.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
</head>
<body>
<form>
 <input type="text" id="name" placeholder="Enter Your Name..." /><br />
 <input type="text" id="age" placeholder="Enter Your age..." /><br />
 <input type="button" value="Submit" onclick="post();">
</form>

<div id="result"></div>

<script type="text/javascript">

function post()
{
 //alert("working");
 var name = $('#name').val();
 var age = $('#age').val();
 
 $.post('testhelp.php',{postname:name,postage:age},
 function(data){
    
//   $('#result').html(data);
 });
}

</script>
</body>
</html>