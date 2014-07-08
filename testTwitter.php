<?php

require_once __DIR__ . '/vendor/autoload.php';

$clientId = "";
$key = "";
$callbackUrl = "";

$twitterLogin = new \SitePoint\SocialLogin\Twitter\TwitterLogin($clientId, $key, $callbackUrl);

if(empty($_GET['oauth_token'])) {
    header("location: ".$twitterLogin->init()->getLoginUrl());
} else {
    $user = $twitterLogin->init()->loginCallback($_GET['oauth_token']);
    echo "Hi ". $user->getFirstname() . " " . $user->getLastname();
}

