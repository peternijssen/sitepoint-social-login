<?php

namespace SitePoint\SocialLogin\Google;

use SitePoint\SocialLogin\Interfaces\SocialLoginInterface;
use OAuth\ServiceFactory;
use OAuth\OAuth2\Service\Google;
use OAuth\Common\Storage\Session;
use OAuth\Common\Consumer\Credentials;

class GoogleLogin implements SocialLoginInterface {

    /**
     * Google service
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
        $this->service = $serviceFactory->createService('google', $credentials, $storage, array('userinfo_email', 'userinfo_profile'));

        return $this;
    }

    /**
     * Returns the login url for the social network
     *
     * @return string
     */
    public function getLoginUrl()
    {
        return $this->service->getAuthorizationUri();
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
        $this->service->requestAccessToken($accessCode);
        $userData = json_decode($this->service->request('https://www.googleapis.com/oauth2/v1/userinfo'), true);
        $googleUser = new GoogleUser($userData);
        return $googleUser;
    }
}
