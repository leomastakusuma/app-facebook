<?php

require 'src/Facebook-fixed/autoload.php';
session_start();

$fb = new Facebook\Facebook([
  'app_id' => '1673188132913490',
  'app_secret' => '6e435fefb77a7972eeceb10dd81df0cb',
  'default_graph_version' => 'v2.4',
  'allowSignedRequest' => false 
  ]);

$helper = $fb->getRedirectLoginHelper();
$permissions = array(
  'email',
  'user_location',
  'user_birthday'
);
$loginUrl = $helper->getLoginUrl('http://mdpu-finance.com/app-facebook/fb-callback.php', $permissions);

echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';