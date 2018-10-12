<!DOCTYPE html>
<html>
<head>

	<title>Login</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/animate.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
  #heading {
  animation-duration: 4.5s;
  animation-delay: 2s;
  animation-iteration-count: 6;
}
img{
   animation-duration: 3s;
  animation-delay: 2s;
  animation-iteration-count: 2;
}
</style>
<script type="text/javascript">
  $(document).ready(function(){
$('img').addClass("animated rubberBand delay2s");
$('nav').addClass("animated flipInX delay2s");
  });
</script>
</head>


<body class="container-fluid">

<nav class="navbar navbar-inverse top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Findme</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
               <li id="l"><a href="#">Events</a></li>
        <li id="r" class="abt"><a href="#">About</a></li>
        <li><a href="showimages.php?mvp=true" >most liked</a></li>
         <li><a href="#foot" class="scroll">subscribe us</a></li>
      </ul>
     
    </div>
  </div>
</nav>

	</center>
  <center><h1 style="font-family: 'Courier New';" id="heading"  class="animated bounce delay-2s">Find me</h1></center>
<center>
  

<div id="myCarousel" class="carousel slide " data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">

      <div class="item active">
        <img src="images/first.png" alt="Los Angeles" style="width:30%;height: 400px;">
        <div class="carousel-caption">
          
          <p></p>
        </div>
      </div>
      <div class="item">
        <img src="images/laptop2.png" alt="Chicago" style="width:30%;height: 400px;">
        <div class="carousel-caption">
         
          <p>laptop detected</p>
        </div>
      </div>
      <div class="item">
        <img src="images/scooter.png" alt="New York" style="width:30%;height: 400px;">
        <div class="carousel-caption">
          <h3></h3>
          <p>scooter detected</p>
        </div>
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


$flag="false";
if (isset($ip)) {
  
 $conn= mysqli_connect("localhost","root","","findme");
if (!$conn) {
  
}
echo "gere";
$sql="select * from findme";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result)){
  echo "gere";
if ($row['ip']==$ip) {

  $sql1="update findme set count=count+1 where ip='".$ip."'";
  mysqli_query($conn,$sql1);
  $flag="true";
}

}
if ($flag=="false") {
  
 $conn= mysqli_connect("localhost","root","","findme");
$sql2 = "INSERT INTO `findme`.`findme` (`id`, `ip`, `date`, `count`) VALUES (NULL,'$ip', now(), 0)";
    mysqli_query($conn,$sql2); 
}


}




?>