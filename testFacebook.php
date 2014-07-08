<?php

require_once __DIR__ . '/vendor/autoload.php';

$clientId = "";
$key = "";
$callbackUrl = "";

$facebookLogin = new \SitePoint\SocialLogin\Facebook\FacebookLogin($clientId, $key, $callbackUrl);

if(empty($_GET['code'])) {
    header("location: ".$facebookLogin->init()->getLoginUrl());
} else {
    $user = $facebookLogin->init()->loginCallback($_GET['code']);
    echo "Hi ". $user->getFirstname() . " " . $user->getLastname();
}

