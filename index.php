<?php

session_start();
require 'src/Facebook-4.4/autoload.php';

$app_id             = '1673188132913490';  //Facebook App ID
$app_secret         = '6e435fefb77a7972eeceb10dd81df0cb'; //Facebook App Secret
$required_scope     = 'public_profile, publish_actions, email'; //Permissions required
$redirect_url       = 'http://mdpu-finance.com/app-facebook/login.php'; //FB redirects to this page with a code

//include autoload.php from SDK folder, just point to the file like this:


//import required class to the current scope
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRedirectLoginHelper;

FacebookSession::setDefaultApplication($app_id , $app_secret);
$helper = new FacebookRedirectLoginHelper($redirect_url);

//try to get current user session
try {
  $session = $helper->getSessionFromRedirect();
} catch(FacebookRequestException $ex) {
    die(" Error : " . $ex->getMessage());
} catch(\Exception $ex) {
    die(" Error : " . $ex->getMessage());
}

if ($session){ //if we have the FB session
    $user_profile = (new FacebookRequest($session, 'GET', '/me'))->execute()->getGraphObject(GraphUser::className());
    //do stuff below, save user info to database etc.
   
    echo '<pre>';
    print_r($user_profile); //Or just print all user details
    echo '</pre>';
   
}else{

    //display login url
    $login_url = $helper->getLoginUrl( array( 'scope' => $required_scope ) );
    echo '<a href="'.$login_url.'">Login with Facebook</a>';
}