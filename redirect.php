<!--all php functions are decleraed in here-->
<?php

    require 'config.php';

    session_start();

    echo "Please wait! Connecting to Facebook Server.. ";


  

  if(isset($_GET['code']))//get Access token and store it inside $result
  {
    
    $result = get_auth_code(573815086485542, "https://www.oriad.lk/SSD/redirect.php", $_GET['code'], "faa8b7d1c1405d462d6267eb10246f20");
    
    
    $token_json = json_decode($result);//jason array to fetch token
    

    
    if(!isset($_COOKIE['access_token']))//set cookie to store access token to get when needed in server page
    {
     	setcookie("access_token",$token_json->access_token,time()+10,"/","www.oriad.lk/");
      	echo '<script> window.location.assign("https://www.oriad.lk/SSD/server.php") </script>';
    }

    	echo '<script> window.location.assign("https://www.oriad.lk/SSD/server.php") </script>';
 
    }



?>
