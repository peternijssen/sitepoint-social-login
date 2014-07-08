<?php

namespace SitePoint\SocialLogin\Facebook;

use SitePoint\SocialLogin\Interfaces\SocialLoginInterface;
use OAuth\ServiceFactory;
use OAuth\OAuth2\Service\Facebook;
use OAuth\Common\Storage\Session;
use OAuth\Common\Consumer\Credentials;

class FacebookLogin implements SocialLoginInterface {

    /**
     * Facebook service
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
        $this->service = $serviceFactory->createService(
            'facebook',
            $credentials,
            $storage,
            array(
                Facebook::SCOPE_EMAIL,
                Facebook::SCOPE_USER_BIRTHDAY,
                Facebook::SCOPE_USER_LOCATION
            )
        );

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
        $token = $this->service->requestAccessToken($accessCode);

        // Send a request with it
        $userData = json_decode($this->service->request('/me'), true);
        $facebookUser = new FacebookUser($userData);
        return $facebookUser;
    }
}
