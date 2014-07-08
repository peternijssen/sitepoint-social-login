<?php

namespace SitePoint\SocialLogin\Twitter;

use SitePoint\SocialLogin\Interfaces\SocialLoginInterface;
use OAuth\ServiceFactory;
use OAuth\OAuth1\Service\Twitter;
use OAuth\Common\Storage\Session;
use OAuth\Common\Consumer\Credentials;

class TwitterLogin implements SocialLoginInterface {

    /**
     * Twitter service
     *
     * @var string
     */
    protected $service;

    /**
     * OAuth client ID
     *
     * @var string
     */
    protected $clientId;

    /**
     * OAuth key
     *
     * @var string
     */
    protected $key;

    /**
     * Callback url
     *
     * @var string
     */
    protected $callbackUrl;

    /**
     * Constructor.
     *
     * @param $clientId string
     * @param $key string
     * @param $callbackUrl string
     */
    public function __construct($clientId, $key, $callbackUrl)
    {
        $this->clientId = $clientId;
        $this->key = $key;
        $this->callbackUrl = $callbackUrl;
    }

    /**
     * Initializes our service
     */
    public function init()
    {
        $storage = new Session();
        $serviceFactory = new ServiceFactory();
        $credentials = new Credentials($this->clientId, $this->key, $this->callbackUrl);
        $this->service = $serviceFactory->createService('twitter', $credentials, $storage);

        return $this;
    }

    /**
     * Returns the login url for the social network
     *
     * @return string
     */
    public function getLoginUrl()
    {
        $token = $this->service->requestRequestToken();
        return $this->service->getAuthorizationUri(array('oauth_token' => $token->getRequestToken()));
    }

    /**
     * Handles the login callback from the social network
     *
     * @param string $accessCode
     *
     * @return SocialUserInterface
     */
    public function loginCallback($accessCode)
    {
        $storage = new Session();
        $token = $storage->retrieveAccessToken('Twitter');

        $this->service->requestAccessToken(
            $_GET['oauth_token'],
            $_GET['oauth_verifier'],
            $token->getRequestTokenSecret()
        );
        $userData = json_decode($this->service->request('account/verify_credentials.json'), true);
        $twitterUser = new TwitterUser($userData);
        return $twitterUser;
    }
}
