<?php

namespace SitePoint\SocialLogin\Interfaces;

interface SocialLoginInterface {

    /**
     * Initializes our service
     */
    public function init();

    /**
     * Returns the login url for the social network
     *
     * @return string
     */
    public function getLoginUrl();

    /**
     * Handles the login callback from the social network
     *
     * @param string $accessToken
     *
     * @return SocialUserInterface
     */
    public function loginCallback($accessToken);
}
