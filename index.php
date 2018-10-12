<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="style/style.css"/>
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
      <a class="navbar-brand" href="#">photoOcean</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
               <li id="l"><a href="#">Events</a></li>
        <li id="r" class="abt"><a href="#">About</a></li>
        <li><a href="showimages.php?mvp=true" >most liked</a></li>
         <li><a href="#foot" class="scroll">subscribe us</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li id="logout"><a href="#" onclick="logout()"><span class="glyphicon glyphicon-log-in" ></span> 
          <?php if(isset($_SESSION['fname'])&&isset($_SESSION['lname'])){
            echo '<h5 style="color:white;">'.$_SESSION['fname']."  ".$_SESSION['lname'].'</h5>';
        }
        ?>
      </a></li>
      </ul>
    </div>
  </div>
</nav>


	</center>

</body>
</html>

<?php
$flag=false;
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



if (isset($ip)) {
  
 $conn= mysqli_connect("localhost","root","","findme");
if (!$conn) {
  
}

$sql="select * from findme";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result)){
if ($row['ip']==$ip) {
  
  $sql1="update findme set count=count+1 where ip='".$ip."'";
  mysqli_query($conn,$sql1);
  $flag=true;
}
  $sql1="Insert into findme(id,ip,date,count) values(null,'"+$ip+"',now(),0)";
  mysqli_query($conn,$sql1); 

}

}




?>