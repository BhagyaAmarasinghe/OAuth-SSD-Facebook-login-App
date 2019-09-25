<!-- Don't loose this file -->

<?php

//function to get Access token
    function get_auth_code($client_id, $redirect_uri, $auth_code, $appID_secret_base64)
    {
        //define parameter using array
        $data = array('grant_type'=>'authorization_code', 'client_id'=>$client_id,'redirect_uri'=>$redirect_uri,'code'=>$auth_code);

        //build http query 
        $query = http_build_query($data);

    //create http contex details
    $contex_data = array(
                         'method'=>'POST',
                         'header'=>'Authorization:Basic '.$appID_secret_base64,
                         'content'=>$query
                        );

    //create contex resource for POST request
    $contx = stream_context_create(array('http'=>$contex_data));

    //store resuts in variable
    $access_token = file_get_contents('https://graph.facebook.com/oauth/access_token',false,$contx);

    return $access_token;

    }

    //change this according to your need * ex :- scope *
    function AUTH_URL($client_id,$redirect_url)
    {
        $url = "https://www.facebook.com/dialog/oauth?response_type=code&client_id=$client_id&redirect_uri=$redirect_url&scope=public_profile%20user_friends";

        
	return $url;
    }


    //function to get user ID
    function get_user_id($access_token)
    {
        $parameters = array('fields'=>'id');
        $buildParam = http_build_query($parameters);
        $requestContent = array('method'=>'GET','header'=>'Authorization:Bearer '.$access_token,'content'=>$buildParam);
        $reqcontex = stream_context_create(array('http'=>$requestContent));
        $result = file_get_contents('https://graph.facebook.com/v3.0/me?',false,$reqcontex);

        return $result;
    }

        //functions to get basic info of account
    function get_user_basics($access_token,$user_id)
    {
        //$parameters = array('fields'=>'id,email');
        //$buildParam = http_build_query($parameters);
    $requestContent = array('method'=>'GET','header'=>'Authorization:Bearer '.$access_token /*,'content'=>$buildParam*/);
        $reqcontex = stream_context_create(array('http'=>$requestContent));
        $resultmail = file_get_contents('https://graph.facebook.com/v3.0/'.$user_id.'?fields=email,birthday,link,picture',false,$reqcontex);
    
        return $resultmail;

    }


?>
