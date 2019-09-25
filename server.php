<?php

    require 'config.php';

    session_start();

   
    
?>

<!DOCTYPE html>
<html>
<head>
    <title> Results </title>
    <meta charset="UTF-8"/>
</head>
<body>
	<div align="center">
                <?php user(); ?>
		
		<h3>Hey <?php echo user()->name; ?>,</h3>
		<img src="<?php echo userBasics()->picture->data->url;?>" width="80" height="80" />  </p>
					<!--<?php user(); ?>
					<?php echo userBasics()->picture->data->url;?>-->
                <p> Name : <?php echo user()->name; ?> </p> 
                <p> E-Mail : <?php echo userBasics()->email; ?> </p>
               
        </div>        

<?php //php function to get data

    
    
    
    function user()	//set user ID to session variable
    {
        $result=get_user_id($_COOKIE['access_token']);
        $jason = json_decode($result);
        $_SESSION['id'] = $jason->id;
        
        return $jason;
    } 
    
    function userBasics() // get user data based on user id
    {
            if(isset($_SESSION['id']))
            {
            $rsult = get_user_basics($_COOKIE['access_token'],$_SESSION['id']);
            $jason = json_decode($rsult);
            return $jason;
            }
            else
            {
                echo "Session ID not detected";
            }
     }  
        
    
?>



</body>
</html>
