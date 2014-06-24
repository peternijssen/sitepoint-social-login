<?php

require_once __DIR__ . '/vendor/autoload.php';

$clientId = "";
$key = "";
$callbackUrl = "";

$googleLogin = new \SitePoint\SocialLogin\Google\GoogleLogin($clientId, $key, $callbackUrl);

if(empty($_GET['code'])) {
    header("location: ".$googleLogin->init()->getLoginUrl());
} else {
    $user = $googleLogin->init()->loginCallback($_GET['code']);
    echo "Hi ". $user->getFirstname() . " " . $user->getLastname();
}

