<!DOCTYPE html>
<html>
<head>
	<title>Download game</title>
	<meta charset="utf-8">
<link rel="stylesheet" href="css/animate.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
  	.checked{
  		color:orange;
  	}
  	.fa-star{
  		margin: 4px;

  	}
  	td{
  		margin:  3px;
  	}
  	.panel{
  		width:450px;
  	}
  </style>
  <script type="text/javascript">
  	$(document).ready(function(){
  		var d=0;
$("#1").click(function(){
 d=1;

 for (var i = 1; i <=d; i++) {
 	$("#"+i).addClass("checked");
 }
});
$("#2").click(function(){
d=2;
 for (var i = 1; i <=d; i++) {
 	$("#"+i).addClass("checked");
 }
});
$("#3").click(function(){
d=3;
 for (var i = 1; i <=d; i++) {
 	$("#"+i).addClass("checked");
 }
});
$("#4").click(function(){
d=4;
 for (var i = 1; i <=d; i++) {
 	$("#"+i).addClass("checked");
 }
});
$("#5").click(function(){
d=5;
 for (var i = 1; i <=d; i++) {
 	$("#"+i).addClass("checked");
 }
  	});

$("#submit").click(function(){
	//alert("in");
	var name=$("#name").val();
	var comment=$("#comment").val();
	//alert(name+comment);
if (d!=0&&name!=null&&comment!=null) {
//alert("success");
 $.ajax({url: "download.php?d="+d+"&name="+name+"&comment="+comment, success: function(result){
          alert("Response added successfully");
	}});
}
});


});
  </script>
</head>
<body class="container-fluid">
	<center>
	<div class="panel panel-default">
		<div class="panel-heading"><h2 style="font-family: 'Courier New';color:green">Rate this app</h2></div>
  <div class="panel-body" >

<table>
	<tr>
	<td style="margin:8px;">
		
<span class="fa fa-star  " id="1" value="1"></span>
<span class="fa fa-star  " id="2"></span>
<span class="fa fa-star  " id="3"></span>
<span class="fa fa-star " id="4"></span>
<span class="fa fa-star " id="5"></span>

</td>
</tr><tr>
	<td>
<textarea type="text" class="form-control" id="comment" placeholder="please comment here" style="margin:8px;width: 300px;"></textarea>
</td>
</tr>
<tr>
	<td><input type="text" name=""  class="form-control" placeholder="enter your name" id="name"></td>
</tr>
<tr><td><input type="button" class="btn btn-primary" id="submit" name="" value="submit response" style="margin:8px;"></td></tr>
</table>
</div>
</div>
</center>
</body>
</html>
<?php

function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
$ip= getRealIpAddr();

//echo $ip;
$flag="false";
if (isset($ip)) {
  
 $conn= mysqli_connect("localhost","root","","findme");
if (!$conn) {
  
}
//echo "gere";
$sql="select * from download";
$result=mysqli_query($conn,$sql);

while($row=mysqli_fetch_array($result)){
//  echo "gere";
if ($row['ip']==$ip) {

  $sql1="update download set count=count+1 where ip='".$ip."'";
  mysqli_query($conn,$sql1);
  $flag="true";
}

}
//echo $flag.$ip;
if ($flag=="false") {
  
 $conn= mysqli_connect("localhost","root","","findme");
$sql2 = "INSERT INTO `download`(`id`, `ip`, `date`, `count`, `downloads`) VALUES (NULL,'$ip', 'now()', 0,0)";
//$sql = "INSERT INTO `findme`.`download` (`id`, `ip`, `date`, `count`, `downloads`) VALUES (NULL, \'\', \'\', \'\', \'\');";
    mysqli_query($conn,$sql2); 
}


}


if (isset($_GET['name'])&&isset($_GET['comment'])&&isset($_GET['d'])) {
	
	$name=$_GET['name'];
	$comment=$_GET['comment'];

	$rating=$_GET['d'];
	echo $name.$comment.$rating;
	 $conn= mysqli_connect("localhost","root","","findme");
	 if (!$conn) {
	 	
	 }

	
	 $sql = "update download set downloads=downloads+1, name='$name', comment='$comment' ,rating='$rating' where ip='$ip' ";
	 mysqli_query($conn,$sql);

}
?>